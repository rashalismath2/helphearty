<?php

use Illuminate\Support\Facades\Broadcast;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('messageFrom-{user_type}-toId-{userId}', function ($user, $user_type,$user_id) {
    if($user_type=="user"){
        //if user was the one sent the message, we should check if we have the correct consultant 
        return User::where("id",$user_id)->first()->consultant===$user->id;        
    }
    else if($user_type=="cons"){
        //if the consultant was the one sent the messge we should check if he has the user hes sendoing
        return User::where("consultant_id",$user_id)->first()->id===$user->id;
    }
});

