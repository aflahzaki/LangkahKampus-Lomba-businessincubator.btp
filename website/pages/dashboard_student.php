<?php
$page_title = 'Dashboard';
$page_scripts = ['dashboard.js'];
include '../includes/header.php';
require_once $base_path . 'includes/auth_middleware.php';

// Demo user data (would come from session/database in production)
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Anisa Rahmawati';
$user_school = 'SMAN 3 Bandung';
$predictions_count = 8;
$success_rate = 75;
$is_premium = isset($_SESSION['is_premium']) ? $_SESSION['is_premium'] : false;
?>

<div class="dashboard-page">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="container">
            <div class="d-flex align-center justify-between flex-wrap gap-2">
                <div>
                    <h1><i class="fas fa-graduation-cap"></i> Selamat Datang, <?php echo htmlspecialchars($user_name); ?>!</h1>
                    <p><i class="fas fa-school"></i> <?php echo $user_school; ?></p>
                </div>
                <div>
                    <a href="prediksi.php" class="btn btn-primary btn-ripple">
                        <i class="fas fa-plus"></i> Prediksi Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Quick Stats -->
        <div class="dashboard-grid" data-aos="fade-up">
            <div class="stat-card">
                <div class="stat-card-icon blue">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div class="stat-card-info">
                    <h3><?php echo $predictions_count; ?></h3>
                    <p>Prediksi Dibuat</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-card-info">
                    <h3><?php echo $success_rate; ?>%</h3>
                    <p>Rata-rata Peluang</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon orange">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="stat-card-info">
                    <h3><?php echo $is_premium ? 'Premium' : 'Gratis'; ?></h3>
                    <p>Status Akun</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon red">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="stat-card-info">
                    <h3>3</h3>
                    <p>Notifikasi Baru</p>
                </div>
            </div>
        </div>

        <!-- Recent Predictions -->
        <div class="card mb-3" data-aos="fade-up" data-aos-delay="100">
            <div class="d-flex align-center justify-between mb-3">
                <h3><i class="fas fa-history"></i> Prediksi Terbaru</h3>
                <a href="prediksi.php" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Program Studi</th>
                            <th>Universitas</th>
                            <th>Probabilitas</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Teknik Informatika</strong></td>
                            <td>Institut Teknologi Bandung</td>
                            <td><span class="badge badge-success">78%</span></td>
                            <td>10 Jan 2025</td>
                            <td><a href="rekomendasi.php" class="btn btn-sm btn-outline" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);">Detail</a></td>
                        </tr>
                        <tr>
                            <td><strong>Kedokteran</strong></td>
                            <td>Universitas Indonesia</td>
                            <td><span class="badge badge-warning">45%</span></td>
                            <td>8 Jan 2025</td>
                            <td><a href="rekomendasi.php" class="btn btn-sm btn-outline" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);">Detail</a></td>
                        </tr>
                        <tr>
                            <td><strong>Manajemen</strong></td>
                            <td>Universitas Gadjah Mada</td>
                            <td><span class="badge badge-success">82%</span></td>
                            <td>5 Jan 2025</td>
                            <td><a href="rekomendasi.php" class="btn btn-sm btn-outline" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);">Detail</a></td>
                        </tr>
                        <tr>
                            <td><strong>Teknik Elektro</strong></td>
                            <td>Institut Teknologi Sepuluh Nopember</td>
                            <td><span class="badge badge-danger">32%</span></td>
                            <td>3 Jan 2025</td>
                            <td><a href="rekomendasi.php" class="btn btn-sm btn-outline" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);">Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recommended Programs & Charts -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;" class="mb-4">
            <div class="card" data-aos="fade-up" data-aos-delay="200">
                <h4 class="mb-2"><i class="fas fa-star"></i> Program Direkomendasikan</h4>
                <div class="stagger-list">
                    <div class="stat-card mb-1">
                        <div class="stat-card-icon green"><i class="fas fa-university"></i></div>
                        <div class="stat-card-info">
                            <h3 style="font-size:1rem;">Sistem Informasi - ITB</h3>
                            <p>Peluang: 85% | Kompetisi rendah</p>
                        </div>
                    </div>
                    <div class="stat-card mb-1">
                        <div class="stat-card-icon blue"><i class="fas fa-university"></i></div>
                        <div class="stat-card-info">
                            <h3 style="font-size:1rem;">Teknik Komputer - UI</h3>
                            <p>Peluang: 72% | Sesuai profil</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-icon blue"><i class="fas fa-university"></i></div>
                        <div class="stat-card-info">
                            <h3 style="font-size:1rem;">Data Science - UGM</h3>
                            <p>Peluang: 68% | Trending</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="300">
                <h4 class="mb-2"><i class="fas fa-chart-bar"></i> Nilai Rata-rata per Mapel</h4>
                <canvas id="subjectChart" style="width:100%;height:200px;"></canvas>
            </div>
        </div>

        <!-- Undang Guru Section -->
        <div class="card mb-3" data-aos="fade-up" data-aos-delay="400">
            <h4 class="mb-2"><i class="fas fa-user-plus"></i> Undang Guru</h4>
            <p class="text-muted mb-2">Bagikan kode ini ke guru BK Anda untuk mengundang mereka ke LangkahKampus</p>

            <?php
            // Demo invite codes for this student
            $demo_invite_codes = [
                ['code' => 'ABC123', 'is_active' => false, 'used_by' => 'Bu Ratna Sari'],
                ['code' => 'DEF456', 'is_active' => true, 'used_by' => null],
            ];
            $active_codes = array_filter($demo_invite_codes, function($c) { return $c['is_active']; });
            $active_count = count($active_codes);
            ?>

            <div style="background:rgba(26,115,232,0.05);border-radius:var(--radius-sm);padding:1rem;margin-bottom:1rem;">
                <p style="font-size:0.85rem;margin-bottom:0.5rem;"><strong>Kode Aktif (<?php echo $active_count; ?>/2):</strong></p>
                <?php foreach ($demo_invite_codes as $invite): ?>
                <div class="d-flex align-center gap-1 mb-1">
                    <code style="font-size:1.1rem;font-weight:700;letter-spacing:2px;padding:0.25rem 0.75rem;background:var(--color-bg);border-radius:var(--radius-sm);"><?php echo $invite['code']; ?></code>
                    <?php if ($invite['is_active']): ?>
                        <span class="badge badge-success">Aktif</span>
                        <button onclick="navigator.clipboard.writeText('<?php echo $invite['code']; ?>');this.innerHTML='<i class=\'fas fa-check\'></i> Disalin';" class="btn btn-sm btn-outline" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);font-size:0.75rem;">
                            <i class="fas fa-copy"></i> Salin
                        </button>
                    <?php else: ?>
                        <span class="badge badge-warning">Digunakan</span>
                        <small class="text-muted">oleh <?php echo htmlspecialchars($invite['used_by']); ?></small>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if ($active_count < 2): ?>
            <form action="<?php echo $base_path; ?>api/invite.php" method="POST" style="display:inline;">
                <input type="hidden" name="action" value="generate">
                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                <button type="submit" class="btn btn-primary btn-sm btn-ripple">
                    <i class="fas fa-plus-circle"></i> Generate Kode Baru
                </button>
            </form>
            <?php else: ?>
            <p class="text-muted" style="font-size:0.85rem;"><i class="fas fa-info-circle"></i> Anda sudah memiliki 2 kode aktif (maksimal).</p>
            <?php endif; ?>
        </div>

        <!-- Quick Actions -->
        <div class="card mb-4" data-aos="fade-up" data-aos-delay="500">
            <h4 class="mb-2"><i class="fas fa-bolt"></i> Aksi Cepat</h4>
            <div class="d-flex flex-wrap gap-2">
                <a href="prediksi.php" class="btn btn-primary btn-ripple"><i class="fas fa-brain"></i> Prediksi Baru</a>
                <a href="rekomendasi.php" class="btn btn-secondary btn-ripple"><i class="fas fa-lightbulb"></i> Lihat Rekomendasi</a>
                <a href="peta_universitas.php" class="btn btn-success btn-ripple"><i class="fas fa-map"></i> Peta PTN</a>
                <a href="validator.php" class="btn btn-outline btn-ripple" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);"><i class="fas fa-check-double"></i> Validasi Pilihan</a>
                <a href="profil.php" class="btn btn-outline btn-ripple" style="border-color:var(--color-border);color:var(--color-text);"><i class="fas fa-user-edit"></i> Edit Profil</a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
