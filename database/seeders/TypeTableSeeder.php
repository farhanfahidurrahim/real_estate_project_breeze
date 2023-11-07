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
                'type_name' => 'Abc',
                'type_icon' => 'icon-1',
            ],
            [
                'type_name' => 'Cde',
                'type_icon' => 'icon-2',
            ],
            [
                'type_name' => 'Efg',
                'type_icon' => 'icon-3',
            ],
            [
                'type_name' => 'Ghi',
                'type_icon' => 'icon-4',
            ],
            [
                'type_name' => 'Ijk',
                'type_icon' => 'icon-5',
            ],
        ]);
    }
}
