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
    public function GetConversationWithUsers(Request $request){
        //TODO - authenticated use messages
        //Middle ware to redirtect user if he hadnt have a consultatn
        $messages=Consultant::where("id",1)->with("users.messages")->first();
        return response()->json($messages);
    }

    public function SaveConversationWithUser(Request $request){
        //TODO - authenticated use messages
        //Middle ware to redirtect user if he hadnt have a consultatn
        
        $message=new Message();
        $message->message=$request->message;
        $message->consultant_id=1;
        $message->user_id=$request->userId;
        $message->from="consultant";

        $message->save();
        
        broadcast(new MessageSent($message))->toOthers();
        return response()->json(["message"=>"message created"]);
    }
}
