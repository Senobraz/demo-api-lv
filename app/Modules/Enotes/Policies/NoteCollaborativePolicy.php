<?php

namespace App\Modules\Enotes\Policies;

use App\Models\User\User;;
use App\Modules\Enotes\Models\NoteCollaborative;

class NoteCollaborativePolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Может ли пользователь общюю заметку, доступную в личном рабочем пространстве
     */
    public function view(User $user, NoteCollaborative $noteCollaborative): bool
    {
        return true;
    }

    /**
     * Может ли пользователь просмотреть общюю заметку, доступную по внешней ссылке
     */
    public function publicView(User $user, NoteCollaborative $noteCollaborative): bool
    {
        return true;
    }
}
