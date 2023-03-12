<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\CategoryController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/categories', ['CategoryController@index']);
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'show']);

Route::get('/channels', [App\Http\Controllers\ChannelController::class, 'index']);
Route::get('/channels/{channel}', [App\Http\Controllers\ChannelController::class, 'show']);
