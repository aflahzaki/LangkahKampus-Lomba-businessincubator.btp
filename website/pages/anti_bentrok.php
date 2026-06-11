<?php
$page_title = 'Statistik Anti-Bentrok';
$page_scripts = ['dashboard.js'];
include '../includes/header.php';
require_once $base_path . 'includes/auth_middleware.php';
require_role(['student']);

// Demo student info
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Ahmad Rizki Pratama';
$user_school = 'SMAN 3 Bandung';

// Demo prediction results with peer statistics
$predictions = [
    [
        'program' => 'Teknik Informatika',
        'university' => 'Institut Teknologi Bandung',
        'probability' => 78,
        'peer_count' => 4,
    ],
    [
        'program' => 'Kedokteran',
        'university' => 'Universitas Indonesia',
        'probability' => 45,
        'peer_count' => 2,
    ],
    [
        'program' => 'Manajemen',
        'university' => 'Universitas Gadjah Mada',
        'probability' => 82,
        'peer_count' => 1,
    ],
];
?>

<div class="dashboard-page">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="container">
            <div class="d-flex align-center justify-between flex-wrap gap-2">
                <div>
                    <h1><i class="fas fa-shield-alt"></i> Statistik Anti-Bentrok</h1>
                    <p><i class="fas fa-school"></i> <?php echo htmlspecialchars($user_school); ?> | Informasi Strategi SNBP</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Info Banner -->
        <div class="card mb-3" data-aos="fade-up">
            <div style="background:rgba(26,115,232,0.05);border-radius:var(--radius-sm);padding:1.5rem;border-left:4px solid var(--color-accent-blue);">
                <h4 style="margin-bottom:0.5rem;"><i class="fas fa-info-circle text-blue"></i> Tentang Statistik Anti-Bentrok</h4>
                <p style="font-size:0.9rem;color:var(--color-text-light);">
                    Fitur ini menunjukkan berapa banyak siswa lain dari sekolahmu yang juga memilih program studi yang sama. 
                    Gunakan informasi ini untuk mempertimbangkan strategi pemilihan SNBP Anda.
                </p>
            </div>
        </div>

        <!-- Prediction Results with Peer Statistics -->
        <div class="card mb-3" data-aos="fade-up" data-aos-delay="100">
            <h3 class="mb-3"><i class="fas fa-chart-bar"></i> Prediksi Anda & Statistik Sekolah</h3>

            <?php foreach ($predictions as $index => $pred):
                $color_class = $pred['probability'] >= 70 ? 'success' : ($pred['probability'] >= 40 ? 'warning' : 'danger');
                $peer_status = $pred['peer_count'] >= 4 ? 'danger' : ($pred['peer_count'] >= 2 ? 'warning' : 'success');
                $peer_message = $pred['peer_count'] >= 4 ? 'Tinggi - pertimbangkan alternatif' : ($pred['peer_count'] >= 2 ? 'Sedang' : 'Rendah - peluang lebih baik');
            ?>
            <div style="border:1px solid var(--color-border);border-radius:var(--radius-sm);padding:1.25rem;margin-bottom:1rem;">
                <div class="d-flex align-center justify-between flex-wrap gap-1 mb-2">
                    <div>
                        <h4 style="margin:0;"><?php echo htmlspecialchars($pred['program']); ?></h4>
                        <small class="text-muted"><?php echo htmlspecialchars($pred['university']); ?></small>
                    </div>
                    <span class="badge badge-<?php echo $color_class; ?>"><?php echo $pred['probability']; ?>% peluang</span>
                </div>

                <div style="background:rgba(<?php echo $peer_status === 'danger' ? '234,67,53' : ($peer_status === 'warning' ? '251,188,4' : '52,168,83'); ?>,0.08);border-radius:var(--radius-sm);padding:0.75rem 1rem;margin-top:0.5rem;">
                    <p style="font-size:0.9rem;margin:0;">
                        <i class="fas fa-users" style="color:<?php echo $peer_status === 'danger' ? 'var(--color-accent-red)' : ($peer_status === 'warning' ? 'var(--color-warning)' : 'var(--color-accent-green)'); ?>;"></i>
                        <strong><?php echo $pred['peer_count']; ?> siswa lain</strong> dari sekolahmu juga memilih program studi ini.
                    </p>
                    <small class="text-muted">Tingkat persaingan internal: <strong><?php echo $peer_message; ?></strong></small>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Tips Section -->
        <div class="card mb-4" data-aos="fade-up" data-aos-delay="200">
            <h3 class="mb-2"><i class="fas fa-lightbulb text-blue"></i> Tips Strategi SNBP</h3>
            <div style="background:rgba(26,115,232,0.05);border-radius:var(--radius-sm);padding:1.5rem;border-left:4px solid var(--color-accent-blue);">
                <ul style="font-size:0.9rem;line-height:2;color:var(--color-text-light);margin:0;padding-left:1.25rem;">
                    <li>Jika banyak siswa dari sekolahmu memilih program studi yang sama, pertimbangkan untuk memilih program alternatif.</li>
                    <li>Kuota SNBP per sekolah terbatas. Semakin sedikit saingan internal, semakin besar peluangmu.</li>
                    <li>Gunakan fitur <a href="rekomendasi.php">Rekomendasi What-If</a> untuk menemukan program studi alternatif terbaik.</li>
                    <li>Diskusikan strategi pemilihan dengan guru BK menggunakan fitur <a href="dashboard_student.php">Undang Guru</a>.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
