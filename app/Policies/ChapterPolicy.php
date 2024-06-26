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
        return $chapter->published || ($user != null && ($user->isAdmin() || $user->id == $chapter->user_id || $user->hasPermissions(UserPermission::APPROVE)));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Series $series): bool
    {
        return $series->published && ($user->isAdmin() || $user->hasPermissions(UserPermission::CREATE));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chapter $chapter): bool
    {
        return $user->isAdmin() || (!$chapter->published && $user->id == $chapter->user_id) || ($chapter->published && $user->hasPermissions(UserPermission::UPDATE));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chapter $chapter): bool
    {
        return $user->isAdmin() || (!$chapter->published && $user->id == $chapter->user_id);
    }

    public function publish(User $user)
    {
        return $user->isAdmin() || $user->hasPermissions(UserPermission::APPROVE);
    }

    public function vote(User $user): bool
    {
        return true;
    }
}
