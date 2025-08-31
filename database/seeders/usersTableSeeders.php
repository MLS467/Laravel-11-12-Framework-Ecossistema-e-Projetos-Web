<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class usersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. adiciona usuários diretamente
        // DB::table('users')->insert([
        //     'username' => 'batata',
        //     'password' => bcrypt('password'),
        //     'active' => true,
        //     'created_at' => Carbon::now()
        // ]);


        // 2. adiciona vários usuários diretamente
        // $users = [
        //     [
        //         'username' => 'batata 2',
        //         'password' => bcrypt('password'),
        //         'active' => true,
        //         'created_at' => Carbon::now()
        //     ],
        //     [
        //         'username' => 'batata 3',
        //         'password' => bcrypt('password'),
        //         'active' => true,
        //         'created_at' => Carbon::now()
        //     ],
        //     [
        //         'username' => 'batata 4',
        //         'password' => bcrypt('password'),
        //         'active' => true,
        //         'created_at' => Carbon::now()
        //     ],
        //     [
        //         'username' => 'batata 5',
        //         'password' => bcrypt('password'),
        //         'active' => true,
        //         'created_at' => Carbon::now()
        //     ]
        // ];

        // DB::table('users')->insert($users);



        // 3. adiciona usuários com valores randômicos

        $qtd = 10;
        $users = [];
        for ($index = 0; $index < $qtd; $index++) {
            $users[] = [
                'username' => Str::random(10),
                'password' => bcrypt('password'),
                'active' => (bool) rand(0, 1),
                'created_at' => Carbon::now()
            ];
        }

        DB::table('users')->insert($users);
    }
}