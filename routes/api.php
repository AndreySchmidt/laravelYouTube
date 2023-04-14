<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/categories', ['CategoryController@index']);
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'show']);

Route::get('/channels', [App\Http\Controllers\ChannelController::class, 'index']);
Route::get('/channels/{channel}', [App\Http\Controllers\ChannelController::class, 'show']);

Route::get('/playlists', [App\Http\Controllers\PlaylistController::class, 'index']);
Route::get('/playlists/{playlist}', [App\Http\Controllers\PlaylistController::class, 'show']);

Route::get('/videos', [App\Http\Controllers\VideoController::class, 'index']);
Route::get('/videos/{video}', [App\Http\Controllers\VideoController::class, 'show']);

Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show']);

Route::get('/comments', [App\Http\Controllers\CommentController::class, 'index']);
Route::get('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'show']);


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/profile', [App\Http\Controllers\Auth\ProfileController::class, 'show']);
    Route::put('/profile', [App\Http\Controllers\Auth\ProfileController::class, 'update']);

    // Route::post('/comments', [App\Http\Controllers\CommentController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/comments', [App\Http\Controllers\CommentController::class, 'store']);
    Route::put('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'update'])->middleware('ability:comment:update');
    // Route::put('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'update'])->middleware('ability:comment:update,comment:delete');
    // если одно разрешение для токена ability (или)
    Route::delete('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->middleware('ability:comment:delete');
    // если нужен набор разрешений для токена abilities (и)
    // Route::delete('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->middleware('abilities:comment:delete,comment:update');

    Route::delete('/personal-access-tokens', [App\Http\Controllers\PersonalAccessTokenController::class, 'destroy']);
});


Route::post('/personal-access-tokens', [App\Http\Controllers\PersonalAccessTokenController::class, 'store']);
