<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeriesRequest;
use App\Http\Resources\SeriesResource;
use App\Models\Series;
use App\Services\SeriesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize("viewAny", Series::class);

        $q = Series::for($request->user());

        SeriesService::filterQuery(
            $q,
            $request->query('key', ''),
            $request->query('filter', ''),
            $request->query('sort', 'new'),
            $request->query('genre', ''),
        );

        $count = $request->query('count', 15);

        $data = $q->simplePaginate($count <= 15 && $count >= 1 ? $count : 15)->withQueryString();

        return SeriesResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeriesRequest $request)
    {
        Gate::authorize("create", Series::class);

        $series = $request->store();

        return new SeriesResource($series);
    }

    /**
     * Display the specified resource.
     */
    public function show(Series $series)
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
