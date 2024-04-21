<?php

use App\Http\Controllers\Api\AuthUserController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PublishSeriesController;
use App\Http\Controllers\Api\SeriesController;
use App\Http\Controllers\Api\SeriesImageController;
use App\Http\Controllers\Api\SeriesSearchController;
use App\Http\Controllers\Api\UserImageController;
use App\Http\Controllers\Api\UsersController;
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

Route::controller(AuthUserController::class)
    ->group(function () {
        Route::get("user", "index")->middleware('auth:sanctum')->name("api.series.list");
        Route::post("login", "login")->name("api.auth.login");
        Route::post("register", "register")->name("api.auth.register");
    });

Route::controller(UsersController::class)
    ->group(function () {
        Route::get("users", "index")->middleware('auth:sanctum')->name("api.users.list");
    });

Route::controller(UserImageController::class)
    ->group(function () {
        Route::get("users/{user:username}/image", "show")->middleware('auth:sanctum')->name("api.users.image.show");
    });

Route::controller(SeriesController::class)
    ->group(function () {
        Route::get("series", "index")->name("api.series.list");
        Route::post("series", "store")->middleware('auth:sanctum')->name("api.series.store");
    });

Route::controller(PublishSeriesController::class)
    ->group(function () {
        Route::get("series/{series}/publish", "store")->name("api.series.publish");
    });

Route::controller(ChapterController::class)
    ->group(function () {
        Route::get("series/{series}/chapters", "index")->name("api.chapter.list");
    });

Route::controller(SeriesImageController::class)
    ->group(function () {
        Route::get("series/{series}/poster", "show")->name("api.series.poster");
    });

Route::controller(PageController::class)
    ->group(function () {
        Route::get('/series/{series}/chapter/{chapter:number}/page/{page:number}', "show")->name("page.show");
    });

Route::controller(PermissionController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('/users/{user:username}/permissions/{permission}', "store")->name("api.permissions.store");
        Route::delete('/users/{user:username}/permissions/{permission:name}', "destroy")->name("api.permissions.delete");
    });
