<?php
/**
 * LangkahKampus - Recommendation API
 * POST: Generates alternative program recommendations based on SIDATA competition ratios
 * 
 * Accepts: { target_kode_prodi: "string" } OR { target_program_name: "string" }
 * Returns: target program info + top 5 alternatives with lower competition ratios
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed. Use POST.']);
    exit;
}

require_once __DIR__ . '/../config/database.php';

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON input']);
    exit;
}

$targetKodeProdi = isset($input['target_kode_prodi']) ? trim($input['target_kode_prodi']) : '';
$targetProgramName = isset($input['target_program_name']) ? trim($input['target_program_name']) : '';

if (empty($targetKodeProdi) && empty($targetProgramName)) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing target_kode_prodi or target_program_name']);
    exit;
}

$pdo = getDBConnection();
if (!$pdo) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

try {
    // Step 1: Find the target program in sidata_prodi
    $target = null;

    if (!empty($targetKodeProdi)) {
        $stmt = $pdo->prepare(
            'SELECT sp.kode_prodi, sp.kode_univ, sp.nama_prodi, sp.jenjang,
                    sp.daya_tampung_2023, sp.peminat_2022, sp.daya_tampung_2022,
                    su.nama_univ
             FROM sidata_prodi sp
             INNER JOIN sidata_universitas su ON sp.kode_univ = su.kode_univ
             WHERE sp.kode_prodi = :kode_prodi
             LIMIT 1'
        );
        $stmt->execute([':kode_prodi' => $targetKodeProdi]);
        $target = $stmt->fetch();
    }

    if (!$target && !empty($targetProgramName)) {
        $stmt = $pdo->prepare(
            'SELECT sp.kode_prodi, sp.kode_univ, sp.nama_prodi, sp.jenjang,
                    sp.daya_tampung_2023, sp.peminat_2022, sp.daya_tampung_2022,
                    su.nama_univ
             FROM sidata_prodi sp
             INNER JOIN sidata_universitas su ON sp.kode_univ = su.kode_univ
             WHERE sp.nama_prodi LIKE :nama_prodi
             LIMIT 1'
        );
        $stmt->execute([':nama_prodi' => '%' . $targetProgramName . '%']);
        $target = $stmt->fetch();
    }

    if (!$target) {
        http_response_code(404);
        echo json_encode(['error' => 'Target program not found in SIDATA']);
        exit;
    }

    // Step 2: Calculate target competition ratio
    $targetDayaTampung = (int) $target['daya_tampung_2022'];
    $targetPeminat = (int) $target['peminat_2022'];
    $targetRatio = ($targetDayaTampung > 0) ? round($targetPeminat / $targetDayaTampung, 2) : 0;

    // Step 3: Extract search keywords from nama_prodi
    $keywords = extractKeywords($target['nama_prodi']);

    // Step 4: Find similar programs from different universities with LOWER ratios
    $recommendations = [];

    foreach ($keywords as $keyword) {
        $searchTerm = '%' . $keyword . '%';

        $stmt = $pdo->prepare(
            'SELECT sp.kode_prodi, sp.kode_univ, sp.nama_prodi, sp.jenjang,
                    sp.daya_tampung_2023, sp.peminat_2022, sp.daya_tampung_2022,
                    su.nama_univ
             FROM sidata_prodi sp
             INNER JOIN sidata_universitas su ON sp.kode_univ = su.kode_univ
             WHERE sp.nama_prodi LIKE :keyword
               AND sp.kode_univ != :target_univ
               AND sp.kode_prodi != :target_prodi
               AND sp.daya_tampung_2022 > 0
               AND sp.peminat_2022 > 0
             ORDER BY (sp.peminat_2022 / sp.daya_tampung_2022) ASC
             LIMIT 20'
        );

        $stmt->execute([
            ':keyword' => $searchTerm,
            ':target_univ' => $target['kode_univ'],
            ':target_prodi' => $target['kode_prodi'],
        ]);

        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $rowDayaTampung = (int) $row['daya_tampung_2022'];
            $rowPeminat = (int) $row['peminat_2022'];
            $rowRatio = ($rowDayaTampung > 0) ? round($rowPeminat / $rowDayaTampung, 2) : 0;

            // Only include programs with LOWER competition ratio
            if ($rowRatio >= $targetRatio) {
                continue;
            }

            // Calculate percentage difference
            $ratioDifference = ($targetRatio > 0)
                ? round((($targetRatio - $rowRatio) / $targetRatio) * 100, 1)
                : 0;

            // Avoid duplicates
            $key = $row['kode_prodi'];
            if (!isset($recommendations[$key])) {
                $recommendations[$key] = [
                    'kode_prodi' => $row['kode_prodi'],
                    'nama_prodi' => $row['nama_prodi'],
                    'universitas' => $row['nama_univ'],
                    'jenjang' => $row['jenjang'],
                    'daya_tampung_2023' => (int) $row['daya_tampung_2023'],
                    'peminat_2022' => (int) $row['peminat_2022'],
                    'ratio' => $rowRatio,
                    'ratio_difference_percent' => $ratioDifference,
                ];
            }
        }

        // Break if we have enough results
        if (count($recommendations) >= 5) {
            break;
        }
    }

    // Sort by ratio ascending (lowest competition = best recommendation)
    usort($recommendations, function ($a, $b) {
        return $a['ratio'] <=> $b['ratio'];
    });

    // Return top 5
    $recommendations = array_slice(array_values($recommendations), 0, 5);

    // Build response
    echo json_encode([
        'success' => true,
        'target' => [
            'kode_prodi' => $target['kode_prodi'],
            'nama_prodi' => $target['nama_prodi'],
            'universitas' => $target['nama_univ'],
            'jenjang' => $target['jenjang'],
            'daya_tampung_2023' => (int) $target['daya_tampung_2023'],
            'peminat_2022' => (int) $target['peminat_2022'],
            'ratio' => $targetRatio,
        ],
        'recommendations' => $recommendations,
        'generated_at' => date('c'),
    ]);

} catch (PDOException $e) {
    error_log('Recommendation error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
}

/**
 * Extract search keywords from a program name.
 * Strategy: use full name first, then try shorter keywords (key subject words),
 * then first 2 words as fallback.
 */
function extractKeywords($namaProdi)
{
    $keywords = [];

    // Full name as first search
    $keywords[] = $namaProdi;

    // Common key subject words to extract
    $subjectKeywords = [
        'INFORMATIKA', 'KEDOKTERAN', 'MANAJEMEN', 'HUKUM', 'FARMASI',
        'AKUNTANSI', 'EKONOMI', 'TEKNIK', 'PENDIDIKAN', 'ARSITEKTUR',
        'PSIKOLOGI', 'BIOLOGI', 'KIMIA', 'FISIKA', 'MATEMATIKA',
        'KOMUNIKASI', 'ADMINISTRASI', 'KEPERAWATAN', 'GIZI', 'KESEHATAN',
        'SASTRA', 'ILMU KOMPUTER', 'SISTEM INFORMASI', 'TEKNIK SIPIL',
        'TEKNIK MESIN', 'TEKNIK ELEKTRO', 'TEKNIK KIMIA', 'TEKNIK INDUSTRI',
        'AGROTEKNOLOGI', 'AGRIBISNIS', 'PETERNAKAN', 'KEHUTANAN',
    ];

    $upperName = strtoupper($namaProdi);

    foreach ($subjectKeywords as $keyword) {
        if (strpos($upperName, $keyword) !== false) {
            $keywords[] = $keyword;
        }
    }

    // First 2 words as fallback
    $words = explode(' ', trim($namaProdi));
    if (count($words) >= 2) {
        $keywords[] = $words[0] . ' ' . $words[1];
    }

    // Remove duplicates while preserving order
    return array_unique($keywords);
}
