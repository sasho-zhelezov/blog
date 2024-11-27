<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('', fn() => to_route('post.index'));

Route::resource('post', PostController::class)->only(['index', 'show']);

Route::resource('post.comment', CommentController::class)->only('store', 'destroy', 'update', 'edit')->middleware('auth');

Route::get('/login', [AuthController::class, 'create'])->name('login');

Route::post('/login', [AuthController::class, 'store']);

Route::delete('logout', fn() => to_route('login'))->name('logout');

Route::delete('login', [AuthController::class, 'destroy'])->name('login.destroy');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::fallback(function () {
    return redirect('/')->with('error', 'The page you are looking for does not exist.');
});
