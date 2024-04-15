<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\StoragePathService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserImageController extends Controller
{
    public function show(Request $request, User $user)
    {
        $images = Storage::allFiles(StoragePathService::forUserImage($user));

        if (sizeof($images) == 0) {
            return redirect("/img/user.png");
        }

        return Storage::response($images[0]);
    }
}
