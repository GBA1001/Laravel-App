<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthCheck;
use App\Http\Controllers\CommentController;

Route::get('/', [AuthCheck::class,'index']);
Route::get('/login', [AuthCheck::class,'index']);
Route::post('/login/submit', [AuthCheck::class,'login']);
Route::get('/register', [AuthCheck::class,'register']);
Route::post('/register/submit', [AuthCheck::class,'registerUser']);

Route::middleware(['auth'])->group(function () { 
Route::get('/post/list', [PostController::class,'index'])->name('post.list');
Route::get('/post/{id}', [PostController::class,'detail']);
Route::delete('/post/delete/{id}', [PostController::class, 'delete']);
Route::get('/create', [PostController::class,'create']);
Route::post('/post/save', [PostController::class, 'save']);
Route::get('/edit/{id}', [PostController::class,'edit']);
Route::put('/post/update/{id}', [PostController::class, 'update'])->name('post.update');
Route::post('/comment/add/{id}', [CommentController::class, 'add'])->name('comment.add');

});

