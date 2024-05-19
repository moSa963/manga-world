<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChapterRequest;
use App\Http\Resources\SeriesResource;
use App\Models\Chapter;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Series $series)
    {
        Gate::authorize("create", Series::class);

        $series = new SeriesResource($series);
        $series->wrap(null);

        return Inertia::render('CreateChapter/CreateChapterPage', [
            "series" => $series,
            "number" => $series->chapters()->orderBy('number', "DESC")->first()?->number + 1 ?? 0,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChapterRequest $request, Series $series)
    {
        Gate::authorize("create", [Chapter::class, $series]);

        $chapter = $request->store($series);

        return to_route("chapter.show", [
            "series" => $series->id,
            "chapter" => $chapter->number,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Series $series, Chapter $chapter)
    {
        Gate::authorize("view", $chapter);

        return Inertia::render('Chapter/ShowChapterPage', [
            "series" => $series,
            "chapter" => $chapter->load("pages"),
            "next" => $chapter->next()?->number,
            "prev" => $chapter->prev()?->number,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chapter $chapter)
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
