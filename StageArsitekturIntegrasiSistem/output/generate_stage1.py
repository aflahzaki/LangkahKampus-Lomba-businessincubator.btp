"""
Generate Stage 1: Proposal Tugas Besar
TOGAF Enterprise Architecture - LangkahKampus EduTech

This script generates the Stage 1 document covering:
- Daftar Nama dan NIM
- Deskripsi Organisasi
- Justifikasi Pemilihan
- Potensi Tantangan
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
    TEAM_MEMBERS,
)


def generate_stage1():
    """Generate Stage 1: Proposal Tugas Besar document."""
    doc = create_document()

    # Cover Page
    add_cover_page(
        doc,
        title="Proposal Tugas Besar",
        stage_name="Stage 1 - Proposal Tugas Besar"
    )

    # Table of Contents
    toc_sections = [
        ("Daftar Nama dan NIM Anggota Kelompok", []),
        ("Deskripsi Organisasi", [
            "Latar Belakang",
            "Sejarah Singkat",
            "Produk dan Layanan Utama",
            "Struktur Organisasi",
        ]),
        ("Justifikasi Pemilihan Organisasi", [
            "Alasan Pemilihan Organisasi",
            "Penggunaan Sistem Informasi dan Teknologi Informasi",
            "Kompleksitas Arsitektur",
        ]),
        ("Potensi Tantangan", [
            "Identifikasi Awal Tantangan",
            "Tantangan yang Dapat Diatasi dengan Enterprise Architecture",
        ]),
        ("Daftar Pustaka", []),
    ]
    add_table_of_contents(doc, toc_sections)

    # ==========================================================================
    # Section 1: Daftar Nama dan NIM
    # ==========================================================================
    add_heading(doc, "1. Daftar Nama dan NIM Anggota Kelompok", level=1)
    add_paragraph(doc,
        "Berikut adalah daftar anggota kelompok yang bertanggung jawab dalam penyusunan "
        "Tugas Besar Arsitektur Integrasi Sistem dengan studi kasus LangkahKampus:"
    )

    # Team table
    headers = ["No.", "Nama Lengkap", "NIM"]
    rows = [(str(i+1), name, nim) for i, (name, nim) in enumerate(TEAM_MEMBERS)]
    add_table(doc, headers, rows, title="Daftar Anggota Kelompok", table_number=1)

    add_paragraph(doc,
        "Seluruh anggota kelompok merupakan mahasiswa Program Studi S1 Sistem Informasi, "
        "Fakultas Rekayasa Industri, Telkom University. Pembagian tugas dilakukan secara "
        "kolaboratif dengan masing-masing anggota bertanggung jawab terhadap domain "
        "arsitektur yang berbeda sesuai kerangka kerja TOGAF ADM."
    )

    # ==========================================================================
    # Section 2: Deskripsi Organisasi
    # ==========================================================================
    add_heading(doc, "2. Deskripsi Organisasi", level=1)

    # 2.1 Latar Belakang
    add_heading(doc, "2.1 Latar Belakang", level=2)
    add_paragraph(doc,
        "LangkahKampus merupakan sebuah startup EduTech yang berfokus pada penyelesaian "
        "permasalahan struktural dan asimetri data dalam sistem penerimaan mahasiswa baru "
        "melalui jalur SNBP (Seleksi Nasional Berdasarkan Prestasi), yang sebelumnya "
        "dikenal sebagai jalur rapor. Sistem SNBP merupakan jalur seleksi masuk perguruan "
        "tinggi negeri di Indonesia yang mengandalkan nilai rapor dan prestasi akademik "
        "siswa SMA/sederajat sebagai dasar penilaian utama."
    )
    add_paragraph(doc,
        "Permasalahan utama yang dihadapi oleh calon mahasiswa dalam sistem SNBP adalah "
        "fenomena yang dikenal sebagai \"Choice-2 Trap\" atau Jebakan Pilihan Kedua. Dalam "
        "mekanisme SNBP, setiap siswa dapat memilih maksimal dua program studi dari dua "
        "perguruan tinggi yang berbeda. Namun, tanpa adanya data historis yang transparan "
        "dan alat analisis yang memadai, banyak siswa yang membuat keputusan berdasarkan "
        "informasi yang tidak lengkap atau bahkan keliru. Akibatnya, ribuan siswa gagal "
        "diterima di pilihan manapun karena ketidaksesuaian antara profil akademik mereka "
        "dengan tingkat kompetisi program studi yang dipilih."
    )
    add_paragraph(doc,
        "Selain itu, terdapat permasalahan asimetri informasi yang signifikan antara "
        "siswa di sekolah-sekolah unggulan di perkotaan dengan siswa di daerah terpencil. "
        "Siswa di sekolah unggulan cenderung memiliki akses lebih baik terhadap informasi "
        "daya tampung, passing grade, dan strategi pemilihan program studi. Sementara itu, "
        "siswa di daerah seringkali hanya mengandalkan saran dari guru BK (Bimbingan "
        "Konseling) yang juga memiliki keterbatasan data. Kondisi ini menciptakan "
        "ketidakadilan sistemik dalam akses pendidikan tinggi di Indonesia."
    )
    add_paragraph(doc,
        "LangkahKampus hadir sebagai solusi teknologi yang memanfaatkan kecerdasan buatan "
        "(Artificial Intelligence) dan machine learning untuk memberikan rekomendasi "
        "berbasis data kepada setiap siswa, terlepas dari lokasi geografis atau latar "
        "belakang sekolah mereka. Platform ini dirancang untuk mendemokratisasi akses "
        "terhadap informasi strategis dalam proses seleksi SNBP, sehingga setiap siswa "
        "memiliki kesempatan yang setara untuk membuat keputusan yang optimal."
    )

    # 2.2 Sejarah Singkat
    add_heading(doc, "2.2 Sejarah Singkat", level=2)
    add_paragraph(doc,
        "LangkahKampus didirikan pada tahun 2024 oleh sekelompok mahasiswa Telkom "
        "University yang memiliki kepedulian terhadap permasalahan akses pendidikan tinggi "
        "di Indonesia. Ide awal lahir dari pengamatan langsung terhadap kesulitan yang "
        "dialami oleh adik-adik kelas dan siswa SMA di sekitar lingkungan pendiri dalam "
        "menentukan pilihan program studi pada jalur SNBP."
    )
    add_paragraph(doc,
        "Pada fase awal pengembangan (Q1-Q2 2024), tim melakukan riset mendalam terhadap "
        "data historis SNBP dari berbagai sumber terbuka, termasuk data daya tampung, "
        "statistik penerimaan, dan pola distribusi siswa berdasarkan asal sekolah dan "
        "wilayah geografis. Hasil riset ini mengonfirmasi hipotesis bahwa terdapat pola "
        "sistematis yang dapat diprediksi menggunakan pendekatan machine learning."
    )
    add_paragraph(doc,
        "Fase kedua (Q3-Q4 2024) difokuskan pada pengembangan prototype platform yang "
        "mencakup model prediktif berbasis ensemble learning (kombinasi XGBoost dan "
        "LightGBM), antarmuka pengguna yang intuitif menggunakan Next.js, serta backend "
        "API menggunakan FastAPI. Platform ini juga mengintegrasikan fitur Explainable AI "
        "(XAI) menggunakan framework DiCE untuk memberikan rekomendasi counterfactual "
        "yang dapat dipahami oleh pengguna awam."
    )
    add_paragraph(doc,
        "Saat ini, LangkahKampus berada dalam fase validasi pasar dan pengembangan fitur "
        "lanjutan, termasuk dashboard Anti-Bentrok untuk Guru BK dan mesin preferensi "
        "geospasial-kognitif yang mempertimbangkan lokasi domisili dan profil psikologis "
        "siswa dalam memberikan rekomendasi."
    )

    # 2.3 Produk dan Layanan Utama
    add_heading(doc, "2.3 Produk dan Layanan Utama", level=2)
    add_paragraph(doc,
        "LangkahKampus menawarkan ekosistem layanan terintegrasi yang dirancang untuk "
        "mengatasi berbagai aspek permasalahan dalam proses seleksi SNBP. Berikut adalah "
        "produk dan layanan utama yang ditawarkan:"
    )

    add_paragraph(doc, "a) Prediksi Probabilitas Penerimaan (ML-Based Admission Scoring)", bold=True)
    add_paragraph(doc,
        "Layanan inti LangkahKampus adalah sistem prediksi probabilitas penerimaan yang "
        "menggunakan model ensemble machine learning. Sistem ini mengombinasikan algoritma "
        "XGBoost dan LightGBM yang dilatih menggunakan data historis SNBP dari ribuan "
        "sekolah di seluruh Indonesia. Model ini mempertimbangkan berbagai fitur termasuk "
        "nilai rapor per semester, akreditasi sekolah, lokasi geografis, rasio pendaftar "
        "terhadap daya tampung, dan tren historis penerimaan program studi target.",
        indent=0.5
    )

    add_paragraph(doc, "b) Choice-2 Trap Rescue System", bold=True)
    add_paragraph(doc,
        "Fitur unik yang secara khusus mengatasi fenomena Jebakan Pilihan Kedua. Sistem "
        "ini menganalisis kombinasi pilihan 1 dan pilihan 2 yang dipilih siswa, kemudian "
        "memberikan peringatan jika kombinasi tersebut memiliki risiko tinggi kegagalan di "
        "kedua pilihan. Sistem juga menyarankan alternatif kombinasi yang lebih optimal "
        "berdasarkan profil akademik siswa.",
        indent=0.5
    )

    add_paragraph(doc, "c) Geospatial dan Cognitive Preference Engine", bold=True)
    add_paragraph(doc,
        "Mesin rekomendasi yang mempertimbangkan tidak hanya kemampuan akademik, tetapi "
        "juga preferensi lokasi geografis (jarak dari rumah, biaya hidup di kota tujuan) "
        "dan profil kognitif siswa (minat, bakat, dan kecenderungan karir). Pendekatan "
        "holistik ini memastikan rekomendasi yang diberikan tidak hanya optimal secara "
        "statistik, tetapi juga sesuai dengan kebutuhan dan preferensi personal siswa.",
        indent=0.5
    )

    add_paragraph(doc, "d) Dashboard Anti-Bentrok untuk Guru BK (B2B)", bold=True)
    add_paragraph(doc,
        "Dashboard khusus yang dirancang untuk Guru Bimbingan Konseling (BK) di sekolah. "
        "Fitur ini memungkinkan Guru BK melihat secara real-time seluruh pilihan yang "
        "diajukan siswa di sekolahnya, mengidentifikasi potensi \"bentrokan\" (collision) "
        "di mana terlalu banyak siswa dari sekolah yang sama memilih program studi yang "
        "sama, serta memberikan rekomendasi redistribusi yang optimal. Fitur ini krusial "
        "karena kuota SNBP per sekolah bersifat terbatas.",
        indent=0.5
    )

    add_paragraph(doc, "e) DiCE Counterfactual XAI (What-If Recommendations)", bold=True)
    add_paragraph(doc,
        "Implementasi Explainable Artificial Intelligence (XAI) menggunakan framework "
        "DiCE (Diverse Counterfactual Explanations) yang memberikan rekomendasi dalam "
        "format \"What-If\". Misalnya, sistem dapat menjelaskan: \"Jika nilai rata-rata "
        "rapor Anda naik 0.3 poin, probabilitas diterima di Program Studi X akan "
        "meningkat dari 45% menjadi 72%\". Pendekatan ini meningkatkan transparansi dan "
        "kepercayaan pengguna terhadap hasil prediksi.",
        indent=0.5
    )

    # 2.4 Struktur Organisasi
    add_heading(doc, "2.4 Struktur Organisasi", level=2)
    add_paragraph(doc,
        "LangkahKampus sebagai startup EduTech tahap awal (early-stage startup) memiliki "
        "struktur organisasi yang lean dan agile. Struktur ini dirancang untuk "
        "memaksimalkan kecepatan pengembangan produk sambil tetap menjaga kualitas teknis "
        "dan orientasi bisnis. Berikut adalah struktur organisasi LangkahKampus:"
    )

    org_headers = ["Peran", "Nama", "Tanggung Jawab Utama"]
    org_rows = [
        ("CEO / Product Owner", "Aflah Rafilah Zaki",
         "Strategi bisnis, product roadmap, hubungan dengan stakeholder"),
        ("CTO / Lead ML Engineer", "Azka Fathir Syarif",
         "Arsitektur teknologi, pengembangan model ML, infrastruktur"),
        ("Full-Stack Developer", "Daffa Rizky Herdiawan",
         "Pengembangan frontend (Next.js) dan backend (FastAPI)"),
        ("Data Engineer / DevOps", "Muhammad Arifin Ilham",
         "Pipeline data, deployment, monitoring, dan operasional sistem"),
    ]
    add_table(doc, org_headers, org_rows,
              title="Struktur Organisasi LangkahKampus", table_number=2)

    add_paragraph(doc,
        "Struktur organisasi ini bersifat flat dengan komunikasi langsung antar anggota "
        "tim. Pengambilan keputusan dilakukan secara kolaboratif melalui sprint planning "
        "mingguan menggunakan metodologi Agile Scrum. Setiap anggota memiliki ownership "
        "terhadap domain masing-masing namun juga berkontribusi secara cross-functional "
        "sesuai kebutuhan proyek."
    )

    # ==========================================================================
    # Section 3: Justifikasi Pemilihan
    # ==========================================================================
    add_heading(doc, "3. Justifikasi Pemilihan Organisasi", level=1)

    # 3.1 Alasan Pemilihan
    add_heading(doc, "3.1 Alasan Pemilihan Organisasi", level=2)
    add_paragraph(doc,
        "Pemilihan LangkahKampus sebagai studi kasus dalam Tugas Besar Arsitektur "
        "Integrasi Sistem didasarkan pada beberapa pertimbangan strategis yang relevan "
        "dengan penerapan Enterprise Architecture framework TOGAF. Berikut adalah "
        "alasan-alasan utama pemilihan organisasi ini:"
    )

    add_paragraph(doc,
        "Pertama, LangkahKampus merepresentasikan sebuah organisasi yang memiliki "
        "kompleksitas arsitektur sistem informasi yang tinggi meskipun masih dalam tahap "
        "startup. Platform ini mengintegrasikan berbagai teknologi mutakhir mulai dari "
        "machine learning, geospatial computing, real-time data processing, hingga "
        "explainable AI. Kompleksitas ini memberikan konteks yang kaya untuk penerapan "
        "seluruh fase dalam TOGAF ADM (Architecture Development Method)."
    )
    add_paragraph(doc,
        "Kedua, LangkahKampus memiliki model bisnis ganda (B2C dan B2B) yang membutuhkan "
        "arsitektur enterprise yang mampu melayani dua segmen pasar dengan kebutuhan yang "
        "berbeda secara bersamaan. Segmen B2C melayani siswa individual dengan layanan "
        "prediksi dan rekomendasi, sementara segmen B2B melayani institusi sekolah dengan "
        "dashboard manajemen dan analitik. Dualitas ini menciptakan tantangan arsitektur "
        "yang menarik untuk dianalisis menggunakan framework TOGAF."
    )
    add_paragraph(doc,
        "Ketiga, domain pendidikan di Indonesia memiliki karakteristik unik yang "
        "memerlukan pemahaman mendalam terhadap konteks lokal. Regulasi pendidikan, pola "
        "musiman SNBP (yang menciptakan peak load signifikan), integrasi dengan sistem "
        "LTMPT/SNPMB, serta keragaman infrastruktur teknologi di berbagai daerah "
        "Indonesia menambah dimensi kompleksitas yang relevan untuk studi arsitektur "
        "enterprise."
    )

    # 3.2 Penggunaan IS/IT
    add_heading(doc, "3.2 Penggunaan Sistem Informasi dan Teknologi Informasi", level=2)
    add_paragraph(doc,
        "LangkahKampus memanfaatkan sistem informasi dan teknologi informasi secara "
        "intensif dalam seluruh aspek operasional bisnisnya. Berikut adalah pemetaan "
        "penggunaan IS/IT pada LangkahKampus:"
    )

    isit_headers = ["Komponen IS/IT", "Teknologi", "Fungsi Bisnis"]
    isit_rows = [
        ("Frontend Application", "Next.js (React)", "User interface untuk siswa dan Guru BK"),
        ("ML Microservice", "FastAPI + Python", "Prediksi probabilitas dan rekomendasi"),
        ("Database", "PostgreSQL", "Penyimpanan data historis, profil, dan transaksi"),
        ("ML Models", "XGBoost + LightGBM", "Model ensemble untuk scoring penerimaan"),
        ("XAI Engine", "DiCE Framework", "Counterfactual explanations untuk transparansi"),
        ("Geospatial Engine", "PostGIS + Custom", "Analisis lokasi dan preferensi spasial"),
        ("Real-time Processing", "WebSocket + Redis", "Dashboard real-time Anti-Bentrok"),
        ("Cloud Infrastructure", "Docker + Cloud", "Deployment, scaling, dan monitoring"),
    ]
    add_table(doc, isit_headers, isit_rows,
              title="Pemetaan Penggunaan IS/IT LangkahKampus", table_number=3)

    add_paragraph(doc,
        "Penggunaan IS/IT yang intensif dan beragam ini menjadikan LangkahKampus sebagai "
        "studi kasus yang ideal untuk penerapan Enterprise Architecture. Setiap komponen "
        "teknologi memiliki interdependensi yang memerlukan perencanaan arsitektur yang "
        "matang untuk memastikan integrasi yang seamless, scalability yang memadai, dan "
        "maintainability jangka panjang."
    )

    # 3.3 Kompleksitas Arsitektur
    add_heading(doc, "3.3 Kompleksitas Arsitektur", level=2)
    add_paragraph(doc,
        "Kompleksitas arsitektur LangkahKampus dapat dilihat dari beberapa dimensi utama "
        "yang menjadikannya studi kasus yang relevan untuk penerapan framework TOGAF:"
    )

    add_paragraph(doc, "Kompleksitas Pipeline Machine Learning:", bold=True)
    add_paragraph(doc,
        "Model prediktif LangkahKampus menggunakan pendekatan ensemble learning yang "
        "mengombinasikan XGBoost dan LightGBM. Pipeline ML ini mencakup tahapan data "
        "ingestion, feature engineering, model training, model serving, monitoring, dan "
        "retraining. Setiap tahapan memerlukan infrastruktur dan pengelolaan yang berbeda, "
        "menciptakan kompleksitas arsitektur data dan teknologi yang signifikan.",
        indent=0.5
    )

    add_paragraph(doc, "Kompleksitas Multi-Tenant dan Multi-Stakeholder:", bold=True)
    add_paragraph(doc,
        "Platform harus melayani berbagai jenis pengguna (siswa, orang tua, Guru BK, "
        "admin sekolah) dengan kebutuhan akses, fitur, dan tingkat keamanan data yang "
        "berbeda-beda. Arsitektur multi-tenant ini memerlukan desain yang cermat untuk "
        "memastikan isolasi data, customization per tenant, dan performance yang konsisten.",
        indent=0.5
    )

    add_paragraph(doc, "Kompleksitas Seasonal Scaling:", bold=True)
    add_paragraph(doc,
        "SNBP memiliki periode pendaftaran yang terkonsentrasi dalam waktu singkat "
        "(biasanya 2-3 minggu per tahun). Selama periode ini, traffic dapat melonjak "
        "10-50x dari baseline normal. Arsitektur sistem harus mampu melakukan auto-scaling "
        "untuk mengakomodasi lonjakan ini tanpa degradasi performa yang signifikan, "
        "sekaligus efisien dalam penggunaan resource di luar periode peak.",
        indent=0.5
    )

    # ==========================================================================
    # Section 4: Potensi Tantangan
    # ==========================================================================
    add_heading(doc, "4. Potensi Tantangan", level=1)

    # 4.1 Identifikasi Awal Tantangan
    add_heading(doc, "4.1 Identifikasi Awal Tantangan", level=2)
    add_paragraph(doc,
        "Berdasarkan analisis awal terhadap LangkahKampus, berikut adalah tantangan-"
        "tantangan utama yang teridentifikasi dan memerlukan penanganan melalui "
        "pendekatan Enterprise Architecture:"
    )

    challenges_headers = ["No.", "Tantangan", "Kategori", "Tingkat Kritis"]
    challenges_rows = [
        ("1", "Scalability pada musim SNBP (peak load 10-50x)", "Teknologi", "Tinggi"),
        ("2", "Integrasi data dari 40.000+ sekolah di Indonesia", "Data", "Tinggi"),
        ("3", "Akurasi model ML dengan data yang tidak seimbang", "Data/Teknologi", "Tinggi"),
        ("4", "Kepatuhan regulasi perlindungan data pribadi (UU PDP)", "Bisnis/Legal", "Tinggi"),
        ("5", "Latensi real-time dashboard Anti-Bentrok", "Teknologi", "Sedang"),
        ("6", "Ketersediaan dan kualitas data historis SNBP", "Data", "Tinggi"),
        ("7", "User adoption di daerah dengan literasi digital rendah", "Bisnis", "Sedang"),
        ("8", "Interoperabilitas dengan sistem SNPMB/LTMPT", "Teknologi/Bisnis", "Sedang"),
    ]
    add_table(doc, challenges_headers, challenges_rows,
              title="Identifikasi Awal Tantangan LangkahKampus", table_number=4)

    add_paragraph(doc,
        "Tantangan-tantangan di atas mencakup berbagai domain arsitektur enterprise, "
        "mulai dari arsitektur bisnis (model operasional dan kepatuhan regulasi), "
        "arsitektur data (integrasi dan kualitas data), arsitektur aplikasi (scalability "
        "dan real-time processing), hingga arsitektur teknologi (infrastruktur dan "
        "deployment). Keragaman tantangan ini mengonfirmasi relevansi penerapan framework "
        "TOGAF sebagai pendekatan holistik dalam menyelesaikan permasalahan arsitektur "
        "enterprise LangkahKampus."
    )

    # 4.2 Tantangan yang Dapat Diatasi dengan EA
    add_heading(doc, "4.2 Tantangan yang Dapat Diatasi dengan Enterprise Architecture", level=2)
    add_paragraph(doc,
        "Enterprise Architecture menggunakan framework TOGAF ADM dapat memberikan "
        "kontribusi signifikan dalam mengatasi tantangan-tantangan yang telah "
        "teridentifikasi. Berikut adalah pemetaan solusi EA terhadap setiap tantangan:"
    )

    add_paragraph(doc, "Scalability dan Peak Load Management:", bold=True)
    add_paragraph(doc,
        "Melalui fase Technology Architecture dalam TOGAF ADM, dapat dirancang arsitektur "
        "infrastruktur yang mendukung auto-scaling, load balancing, dan caching strategy "
        "yang optimal. Architecture Building Blocks (ABBs) yang spesifik untuk penanganan "
        "peak load akan didefinisikan, termasuk penggunaan containerization (Docker/Kubernetes), "
        "CDN untuk static assets, dan database sharding untuk distribusi beban.",
        indent=0.5
    )

    add_paragraph(doc, "Integrasi Data Multi-Sumber:", bold=True)
    add_paragraph(doc,
        "Fase Information Systems Architecture akan menghasilkan data architecture yang "
        "komprehensif, mencakup data flow diagram, data integration patterns (ETL/ELT), "
        "master data management, dan data governance framework. Arsitektur ini akan "
        "memastikan bahwa data dari berbagai sumber (sekolah, LTMPT, BPS) dapat "
        "diintegrasikan secara konsisten dan reliable.",
        indent=0.5
    )

    add_paragraph(doc, "Kepatuhan Regulasi (UU PDP):", bold=True)
    add_paragraph(doc,
        "Architecture Vision dan Business Architecture akan mendefinisikan privacy-by-design "
        "principles yang menjadi pedoman seluruh pengembangan sistem. Ini mencakup "
        "data classification, consent management, right to erasure, data minimization, "
        "dan audit trail yang terintegrasi dalam setiap lapisan arsitektur.",
        indent=0.5
    )

    add_paragraph(doc, "Model ML dan Explainability:", bold=True)
    add_paragraph(doc,
        "Application Architecture akan mendefinisikan MLOps pipeline yang mencakup model "
        "versioning, A/B testing, monitoring drift, dan automated retraining. Integrasi "
        "DiCE XAI framework akan dirancang sebagai komponen arsitektur yang terpisah namun "
        "terintegrasi, memastikan setiap prediksi dapat dijelaskan kepada pengguna.",
        indent=0.5
    )

    add_paragraph(doc, "User Adoption dan Aksesibilitas:", bold=True)
    add_paragraph(doc,
        "Business Architecture akan mendefinisikan strategi omni-channel yang memungkinkan "
        "akses platform melalui berbagai perangkat dan kondisi konektivitas. Termasuk "
        "progressive web app (PWA) untuk akses offline-first, antarmuka yang sederhana "
        "untuk pengguna dengan literasi digital rendah, serta integrasi dengan platform "
        "yang sudah familiar (WhatsApp, SMS) sebagai channel komunikasi alternatif.",
        indent=0.5
    )

    # ==========================================================================
    # Daftar Pustaka
    # ==========================================================================
    references = [
        "The Open Group. (2022). TOGAF Standard, 10th Edition. The Open Group.",
        "Harrison, R. (2018). TOGAF 9 Foundation Study Guide (4th ed.). Van Haren Publishing.",
        "Lankhorst, M. (2017). Enterprise Architecture at Work: Modelling, Communication and Analysis (4th ed.). Springer.",
        "Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi. (2024). Panduan Seleksi Nasional Berdasarkan Prestasi (SNBP) Tahun 2024. Kemendikbudristek.",
        "Chen, T., & Guestrin, C. (2016). XGBoost: A Scalable Tree Boosting System. Proceedings of the 22nd ACM SIGKDD International Conference on Knowledge Discovery and Data Mining, 785-794.",
        "Ke, G., Meng, Q., Finley, T., Wang, T., Chen, W., Ma, W., Ye, Q., & Liu, T. Y. (2017). LightGBM: A Highly Efficient Gradient Boosting Decision Tree. Advances in Neural Information Processing Systems, 30.",
        "Mothilal, R. K., Sharma, A., & Tan, C. (2020). Explaining Machine Learning Classifiers through Diverse Counterfactual Explanations. Proceedings of the 2020 Conference on Fairness, Accountability, and Transparency, 607-617.",
        "Republik Indonesia. (2022). Undang-Undang Nomor 27 Tahun 2022 tentang Pelindungan Data Pribadi. Lembaran Negara Republik Indonesia.",
        "Josey, A. (2018). TOGAF 9.2 - A Pocket Guide. Van Haren Publishing.",
        "Ross, J. W., Weill, P., & Robertson, D. C. (2006). Enterprise Architecture as Strategy: Creating a Foundation for Business Execution. Harvard Business School Press.",
    ]
    add_references(doc, references)

    # Save document
    save_document(doc, "Stage1_Proposal_Tugas_Besar.docx")
    print("Stage 1: Proposal Tugas Besar - Berhasil di-generate!")


if __name__ == "__main__":
    generate_stage1()
