<?php

namespace Database\Seeders;

use App\Models\RayEmployee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class RayEmployeeSeeder extends Seeder
{
    public function run()
    {
        $ray_employee = new RayEmployee();
        $ray_employee->name = 'Ray Employee ';
        $ray_employee->email = 'Ray@gmail.com';
        $ray_employee->password = Hash::make('123456789');
        $ray_employee->phone = '0935464280';
        $ray_employee->description = 'This is a default user for section laboratory';
        $ray_employee->job_number = (string) Uuid::generate();
        $ray_employee->job_title  = 'The Title';
        $ray_employee->save();
    }
}
