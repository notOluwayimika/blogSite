<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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
// Auth
Route::post('/register',[RegisterController::class,'store']);
Route::post('/login',[SessionsController::class,'store']);

Route::get('/login', function(){
    return 'Please login';
})->name('login');

//posts
Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{id}',[PostController::class,'show']);

//comments
Route::get('/comment',[CommentController::class,'index']);
Route::get('/comment/{id}',[CommentController::class,'show']);

//categories
Route::get('/category',[CategoryController::class,'index']);
Route::get('/category/{id}',[CategoryController::class,'show']);

//search
Route::get('/posts/search/{title}', [PostController::class, 'search']); 



//Protected Routes
Route::group(['middleware'=>['auth:sanctum']], function () {
    //logout
    Route::post('/logout',[SessionsController::class,'destroy']);
   
    //posts
    Route::post('/posts',[PostController::class,'store'])->middleware('role:admin|writer');
    Route::put('/posts/{id}',[PostController::class,'update'])->middleware('role:admin|writer');
    Route::delete('/posts/{id}',[PostController::class,'destroy'])->middleware('role:admin|writer');

    //category
    Route::post('/category',[CategoryController::class,'store'])->middleware('role:admin|writer');
    Route::put('/category/{id}',[CategoryController::class,'update'])->middleware('role:admin|writer');
    Route::delete('/category/{id}',[CategoryController::class,'destroy'])->middleware('role:admin|writer');

    //comments
    Route::post('/comments/{post_id}',[CommentController::class,'store']);
    Route::put('/comments/{id}',[CommentController::class,'update']);
    Route::delete('/comments/{id}',[CommentController::class,'destroy']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
