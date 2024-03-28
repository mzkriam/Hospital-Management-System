<?php

namespace App\Http\Livewire\Chat;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateChat extends Component
{
    public $users;
    public $receive;
    public $auth_email;
    public $catchError;
    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }
    public function createConversation($receiver_email)
    {
        $CheckConversation = Conversation::checkConversation($this->auth_email, $receiver_email)->get();
        if ($CheckConversation->isEmpty()) {
            DB::beginTransaction();
            try {
                $createConversation = Conversation::create([
                    'sender_email' => $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'last_time_message' => null,
                ]);
                Message::create([
                    'conversation_id' => $createConversation->id,
                    'sender_email' => $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'body' => 'Begin Conversation',
                ]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->catchError = $e->getMessage();
            }
        } else {
            dd("Conversation Created successfully");
        }
    }
    public function render()
    {
        if (Auth::guard('patient')->check()) {
            $this->users = Doctor::get();
            $this->receive = 'Doctors';
        } elseif (Auth::guard('doctor')->check()) {
            $this->users = Patient::get();
            $this->receive = 'Patients';
        }
        return view('livewire.chat.create-chat')->extends('Dashboard.layouts.master');
    }
}
