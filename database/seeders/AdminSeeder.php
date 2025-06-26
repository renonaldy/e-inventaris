<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password123'), // Ganti password sesuai kebutuhan
            'role' => 'superadmin', // Pastikan kolom role ada di tabel users
        ]);

        // Buat admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Ganti password sesuai kebutuhan
            'role' => 'admin', // Pastikan kolom role ada di tabel users
        ]);
    }
}
