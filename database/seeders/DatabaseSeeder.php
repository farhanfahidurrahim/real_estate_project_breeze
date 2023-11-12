<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SmtpSetting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UsersTableSeeder::class);
        \App\Models\User::factory(5)->create();
        $this->call(TypeTableSeeder::class);
        $this->call(AmenityTableSeeder::class);
        $this->call(PropertyTableSeeder::class);
        \App\Models\Property::factory(25)->create();
        $this->call(SettingTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
    }
}
