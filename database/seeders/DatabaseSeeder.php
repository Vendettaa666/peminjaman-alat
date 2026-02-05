<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'nama_lengkap' => 'Administrator',
            'role' => 'admin',
            'password' => Hash::make('123'),
            
        ]);

        User::create([
            'username' => 'peminjam',
            'email' => 'peminjam@gmail.com',
            'nama_lengkap' => 'peminjam',
            'role' => 'peminjam',
            'password' => Hash::make('123'),
            
        ]);

        User::create([
            'username' => 'petugas',
            'email' => 'petugas@gmail.com',
            'nama_lengkap' => 'petugas',
            'role' => 'petugas',
            'password' => Hash::make('123'),
            
        ]);
    }
}
