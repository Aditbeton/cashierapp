<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
return view('welcome');
})->name('home')->middleware('auth');
Route::view('login', 'auth.login')->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::singleton('profile', ProfileController::class);
    Route::resource('user', UserController::class)->middleware('can:admin');
});
/* Route::get('/', function () {
    return view('auth.login');
}); */
/* dokslinya welcome */