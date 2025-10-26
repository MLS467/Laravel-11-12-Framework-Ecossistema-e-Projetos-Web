<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    private $number_clients = 100;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory()->count($this->number_clients)->create();
    }
}