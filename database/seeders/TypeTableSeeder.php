<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::insert([
            [
                'type_name' => 'Residential',
                'type_icon' => 'icon-1',
            ],
            [
                'type_name' => 'Commercial',
                'type_icon' => 'icon-2',
            ],
            [
                'type_name' => 'Apartment',
                'type_icon' => 'icon-3',
            ],
            [
                'type_name' => 'Industrial',
                'type_icon' => 'icon-4',
            ],
            [
                'type_name' => 'Office',
                'type_icon' => 'icon-5',
            ],
            [
                'type_name' => 'Floor',
                'type_icon' => 'icon-6',
            ],
            [
                'type_name' => 'Duplex',
                'type_icon' => 'icon-7',
            ],
            [
                'type_name' => 'Building',
                'type_icon' => 'icon-8',
            ],
            [
                'type_name' => 'Warehouse',
                'type_icon' => 'icon-9',
            ],
        ]);
    }
}
