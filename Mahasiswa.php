<?php

abstract class Mahasiswa {
    // Properti Atribut Terenkapsulasi ( protected )
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal; // dipetakan dari kolom tarif_ukt_nominal di database

    // Constructor untuk menginisialisasi properti global
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal) {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->nama_mahasiswa = $nama_mahasiswa;
        $this->nim = $nim;
        $this->semester = $semester;
        $this->tarifUktNominal = $tarifUktNominal;
    }

    // Metode Abstract (Tanpa isi/Body)
    abstract public function hitungTagihanSemester();
    abstract public function tampilkanSpesifikasiAkademik();

    // Getter untuk properti (opsional tapi berguna untuk pembacaan luar kelas)
    public function getIdMahasiswa() {
        return $this->id_mahasiswa;
    }

    public function getNamaMahasiswa() {
        return $this->nama_mahasiswa;
    }

    public function getNim() {
        return $this->nim;
    }

    public function getSemester() {
        return $this->semester;
    }

    public function getTarifUktNominal() {
        return $this->tarifUktNominal;
    }
}
