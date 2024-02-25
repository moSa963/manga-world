<?php

namespace App\Http\Resources;

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
            "pages" => PageResource::collection($this->pages),
        ];
    }

    public static function collection($resource)
    {
        return new ChapterCollection($resource);
    }
}
