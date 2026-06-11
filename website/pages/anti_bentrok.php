<?php
$page_title = 'Anti-Bentrok Dashboard';
$page_scripts = ['dashboard.js'];
include '../includes/header.php';

// Demo data for Guru BK view
$school_name = 'SMAN 3 Bandung';
$total_students = 45;
$slots_data = [
    ['program' => 'Teknik Informatika', 'university' => 'ITB', 'quota' => 5, 'chosen' => 4, 'status' => 'terbatas'],
    ['program' => 'Kedokteran', 'university' => 'UI', 'quota' => 3, 'chosen' => 3, 'status' => 'penuh'],
    ['program' => 'Manajemen', 'university' => 'UGM', 'quota' => 8, 'chosen' => 2, 'status' => 'aman'],
    ['program' => 'Teknik Sipil', 'university' => 'ITB', 'quota' => 6, 'chosen' => 5, 'status' => 'terbatas'],
    ['program' => 'Farmasi', 'university' => 'UI', 'quota' => 4, 'chosen' => 1, 'status' => 'aman'],
    ['program' => 'Akuntansi', 'university' => 'UNPAD', 'quota' => 7, 'chosen' => 7, 'status' => 'penuh'],
    ['program' => 'Psikologi', 'university' => 'UGM', 'quota' => 5, 'chosen' => 3, 'status' => 'aman'],
    ['program' => 'Teknik Elektro', 'university' => 'ITS', 'quota' => 4, 'chosen' => 1, 'status' => 'aman'],
];
?>

<div class="dashboard-page">
    <div class="dashboard-header">
        <div class="container">
            <div class="d-flex align-center justify-between flex-wrap gap-2">
                <div>
                    <h1><i class="fas fa-shield-alt"></i> Anti-Bentrok Dashboard</h1>
                    <p><i class="fas fa-school"></i> <?php echo $school_name; ?> | Monitoring Pilihan SNBP</p>
                </div>
                <div class="d-flex gap-1">
                    <button onclick="refreshSlotData()" class="btn btn-primary btn-sm btn-ripple">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                    <button onclick="exportTableToCSV('slotTable', 'anti_bentrok_export.csv')" class="btn btn-outline btn-sm" style="border-color:#fff;color:#fff;">
                        <i class="fas fa-file-excel"></i> Export
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Summary Stats -->
        <div class="dashboard-grid" data-aos="fade-up">
            <div class="stat-card">
                <div class="stat-card-icon blue"><i class="fas fa-users"></i></div>
                <div class="stat-card-info">
                    <h3><?php echo $total_students; ?></h3>
                    <p>Total Siswa Mendaftar</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon green"><i class="fas fa-check-circle"></i></div>
                <div class="stat-card-info">
                    <h3>4</h3>
                    <p>Program Aman</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon orange"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="stat-card-info">
                    <h3>2</h3>
                    <p>Program Terbatas</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon red"><i class="fas fa-times-circle"></i></div>
                <div class="stat-card-info">
                    <h3>2</h3>
                    <p>Program Penuh</p>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="card mb-3" data-aos="fade-up" data-aos-delay="100">
            <div class="d-flex align-center gap-2 flex-wrap">
                <div class="form-group" style="margin-bottom:0;flex:1;min-width:200px;">
                    <input type="text" class="form-control" data-filter-table="slotTable" 
                           placeholder="Cari program studi atau universitas...">
                </div>
                <select class="form-control" style="width:auto;">
                    <option value="">Semua Status</option>
                    <option value="aman">Aman</option>
                    <option value="terbatas">Terbatas</option>
                    <option value="penuh">Penuh</option>
                </select>
            </div>
        </div>

        <!-- Slot Monitoring Table -->
        <div class="card mb-3" data-aos="fade-up" data-aos-delay="200">
            <h3 class="mb-3"><i class="fas fa-table"></i> Monitoring Slot Program Studi</h3>

            <div class="table-responsive">
                <table class="table" id="slotTable">
                    <thead>
                        <tr>
                            <th>Program Studi</th>
                            <th>Universitas</th>
                            <th>Kuota</th>
                            <th>Sudah Memilih</th>
                            <th>Sisa Slot</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($slots_data as $slot):
                            $sisa = $slot['quota'] - $slot['chosen'];
                            $status_class = $slot['status'] === 'aman' ? 'success' : ($slot['status'] === 'terbatas' ? 'warning' : 'danger');
                            $status_text = $slot['status'] === 'aman' ? 'Aman' : ($slot['status'] === 'terbatas' ? 'Terbatas' : 'Penuh');
                            $percentage = ($slot['chosen'] / $slot['quota']) * 100;
                        ?>
                        <tr>
                            <td><strong><?php echo $slot['program']; ?></strong></td>
                            <td><?php echo $slot['university']; ?></td>
                            <td data-slot-animate><?php echo $slot['quota']; ?></td>
                            <td>
                                <?php echo $slot['chosen']; ?>
                                <div class="progress-bar" style="height:4px;margin-top:4px;">
                                    <div class="progress-fill" style="width:<?php echo $percentage; ?>%;background:<?php echo $status_class === 'success' ? 'var(--color-accent-green)' : ($status_class === 'warning' ? 'var(--color-warning)' : 'var(--color-accent-red)'); ?>;"></div>
                                </div>
                            </td>
                            <td><strong><?php echo $sisa; ?></strong></td>
                            <td><span class="badge badge-<?php echo $status_class; ?>"><?php echo $status_text; ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Student List with Conflicts -->
        <div class="card mb-3" data-aos="fade-up" data-aos-delay="300">
            <h3 class="mb-3"><i class="fas fa-exclamation-circle text-red"></i> Peringatan Konflik</h3>
            <p class="text-muted mb-2">Siswa yang memilih program dengan slot penuh atau terbatas</p>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Pilihan 1</th>
                            <th>Pilihan 2</th>
                            <th>Peringatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Budi Santoso</td>
                            <td>Kedokteran - UI</td>
                            <td>Farmasi - UI</td>
                            <td><span class="badge badge-danger">Pilihan 1 PENUH</span></td>
                            <td><button class="btn btn-sm btn-danger">Notifikasi</button></td>
                        </tr>
                        <tr>
                            <td>Siti Nurhaliza</td>
                            <td>Teknik Informatika - ITB</td>
                            <td>Akuntansi - UNPAD</td>
                            <td><span class="badge badge-warning">Kedua pilihan terbatas/penuh</span></td>
                            <td><button class="btn btn-sm btn-danger">Notifikasi</button></td>
                        </tr>
                        <tr>
                            <td>Ahmad Rizki</td>
                            <td>Akuntansi - UNPAD</td>
                            <td>Teknik Sipil - ITB</td>
                            <td><span class="badge badge-danger">Pilihan 1 PENUH</span></td>
                            <td><button class="btn btn-sm btn-danger">Notifikasi</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Suggestions Panel -->
        <div class="card mb-4" data-aos="fade-up" data-aos-delay="400">
            <h3 class="mb-2"><i class="fas fa-lightbulb text-blue"></i> Saran Redistribusi</h3>
            <div style="background:rgba(26,115,232,0.05);border-radius:var(--radius-sm);padding:1.5rem;border-left:4px solid var(--color-accent-blue);">
                <p style="font-size:0.95rem;line-height:1.8;">
                    <strong>Rekomendasi:</strong> Terdapat 3 siswa yang perlu mengubah pilihan program studi karena kuota sudah penuh. 
                    Sarankan program alternatif berikut:
                </p>
                <ul style="margin-top:0.5rem;font-size:0.9rem;line-height:2;color:var(--color-text-light);">
                    <li><i class="fas fa-arrow-right text-green"></i> Budi Santoso: Pertimbangkan <strong>Ilmu Biomedis - UI</strong> (slot tersisa: 3)</li>
                    <li><i class="fas fa-arrow-right text-green"></i> Siti Nurhaliza: Pertimbangkan <strong>Sistem Informasi - ITB</strong> (slot tersisa: 4)</li>
                    <li><i class="fas fa-arrow-right text-green"></i> Ahmad Rizki: Pertimbangkan <strong>Manajemen - UGM</strong> (slot tersisa: 6)</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
