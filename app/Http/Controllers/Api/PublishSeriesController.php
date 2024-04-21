<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeriesResource;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PublishSeriesController extends Controller
{
    public function store(Request $request, Series $series)
    {
        Gate::authorize("publish", $series);

        $series->update([
            "published" => true,
        ]);

        return new SeriesResource($series);
    }
}
