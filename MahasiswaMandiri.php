<?php

require_once 'Mahasiswa.php';
require_once 'koneksi.php';

class MahasiswaMandiri extends Mahasiswa {
    // Properti tambahan
    protected $golonganUKT;
    protected $namaWali;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $golonganUKT, $namaWali) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->golonganUKT = $golonganUKT;
        $this->namaWali = $namaWali;
    }

    // Getter untuk properti tambahan
    public function getGolonganUKT() {
        return $this->golonganUKT;
    }

    public function getNamaWali() {
        return $this->namaWali;
    }

    // Method query (SELECT-WHERE)
    public static function getByNim($nim) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM tabel_mahasiswa WHERE nim = :nim AND jenis_pembiayaan = 'Mandiri'");
        $stmt->execute(['nim' => $nim]);
        $row = $stmt->fetch();

        if ($row) {
            return new self(
                $row['id_mahasiswa'],
                $row['nama_mahasiswa'],
                $row['nim'],
                $row['semester'],
                $row['tarif_ukt_nominal'],
                $row['golongan_ukt'],
                $row['nama_wali']
            );
        }
    }

    // Method query to get all Mahasiswa Mandiri
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri'");
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = new self(
                $row['id_mahasiswa'],
                $row['nama_mahasiswa'],
                $row['nim'],
                $row['semester'],
                $row['tarif_ukt_nominal'],
                $row['golongan_ukt'],
                $row['nama_wali']
            );
        }
        return $results;
    }

    // Implementasi abstract methods
    public function hitungTagihanSemester() {
        return (float)$this->tarifUktNominal + 100000;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Golongan UKT: " . $this->golonganUKT . ", Nama Wali: " . $this->namaWali;
    }
}
