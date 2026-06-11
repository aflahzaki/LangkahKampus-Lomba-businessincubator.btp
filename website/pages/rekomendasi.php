<?php
$page_title = 'Rekomendasi What-If';
include '../includes/header.php';
?>

<div class="dashboard-page">
    <div class="dashboard-header">
        <div class="container">
            <h1><i class="fas fa-lightbulb"></i> Rekomendasi What-If</h1>
            <p>Analisis counterfactual - Temukan apa yang perlu berubah untuk meningkatkan peluang Anda</p>
        </div>
    </div>

    <div class="container">
        <!-- Current Prediction Summary -->
        <div class="card mb-3" data-aos="fade-up">
            <div class="d-flex align-center gap-3 flex-wrap">
                <div class="gauge-container" style="width:120px;height:120px;">
                    <svg class="gauge-svg" width="120" height="120" viewBox="0 0 120 120">
                        <circle class="gauge-bg" cx="60" cy="60" r="48" stroke-width="8"/>
                        <circle class="gauge-fill" cx="60" cy="60" r="48" stroke-width="8"
                                stroke="#F39C12" stroke-dasharray="301.59" stroke-dashoffset="166" stroke-linecap="round"/>
                    </svg>
                    <div class="gauge-text" style="font-size:0.7rem;">
                        <div style="font-size:1.5rem;font-weight:800;">45%</div>
                        <div>Saat ini</div>
                    </div>
                </div>
                <div>
                    <h3>Kedokteran - Universitas Indonesia</h3>
                    <p class="text-muted">Prediksi dibuat: 8 Januari 2025</p>
                    <span class="badge badge-warning">Peluang Sedang</span>
                </div>
            </div>
        </div>

        <!-- What-If Recommendations -->
        <div class="section-header" data-aos="fade-up">
            <h2>Alternatif Program Studi</h2>
            <p>Berikut program studi yang lebih sesuai berdasarkan profil akademik Anda</p>
        </div>

        <div class="features-grid" style="grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));">
            <!-- Recommendation 1 -->
            <div class="card hover-lift" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex align-center justify-between mb-2">
                    <span class="badge badge-success">#1 Rekomendasi</span>
                    <span style="font-size:1.5rem;font-weight:800;color:var(--color-accent-green);">85%</span>
                </div>
                <h4>Farmasi</h4>
                <p class="text-muted mb-2">Universitas Indonesia</p>

                <div style="background:var(--color-bg);border-radius:var(--radius-sm);padding:1rem;margin-bottom:1rem;">
                    <h5 style="font-size:0.85rem;margin-bottom:0.5rem;"><i class="fas fa-exchange-alt text-blue"></i> Perubahan yang Diperlukan:</h5>
                    <ul style="font-size:0.85rem;color:var(--color-text-light);line-height:2;">
                        <li><i class="fas fa-arrow-right text-green"></i> Ganti target dari Kedokteran ke Farmasi</li>
                        <li><i class="fas fa-arrow-up text-blue"></i> Nilai Kimia sudah sesuai (Rata-rata: 88)</li>
                    </ul>
                </div>

                <div class="progress-bar mb-1">
                    <div class="progress-fill" style="width:85%;background:linear-gradient(90deg,var(--color-accent-green),var(--color-accent-green-light));"></div>
                </div>
                <small class="text-muted">Peluang: 85% (naik 40% dari prediksi saat ini)</small>
            </div>

            <!-- Recommendation 2 -->
            <div class="card hover-lift" data-aos="fade-up" data-aos-delay="200">
                <div class="d-flex align-center justify-between mb-2">
                    <span class="badge badge-success">#2 Rekomendasi</span>
                    <span style="font-size:1.5rem;font-weight:800;color:var(--color-accent-green);">78%</span>
                </div>
                <h4>Ilmu Biomedis</h4>
                <p class="text-muted mb-2">Universitas Indonesia</p>

                <div style="background:var(--color-bg);border-radius:var(--radius-sm);padding:1rem;margin-bottom:1rem;">
                    <h5 style="font-size:0.85rem;margin-bottom:0.5rem;"><i class="fas fa-exchange-alt text-blue"></i> Perubahan yang Diperlukan:</h5>
                    <ul style="font-size:0.85rem;color:var(--color-text-light);line-height:2;">
                        <li><i class="fas fa-arrow-right text-green"></i> Ganti target ke Ilmu Biomedis</li>
                        <li><i class="fas fa-info-circle text-blue"></i> Kompetisi 40% lebih rendah</li>
                    </ul>
                </div>

                <div class="progress-bar mb-1">
                    <div class="progress-fill" style="width:78%;background:linear-gradient(90deg,var(--color-accent-green),var(--color-accent-blue));"></div>
                </div>
                <small class="text-muted">Peluang: 78% (naik 33% dari prediksi saat ini)</small>
            </div>

            <!-- Recommendation 3 -->
            <div class="card hover-lift" data-aos="fade-up" data-aos-delay="300">
                <div class="d-flex align-center justify-between mb-2">
                    <span class="badge badge-info">#3 Rekomendasi</span>
                    <span style="font-size:1.5rem;font-weight:800;color:var(--color-accent-blue);">71%</span>
                </div>
                <h4>Kedokteran</h4>
                <p class="text-muted mb-2">Universitas Padjadjaran</p>

                <div style="background:var(--color-bg);border-radius:var(--radius-sm);padding:1rem;margin-bottom:1rem;">
                    <h5 style="font-size:0.85rem;margin-bottom:0.5rem;"><i class="fas fa-exchange-alt text-blue"></i> Perubahan yang Diperlukan:</h5>
                    <ul style="font-size:0.85rem;color:var(--color-text-light);line-height:2;">
                        <li><i class="fas fa-arrow-right text-green"></i> Ganti universitas ke UNPAD</li>
                        <li><i class="fas fa-info-circle text-blue"></i> Tetap di jurusan Kedokteran</li>
                        <li><i class="fas fa-arrow-up text-blue"></i> Rasio kompetisi lebih rendah</li>
                    </ul>
                </div>

                <div class="progress-bar mb-1">
                    <div class="progress-fill" style="width:71%;background:linear-gradient(90deg,var(--color-accent-blue),var(--color-accent-blue-light));"></div>
                </div>
                <small class="text-muted">Peluang: 71% (naik 26% dari prediksi saat ini)</small>
            </div>
        </div>

        <!-- What-If Simulator -->
        <div class="card mt-4 mb-4" data-aos="fade-up" data-aos-delay="400">
            <h3 class="mb-3"><i class="fas fa-sliders-h"></i> Simulator What-If Interaktif</h3>
            <p class="text-muted mb-3">Geser slider untuk melihat bagaimana perubahan nilai mempengaruhi peluang Anda</p>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;">
                <div>
                    <div class="form-group">
                        <label class="form-label">Jika nilai Matematika rata-rata: <strong id="mathValue">85</strong></label>
                        <input type="range" min="60" max="100" value="85" class="form-control" style="padding:0;" 
                               oninput="document.getElementById('mathValue').textContent=this.value; updateSimulation();">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jika peringkat di sekolah: <strong id="rankValue">15</strong></label>
                        <input type="range" min="1" max="100" value="15" class="form-control" style="padding:0;" 
                               oninput="document.getElementById('rankValue').textContent=this.value; updateSimulation();">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jika nilai B.Inggris rata-rata: <strong id="engValue">80</strong></label>
                        <input type="range" min="60" max="100" value="80" class="form-control" style="padding:0;" 
                               oninput="document.getElementById('engValue').textContent=this.value; updateSimulation();">
                    </div>
                </div>
                <div class="text-center">
                    <div class="gauge-container" style="width:150px;height:150px;margin:0 auto;">
                        <svg class="gauge-svg" width="150" height="150" viewBox="0 0 150 150">
                            <circle class="gauge-bg" cx="75" cy="75" r="60" stroke-width="10"/>
                            <circle class="gauge-fill" id="simGauge" cx="75" cy="75" r="60" stroke-width="10"
                                    stroke="#F39C12" stroke-dasharray="376.99" stroke-dashoffset="207" stroke-linecap="round"/>
                        </svg>
                        <div class="gauge-text">
                            <div id="simPercentage" style="font-size:2rem;font-weight:800;">45%</div>
                            <div style="font-size:0.7rem;color:var(--color-text-light);">Prediksi</div>
                        </div>
                    </div>
                    <p class="mt-2 text-muted" style="font-size:0.85rem;">Hasil simulasi berdasarkan perubahan parameter di atas</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateSimulation() {
    var math = parseInt(document.getElementById('mathValue').textContent);
    var rank = parseInt(document.getElementById('rankValue').textContent);
    var eng = parseInt(document.getElementById('engValue').textContent);

    // Simple mock calculation
    var base = 45;
    var bonus = ((math - 85) * 0.5) + ((15 - rank) * 0.3) + ((eng - 80) * 0.3);
    var result = Math.min(95, Math.max(10, Math.round(base + bonus)));

    var gauge = document.getElementById('simGauge');
    var text = document.getElementById('simPercentage');
    var circumference = 376.99;
    var offset = circumference - (result / 100) * circumference;

    gauge.style.strokeDashoffset = offset;
    gauge.style.stroke = result >= 70 ? '#27AE60' : (result >= 40 ? '#F39C12' : '#C0392B');
    text.textContent = result + '%';
}
</script>

<?php include '../includes/footer.php'; ?>
