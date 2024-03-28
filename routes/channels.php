<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});



Broadcast::channel(
    'create-invoice.{doctor_id}',
    function ($user, $doctor_id) {
        return (int) $user->id === (int) $doctor_id;
    },
    [
        'guards' => [
            'doctor'
        ]
    ]
);
Broadcast::channel(
    'transfer-to-ray',
    [
        'guards' => [
            'ray_employee'
        ]
    ]
);
Broadcast::channel(
    'transfer-to-laboratory',
    [
        'guards' => [
            'laboratory_employee'
        ]
    ]
);
Broadcast::channel(
    'transfer-to-pharmacy',
    [
        'guards' => [
            'pharmacy_employee'
        ]
    ]
);

Broadcast::channel(
    'chat.{receiver_id}',
    function ($user, $receiver_id) {
        return (int) $user->id === (int) $receiver_id;
    },
    [
        'guards' => [
            'web', 'admin', 'patient', 'doctor', 'ray_employee', 'laboratory_employee',
            'pharmacy_employee', 'reception_employee', 'accounting_employee', 'api'
        ]
    ]
);
