<?php

namespace App\Events;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender;
    public $message;
    public $conversation;
    public $receiver;
    public function __construct($sender, Message $message, Conversation $conversation, $receiver)
    {
        $this->sender = $sender;
        $this->message = $message;
        $this->conversation = $conversation;
        $this->receiver = $receiver;
    }
    public function broadcastWith()
    {
        return [
            'conversation_id' => $this->conversation->id,
            'sender_email' => $this->sender,
            'receiver_email' => $this->receiver['email'],
            'message' => $this->message->id
        ];
    }
    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->receiver['id']);
    }
}
