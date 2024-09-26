<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::post('/posts/{post}/toggle-like', function(){
//     return "dd('here')";
// })->name('toggle-like');

// Route::post('/test', function(){
//     return "dd('here dd')";
// });

Route::get('/', fn() => redirect('/landingPage'));
Route::get('/landingPage', [PostController::class, 'landingPage']);
Route::get('/allPosts', [PostController::class, 'allPost']);

Route::get('/login', fn() => view('Pages.login'))->name('login')->middleware('guest');
Route::get('/register', fn() => view('Pages.register'))->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/myAccount', [UserController::class, 'myAccount'])->middleware('auth');
Route::put('/myAccount/{user}', [UserController::class, 'eMyAccount'])->middleware('auth');
Route::delete('/myAccount/{user}', [UserController::class, 'dMyAccount'])->middleware('auth');

Route::get('/users', [UserController::class, 'index'])->middleware('admin');
Route::get('/users/edit/{user}', [UserController::class, 'edit'])->middleware('admin');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('admin');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('admin');

Route::get('/posts', [PostController::class, 'index'])->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/myPosts', [PostController::class, 'myPosts'])->name('myPosts.index')->middleware('auth');
Route::get('/myPosts/add', [PostController::class, 'create'])->middleware('auth');
Route::post('/myPosts', [PostController::class, 'store'])->middleware('auth');
Route::get('/myPosts/edit/{post}', [PostController::class, 'edit'])->middleware('auth');
Route::put('/myPosts/{post}', [PostController::class, 'update'])->middleware('auth');
Route::delete('/myPosts/{post}', [PostController::class, 'destroy'])->middleware('auth');
Route::get('/postsBy/{user}', [PostController::class, 'postsBy']);

// Route::post('/posts/{post}/toggle-like', [PostController::class, 'toggleLike'])->name('toggle-like');
Route::post('/post/toggle-like', [LikeController::class, 'toggleLike'])->middleware('auth');

Route::resource('/comments', CommentController::class)->middleware('auth');

// Route::resource('/like',LikeController::class);
