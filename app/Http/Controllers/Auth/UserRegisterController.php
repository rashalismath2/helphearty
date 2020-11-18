<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Consultant;

class UserRegisterController extends Controller
{
    public function __construct(){
        $this->middleware("guest");
    }


    public function showRegisterForConsultant(Request $request){
        return view("Consultant/Auth/Register");
    }

    public function register(Request $request){

        $validate=$request->validate([
            "email"=>"required|unique:users",
            "name"=>"required",
            "password"=>"required"
        ]);

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        
        $user->save();

        return redirect()->route("login-view");

    }
    public function registerConsultant(Request $request){

        $validate=$request->validate([
            "email"=>"required|unique:consultants",
            "first_name"=>"required",
            "last_name"=>"required",
            "education"=>"required",
            "password"=>"required"
        ]);

        $user=new Consultant();
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->education=$request->education;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        
        $user->save();

        return redirect()->route("login-cons");

    }
}
