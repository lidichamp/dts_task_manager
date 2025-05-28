<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4), 
            'assigned_to' => $this->faker->name, 
            'description' => $this->faker->paragraph, 
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'due_date' => $this->faker->dateTimeBetween('+1 days', '+30 days')->format('Y-m-d'),
        ];
    }
}
