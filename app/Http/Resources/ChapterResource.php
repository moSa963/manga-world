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
            "series" => $this->series->title,
            "title" => $this->title,
            "number" => $this->number,
            "published" => $this->published,
            "release_year" => $this->release_year,
            "pages" => $this->when($this->relationLoaded("pages"), PageResource::collection($this->pages)),
        ];
    }
}
