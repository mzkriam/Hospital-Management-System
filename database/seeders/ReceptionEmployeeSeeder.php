<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reception;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class ReceptionEmployeeSeeder extends Seeder
{
    public function run()
    {
        $reception_employee = new Reception();
        $reception_employee->name = 'Reception Employee ';
        $reception_employee->email = 'Reception@gmail.com';
        $reception_employee->password = Hash::make('123456789');
        $reception_employee->phone = '0935464280';
        $reception_employee->description = 'This is a default user for section reception';
        $reception_employee->job_number = (string) Uuid::generate();
        $reception_employee->job_title  = 'The Title';
        $reception_employee->save();
    }
}
