<?php

use App\Http\Controllers\CryptoController;
use Illuminate\Support\Facades\Route;

// Main routes for crypto app
Route::get('/', [CryptoController::class, 'index'])->name('home');
Route::get('/{crypto}', [CryptoController::class, 'show'])->name('home.show');
