"""
Generate Stage 4: Phase B - Business Architecture
TOGAF Enterprise Architecture - LangkahKampus EduTech

This script generates the Stage 4 document covering:
- Architecture Definition Document (Baseline & Target Business Architecture)
- Gap Analysis
- Architecture Requirements Specification
- Architecture Principles (updated)
- Business Principles, Goals, Drivers (updated)
- Statement of Architecture Work (updated)
"""

import os
import sys

sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))

from docx_utils import (
    create_document,
    add_cover_page,
    add_table_of_contents,
    add_heading,
    add_paragraph,
    add_bullet_list,
    add_numbered_list,
    add_table,
    add_references,
    save_document,
)


def generate_stage4():
    """Generate Stage 4: Phase B - Business Architecture."""
    doc = create_document()

    # Cover Page
    add_cover_page(
        doc,
        title="Phase B: Arsitektur Bisnis",
        stage_name="Stage 4 - Arsitektur Bisnis (Business Architecture)"
    )

    # Table of Contents
    toc_sections = [
        ("Dokumen Definisi Arsitektur - Bisnis", [
            "Arsitektur Bisnis Baseline (As-Is)",
            "Arsitektur Bisnis Target (To-Be)",
            "Gap Analysis",
        ]),
        ("Spesifikasi Kebutuhan Arsitektur", [
            "Kebutuhan Fungsional (Diperbarui)",
            "Kebutuhan Non-Fungsional (Diperbarui)",
        ]),
        ("Prinsip Arsitektur (Diperbarui)", []),
        ("Prinsip, Tujuan, dan Pendorong Bisnis (Diperbarui)", []),
        ("Pernyataan Pekerjaan Arsitektur (Diperbarui)", []),
        ("Daftar Pustaka", []),
    ]
    add_table_of_contents(doc, toc_sections)

    # ==========================================================================
    # SECTION 1: ARCHITECTURE DEFINITION DOCUMENT
    # ==========================================================================
    add_heading(doc, "1. Dokumen Definisi Arsitektur - Bisnis", level=1)

    add_paragraph(doc,
        "Architecture Definition Document pada fase Business Architecture mendokumentasikan "
        "arsitektur bisnis LangkahKampus secara komprehensif, mencakup kondisi saat ini "
        "(baseline/as-is) dan kondisi yang diinginkan (target/to-be). Dokumen ini menjadi "
        "dasar untuk analisis gap dan perencanaan transisi dari arsitektur bisnis yang ada "
        "menuju arsitektur bisnis target yang mendukung visi platform EduTech LangkahKampus."
    )

    # --------------------------------------------------------------------------
    # 1.1 BASELINE BUSINESS ARCHITECTURE (AS-IS)
    # --------------------------------------------------------------------------
    add_heading(doc, "1.1 Arsitektur Bisnis Baseline (As-Is)", level=2)

    add_paragraph(doc,
        "Arsitektur bisnis baseline menggambarkan kondisi proses SNBP saat ini sebelum "
        "adanya intervensi platform LangkahKampus. Kondisi ini mencerminkan proses manual "
        "dan fragmentasi informasi yang menjadi tantangan utama dalam ekosistem pendidikan."
    )

    # Organization/Actor Catalog
    add_heading(doc, "1.1.1 Organization/Actor Catalog (Baseline)", level=3)

    add_table(doc,
        headers=["Actor", "Deskripsi", "Peran dalam Proses SNBP"],
        rows=[
            ["Siswa SMA/MA/SMK", "Peserta didik kelas 12 yang akan mendaftar perguruan tinggi", "Mengumpulkan informasi, memilih prodi, mendaftar SNBP secara mandiri"],
            ["Guru BK", "Guru Bimbingan Konseling di sekolah", "Memberikan konseling manual, merekomendasikan prodi berdasarkan pengalaman pribadi"],
            ["Kepala Sekolah", "Pimpinan satuan pendidikan", "Memvalidasi dan menandatangani rekomendasi sekolah"],
            ["Operator Sekolah", "Staf TI/administrasi sekolah", "Menginput data siswa ke portal LTMPT, mengelola akun sekolah"],
            ["LTMPT", "Lembaga Tes Masuk Perguruan Tinggi", "Menyelenggarakan SNBP, menetapkan kuota, mengumumkan hasil"],
            ["Orang Tua/Wali", "Penanggung jawab siswa", "Mendampingi keputusan, mencari informasi dari alumni/kenalan"],
            ["Alumni/Senior", "Lulusan sekolah yang sudah kuliah", "Memberikan informasi informal tentang pengalaman SNBP"],
            ["Bimbel/Konsultan", "Lembaga bimbingan belajar", "Memberikan panduan umum (tidak spesifik SNBP) dengan biaya mahal"],
        ],
        title="Organization/Actor Catalog (Baseline)",
        table_number=1
    )

    # Business Service/Function Catalog
    add_heading(doc, "1.1.2 Business Service/Function Catalog (Baseline)", level=3)

    add_table(doc,
        headers=["Service/Function", "Provider", "Deskripsi", "Mode Delivery"],
        rows=[
            ["Konseling Pilihan Prodi", "Guru BK", "Konsultasi tatap muka one-on-one dengan siswa tentang pilihan prodi", "Manual, tatap muka"],
            ["Pengumpulan Data Rapor", "Operator Sekolah", "Mengumpulkan dan merekap nilai rapor siswa secara manual dari buku rapor", "Manual, spreadsheet"],
            ["Pencarian Informasi Prodi", "Siswa (mandiri)", "Siswa mencari informasi prodi melalui internet, brosur, dan bertanya ke senior", "Self-service, tidak terstruktur"],
            ["Input Data LTMPT", "Operator Sekolah", "Menginput data siswa dan nilai rapor ke portal PDSS LTMPT", "Manual, web portal"],
            ["Rekomendasi Sekolah", "Kepala Sekolah", "Memberikan surat rekomendasi berdasarkan input Guru BK", "Manual, paper-based"],
            ["Koordinasi Internal", "Guru BK", "Mengkoordinasikan pilihan siswa agar tidak terjadi bentrokan masif", "Manual, spreadsheet/papan tulis"],
            ["Informasi dari Alumni", "Alumni", "Sharing pengalaman melalui grup WhatsApp atau kunjungan informal", "Informal, tidak terstruktur"],
        ],
        title="Business Service/Function Catalog (Baseline)",
        table_number=2
    )

    # Business Interaction Matrix
    add_heading(doc, "1.1.3 Business Interaction Matrix (Baseline)", level=3)

    add_table(doc,
        headers=["", "Siswa", "Guru BK", "Operator", "LTMPT", "Orang Tua", "Alumni"],
        rows=[
            ["Siswa", "-", "Konsultasi lisan", "Tidak langsung", "Portal SNBP", "Diskusi", "Chat informal"],
            ["Guru BK", "Konseling", "-", "Koordinasi manual", "Tidak langsung", "Rapat wali", "Tidak ada"],
            ["Operator", "Data entry", "Konfirmasi data", "-", "Upload PDSS", "Tidak ada", "Tidak ada"],
            ["LTMPT", "Pengumuman", "Tidak langsung", "Portal PDSS", "-", "Tidak ada", "Tidak ada"],
            ["Orang Tua", "Diskusi", "Rapat wali", "Tidak ada", "Lihat hasil", "-", "Bertanya"],
            ["Alumni", "Chat", "Tidak ada", "Tidak ada", "Tidak ada", "Bertanya", "-"],
        ],
        title="Business Interaction Matrix (Baseline)",
        table_number=3
    )

    # Actor/Role Matrix
    add_heading(doc, "1.1.4 Actor/Role Matrix (Baseline)", level=3)

    add_table(doc,
        headers=["Actor", "Information Provider", "Decision Maker", "Implementer", "Advisor"],
        rows=[
            ["Siswa", "Ya (data diri, nilai)", "Ya (pilihan prodi)", "Ya (mendaftar)", "Tidak"],
            ["Guru BK", "Terbatas", "Tidak", "Tidak", "Ya (utama)"],
            ["Operator Sekolah", "Ya (data administratif)", "Tidak", "Ya (input data)", "Tidak"],
            ["Kepala Sekolah", "Tidak", "Ya (validasi)", "Tidak", "Terbatas"],
            ["LTMPT", "Ya (aturan, kuota)", "Ya (seleksi)", "Ya (sistem)", "Tidak"],
            ["Orang Tua", "Terbatas", "Ya (persetujuan)", "Tidak", "Terbatas"],
        ],
        title="Actor/Role Matrix (Baseline)",
        table_number=4
    )

    # Goal/Objective/Service Diagram Description
    add_heading(doc, "1.1.5 Goal/Objective/Service Diagram (Baseline)", level=3)
    add_paragraph(doc,
        "Pada kondisi baseline, tujuan utama proses SNBP adalah memastikan siswa "
        "yang berprestasi dapat diterima di perguruan tinggi pilihan. Namun, "
        "pencapaian tujuan ini terhambat oleh:"
    )
    add_bullet_list(doc, [
        "Goal: Siswa diterima di prodi pilihan pertama - Service: Konseling manual Guru BK (efektivitas rendah, 40-50% akurasi informal)",
        "Goal: Menghindari Choice-2 Trap - Service: Tidak ada layanan khusus (siswa tidak menyadari masalah ini)",
        "Goal: Optimalisasi kuota sekolah - Service: Koordinasi manual Guru BK via spreadsheet (sering terjadi bentrokan)",
        "Goal: Informasi akurat tentang peluang - Service: Pencarian mandiri oleh siswa (fragmentasi, bias konfirmasi)",
    ])

    # Business Model Diagram Description
    add_heading(doc, "1.1.6 Business Model Diagram (Baseline)", level=3)
    add_paragraph(doc,
        "Model bisnis pada kondisi baseline bersifat informal dan non-komersial. "
        "Layanan bimbingan SNBP disediakan oleh sekolah sebagai bagian dari tugas "
        "Guru BK tanpa biaya tambahan. Alternatif komersial yang ada (bimbel) "
        "bersifat umum dan tidak fokus pada optimasi SNBP. Tidak ada entitas "
        "yang menyediakan layanan prediksi berbasis data secara spesifik untuk SNBP."
    )

    # Functional Decomposition Diagram
    add_heading(doc, "1.1.7 Functional Decomposition Diagram (Baseline)", level=3)
    add_paragraph(doc, "Dekomposisi fungsi pada proses SNBP baseline:")
    add_paragraph(doc, "1. Fungsi Persiapan SNBP:", bold=True)
    add_bullet_list(doc, [
        "1.1 Pengumpulan nilai rapor (manual dari buku rapor)",
        "1.2 Identifikasi minat siswa (kuesioner sederhana atau diskusi)",
        "1.3 Pencarian informasi prodi (internet, brosur, alumni)",
    ])
    add_paragraph(doc, "2. Fungsi Seleksi dan Penentuan Pilihan:", bold=True)
    add_bullet_list(doc, [
        "2.1 Analisis peluang oleh Guru BK (berdasarkan pengalaman)",
        "2.2 Konsultasi pilihan prodi (one-on-one dengan Guru BK)",
        "2.3 Koordinasi pilihan antar siswa (spreadsheet/papan)",
        "2.4 Finalisasi pilihan oleh siswa dan orang tua",
    ])
    add_paragraph(doc, "3. Fungsi Administratif:", bold=True)
    add_bullet_list(doc, [
        "3.1 Input data ke PDSS LTMPT",
        "3.2 Verifikasi data oleh kepala sekolah",
        "3.3 Submission pendaftaran SNBP",
    ])

    # Process Flow Diagram Description
    add_heading(doc, "1.1.8 Process Flow Diagram (Baseline)", level=3)
    add_paragraph(doc,
        "Alur proses SNBP pada kondisi baseline berlangsung secara sequential dan "
        "predominantly manual:"
    )
    add_numbered_list(doc, [
        "Siswa mengumpulkan nilai rapor semester 1-5 secara mandiri",
        "Siswa berkonsultasi dengan Guru BK tentang pilihan prodi (bergantung ketersediaan Guru BK)",
        "Guru BK memberikan saran berdasarkan pengalaman dan intuisi (tanpa data kuantitatif)",
        "Siswa mencari informasi tambahan dari internet, alumni, dan orang tua",
        "Guru BK mencoba mengkoordinasikan pilihan siswa via spreadsheet untuk menghindari bentrokan",
        "Operator sekolah menginput data siswa ke portal PDSS LTMPT",
        "Kepala sekolah memvalidasi data dan rekomendasi",
        "Siswa melakukan registrasi dan memilih prodi di portal SNBP",
        "Menunggu pengumuman hasil (tidak ada feedback atau tracking)",
        "Hasil diumumkan tanpa penjelasan (accepted/rejected tanpa reasoning)",
    ])

    add_paragraph(doc,
        "Kelemahan utama proses baseline: tidak ada data-driven decision support, "
        "tingginya ketergantungan pada satu Guru BK per sekolah, tidak ada mekanisme "
        "pencegahan bentrokan yang efektif, dan siswa di daerah terpinggirkan karena "
        "keterbatasan akses informasi."
    )

    # --------------------------------------------------------------------------
    # 1.2 TARGET BUSINESS ARCHITECTURE (TO-BE)
    # --------------------------------------------------------------------------
    add_heading(doc, "1.2 Arsitektur Bisnis Target (To-Be)", level=2)

    add_paragraph(doc,
        "Arsitektur bisnis target menggambarkan kondisi setelah platform LangkahKampus "
        "terimplementasi penuh, di mana proses SNBP didukung oleh teknologi prediktif, "
        "dashboard real-time, dan rekomendasi berbasis AI yang transparan."
    )

    # Organization/Actor Catalog (Target)
    add_heading(doc, "1.2.1 Organization/Actor Catalog (Target)", level=3)

    add_table(doc,
        headers=["Actor", "Deskripsi", "Peran dalam Proses SNBP Terintegrasi"],
        rows=[
            ["Siswa SMA/MA/SMK", "Pengguna utama platform LangkahKampus", "Menggunakan prediksi ML, menerima rekomendasi XAI, melakukan What-If analysis"],
            ["Guru BK", "Power user dashboard Anti-Bentrok", "Menggunakan dashboard untuk monitoring pilihan siswa, mencegah bentrokan, memberikan konseling data-driven"],
            ["Operator Sekolah", "Admin sekolah pada platform B2B", "Mengelola data siswa batch upload, konfigurasi sekolah, generate laporan"],
            ["Admin Platform", "Tim operasional LangkahKampus", "Monitoring platform, manajemen pengguna, konfigurasi ML model, customer support"],
            ["ML System", "Automated prediction engine", "Menghasilkan prediksi probabilitas, rekomendasi prodi, counterfactual explanations"],
            ["Payment System", "Automated payment processing", "Memproses pembayaran premium, mengelola subscription sekolah"],
            ["Notification System", "Automated communication", "Mengirim update, reminder deadline, hasil prediksi, dan alert bentrokan"],
            ["Data Pipeline", "Automated data processing", "Mengumpulkan, membersihkan, dan mengolah data untuk ML model training"],
            ["LTMPT", "Regulator SNBP", "Menyediakan aturan dan menyelenggarakan seleksi (tidak berubah)"],
            ["Orang Tua/Wali", "Supporting stakeholder", "Mengakses ringkasan prediksi anak, memahami rekomendasi melalui penjelasan XAI"],
        ],
        title="Organization/Actor Catalog (Target)",
        table_number=5
    )

    # Business Service/Function Catalog (Target)
    add_heading(doc, "1.2.2 Business Service/Function Catalog (Target)", level=3)

    add_table(doc,
        headers=["Service/Function", "Provider", "Deskripsi", "Mode Delivery"],
        rows=[
            ["Prediksi Probabilitas SNBP", "ML Engine (XGBoost+LightGBM)", "Prediksi probabilitas diterima di setiap prodi berdasarkan profil siswa", "Otomatis, real-time, API"],
            ["Rekomendasi Prodi (XAI)", "DiCE Engine", "Rekomendasi prodi optimal dengan penjelasan counterfactual yang transparan", "Otomatis, on-demand"],
            ["Dashboard Anti-Bentrok", "Platform LangkahKampus", "Visualisasi real-time pilihan siswa se-sekolah untuk mencegah bentrokan", "Real-time dashboard, web"],
            ["What-If Analysis", "ML Engine", "Simulasi perubahan parameter input dan dampaknya terhadap prediksi", "Interaktif, self-service"],
            ["Geospatial Preference Engine", "Platform LangkahKampus", "Matching preferensi lokasi siswa dengan lokasi universitas", "Otomatis, personalized"],
            ["Manajemen Data Rapor", "Platform LangkahKampus", "Upload dan validasi otomatis data rapor siswa (individual/batch)", "Digital, semi-otomatis"],
            ["Analytics & Reporting", "Platform LangkahKampus", "Laporan penggunaan, statistik prediksi, dan insight untuk sekolah", "Otomatis, scheduled/on-demand"],
            ["Payment Processing", "Payment Gateway (Midtrans)", "Pemrosesan pembayaran untuk layanan premium dan subscription B2B", "Otomatis, multi-channel"],
            ["Notification & Alert", "Platform LangkahKampus", "Notifikasi deadline, hasil prediksi, alert bentrokan untuk Guru BK", "Push, email, in-app"],
            ["Customer Support", "Tim Support LangkahKampus", "Bantuan teknis dan panduan penggunaan platform", "Chat, email, knowledge base"],
        ],
        title="Business Service/Function Catalog (Target)",
        table_number=6
    )

    # Business Interaction Matrix (Target)
    add_heading(doc, "1.2.3 Business Interaction Matrix (Target)", level=3)

    add_table(doc,
        headers=["", "Siswa", "Guru BK", "Platform", "ML Engine", "Payment", "Sekolah Admin"],
        rows=[
            ["Siswa", "-", "Via platform", "UI interaction", "Prediksi & rekom", "Pembayaran", "Tidak langsung"],
            ["Guru BK", "Dashboard view", "-", "Dashboard", "Insight data", "Tidak ada", "Koordinasi"],
            ["Platform", "Serve content", "Serve dashboard", "-", "Request prediction", "Process payment", "Serve admin panel"],
            ["ML Engine", "Return prediction", "Return analytics", "API response", "-", "Tidak ada", "Batch analysis"],
            ["Payment", "Confirm payment", "Tidak ada", "Status update", "Tidak ada", "-", "Invoice B2B"],
            ["Sekolah Admin", "Manage students", "Support", "Admin panel", "Tidak langsung", "Subscription", "-"],
        ],
        title="Business Interaction Matrix (Target)",
        table_number=7
    )

    # Actor/Role Matrix (Target)
    add_heading(doc, "1.2.4 Actor/Role Matrix (Target)", level=3)

    add_table(doc,
        headers=["Actor", "Information Consumer", "Decision Support", "Service Provider", "Administrator"],
        rows=[
            ["Siswa", "Ya (prediksi, rekom)", "Ya (What-If)", "Tidak", "Tidak"],
            ["Guru BK", "Ya (dashboard)", "Ya (Anti-Bentrok)", "Tidak", "Terbatas (sekolah)"],
            ["ML Engine", "Ya (data training)", "Ya (prediction)", "Ya (core service)", "Tidak"],
            ["Platform", "Ya (aggregasi)", "Ya (rekomendasi)", "Ya (semua layanan)", "Ya"],
            ["Admin", "Ya (monitoring)", "Tidak", "Ya (support)", "Ya (penuh)"],
            ["Payment System", "Ya (transaksi)", "Tidak", "Ya (pembayaran)", "Ya (finansial)"],
        ],
        title="Actor/Role Matrix (Target)",
        table_number=8
    )

    # Goal/Objective/Service Diagram (Target)
    add_heading(doc, "1.2.5 Goal/Objective/Service Diagram (Target)", level=3)
    add_paragraph(doc,
        "Pada arsitektur target, setiap tujuan bisnis dipetakan langsung ke layanan "
        "digital yang spesifik:"
    )
    add_bullet_list(doc, [
        "Goal: Siswa diterima di prodi optimal - Service: ML Prediction Engine (akurasi >85%) + DiCE XAI Recommendation",
        "Goal: Menghindari Choice-2 Trap - Service: Anti-Choice-2-Trap Algorithm + What-If Simulator + Counterfactual Explanation",
        "Goal: Optimalisasi kuota sekolah - Service: Anti-Bentrok Dashboard (real-time de-confliction) + Alert System",
        "Goal: Informasi akurat & setara - Service: Geospatial Engine + Data-driven Analytics + Progressive Web App (accessible everywhere)",
        "Goal: Efisiensi Guru BK - Service: Automated Monitoring Dashboard + Batch Student Analysis + Priority Alert System",
        "Goal: Sustainable business - Service: Freemium Payment Gateway + B2B SaaS Subscription + Analytics for Schools",
    ])

    # Business Model Diagram (Target)
    add_heading(doc, "1.2.6 Business Model Diagram (Target)", level=3)
    add_paragraph(doc,
        "Model bisnis target LangkahKampus mengadopsi dual-revenue approach:"
    )
    add_paragraph(doc, "Revenue Stream 1 - B2C Freemium:", bold=True)
    add_bullet_list(doc, [
        "Free tier: Informasi umum prodi, 1x prediksi gratis per tahun",
        "Premium tier: Unlimited prediksi (Rp15.000-25.000/prediksi), What-If analysis, rekomendasi XAI detail",
        "Target: 100.000 siswa premium per tahun (dari 1.5 juta total SNBP registrants)",
    ])
    add_paragraph(doc, "Revenue Stream 2 - B2B SaaS:", bold=True)
    add_bullet_list(doc, [
        "School subscription: Dashboard Anti-Bentrok + Analytics (Rp 5-15 juta/sekolah/tahun)",
        "Enterprise tier: Custom integration, dedicated support, white-label option",
        "Target: 5.000 sekolah dalam 3 tahun (12.5% dari 40.000 SMA/MA/SMK)",
    ])

    # Functional Decomposition Diagram (Target)
    add_heading(doc, "1.2.7 Functional Decomposition Diagram (Target)", level=3)
    add_paragraph(doc, "Dekomposisi fungsi pada arsitektur bisnis target:")
    add_paragraph(doc, "1. Fungsi Akuisisi & Onboarding:", bold=True)
    add_bullet_list(doc, [
        "1.1 Registrasi pengguna (siswa/sekolah) - OAuth + email/phone",
        "1.2 Input data profil siswa dan nilai rapor (manual/batch upload)",
        "1.3 Verifikasi data otomatis dan quality check",
        "1.4 Onboarding flow dengan tutorial interaktif",
    ])
    add_paragraph(doc, "2. Fungsi Prediksi & Rekomendasi:", bold=True)
    add_bullet_list(doc, [
        "2.1 ML Model Inference - prediksi probabilitas per prodi",
        "2.2 DiCE Counterfactual Generation - what-if scenarios",
        "2.3 Geospatial Preference Matching - lokasi preference",
        "2.4 Ensemble Aggregation - combining multiple model outputs",
        "2.5 Explainability Layer - SHAP/DiCE explanation generation",
    ])
    add_paragraph(doc, "3. Fungsi Dashboard & Monitoring:", bold=True)
    add_bullet_list(doc, [
        "3.1 Anti-Bentrok real-time visualization",
        "3.2 Student portfolio tracking",
        "3.3 School-level analytics dan reporting",
        "3.4 Admin monitoring dan platform health",
    ])
    add_paragraph(doc, "4. Fungsi Transaksi & Pembayaran:", bold=True)
    add_bullet_list(doc, [
        "4.1 Payment processing (Midtrans/Xendit integration)",
        "4.2 Subscription management (B2B schools)",
        "4.3 Invoice generation dan financial reporting",
    ])
    add_paragraph(doc, "5. Fungsi Support & Communication:", bold=True)
    add_bullet_list(doc, [
        "5.1 In-app notification system",
        "5.2 Email dan push notification",
        "5.3 Customer support ticketing",
        "5.4 Knowledge base dan FAQ",
    ])

    # Process Flow Diagram (Target)
    add_heading(doc, "1.2.8 Process Flow Diagram (Target)", level=3)
    add_paragraph(doc,
        "Alur proses SNBP dengan platform LangkahKampus terintegrasi:"
    )
    add_numbered_list(doc, [
        "Siswa mendaftar di platform LangkahKampus (2 menit, mobile-friendly)",
        "Siswa menginput data rapor (manual atau foto rapor dengan OCR)",
        "Sistem memvalidasi dan memproses data secara otomatis",
        "ML Engine menghasilkan prediksi probabilitas untuk semua prodi relevan (<2 detik)",
        "DiCE Engine memberikan rekomendasi prodi optimal dengan penjelasan counterfactual",
        "Siswa melakukan What-If analysis untuk mengeksplorasi skenario alternatif",
        "Guru BK melihat dashboard Anti-Bentrok untuk mengidentifikasi potensi konflik",
        "Sistem mengirim alert otomatis jika terdeteksi bentrokan pilihan",
        "Guru BK dan siswa melakukan konseling berbasis data platform",
        "Siswa memfinalisasi pilihan dan mendaftar SNBP melalui portal LTMPT dengan confidence tinggi",
        "Platform memberikan notifikasi pengumuman hasil dan analisis post-result",
    ])

    # --------------------------------------------------------------------------
    # 1.3 GAP ANALYSIS
    # --------------------------------------------------------------------------
    add_heading(doc, "1.3 Gap Analysis", level=2)

    add_paragraph(doc,
        "Gap Analysis mengidentifikasi perbedaan antara kondisi baseline (as-is) "
        "dan target (to-be), serta menentukan langkah-langkah yang diperlukan "
        "untuk menutup gap tersebut."
    )

    # Gap Analysis Matrix
    add_heading(doc, "1.3.1 Gap Analysis Matrix", level=3)

    add_table(doc,
        headers=["Business Capability", "Baseline (As-Is)", "Target (To-Be)", "Gap", "Criticality"],
        rows=[
            ["Prediksi Penerimaan", "Tidak ada (hanya intuisi Guru BK)", "ML ensemble prediction >85% akurasi", "Perlu bangun dari nol: data pipeline, ML model, serving infrastructure", "Kritis"],
            ["Rekomendasi Prodi", "Saran verbal Guru BK berdasarkan pengalaman", "XAI-based recommendation dengan counterfactual explanation", "Perlu implementasi DiCE framework dan recommendation engine", "Kritis"],
            ["De-konflik Pilihan", "Spreadsheet manual (error-prone, lambat)", "Real-time dashboard Anti-Bentrok dengan alert otomatis", "Perlu real-time data sync, visualization, dan notification system", "Tinggi"],
            ["Data Management", "Manual, paper-based, tidak terstruktur", "Digital, validated, centralized PostgreSQL database", "Perlu data migration, validation rules, dan batch processing", "Tinggi"],
            ["Akses Informasi", "Tidak merata (bias kota besar)", "Merata via PWA yang accessible di semua device/koneksi", "Perlu responsive design, progressive enhancement, offline support", "Tinggi"],
            ["Payment Processing", "Tidak ada (layanan gratis dari sekolah)", "Freemium model dengan multiple payment channels", "Perlu payment gateway integration, subscription management", "Sedang"],
            ["Analytics & Reporting", "Tidak ada", "Comprehensive analytics untuk siswa dan sekolah", "Perlu data warehouse, reporting engine, visualization tools", "Sedang"],
            ["Communication", "Tatap muka, WhatsApp informal", "Multi-channel notification (in-app, email, push)", "Perlu notification infrastructure dan communication workflows", "Sedang"],
            ["User Authentication", "Tidak ada (no platform)", "OAuth + email/phone auth dengan role-based access", "Perlu auth system, user management, RBAC", "Tinggi"],
            ["School Integration", "Tidak ada B2B service", "Multi-tenant SaaS untuk sekolah", "Perlu multi-tenancy architecture, admin panel, API", "Sedang"],
        ],
        title="Gap Analysis Matrix - Business Architecture",
        table_number=9
    )

    # Gap and Solution Table
    add_heading(doc, "1.3.2 Gap and Solution Table", level=3)

    add_table(doc,
        headers=["ID Gap", "Deskripsi Gap", "Solusi yang Diusulkan", "Dependensi", "Prioritas"],
        rows=[
            ["GAP-B01", "Tidak ada kemampuan prediksi berbasis data", "Implementasi ML pipeline dengan XGBoost+LightGBM ensemble, training dengan historical SNBP data", "Data collection, ML infrastructure, compute resources", "P1"],
            ["GAP-B02", "Tidak ada rekomendasi yang explainable", "Integrasi DiCE counterfactual framework untuk generate recommendations yang transparan", "ML model (GAP-B01), DiCE library, explanation UI", "P1"],
            ["GAP-B03", "Koordinasi pilihan manual dan error-prone", "Real-time Anti-Bentrok dashboard dengan WebSocket-based updates dan conflict detection algorithm", "Student data (GAP-B04), real-time infrastructure", "P1"],
            ["GAP-B04", "Data tidak terstruktur dan tersebar", "Centralized database PostgreSQL dengan data validation, migration tools, dan batch import", "Database infrastructure, data model design", "P1"],
            ["GAP-B05", "Akses informasi tidak merata", "Progressive Web App dengan responsive design dan offline-first architecture", "Frontend development, CDN, performance optimization", "P2"],
            ["GAP-B06", "Tidak ada monetisasi", "Freemium payment integration (Midtrans/Xendit) dan B2B subscription model", "Payment gateway partnership, pricing strategy", "P2"],
            ["GAP-B07", "Tidak ada analytics capability", "Data warehouse implementation dengan reporting dashboard untuk schools", "Data pipeline (GAP-B04), BI tools", "P2"],
            ["GAP-B08", "Komunikasi tidak terstruktur", "Multi-channel notification system (FCM, email, in-app) dengan template management", "User management, notification infrastructure", "P3"],
            ["GAP-B09", "Tidak ada platform digital", "Full-stack platform development (Next.js + FastAPI + PostgreSQL)", "All infrastructure, team, budget", "P1"],
            ["GAP-B10", "Tidak ada layanan B2B", "Multi-tenant school dashboard dengan white-label capability", "Platform core (GAP-B09), school partnerships", "P2"],
        ],
        title="Gap and Solution Table",
        table_number=10
    )

    # Transition Timeline Diagram
    add_heading(doc, "1.3.3 Transition Timeline", level=3)

    add_paragraph(doc,
        "Transisi dari arsitektur bisnis baseline ke target dilakukan secara bertahap "
        "dalam tiga fase utama:"
    )

    add_table(doc,
        headers=["Fase", "Periode", "Fokus Utama", "Deliverables", "Success Criteria"],
        rows=[
            ["Fase 1: Foundation", "Bulan 1-4", "Core platform, ML model v1, basic prediction", "MVP platform, basic prediction, user auth, data pipeline", "1.000 beta users, prediction accuracy >75%"],
            ["Fase 2: Enhancement", "Bulan 5-8", "Anti-Bentrok, XAI, payment integration", "Anti-Bentrok dashboard, DiCE integration, freemium launch", "10.000 users, 50 pilot schools, first revenue"],
            ["Fase 3: Scale", "Bulan 9-12", "B2B SaaS, analytics, full scale-up", "School admin panel, analytics dashboard, marketing scale", "100.000 users, 500 schools, break-even trajectory"],
        ],
        title="Transition Timeline - Business Architecture",
        table_number=11
    )

    # ==========================================================================
    # SECTION 2: ARCHITECTURE REQUIREMENTS SPECIFICATION (UPDATED)
    # ==========================================================================
    add_heading(doc, "2. Spesifikasi Kebutuhan Arsitektur (Diperbarui)", level=1)

    add_paragraph(doc,
        "Berdasarkan analisis business architecture, berikut adalah requirements yang "
        "diperbarui untuk mengakomodasi kebutuhan arsitektur bisnis target."
    )

    add_heading(doc, "2.1 Kebutuhan Fungsional (Diperbarui)", level=2)

    add_table(doc,
        headers=["ID", "Kebutuhan", "Sumber (Gap)", "Prioritas"],
        rows=[
            ["FR-B01", "Platform harus menyediakan prediksi probabilitas penerimaan SNBP dengan akurasi minimal 85%", "GAP-B01", "P1"],
            ["FR-B02", "Sistem rekomendasi harus memberikan penjelasan counterfactual (DiCE) untuk setiap rekomendasi", "GAP-B02", "P1"],
            ["FR-B03", "Dashboard Anti-Bentrok harus menampilkan data pilihan siswa secara real-time (<5 detik delay)", "GAP-B03", "P1"],
            ["FR-B04", "Platform harus mendukung batch upload data siswa (CSV/Excel) minimal 500 records per upload", "GAP-B04", "P1"],
            ["FR-B05", "What-If simulator harus memberikan hasil dalam <3 detik untuk setiap skenario perubahan", "GAP-B01, GAP-B02", "P2"],
            ["FR-B06", "Sistem notifikasi harus mendukung minimal 3 channel (in-app, email, push)", "GAP-B08", "P2"],
            ["FR-B07", "School admin panel harus mendukung multi-tenant dengan data isolation per sekolah", "GAP-B10", "P2"],
            ["FR-B08", "Platform harus menyediakan reporting dengan export ke PDF dan Excel", "GAP-B07", "P2"],
        ],
        title="Updated Functional Requirements dari Business Architecture",
        table_number=12
    )

    add_heading(doc, "2.2 Kebutuhan Non-Fungsional (Diperbarui)", level=2)

    add_table(doc,
        headers=["ID", "Kebutuhan", "Metrik", "Prioritas"],
        rows=[
            ["NFR-B01", "Platform harus menangani 500.000 concurrent users saat peak SNBP (Jan-Feb)", "500K concurrent sessions", "P1"],
            ["NFR-B02", "Prediction response time < 2 detik (p95) termasuk explanation generation", "< 2s p95 latency", "P1"],
            ["NFR-B03", "Dashboard Anti-Bentrok harus update < 5 detik setelah perubahan data", "< 5s propagation", "P1"],
            ["NFR-B04", "System availability minimal 99.9% selama SNBP period", "99.9% SLA (peak)", "P1"],
            ["NFR-B05", "Data backup harus dilakukan setiap 1 jam dengan retention 30 hari", "RPO < 1 hour", "P2"],
            ["NFR-B06", "Platform harus accessible (WCAG 2.1 AA) untuk semua fitur utama", "WCAG 2.1 AA", "P2"],
        ],
        title="Updated Non-Functional Requirements dari Business Architecture",
        table_number=13
    )

    # ==========================================================================
    # SECTION 3: ARCHITECTURE PRINCIPLES (UPDATED)
    # ==========================================================================
    add_heading(doc, "3. Prinsip Arsitektur (Diperbarui)", level=1)

    add_paragraph(doc,
        "Berdasarkan analisis business architecture, prinsip arsitektur diperbarui "
        "dengan penambahan prinsip-prinsip berikut yang spesifik untuk domain bisnis:"
    )

    principles_updated = [
        {
            "name": "Seasonal Scalability",
            "statement": "Arsitektur harus mampu scale up 10x selama peak period SNBP dan scale down saat off-peak untuk optimasi biaya",
            "rationale": "Traffic LangkahKampus bersifat sangat seasonal dengan peak di Januari-Februari. Arsitektur harus cost-effective sepanjang tahun.",
            "implications": "Auto-scaling infrastructure, serverless computing untuk burst workload, capacity planning berbasis seasonal pattern"
        },
        {
            "name": "Multi-Stakeholder Value Delivery",
            "statement": "Setiap fitur platform harus memberikan value kepada minimal dua stakeholder group secara simultan",
            "rationale": "Platform yang sustainable harus menciptakan network effects antara siswa, Guru BK, dan sekolah.",
            "implications": "Feature design harus mempertimbangkan multiple user personas, data sharing policies antar stakeholder"
        },
        {
            "name": "Graceful Degradation",
            "statement": "Jika satu komponen gagal, platform tetap memberikan layanan dasar (basic prediction tanpa XAI detail)",
            "rationale": "Reliability saat SNBP peak sangat kritis - siswa tidak bisa menunggu karena deadline ketat.",
            "implications": "Circuit breaker patterns, fallback strategies, cached results, degraded mode design"
        },
    ]

    for p in principles_updated:
        add_paragraph(doc, f"Prinsip Baru: {p['name']}", bold=True)
        add_paragraph(doc, f"Pernyataan: {p['statement']}")
        add_paragraph(doc, f"Rasional: {p['rationale']}")
        add_paragraph(doc, f"Implikasi: {p['implications']}")
        doc.add_paragraph()

    # ==========================================================================
    # SECTION 4: BUSINESS PRINCIPLES, GOALS, DRIVERS (UPDATED)
    # ==========================================================================
    add_heading(doc, "4. Prinsip, Tujuan, dan Pendorong Bisnis (Diperbarui)", level=1)

    add_paragraph(doc,
        "Berdasarkan hasil analisis business architecture, business principles, goals, "
        "dan drivers diperbarui dengan penambahan:"
    )

    add_heading(doc, "4.1 Tujuan yang Diperbarui", level=2)
    add_numbered_list(doc, [
        "(Baru) Mencapai prediction accuracy >85% pada akhir Fase 1 melalui iterative ML model improvement",
        "(Baru) Mengurangi bentrokan pilihan intra-sekolah sebesar 80% pada sekolah yang menggunakan Anti-Bentrok",
        "(Baru) Mencapai customer satisfaction score (CSAT) > 4.0/5.0 dari Guru BK pengguna dashboard",
        "(Update) Mencapai 100.000 pengguna aktif pada tahun pertama melalui B2C freemium acquisition",
        "(Update) Bermitra dengan 500 sekolah pada tahun pertama melalui pilot program gratis",
    ])

    add_heading(doc, "4.2 Pendorong yang Diperbarui", level=2)
    add_bullet_list(doc, [
        "(Baru) Network Effect - Semakin banyak sekolah menggunakan Anti-Bentrok, semakin akurat data agregat untuk prediksi",
        "(Baru) Data Moat - Akumulasi data prediksi dan outcomes menciptakan competitive advantage yang sulit direplikasi",
        "(Baru) Trust Building - Transparansi melalui XAI membangun kepercayaan yang menjadi barrier to switching",
        "(Update) Seasonal Urgency - Siklus SNBP yang tetap setiap tahun menciptakan natural marketing momentum",
    ])

    # ==========================================================================
    # SECTION 5: STATEMENT OF ARCHITECTURE WORK (UPDATED)
    # ==========================================================================
    add_heading(doc, "5. Pernyataan Pekerjaan Arsitektur (Diperbarui)", level=1)

    add_paragraph(doc,
        "Statement of Architecture Work diperbarui untuk mencerminkan scope dan "
        "deliverables dari fase Business Architecture."
    )

    add_heading(doc, "5.1 Pembaruan Lingkup", level=2)
    add_paragraph(doc,
        "Fase Business Architecture telah berhasil mendefinisikan 10 business capabilities "
        "yang perlu dibangun, mengidentifikasi 10 gap utama antara kondisi baseline dan "
        "target, serta menyusun roadmap transisi 3 fase dalam 12 bulan. Deliverables "
        "fase ini menjadi input utama untuk fase selanjutnya (IS Architecture) yang "
        "akan menerjemahkan kebutuhan bisnis menjadi arsitektur data dan aplikasi."
    )

    add_heading(doc, "5.2 Keputusan Utama dari Business Architecture", level=2)
    add_table(doc,
        headers=["ID Keputusan", "Keputusan", "Rasional", "Dampak"],
        rows=[
            ["DEC-B01", "Dual revenue model (B2C freemium + B2B SaaS)", "Diversifikasi revenue dan network effects", "Payment architecture, multi-tenant design"],
            ["DEC-B02", "ML prediction sebagai core service (bukan add-on)", "Differentiator utama platform", "ML infrastructure investment, data pipeline priority"],
            ["DEC-B03", "Anti-Bentrok sebagai killer feature untuk B2B", "Unique value proposition untuk sekolah", "Real-time infrastructure, school partnership strategy"],
            ["DEC-B04", "XAI (DiCE) untuk transparency dan trust", "Membangun kepercayaan pengguna", "DiCE integration, explanation UI design"],
            ["DEC-B05", "3-phase rollout (Foundation, Enhancement, Scale)", "Manage risk dan validate assumptions", "Phased development, iterative validation"],
        ],
        title="Keputusan Arsitektur Utama - Fase Bisnis",
        table_number=14
    )

    add_heading(doc, "5.3 Langkah Selanjutnya", level=2)
    add_paragraph(doc,
        "Hasil dari fase Business Architecture akan menjadi input untuk:"
    )
    add_bullet_list(doc, [
        "Phase C-1 (Data Architecture): Menerjemahkan business entities dan data requirements menjadi data model dan data flow",
        "Phase C-2 (Application Architecture): Menerjemahkan business services menjadi application components dan interfaces",
        "Phase D (Technology Architecture): Menentukan technology stack yang mendukung business requirements",
    ])

    # References
    references = [
        "The Open Group. (2022). TOGAF Standard, 10th Edition. The Open Group.",
        "Harrison, R. (2018). TOGAF 9 Foundation Study Guide (4th ed.). Van Haren Publishing.",
        "Osterwalder, A., & Pigneur, Y. (2010). Business Model Generation. John Wiley & Sons.",
        "Lankhorst, M. (2017). Enterprise Architecture at Work (4th ed.). Springer.",
        "Porter, M. E. (1985). Competitive Advantage: Creating and Sustaining Superior Performance. Free Press.",
        "Kementerian Pendidikan dan Kebudayaan. (2023). Panduan Sistem SNBP 2024. Kemendikbudristek.",
        "Undang-Undang Republik Indonesia Nomor 27 Tahun 2022 tentang Perlindungan Data Pribadi.",
        "Newman, S. (2021). Building Microservices (2nd ed.). O'Reilly Media.",
        "Kim, W. C., & Mauborgne, R. (2015). Blue Ocean Strategy (Expanded Edition). Harvard Business Review Press.",
        "Christensen, C. M. (2016). The Innovator's Dilemma. Harvard Business Review Press.",
        "Blank, S. (2013). The Startup Owner's Manual. K&S Ranch.",
        "Richards, M., & Ford, N. (2020). Fundamentals of Software Architecture. O'Reilly Media.",
    ]

    add_references(doc, references)

    # Save document
    save_document(doc, "Stage4_Business_Architecture.docx")
    print("Stage 4: Dokumen berhasil di-generate!")
    print(f"Total paragraphs: {len(doc.paragraphs)}")
    print(f"Total tables: {len(doc.tables)}")


if __name__ == "__main__":
    generate_stage4()
