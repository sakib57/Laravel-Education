<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{

	public function __construct(){
		$this->middleware('guest:admin',['except'=>['logout']]);
	}

    public function showLoginForm(){
    	return view('auth.admin-login');
    }

    public function login(Request $request){
    	//validate form data
    	$this->validate($request,[
    		'email'=>'required|email',
    		'password'=>'required|min:6'
    	]);
    	//get data 
    	
    	$credentials = $request->only('email', 'password');
    	// echo '<pre>';
    	// 	print_r($credentials);
    	// 	exit();
    	//attempt to login
    	if(Auth::guard('admin')->attempt($credentials,$request->remember)){

    		// echo '<pre>';
    		// print_r($credentials);
    		// exit();
    		//if success, redirect
    		return redirect()->intended(route('admin.dashboard'));
    	}
    	//if unsuccess , return
    	return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        //$this->guard()->logout();
        //$request->session()->invalidate();

        return redirect()->route('admin.login');
    }
}
