<?php

namespace App\Services;

use App\Models\Series;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ChapterService
{
    static function filterQuery($q, string $publicationStatus)
    {
        ChapterService::addPublicationStatus($q, $publicationStatus);

        return $q;
    }

    private static function addPublicationStatus($q, string $publicationStatus)
    {
        if ($publicationStatus === "unpublished") {
            $q->where('published', false);
        } else if ($publicationStatus === "published") {
            $q->where('published', true);
        }
    }
}
