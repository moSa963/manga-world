<?php

use App\Http\Controllers\Api\SeriesController;
use App\Http\Controllers\Api\SeriesImageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(SeriesController::class)
    ->group(function () {
        Route::get("series", "index")->name("api.series.list");
    });

Route::controller(SeriesImageController::class)
    ->group(function () {
        Route::get("series/{series}/poster", "show")->name("api.series.poster");
    });
