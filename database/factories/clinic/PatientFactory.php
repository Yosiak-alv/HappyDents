<?php

namespace Database\Factories\clinic;

use App\Models\clinic\BranchOffice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\clinic\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $branch = BranchOffice::inRandomOrder()->limit(1)->first();
        return [
            'dui' => fake()->unique()->numerify('########-#'),
            'name' => fake()->name(),
            'lastname' => fake()->lastName(),
            'genre' => fake()->randomElement(['Mujer','Hombre']),
            'email' =>fake()->email(),
            'phone' => fake()->phoneNumber(),
            'second_phone' => fake()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'occupation' => fake()->word(),
            'birthdate' => fake()->date(),
            'branch_office_id' => $branch->id,
            'contact_name' =>fake()->name(),
            'contact_phone' =>fake()->phoneNumber(),
            'contact_email' =>fake()->freeEmail()
        ];
    }
}
