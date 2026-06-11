<?php
/**
 * LangkahKampus - Guru API
 * Handles guru-specific actions like adding comments
 */

session_start();

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    flash_message('danger', 'Method tidak diizinkan.');
    redirect('../pages/dashboard_guru.php');
    exit;
}

// Check authentication
if (!is_logged_in()) {
    flash_message('warning', 'Silakan login terlebih dahulu.');
    redirect('../pages/login.php');
    exit;
}

// Check role - only guru can access
$user = get_user();
if ($user['role'] !== 'guru') {
    flash_message('danger', 'Anda tidak memiliki akses ke fitur ini.');
    redirect('../pages/dashboard_student.php');
    exit;
}

$action = isset($_POST['action']) ? sanitize_input($_POST['action']) : '';

switch ($action) {
    case 'add_comment':
        handleAddComment();
        break;
    default:
        flash_message('danger', 'Aksi tidak valid.');
        redirect('../pages/dashboard_guru.php');
        break;
}

/**
 * Add a comment/evaluation for a student
 */
function handleAddComment()
{
    // CSRF verification
    $csrf_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
    if (!verify_csrf_token($csrf_token)) {
        flash_message('danger', 'Token keamanan tidak valid. Silakan coba lagi.');
        redirect('../pages/dashboard_guru.php');
        return;
    }

    $guru_id = $_SESSION['user_id'];
    $student_id = isset($_POST['student_id']) ? (int) $_POST['student_id'] : 0;
    $comment_text = isset($_POST['comment_text']) ? trim($_POST['comment_text']) : '';

    // Validate inputs
    if ($student_id <= 0) {
        flash_message('danger', 'ID siswa tidak valid.');
        redirect('../pages/dashboard_guru.php');
        return;
    }

    if (empty($comment_text)) {
        flash_message('danger', 'Komentar tidak boleh kosong.');
        redirect('../pages/dashboard_guru.php');
        return;
    }

    if (strlen($comment_text) > 1000) {
        flash_message('danger', 'Komentar terlalu panjang (maksimal 1000 karakter).');
        redirect('../pages/dashboard_guru.php');
        return;
    }

    // Connect to database
    $pdo = getDBConnection();
    if (!$pdo) {
        flash_message('danger', 'Koneksi database gagal. Silakan coba lagi.');
        redirect('../pages/dashboard_guru.php');
        return;
    }

    try {
        // Validate that guru is linked to this student via invite_codes
        $linkStmt = $pdo->prepare(
            'SELECT id FROM invite_codes WHERE student_id = :student_id AND used_by_guru_id = :guru_id LIMIT 1'
        );
        $linkStmt->execute([
            ':student_id' => $student_id,
            ':guru_id' => $guru_id,
        ]);

        if (!$linkStmt->fetch()) {
            flash_message('danger', 'Anda tidak terhubung dengan siswa ini.');
            redirect('../pages/dashboard_guru.php');
            return;
        }

        // Insert comment
        $insertStmt = $pdo->prepare(
            'INSERT INTO guru_comments (guru_id, student_id, comment_text, created_at) VALUES (:guru_id, :student_id, :comment_text, NOW())'
        );
        $insertStmt->execute([
            ':guru_id' => $guru_id,
            ':student_id' => $student_id,
            ':comment_text' => $comment_text,
        ]);

        flash_message('success', 'Komentar berhasil ditambahkan.');
        redirect('../pages/dashboard_guru.php');

    } catch (PDOException $e) {
        error_log('Guru comment error: ' . $e->getMessage());
        flash_message('danger', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        redirect('../pages/dashboard_guru.php');
    }
}
