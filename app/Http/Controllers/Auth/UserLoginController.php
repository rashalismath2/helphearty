<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserLoginController extends Controller
{
    public function __construct(){
        $this->middleware("guest",["except"=>["logout"]]);
    }

    public function showLogin(){
        return view("User/Auth/Login");
    }
    public function showLoginForConsultant(){
        return view("Consultant/Auth/Login");
    }

    public function login(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard("web")->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/home');
        }

        $errors = new MessageBag();
        $errors->add("login",'Email and/or password invalid.'); 

        return redirect()->back()->withErrors($errors)->withInput();
    }

    public function loginConsultant(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard("cons")->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/dasboard');
        }

        $errors = new MessageBag();
        $errors->add("login",'Email and/or password invalid.'); 

        return redirect()->back()->withErrors($errors)->withInput();
    }

    public function logout(Request $request){
        Auth::guard($request->guard)->logout();
        if($request->guard=="web"){
            return redirect()->route("login-view");
        }
        else{
            return redirect()->route("login-view-cons");
        }
    }
}
