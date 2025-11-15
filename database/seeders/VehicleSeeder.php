<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicles')->insert([
            [
                'brand' => 'Toyota Avanza',
                'year' => 2021,
                'plate_number' => 'B 1234 XYZ',
                'transmission' => 'automatic',
                'fuel_type' => 'gasoline',
                'capacity' => 7,
                'price_per_day' => 350000,
                'description' => 'Mobil keluarga irit BBM dan nyaman digunakan.',
                'photo' => 'vehicles/avanza.jpg',
                'vehicle_type' => 'car',
                'status' => 'Available',
            ],
            [
                'brand' => 'Honda Beat',
                'year' => 2020,
                'plate_number' => 'BE 5678 ABC',
                'transmission' => 'manual',
                'fuel_type' => 'gasoline',
                'capacity' => 2,
                'price_per_day' => 100000,
                'description' => 'Motor matic irit BBM dan lincah di jalan.',
                'photo' => 'vehicles/beat.jpg',
                'vehicle_type' => 'motorcycle',
                'status' => 'Available',
            ],
            [
                'brand' => 'Mitsubishi Xpander',
                'year' => 2022,
                'plate_number' => 'B 9876 DEF',
                'transmission' => 'automatic',
                'fuel_type' => 'gasoline',
                'capacity' => 7,
                'price_per_day' => 450000,
                'description' => 'Mobil MPV premium dengan kenyamanan ekstra.',
                'photo' => 'vehicles/xpander.jpg',
                'vehicle_type' => 'car',
                'status' => 'Available',
            ],
        ]);
    }
}
