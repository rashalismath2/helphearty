<?php

namespace App\Http\Controllers\API\Consultant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Consultant;
use App\Models\Message;

use Illuminate\Support\Facades\Auth;

use App\Events\MessageSent;

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware("auth:consapi");
    }
    public function GetConversationWithUsers(Request $request){

        $messages=Consultant::where("id",auth()->user()->id)->with("users.messages")->first();
        return response()->json($messages);
    }

    public function SaveConversationWithUser(Request $request){
        
        $message=new Message();
        $message->message=$request->message;
        $message->consultant_id=auth()->user()->id;
        $message->user_id=$request->userId;
        $message->from="consultant";

        $message->save();
        
        broadcast(new MessageSent($message,auth()->user(),"cons"))->toOthers();
        return response()->json(["message"=>"message created"]);
    }
}
