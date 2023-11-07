<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Amenity::insert([
            [
                'amenity_name' => 'Fahi',
            ],
            [
                'amenity_name' => 'Dur',
            ],
            [
                'amenity_name' => 'Rhm',
            ],
            [
                'amenity_name' => 'Frn',
            ],
            [
                'amenity_name' => 'Frn',
            ],
            [
                'amenity_name' => 'Frf',
            ],
        ]);
    }
}
