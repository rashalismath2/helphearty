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

Broadcast::channel('messageFrom-cons-toId-{userId}', function ($user,$userId) {
        //if the consultant was the one sent the messge we should check if he has the user hes sendoing
        return User::where("consultant_id",$userId)->where("id",$user->id)->first()->id===$user->id;
} ,['guards' => ['api']]);

Broadcast::channel('messageFrom-user-toId-{userId}', function ($user,$userId) {
        //if user was the one sent the message, we should check if we have the correct consultant 
        return $user->id===(int)$userId;        
 
} ,['guards' => ['consapi']]);

