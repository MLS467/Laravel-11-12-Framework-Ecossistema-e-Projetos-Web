<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class clientSeedersTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory(500)->create();
    }
}