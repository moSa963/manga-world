<?php

namespace App\Services;

use App\Models\Series;
use Illuminate\Database\Eloquent\Builder;

class SeriesService
{
    static function filterQuery(Builder $q, string $searchKey, string $publicationStatus): Builder
    {
        $q->where(function ($q) use ($searchKey) {
            $q->where("title", 'LIKE', "%$searchKey%")
                ->orWhere("other_names", 'LIKE', "%$searchKey%")
                ->orWhere('author', 'LIKE', "%$searchKey%");
        });

        if ($publicationStatus === "unpublished") {
            $q->where('published', false);
        } else if ($publicationStatus === "published") {
            $q->where('published', true);
        }

        return $q;
    }
}
