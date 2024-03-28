<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LabEmployee;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class LaboratoryEmployeeSeeder extends Seeder
{
    public function run()
    {
        $laboratory_employee = new LabEmployee();
        $laboratory_employee->name = 'Laboratory Employee ';
        $laboratory_employee->email = 'Lab@gmail.com';
        $laboratory_employee->password = Hash::make('123456789');
        $laboratory_employee->phone = '0935464280';
        $laboratory_employee->description = 'This is a default user for section laboratory';
        $laboratory_employee->job_number = (string) Uuid::generate();
        $laboratory_employee->job_title  = 'The Title';
        $laboratory_employee->save();
    }
}
