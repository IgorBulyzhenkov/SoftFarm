<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('/v1')->group(function () {
    Route::prefix('/products')->group(function () {
        Route::get('/',         [ProductsController::class, 'index']);
        Route::get('/{id}',     [ProductsController::class, 'show']);

        Route::post('/',        [ProductsController::class, 'store']);
        Route::put('/{id}',     [ProductsController::class, 'update']);

        Route::delete('/{id}',  [ProductsController::class, 'destroy']);
    });
});
