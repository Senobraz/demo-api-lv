<?php

namespace App\Actions\Workspaces;

use App\Actions\ApiAction;
use App\DTO\Workspaces\CreateWorkspaceDTO;
use App\Events\WorkspaceCreated;
use App\Models\User\User;
use App\Models\User\UserWorkspace;
use App\Models\Workspace\Workspace;
use App\Supports\ModuleSupport;
use App\Traits\UseDB;
use Illuminate\Validation\ValidationException;

class Create extends ApiAction
{
    use UseDB;

    protected User|null $owner = null;

    public function execute(User $owner, CreateWorkspaceDTO $dto): bool
    {
        $this->owner = $owner;

        $this->validate([
            'module' => $dto->getModuleCode(),
        ]);

        $this->transaction(function () use ($owner, $dto): void {
            $workspace = Workspace::create([
                'owner_id' => $owner->getId(),
                'name' => $dto->getName(),
                'description' => $dto->getDescription(),
                'module_id' => $dto->getModuleId(),
                'type' => $dto->getType(),
                'status' => $dto->getStatus(),
                'avatar_color_id' => $dto->getAvatarColorId(),
                'avatar_icon_id' => $dto->getAvatarIconId(),
            ]);

            UserWorkspace::create([
                'user_id' => $owner->getId(),
                'workspace_id' => $workspace->getId(),
            ]);

            event(new WorkspaceCreated($workspace));
        });

        return true;
    }

    public function validate(array $data): bool
    {
        if($this->owner->account && !ModuleSupport::installed($data['module'], $this->owner->account->getId())) {
            throw ValidationException::withMessages([
                'forbidden' => 'forbidden create workspace',
            ]);
        }

        return parent::validate($data);
    }
}
