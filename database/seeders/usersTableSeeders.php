<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [

                'username' => 'teste1@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [

                'username' => 'teste2@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [

                'username' => 'teste3@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s')
            ]

        ]);
    }
}