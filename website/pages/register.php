<?php
$page_title = 'Daftar';
$base_path = '../';
require_once $base_path . 'config/app.php';
require_once $base_path . 'includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (is_logged_in()) {
    redirect('dashboard_student.php');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title . ' - ' . APP_NAME; ?></title>
    <link rel="icon" type="image/png" href="<?php echo $base_path; ?>assets/images/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/animations.css">
</head>
<body>
    <div class="auth-page">
        <canvas id="particleCanvas" class="particles-canvas"></canvas>

        <div class="auth-container" style="max-width:500px;">
            <div class="auth-card">
                <div class="auth-logo">
                    <img src="<?php echo $base_path; ?>assets/images/logo.png" alt="<?php echo APP_NAME; ?>">
                    <h2>Buat Akun Baru</h2>
                    <p class="text-muted">Bergabung dengan <?php echo APP_NAME; ?></p>
                </div>

                <!-- Progress Steps -->
                <div class="progress-bar mb-3">
                    <div class="progress-fill" id="registerProgress" style="width: 33%"></div>
                </div>
                <div class="text-center mb-3" style="font-size:0.85rem;color:var(--color-text-light);">
                    Langkah <span id="currentStep">1</span> dari 3
                </div>

                <form id="registerForm" method="POST" action="<?php echo $base_path; ?>api/auth.php">
                    <input type="hidden" name="action" value="register">
                    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

                    <!-- Step 1: Account Info -->
                    <div class="register-step active" id="step1">
                        <div class="form-group">
                            <label class="form-label" for="full_name">Nama Lengkap</label>
                            <input type="text" id="full_name" name="full_name" class="form-control" 
                                   placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="reg_email">Email</label>
                            <input type="email" id="reg_email" name="email" class="form-control" 
                                   placeholder="nama@email.com" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="phone">No. Telepon</label>
                            <input type="tel" id="phone" name="phone" class="form-control" 
                                   placeholder="08xxxxxxxxxx">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="reg_password">Password</label>
                                <input type="password" id="reg_password" name="password" class="form-control" 
                                       placeholder="Min. 8 karakter" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="confirm_password">Konfirmasi</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" 
                                       placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary btn-block" onclick="nextStep(2)">
                            Lanjut <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>

                    <!-- Step 2: Role Selection -->
                    <div class="register-step" id="step2" style="display:none;">
                        <div class="form-group">
                            <label class="form-label">Pilih Peran Anda</label>
                            <div class="payment-methods">
                                <div class="payment-method" data-role="student" onclick="selectRole(this, 'student')">
                                    <i class="fas fa-user-graduate"></i>
                                    <div><strong>Siswa</strong></div>
                                    <small>Siswa SMA/SMK/MA</small>
                                </div>
                                <div class="payment-method" data-role="guru_bk" onclick="selectRole(this, 'guru_bk')">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <div><strong>Guru BK</strong></div>
                                    <small>Bimbingan Konseling</small>
                                </div>
                                <div class="payment-method" data-role="school_admin" onclick="selectRole(this, 'school_admin')">
                                    <i class="fas fa-school"></i>
                                    <div><strong>Admin Sekolah</strong></div>
                                    <small>Pengelola sekolah</small>
                                </div>
                            </div>
                            <input type="hidden" name="role" id="selectedRole" value="student">
                        </div>

                        <div style="display:flex;gap:1rem;">
                            <button type="button" class="btn btn-outline btn-block" style="border-color:var(--color-border);color:var(--color-text);" onclick="prevStep(1)">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </button>
                            <button type="button" class="btn btn-primary btn-block" onclick="nextStep(3)">
                                Lanjut <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Profile Details -->
                    <div class="register-step" id="step3" style="display:none;">
                        <div class="form-group">
                            <label class="form-label" for="school_name">Nama Sekolah</label>
                            <input type="text" id="school_name" name="school_name" class="form-control" 
                                   placeholder="SMAN 1 ...">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="province">Provinsi</label>
                                <select id="province" name="province" class="form-control">
                                    <option value="">Pilih Provinsi</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                    <option value="Jawa Timur">Jawa Timur</option>
                                    <option value="DKI Jakarta">DKI Jakarta</option>
                                    <option value="DI Yogyakarta">DI Yogyakarta</option>
                                    <option value="Banten">Banten</option>
                                    <option value="Sumatera Utara">Sumatera Utara</option>
                                    <option value="Sumatera Barat">Sumatera Barat</option>
                                    <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                    <option value="Bali">Bali</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="major_track">Jurusan</label>
                                <select id="major_track" name="major_track" class="form-control">
                                    <option value="">Pilih Jurusan</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                    <option value="Bahasa">Bahasa</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="display:flex;align-items:center;gap:0.5rem;font-size:0.85rem;cursor:pointer;">
                                <input type="checkbox" name="agree_terms" value="1" required>
                                Saya menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>
                            </label>
                        </div>

                        <div style="display:flex;gap:1rem;">
                            <button type="button" class="btn btn-outline btn-block" style="border-color:var(--color-border);color:var(--color-text);" onclick="prevStep(2)">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </button>
                            <button type="submit" class="btn btn-primary btn-block btn-ripple">
                                <i class="fas fa-user-plus"></i> Daftar
                            </button>
                        </div>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="text-muted" style="font-size:0.9rem;">
                        Sudah punya akun? <a href="login.php"><strong>Masuk</strong></a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo $base_path; ?>assets/js/main.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        initParticleBackground();
    });

    function nextStep(step) {
        document.querySelectorAll('.register-step').forEach(function(el) { el.style.display = 'none'; });
        document.getElementById('step' + step).style.display = 'block';
        document.getElementById('currentStep').textContent = step;
        document.getElementById('registerProgress').style.width = (step * 33.33) + '%';
    }

    function prevStep(step) {
        document.querySelectorAll('.register-step').forEach(function(el) { el.style.display = 'none'; });
        document.getElementById('step' + step).style.display = 'block';
        document.getElementById('currentStep').textContent = step;
        document.getElementById('registerProgress').style.width = (step * 33.33) + '%';
    }

    function selectRole(el, role) {
        document.querySelectorAll('.payment-method').forEach(function(m) { m.classList.remove('selected'); });
        el.classList.add('selected');
        document.getElementById('selectedRole').value = role;
    }
    </script>
</body>
</html>
