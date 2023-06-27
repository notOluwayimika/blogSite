<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('posts');

Route::get('/posts/{post}', [PostController::class, 'show']);

Route::get('/register',[RegisterController::class,'create'])->middleware('guest');

Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('/login', [SessionsController::class, 'create'])->middleware('guest');