<?php

require_once 'Mahasiswa.php';
require_once 'koneksi.php';

class MahasiswaPrestasi extends Mahasiswa {
    // Properti tambahan
    protected $namaInstansiBeasiswa;
    protected $minimalIpkSyarat;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $namaInstansiBeasiswa, $minimalIpkSyarat) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    // Getter untuk properti tambahan
    public function getNamaInstansiBeasiswa() {
        return $this->namaInstansiBeasiswa;
    }

    public function getMinimalIpkSyarat() {
        return $this->minimalIpkSyarat;
    }

    // Method query (SELECT-WHERE)
    public static function getByNim($nim) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM tabel_mahasiswa WHERE nim = :nim AND jenis_pembiayaan = 'Prestasi'");
        $stmt->execute(['nim' => $nim]);
        $row = $stmt->fetch();

        if ($row) {
            return new self(
                $row['id_mahasiswa'],
                $row['nama_mahasiswa'],
                $row['nim'],
                $row['semester'],
                $row['tarif_ukt_nominal'],
                $row['nama_instansi_beasiswa'],
                $row['minimal_ipk_syarat']
            );
        }
    }

    // Method query to get all Mahasiswa Prestasi
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Prestasi'");
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = new self(
                $row['id_mahasiswa'],
                $row['nama_mahasiswa'],
                $row['nim'],
                $row['semester'],
                $row['tarif_ukt_nominal'],
                $row['nama_instansi_beasiswa'],
                $row['minimal_ipk_syarat']
            );
        }
        return $results;
    }

    // Implementasi abstract methods
    public function hitungTagihanSemester() {
        return (float)$this->tarifUktNominal * 0.25;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Nama Instansi Beasiswa: " . $this->namaInstansiBeasiswa . ", Minimal IPK Syarat: " . $this->minimalIpkSyarat;
    }
}
