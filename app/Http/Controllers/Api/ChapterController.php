<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Resources\ChapterResource;
use App\Models\Chapter;
use App\Models\Series;
use App\Services\ChapterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Series $series)
    {
        Gate::authorize("view", $series);

        $q = $series->chapters()
            ->orderBy("number", $request->query("order", 'new') == "new" ? 'desc' : 'asc');

        ChapterService::filterQuery(
            $q,
            $request->query('filter', ''),
        );
        $count = $request->query('count', 5);
        $data = $q->simplePaginate($count <= 15 && $count >= 1 ? $count : 5)->withQueryString();

        return ChapterResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChapterRequest $request, Series $series)
    {
        Gate::authorize("create", [Chapter::class, $series]);

        $chapter = $request->store($series);

        return new ChapterResource($chapter);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chapter $chapter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {
        //
    }
}
