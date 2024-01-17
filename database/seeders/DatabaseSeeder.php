<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            "name" => "Admin",
            "email" => "admin@b2bee.com.tr",
            "email_verified_at" => now(),
            "password" => Hash::make("123456"),
            "two_factor_secret" => null,
            "two_factor_recovery_codes" => null,
            "is_delete" => "0",
            "status" => "1",
            "remember_token" => null,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

    }
}
