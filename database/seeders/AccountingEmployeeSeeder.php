<?php

namespace Database\Seeders;

use App\Models\Accounting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class AccountingEmployeeSeeder extends Seeder
{
    public function run()
    {
        $accounting_employee = new Accounting();
        $accounting_employee->name = 'Accounting Employee ';
        $accounting_employee->email = 'Accounting@gmail.com';
        $accounting_employee->password = Hash::make('123456789');
        $accounting_employee->phone = '0935464280';
        $accounting_employee->description = 'This is a default user for section accounting';
        $accounting_employee->job_number = (string) Uuid::generate();
        $accounting_employee->job_title  = 'The Title';
        $accounting_employee->save();
    }
}
