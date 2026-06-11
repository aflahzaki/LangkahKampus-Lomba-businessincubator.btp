<?php
$page_title = 'Pembayaran';
include '../includes/header.php';
?>

<div class="dashboard-page">
    <div class="dashboard-header">
        <div class="container">
            <h1><i class="fas fa-credit-card"></i> Pembayaran</h1>
            <p>Pilih paket yang sesuai dengan kebutuhan prediksi SNBP Anda</p>
        </div>
    </div>

    <div class="container">
        <!-- Pricing Cards -->
        <div class="pricing-grid mb-4" data-aos="fade-up">
            <div class="pricing-card" id="pkg-basic">
                <div class="pricing-name">Prediksi Dasar</div>
                <div class="pricing-price"><?php echo format_rupiah(PRICE_BASIC_PREDICTION); ?> <span>/prediksi</span></div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> 1x prediksi probabilitas SNBP</li>
                    <li><i class="fas fa-check"></i> Confidence interval</li>
                    <li><i class="fas fa-check"></i> Grafik feature importance</li>
                    <li><i class="fas fa-check"></i> Perbandingan historis</li>
                    <li class="disabled"><i class="fas fa-times"></i> Rekomendasi What-If</li>
                    <li class="disabled"><i class="fas fa-times"></i> Simpan riwayat</li>
                </ul>
                <button class="btn btn-outline btn-block" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);" onclick="selectPackage('basic', 15000)">
                    Pilih Paket Ini
                </button>
            </div>

            <div class="pricing-card popular" id="pkg-deep">
                <div class="pricing-name">Rekomendasi Mendalam</div>
                <div class="pricing-price"><?php echo format_rupiah(PRICE_DEEP_RECOMMENDATION); ?> <span>/prediksi</span></div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> Semua fitur Prediksi Dasar</li>
                    <li><i class="fas fa-check"></i> 5 rekomendasi alternatif</li>
                    <li><i class="fas fa-check"></i> Analisis counterfactual What-If</li>
                    <li><i class="fas fa-check"></i> Hard-Rule Validator</li>
                    <li><i class="fas fa-check"></i> Simpan & bandingkan riwayat</li>
                    <li><i class="fas fa-check"></i> Export hasil PDF</li>
                </ul>
                <button class="btn btn-primary btn-block btn-ripple" onclick="selectPackage('deep', 25000)">
                    Pilih Paket Ini
                </button>
            </div>

            <div class="pricing-card" id="pkg-premium">
                <div class="pricing-name">Premium Bulanan</div>
                <div class="pricing-price"><?php echo format_rupiah(PRICE_MONTHLY_PREMIUM); ?> <span>/bulan</span></div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> Prediksi unlimited</li>
                    <li><i class="fas fa-check"></i> Rekomendasi unlimited</li>
                    <li><i class="fas fa-check"></i> Anti-Bentrok Dashboard</li>
                    <li><i class="fas fa-check"></i> Dashboard analytics</li>
                    <li><i class="fas fa-check"></i> Priority support</li>
                    <li><i class="fas fa-check"></i> Notifikasi slot real-time</li>
                </ul>
                <button class="btn btn-outline btn-block" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);" onclick="selectPackage('premium', 49000)">
                    Pilih Paket Ini
                </button>
            </div>
        </div>

        <!-- Payment Section (hidden initially, shows after package selection) -->
        <div id="paymentSection" class="hidden">
            <div style="max-width:600px;margin:0 auto;">
                <div class="card mb-3" data-aos="fade-up">
                    <h3 class="mb-3"><i class="fas fa-wallet"></i> Metode Pembayaran</h3>

                    <div class="payment-methods">
                        <div class="payment-method" onclick="selectPayment(this, 'bca')">
                            <i class="fas fa-university"></i>
                            <div><strong>Transfer BCA</strong></div>
                        </div>
                        <div class="payment-method" onclick="selectPayment(this, 'mandiri')">
                            <i class="fas fa-university"></i>
                            <div><strong>Transfer Mandiri</strong></div>
                        </div>
                        <div class="payment-method" onclick="selectPayment(this, 'gopay')">
                            <i class="fas fa-mobile-alt"></i>
                            <div><strong>GoPay</strong></div>
                        </div>
                        <div class="payment-method" onclick="selectPayment(this, 'ovo')">
                            <i class="fas fa-mobile-alt"></i>
                            <div><strong>OVO</strong></div>
                        </div>
                        <div class="payment-method" onclick="selectPayment(this, 'dana')">
                            <i class="fas fa-mobile-alt"></i>
                            <div><strong>DANA</strong></div>
                        </div>
                        <div class="payment-method" onclick="selectPayment(this, 'qris')">
                            <i class="fas fa-qrcode"></i>
                            <div><strong>QRIS</strong></div>
                        </div>
                    </div>

                    <!-- Promo Code -->
                    <div class="form-group mt-3">
                        <label class="form-label">Kode Promo (Opsional)</label>
                        <div class="d-flex gap-1">
                            <input type="text" class="form-control" placeholder="Masukkan kode promo" id="promoCode">
                            <button class="btn btn-outline" style="border-color:var(--color-accent-blue);color:var(--color-accent-blue);white-space:nowrap;" onclick="applyPromo()">Terapkan</button>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="card mb-3" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="mb-2"><i class="fas fa-receipt"></i> Ringkasan Pesanan</h3>
                    <div style="border-top:1px solid var(--color-border);padding-top:1rem;">
                        <div class="d-flex justify-between mb-1">
                            <span class="text-muted">Paket:</span>
                            <strong id="summaryPackage">Rekomendasi Mendalam</strong>
                        </div>
                        <div class="d-flex justify-between mb-1">
                            <span class="text-muted">Subtotal:</span>
                            <span id="summarySubtotal">Rp25.000</span>
                        </div>
                        <div class="d-flex justify-between mb-1">
                            <span class="text-muted">Diskon:</span>
                            <span id="summaryDiscount" class="text-green">-Rp0</span>
                        </div>
                        <hr style="border-color:var(--color-border);margin:0.75rem 0;">
                        <div class="d-flex justify-between">
                            <strong>Total:</strong>
                            <strong id="summaryTotal" style="font-size:1.2rem;color:var(--color-accent-blue);">Rp25.000</strong>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-lg btn-block btn-ripple mb-4" onclick="processPayment()">
                    <i class="fas fa-lock"></i> Bayar Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<script>
var selectedAmount = 0;
var selectedPackageName = '';

function selectPackage(pkg, amount) {
    selectedAmount = amount;
    var names = { basic: 'Prediksi Dasar', deep: 'Rekomendasi Mendalam', premium: 'Premium Bulanan' };
    selectedPackageName = names[pkg];

    document.getElementById('paymentSection').classList.remove('hidden');
    document.getElementById('summaryPackage').textContent = selectedPackageName;
    document.getElementById('summarySubtotal').textContent = formatRupiah(amount);
    document.getElementById('summaryTotal').textContent = formatRupiah(amount);

    document.getElementById('paymentSection').scrollIntoView({ behavior: 'smooth' });
}

function selectPayment(el, method) {
    document.querySelectorAll('.payment-method').forEach(function(m) { m.classList.remove('selected'); });
    el.classList.add('selected');
}

function applyPromo() {
    var code = document.getElementById('promoCode').value.trim();
    if (code.toLowerCase() === 'langkah2025') {
        var discount = Math.round(selectedAmount * 0.2);
        document.getElementById('summaryDiscount').textContent = '-' + formatRupiah(discount);
        document.getElementById('summaryTotal').textContent = formatRupiah(selectedAmount - discount);
        showToast('success', 'Kode promo berhasil! Diskon 20% diterapkan.');
    } else if (code) {
        showToast('danger', 'Kode promo tidak valid');
    }
}

function processPayment() {
    var selected = document.querySelector('.payment-method.selected');
    if (!selected) {
        showToast('warning', 'Silakan pilih metode pembayaran');
        return;
    }

    // Show loading
    showToast('info', 'Memproses pembayaran...');

    setTimeout(function() {
        showToast('success', 'Pembayaran berhasil! Fitur ' + selectedPackageName + ' telah aktif.');
    }, 2000);
}

function formatRupiah(amount) {
    return 'Rp' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

<?php include '../includes/footer.php'; ?>
