<?php

use App\Models\Chapter;
use App\Models\ChapterComment;
use App\Models\ChapterCommentVote;
use App\Models\Series;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('User can vote on comment', function () {
    $comment = ChapterComment::factory()->createOne();

    Sanctum::actingAs(User::factory()->createOne());

    $response = $this->post(route('api.chapter.comments.vote.store', [
        "comment" => $comment->id,
        "value" => 1
    ]));

    $response->assertSuccessful();
    $this->assertTrue($comment->votes()->count() == 1);
});

test('User can remove their vote on comment', function () {
    $comment = ChapterComment::factory()->createOne();
    $user = User::factory()->createOne();

    Sanctum::actingAs($user);

    ChapterCommentVote::create([
        "user_id" => $user->id,
        "chapter_comment_id" => $comment->id,
        "vote" => 1,
    ]);

    $this->assertTrue($comment->votes()->count() == 1);

    $response = $this->delete(route('api.chapter.comments.vote.delete', [
        "comment" => $comment->id,
    ]));

    $response->assertSuccessful();
    $this->assertTrue($comment->votes()->first()->vote == 0);
});

afterEach(function () {
    $series = Series::all();

    foreach ($series as $s) {
        $s->delete();
    }
});
