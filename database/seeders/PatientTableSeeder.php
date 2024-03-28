<?php

namespace Database\Seeders;

use App\Models\Reception;
use App\Models\Insurance;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class PatientTableSeeder extends Seeder
{
    public function run()
    {
        $Patients = new Patient();
        $Patients->email = 'patient@gmail.com';
        $Patients->Password = Hash::make('123456789');
        $Patients->Date_Birth = '1988-10-01';
        $Patients->Phone = '0935464526';
        $Patients->Gender = 1;
        $Patients->Blood_Group = 'B+';
        $Patients->reception_id = Reception::get()->random()->id;
        $Patients->insurance_id = Insurance::get()->random()->id;
        $Patients->save();
        $Patients->name = 'Yanal Akel';
        $Patients->Address = 'Syria';
        $Patients->save();
    }
}
