<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => (string) Str::uuid(),
                'username' => 'admin01',
                'name' => 'Admin Utama',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'phone_number' => '081234567890',
                'profile_picture' => 'admin.png',
                'role' => 'admin',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'username' => 'user01',
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('user123'),
                'phone_number' => '082123456789',
                'profile_picture' => 'profile.png',
                'role' => 'customer',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'username' => 'user02',
                'name' => 'Siti Aminah',
                'email' => 'siti@example.com',
                'password' => Hash::make('user123'),
                'phone_number' => '083123456789',
                'profile_picture' => 'profile.png',
                'role' => 'customer',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
