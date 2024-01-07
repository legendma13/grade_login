<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        
        \App\Models\User::factory(10)->create();
        
        User::factory()->create([
            'email' => 'admin@projectworld.online',
            'birthday' => '1999-11-13',
            'role' => 'admin',
            'password' => Hash::make('password'), // Replace 'password' with the desired password
        ]);
                
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
