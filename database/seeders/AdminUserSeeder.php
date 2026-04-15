<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nisn' => '555555555',
            'username' => 'Admin Sekolah',
            'tanggal_lahir' => '1990-01-01',
            'password' => Hash::make('admin123'),
            'email' => 'admin@sekolah.com',
            'phone' => '081234567890',
            'role' => 'admin',
            'is_active' => true
        ]);
    }
}
