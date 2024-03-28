<?php

namespace App\Events;

use App\Models\Patient;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class CreateInvoice implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $doctor_id;
    public $patient;
    public $invoice_id;
    public $message;
    public $created_at;
    public function __construct($data)
    {
        $patient = Patient::find($data['patient']);
        $this->message = "New examination : ";
        $this->patient = $patient->name;
        $this->invoice_id = $data['invoice_id'];
        $this->doctor_id = $data['doctor_id'];
        $this->created_at = date('Y-m-d H:i:s');
    }
    //channel
    public function broadcastOn()
    {
        return new PrivateChannel('create-invoice.' . $this->doctor_id);
    }
    //Event
    public function broadcastAs()
    {
        return 'create-invoice';
    }
}
