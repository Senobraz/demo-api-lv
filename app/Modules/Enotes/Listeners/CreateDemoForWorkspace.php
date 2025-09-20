<?php

namespace App\Modules\Enotes\Listeners;

use App\Events\WorkspaceCreated;
use App\Modules\Enotes\Supports\DemoSupport;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CreateDemoForWorkspace
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
    public function handle(WorkspaceCreated $event): void
    {
        $workspaceId = $event->workspace->getId();

        $demoAccountUlid = (string)config('app.demo_account_ulid_ru');

        try {
            if($demoAccountUlid) {
                DemoSupport::initializeDemoForWorkspace($demoAccountUlid, $workspaceId);
            }
        } catch (\Throwable $e) {
            Log::channel('errors')->error(CreateDemoForWorkspace::class . ':' . $e->getMessage(), [
                'demo_account_ulid' => $demoAccountUlid,
                'workspace_id' => $workspaceId,
            ]);
        }
    }
}
