<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("roles")->insert([
            'name' => 'SuperAdmin',
            'guard_name' => 'web',
        ]);

        DB::table("permissions")->insert([
            [
                'name' => 'type.menu',
                'guard_name' => 'web',
                'group_name' => 'type',
            ],
            [
                'name' => 'type.all',
                'guard_name' => 'web',
                'group_name' => 'type',
            ],
            [
                'name' => 'type.add',
                'guard_name' => 'web',
                'group_name' => 'type',
            ],
            [
                'name' => 'amenity.menu',
                'guard_name' => 'web',
                'group_name' => 'amenity',
            ],
            [
                'name' => 'property.menu',
                'guard_name' => 'web',
                'group_name' => 'property',
            ],
            [
                'name' => 'role_permission.menu',
                'guard_name' => 'web',
                'group_name' => 'role',
            ],
            [
                'name' => 'agent.menu',
                'guard_name' => 'web',
                'group_name' => 'agent',
            ]
        ]);

        DB::table("role_has_permissions")->insert([
            [
                'permission_id' => '1',
                'role_id' => '1',
            ],
            [
                'permission_id' => '2',
                'role_id' => '1',
            ],
            [
                'permission_id' => '3',
                'role_id' => '1',
            ],
            [
                'permission_id' => '4',
                'role_id' => '1'
            ],
            [
                'permission_id' => '5',
                'role_id' => '1',
            ],
            [
                'permission_id' => '6',
                'role_id' => '1',
            ],
            [
                'permission_id' => '7',
                'role_id' => '1',
            ],
        ]);

        DB::table("model_has_roles")->insert([
            'role_id' => '1',
            'model_type' => 'App\Models\User',
            'model_id' => '1',
        ]);

    }
}
