<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    protected $model = Section::class;
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(["الاعصاب", "التوليد", "الجراحة", "المخ", "العمليات", "المختبر"]),
            'description' => $this->faker->paragraph
        ];
    }
}
