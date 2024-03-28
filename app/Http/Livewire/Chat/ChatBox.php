<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBox extends Component
{
    // protected $listeners = ['loadConversation', 'pushMessage'];
    public $receiver;
    public $receiveUser;
    public $selectedConversation;
    public $messages;
    public $auth_email;

    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }

    public function getListeners()
    {
        $auth_id = auth()->user()->id;
        return [
            "echo-private:chat.{$auth_id},MessageSent" => 'broadcastMassage', 'loadConversation', 'pushMessage'
        ];
    }
    public function broadcastMassage($event)
    {
        $broadcastMessage = Message::find($event['message']);
        $broadcastMessage->read = 1;
        $this->pushMessage($broadcastMessage->id);
    }
    public function loadConversation(Conversation $conversation, $receiver)
    {
        $this->selectedConversation = $conversation;
        $this->receiveUser = $receiver;
        $this->messages = Message::where('conversation_id', $this->selectedConversation->id)->get();
    }
    public function pushMessage($message_id)
    {
        $new_message = Message::find($message_id);
        $this->messages->push($new_message);
    }
    public function render()
    {
        return view('livewire.chat.chat-box');
    }
}
