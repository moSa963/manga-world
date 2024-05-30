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
            "genres" => $this->genres,
            "type" => $this->type,
            "published" => boolval($this->published),
            "releaseDate" => $this->release_date,
            "chaptersCount" => $this->whenCounted("chapters"),
            "latestChapters" => ChapterResource::collection($this->chapters()->orderBy("number", "DESC")->limit(2)->get()),
        ];
    }
}
