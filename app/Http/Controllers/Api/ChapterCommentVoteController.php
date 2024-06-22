<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\ChapterComment;
use App\Models\ChapterCommentVote;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ChapterCommentVoteController extends Controller
{
    public function store(Request $request, ChapterComment $comment, string $vote)
    {
        Gate::authorize("vote", Chapter::class);

        $comment->vote($request->user(), $vote == "down" ? -1 : 1);

        return response()->noContent();
    }

    public function destroy(Request $request, ChapterComment $comment)
    {

        Gate::authorize("vote", Chapter::class);

        $comment->vote($request->user(), 0);

        return response()->noContent();
    }
}
