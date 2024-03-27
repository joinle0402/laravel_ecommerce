<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\IndexController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard');
Route::get('/login', [AuthController::class, 'loginView']);
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/admin/dashboard', [IndexController::class, 'dashboard']);
