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
        DB::table('users')->insert([
            'username' => 'batata',
            'password' => bcrypt('password'),
            'active' => true,
            'created_at' => Carbon::now()
        ]);
    }
}