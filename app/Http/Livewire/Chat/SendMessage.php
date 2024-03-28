<?php

namespace App\Http\Livewire\Chat;

use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Message;
use App\Models\Conversation;

class SendMessage extends Component
{
    public $selectedConversation;
    public $auth_email;
    public $body;
    public $receiveUser;
    public $sender;
    public $createdMessage;
    protected $listeners = ['updateMessage', 'dispatchSentMessage'];
    public function updateMessage(Conversation $conversation, $receiver)
    {
        $this->selectedConversation = $conversation;
        $this->receiveUser = $receiver;
    }
    public function mount()
    {
        if (Auth::guard('patient')->check()) {
            $this->auth_email = Auth::guard('patient')->user()->email;
            $this->sender = Auth::guard('patient')->user();
        } elseif (Auth::guard('doctor')->check()) {
            $this->auth_email = Auth::guard('doctor')->user()->email;
            $this->sender = Auth::guard('doctor')->user();
        }
    }
    public function sendMessage()
    {
        if ($this->body == null) {
            return null;
        }
        $this->createdMessage =  Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_email' => $this->auth_email,
            'receiver_email' => $this->receiveUser['email'],
            'body' => $this->body,
        ]);
        $this->selectedConversation->last_time_message = $this->createdMessage->created_at;
        $this->selectedConversation->save();
        $this->reset('body');
        $this->emitTo('chat.chat-box', 'pushMessage', $this->createdMessage->id);
        $this->emitTo('chat.chat-list', 'refresh');
        $this->emitSelf('dispatchSentMessage');
    }
    public function dispatchSentMessage()
    {
        broadcast(new MessageSent($this->sender, $this->createdMessage, $this->selectedConversation, $this->receiveUser));
    }
    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
