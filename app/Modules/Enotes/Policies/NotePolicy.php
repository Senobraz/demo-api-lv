<?php

namespace App\Modules\Enotes\Policies;

use App\Models\User\User;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\Models\Note;

class NotePolicy
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
    public function view(User $user, Note $note): bool
    {
        return $user->getId() === $note->workspace->getOwnerId();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Workspace $workspace): bool
    {
        return $user->getId() === $workspace->getOwnerId();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Note $note): bool
    {
        return $user->getId() === $note->workspace->getOwnerId();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Note $note): bool
    {
        return $user->getId() == $note->workspace->getOwnerId();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Workspace $workspace): bool
    {
        return false;
    }

    /**
     * Может ли пользователь открыть доступ публично по ссылке
     */
    public function sharePublicEnable(User $user, Note $note): bool
    {
        return $user->getId() === $note->workspace->getOwnerId();
    }

    /**
     * Может ли пользователь закрыть доступ по ссылке
     */
    public function sharePublicDisable(User $user, Note $note): bool
    {
        return $user->getId() === $note->workspace->getOwnerId();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Workspace $workspace): bool
    {
        return false;
    }
}
