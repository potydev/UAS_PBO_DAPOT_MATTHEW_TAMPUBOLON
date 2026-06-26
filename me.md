Tahap 1 : Konfigurasi Basis Data (mysql)
- Buat basis data relasional pada Mysql dengan format DB_UAS_PBO_RPL1A_DAPOTMATTHEWTAMPUBOLON
- Rancang satu tabel terpusat bernama tabel_mahasiswa dengan ketentuan struktur kolom yang mencakup seluruh atribut objek sebagai berikut :
   1. Atribut Global (induk) id_mahasiswa (PRIMARY KEY), nama_mahasiswa, nim, semester, tarif_ukt_nominal, dan jenis_pembiayaan,(Enum :  Mandiri, Bidikmisi, Prestasi)
   2. Atribut Spesifik (Anak - Set Menjadi Nullable): golongan_ukt, nama_wali, nomor_kip_kuliah, dana_saku_subsidi, nama_instansi_beasiswa, dan minimal_ipk_syarat.
-  isilah tabel tersebut dengan minimal 2 data sampel untuk masing - masing jenis pembiayaan mahasiswa (total minimal 20 data baris)


tahap 2 :  Manajemen Repositori Github dan ketentuan Komit
- Buat Repositori Github publik dengan nama: UAS_PBO_DAPOTMATTHEWTAMPUBOLON
- Ekspor basis data anda menjadi file .sql dan masukkan ke dalam proyek
- Aturan Komit, Contoh: [ Tahap 3 ] Membuat abstract class Mahasiswa dan methods
harus di awalali dengan nomor tahapan soal