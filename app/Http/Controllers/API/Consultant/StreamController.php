<?php

namespace App\Http\Controllers\API\Consultant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Events\AnswerSend;

class StreamController extends Controller
{
    public function __construct(){
        $this->middleware("auth:consapi");
    }

    public function sendAnswer(Request $request){
        broadcast(new AnswerSend($request->answer,auth()->user(),"cons",$request->toId))->toOthers();
        return response()->json(["message"=>"answer sent"]);
    }
}
