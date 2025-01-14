<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('loginPage');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('saveLogin');

Route::middleware(['admin'])->group(function () {
    Route::resource('store', StoreController::class);
});

Route::middleware('user')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/user-location', [UserController::class, 'index'])->name('user.location');
});
