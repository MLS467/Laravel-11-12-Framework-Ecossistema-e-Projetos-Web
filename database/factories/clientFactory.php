<?php

namespace Database\Factories;

use App\Models\Client as ModelsClient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class clientFactory extends Factory
{

    protected $model = ModelsClient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'active' => $this->faker->boolean()
        ];
    }
}