<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf' => $this->faker->numberBetween(9999999999,99999999999),
            'birthdate' => $this->faker->dateTimeThisCentury('-18 years'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other'])
        ];
    }
}
