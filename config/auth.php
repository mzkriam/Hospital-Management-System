<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'patient' => [
            'driver' => 'session',
            'provider' => 'patients',
        ],
        'doctor' => [
            'driver' => 'session',
            'provider' => 'doctors',
        ],
        'ray_employee' => [
            'driver' => 'session',
            'provider' => 'ray_employees',
        ],
        'laboratory_employee' => [
            'driver' => 'session',
            'provider' => 'laboratory_employees',
        ],
        'pharmacy_employee' => [
            'driver' => 'session',
            'provider' => 'pharmacy_employees',
        ],
        'reception_employee' => [
            'driver' => 'session',
            'provider' => 'reception_employees',
        ],
        'accounting_employee' => [
            'driver' => 'session',
            'provider' => 'accounting_employees',
        ],
    ],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'patients' => [
            'driver' => 'eloquent',
            'model' => App\Models\Patient::class,
        ],
        'doctors' => [
            'driver' => 'eloquent',
            'model' => App\Models\doctor::class,
        ],
        'ray_employees' => [
            'driver' => 'eloquent',
            'model' => App\Models\RayEmployee::class,
        ],
        'laboratory_employees' => [
            'driver' => 'eloquent',
            'model' => App\Models\LabEmployee::class,
        ],
        'pharmacy_employees' => [
            'driver' => 'eloquent',
            'model' => App\Models\phaEmployee::class,
        ],
        'reception_employees' => [
            'driver' => 'eloquent',
            'model' => App\Models\Reception::class,
        ],
        'accounting_employees' => [
            'driver' => 'eloquent',
            'model' => App\Models\Accounting::class,
        ],
    ],
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
