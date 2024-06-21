<?php

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SchoolController::class, 'index'])->name('index');

Route::get('/colegios', [SchoolController::class, 'schools'])->name('colegios');

Route::get('/colegios/{id}', [SchoolController::class, 'school']);

Route::get('/tallas', function () {
    return view('sizes');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/{user_id?}', [ProfileController::class, 'show'])->name('profile');
});

require __DIR__.'/auth.php';
