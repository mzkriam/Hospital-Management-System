<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatList extends Component
{
    public $conversations;
    public $receiveUser;
    public $selectedConversation;
    public $auth_email;
    protected $listeners = ['chatUserSelected', 'refresh' => '$refresh'];
    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }
    public function render()
    {
        $this->conversations = Conversation::where('sender_email', $this->auth_email)->orWhere('receiver_email', $this->auth_email)->orderBy('created_at', 'DESC')->get();
        return view('livewire.chat.chat-list');
    }
    public function getUsers(Conversation $conversation, $request)
    {
        if ($conversation->sender_email == $this->auth_email) {
            if (Auth::guard('patient')->check()) {
                $this->receiveUser = Doctor::where('email', $conversation->receiver_email)->first();
            } elseif (Auth::guard('doctor')->check()) {
                $this->receiveUser = Patient::where('email', $conversation->receiver_email)->first();
            }
        } elseif ($conversation->receiver_email == $this->auth_email) {
            if (Auth::guard('patient')->check()) {
                $this->receiveUser = Doctor::where('email', $conversation->sender_email)->first();
            } elseif (Auth::guard('doctor')->check()) {
                $this->receiveUser = Patient::where('email', $conversation->sender_email)->first();
            }
        }
        if (isset($request)) {
            return $this->receiveUser->$request;
        }
    }
    public function chatUserSelected(Conversation $conversation, $receiver_id)
    {
        $this->selectedConversation = $conversation;
        if (Auth::guard('patient')->check()) {
            $this->receiveUser = Doctor::find($receiver_id);
        } elseif (Auth::guard('doctor')->check()) {
            $this->receiveUser = Patient::find($receiver_id);
        }
        $this->emitTo('chat.chat-box', 'loadConversation', $this->selectedConversation, $this->receiveUser);
        $this->emitTo('chat.send-message', 'updateMessage', $this->selectedConversation, $this->receiveUser);
    }
}
