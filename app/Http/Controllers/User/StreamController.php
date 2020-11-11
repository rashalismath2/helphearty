<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function __construct(){
        $this->middleware("web");
    }

    public function index(Request $request){
        return view("User.stream");
    }

}
