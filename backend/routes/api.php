<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'register']);

Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index');
    Route::post('/store', 'store');
    Route::get('/posts/{id}', 'show')->where('id', '[0-9]+');
    Route::patch('/posts/{id}/update', 'update')->where('id', '[0-9]+');
    Route::delete('/posts/{id}/destroy', 'destroy')->where('id', '[0-9]+');
});
