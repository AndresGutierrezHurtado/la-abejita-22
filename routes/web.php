<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ViewController;

Route::get('/', [ViewController::class, 'welcome']);
Route::get('/contact', [ViewController::class, 'contact']);

// Auth routes
Route::middleware('guest')->group(function() {
    Route::get('/login', [ViewController::class, 'login']);
    Route::get('/register', [ViewController::class, 'register']);
    Route::get('/forget', [ViewController::class, 'forget']);
    Route::get('/authcode', [ViewController::class, 'authcode']);
    Route::get('/reset', [ViewController::class, 'reset']);
});
