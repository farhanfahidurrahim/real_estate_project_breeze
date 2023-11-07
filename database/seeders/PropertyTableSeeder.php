<?php

namespace Database\Seeders;

use App\Models\MultiImage;
use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::create([
            'ptype_id' => '1',
            'amenities_id' => '1',
            'property_name' => 'Nahraf Rudihaf',
            'property_slug' => 'nahraf-rudihaf',
            'property_code' => '753951',
            'property_status' => 'buy',
            'lowest_price' => '500',
            'maximum_price' => '50000',
            'property_thumbnail' => 'img here',
            'short_description' => 'This is short description',
            'long_description' => 'This is long description',
            'bedrooms' => '4',
            'bathrooms' => '4',
            'garage' => '1',
            'garage_size' => '500',
            'property_size' => '1800',
            'property_video' => 'link here',
            'address' => 'Sadar',
            'city' => 'Kishoreganj',
            'state' => 'Dhaka',
            'postal_code' => '2300',
            'neighborhood' => '',
            'latitude' => '3651.79512.63214',
            'longitude' => '9452.45845.5491',
            'featured' => '1',
            'hot' => '1',
            'agent_id' => '2',
            'status' => 'active',
        ]);

        MultiImage::create([
            'property_id' => '1',
            'photo_name' => 'zzz,xxx,yyy',
        ]);
    }
}
