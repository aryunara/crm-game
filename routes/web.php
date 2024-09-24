<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('menu', [UserController::class, 'index'])->name('menu');
Route::post('login', [UserController::class, 'postLogin'])->name('post.login');
Route::post('register', [UserController::class, 'postRegister'])->name('post.register');
Route::get('main', [MainController::class, 'index'])->name('main');
