<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::get('ping', function(){
    $mailchimp = new \MailchimpMarketing\ApiClient();
    $mailchimp->setConfig([
        'apikey'=>config('services.mailchimp.key'),
        'server'=>'us21'
    ]);
    // $response = $mailchimp->ping->get(); 
    // dd($response);
});
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::post('/posts/{post}/comments',[CommentController::class, 'store'])->middleware('auth');

Route::get('/register',[RegisterController::class,'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');
Route::get('/login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');

//admin controllers
Route::get('admin/post/create', [AdminPostController::class, 'create'])->middleware('admin');
Route::post('/admin/post', [AdminPostController::class, 'store'])->middleware('admin');
Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('admin');
Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('admin');
Route::patch('admin/post/{post}', [AdminPostController::class, 'update'])->middleware('admin');
Route::delete('admin/post/{post}', [AdminPostController::class, 'destroy'])->middleware('admin');



