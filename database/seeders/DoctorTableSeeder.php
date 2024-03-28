<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;


class DoctorTableSeeder extends Seeder
{
    public function run()
    {
        Doctor::factory()->count(30)->create();
        // $doctors = Doctor::factory()->count(30)->create();
        // $Appointments = Appointment::all();

        // Doctor::get()->each(function ($doctor) use ($Appointments) {
        //     $doctor->doctorappointments()->attach(
        //         $Appointments->random(rand(1, 7))->pluck('id')->toArray()
        //     );
        // });

        // foreach ($doctors as $doctor) {
        //     $Appointments = Appointment::get()->random()->id;
        //     $doctor->doctorappointments()->attach($Appointments);
        // }
    }
}
