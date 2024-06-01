<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Genre::all()->pluck('name');
    }

    public function store(StoreGenreRequest $request)
    {
        Gate::allowIf($request->user()->isAdmin());

        $request->store();
    }

    public function destroy(Request $request, Genre $genre)
    {
        Gate::allowIf($request->user()->isAdmin());

        $genre->delete();
    }
}
