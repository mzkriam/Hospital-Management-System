<?php

namespace App\Events;

use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransferToPharmacy implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $patient;
    public $invoice_id;
    public $treatment_id;
    public $operation_id;
    public $notification_id;
    public $message;
    public $created_at;
    public function __construct($data)
    {
        $patient = Patient::find($data['patient']);
        $this->message = "New examination : ";
        $this->patient = $patient->name;
        $this->notification_id = $data['notification_id'];
        $this->invoice_id = $data['invoice_id'];
        if (array_key_exists('treatment_id', $data)) {
            $this->treatment_id = $data['treatment_id'];
        }
        if (array_key_exists('operation_id', $data)) {
            $this->operation_id = $data['operation_id'];
        }
        $this->created_at = date('Y-m-d H:i:s');
    }
    public function broadcastOn()
    {
        return new Channel('transfer-to-pharmacy');
    }
    //Event
    public function broadcastAs()
    {
        return 'transfer-to-pharmacy';
    }
}
