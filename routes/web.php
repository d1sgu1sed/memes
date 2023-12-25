<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MainPageController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth']], function (){
  Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.index');
  Route::get('/posts/create', [PostController::class, 'createForm'])->name('posts.createForm');
  Route::post('/posts/create', [PostController::class, 'create'])->name('posts.create');
  Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
  Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('comments.store');
  Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
  Route::get('/user/{user}/get-posts', [UserController::class, 'getPosts'])->name('user.getPosts');
  Route::get('/user/{user}/get-comments', [UserController::class, 'getComments'])->name('user.getComments');
  Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
  Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
  Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [App\Http\Controllers\MainPageController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
