<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\UserLoginController;

use App\Http\Controllers\API\User\MessagesController;
use App\Http\Controllers\API\User\StreamController;
use App\Http\Controllers\API\Consultant\MessageController as ConsMessageController;
use App\Http\Controllers\API\Consultant\StreamController as ConsStreamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::prefix('user')->group(function () {
    Route::get("/messages",[MessagesController::class,"GetConversationWithConsultant"]);
    Route::post("/messages",[MessagesController::class,"SaveConversationWithConsultant"]);
    Route::post("/send-offer",[StreamController::class,"sendOffer"]);
    Route::post("/call-cons",[StreamController::class,"callCons"]);

});

Route::prefix('consultant')->group(function () {
    Route::get("/messages",[ConsMessageController::class,"GetConversationWithUsers"]);
    Route::post("/messages",[ConsMessageController::class,"SaveConversationWithUser"]);
    Route::post("/send-answer",[ConsStreamController::class,"sendAnswer"]);
    Route::post("/answer-call",[ConsStreamController::class,"sendCallAcceptance"]);
});

Route::post("/getAcessToken",[UserLoginController::class,"getAcessToken"])->name("get_access_token");