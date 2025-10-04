<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Methode 1: DB facade gebruiken
        DB::table('categories')->insert([
            [
                'name' => 'Luxury Watches',
                'description' => 'High-end premium timepieces',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sport Watches',
                'description' => 'Watches designed for active lifestyle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Smart Watches',
                'description' => 'Digital watches with smart features',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Methode 2: Conditionele seeding
        if (app()->environment('local', 'testing')) {
            DB::table('categories')->insert([
                'name' => 'Test Category',
                'description' => 'Only for testing environment',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
