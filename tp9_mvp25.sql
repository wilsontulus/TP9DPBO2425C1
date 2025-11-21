-- Create database
CREATE DATABASE IF NOT EXISTS tp9_mvp25;
USE tp9_mvp25;

-- Create table tim
CREATE TABLE IF NOT EXISTS tim (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    tahun_berdiri INT NOT NULL
);

-- Create table pembalap
CREATE TABLE IF NOT EXISTS pembalap (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    tim_id INT NOT NULL,
    negara VARCHAR(255) NOT NULL,
    poinMusim INT DEFAULT 0,
    jumlahMenang INT DEFAULT 0,
    FOREIGN KEY (tim_id) REFERENCES tim(id)
);

-- Insert data

INSERT INTO tim (nama, tahun_berdiri) VALUES
('Mercedes', 2010),
('Red Bull', 2012),
('Ferrari', 2004),
('McLaren', 2007),
('AlphaTauri', 2014),
('Alpine', 2016);

INSERT INTO pembalap (nama, tim_id, negara, poinMusim, jumlahMenang) VALUES
('Lewis Hamilton', 1, 'United Kingdom', 347, 11),
('Max Verstappen', 2, 'Netherlands', 335, 10),
('Valtteri Bottas', 1, 'Finland', 203, 2),
('Sergio Perez', 2, 'Mexico', 190, 1),
('Carlos Sainz', 3, 'Spain', 150, 0),
('Daniel Ricciardo', 4, 'Australia', 115, 1),
('Charles Leclerc', 3, 'Monaco', 95, 0),
('Lando Norris', 4, 'United Kingdom', 88, 0),
('Pierre Gasly', 5, 'France', 75, 0),
('Fernando Alonso', 6, 'Spain', 65, 0);