<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Services\StoragePathService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeriesImageController extends Controller
{
    public function show(Series $series)
    {
        abort_if(Storage::missing(StoragePathService::forPoster($series)), 404);
        return Storage::response(StoragePathService::forPoster($series));
    }
}
