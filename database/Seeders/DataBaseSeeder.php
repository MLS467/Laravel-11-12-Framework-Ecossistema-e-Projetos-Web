<?php

namespace Database\Seeders;

use Database\Factories\ClientFactory;
use Database\Factories\OrderFactory;
use Database\Factories\PhoneFactory;
use Database\Factories\ProductsFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            clientSeedersTable::class,
            ProductsSeeder::class,
            OrderSeeder::class,
            PhoneSeeder::class
        ]);
    }
}