<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            // AppointmentTableSeeder::class,
            SectionTableSeeder::class,
            DoctorTableSeeder::class,
            ImageTableSeeder::class,
            ServiceTableSeeder::class,
            RayEmployeeSeeder::class,
            LaboratoryEmployeeSeeder::class,
            PharmacyEmployeeSeeder::class,
            // RayServiceSeeder::class,
            // LabServiceSeeder::class,
            MedicineSeeder::class,
            AccountingEmployeeSeeder::class,
            ReceptionEmployeeSeeder::class,
            InsuranceTableSeeder::class,
            PatientTableSeeder::class,
        ]);
    }
}
