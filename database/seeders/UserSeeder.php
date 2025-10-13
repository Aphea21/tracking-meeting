<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Agent',
            'email' => 'member@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'member'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Ly',
            'email' => 'johnnybrader08@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'u@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'member',
            'email' => 'm@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'member'
        ]);
    }
}