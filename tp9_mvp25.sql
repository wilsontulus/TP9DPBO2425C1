-- Create database
CREATE DATABASE IF NOT EXISTS tp9_mvp25;
USE tp9_mvp25;

-- Create table tim
CREATE TABLE IF NOT EXISTS tim (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL
);

-- Create table pembalap
CREATE TABLE IF NOT EXISTS pembalap (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    tim VARCHAR(255) NOT NULL,
    negara VARCHAR(255) NOT NULL,
    poinMusim INT DEFAULT 0,
    jumlahMenang INT DEFAULT 0
);

-- Insert data

INSERT INTO tim (nama) VALUES
('Mercedes'),
('Red Bull'),
('Ferrari'),
('McLaren'),
('AlphaTauri'),
('Alpine');

INSERT INTO pembalap (nama, tim, negara, poinMusim, jumlahMenang) VALUES
('Lewis Hamilton', 'Mercedes', 'United Kingdom', 347, 11),
('Max Verstappen', 'Red Bull', 'Netherlands', 335, 10),
('Valtteri Bottas', 'Mercedes', 'Finland', 203, 2),
('Sergio Perez', 'Red Bull', 'Mexico', 190, 1),
('Carlos Sainz', 'Ferrari', 'Spain', 150, 0),
('Daniel Ricciardo', 'McLaren', 'Australia', 115, 1),
('Charles Leclerc', 'Ferrari', 'Monaco', 95, 0),
('Lando Norris', 'McLaren', 'United Kingdom', 88, 0),
('Pierre Gasly', 'AlphaTauri', 'France', 75, 0),
('Fernando Alonso', 'Alpine', 'Spain', 65, 0);