<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Consultant;

class UserLoginController extends Controller
{
    public function __construct(){
        $this->middleware("guest",["except"=>["logout"]]);
    }

   
    public function showLoginForConsultant(){
        return view("Consultant/Auth/Login");
    }

    public function getAccessTokenForUser(Request $request){
        $user=User::where("email",$request->email)->first();
    }

    public function getAcessToken(Request $request){
        $guard=$request->guard;
        if($guard=="web"){
            $user=User::where("email",$request->email)->first();
            
            $token = $user->createToken('access_token')->accessToken;
            return response()->json(["api_token"=>$token]);
        }
        else if($guard=="cons"){
            $user=Consultant::where("email",$request->email)->first();
            
            $token = $user->createToken('access_token')->accessToken;
            return response()->json(["api_token"=>$token]);
        }
    }

    public function login(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard("web")->attempt($credentials)) {
    
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
            $user=Auth::guard("cons")->user();
            $token = $user->createToken('access_token')->accessToken;
            
            return redirect()->intended('/dashboard');
        }

        $errors = new MessageBag();
        $errors->add("login",'Email and/or password invalid.'); 

        return redirect()->back()->withErrors($errors)->withInput();
    }

    public function logout(Request $request){
        Auth::guard($request->guard)->logout();
        if($request->guard=="web"){
            return redirect()->route("welcome");
        }
        else{
            return redirect()->route("login-view-cons");
        }
    }
}
