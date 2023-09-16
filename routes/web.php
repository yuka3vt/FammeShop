<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('', [BaseController::class, 'index']);
    Route::get('/tentang', [BaseController::class, 'tentang']);
    Route::get('/hubungi', [BaseController::class, 'hubungi']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'Autentikasi']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'RegisterStore']);
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/{blog:slug}', [BlogController::class, 'show']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
});
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/shop', [UserController::class, 'index']);
    Route::get('/shop/{produk:slug}', [ProdukController::class, 'show']);
});
    Route::post('/logout',[AuthController::class,'logout']);