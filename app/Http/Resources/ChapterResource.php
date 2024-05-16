<?php

namespace App\Http\Resources;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
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
            "series" => $this->series->title,
            "title" => $this->title,
            "number" => $this->number,
            "published" => $this->published,
            "releaseDate" => $this->release_date,
            "pages" => $this->when($this->relationLoaded("pages"), PageResource::collection($this->pages)),
        ];
    }
}
