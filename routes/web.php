<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SchoolController::class, 'index'])->name('index'); // Read

Route::get('/colegios', [SchoolController::class, 'schools'])->name('colegios'); // Read

Route::get('/colegios/{id}', [SchoolController::class, 'school']); // Read

Route::get('/producto/{id}', [ProductController::class, 'public']); // Read

Route::middleware('auth')->group(function () {
    // user profile
    Route::get('/profile/user/{user_id?}', [ProfileController::class, 'show'])->name('profile'); // Read
    Route::put('/profile/user/{user_id}', [ProfileController::class, 'update'])->name('profile.update'); // Update
    Route::put('/profile/user/updateImage/{user_id}', [ProfileController::class, 'update_img']); // Update image
    Route::put('/profile/user/deleteImage/{user_id}', [ProfileController::class, 'delete_img']); // Update image
    Route::delete('/profile/user/destroy/{user_id}', [ProfileController::class, 'destroy']); // delete

    // email
    Route::post('/send-email', [MailController::class, 'sendMail']);

    // cart
    Route::get('/carrito', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::put('/cart/update', [CartController::class, 'update']);
    Route::delete('/cart/delete/{product_id}', [CartController::class, 'delete']);
    Route::get('/cart/clear', [CartController::class, 'clear']);

    //payment
    Route::get('/pay', [PaymentController::class, 'form']);
    Route::post('/pay/store-session-data', [PaymentController::class, 'storeSessionData']);
    Route::get('/pay/callback', [PaymentController::class, 'callback']);
    Route::get('/order/{order_id}', [ProfileController::class, 'order']);
    Route::get('/receipt/{order_id}', [ProfileController::class, 'receipt']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboards
    Route::get('/dashboard/users', [AdminController::class, 'users'])->name('dashboard.users'); // Read
    Route::get('/dashboard/products', [AdminController::class, 'products'])->name('dashboard.products'); // Read
    Route::get('/dashboard/schools', [AdminController::class, 'schools'])->name('dashboard.schools'); // Read

    // Colegio
    Route::get('/profile/school/{school_id}', [SchoolController::class, 'profile']); // Read
    Route::put('/profile/school/{school_id}', [SchoolController::class, 'update']); // Update 
    Route::delete('/school/destroy/{school_id}', [SchoolController::class, 'destroy']); // Delete
    Route::post('/school/store', [SchoolController::class, 'store']); // Create

    //Producto
    Route::get('/profile/product/{product_id}', [ProductController::class, 'profile']); // Read
    Route::put('/profile/product/{product_id}', [ProductController::class, 'update']); // Update 
    Route::delete('/product/destroy/{product_id}', [ProductController::class, 'destroy']); // Delete
    Route::delete('/product/media/destroy/{media_id}', [ProductController::class, 'media_destroy']); // Delete
    Route::post('/product/store', [ProductController::class, 'store']); // Create
});

require __DIR__.'/auth.php';
