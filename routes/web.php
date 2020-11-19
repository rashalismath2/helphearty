<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\User\StreamController;
use App\Http\Controllers\Consultant\StreamController as ConsultantStreamController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\User\QuestionsController;

Route::get('/',[WelcomeController::class,"index"])->name("welcome");
 

///////User routes
Route::get('/home', function () {
    return view('User/home');
})->middleware(["auth","SelectCategory"])->name("home");

//viedo streaming
Route::get("/user/stream",[StreamController::class,"index"])->name("user-stream-view");

//questions
Route::get("/user/questions/category",[QuestionsController::class,"index"])->middleware(["web","CheckStarterCompletion"])->name("questions-category");
Route::post("/user/questions/category",[QuestionsController::class,"saveCategory"])->name("save-category");

Route::get("/user/questions/counsellors",[QuestionsController::class,"counsellors"])->middleware(["web","SelectCategory"])->name("questions-counsellors");
Route::post("/user/questions/counsellors",[QuestionsController::class,"saveCounsellor"])->name("save-counsellor");

Route::get("/user/questions/answers",[QuestionsController::class,"answers"])->middleware(["web","SelectCategory","CheckCounsellor","CheckStarterCompletion"])->name("questions-answers");
Route::post("/user/questions/answers",[QuestionsController::class,"saveAnswers"])->name("save-answers");


// Authentication for users
Route::post('/login',[UserLoginController::class,"login"])->name("login");
Route::post('/register',[UserRegisterController::class,"register"])->name("register");
Route::post('/logout',[UserLoginController::class,"logout"])->name("logout");




///////cons routes

Route::get('/dashboard', function () {
    return view('Consultant/home');
})->middleware(["auth:cons"])->name("dashboard");

Route::get("/consultant/stream",[ConsultantStreamController::class,"index"])->name("consultant-stream-view");



//Authentications for consultants
Route::prefix('consultant')->group(function () {
    Route::get('/login',[ UserLoginController::class,"showLoginForConsultant"])->name("login-view-cons");
    Route::get('/register', [UserRegisterController::class,"showRegisterForConsultant"])->name("register-view-cons");
    
    Route::post('/login',[UserLoginController::class,"loginConsultant"])->name("login-cons");
    Route::post('/register',[UserRegisterController::class,"registerConsultant"])->name("register-cons");
   
    Route::post('/logout',[UserLoginController::class,"logout"])->name("logout-cons");
    
});