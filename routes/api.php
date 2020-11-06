<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\User\MessagesController;
use App\Http\Controllers\API\Consultant\MessageController as ConsMessageController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function () {
    Route::get("/messages",[MessagesController::class,"GetConversationWithConsultant"]);
    Route::post("/messages",[MessagesController::class,"SaveConversationWithConsultant"]);
});

Route::prefix('consultant')->group(function () {
    Route::get("/messages",[ConsMessageController::class,"GetConversationWithUsers"]);
    Route::post("/messages",[ConsMessageController::class,"SaveConversationWithUser"]);
});