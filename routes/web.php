<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Public routes for signup and login
Route::get('/signup', [AuthController::class, 'showRegistration'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Public index routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

// Protected routes for other product and category actions
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('products', ProductController::class)->except(['index', 'show']);
    Route::resource('categories', CategoryController::class)->except(['index', 'show']);
});
