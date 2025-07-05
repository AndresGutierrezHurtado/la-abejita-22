<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ViewController;

Route::get('/', [ViewController::class, 'welcome']);
Route::get('/contact', [ViewController::class, 'contact']);
