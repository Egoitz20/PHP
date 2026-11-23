-- WES - 1. ebaluazioa - Azterketa
-- Sortu datu-basea ondorengo izenarekin: E1Azterketa.
-- CREATE DATABASE E1Azterketa CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
-- Mugitu sortu berri dugun datu-basera.
-- USE E1Azterketa;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS mendiak;

-- Sortu mendiak taula.
--   altuera:    metrotan
--   distantzia: ohiko igoera-ibilbidearen luzera, kilometrotan
--   desnibela:  ohiko igoera-ibilbidearen desnibel positiboa, metrotan
CREATE TABLE mendiak (
    id INT AUTO_INCREMENT PRIMARY KEY,
    izena VARCHAR(100) NOT NULL,
    lurraldea VARCHAR(20) NOT NULL,
    altuera INT NOT NULL,
    distantzia DECIMAL(4,1) NOT NULL,
    desnibela INT NOT NULL
);

-- Hasierako datuak.
INSERT INTO mendiak (izena, lurraldea, altuera, distantzia, desnibela) VALUES
('Gorbeia',      'Araba',    1482, 12.5, 1010),
('Anboto',       'Bizkaia',  1331,  9.0, 1080),
('Oiz',          'Bizkaia',  1026,  8.5,  640),
('Ganekogorta',  'Bizkaia',   998, 11.0,  780),
('Serantes',     'Bizkaia',   451,  4.5,  420),
('Sollube',      'Bizkaia',   684,  7.0,  470),
('Kolitza',      'Bizkaia',   879,  9.5,  610),
('Txindoki',     'Gipuzkoa', 1346, 10.0, 1050),
('Aitzkorri',    'Gipuzkoa', 1528, 14.0, 1100),
('Hernio',       'Gipuzkoa', 1075,  9.0,  760),
('Adarra',       'Gipuzkoa',  811,  8.0,  590),
('Jaizkibel',    'Gipuzkoa',  543,  6.5,  500),
('Aiako Harria', 'Gipuzkoa',  832,  7.5,  540),
('Kapildui',     'Araba',    1177, 10.5,  480),
('Aratz',        'Araba',    1442, 11.5,  720),
('Toloño',       'Araba',    1271, 13.0,  690),
('Orhi',         'Nafarroa', 2021,  6.0,  700),
('Beriain',      'Nafarroa', 1493,  9.5, 1020),
('Larrun',       'Nafarroa',  905, 10.0,  830),
('Mendaur',      'Nafarroa', 1131,  8.0,  460);
