<?php

namespace Database\Factories\clinic;

use App\Models\clinic\Patient;
use App\Models\clinic\System;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\clinic\FamilyBackground>
 */
class FamilyBackgroundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $patient = Patient::inRandomOrder()->limit(1)->first();
        $system = System::inRandomOrder()->limit(1)->first();
        return [
            'patient_id' => $patient->id,
            'system_id' => $system->id,
            'relationship' => fake()->word(),
            'condition' => fake()->paragraph(2,true)
        ];
    }
}
