<?php
/**
 * LangkahKampus - Recommendation API
 * POST: Generates alternative program recommendations with What-If explanations
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

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['prediction_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing prediction_id']);
    exit;
}

// Generate mock recommendations
$recommendations = generateRecommendations($input['prediction_id']);

http_response_code(200);
echo json_encode([
    'success' => true,
    'prediction_id' => $input['prediction_id'],
    'recommendations' => $recommendations,
    'generated_at' => date('c')
]);

function generateRecommendations($predictionId)
{
    $alternatives = [
        [
            'program' => 'Farmasi',
            'university' => 'Universitas Indonesia',
            'degree' => 'S1',
            'probability' => 0.85,
            'rank_order' => 1,
            'reason' => 'Kompetisi lebih rendah dengan persyaratan mata pelajaran yang sesuai',
            'changes_needed' => [
                ['type' => 'switch_program', 'description' => 'Ganti target ke Farmasi UI'],
                ['type' => 'maintain', 'description' => 'Nilai Kimia sudah memenuhi syarat (88.2)']
            ]
        ],
        [
            'program' => 'Ilmu Biomedis',
            'university' => 'Universitas Indonesia',
            'degree' => 'S1',
            'probability' => 0.78,
            'rank_order' => 2,
            'reason' => 'Program baru dengan rasio kompetisi rendah, sesuai profil IPA',
            'changes_needed' => [
                ['type' => 'switch_program', 'description' => 'Ganti target ke Ilmu Biomedis'],
                ['type' => 'info', 'description' => 'Rasio kompetisi 40% lebih rendah dari Kedokteran']
            ]
        ],
        [
            'program' => 'Kedokteran',
            'university' => 'Universitas Padjadjaran',
            'degree' => 'S1',
            'probability' => 0.71,
            'rank_order' => 3,
            'reason' => 'Tetap di jurusan Kedokteran dengan kompetisi lebih rendah',
            'changes_needed' => [
                ['type' => 'switch_university', 'description' => 'Ganti universitas ke UNPAD'],
                ['type' => 'info', 'description' => 'Kuota lebih besar: 60 vs 40 mahasiswa']
            ]
        ],
        [
            'program' => 'Teknik Biomedis',
            'university' => 'Institut Teknologi Bandung',
            'degree' => 'S1',
            'probability' => 0.68,
            'rank_order' => 4,
            'reason' => 'Kombinasi minat kesehatan dan teknologi',
            'changes_needed' => [
                ['type' => 'switch_program', 'description' => 'Beralih ke Teknik Biomedis ITB'],
                ['type' => 'improve', 'description' => 'Jika nilai Matematika naik 3 poin, peluang menjadi 74%']
            ]
        ],
        [
            'program' => 'Gizi Kesehatan',
            'university' => 'Universitas Gadjah Mada',
            'degree' => 'S1',
            'probability' => 0.82,
            'rank_order' => 5,
            'reason' => 'Bidang kesehatan dengan tingkat penerimaan lebih tinggi',
            'changes_needed' => [
                ['type' => 'switch_program', 'description' => 'Ganti ke Gizi Kesehatan UGM'],
                ['type' => 'maintain', 'description' => 'Profil akademik sudah sangat sesuai']
            ]
        ]
    ];

    return $alternatives;
}
