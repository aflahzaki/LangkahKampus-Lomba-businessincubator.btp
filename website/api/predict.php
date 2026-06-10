<?php
/**
 * LangkahKampus - Prediction API
 * POST: Receives student data + target program, returns prediction
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

// Get input data
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON input']);
    exit;
}

// Validate required fields
$required = ['scores', 'school_ranking', 'total_students', 'school_accreditation', 'target_program_id'];
foreach ($required as $field) {
    if (!isset($input[$field])) {
        http_response_code(400);
        echo json_encode(['error' => "Missing required field: $field"]);
        exit;
    }
}

// Calculate mock prediction
$prediction = calculatePrediction($input);

// Return response
http_response_code(200);
echo json_encode($prediction);

/**
 * Calculate mock prediction based on input data
 * In production, this would call the ML model API
 */
function calculatePrediction($input)
{
    $scores = $input['scores'];
    $ranking = (int)$input['school_ranking'];
    $totalStudents = (int)$input['total_students'];
    $accreditation = $input['school_accreditation'];

    // Calculate average GPA across all subjects and semesters
    $totalScore = 0;
    $scoreCount = 0;

    foreach ($scores as $subject => $semesters) {
        foreach ($semesters as $sem => $score) {
            if ($score > 0) {
                $totalScore += $score;
                $scoreCount++;
            }
        }
    }

    $avgGPA = $scoreCount > 0 ? $totalScore / $scoreCount : 75;

    // Ranking percentile (lower is better)
    $rankPercentile = $totalStudents > 0 ? ($ranking / $totalStudents) : 0.5;

    // Base probability calculation
    $baseProbability = 0;

    // GPA contribution (40% weight)
    $gpaFactor = min(1, max(0, ($avgGPA - 60) / 40)); // normalize 60-100 to 0-1
    $baseProbability += $gpaFactor * 0.40;

    // Ranking contribution (25% weight)
    $rankFactor = max(0, 1 - $rankPercentile); // lower percentile = higher factor
    $baseProbability += $rankFactor * 0.25;

    // Accreditation contribution (15% weight)
    $accreditationMap = ['A' => 1.0, 'B' => 0.7, 'C' => 0.4];
    $accFactor = $accreditationMap[$accreditation] ?? 0.5;
    $baseProbability += $accFactor * 0.15;

    // Random competition factor (20% weight) - simulates program difficulty
    $competitionFactor = 0.3 + (mt_rand(0, 100) / 200); // 0.3 to 0.8
    $baseProbability += $competitionFactor * 0.20;

    // Clamp to 0.05-0.95 range
    $probability = max(0.05, min(0.95, $baseProbability));

    // Confidence interval (wider for edge cases)
    $ciWidth = 0.08 + (abs($probability - 0.5) * 0.1);
    $confidenceLower = max(0.01, $probability - $ciWidth);
    $confidenceUpper = min(0.99, $probability + $ciWidth);

    // Feature importances
    $featureImportances = [
        'gpa_average' => 0.35 + (mt_rand(0, 10) / 100),
        'school_ranking' => 0.22 + (mt_rand(0, 8) / 100),
        'school_accreditation' => 0.15 + (mt_rand(0, 5) / 100),
        'competition_ratio' => 0.12 + (mt_rand(0, 5) / 100),
        'historical_acceptance' => 0.09 + (mt_rand(0, 5) / 100),
        'subject_relevance' => 0.07 + (mt_rand(0, 5) / 100)
    ];

    // Normalize feature importances to sum to 1
    $total = array_sum($featureImportances);
    foreach ($featureImportances as $key => $value) {
        $featureImportances[$key] = round($value / $total, 4);
    }

    return [
        'success' => true,
        'probability' => round($probability * 100, 1),
        'confidence_lower' => round($confidenceLower, 4),
        'confidence_upper' => round($confidenceUpper, 4),
        'model_version' => 'GBM-v2.1.0',
        'feature_importances' => $featureImportances,
        'input_summary' => [
            'avg_gpa' => round($avgGPA, 2),
            'ranking_percentile' => round($rankPercentile * 100, 1) . '%',
            'school_accreditation' => $accreditation,
            'subjects_count' => count($scores)
        ],
        'timestamp' => date('c')
    ];
}
