<?php

use App\Http\Controllers\Api\AuthUserController;
use App\Http\Controllers\Api\ChapterCommentController;
use App\Http\Controllers\Api\ChapterCommentVoteController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PublishChapterController;
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
        Route::get("user", "index")->middleware('auth:sanctum')->name("api.auth.user");
        Route::post("login", "login")->name("api.auth.login");
        Route::post("register", "register")->name("api.auth.register");
    });

Route::controller(UsersController::class)
    ->group(function () {
        Route::get("users", "index")->middleware('auth:sanctum')->name("api.users.list");
    });

Route::controller(UserImageController::class)
    ->group(function () {
        Route::get("users/{user:username}/image", "show")->name("api.users.image.show");
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

Route::controller(PublishChapterController::class)
    ->group(function () {
        Route::get("series/{series}/chapters/{chapter:number}/publish", "store")->name("api.chapter.publish");
    });

Route::controller(ChapterController::class)
    ->group(function () {
        Route::get("series/{series}/chapters", "index")->name("api.chapter.list");
        Route::post("series/{series}/chapters", "store")->name("api.chapter.store");
    });

Route::controller(SeriesImageController::class)
    ->group(function () {
        Route::get("series/{series}/poster", "show")->name("api.series.poster");
    });

Route::controller(PageController::class)
    ->group(function () {
        Route::get('/series/{series}/chapter/{chapter:number}/page/{page:number}', "show")->name("page.show");
    });

Route::controller(ChapterCommentController::class)
    ->group(function () {
        Route::get('/series/{series}/chapters/{chapter:number}/comments', "index")->name("api.chapter.comments.list");
        Route::post('/series/{series}/chapters/{chapter:number}/comments', "store")->name("api.chapter.comments.store");
    });

Route::controller(ChapterCommentVoteController::class)
    ->group(function () {
        Route::post('/chapters/comments/{comment}/vote/{value}', "store")->name("api.chapter.comments.vote.store");
        Route::delete('/chapters/comments/{comment}/vote', "destroy")->name("api.chapter.comments.vote.delete");
    });

Route::controller(PermissionController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('/users/{user:username}/permissions/{permission}', "store")->name("api.permissions.store");
        Route::delete('/users/{user:username}/permissions/{permission:name}', "destroy")->name("api.permissions.delete");
    });

Route::controller(GenreController::class)
    ->group(function () {
        Route::get('/genres', "index")->name("api.genres.list");
        Route::post('/genres', "store")->name("api.genres.store");
        Route::delete('/genres/{genre:name}', "destroy")->name("api.genres.delete");
    });
