<?php

use App\Http\Controllers\API\ArtistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SongController;
use App\Http\Controllers\API\AlbumController;
use App\Http\Controllers\API\VoteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/token/create', [AuthController::class, 'createToken']);

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/register', 'registerUser');
    Route::post('/login', 'loginUser');
    Route::post('/logout', 'logoutUser')->middleware('auth:sanctum');
});

Route::controller(SongController::class)->prefix('song')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'info');
});

Route::controller(ArtistController::class)->prefix('artist')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'get');
    Route::get('/{id}/song', 'getSong');
    Route::get('/{id}/album', 'getAlbum');
});

Route::controller(AlbumController::class)->prefix('album')->group(function () {
    Route::get('/', 'index');
    Route::get('/search', 'search');
    Route::get('/{id}', 'get');
    Route::get('/{id}/song', 'getSong');
    Route::get('/{id}/delete', 'delete')->middleware('auth:sanctum');
});

Route::controller(VoteController::class)->prefix('vote')->group(function () {
    Route::post('/', 'vote')->middleware('auth:sanctum');
});
