<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeriesController;
use App\Models\Chapter;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('IndexPage/IndexPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name("index");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(SeriesController::class)
    ->group(function () {
        Route::get('/series', "index")->name("series.list");
        Route::get('/series/new', "create")->name("series.create");
        Route::post('/series/new', "store")->name("series.store");
        Route::get('/series/{series}', "show")->name("series.show");
    });

Route::controller(ChapterController::class)
    ->group(function () {
        Route::get('/series/{series}/chapter/new', "create")->name("chapter.create");
        Route::post('/series/{series}/chapter/new', "store")->name("chapter.store");
        Route::get('/series/{series}/chapter/{chapter:number}', "show")->name("chapter.show");
    });


require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
