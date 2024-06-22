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
            "chapter_number" => $this->chapter->number,
            "comment" => $this->comment,
            "vote" => intval($this->votes_sum_vote ?? 0),
            "voted" => $this->voted($request->user()),
            "created_at" => $this->created_at
        ];
    }
}
