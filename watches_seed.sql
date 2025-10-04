-- SQL Script om watches tabel te vullen met testdata
-- Voor gebruik in SQLite database

-- Watches tabel aanmaken
CREATE TABLE IF NOT EXISTS watches (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    brand VARCHAR(255) NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Oude data verwijderen (optioneel)
DELETE FROM watches;

-- Watches data invoegen
INSERT INTO watches (name, brand, price, description) VALUES 
('Rolex Submariner', 'Rolex', 8500.00, 'Luxe duikhorloge met automatisch uurwerk'),
('Omega Speedmaster', 'Omega', 4200.00, 'Beroemd maanhorloge met chronograaf'),
('Seiko 5', 'Seiko', 150.00, 'Betaalbaar automatisch horloge'),
('Casio G-Shock', 'Casio', 89.99, 'Schokbestendige digitale horloge'),
('Apple Watch', 'Apple', 399.00, 'Smartwatch met health tracking'),
('TAG Heuer Carrera', 'TAG Heuer', 2200.00, 'Zwitserse luxe sporthorloge'),
('Tissot PRC 200', 'Tissot', 300.00, 'Zwitserse sporthorloge voor actieve mensen'),
('Citizen Eco-Drive', 'Citizen', 180.00, 'Solar-powered horloge met lange batterijduur'),
('Hamilton Khaki Field', 'Hamilton', 450.00, 'Militaire stijl veldhorloge'),
('Fossil Grant', 'Fossil', 120.00, 'Klassiek chronograaf horloge');

-- Resultaat tonen
SELECT 'Data succesvol toegevoegd!' as Status;
SELECT COUNT(*) as 'Aantal horloges' FROM watches;
SELECT * FROM watches ORDER BY brand, name;