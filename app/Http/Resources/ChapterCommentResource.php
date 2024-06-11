<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChapterCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "username" => $this->user->username,
            "chapter_id" => $this->chapter_id,
            "comment" => $this->comment,
            "vote" => $this->votes_sum_vote,
            "created_at" => $this->created_at
        ];
    }
}
