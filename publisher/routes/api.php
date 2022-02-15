<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CategoryController;

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



Route::middleware('bearer')->group(function () {
    Route::resource('tests', TestController::class, [
        'except' => ['create', 'edit']
    ]);
    Route::resource('categories', CategoryController::class, [
        'except' => ['create', 'edit']
    ]);
});

Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
