<?php

namespace App\Events;

use App\Models\Workspace\Workspace;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WorkspaceCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Workspace $workspace;

    /**
     * Create a new event instance.
     */
    public function __construct(Workspace $workspace)
    {
        $this->workspace = $workspace;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            //new PrivateChannel('channel-name'),
        ];
    }
}
