<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Series;
use App\Models\User;

class StoragePathService
{
    static function root(Series $series): string
    {
        return "$series->id";
    }

    static function forUserImage(User $user)
    {
        return "users/{$user->username}/image";
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
