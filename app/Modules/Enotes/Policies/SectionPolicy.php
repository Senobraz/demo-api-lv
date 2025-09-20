<?php

namespace App\Modules\Enotes\Policies;

use App\Models\User\User;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\Models\Section;

class SectionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Workspace $workspace): bool
    {
        return $user->getId() === $workspace->getOwnerId();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Workspace $workspace): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Workspace $workspace): bool
    {
        return $user->getId() == $workspace->getOwnerId();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Section $section): bool
    {
        return $user->getId() == $section->workspace->getOwnerId();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Section $section): bool
    {
        return $user->getId() == $section->workspace->getOwnerId();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Workspace $workspace): bool
    {
        return false;
    }

    public function order(User $user, Section $section): bool
    {
        return $user->getId() == $section->workspace->getOwnerId();
    }

    public function move(User $user, Section $section): bool
    {
        return $user->getId() == $section->workspace->getOwnerId();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Workspace $workspace): bool
    {
        return false;
    }
}
