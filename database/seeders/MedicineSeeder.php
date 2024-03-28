<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhaEmployee;
use App\Models\Medicine;


class MedicineSeeder extends Seeder
{
    public function run()
    {
        $medicine = new Medicine();
        $medicine->name = 'Default Medicine';
        $medicine->price = 3.200;
        $medicine->pha_employee_id = PhaEmployee::get()->random()->id;
        $medicine->code = '1254789';
        $medicine->description = 'This is a default Service for Ray Service';
        $medicine->save();
    }
}
