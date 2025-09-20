<?php

namespace App\Modules\Enotes\Listeners;

use App\Modules\Enotes\Actions\Workspaces\Create;
use App\DTO\Workspaces\CreateWorkspaceDTO;
use App\Events\AccountCreated;
use App\Models\Module\Module;
use Illuminate\Validation\ValidationException;

class CreateWorkspace
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * prepare the event.
     * @throws ValidationException
     */
    public function handle(AccountCreated $event): void
    {
        (new Create())->execute($event->user, new CreateWorkspaceDTO([
            'name' => __('enotes.workspace_private_name'),
            'module' => Module::MODULE_ENOTE,
        ]));
    }
}
