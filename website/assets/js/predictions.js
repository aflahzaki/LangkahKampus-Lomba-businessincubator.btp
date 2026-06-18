/**
 * LangkahKampus - Predictions JavaScript
 * Handles prediction form, result visualization, probability gauge,
 * Choice-2 trap warning, anti-bentrok stats, and recommendations
 */

document.addEventListener('DOMContentLoaded', function() {
    initPredictionForm();
    initProgramSearch();
});

/* === Prediction Form Handler === */
function initPredictionForm() {
    var form = document.getElementById('predictionForm');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!validateForm(form)) return;

        // Show loading
        var submitBtn = form.querySelector('button[type="submit"]');
        var originalBtnText = submitBtn.innerHTML;

        submitBtn.innerHTML = '<div class="spinner" style="width:20px;height:20px;margin:0 auto;border-width:2px;"></div>';
        submitBtn.disabled = true;

        // Collect form data
        var formData = collectPredictionData(form);

        // Submit to API
        ajaxRequest('../api/predict.php', 'POST', formData, function(error, response) {
            submitBtn.innerHTML = originalBtnText;
            submitBtn.disabled = false;

            if (error) {
                showToast('danger', 'Gagal memproses prediksi: ' + error);
                return;
            }

            displayPredictionResult(response);
            displayChoice2Trap(response);
            displayAntiBentrokStats(response);
            displayRecommendations(response);
            displayWhatIfSimulator(response);
        });
    });
}

/* === Collect Form Data === */
function collectPredictionData(form) {
    var data = {
        scores: {},
        school_ranking: parseInt(form.querySelector('[name="school_ranking"]').value) || 0,
        total_students: parseInt(form.querySelector('[name="total_students"]').value) || 0,
        school_accreditation: form.querySelector('[name="school_accreditation"]').value,
        target_program_id: form.querySelector('[name="target_program"]').value
    };

    // Collect semester scores
    var subjects = ['matematika', 'b_indonesia', 'b_inggris', 'fisika', 'kimia', 'biologi'];
    subjects.forEach(function(subject) {
        data.scores[subject] = {};
        for (var sem = 1; sem <= 5; sem++) {
            var input = form.querySelector('[name="' + subject + '_sem' + sem + '"]');
            if (input) {
                data.scores[subject]['sem' + sem] = parseFloat(input.value) || 0;
            }
        }
    });

    return data;
}

/* === Display Prediction Result (Gauge) === */
function displayPredictionResult(response) {
    var resultSection = document.getElementById('predictionResult');
    if (!resultSection) return;

    resultSection.classList.remove('hidden');
    resultSection.scrollIntoView({ behavior: 'smooth', block: 'start' });

    var probability = response.probability || 0;
    var confidence_lower = response.confidence_lower || 0;
    var confidence_upper = response.confidence_upper || 0;
    var features = response.feature_importances || {};

    // Animate gauge
    animateGauge(probability);

    // Update confidence interval
    updateConfidenceBar(probability, confidence_lower, confidence_upper);

    // Update feature importance chart
    displayFeatureImportance(features);

    // Update text
    var statusEl = document.getElementById('predictionStatus');
    if (statusEl) {
        var color = probability >= 70 ? 'green' : (probability >= 40 ? 'orange' : 'red');
        var status = probability >= 70 ? 'Peluang Tinggi' : (probability >= 40 ? 'Peluang Sedang' : 'Peluang Rendah');
        statusEl.textContent = status;
        statusEl.style.color = color === 'green' ? '#27AE60' : (color === 'orange' ? '#F39C12' : '#C0392B');
    }
}

/* === Display Choice-2 Trap Warning === */
function displayChoice2Trap(response) {
    var warningEl = document.getElementById('choice2TrapWarning');
    if (!warningEl) return;

    if (response.blocks_choice2) {
        warningEl.classList.remove('hidden');
        warningEl.style.animation = 'fadeIn 0.5s ease';
    } else {
        warningEl.classList.add('hidden');
    }
}

/* === Display Anti-Bentrok Statistics === */
function displayAntiBentrokStats(response) {
    var statsEl = document.getElementById('antiBentrokStats');
    if (!statsEl) return;

    var peerCount = response.peer_count || 0;

    if (peerCount > 0) {
        statsEl.classList.remove('hidden');
        statsEl.style.animation = 'fadeIn 0.5s ease';

        var textEl = document.getElementById('peerStatText');
        var countEl = document.getElementById('peerCountValue');
        var barEl = document.getElementById('peerProgressBar');
        var riskEl = document.getElementById('peerRiskText');

        if (textEl) {
            textEl.innerHTML = '<strong>' + peerCount + ' siswa</strong> dari sekolahmu juga memilih prodi ini sebagai target.';
        }
        if (countEl) countEl.textContent = peerCount;

        // Progress bar (max at 10 peers for visual)
        var peerPercent = Math.min((peerCount / 10) * 100, 100);
        if (barEl) barEl.style.width = peerPercent + '%';

        if (riskEl) {
            if (peerCount >= 5) {
                riskEl.textContent = 'Tingkat persaingan internal TINGGI. Pertimbangkan prodi alternatif.';
                riskEl.style.color = '#C0392B';
            } else if (peerCount >= 3) {
                riskEl.textContent = 'Persaingan sedang. Pastikan peringkat Anda lebih unggul.';
                riskEl.style.color = '#F39C12';
            } else {
                riskEl.textContent = 'Persaingan rendah dari sekolah yang sama. Peluang baik!';
                riskEl.style.color = '#27AE60';
            }
        }
    } else {
        statsEl.classList.add('hidden');
    }
}

/* === Display Recommendations (if probability < 70%) === */
function displayRecommendations(response) {
    var recSection = document.getElementById('recommendationsSection');
    var recCards = document.getElementById('recommendationCards');
    if (!recSection || !recCards) return;

    var probability = response.probability || 0;
    var recommendations = response.recommendations || [];

    if (probability < 70 && recommendations.length > 0) {
        recSection.classList.remove('hidden');
        recSection.style.animation = 'fadeIn 0.5s ease';
        recCards.innerHTML = '';

        recommendations.forEach(function(rec, index) {
            var card = document.createElement('div');
            card.style.cssText = 'background:var(--color-bg);border-radius:var(--radius-sm);padding:0.75rem;margin-bottom:0.5rem;';
            card.innerHTML = '<div style="display:flex;align-items:center;justify-content:space-between;">' +
                '<div>' +
                '<strong style="font-size:0.9rem;">' + rec.name + '</strong><br>' +
                '<small style="color:var(--color-text-light);">' + rec.university + '</small>' +
                '</div>' +
                '<span style="font-size:1.1rem;font-weight:700;color:#27AE60;">' + rec.probability + '%</span>' +
                '</div>' +
                (rec.change_needed ? '<small style="color:var(--color-accent-blue);"><i class="fas fa-info-circle"></i> ' + rec.change_needed + '</small>' : '');
            recCards.appendChild(card);
        });
    } else {
        recSection.classList.add('hidden');
    }
}

/* === Display What-If Simulator === */
function displayWhatIfSimulator(response) {
    var simEl = document.getElementById('whatIfSimulator');
    if (!simEl) return;

    simEl.classList.remove('hidden');
    simEl.style.animation = 'fadeIn 0.5s ease';

    // Store base probability for slider calculation
    window._baseProbability = response.probability || 0;
}

/* === What-If Slider Update === */
function updateWhatIf(value) {
    var labelEl = document.getElementById('whatIfValue');
    var resultEl = document.getElementById('whatIfResult');
    if (labelEl) labelEl.textContent = '+' + value;

    var baseProbability = window._baseProbability || 50;
    var bonus = parseFloat(value) * 2.5;
    var newProb = Math.min(99, Math.round(baseProbability + bonus));

    if (resultEl) {
        resultEl.textContent = newProb + '%';
        resultEl.style.color = newProb >= 70 ? '#27AE60' : (newProb >= 40 ? '#F39C12' : '#C0392B');
    }
}

/* === Animated Circular Gauge === */
function animateGauge(percentage) {
    var gaugeEl = document.getElementById('gaugeCircle');
    var gaugeText = document.getElementById('gaugePercentage');
    if (!gaugeEl || !gaugeText) return;

    var radius = 90;
    var circumference = 2 * Math.PI * radius;

    gaugeEl.style.strokeDasharray = circumference;
    gaugeEl.style.strokeDashoffset = circumference;

    // Set color based on percentage
    var color;
    if (percentage >= 70) {
        color = '#27AE60';
    } else if (percentage >= 40) {
        color = '#F39C12';
    } else {
        color = '#C0392B';
    }
    gaugeEl.style.stroke = color;

    // Animate
    var targetOffset = circumference - (percentage / 100) * circumference;

    setTimeout(function() {
        gaugeEl.style.strokeDashoffset = targetOffset;

        // Counter for text
        var current = 0;
        var duration = 1500;
        var steps = 60;
        var increment = percentage / steps;
        var stepTime = duration / steps;

        var timer = setInterval(function() {
            current += increment;
            if (current >= percentage) {
                current = percentage;
                clearInterval(timer);
            }
            gaugeText.textContent = Math.round(current) + '%';
        }, stepTime);
    }, 200);
}

/* === Confidence Interval Bar === */
function updateConfidenceBar(probability, lower, upper) {
    var rangeEl = document.getElementById('confidenceRange');
    var pointEl = document.getElementById('confidencePoint');
    var lowerText = document.getElementById('confidenceLower');
    var upperText = document.getElementById('confidenceUpper');

    if (!rangeEl || !pointEl) return;

    rangeEl.style.left = (lower * 100) + '%';
    rangeEl.style.width = ((upper - lower) * 100) + '%';
    pointEl.style.left = (probability * 100) + '%';

    if (lowerText) lowerText.textContent = Math.round(lower * 100) + '%';
    if (upperText) upperText.textContent = Math.round(upper * 100) + '%';
}

/* === Feature Importance Chart === */
function displayFeatureImportance(features) {
    var container = document.getElementById('featureImportance');
    if (!container) return;

    container.innerHTML = '';

    var sorted = Object.entries(features).sort(function(a, b) { return b[1] - a[1]; });

    sorted.forEach(function(entry, index) {
        var name = entry[0];
        var value = entry[1];
        var bar = document.createElement('div');
        bar.className = 'feature-bar-item';
        bar.style.animationDelay = (index * 0.1) + 's';
        bar.innerHTML = '<div class="feature-bar-label">' +
            '<span>' + formatFeatureName(name) + '</span>' +
            '<span>' + Math.round(value * 100) + '%</span></div>' +
            '<div class="progress-bar"><div class="progress-fill" style="width: 0%; transition-delay: ' + (index * 0.1 + 0.5) + 's;"></div></div>';
        container.appendChild(bar);

        // Animate width
        setTimeout(function() {
            bar.querySelector('.progress-fill').style.width = (value * 100) + '%';
        }, 100);
    });
}

function formatFeatureName(name) {
    var map = {
        'gpa_average': 'Rata-rata Nilai',
        'school_ranking': 'Peringkat Sekolah',
        'school_accreditation': 'Akreditasi Sekolah',
        'competition_ratio': 'Rasio Kompetisi',
        'historical_acceptance': 'Riwayat Penerimaan',
        'subject_relevance': 'Relevansi Mata Pelajaran'
    };
    return map[name] || name.replace(/_/g, ' ');
}

/* === Program Search Autocomplete === */
function initProgramSearch() {
    var searchInput = document.getElementById('programSearch');
    var resultsContainer = document.getElementById('programResults');
    var hiddenInput = document.querySelector('[name="target_program"]');

    if (!searchInput || !resultsContainer) return;

    var debounceTimer;

    searchInput.addEventListener('input', function() {
        var query = this.value.trim();

        clearTimeout(debounceTimer);

        if (query.length < 2) {
            resultsContainer.innerHTML = '';
            resultsContainer.classList.add('hidden');
            return;
        }

        debounceTimer = setTimeout(function() {
            ajaxRequest('../api/search_programs.php?q=' + encodeURIComponent(query), 'GET', null, function(error, response) {
                if (error) return;

                resultsContainer.innerHTML = '';
                resultsContainer.classList.remove('hidden');

                if (response.programs && response.programs.length) {
                    response.programs.forEach(function(program) {
                        var item = document.createElement('div');
                        item.className = 'search-result-item';
                        item.innerHTML = '<strong>' + program.name + '</strong><br><small>' + program.university + ' - ' + program.degree + '</small>';
                        item.addEventListener('click', function() {
                            searchInput.value = program.name + ' - ' + program.university;
                            if (hiddenInput) hiddenInput.value = program.id;
                            resultsContainer.classList.add('hidden');
                        });
                        resultsContainer.appendChild(item);
                    });
                } else {
                    resultsContainer.innerHTML = '<div class="search-result-item text-muted">Tidak ditemukan</div>';
                }
            });
        }, 300);
    });

    // Close results on outside click
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
            resultsContainer.classList.add('hidden');
        }
    });
}
