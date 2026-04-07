<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//trang chu
Route::get('/', [ProductController::class, 'index'])->name('client.product.index');

//chi tiet san pham
Route::get('/product/{id}', [ProductController::class, 'showDetail'])->name('client.product.detail');

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/product/{id}', [ProductController::class, 'showDetail'])->name('client.product.detail');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});