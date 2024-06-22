<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterComment extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "chapter_id",
        "comment",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function votes()
    {
        return $this->hasMany(ChapterCommentVote::class);
    }

    public function voted(?User $user)
    {
        if ($user == null) return 0;

        $vote = $this->votes()->where('user_id', $user->id)->first();

        return $vote?->vote ?? 0;
    }

    public function vote(User $user, $val)
    {
        ChapterCommentVote::updateOrCreate(
            [
                "user_id" => $user->id,
                "chapter_comment_id" => $this->id,
            ],
            ['vote' => $val]
        );
    }
}
