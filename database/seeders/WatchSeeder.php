<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eerst de watches tabel aanmaken als deze niet bestaat
        DB::statement("CREATE TABLE IF NOT EXISTS watches (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(255) NOT NULL,
            brand VARCHAR(255) NOT NULL,
            price DECIMAL(8,2) NOT NULL,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // Data toevoegen
        $watches = [
            [
                'name' => 'Rolex Submariner',
                'brand' => 'Rolex',
                'price' => 8500.00,
                'description' => 'Luxe duikhorloge met automatisch uurwerk',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Omega Speedmaster',
                'brand' => 'Omega',
                'price' => 4200.00,
                'description' => 'Beroemd maanhorloge met chronograaf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Seiko 5',
                'brand' => 'Seiko',
                'price' => 150.00,
                'description' => 'Betaalbaar automatisch horloge',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Casio G-Shock',
                'brand' => 'Casio',
                'price' => 89.99,
                'description' => 'Schokbestendige digitale horloge',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Apple Watch',
                'brand' => 'Apple',
                'price' => 399.00,
                'description' => 'Smartwatch met health tracking',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'TAG Heuer Carrera',
                'brand' => 'TAG Heuer',
                'price' => 2200.00,
                'description' => 'Zwitserse luxe sporthorloge',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        // Bulk insert
        DB::table('watches')->insert($watches);
        
        echo "✅ WatchSeeder: " . count($watches) . " horloges toegevoegd aan de database!\n";
    }
}
