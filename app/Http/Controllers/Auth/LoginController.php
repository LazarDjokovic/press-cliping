<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'email'=>'required|email:unique',
            'password'=>'required'
        ]);

        if($validator->fails()){
            $errors=$validator->errors();
            return response(array('success'=>false,'errors'=>$errors),200);
        }

        if(Auth::check()){
            $user = Auth::user();
            return response(array('success' => true, 'user' => $user), 200);
        }

        $user_attempt = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if($user_attempt){
            $user = Auth::user();
            return response(array('success' => true, 'user' => $user), 200);
        }

        return response(array('success'=>false,'message'=>'Email ili lozinka ne postoje'), 200);
    }
}
