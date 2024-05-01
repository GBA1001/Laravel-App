<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthCheck;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', [AuthCheck::class,'index']);
Route::get('/login', [AuthCheck::class,'index']);
Route::post('/login/submit', [AuthCheck::class,'login']);
Route::get('/register', [AuthCheck::class,'register']);
Route::post('/register/submit', [AuthCheck::class,'registerUser']);
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::delete('/admin/post/{postId}', [AdminController::class, 'deletePost'])->name('admin.deletePost');
Route::delete('/admin/comment/{commentId}', [AdminController::class, 'deleteComment'])->name('admin.deleteComment');

Route::middleware(['auth'])->group(function () { 

Route::get('/post/list', [PostController::class,'index'])->name('post.list');
Route::get('/post/{id}', [PostController::class,'detail']);
Route::delete('/post/delete/{id}', [PostController::class, 'delete']);
Route::get('/create', [PostController::class,'create']);
Route::post('/post/save', [PostController::class, 'save']);
Route::get('/edit/{id}', [PostController::class,'edit']);
Route::put('/post/update/{id}', [PostController::class, 'update'])->name('post.update');
Route::post('/comment/add/{id}', [CommentController::class, 'add'])->name('comment.add');
Route::put('/comment/edit/{comment}', [CommentController::class, 'edit'])->name('comment.edit');
Route::post('/comment/{comment}/{postId}/reply', [CommentController::class, 'reply'])->name('comment.reply');

Route::get('/profile/{id}', [UserController::class,'profile']);


});


