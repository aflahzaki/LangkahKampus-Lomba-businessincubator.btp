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

// Determine registration type
$type = isset($_GET['type']) ? $_GET['type'] : '';
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
                    <?php if ($type === 'siswa'): ?>
                        <h2>Daftar sebagai Siswa</h2>
                        <p class="text-muted">Buat akun siswa di <?php echo APP_NAME; ?></p>
                    <?php elseif ($type === 'guru'): ?>
                        <h2>Daftar sebagai Guru</h2>
                        <p class="text-muted">Buat akun guru di <?php echo APP_NAME; ?></p>
                    <?php else: ?>
                        <h2>Buat Akun Baru</h2>
                        <p class="text-muted">Bergabung dengan <?php echo APP_NAME; ?></p>
                    <?php endif; ?>
                </div>

                <?php
                $flash = get_flash_message();
                if ($flash):
                ?>
                <div class="toast toast-<?php echo $flash['type']; ?>" style="position:relative;top:auto;right:auto;margin-bottom:1rem;">
                    <i class="fas fa-info-circle"></i>
                    <span><?php echo $flash['message']; ?></span>
                </div>
                <?php endif; ?>

                <?php if ($type === ''): ?>
                <!-- Role Selection Landing -->
                <div class="form-group">
                    <label class="form-label" style="text-align:center;display:block;margin-bottom:1rem;">Pilih Peran Anda</label>
                    <div class="payment-methods">
                        <a href="register.php?type=siswa" class="payment-method" style="text-decoration:none;color:inherit;">
                            <i class="fas fa-user-graduate"></i>
                            <div><strong>Daftar sebagai Siswa</strong></div>
                            <small>Siswa SMA/SMK/MA yang ingin eksplorasi kampus</small>
                        </a>
                        <a href="register.php?type=guru" class="payment-method" style="text-decoration:none;color:inherit;">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <div><strong>Daftar sebagai Guru</strong></div>
                            <small>Guru BK yang diundang oleh siswa</small>
                        </a>
                    </div>
                </div>

                <?php elseif ($type === 'siswa'): ?>
                <!-- Student Registration Form (2-step) -->
                <div class="progress-bar mb-3">
                    <div class="progress-fill" id="registerProgress" style="width: 50%"></div>
                </div>
                <div class="text-center mb-3" style="font-size:0.85rem;color:var(--color-text-light);">
                    Langkah <span id="currentStep">1</span> dari 2
                </div>

                <form id="registerForm" method="POST" action="<?php echo $base_path; ?>api/auth.php">
                    <input type="hidden" name="action" value="register">
                    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                    <input type="hidden" name="role" value="student">

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

                    <!-- Step 2: School Details -->
                    <div class="register-step" id="step2" style="display:none;">
                        <div class="form-group">
                            <label class="form-label" for="school_name">Nama Sekolah</label>
                            <select id="school_name" name="school_name" class="form-control">
                                <option value="">Pilih Sekolah</option>
                                <option value="SMAN 3 Jakarta">SMAN 3 Jakarta</option>
                                <option value="SMAN 3 Bandung">SMAN 3 Bandung</option>
                                <option value="SMAN 5 Surabaya">SMAN 5 Surabaya</option>
                                <option value="SMAN 1 Yogyakarta">SMAN 1 Yogyakarta</option>
                                <option value="SMA Labschool Jakarta">SMA Labschool Jakarta</option>
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

                        <div class="form-group">
                            <label style="display:flex;align-items:center;gap:0.5rem;font-size:0.85rem;cursor:pointer;">
                                <input type="checkbox" name="agree_terms" value="1" required>
                                Saya menyetujui <a href="#">Syarat &amp; Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>
                            </label>
                        </div>

                        <div style="display:flex;gap:1rem;">
                            <button type="button" class="btn btn-outline btn-block" style="border-color:var(--color-border);color:var(--color-text);" onclick="prevStep(1)">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </button>
                            <button type="submit" class="btn btn-primary btn-block btn-ripple">
                                <i class="fas fa-user-plus"></i> Daftar
                            </button>
                        </div>
                    </div>
                </form>

                <?php elseif ($type === 'guru'): ?>
                <!-- Guru Registration Form (single step) -->
                <form id="registerForm" method="POST" action="<?php echo $base_path; ?>api/auth.php">
                    <input type="hidden" name="action" value="register">
                    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                    <input type="hidden" name="role" value="guru">

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

                    <div class="form-group">
                        <label class="form-label" for="invite_code">Kode Undangan</label>
                        <input type="text" id="invite_code" name="invite_code" class="form-control" 
                               placeholder="Masukkan 6 karakter kode" maxlength="6" style="text-transform:uppercase;letter-spacing:0.2em;font-weight:600;" required>
                        <small style="color:var(--color-text-muted);display:block;margin-top:0.3rem;">
                            Masukkan kode undangan yang diberikan oleh siswa Anda
                        </small>
                    </div>

                    <div class="form-group">
                        <label style="display:flex;align-items:center;gap:0.5rem;font-size:0.85rem;cursor:pointer;">
                            <input type="checkbox" name="agree_terms" value="1" required>
                            Saya menyetujui <a href="#">Syarat &amp; Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-ripple">
                        <i class="fas fa-user-plus"></i> Daftar sebagai Guru
                    </button>
                </form>
                <?php endif; ?>

                <div class="text-center mt-3">
                    <p class="text-muted" style="font-size:0.9rem;">
                        Sudah punya akun? <a href="login.php"><strong>Masuk</strong></a>
                    </p>
                    <?php if ($type !== ''): ?>
                    <p class="text-muted" style="font-size:0.85rem;">
                        <a href="register.php"><i class="fas fa-arrow-left"></i> Kembali ke pilihan peran</a>
                    </p>
                    <?php endif; ?>
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
        document.getElementById('registerProgress').style.width = (step * 50) + '%';
    }

    function prevStep(step) {
        document.querySelectorAll('.register-step').forEach(function(el) { el.style.display = 'none'; });
        document.getElementById('step' + step).style.display = 'block';
        document.getElementById('currentStep').textContent = step;
        document.getElementById('registerProgress').style.width = (step * 50) + '%';
    }
    </script>
</body>
</html>
