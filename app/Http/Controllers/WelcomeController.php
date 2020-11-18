<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultant;

class WelcomeController extends Controller
{
    public function index(Request $request){
        $consultants=Consultant::take(10)->get();
        return view("welcome")->with("consultants",$consultants);
    }
}
