<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => random_int(0, 9999),
            'client_id' => Client::inRandomOrder()->first()->id,
            'product_id' => Products::inRandomOrder()->first()->id,
            'quantity' => random_int(1, 10)
        ];
    }
}