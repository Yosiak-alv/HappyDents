<?php

namespace Database\Factories\clinic;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\clinic\Diagnostic>
 */
class DiagnosticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'observation' =>fake()->paragraph(2,true),
            'diagnostic' => fake()->paragraph(2,true)
        ];
    }
}
