<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\UserRegisterController;


Route::get('/', function () {
    return view('welcome');
})->name("welcome");
 

//User routes
Route::get('/home', function () {
    return view('User/home');
})->middleware(["auth"])->name("home");



// Authentication for users
Route::get('/login',[ UserLoginController::class,"showLogin"])->name("login-view");
Route::get('/register', [UserRegisterController::class,"showRegister"])->name("register-view");

Route::post('/login',[UserLoginController::class,"login"])->name("login");
Route::post('/register',[UserRegisterController::class,"register"])->name("register");

Route::post('/logout',[UserLoginController::class,"logout"])->name("logout");


//cons routes

Route::get('/dashboard', function () {
    return view('Consultant/home');
})->middleware(["auth:cons"])->name("dashboard");


//Authentications for consultants
Route::prefix('consultant')->group(function () {
    Route::get('/login',[ UserLoginController::class,"showLoginForConsultant"])->name("login-view-cons");
    Route::get('/register', [UserRegisterController::class,"showRegisterForConsultant"])->name("register-view-cons");
    
    Route::post('/login',[UserLoginController::class,"loginConsultant"])->name("login-cons");
    Route::post('/register',[UserRegisterController::class,"registerConsultant"])->name("register-cons");
   
    Route::post('/logout',[UserLoginController::class,"logout"])->name("logout-cons");
    
});