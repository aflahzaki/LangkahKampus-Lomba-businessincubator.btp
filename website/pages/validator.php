<?php
$page_title = 'Validator Pilihan SNBP';
include '../includes/header.php';
?>

<div class="dashboard-page">
    <div class="dashboard-header">
        <div class="container">
            <h1><i class="fas fa-check-double"></i> Hard-Rule Validator</h1>
            <p>Validasi pilihan 1 dan 2 SNBP Anda berdasarkan aturan resmi SNPMB</p>
        </div>
    </div>

    <div class="container">
        <div style="max-width:800px;margin:0 auto;">
            <!-- Validator Form -->
            <div class="card mb-3" data-aos="fade-up">
                <h3 class="mb-3"><i class="fas fa-clipboard-check"></i> Masukkan Pilihan Anda</h3>

                <form id="validatorForm">
                    <div class="form-group">
                        <label class="form-label">Pilihan 1 (Prioritas Utama)</label>
                        <input type="text" id="choice1Search" class="form-control" 
                               placeholder="Cari program studi pilihan 1...">
                        <input type="hidden" name="choice1" id="choice1Value" value="1">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pilihan 2</label>
                        <input type="text" id="choice2Search" class="form-control" 
                               placeholder="Cari program studi pilihan 2...">
                        <input type="hidden" name="choice2" id="choice2Value" value="5">
                    </div>

                    <button type="button" class="btn btn-primary btn-lg btn-block btn-ripple" onclick="validateChoices()">
                        <i class="fas fa-shield-alt"></i> Validasi Sekarang
                    </button>
                </form>
            </div>

            <!-- Validation Results -->
            <div id="validationResults" class="mb-4">
                <!-- Demo Results -->
                <div class="card mb-2" data-aos="fade-up" data-aos-delay="100" style="border-left:4px solid var(--color-accent-green);">
                    <div class="d-flex align-center gap-2">
                        <i class="fas fa-check-circle" style="font-size:1.5rem;color:var(--color-accent-green);"></i>
                        <div>
                            <h4 style="color:var(--color-accent-green);">Pilihan Valid</h4>
                            <p class="text-muted" style="font-size:0.9rem;">Pilihan 2 tidak memblokir pilihan 1. Kedua program bisa dipilih bersamaan.</p>
                        </div>
                    </div>
                </div>

                <div class="card mb-2" data-aos="fade-up" data-aos-delay="200" style="border-left:4px solid var(--color-accent-green);">
                    <div class="d-flex align-center gap-2">
                        <i class="fas fa-check-circle" style="font-size:1.5rem;color:var(--color-accent-green);"></i>
                        <div>
                            <h4 style="color:var(--color-accent-green);">Akreditasi Sesuai</h4>
                            <p class="text-muted" style="font-size:0.9rem;">Akreditasi program studi memenuhi persyaratan minimum SNBP.</p>
                        </div>
                    </div>
                </div>

                <div class="card mb-2" data-aos="fade-up" data-aos-delay="300" style="border-left:4px solid var(--color-accent-green);">
                    <div class="d-flex align-center gap-2">
                        <i class="fas fa-check-circle" style="font-size:1.5rem;color:var(--color-accent-green);"></i>
                        <div>
                            <h4 style="color:var(--color-accent-green);">Kuota Tersedia</h4>
                            <p class="text-muted" style="font-size:0.9rem;">Kedua program masih memiliki kuota yang tersedia.</p>
                        </div>
                    </div>
                </div>

                <div class="card mb-2" data-aos="fade-up" data-aos-delay="400" style="border-left:4px solid var(--color-warning);">
                    <div class="d-flex align-center gap-2">
                        <i class="fas fa-exclamation-triangle" style="font-size:1.5rem;color:var(--color-warning);"></i>
                        <div>
                            <h4 style="color:var(--color-warning);">Perhatian: Kompetisi Tinggi</h4>
                            <p class="text-muted" style="font-size:0.9rem;">Pilihan 1 memiliki rasio kompetisi 1:15. Pastikan peringkat dan nilai Anda memadai.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rules Info -->
            <div class="card" data-aos="fade-up" data-aos-delay="500">
                <h4 class="mb-2"><i class="fas fa-book text-blue"></i> Aturan SNBP yang Divalidasi</h4>
                <ul style="font-size:0.9rem;line-height:2.2;color:var(--color-text-light);">
                    <li><i class="fas fa-gavel text-primary"></i> <strong>Blocking Rule:</strong> Beberapa program studi di universitas yang sama tidak boleh dipilih bersamaan</li>
                    <li><i class="fas fa-gavel text-primary"></i> <strong>Akreditasi:</strong> Program studi harus terakreditasi minimum B/Baik Sekali</li>
                    <li><i class="fas fa-gavel text-primary"></i> <strong>Lintas Jurusan:</strong> Siswa IPS tidak bisa memilih prodi eksakta tertentu</li>
                    <li><i class="fas fa-gavel text-primary"></i> <strong>Kuota Sekolah:</strong> Maksimal 3 siswa per program studi per sekolah</li>
                    <li><i class="fas fa-gavel text-primary"></i> <strong>Peringkat:</strong> Hanya siswa peringkat top 40% yang eligible SNBP</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function validateChoices() {
    var choice1 = document.getElementById('choice1Search').value;
    var choice2 = document.getElementById('choice2Search').value;

    if (!choice1 || !choice2) {
        showToast('warning', 'Silakan isi kedua pilihan program studi');
        return;
    }

    // Show loading
    var btn = event.target;
    btn.innerHTML = '<div class="spinner" style="width:20px;height:20px;margin:0;border-width:2px;display:inline-block;"></div> Memvalidasi...';
    btn.disabled = true;

    // Simulate API call
    setTimeout(function() {
        btn.innerHTML = '<i class="fas fa-shield-alt"></i> Validasi Sekarang';
        btn.disabled = false;
        showToast('success', 'Validasi selesai! Lihat hasil di bawah.');
    }, 1500);
}
</script>

<?php include '../includes/footer.php'; ?>
