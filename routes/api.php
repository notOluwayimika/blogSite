<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public Routes
// Route::resource('/posts', PostsController::class);
Route::post('/register',[RegisterController::class,'store']);
Route::get('/posts',[PostsController::class,'index']);
Route::get('/posts/{id}',[PostsController::class,'show']);
Route::get('/posts/search/{title}', [PostsController::class, 'search']); 
Route::post('/login',[SessionsController::class,'store']);
//Protexted Routes
Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::post('/posts',[PostsController::class,'store']);
    Route::put('/posts/{id}',[PostsController::class,'update']);
    Route::delete('/posts/{id}',[PostsController::class,'destroy']);
    Route::post('/logout',[SessionsController::class,'destroy']);
   
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
