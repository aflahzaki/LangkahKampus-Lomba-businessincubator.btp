<?php
$page_title = 'Prediksi SNBP';
$page_scripts = ['predictions.js'];
include '../includes/header.php';
?>

<div class="dashboard-page">
    <div class="dashboard-header">
        <div class="container">
            <h1><i class="fas fa-brain"></i> Prediksi SNBP</h1>
            <p>Masukkan data akademik Anda dan pilih program studi target untuk mendapatkan prediksi probabilitas penerimaan</p>
        </div>
    </div>

    <div class="container">
        <div style="display:grid;grid-template-columns:1fr 400px;gap:2rem;align-items:start;">
            <!-- Prediction Form -->
            <div class="card" data-aos="fade-up">
                <h3 class="mb-3"><i class="fas fa-edit"></i> Data Akademik</h3>

                <form id="predictionForm">
                    <!-- School Info -->
                    <div class="form-row mb-3">
                        <div class="form-group">
                            <label class="form-label">Peringkat di Sekolah</label>
                            <input type="number" name="school_ranking" class="form-control" placeholder="Peringkat Anda" min="1" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Total Siswa (Angkatan)</label>
                            <input type="number" name="total_students" class="form-control" placeholder="Jumlah siswa" min="1" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Akreditasi Sekolah</label>
                            <select name="school_accreditation" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="A">A (Unggul)</option>
                                <option value="B">B (Baik)</option>
                                <option value="C">C (Cukup)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Semester Scores -->
                    <h4 class="mb-2">Nilai Rapor (Semester 1-5)</h4>
                    <p class="text-muted mb-2" style="font-size:0.85rem;">Masukkan nilai rata-rata per mata pelajaran untuk setiap semester</p>

                    <?php
                    $subjects = [
                        'matematika' => 'Matematika',
                        'b_indonesia' => 'B. Indonesia',
                        'b_inggris' => 'B. Inggris',
                        'fisika' => 'Fisika/Ekonomi',
                        'kimia' => 'Kimia/Sosiologi',
                        'biologi' => 'Biologi/Geografi'
                    ];

                    foreach ($subjects as $key => $label):
                    ?>
                    <div class="mb-2">
                        <label class="form-label"><?php echo $label; ?></label>
                        <div class="form-row" style="grid-template-columns:repeat(5,1fr);">
                            <?php for ($sem = 1; $sem <= 5; $sem++): ?>
                            <div class="form-group" style="margin-bottom:0.5rem;">
                                <input type="number" name="<?php echo $key; ?>_sem<?php echo $sem; ?>" 
                                       class="form-control" placeholder="S<?php echo $sem; ?>" 
                                       min="0" max="100" step="0.01" required>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <!-- Target Program -->
                    <h4 class="mb-2 mt-3">Target Program Studi</h4>
                    <div class="form-group" style="position:relative;">
                        <label class="form-label">Cari Program Studi & Universitas</label>
                        <input type="text" id="programSearch" class="form-control" 
                               placeholder="Ketik nama program studi atau universitas...">
                        <input type="hidden" name="target_program" value="">
                        <div id="programResults" class="hidden" style="position:absolute;top:100%;left:0;right:0;background:white;border:1px solid var(--color-border);border-radius:var(--radius-sm);max-height:200px;overflow-y:auto;z-index:100;box-shadow:var(--shadow-md);"></div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block btn-ripple mt-3">
                        <i class="fas fa-magic"></i> Prediksi Sekarang
                    </button>
                </form>
            </div>

            <!-- Prediction Result -->
            <div>
                <div class="card hidden" id="predictionResult" data-aos="zoom-in">
                    <div class="prediction-result">
                        <h3 class="mb-2">Hasil Prediksi</h3>

                        <!-- Gauge -->
                        <div class="gauge-container">
                            <svg class="gauge-svg" width="220" height="220" viewBox="0 0 220 220">
                                <circle class="gauge-bg" cx="110" cy="110" r="90"/>
                                <circle class="gauge-fill" id="gaugeCircle" cx="110" cy="110" r="90"
                                        stroke-dasharray="565.48" stroke-dashoffset="565.48"/>
                            </svg>
                            <div class="gauge-text">
                                <div class="gauge-percentage" id="gaugePercentage">0%</div>
                                <div class="gauge-label">Probabilitas</div>
                            </div>
                        </div>

                        <div id="predictionStatus" style="font-size:1.2rem;font-weight:700;margin-bottom:1rem;"></div>

                        <!-- Confidence Interval -->
                        <h5 class="mb-1">Interval Kepercayaan</h5>
                        <div class="confidence-bar">
                            <div class="confidence-range" id="confidenceRange"></div>
                            <div class="confidence-point" id="confidencePoint"></div>
                        </div>
                        <div class="d-flex justify-between text-muted" style="font-size:0.8rem;">
                            <span id="confidenceLower">0%</span>
                            <span id="confidenceUpper">100%</span>
                        </div>

                        <!-- Feature Importance -->
                        <h5 class="mt-3 mb-2">Faktor Penting</h5>
                        <div id="featureImportance"></div>

                        <div class="mt-3 d-flex gap-1">
                            <a href="rekomendasi.php" class="btn btn-sm btn-primary"><i class="fas fa-lightbulb"></i> Lihat Rekomendasi</a>
                            <button class="btn btn-sm btn-outline" style="border-color:var(--color-border);color:var(--color-text);" onclick="window.print()"><i class="fas fa-download"></i> Simpan</button>
                        </div>
                    </div>
                </div>

                <!-- Tips Card -->
                <div class="card mt-2" data-aos="fade-up" data-aos-delay="300">
                    <h4 class="mb-2"><i class="fas fa-lightbulb text-blue"></i> Tips</h4>
                    <ul style="font-size:0.9rem;color:var(--color-text-light);line-height:2;">
                        <li><i class="fas fa-check text-green"></i> Masukkan nilai sesuai rapor resmi</li>
                        <li><i class="fas fa-check text-green"></i> Peringkat dihitung dari kelas 10-12</li>
                        <li><i class="fas fa-check text-green"></i> Akreditasi mempengaruhi bobot prediksi</li>
                        <li><i class="fas fa-check text-green"></i> Coba beberapa program untuk perbandingan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
