<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RayService;
use App\Models\RayEmployee;
use App\Models\Invoice;
use App\Models\Patient;


class RayServiceSeeder extends Seeder
{
    public function run()
    {
        $ray_service = new RayService();
        $ray_service->name = 'Ray Service ';
        $ray_service->description = "From Doctor";
        $ray_service->price = 3.200;
        $ray_service->patient_id = Patient::get()->random()->id;
        $ray_service->ray_employ_id = RayEmployee::get()->random()->id;
        $ray_service->invoice_id = Invoice::get()->random()->id;
        $ray_service->code = '1254789';
        $ray_service->save();
    }
}
