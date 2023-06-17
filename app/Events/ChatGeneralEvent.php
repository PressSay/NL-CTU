<?php

namespace App\Events;

use App\ChrisKonnertz\BBCode\BBCode;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class ChatGeneralEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    protected $user;
    protected $message;
    protected $date;


    public function __construct($user, $message, $date)
    {
        $this->user = $user;
        $this->message = $message;
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
            new Channel('chat-general'),
        ];
    }

    public function broadcastWith(): array
    {
        $bbcode = new BBCode();
        $message = $bbcode->render($this->message);


        return [
            'userName' => $this->user->name,
            'avatar' => Storage::url($this->user->profile->avatar),
            'message' => $message,
            'date' => $this->date,
        ];
    }

    public function broadcastAs(): string
    {
        return 'ChatGeneralEvent';
    }
}
