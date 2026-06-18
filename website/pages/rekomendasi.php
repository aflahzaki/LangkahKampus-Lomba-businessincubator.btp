<?php
$page_title = 'Rekomendasi';
include '../includes/header.php';
?>

<div class="dashboard-page">
    <div class="dashboard-header">
        <div class="container">
            <h1><i class="fas fa-lightbulb"></i> Rekomendasi</h1>
            <p>Rekomendasi alternatif kini terintegrasi langsung ke halaman Prediksi</p>
        </div>
    </div>

    <div class="container">
        <div style="max-width:600px;margin:2rem auto;text-align:center;">
            <div class="card" data-aos="fade-up">
                <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--color-accent-blue),var(--color-accent-green));display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:2rem;margin-bottom:1.5rem;">
                    <i class="fas fa-magic"></i>
                </div>
                <h3 class="mb-2">Fitur Ini Telah Diperbarui!</h3>
                <p class="text-muted mb-3">
                    Rekomendasi alternatif, analisis What-If, dan perbandingan program studi kini muncul otomatis 
                    setelah Anda melakukan prediksi. Semua dalam satu halaman untuk pengalaman yang lebih efisien.
                </p>
                <div class="d-flex justify-center gap-2">
                    <a href="prediksi.php" class="btn btn-primary btn-ripple">
                        <i class="fas fa-brain"></i> Buat Prediksi Baru
                    </a>
                    <a href="dashboard_student.php" class="btn btn-outline btn-ripple" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
