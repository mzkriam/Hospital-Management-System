<?php

namespace Database\Seeders;

use App\Models\Insurance;
use App\Models\Accounting;
use Illuminate\Database\Seeder;

class InsuranceTableSeeder extends Seeder
{
    public function run()
    {
        $insurance = new Insurance();
        $insurance->name = 'Insurance';
        $insurance->notes = 'Insurance Company Default';
        $insurance->contact_number = '0935464280';
        $insurance->insurance_code = '01221110';
        $insurance->discount_percentage = 20;
        $insurance->company_rate = 5;
        $insurance->status = 1;
        $insurance->accountings_id = Accounting::get()->random()->id;
        $insurance->save();
    }
}
