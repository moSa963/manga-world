<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Series;

class StoragePathService
{

    static function forPoster(Series $series): string
    {
        return "$series->title/";
    }

    static function forPage(Page $page): string
    {
        return "{$page->series->title}/{$page->chapter->number}/";
    }
}
