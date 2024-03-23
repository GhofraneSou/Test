<?php

namespace Database\Factories;

use App\Models\TaskList;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaskList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Titre' => $this->faker->sentence,
            'Description' => $this->faker->paragraph,
            'Etat' => $this->faker->randomElement(['Complet', 'Incomplet']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}