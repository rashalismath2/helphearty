<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function __construct(){
        $this->middleware("auth:cons");
    }

    public function index(Request $request){
        return view("Consultant.stream");
    }
}
