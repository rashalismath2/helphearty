<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Message;

use App\Events\MessageSent;

class MessagesController extends Controller
{
    public function GetConversationWithConsultant(Request $request){
        //TODO - authenticated use messages
        //Middle ware to redirtect user if he hadnt have a consultatn
        $user=User::where("id",1)->with("consultant")->with("messages")->first();
        return response()->json($user);
    }
    public function SaveConversationWithConsultant(Request $request){
        //TODO - authenticated use messages
        //Middle ware to redirtect user if he hadnt have a consultatn
        $user=User::find(1);
        
        $message=new Message();
        $message->message=$request->message;
        $message->consultant_id=$user->consultant_id;
        $message->user_id=$user->id;
        $message->from="user";

        $message->save();
        broadcast(new MessageSent($message))->toOthers();
        return response()->json(["message"=>"message created"]);
    }
}
