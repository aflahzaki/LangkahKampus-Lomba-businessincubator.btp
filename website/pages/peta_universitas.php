<?php
$page_title = 'Peta Universitas';
$use_leaflet = true;
include '../includes/header.php';
?>

<div class="map-page">
    <div class="map-container">
        <!-- Sidebar -->
        <div class="map-sidebar">
            <h3><i class="fas fa-map-marked-alt"></i> Filter Universitas</h3>

            <!-- Radius Filter -->
            <div class="form-group">
                <label class="form-label">Radius: <span id="radiusValue">500 km</span></label>
                <input type="range" id="radiusSlider" min="0" max="500" value="500" class="form-control" style="padding:0;">
            </div>

            <!-- Province Filter -->
            <div class="form-group">
                <label class="form-label">Provinsi</label>
                <select id="provinceFilter" class="form-control">
                    <option value="">Semua Provinsi</option>
                    <option value="DKI Jakarta">DKI Jakarta</option>
                    <option value="Jawa Barat">Jawa Barat</option>
                    <option value="Jawa Tengah">Jawa Tengah</option>
                    <option value="Jawa Timur">Jawa Timur</option>
                    <option value="DI Yogyakarta">DI Yogyakarta</option>
                    <option value="Sumatera Utara">Sumatera Utara</option>
                    <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                </select>
            </div>

            <!-- Type Filter -->
            <div class="form-group">
                <label class="form-label">Tipe Universitas</label>
                <select id="typeFilter" class="form-control">
                    <option value="">PTN & PTS</option>
                    <option value="PTN">PTN</option>
                    <option value="PTS">PTS</option>
                </select>
            </div>

            <!-- Accreditation Filter -->
            <div class="form-group">
                <label class="form-label">Akreditasi</label>
                <select id="accreditationFilter" class="form-control">
                    <option value="">Semua Akreditasi</option>
                    <option value="A">Unggul (A)</option>
                    <option value="B">Baik Sekali (B)</option>
                    <option value="C">Baik (C)</option>
                </select>
            </div>

            <hr style="border-color:var(--color-border);margin:1rem 0;">

            <!-- Results Count -->
            <div class="d-flex align-center justify-between mb-2">
                <span class="text-muted" style="font-size:0.85rem;">Ditemukan:</span>
                <strong id="universityCount">10</strong> <span class="text-muted">universitas</span>
            </div>

            <!-- University List -->
            <div id="universityList" style="max-height:300px;overflow-y:auto;">
                <!-- Populated by JS -->
            </div>
        </div>

        <!-- Map -->
        <div id="map"></div>
    </div>
</div>

<style>
.university-list-item {
    padding: 0.75rem;
    border-bottom: 1px solid var(--color-border);
    cursor: pointer;
    transition: background var(--transition-fast);
}
.university-list-item:hover {
    background: rgba(26,115,232,0.05);
}
.university-list-item strong {
    display: block;
    font-size: 0.85rem;
    color: var(--color-primary);
}
.university-list-item small {
    color: var(--color-text-light);
    font-size: 0.75rem;
}
</style>

<?php include '../includes/footer.php'; ?>
