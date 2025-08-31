<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usersTableSeeders2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 2. adiciona vários usuários diretamente
        $users = [
            [
                'username' => 'batata 2',
                'password' => bcrypt('password'),
                'active' => true,
                'created_at' => Carbon::now()
            ],
            [
                'username' => 'batata 3',
                'password' => bcrypt('password'),
                'active' => true,
                'created_at' => Carbon::now()
            ],
            [
                'username' => 'batata 4',
                'password' => bcrypt('password'),
                'active' => true,
                'created_at' => Carbon::now()
            ],
            [
                'username' => 'batata 5',
                'password' => bcrypt('password'),
                'active' => true,
                'created_at' => Carbon::now()
            ]
        ];

        DB::table('users')->insert($users);
    }
}