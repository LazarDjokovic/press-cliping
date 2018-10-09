<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        if($users)
            return response(array('success' => true, 'users' => $users), 200);
        return response(array('success' => false), 204);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'email'=>'required|email|unique:users',
            'name'=>'required',
            'last_name'=>'required',
        ]);

        if($validator->fails()){
            return response(array('success'=>false,'error'=>'Polja nisu u dobrom formatu'),200);
        }

        try{
            User::create($request->all());
            return response(array('success'=>true,'message'=>'Korisnik dodat'),200);
        }
        catch(\Exception $e){
            return response(array('success'=>false,'message'=> $e->getMessage()),200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator=Validator::make($request->all(), [
            'email'=>'required|email|unique:users',
            "password"=>'required',
            'name'=>'required',
            'last_name'=>'required',
        ]);

        if($validator->fails()){
            return response(array('success'=>false,'error'=>'Polja nisu u dobrom formatu'),200);
        }

        try{
            User::where('id', $user->id)
                ->update([
                    'name' =>$request->name,
                    'last_name'=>$request->last_name,
                    'email'=>$request->email,
                    'password'=>$request->password
                ]);
            return response(array('success'=>true,'message'=>'User updateovan'),200);
        }
        catch (\Exception $e){
            return response(array('success'=>false,'error'=>$e->getMessage()),200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $userDelete = User::find($user->id)->first();

        try{
            $userDelete->delete();
            return response(array('success'=>true,'message'=>'User obrisan'),200);
        }
        catch (\Exception $e){
            return response(array('success'=>false,'message'=>$e->getMessage()),200);
        }
    }
}
