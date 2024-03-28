<?php

namespace App\Events;

use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransferToRay implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $patient;
    public $invoice_id;
    public $ray_service_id;
    public $message;
    public $created_at;
    public function __construct($data)
    {
        $patient = Patient::find($data['patient']);
        $this->message = "New examination : ";
        $this->patient = $patient->name;
        $this->invoice_id = $data['invoice_id'];
        $this->ray_service_id = $data['ray_service_id'];
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function broadcastOn()
    {
        return new Channel('transfer-to-ray');
    }
    //Event
    public function broadcastAs()
    {
        return 'transfer-to-ray';
    }
}
