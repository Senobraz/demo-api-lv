<?php

namespace App\Modules\Enotes\Actions\Workspaces;

use App\DTO\Workspaces\CreateWorkspaceDTO;
use App\Models\User\User;

class Create extends \App\Actions\Workspaces\Create
{
    public function execute(User $owner, CreateWorkspaceDTO $dto): bool
    {
        parent::execute($owner, $dto);

        return true;
    }
}
