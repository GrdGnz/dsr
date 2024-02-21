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

// Route for handling 404, 500, and 403 errors
Route::fallback(function () {
    return view('error');
})->name('error');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/inventory', [App\Http\Controllers\InventoryController::class, 'index'])->name('inventory.index');
    Route::post('/inventory/fetch-data', [App\Http\Controllers\InventoryController::class, 'fetchData'])->name('inventory.fetchData');
});

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
