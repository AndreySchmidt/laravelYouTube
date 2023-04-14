<?php

use Illuminate\Support\Facades\Route;

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

// Route::post('/register', dd(request()));

Route::post('/register', [App\Http\Controllers\Auth\RegisterUserController::class, 'store'])->middleware('guest');
Route::delete('/delete-account', [App\Http\Controllers\Auth\RegisterUserController::class, 'destroy'])->middleware('auth');
Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::delete('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->middleware('auth');