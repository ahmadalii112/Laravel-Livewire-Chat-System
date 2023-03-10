<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public $conversation;
    public $receiver;

    /**
     * Create a new event instance.
     */
    public function __construct($user, $message, $conversation, $receiver)
    {
        //
        $this->user = $user;
        $this->message = $message;
        $this->conversation = $conversation;
        $this->receiver = $receiver;
    }

    public function broadCastWith()
    {
        return [
            'user' => $this->user->id,
            'message' => $this->message->id,
            'conversation' => $this->conversation->id,
            'receiver' => $this->receiver->id,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        error_log($this->user);
        error_log($this->receiver);
        return [
            new PrivateChannel('chat.'. $this->receiver->id),
        ];
    }
}
