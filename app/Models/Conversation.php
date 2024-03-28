<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

class Conversation extends Model
{
    use HasFactory;
    protected $fillable = ['sender_email', 'receiver_email', 'last_time_message'];
    public function scopeCheckConversation($query, $auth_email, $receiver_email)
    {
        return $query->where('sender_email', $auth_email)->where('receiver_email', $receiver_email)->orWhere('sender_email', $receiver_email)->where('receiver_email', $auth_email);
    }
    public function Messages()
    {
        return $this->hasMany(Message::class);
    }
}
