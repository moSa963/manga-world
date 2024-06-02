<?php

namespace App\Services;

use App\Models\Series;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class SeriesService
{
    static function filterQuery(Builder $q, string $searchKey, string $publicationStatus, string $orderBy, string $genre): Builder
    {
        SeriesService::addSearchKey($q, $searchKey);

        SeriesService::addPublicationStatus($q, $publicationStatus);

        SeriesService::addOrderBy($q, $orderBy);

        SeriesService::filterByGenre($q, $genre);

        return $q;
    }

    private static function addSearchKey(Builder $q, string $searchKey)
    {
        $q->where(function ($q) use ($searchKey) {
            $q->where("title", 'LIKE', "%$searchKey%")
                ->orWhere("other_names", 'LIKE', "%$searchKey%")
                ->orWhere('author', 'LIKE', "%$searchKey%");
        });
    }

    private static function addPublicationStatus(Builder $q, string $publicationStatus)
    {
        if ($publicationStatus === "unpublished") {
            $q->where('published', false);
        } else if ($publicationStatus === "published") {
            $q->where('published', true);
        }
    }

    private static function addOrderBy(Builder $q, string $orderBy)
    {
        if ($orderBy === "old") {
            $q->orderBy('created_at');
        } else if ($orderBy === "new") {
            $q->orderBy('created_at', "DESC");
        } else if ($orderBy === "new_add") {
            $q->orderBy('updated_at', 'DESC');
        }
    }

    private static function filterByGenre(Builder $q, string $genre)
    {
        if (empty($genre)) {
            return;
        }

        $q->where('genres', 'like', "%{$genre}%");
    }
}
