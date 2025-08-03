<?php

namespace App\Http\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class Operation
{

    public static function descrypt_id($value)
    {
        try {
            $capture_id = Crypt::decrypt($value);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }

        return $capture_id;
    }

    public static function testing_database(): bool
    {
        try {
            DB::connection()->getPdo();
        } catch (\PDOException $e) {
            echo "connection failed $e";
            return false;
        }

        return true;
    }
}