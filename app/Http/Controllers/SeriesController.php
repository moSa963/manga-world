<?php

namespace App\Http\Controllers;

use App\Enums\SeriesStatus;
use App\Enums\SeriesTypes;
use App\Http\Requests\StoreSeriesRequest;
use App\Http\Resources\SeriesResource;
use App\Models\Series;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('ListPage/ListPage', [
            "canCreateSeries" => Gate::check("create", Series::class),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize("create", Series::class);

        return Inertia::render('CreateSeries/CreateSeriesPage', [
            "status" => SeriesStatus::values(),
            "types" => SeriesTypes::values(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeriesRequest $request)
    {
        Gate::authorize("create", Series::class);

        $series = $request->store();

        return to_route("series.show", [
            "series" => $series->id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Series $series)
    {
        Gate::authorize("view", $series);

        $series = new SeriesResource($series);
        $series->wrap(null);

        return Inertia::render('Series/ShowSeriesPage', [
            "series" => $series,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Series $series)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Series $series)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Series $series)
    {
        //
    }
}
