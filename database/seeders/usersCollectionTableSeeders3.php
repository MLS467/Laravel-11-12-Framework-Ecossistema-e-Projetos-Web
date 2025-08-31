<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class usersCollectionTableSeeders3 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            usersTableSeeders::class,
            usersTableSeeders2::class,
            usersTableSeeders3::class,
        ]);
    }
}