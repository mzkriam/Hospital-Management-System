<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use \App\Models\Doctor;
use Webpatser\Uuid\Uuid;


class DoctorFactory extends Factory
{
    protected $model = Doctor::class;
    public function definition()
    {
        //'email', 'email_verified_at', 'password', 'phone',
        //'name'
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'phone' => $this->faker->phoneNumber(),
            'section_id' => Section::all()->random()->id,
            'number_of_statements' => 10,
            'job_number' => (string) Uuid::generate(),
        ];
    }
}
