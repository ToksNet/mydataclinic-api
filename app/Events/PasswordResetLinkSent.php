<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use App\Models\Organisation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class PasswordResetLinkSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $resetLink;

    /**
     * Create a new event instance.
     */
    public function __construct(Organisation $user, $resetLink)
    {
        $this->user = $user;
        $this->resetLink = $resetLink;
    }

    

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
