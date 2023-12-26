<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ModerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth']], function (){
  Route::get('/{user}', [DashboardController::class, 'dashboard'])->name('admin.index');
  Route::post('/posts/create', [PostController::class, 'create'])->name('posts.create');
  Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('comments.store');
  Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'ismoderator'])->group(function () {
    Route::get('/moderate/comments', [ModerController::class, 'comments'])->name('moderate.comments');
    Route::post('/moderate/comments/{comment}/approve', [ModerController::class, 'approveComment'])->name('moderate.approveComment');
    Route::post('/moderate/comments/{comment}/reject', [ModerController::class, 'rejectComment'])->name('moderate.rejectComment');
});

Route::middleware('auth')->group(function () {
  Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
  Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
  Route::delete('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('posts.unlike');
  Route::get('/posts/likes', [PostController::class, 'likePost'])->name('like');
  Route::get('/dashboard', [App\Http\Controllers\MainPageController::class, 'index'])->name('dashboard');
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
