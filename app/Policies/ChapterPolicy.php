<?php

namespace App\Policies;

use App\Enums\UserPermission;
use App\Models\Chapter;
use App\Models\Series;
use App\Models\User;

class ChapterPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Chapter $chapter): bool
    {
        return $chapter->published || $user?->isAdmin() || $user->id == $chapter->user_id || $user?->hasPermission(UserPermission::APPROVE);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Series $series): bool
    {
        return $series->published && ($user->isAdmin() || $user->hasPermission(UserPermission::CREATE));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chapter $chapter): bool
    {
        return $user->isAdmin() || (!$chapter->published && $user->id == $chapter->user_id) || ($chapter->published && $user->hasPermission(UserPermission::UPDATE));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chapter $chapter): bool
    {
        return $user->isAdmin() || (!$chapter->published && $user->id == $chapter->user_id);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Chapter $chapter): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Chapter $chapter): bool
    {
        //
        return false;
    }
}
