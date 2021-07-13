<?php

use App\Http\Controllers\CryptoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main routes for crypto app
Route::get('/', [CryptoController::class, 'index'])->name('home');
Route::get('/{crypto}', [CryptoController::class, 'show'])->name('home.show');

 


