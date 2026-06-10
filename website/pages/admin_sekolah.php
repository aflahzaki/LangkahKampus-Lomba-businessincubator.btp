<?php
$page_title = 'Dashboard Admin Sekolah';
$page_scripts = ['dashboard.js'];
include '../includes/header.php';

// Demo data
$school_data = [
    'name' => 'SMAN 3 Bandung',
    'npsn' => '20219321',
    'accreditation' => 'A',
    'total_students' => 1250,
    'registered_users' => 320,
    'subscription' => 'Pro'
];
?>

<div class="dashboard-page">
    <div class="dashboard-header">
        <div class="container">
            <div class="d-flex align-center justify-between flex-wrap gap-2">
                <div>
                    <h1><i class="fas fa-school"></i> Admin Sekolah</h1>
                    <p><?php echo $school_data['name']; ?> | NPSN: <?php echo $school_data['npsn']; ?></p>
                </div>
                <div>
                    <span class="badge badge-success" style="font-size:0.9rem;padding:0.5rem 1rem;">
                        <i class="fas fa-crown"></i> Paket <?php echo $school_data['subscription']; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Stats Overview -->
        <div class="dashboard-grid" data-aos="fade-up">
            <div class="stat-card">
                <div class="stat-card-icon blue"><i class="fas fa-users"></i></div>
                <div class="stat-card-info">
                    <h3><?php echo $school_data['total_students']; ?></h3>
                    <p>Total Siswa</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon green"><i class="fas fa-user-check"></i></div>
                <div class="stat-card-info">
                    <h3><?php echo $school_data['registered_users']; ?></h3>
                    <p>Terdaftar LangkahKampus</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon orange"><i class="fas fa-chart-pie"></i></div>
                <div class="stat-card-info">
                    <h3>156</h3>
                    <p>Prediksi Dibuat</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon red"><i class="fas fa-percentage"></i></div>
                <div class="stat-card-info">
                    <h3>72%</h3>
                    <p>Success Rate SNBP</p>
                </div>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;" class="mb-3">
            <!-- Acceptance Rate Chart -->
            <div class="card" data-aos="fade-up" data-aos-delay="100">
                <h4 class="mb-2"><i class="fas fa-chart-bar"></i> Success Rate SNBP per Tahun</h4>
                <canvas id="acceptanceChart" style="width:100%;height:200px;"></canvas>
            </div>

            <!-- Popular Programs -->
            <div class="card" data-aos="fade-up" data-aos-delay="200">
                <h4 class="mb-2"><i class="fas fa-star"></i> Program Studi Populer</h4>
                <div style="font-size:0.9rem;">
                    <div class="d-flex align-center justify-between p-2" style="border-bottom:1px solid var(--color-border);">
                        <span>1. Teknik Informatika - ITB</span>
                        <span class="badge badge-info">15 siswa</span>
                    </div>
                    <div class="d-flex align-center justify-between p-2" style="border-bottom:1px solid var(--color-border);">
                        <span>2. Kedokteran - UI</span>
                        <span class="badge badge-info">12 siswa</span>
                    </div>
                    <div class="d-flex align-center justify-between p-2" style="border-bottom:1px solid var(--color-border);">
                        <span>3. Manajemen - UGM</span>
                        <span class="badge badge-info">10 siswa</span>
                    </div>
                    <div class="d-flex align-center justify-between p-2" style="border-bottom:1px solid var(--color-border);">
                        <span>4. Hukum - UNPAD</span>
                        <span class="badge badge-info">8 siswa</span>
                    </div>
                    <div class="d-flex align-center justify-between p-2">
                        <span>5. Farmasi - UI</span>
                        <span class="badge badge-info">7 siswa</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Management Table -->
        <div class="card mb-3" data-aos="fade-up" data-aos-delay="300">
            <div class="d-flex align-center justify-between mb-3 flex-wrap gap-2">
                <h3><i class="fas fa-users"></i> Manajemen Siswa</h3>
                <div class="d-flex gap-1">
                    <input type="text" class="form-control" data-filter-table="studentTable" 
                           placeholder="Cari siswa..." style="width:250px;">
                    <button class="btn btn-sm btn-primary btn-ripple"><i class="fas fa-upload"></i> Upload Batch</button>
                    <button class="btn btn-sm btn-outline" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);" 
                            onclick="exportTableToCSV('studentTable', 'siswa_export.csv')">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table" id="studentTable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Peringkat</th>
                            <th>Prediksi Tertinggi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Anisa Rahmawati</strong></td>
                            <td>XII</td>
                            <td>IPA</td>
                            <td>5</td>
                            <td><span class="badge badge-success">78% - TI ITB</span></td>
                            <td><span class="badge badge-info">Premium</span></td>
                        </tr>
                        <tr>
                            <td><strong>Budi Santoso</strong></td>
                            <td>XII</td>
                            <td>IPA</td>
                            <td>12</td>
                            <td><span class="badge badge-warning">52% - Kedokteran UI</span></td>
                            <td><span class="badge badge-info">Gratis</span></td>
                        </tr>
                        <tr>
                            <td><strong>Citra Dewi</strong></td>
                            <td>XII</td>
                            <td>IPS</td>
                            <td>3</td>
                            <td><span class="badge badge-success">85% - Manajemen UGM</span></td>
                            <td><span class="badge badge-info">Premium</span></td>
                        </tr>
                        <tr>
                            <td><strong>Dimas Pratama</strong></td>
                            <td>XII</td>
                            <td>IPA</td>
                            <td>8</td>
                            <td><span class="badge badge-success">71% - T.Elektro ITS</span></td>
                            <td><span class="badge badge-info">Gratis</span></td>
                        </tr>
                        <tr>
                            <td><strong>Eka Putri</strong></td>
                            <td>XII</td>
                            <td>IPA</td>
                            <td>2</td>
                            <td><span class="badge badge-success">90% - Farmasi UI</span></td>
                            <td><span class="badge badge-info">Premium</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Guru BK Management -->
        <div class="card mb-4" data-aos="fade-up" data-aos-delay="400">
            <h3 class="mb-3"><i class="fas fa-chalkboard-teacher"></i> Kelola Akun Guru BK</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Siswa Binaan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Hendra Wijaya, S.Pd.</strong></td>
                            <td>hendra.bk@sman3bdg.sch.id</td>
                            <td>45 siswa</td>
                            <td><span class="badge badge-success">Aktif</span></td>
                            <td><button class="btn btn-sm btn-outline" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);">Edit</button></td>
                        </tr>
                        <tr>
                            <td><strong>Siti Aminah, M.Pd.</strong></td>
                            <td>siti.bk@sman3bdg.sch.id</td>
                            <td>38 siswa</td>
                            <td><span class="badge badge-success">Aktif</span></td>
                            <td><button class="btn btn-sm btn-outline" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);">Edit</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-primary btn-sm mt-2 btn-ripple"><i class="fas fa-plus"></i> Tambah Guru BK</button>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
