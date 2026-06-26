<?php
// Load all model classes
require_once 'koneksi.php';
require_once 'Mahasiswa.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

// Fetch all students based on their categories
$mandiriList = MahasiswaMandiri::getAll();
$bidikmisiList = MahasiswaBidikmisi::getAll();
$prestasiList = MahasiswaPrestasi::getAll();

// Calculate total statistics
$countMandiri = count($mandiriList);
$countBidikmisi = count($bidikmisiList);
$countPrestasi = count($prestasiList);
$totalMahasiswa = $countMandiri + $countBidikmisi + $countPrestasi;

// Calculate total revenue / billing tagihan
$totalTagihan = 0;
foreach ($mandiriList as $m) {
    $totalTagihan += $m->hitungTagihanSemester();
}
foreach ($bidikmisiList as $m) {
    $totalTagihan += $m->hitungTagihanSemester();
}
foreach ($prestasiList as $m) {
    $totalTagihan += $m->hitungTagihanSemester();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Registrasi Pembayaran Kuliah Mahasiswa - UAS PBO">
    <title>Registrasi Pembayaran Kuliah Mahasiswa</title>
    <!-- Custom Style Sheet -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <!-- Header -->
        <header>
            <h1 id="main-title">Registrasi Pembayaran Kuliah</h1>
            <p id="sub-title">Sistem Pemantauan dan Pengelolaan Tagihan UKT Mahasiswa - UAS PBO</p>
        </header>

        <!-- Stats Grid Dashboard -->
        <section class="stats-grid" aria-label="Statistik Mahasiswa">
            <!-- Total Mahasiswa -->
            <div class="stat-card total-border" id="card-stat-total">
                <h3>Total Registrasi</h3>
                <div class="stat-value"><?= $totalMahasiswa ?></div>
                <p style="color: var(--text-secondary); margin-top: 5px; font-size: 0.85rem;">Mahasiswa Terdaftar</p>
            </div>

            <!-- Mahasiswa Mandiri -->
            <div class="stat-card mandiri-border" id="card-stat-mandiri">
                <h3 style="color: var(--mandiri-color);">Jalur Mandiri</h3>
                <div class="stat-value text-highlight-mandiri"><?= $countMandiri ?></div>
                <p style="color: var(--text-secondary); margin-top: 5px; font-size: 0.85rem;">Registrasi Mandiri</p>
            </div>

            <!-- Mahasiswa Bidikmisi -->
            <div class="stat-card bidikmisi-border" id="card-stat-bidikmisi">
                <h3 style="color: var(--bidikmisi-color);">Jalur Bidikmisi</h3>
                <div class="stat-value text-highlight-bidikmisi"><?= $countBidikmisi ?></div>
                <p style="color: var(--text-secondary); margin-top: 5px; font-size: 0.85rem;">Penerima KIP-Kuliah</p>
            </div>

            <!-- Mahasiswa Prestasi -->
            <div class="stat-card prestasi-border" id="card-stat-prestasi">
                <h3 style="color: var(--prestasi-color);">Jalur Prestasi</h3>
                <div class="stat-value text-highlight-prestasi"><?= $countPrestasi ?></div>
                <p style="color: var(--text-secondary); margin-top: 5px; font-size: 0.85rem;">Beasiswa Prestasi</p>
            </div>

            <!-- Total Proyeksi Tagihan -->
            <div class="stat-card" style="grid-column: 1 / -1; border-color: rgba(255, 255, 255, 0.15);" id="card-stat-revenue">
                <h3>Total Proyeksi Tagihan Semester Ini</h3>
                <div class="stat-value" style="font-size: 2.2rem; background: linear-gradient(135deg, #fff 0%, #a0aec0 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    Rp <?= number_format($totalTagihan, 0, ',', '.') ?>
                </div>
            </div>
        </section>

        <!-- Navigation Tabs -->
        <div class="tabs-container">
            <div class="tabs-nav" role="tablist">
                <button class="tab-btn active" data-type="mandiri" onclick="switchTab('mandiri')" role="tab" id="tab-btn-mandiri">
                    Mahasiswa Mandiri
                </button>
                <button class="tab-btn" data-type="bidikmisi" onclick="switchTab('bidikmisi')" role="tab" id="tab-btn-bidikmisi">
                    Mahasiswa Bidikmisi
                </button>
                <button class="tab-btn" data-type="prestasi" onclick="switchTab('prestasi')" role="tab" id="tab-btn-prestasi">
                    Mahasiswa Prestasi
                </button>
            </div>
        </div>

        <!-- Tab Panels -->
        <!-- 1. PANEL MANDIRI -->
        <div class="tab-panel active" id="panel-mandiri" role="tabpanel">
            <div class="table-card">
                <div class="table-header-desc">
                    <h2>Daftar Mahasiswa Jalur Mandiri</h2>
                    <span class="badge mandiri">Skema Mandiri</span>
                </div>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th class="text-center">Semester</th>
                                <th class="text-right">Tarif UKT Asli</th>
                                <th class="text-right">Tagihan Semester (+Biaya Ops)</th>
                                <th>Spesifikasi Akademik</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($mandiriList)): ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data mahasiswa mandiri.</td>
                                </tr>
                            <?php else: 
                                $no = 1;
                                foreach ($mandiriList as $m): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-bold"><?= htmlspecialchars($m->getNim()) ?></td>
                                        <td><?= htmlspecialchars($m->getNamaMahasiswa()) ?></td>
                                        <td class="text-center"><?= htmlspecialchars($m->getSemester()) ?></td>
                                        <td class="text-right">Rp <?= number_format($m->getTarifUktNominal(), 0, ',', '.') ?></td>
                                        <td class="text-right text-bold text-highlight-mandiri">Rp <?= number_format($m->hitungTagihanSemester(), 0, ',', '.') ?></td>
                                        <td><span class="tag-spec"><?= htmlspecialchars($m->tampilkanSpesifikasiAkademik()) ?></span></td>
                                    </tr>
                                <?php endforeach; 
                            endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 2. PANEL BIDIKMISI -->
        <div class="tab-panel" id="panel-bidikmisi" role="tabpanel">
            <div class="table-card">
                <div class="table-header-desc">
                    <h2>Daftar Mahasiswa Jalur Bidikmisi</h2>
                    <span class="badge bidikmisi">KIP-Kuliah</span>
                </div>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th class="text-center">Semester</th>
                                <th class="text-right">Tarif UKT Asli</th>
                                <th class="text-right">Tagihan Semester</th>
                                <th>Spesifikasi Akademik</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($bidikmisiList)): ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data mahasiswa bidikmisi.</td>
                                </tr>
                            <?php else: 
                                $no = 1;
                                foreach ($bidikmisiList as $m): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-bold"><?= htmlspecialchars($m->getNim()) ?></td>
                                        <td><?= htmlspecialchars($m->getNamaMahasiswa()) ?></td>
                                        <td class="text-center"><?= htmlspecialchars($m->getSemester()) ?></td>
                                        <td class="text-right">Rp <?= number_format($m->getTarifUktNominal(), 0, ',', '.') ?></td>
                                        <td class="text-right text-bold text-highlight-bidikmisi">Rp <?= number_format($m->hitungTagihanSemester(), 0, ',', '.') ?></td>
                                        <td><span class="tag-spec"><?= htmlspecialchars($m->tampilkanSpesifikasiAkademik()) ?></span></td>
                                    </tr>
                                <?php endforeach; 
                            endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 3. PANEL PRESTASI -->
        <div class="tab-panel" id="panel-prestasi" role="tabpanel">
            <div class="table-card">
                <div class="table-header-desc">
                    <h2>Daftar Mahasiswa Jalur Prestasi</h2>
                    <span class="badge prestasi">Beasiswa</span>
                </div>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th class="text-center">Semester</th>
                                <th class="text-right">Tarif UKT Asli</th>
                                <th class="text-right">Tagihan (Potongan 75%)</th>
                                <th>Spesifikasi Akademik</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($prestasiList)): ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data mahasiswa prestasi.</td>
                                </tr>
                            <?php else: 
                                $no = 1;
                                foreach ($prestasiList as $m): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-bold"><?= htmlspecialchars($m->getNim()) ?></td>
                                        <td><?= htmlspecialchars($m->getNamaMahasiswa()) ?></td>
                                        <td class="text-center"><?= htmlspecialchars($m->getSemester()) ?></td>
                                        <td class="text-right">Rp <?= number_format($m->getTarifUktNominal(), 0, ',', '.') ?></td>
                                        <td class="text-right text-bold text-highlight-prestasi">Rp <?= number_format($m->hitungTagihanSemester(), 0, ',', '.') ?></td>
                                        <td><span class="tag-spec"><?= htmlspecialchars($m->tampilkanSpesifikasiAkademik()) ?></span></td>
                                    </tr>
                                <?php endforeach; 
                            endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Tab Switching Logic -->
    <script>
        function switchTab(type) {
            // Deactivate all tab buttons
            const tabButtons = document.querySelectorAll('.tab-btn');
            tabButtons.forEach(btn => btn.classList.remove('active'));

            // Deactivate all tab panels
            const panels = document.querySelectorAll('.tab-panel');
            panels.forEach(panel => panel.classList.remove('active'));

            // Activate current tab button
            const activeBtn = document.querySelector(`.tab-btn[data-type="${type}"]`);
            if (activeBtn) {
                activeBtn.classList.add('active');
            }

            // Activate current panel
            const activePanel = document.getElementById(`panel-${type}`);
            if (activePanel) {
                activePanel.classList.add('active');
            }
        }
    </script>
</body>
</html>
