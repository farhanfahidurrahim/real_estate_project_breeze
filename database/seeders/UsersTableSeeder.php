<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            //Admin
            [
                'name'=> 'Admin Farhan',
                'username'=> 'admin',
                'email'=> 'admin@gmail.com',
                'password'=> Hash::make('12345678'),
                'phone'=> '01675717825',
                'role'=> 'admin',
                'status'=> 'active',
            ],
            //Agent
            [
                'name'=> 'Agent Farhan',
                'username'=> 'agent',
                'email'=> 'agent@gmail.com',
                'password'=> Hash::make('12345678'),
                'phone'=> '01675717825',
                'role'=> 'agent',
                'status'=> 'active',
            ],
            //User
            [
                'name'=> 'User Farhan',
                'username'=> 'user',
                'email'=> 'user@gmail.com',
                'password'=> Hash::make('12345678'),
                'phone'=> '01675717825',
                'role'=> 'user',
                'status'=> 'active',
            ],
        ]);
    }
}
