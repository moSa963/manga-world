<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GenreController extends Controller
{
    function index()
    {
        return Inertia::render('Administration/GenrePage/GenrePage');
    }
}
