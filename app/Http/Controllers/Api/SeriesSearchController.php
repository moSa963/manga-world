<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeriesResource;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesSearchController extends Controller
{
    public function index(Request $request, string $key)
    {
        $data = Series::for($request->user())
            ->where(function ($q) use ($key) {
                $q->where("title", 'LIKE', "%$key%")
                    ->orWhere("other_names", 'LIKE', "%$key%")
                    ->orWhere('author', 'LIKE', "%$key%");
            })
            ->simplePaginate(5);

        return SeriesResource::collection($data);
    }
}
