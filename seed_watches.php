<?php
// Eenvoudig PHP script om data toe te voegen aan SQLite database
$database_path = __DIR__ . '/database/database.sqlite';

echo "🔄 Bezig met toevoegen van horloges aan de database...\n";

try {
    // SQLite database aanmaken/openen
    $pdo = new PDO("sqlite:$database_path");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Watches tabel aanmaken als deze niet bestaat
    $create_table_sql = "
        CREATE TABLE IF NOT EXISTS watches (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(255) NOT NULL,
            brand VARCHAR(255) NOT NULL,
            price DECIMAL(8,2) NOT NULL,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ";
    
    $pdo->exec($create_table_sql);
    echo "✅ Watches tabel aangemaakt/gecontroleerd\n";
    
    // Data voor horloges
    $watches = [
        ['Rolex Submariner', 'Rolex', 8500.00, 'Luxe duikhorloge met automatisch uurwerk'],
        ['Omega Speedmaster', 'Omega', 4200.00, 'Beroemd maanhorloge met chronograaf'],
        ['Seiko 5', 'Seiko', 150.00, 'Betaalbaar automatisch horloge'],
        ['Casio G-Shock', 'Casio', 89.99, 'Schokbestendige digitale horloge'],
        ['Apple Watch', 'Apple', 399.00, 'Smartwatch met health tracking'],
        ['TAG Heuer Carrera', 'TAG Heuer', 2200.00, 'Zwitserse luxe sporthorloge'],
        ['Tissot PRC 200', 'Tissot', 300.00, 'Zwitserse sporthorloge'],
        ['Citizen Eco-Drive', 'Citizen', 180.00, 'Solar-powered horloge'],
    ];
    
    // Eerst de tabel leegmaken
    $pdo->exec("DELETE FROM watches");
    echo "🗑️  Oude data verwijderd\n";
    
    // Bereid statement voor
    $stmt = $pdo->prepare("
        INSERT INTO watches (name, brand, price, description, created_at, updated_at) 
        VALUES (?, ?, ?, ?, datetime('now'), datetime('now'))
    ");
    
    // Voeg alle horloges toe
    $count = 0;
    foreach ($watches as $watch) {
        $stmt->execute($watch);
        $count++;
        echo "➕ Toegevoegd: {$watch[1]} {$watch[0]} - €{$watch[2]}\n";
    }
    
    echo "\n🎉 Seeding voltooid! {$count} horloges toegevoegd aan de watches tabel.\n";
    
    // Toon resultaten
    echo "\n📋 Overzicht van alle horloges in de database:\n";
    echo "ID | Merk        | Model                | Prijs      | Beschrijving\n";
    echo "---|-------------|----------------------|------------|----------------------------------\n";
    
    $result = $pdo->query("SELECT * FROM watches ORDER BY brand, name");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        printf("%-2d | %-11s | %-20s | €%-8.2f | %s\n", 
            $row['id'], 
            $row['brand'], 
            $row['name'], 
            $row['price'], 
            substr($row['description'], 0, 30) . '...'
        );
    }
    
} catch (PDOException $e) {
    echo "❌ Fout: " . $e->getMessage() . "\n";
    exit(1);
}