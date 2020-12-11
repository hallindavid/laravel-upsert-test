<?php

namespace Database\Factories;

use App\Models\TestTask;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestTaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TestTask::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(),
            'sort_order'=>$this->faker->randomNumber(4, false),
        ];
    }
}
