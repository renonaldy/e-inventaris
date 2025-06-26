<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::updateOrCreate(
            ['email' => 'reno@reno.test'],
            [
                'name' => 'Admin Sispeba',
                'role' => 'admin',
                'password' => Hash::make('reno123'),
            ]
        );

        // User biasa
        User::updateOrCreate(
            ['email' => 'fahmi@example.test'],
            [
                'name' => 'Fahmi',
                'role' => 'user',
                'password' => Hash::make('fahmi123'),
            ]
        );
    }
}
