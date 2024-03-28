<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;

class AppointmentTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('appointments')->delete();
        $Appointments = [
            ['name' => 'Saturday'],
            ['name' => 'Sunday'],
            ['name' => 'Monday'],
            ['name' => 'Tuesday'],
            ['name' => 'Wednesday'],
            ['name' => 'Thursday'],
            ['name' => 'Friday'],
        ];
        foreach ($Appointments as $Appointment) {
            Appointment::create($Appointment);
        }
    }
}
