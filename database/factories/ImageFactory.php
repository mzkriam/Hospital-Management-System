<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Image;
use \App\Models\Doctor;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    protected $model = Image::class;
    /* @return array
     */
    public function definition()
    {
        return [
            'filename' => $this->faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg']),
            'imageable_id' => Doctor::all()->random()->id,
            'imageable_type' => 'App\Models\Doctor',
        ];
    }
}
