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
            "user" => new UserResource($this->user),
            "title" => $this->title,
            "description" => $this->description,
            "painter" => $this->painter,
            "author" => $this->author,
            "status" => $this->status,
            "other_names" => $this->other_names,
            "type" => $this->type,
            "release_year" => $this->type,
            "chapters_count" => $this->whenCounted("chapters"),
        ];
    }
}
