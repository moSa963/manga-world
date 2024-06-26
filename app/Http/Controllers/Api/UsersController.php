<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize("viewAny", User::class);

        $key = $request->query("key");

        $q = User::query()->withCount("permissions");

        if ($key != null) {
            $q->where(function ($q) use ($key) {
                $q->where("name", 'LIKE', "%$key%")
                    ->orWhere("username", 'LIKE', "%$key%");
            });
        }

        $q->with("permissions");

        $q->orderBy("admin", "DESC")
            ->orderBy("permissions_count", "DESC");

        $data = $q->simplePaginate()->withQueryString();

        return UserResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
