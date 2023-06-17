<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostGeneralEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    protected $user;
    protected $date;
    protected $content;


    public function __construct($user, $content, $date)
    {
        $this->user = $user;
        $this->content = $content;
        $this->date = $date;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('post-general'),
        ];
    }


    public function broadcastWith(): array
    {
        return [
            'userId' => $this->user->id,
            'avatar' => Storage::url($this->user->profile->avatar),
            'userName' => $this->user->name,
            'content' => $this->content,
            'date' => $this->date,
        ];
    }

    public function broadcastAs(): string {
        return 'PostGeneralEvent';
    }
}
