-- Buat basis data relasional pada Mysql dengan format DB_UAS_PBO_RPL1A_DAPOTMATTHEWTAMPUBOLON
CREATE DATABASE IF NOT EXISTS DB_UAS_PBO_RPL1A_DAPOTMATTHEWTAMPUBOLON;
USE DB_UAS_PBO_RPL1A_DAPOTMATTHEWTAMPUBOLON;

-- Rancang satu tabel terpusat bernama tabel_mahasiswa dengan ketentuan struktur kolom yang mencakup seluruh atribut objek
DROP TABLE IF EXISTS tabel_mahasiswa;

CREATE TABLE tabel_mahasiswa (
    -- Atribut Global (induk)
    id_mahasiswa INT AUTO_INCREMENT PRIMARY KEY,
    nama_mahasiswa VARCHAR(100) NOT NULL,
    nim VARCHAR(20) NOT NULL UNIQUE,
    semester INT NOT NULL,
    tarif_ukt_nominal DECIMAL(12, 2) NOT NULL,
    jenis_pembiayaan ENUM('Mandiri', 'Bidikmisi', 'Prestasi') NOT NULL,

    -- Atribut Spesifik (Anak - Set Menjadi Nullable)
    -- Spesifik Mandiri
    golongan_ukt VARCHAR(50) DEFAULT NULL,
    nama_wali VARCHAR(100) DEFAULT NULL,

    -- Spesifik Bidikmisi
    nomor_kip_kuliah VARCHAR(50) DEFAULT NULL,
    dana_saku_subsidi DECIMAL(12, 2) DEFAULT NULL,

    -- Spesifik Prestasi
    nama_instansi_beasiswa VARCHAR(100) DEFAULT NULL,
    minimal_ipk_syarat DECIMAL(3, 2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Isilah tabel tersebut dengan minimal 2 data sampel untuk masing-masing jenis pembiayaan mahasiswa (total minimal 20 data baris)
INSERT INTO tabel_mahasiswa (
    nama_mahasiswa, 
    nim, 
    semester, 
    tarif_ukt_nominal, 
    jenis_pembiayaan, 
    golongan_ukt, 
    nama_wali, 
    nomor_kip_kuliah, 
    dana_saku_subsidi, 
    nama_instansi_beasiswa, 
    minimal_ipk_syarat
) VALUES 
-- 1. Mandiri
('Matthew Tampubolon', '2201001', 4, 4500000.00, 'Mandiri', 'Golongan IV', 'Jonah Tampubolon', NULL, NULL, NULL, NULL),
('Rian Sitorus', '2201002', 4, 5000000.00, 'Mandiri', 'Golongan V', 'Arnold Sitorus', NULL, NULL, NULL, NULL),
('Sarah Nainggolan', '2201003', 2, 4500000.00, 'Mandiri', 'Golongan IV', 'Robert Nainggolan', NULL, NULL, NULL, NULL),
('Budi Santoso', '2201004', 6, 6000000.00, 'Mandiri', 'Golongan VI', 'Supardi Santoso', NULL, NULL, NULL, NULL),
('David Panjaitan', '2201005', 2, 4500000.00, 'Mandiri', 'Golongan IV', 'Herman Panjaitan', NULL, NULL, NULL, NULL),
('Elizabeth Simanjuntak', '2201006', 4, 5000000.00, 'Mandiri', 'Golongan V', 'Piter Simanjuntak', NULL, NULL, NULL, NULL),
('Ferry Siregar', '2201007', 6, 4500000.00, 'Mandiri', 'Golongan IV', 'Sahat Siregar', NULL, NULL, NULL, NULL),

-- 2. Bidikmisi
('Andi Wijaya', '2201008', 4, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-2201008-01', 800000.00, NULL, NULL),
('Cici Paramida', '2201009', 4, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-2201009-02', 800000.00, NULL, NULL),
('Deni Ramadhan', '2201010', 2, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-2201010-03', 750000.00, NULL, NULL),
('Eka Saputra', '2201011', 6, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-2201011-04', 850000.00, NULL, NULL),
('Fitri Handayani', '2201012', 2, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-2201012-05', 750000.00, NULL, NULL),
('Guntur Prabowo', '2201013', 4, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-2201013-06', 800000.00, NULL, NULL),
('Hani Lestari', '2201014', 6, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-2201014-07', 850000.00, NULL, NULL),

-- 3. Prestasi
('Ivan Christo', '2201015', 4, 1500000.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50),
('Jessica Mila', '2201016', 4, 1000000.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Yayasan BCA', 3.60),
('Kevin Sanjaya', '2201017', 2, 1200000.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Tanoto Foundation', 3.40),
('Lisa Lestari', '2201018', 6, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Pertamina Sobat Bumi', 3.50),
('Mega Utami', '2201019', 2, 1500000.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Kemenristekdikti', 3.30),
('Nando Sinaga', '2201020', 6, 800000.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Unggulan', 3.75);
