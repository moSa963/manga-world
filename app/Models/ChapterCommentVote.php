<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterCommentVote extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "chapter_comment_id",
        "vote",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chapter_comment()
    {
        return $this->belongsTo(ChapterComment::class);
    }
}
