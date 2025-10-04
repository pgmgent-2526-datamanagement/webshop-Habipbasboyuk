<?php
// Script om watches tabel aan te maken en te vullen
try {
    $database_path = __DIR__ . '/database/database.sqlite';
    
    // Check of het bestand bestaat
    if (!file_exists($database_path)) {
        touch($database_path);
        echo "📁 SQLite database bestand aangemaakt.\n";
    }
    
    // Verbind met SQLite database
    $pdo = new PDO("sqlite:$database_path");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "🔗 Verbonden met SQLite database.\n";
    
    // Maak watches tabel aan
    $createTableSQL = "
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
    
    $pdo->exec($createTableSQL);
    echo "✅ Watches tabel aangemaakt.\n";
    
    // Verwijder oude data
    $pdo->exec("DELETE FROM watches");
    echo "🗑️  Oude data verwijderd.\n";
    
    // Voeg watches data toe
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
    
    $stmt = $pdo->prepare("
        INSERT INTO watches (name, brand, price, description, created_at, updated_at) 
        VALUES (?, ?, ?, ?, datetime('now'), datetime('now'))
    ");
    
    $count = 0;
    foreach ($watches as $watch) {
        $stmt->execute($watch);
        $count++;
        echo "➕ Toegevoegd: {$watch[1]} {$watch[0]} - €{$watch[2]}\n";
    }
    
    echo "\n🎉 Database setup voltooid! {$count} horloges toegevoegd.\n";
    
    // Toon overzicht
    echo "\n📋 Overzicht van alle horloges:\n";
    echo str_repeat("-", 80) . "\n";
    
    $result = $pdo->query("SELECT * FROM watches ORDER BY brand, name");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        printf("ID: %-2d | %-11s | %-20s | €%-8.2f\n", 
            $row['id'], 
            $row['brand'], 
            $row['name'], 
            $row['price']
        );
    }
    
    echo str_repeat("-", 80) . "\n";
    echo "✅ Je Laravel applicatie kan nu de watches ophalen uit de database!\n";
    echo "🌐 Ga naar: http://127.0.0.1:8000\n";
    
} catch (PDOException $e) {
    echo "❌ Database fout: " . $e->getMessage() . "\n";
    echo "💡 Probeer: composer require doctrine/dbal\n";
    echo "💡 Of gebruik MySQL/MariaDB in plaats van SQLite\n";
    exit(1);
} catch (Exception $e) {
    echo "❌ Algemene fout: " . $e->getMessage() . "\n";
    exit(1);
}
?>