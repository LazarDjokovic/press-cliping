<?php

namespace App\Http\Controllers;

use App\Model\Keyword;
use Illuminate\Http\Request;
use Validator;

class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //return response ($request->all(),200);
        $validator=Validator::make($request->all(), [
            'name'=>'required|unique:keywords',
            'company_id'=>'required'
        ]);

        if($validator->fails()){
            return response(array('success'=>false,'error'=>$validator->errors()),200);
        }

        try{
            $companyId = Keyword::create([
                'name' => $request->name,
                'company_id'=>$request->company_id
            ]);

            return response(array('success'=>true,'message'=> 'Keywords added'),200);
        }
        catch(\Exception $e){
            return response(array('success'=>false,'message'=> $e->getMessage()),200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Keyword  $keyword
     * @return \Illuminate\Http\Response
     */
    public function show(Keyword $keyword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Keyword  $keyword
     * @return \Illuminate\Http\Response
     */
    public function edit(Keyword $keyword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Keyword  $keyword
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keyword $keyword)
    {
        $validator=Validator::make($request->all(), [
            'name'=>'required|unique:keywords',
            'company_id'=>'required'
        ]);

        if($validator->fails()){
            return response(array('success'=>false,'error'=>$validator->errors()),200);
        }

        try{
            Keyword::where('id', $keyword->id)
                ->update([
                    'name' =>$request->name,
                    'company_id'=>$request->company_id
                ]);
            return response(array('success'=>true,'message'=>'Keyword updated'),200);
        }
        catch (\Exception $e){
            return response(array('success'=>false,'error'=>$e->getMessage()),200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Keyword  $keyword
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keyword $keyword)
    {
        try{
            Keyword::where('id','=',$keyword->id)->delete();
            return response(array('success'=>true,'message'=>'Keyword deleted'),200);
        }
        catch (\Exception $e){
            return response(array('success'=>false,'message'=>$e->getMessage()),200);
        }
    }
}
