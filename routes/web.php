<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/datasource', [App\Http\Controllers\InventoryController::class, 'index'])->name('datasource');
    Route::get('/search', [App\Http\Controllers\InventoryController::class, 'search'])->name('search');
});

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
