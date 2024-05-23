<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChapterResource;
use App\Models\Chapter;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PublishChapterController extends Controller
{
    public function store(Request $request, Series $series, Chapter $chapter)
    {
        Gate::authorize("publish", $chapter);

        $chapter->update([
            "published" => true,
        ]);

        return new ChapterResource($chapter);
    }
}
