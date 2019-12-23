<?php

namespace App\Http\Controllers;
use App\User; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiAuthController extends Controller
{
	public function view(){
		return User::all()->toArray();
	}
     public function register(Request $request) 
    	{ 
        $validateData=$request->validate([
        	'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required'
        	]);
        $validateData['password']=bcrypt($request->password);
        $user=User::create($validateData);
        $accessToken=$user->createToken('authToken')->accessToken;
        return response(['message'=>"Insert data",'user'=>$user,'accessToken'=>$accessToken]);
}
	public function login(Request $request){
		$loginData=$request->validate([
            'email' => 'required|email', 
            'password' => 'required'
        	]);
		if(!auth()->attempt($loginData)){
			return response(['message'=>"invalid data"]);
		}
		$accessToken=auth()->user()->createToken('authToken')->accessToken;
		return response(['message'=>"Login Successfull",'user'=>auth()->user(),'accessToken'=>$accessToken]);

	}
}
