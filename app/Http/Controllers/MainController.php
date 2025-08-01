<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function test_db(): void
    {
        try {
            DB::connection()->getPdo();
            echo "connection successfuly";
        } catch (\PDOException $e) {
            echo "connection failed $e";
        }
    }
}