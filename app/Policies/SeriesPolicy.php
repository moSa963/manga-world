<?php

namespace App\Policies;

use App\Enums\UserPermission;
use App\Models\Series;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SeriesPolicy
{

    public function before(User $user, string $ability): bool|null
    {
        return $user->isAdmin() ?: null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Series $series): bool
    {
        return $series->published || $user?->id == $series->user_id || $user?->hasPermissions(UserPermission::APPROVE);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissions(UserPermission::CREATE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Series $series): bool
    {
        return (!$series->published && $user->id == $series->user_id) || ($series->published && $user->hasPermissions(UserPermission::UPDATE));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Series $series): bool
    {
        return !$series->published && $user->id == $series->user_id;
    }

    public function publish(User $user)
    {
        return $user->hasPermissions(UserPermission::APPROVE);
    }
}
