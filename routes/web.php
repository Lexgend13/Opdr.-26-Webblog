<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');
Route::get('/home',                    [ArticleController::class,'index'])->name('articles.index');
Route::get('/create-article',          [ArticleController::class,'create'])->name('articles.create');
Route::get('/article/{article}',       [ArticleController::class,'show'])->name('articles.show');
Route::get('/articles/{article}/edit', [ArticleController::class,'edit'])->name('articles.edit');
Route::put('/articles/{article}',      [ArticleController::class,'update'])->name('articles.update');
Route::post('/articles',               [ArticleController::class,'store'])->name('articles.store');
Route::delete('/articles/{article}',   [ArticleController::class, 'destroy'])->name('articles.destroy');

// Route::resource('articles', ArticleController::class);

Route::get('/create-category',    [CategoryController::class,'create'])->name('categories.create');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::post('/categories',        [CategoryController::class,'store'])->name('categories.store');

Route::get('/register',    [UserController::class, 'create'])->name('users.create')->middleware('guest');
Route::post('/register',   [UserController::class, 'store'])->name('users.store')->middleware('guest');
Route::get('/login',       [UserController::class,'show'])->name('users.show')->middleware('guest');      //show login page
Route::post('/login',      [UserController::class,'update'])->name('users.update')->middleware('guest');  //log user in
Route::post('/logout',     [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');
Route::get('/my-articles', [UserController::class, 'index'])->name('users.index')->middleware(('auth'));
Route::get('/buy-Premium', [UserController::class, 'premium'])->name('users.premium')->middleware(('auth'));
Route::put('/buy-Premium', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');

Route::post('/store-comment',                           [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::put('/update-comment/{comment}',                      [CommentController::class, 'update'])->name('comments.update')->middleware('auth');
Route::delete('/delete-comment/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

