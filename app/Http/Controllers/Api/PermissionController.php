<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserPermission;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function store(Request $request, User $user, $permission)
    {
        Gate::allowIf($request->user()->isAdmin() === true);

        $permission = Permission::where("name", $permission)->firstOrFail();

        $user->addPermission(UserPermission::from($permission->name));
    }

    public function destroy(Request $request, User $user, Permission $permission)
    {
        Gate::allowIf($request->user()->isAdmin() === true);

        $user->deletePermission(UserPermission::from($permission->name));
    }
}
