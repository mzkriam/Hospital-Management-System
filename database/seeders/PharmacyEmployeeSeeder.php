<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhaEmployee;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class PharmacyEmployeeSeeder extends Seeder
{
    public function run()
    {
        $pharmacy_employee = new PhaEmployee();
        $pharmacy_employee->name = 'Pharmacy Employee ';
        $pharmacy_employee->email = 'Pha@gmail.com';
        $pharmacy_employee->password = Hash::make('123456789');
        $pharmacy_employee->phone = '0935464280';
        $pharmacy_employee->description = 'This is a default user for section Pharmacy';
        $pharmacy_employee->job_number = (string) Uuid::generate();
        $pharmacy_employee->job_title  = 'The Title';
        $pharmacy_employee->save();
    }
}
