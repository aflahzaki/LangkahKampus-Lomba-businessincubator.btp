<?php
$page_title = 'Profil Saya';
include '../includes/header.php';

// Demo user data
$user_data = [
    'full_name' => 'Anisa Rahmawati',
    'email' => 'anisa@example.com',
    'phone' => '081234567890',
    'school' => 'SMAN 3 Bandung',
    'province' => 'Jawa Barat',
    'major_track' => 'IPA',
    'ranking' => 5,
    'total_students' => 320,
    'is_premium' => false
];
?>

<div class="dashboard-page">
    <div class="dashboard-header">
        <div class="container">
            <h1><i class="fas fa-user-circle"></i> Profil Saya</h1>
            <p>Kelola informasi akun dan data akademik Anda</p>
        </div>
    </div>

    <div class="container">
        <div style="display:grid;grid-template-columns:300px 1fr;gap:2rem;align-items:start;">
            <!-- Profile Sidebar -->
            <div class="card text-center" data-aos="fade-up">
                <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--color-accent-blue),var(--color-primary));display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;color:#fff;font-size:2rem;">
                    <i class="fas fa-user"></i>
                </div>
                <h4><?php echo $user_data['full_name']; ?></h4>
                <p class="text-muted" style="font-size:0.85rem;"><?php echo $user_data['email']; ?></p>
                <span class="badge <?php echo $user_data['is_premium'] ? 'badge-success' : 'badge-info'; ?> mt-1">
                    <?php echo $user_data['is_premium'] ? 'Premium' : 'Gratis'; ?>
                </span>

                <hr style="margin:1.5rem 0;border-color:var(--color-border);">

                <ul style="text-align:left;font-size:0.9rem;line-height:2.5;">
                    <li><i class="fas fa-school text-blue" style="width:20px;"></i> <?php echo $user_data['school']; ?></li>
                    <li><i class="fas fa-map-marker-alt text-red" style="width:20px;"></i> <?php echo $user_data['province']; ?></li>
                    <li><i class="fas fa-book text-green" style="width:20px;"></i> Jurusan: <?php echo $user_data['major_track']; ?></li>
                    <li><i class="fas fa-trophy" style="width:20px;color:var(--color-warning);"></i> Peringkat: <?php echo $user_data['ranking']; ?>/<?php echo $user_data['total_students']; ?></li>
                </ul>

                <?php if (!$user_data['is_premium']): ?>
                <a href="pembayaran.php" class="btn btn-primary btn-block mt-2 btn-ripple">
                    <i class="fas fa-crown"></i> Upgrade Premium
                </a>
                <?php endif; ?>
            </div>

            <!-- Main Content -->
            <div>
                <!-- Edit Profile Form -->
                <div class="card mb-3" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="mb-3"><i class="fas fa-user-edit"></i> Edit Informasi Pribadi</h3>
                    <form>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" value="<?php echo $user_data['full_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="<?php echo $user_data['email']; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">No. Telepon</label>
                                <input type="tel" class="form-control" value="<?php echo $user_data['phone']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Jurusan</label>
                                <select class="form-control">
                                    <option value="IPA" selected>IPA</option>
                                    <option value="IPS">IPS</option>
                                    <option value="Bahasa">Bahasa</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-ripple" onclick="showToast('success','Profil berhasil disimpan')">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

                <!-- Academic Data -->
                <div class="card mb-3" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="mb-3"><i class="fas fa-graduation-cap"></i> Data Akademik</h3>
                    <p class="text-muted mb-2">Nilai rapor semester 1-5 (rata-rata per mata pelajaran)</p>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th>Sem 1</th>
                                    <th>Sem 2</th>
                                    <th>Sem 3</th>
                                    <th>Sem 4</th>
                                    <th>Sem 5</th>
                                    <th>Rata-rata</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Matematika</strong></td>
                                    <td>88</td><td>90</td><td>87</td><td>91</td><td>89</td>
                                    <td><span class="badge badge-success">89.0</span></td>
                                </tr>
                                <tr>
                                    <td><strong>B. Indonesia</strong></td>
                                    <td>85</td><td>86</td><td>88</td><td>87</td><td>86</td>
                                    <td><span class="badge badge-success">86.4</span></td>
                                </tr>
                                <tr>
                                    <td><strong>B. Inggris</strong></td>
                                    <td>82</td><td>84</td><td>83</td><td>85</td><td>84</td>
                                    <td><span class="badge badge-success">83.6</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Fisika</strong></td>
                                    <td>90</td><td>88</td><td>92</td><td>89</td><td>91</td>
                                    <td><span class="badge badge-success">90.0</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Kimia</strong></td>
                                    <td>86</td><td>87</td><td>85</td><td>88</td><td>87</td>
                                    <td><span class="badge badge-success">86.6</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Biologi</strong></td>
                                    <td>84</td><td>85</td><td>86</td><td>84</td><td>85</td>
                                    <td><span class="badge badge-success">84.8</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Prediction History -->
                <div class="card mb-4" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="mb-3"><i class="fas fa-history"></i> Riwayat Prediksi</h3>
                    <div class="stagger-list">
                        <div class="stat-card mb-1">
                            <div class="stat-card-icon green"><i class="fas fa-chart-line"></i></div>
                            <div class="stat-card-info" style="flex:1;">
                                <div class="d-flex align-center justify-between">
                                    <h3 style="font-size:0.95rem;">Teknik Informatika - ITB</h3>
                                    <span class="badge badge-success">78%</span>
                                </div>
                                <p>10 Januari 2025</p>
                            </div>
                        </div>
                        <div class="stat-card mb-1">
                            <div class="stat-card-icon orange"><i class="fas fa-chart-line"></i></div>
                            <div class="stat-card-info" style="flex:1;">
                                <div class="d-flex align-center justify-between">
                                    <h3 style="font-size:0.95rem;">Kedokteran - UI</h3>
                                    <span class="badge badge-warning">45%</span>
                                </div>
                                <p>8 Januari 2025</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card-icon green"><i class="fas fa-chart-line"></i></div>
                            <div class="stat-card-info" style="flex:1;">
                                <div class="d-flex align-center justify-between">
                                    <h3 style="font-size:0.95rem;">Manajemen - UGM</h3>
                                    <span class="badge badge-success">82%</span>
                                </div>
                                <p>5 Januari 2025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
