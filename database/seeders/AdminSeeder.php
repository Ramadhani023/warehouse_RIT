<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'dob' => null,
            'descr' => 'Default administrator account',
            'role' => 'admin',
            'password' => Hash::make('admin123'), // Hashed password
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
