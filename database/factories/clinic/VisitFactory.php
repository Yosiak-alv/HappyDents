<?php

namespace Database\Factories\clinic;

use App\Models\clinic\Patient;
use App\Models\clinic\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\clinic\Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $patient = Patient::inRandomOrder()->limit(1)->first();
        $treatment = Treatment::inRandomOrder()->limit(1)->first();
        return [
            'patient_id' => $patient->id,
            'treatment_id' =>$treatment->id,
            'payment' => fake()->randomFloat(2,5,500)
        ];
    }
}
