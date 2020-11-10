<?php

namespace Database\Factories;

use App\Models\Workshop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WorkshopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Workshop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(60),
            'lead' => $this->faker->text(255),
            'description' => $this->faker->paragraphs(3, true),
            'instructor'  => $this->faker->name(),
            'datetime'  => $this->faker->dateTimeThisMonth(),
            'duration' => $this->faker->randomElement([2, 3, 4])
        ];
    }
}
