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
                'amenity_name' => 'Air Conditioning',
            ],
            [
                'amenity_name' => 'Cleaning Service',
            ],
            [
                'amenity_name' => 'Dishwasher',
            ],
            [
                'amenity_name' => 'Hardwood Flows',
            ],
            [
                'amenity_name' => 'Swimming Pool',
            ],
            [
                'amenity_name' => 'Outdoor Shower',
            ],
            [
                'amenity_name' => 'Pet Friendly',
            ],
            [
                'amenity_name' => 'Basketball Court',
            ],
            [
                'amenity_name' => 'Refrigerator',
            ],
            [
                'amenity_name' => 'Gym',
            ],
            [
                'amenity_name' => 'CCTv Camera',
            ],
            [
                'amenity_name' => 'Security Guard',
            ],
        ]);
    }
}
