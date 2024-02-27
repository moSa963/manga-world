<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Series;

class StoragePathService
{
    static function root(Series $series): string
    {
        return "$series->title";
    }

    static function forPoster(Series $series): string
    {
        return StoragePathService::root($series) . "/poster";
    }

    static function forPage(Page $page): string
    {
        return StoragePathService::root($page->series) . "/{$page->chapter->number}";
    }
}
