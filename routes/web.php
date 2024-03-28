<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\IndexController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::redirect('/', '/login');
    Route::get('/login', [AuthController::class, 'loginView']);
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('dashboard');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
