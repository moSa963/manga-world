<?php

namespace App\Observers;

use App\Models\Chapter;
use App\Services\StoragePathService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ChapterObserver
{
    /**
     * Handle the Chapter "created" event.
     */
    public function created(Chapter $chapter): void
    {
        $chapter->series()->update([
            "updated_at" => Carbon::now(),
        ]);
    }

    /**
     * Handle the Chapter "updated" event.
     */
    public function updated(Chapter $chapter): void
    {
        //
    }

    /**
     * Handle the Chapter "deleted" event.
     */
    public function deleted(Chapter $chapter): void
    {
        Storage::deleteDirectory(StoragePathService::forPage($chapter));
    }

    /**
     * Handle the Chapter "restored" event.
     */
    public function restored(Chapter $chapter): void
    {
        //
    }

    /**
     * Handle the Chapter "force deleted" event.
     */
    public function forceDeleted(Chapter $chapter): void
    {
        //
    }
}
