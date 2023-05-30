<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Yasin Ayatulloh Hakim',
            'slug' => 'yasin-ayatulloh-hakim',
            'username' => 'cybernet',
            'email' => 'yasin03ckm@gmail.com',
            'password' => Hash::make('@Abyasinah22123'),
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
    }
}
