<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class usersTableSeeders3 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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