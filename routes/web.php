<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
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
Route::get('/post/datatable', [PostController::class, 'datatable'])->name('posts.list');

Route::get('/register',[RegisterController::class,'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');
Route::get('/login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');


//admin controllers
Route::get('admin/post/create', [AdminPostController::class, 'create'])->middleware('role:admin|writer');
Route::post('/admin/post', [AdminPostController::class, 'store'])->middleware('role:admin|writer');
Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('role:admin|writer');
Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('role:admin|writer');
Route::patch('admin/post/{post}', [AdminPostController::class, 'update'])->middleware('role:admin|writer');
Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('role:admin|writer');

//comments
Route::delete('/comments/{id}',[CommentController::class,'destroy'])->middleware('auth');
Route::put('/comments/{id}',[CommentController::class,'update'])->middleware('auth');

//category
Route::get('admin/categories', [CategoryController::class, 'index'])->middleware('role:admin');
Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->middleware('role:admin');
Route::delete('admin/categories/{id}',[CategoryController::class,'destroy'])->middleware('role:admin');
Route::get('/category/datatable', [CategoryController::class, 'datatable'])->name('category.list');

//users
Route::get('admin/users',[UserController::class, 'index'])->middleware('role:admin');
Route::get('admin/users/{user}/edit',[UserController::class, 'edit'])->middleware('role:admin');
Route::get('/user/datatable', [UserController::class, 'datatable'])->name('user.list');
Route::delete('admin/users/{id}',[UserController::class,'destroy'])->middleware('role:admin');
Route::put('admin/users/{id}',[UserController::class,'update'])->middleware('role:admin');
Route::get('users/{id}',[UserController::class,'show'])->middleware('owner');
Route::post('admin/users/{user}/role',[UserController::class,'role'])->middleware('role:admin');
//edit user
Route::put('/users/{id}',[UserController::class,'update']);
