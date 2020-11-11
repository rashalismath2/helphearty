<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Events\OfferSend;

class StreamController extends Controller
{
    public function __construct(){
        $this->middleware("auth:api");
    }

    public function sendOffer(Request $request){

        broadcast(new OfferSend($request->offer,auth()->user(),"user"))->toOthers();
        return response()->json(["message"=>"Offer sent"]);
    }
}
