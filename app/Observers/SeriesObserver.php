<?php

namespace App\Observers;

use App\Models\Series;
use App\Services\StoragePathService;
use Illuminate\Support\Facades\Storage;

class SeriesObserver
{
    /**
     * Handle the Series "created" event.
     */
    public function created(Series $series): void
    {
        //
    }

    /**
     * Handle the Series "updated" event.
     */
    public function updated(Series $series): void
    {
        //
    }

    /**
     * Handle the Series "deleted" event.
     */
    public function deleted(Series $series): void
    {
        Storage::deleteDirectory(StoragePathService::root($series));
    }

    /**
     * Handle the Series "restored" event.
     */
    public function restored(Series $series): void
    {
        //
    }

    /**
     * Handle the Series "force deleted" event.
     */
    public function forceDeleted(Series $series): void
    {
        //
    }
}
