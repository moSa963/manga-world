<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChapterCommentRequest;
use App\Http\Resources\ChapterCommentResource;
use App\Http\Resources\ChapterResource;
use App\Models\Chapter;
use App\Models\ChapterComment;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ChapterCommentController extends Controller
{
    public function index(Request $request, Series $series, Chapter $chapter)
    {
        Gate::authorize("view", $series);

        $comments = $chapter->comments()->simplePaginate()->withQueryString();;

        return ChapterCommentResource::collection($comments);
    }

    public function store(StoreChapterCommentRequest $request, Series $series, Chapter $chapter)
    {
        Gate::authorize("view", $series);

        $comment = $request->store($chapter);

        return new ChapterCommentResource($comment);
    }
}
