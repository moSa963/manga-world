<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeriesResource extends JsonResource
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
            "user" => new UserResource($this->user),
            "title" => $this->title,
            "description" => $this->description,
            "painter" => $this->painter,
            "author" => $this->author,
            "status" => $this->status,
            "otherNames" => $this->other_names,
            "type" => $this->type,
            "releaseYear" => $this->release_year,
            "chaptersCount" => $this->whenCounted("chapters"),
            "latestChapters" => ChapterResource::collection($this->chapters()->limit(2)->get()),
        ];
    }
}
