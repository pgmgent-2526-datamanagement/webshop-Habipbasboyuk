<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Methode 1: Factory gebruiken voor meerdere users
        User::factory(10)->create();

        // Methode 2: Specifieke test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Methode 3: Admin user handmatig maken
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);

        // Methode 4: Andere seeders aanroepen
        $this->call([
            WatchSeeder::class,
            // CategorySeeder::class,
            // ProductSeeder::class,
        ]);
    }
}
