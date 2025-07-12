<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Guest view routes
Route::get('/', [ViewController::class, 'welcome']);
Route::get('/contact', [ViewController::class, 'contact']);
Route::get('/schools', [ViewController::class, 'schools']);
Route::get('/products', [ViewController::class, 'products']);
Route::get('/products/{id}', [ViewController::class, 'product']);

// Guest view routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [ViewController::class, 'login'])->name('login');
    Route::get('/register', [ViewController::class, 'register']);
    Route::get('/forget', [ViewController::class, 'forget']);
    Route::get('/authcode', [ViewController::class, 'authcode']);
    Route::get('/reset', [ViewController::class, 'reset']);
});

// Auth view routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ViewController::class, 'profile']);
    Route::get('/cart', [ViewController::class, 'cart']);
    Route::get('/orders', [ViewController::class, 'orders']);
    Route::get('/admin/users', [ViewController::class, 'userManagement']);
    Route::get('/admin/products', [ViewController::class, 'productManagement']);
    Route::get('/admin/schools', [ViewController::class, 'schoolManagement']);
    Route::get('/admin/orders', [ViewController::class, 'orderManagement']);
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/users', [AuthController::class, 'register']);
    Route::post('/forget', [AuthController::class, 'forget']);
    Route::post('/forget', [AuthController::class, 'change']);
});

// Auth routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/users/{id}', [UserController::class, 'update']);
});