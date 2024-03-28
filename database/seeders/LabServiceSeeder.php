<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LabService;
use App\Models\LabEmployee;
use App\Models\Invoice;
use App\Models\Patient;


class LabServiceSeeder extends Seeder
{
    public function run()
    {
        $lab_service = new LabService();
        $lab_service->name = 'Lab Service ';
        $lab_service->description = "From Doctor";
        $lab_service->price = 6.200;
        $lab_service->patient_id = Patient::get()->random()->id;
        $lab_service->lab_employ_id = LabEmployee::get()->random()->id;
        $lab_service->invoice_id = Invoice::get()->random()->id;
        $lab_service->code = '987456123';
        $lab_service->save();
    }
}
