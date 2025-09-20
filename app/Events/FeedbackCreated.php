<?php

namespace App\Events;

use App\Models\Support\Feedback;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FeedbackCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Feedback $feedback;

    /**
     * Create a new event instance.
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
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
