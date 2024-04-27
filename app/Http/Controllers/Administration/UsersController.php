<?php

namespace App\Http\Controllers\Administration;

use App\Enums\UserPermission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    function index()
    {
        return Inertia::render('Administration/UsersPage/UsersPage', [
            "permissions" => UserPermission::values(),
        ]);
    }
}
