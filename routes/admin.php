<?php

use App\Http\Controllers\Administration\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix("admin")
    ->middleware('admin')
    ->group(function () {
        Route::controller(UsersController::class)
            ->group(function () {
                Route::get('users', "index")->name("admin.users.list");
            });
    });
