<?php

require_once 'Mahasiswa.php';
require_once 'koneksi.php';

class MahasiswaBidikmisi extends Mahasiswa {
    // Properti tambahan
    protected $nomorKipKuliah;
    protected $danaSakuSubsidi;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $nomorKipKuliah, $danaSakuSubsidi) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    // Getter untuk properti tambahan
    public function getNomorKipKuliah() {
        return $this->nomorKipKuliah;
    }

    public function getDanaSakuSubsidi() {
        return $this->danaSakuSubsidi;
    }

    // Method query (SELECT-WHERE)
    public static function getByNim($nim) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM tabel_mahasiswa WHERE nim = :nim AND jenis_pembiayaan = 'Bidikmisi'");
        $stmt->execute(['nim' => $nim]);
        $row = $stmt->fetch();

        if ($row) {
            return new self(
                $row['id_mahasiswa'],
                $row['nama_mahasiswa'],
                $row['nim'],
                $row['semester'],
                $row['tarif_ukt_nominal'],
                $row['nomor_kip_kuliah'],
                $row['dana_saku_subsidi']
            );
        }
    }

    // Method query to get all Mahasiswa Bidikmisi
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Bidikmisi'");
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = new self(
                $row['id_mahasiswa'],
                $row['nama_mahasiswa'],
                $row['nim'],
                $row['semester'],
                $row['tarif_ukt_nominal'],
                $row['nomor_kip_kuliah'],
                $row['dana_saku_subsidi']
            );
        }
        return $results;
    }

    // Implementasi abstract methods
    public function hitungTagihanSemester() {
        return 0; // Bidikmisi biasanya gratis UKT
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Nomor KIP Kuliah: " . $this->nomorKipKuliah . ", Dana Saku Subsidi: Rp" . number_format($this->danaSakuSubsidi, 0, ',', '.');
    }
}
