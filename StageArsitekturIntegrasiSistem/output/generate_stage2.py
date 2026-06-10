"""
Generate Stage 2: Methodology and Project Planning
TOGAF Enterprise Architecture - LangkahKampus EduTech

This script generates the Stage 2 document covering:
- Deskripsi ADM TOGAF dan aplikasinya pada proyek
- Metodologi yang disusun khusus untuk proyek
- Rencana proyek detail
- Analisis risiko dan strategi mitigasi
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


def generate_stage2():
    """Generate Stage 2: Methodology and Project Planning document."""
    doc = create_document()

    # Cover Page
    add_cover_page(
        doc,
        title="Methodology and Project Planning",
        stage_name="Stage 2 - Methodology and Project Planning"
    )

    # Table of Contents
    toc_sections = [
        ("Deskripsi ADM TOGAF", [
            "Pengantar TOGAF ADM",
            "Fase-fase ADM TOGAF",
            "Aplikasi ADM pada Proyek LangkahKampus",
        ]),
        ("Metodologi Proyek", [
            "Pendekatan Metodologi",
            "Adaptasi untuk Konteks Startup EduTech",
            "Framework Integrasi: TOGAF + Agile",
        ]),
        ("Rencana Proyek Detail", [
            "Ruang Lingkup Proyek",
            "Sumber Daya",
            "Jadwal dan Timeline Proyek",
            "Milestones",
        ]),
        ("Analisis Risiko dan Strategi Mitigasi", [
            "Identifikasi Risiko",
            "Matriks Risiko",
            "Strategi Mitigasi Detail",
        ]),
        ("Daftar Pustaka", []),
    ]
    add_table_of_contents(doc, toc_sections)

    # ==========================================================================
    # Section 1: Deskripsi ADM TOGAF
    # ==========================================================================
    add_heading(doc, "1. Deskripsi ADM TOGAF", level=1)

    # 1.1 Pengantar TOGAF ADM
    add_heading(doc, "1.1 Pengantar TOGAF ADM", level=2)
    add_paragraph(doc,
        "TOGAF (The Open Group Architecture Framework) merupakan framework arsitektur "
        "enterprise yang paling banyak digunakan secara global untuk merancang, "
        "merencanakan, mengimplementasikan, dan mengelola arsitektur informasi enterprise. "
        "TOGAF dikembangkan dan dipelihara oleh The Open Group, sebuah konsorsium industri "
        "yang beranggotakan ratusan organisasi dari berbagai sektor. Versi terkini, TOGAF "
        "Standard 10th Edition (2022), menyediakan pendekatan komprehensif yang dapat "
        "diadaptasi untuk berbagai jenis dan skala organisasi."
    )
    add_paragraph(doc,
        "Komponen inti dari TOGAF adalah Architecture Development Method (ADM), sebuah "
        "metode iteratif dan siklikal yang menyediakan panduan langkah demi langkah untuk "
        "mengembangkan arsitektur enterprise. ADM terdiri dari serangkaian fase yang "
        "saling terkait, dimulai dari penetapan visi arsitektur hingga pengelolaan "
        "perubahan arsitektur secara berkelanjutan. Setiap fase menghasilkan artifak "
        "(deliverables) yang menjadi input bagi fase berikutnya, menciptakan alur kerja "
        "yang terstruktur dan traceable."
    )
    add_paragraph(doc,
        "ADM bersifat generik dan modular, yang berarti organisasi dapat mengadaptasi "
        "dan menyesuaikan penerapannya sesuai dengan konteks, kebutuhan, dan tingkat "
        "kematangan organisasi. Untuk LangkahKampus sebagai startup EduTech, ADM akan "
        "diadaptasi dengan pendekatan yang lebih agile dan iteratif, tetap mempertahankan "
        "rigor arsitektural namun dengan siklus yang lebih pendek dan fleksibel."
    )

    # 1.2 Fase-fase ADM TOGAF
    add_heading(doc, "1.2 Fase-fase ADM TOGAF", level=2)
    add_paragraph(doc,
        "ADM TOGAF terdiri dari fase Preliminary dan delapan fase utama (A hingga H) "
        "yang membentuk siklus pengembangan arsitektur. Berikut adalah deskripsi setiap "
        "fase beserta relevansinya terhadap proyek LangkahKampus:"
    )

    add_paragraph(doc, "Preliminary Phase: Framework and Principles", bold=True)
    add_paragraph(doc,
        "Fase ini menetapkan konteks organisasi, mendefinisikan prinsip-prinsip "
        "arsitektur, dan menyiapkan tools serta metodologi yang akan digunakan. Pada "
        "konteks LangkahKampus, fase ini mencakup penetapan prinsip-prinsip seperti "
        "privacy-by-design, scalability-first, dan data-driven decision making sebagai "
        "landasan seluruh pengembangan arsitektur.",
        indent=0.5
    )

    add_paragraph(doc, "Phase A: Architecture Vision", bold=True)
    add_paragraph(doc,
        "Fase ini mendefinisikan visi tingkat tinggi dari arsitektur target, "
        "mengidentifikasi stakeholder, dan memperoleh persetujuan (approval) untuk "
        "melanjutkan proses pengembangan. Untuk LangkahKampus, Architecture Vision "
        "menggambarkan bagaimana platform EduTech akan beroperasi secara holistik, "
        "melayani siswa dan sekolah dengan sistem prediksi berbasis AI yang terintegrasi.",
        indent=0.5
    )

    add_paragraph(doc, "Phase B: Business Architecture", bold=True)
    add_paragraph(doc,
        "Fase ini mengembangkan arsitektur bisnis yang menggambarkan proses bisnis, "
        "fungsi organisasi, dan bagaimana bisnis beroperasi untuk memenuhi tujuan "
        "strategis. Pada LangkahKampus, ini mencakup pemetaan proses bisnis untuk "
        "layanan B2C (prediksi individual) dan B2B (dashboard sekolah), serta "
        "value chain dari data collection hingga delivery of insights.",
        indent=0.5
    )

    add_paragraph(doc, "Phase C: Information Systems Architecture", bold=True)
    add_paragraph(doc,
        "Fase ini terbagi menjadi dua sub-fase: Data Architecture dan Application "
        "Architecture. Data Architecture mendefinisikan struktur data, aliran data, "
        "dan pengelolaan data. Application Architecture mendefinisikan komponen aplikasi "
        "dan interaksi antar komponen. Untuk LangkahKampus, fase ini sangat krusial "
        "mengingat kompleksitas pipeline ML, data dari 40.000+ sekolah, dan arsitektur "
        "microservices yang digunakan.",
        indent=0.5
    )

    add_paragraph(doc, "Phase D: Technology Architecture", bold=True)
    add_paragraph(doc,
        "Fase ini mendefinisikan infrastruktur teknologi yang mendukung deployment "
        "komponen-komponen yang telah didefinisikan di fase sebelumnya. Pada LangkahKampus, "
        "ini mencakup arsitektur cloud, containerization strategy, database infrastructure, "
        "ML serving infrastructure, dan monitoring stack.",
        indent=0.5
    )

    add_paragraph(doc, "Phase E: Opportunities and Solutions", bold=True)
    add_paragraph(doc,
        "Fase ini mengidentifikasi peluang implementasi dan menentukan solusi-solusi "
        "yang akan diimplementasikan. Termasuk evaluasi build vs buy decisions, "
        "prioritization of work packages, dan transition architecture planning.",
        indent=0.5
    )

    add_paragraph(doc, "Phase F: Migration Planning", bold=True)
    add_paragraph(doc,
        "Fase ini mengembangkan rencana migrasi detail dari arsitektur saat ini (baseline) "
        "menuju arsitektur target. Untuk LangkahKampus sebagai startup, fokusnya lebih "
        "pada phased implementation plan daripada migrasi dari sistem legacy.",
        indent=0.5
    )

    add_paragraph(doc, "Phase G: Implementation Governance", bold=True)
    add_paragraph(doc,
        "Fase ini menyediakan pengawasan arsitektural selama implementasi untuk "
        "memastikan bahwa implementasi sesuai dengan arsitektur yang telah dirancang. "
        "Pada LangkahKampus, ini diintegrasikan dengan CI/CD pipeline dan code review "
        "process untuk memastikan conformance.",
        indent=0.5
    )

    add_paragraph(doc, "Phase H: Architecture Change Management", bold=True)
    add_paragraph(doc,
        "Fase ini mengelola perubahan arsitektur secara berkelanjutan, memastikan bahwa "
        "arsitektur tetap relevan seiring dengan perubahan bisnis dan teknologi. Untuk "
        "LangkahKampus, ini mencakup mekanisme untuk mengakomodasi perubahan regulasi "
        "SNBP, evolusi model ML, dan perubahan kebutuhan pasar.",
        indent=0.5
    )

    add_paragraph(doc, "Requirements Management (Pusat Siklus ADM)", bold=True)
    add_paragraph(doc,
        "Requirements Management bukan merupakan fase tersendiri melainkan proses "
        "berkelanjutan yang berjalan di tengah seluruh fase ADM. Proses ini memastikan "
        "bahwa requirements dari stakeholder ditangkap, dikelola, dan dipenuhi secara "
        "konsisten di setiap fase pengembangan arsitektur.",
        indent=0.5
    )

    # 1.3 Aplikasi ADM pada Proyek LangkahKampus
    add_heading(doc, "1.3 Aplikasi ADM pada Proyek LangkahKampus", level=2)
    add_paragraph(doc,
        "Penerapan ADM TOGAF pada proyek LangkahKampus dilakukan dengan mempertimbangkan "
        "karakteristik unik dari organisasi sebagai startup EduTech. Berikut adalah "
        "pemetaan penerapan setiap fase ADM dalam konteks Tugas Besar ini:"
    )

    adm_headers = ["Fase ADM", "Deliverable Utama", "Stage Tugas Besar"]
    adm_rows = [
        ("Preliminary", "Architecture Principles, Stakeholder Map", "Stage 3"),
        ("Phase A: Architecture Vision", "Architecture Vision Document, Value Chain", "Stage 3"),
        ("Requirements Management", "Requirements Catalog, Prioritized Requirements", "Stage 3"),
        ("Phase B: Business Architecture", "Business Process Model, Organization Map", "Stage 4"),
        ("Phase C: IS Architecture (Data)", "Data Entity Model, Data Flow Diagram", "Stage 5"),
        ("Phase C: IS Architecture (App)", "Application Portfolio, Integration Map", "Stage 5"),
        ("Phase D: Technology Architecture", "Technology Standards, Infrastructure Diagram", "Stage 6"),
    ]
    add_table(doc, adm_headers, adm_rows,
              title="Pemetaan Fase ADM ke Stage Tugas Besar", table_number=1)

    add_paragraph(doc,
        "Penerapan ADM pada LangkahKampus menggunakan pendekatan iteratif dimana setiap "
        "stage menghasilkan deliverables yang menjadi input untuk stage berikutnya. Hal "
        "ini memastikan konsistensi dan traceability dari visi arsitektur tingkat tinggi "
        "hingga detail implementasi teknologi."
    )

    # ==========================================================================
    # Section 2: Metodologi Proyek
    # ==========================================================================
    add_heading(doc, "2. Metodologi Proyek", level=1)

    # 2.1 Pendekatan Metodologi
    add_heading(doc, "2.1 Pendekatan Metodologi", level=2)
    add_paragraph(doc,
        "Metodologi yang digunakan dalam proyek ini merupakan adaptasi dari TOGAF ADM "
        "yang disesuaikan dengan konteks startup EduTech dan keterbatasan waktu akademik. "
        "Pendekatan ini mengombinasikan kerangka kerja TOGAF untuk rigor arsitektural "
        "dengan prinsip-prinsip Agile untuk fleksibilitas dan kecepatan iterasi."
    )
    add_paragraph(doc,
        "Pendekatan metodologi yang dipilih adalah Lean Enterprise Architecture yang "
        "mengadopsi prinsip minimum viable architecture. Berbeda dengan penerapan TOGAF "
        "tradisional yang cenderung heavyweight dan membutuhkan waktu berbulan-bulan, "
        "pendekatan lean ini fokus pada deliverables yang memberikan nilai nyata dan "
        "actionable insights bagi organisasi studi kasus."
    )
    add_paragraph(doc,
        "Metodologi ini terdiri dari empat tahapan utama yang masing-masing "
        "menghasilkan artefak arsitektur yang spesifik dan terukur:"
    )
    add_numbered_list(doc, [
        "Discovery Phase: Pemahaman konteks bisnis, identifikasi stakeholder, dan pengumpulan requirements",
        "Design Phase: Perancangan arsitektur pada keempat domain (bisnis, data, aplikasi, teknologi)",
        "Validation Phase: Validasi arsitektur terhadap requirements dan constraint yang telah didefinisikan",
        "Documentation Phase: Dokumentasi formal seluruh artefak arsitektur dalam format akademik",
    ])

    # 2.2 Adaptasi untuk Konteks Startup EduTech
    add_heading(doc, "2.2 Adaptasi untuk Konteks Startup EduTech", level=2)
    add_paragraph(doc,
        "Penerapan TOGAF ADM pada LangkahKampus memerlukan beberapa adaptasi mengingat "
        "karakteristik unik startup dibandingkan dengan enterprise besar yang menjadi "
        "target utama framework TOGAF. Berikut adalah adaptasi-adaptasi yang dilakukan:"
    )

    add_paragraph(doc, "Adaptasi 1: Simplified Governance", bold=True)
    add_paragraph(doc,
        "Startup tidak memiliki architecture board formal atau governance structure yang "
        "kompleks. Oleh karena itu, governance dalam proyek ini disederhanakan menjadi "
        "peer review antar anggota tim dan validasi oleh dosen pengampu sebagai "
        "architecture governance board.",
        indent=0.5
    )

    add_paragraph(doc, "Adaptasi 2: Greenfield vs Brownfield", bold=True)
    add_paragraph(doc,
        "Berbeda dengan enterprise besar yang umumnya memiliki legacy systems (brownfield), "
        "LangkahKampus sebagai startup memulai dari greenfield. Ini berarti fase Migration "
        "Planning (Phase F) lebih berfokus pada phased implementation strategy daripada "
        "migrasi dari sistem lama. Namun, integrasi dengan sistem eksternal (SNPMB/LTMPT) "
        "tetap menjadi pertimbangan brownfield yang relevan.",
        indent=0.5
    )

    add_paragraph(doc, "Adaptasi 3: Iterative dan Time-boxed", bold=True)
    add_paragraph(doc,
        "Setiap stage dalam tugas besar ini di-time-box sesuai jadwal perkuliahan. "
        "Meskipun ADM bersifat iteratif, dalam konteks akademik ini setiap iterasi "
        "diselesaikan dalam satu stage submission. Feedback dari dosen pada setiap stage "
        "menjadi input untuk refinement di stage berikutnya.",
        indent=0.5
    )

    add_paragraph(doc, "Adaptasi 4: Focus on Core Domain", bold=True)
    add_paragraph(doc,
        "Mengingat skala startup dan keterbatasan waktu, scope arsitektur difokuskan "
        "pada core domain LangkahKampus yaitu ML prediction service, student-facing "
        "application, dan school dashboard. Supporting domains seperti HR, finance, "
        "dan procurement tidak termasuk dalam scope arsitektur ini.",
        indent=0.5
    )

    # 2.3 Framework Integrasi
    add_heading(doc, "2.3 Framework Integrasi: TOGAF + Agile", level=2)
    add_paragraph(doc,
        "Integrasi antara TOGAF dan pendekatan Agile dilakukan melalui konsep "
        "\"Architecture Runway\" dimana arsitektur dikembangkan secukupnya (just enough) "
        "untuk mendukung pengembangan fitur dalam sprint-sprint mendatang, tanpa terlalu "
        "jauh ke depan (over-architecting) yang berisiko menjadi obsolete."
    )

    add_paragraph(doc,
        "Model integrasi yang digunakan adalah sebagai berikut:"
    )
    add_bullet_list(doc, [
        "Intentional Architecture (TOGAF): Mendefinisikan guardrails dan standards yang harus diikuti",
        "Emergent Architecture (Agile): Memungkinkan detail arsitektur berkembang organis melalui implementasi",
        "Architecture Decision Records (ADR): Mendokumentasikan keputusan arsitektur kunci beserta rasionalnya",
        "Fitness Functions: Metrik terukur yang memvalidasi apakah implementasi conform dengan arsitektur",
    ])

    add_paragraph(doc,
        "Dengan pendekatan hybrid ini, proyek mendapatkan manfaat dari kedua sisi: "
        "structure dan rigor dari TOGAF untuk memastikan arsitektur yang koheren dan "
        "well-documented, serta flexibility dan responsiveness dari Agile untuk "
        "mengakomodasi perubahan dan learning yang terjadi selama proses pengembangan."
    )

    # ==========================================================================
    # Section 3: Rencana Proyek Detail
    # ==========================================================================
    add_heading(doc, "3. Rencana Proyek Detail", level=1)

    # 3.1 Ruang Lingkup
    add_heading(doc, "3.1 Ruang Lingkup Proyek", level=2)
    add_paragraph(doc,
        "Ruang lingkup proyek arsitektur enterprise LangkahKampus mencakup keempat "
        "domain arsitektur yang didefinisikan dalam TOGAF, dengan fokus khusus pada "
        "core business platform. Berikut adalah definisi ruang lingkup untuk setiap domain:"
    )

    add_paragraph(doc, "Business Architecture (In Scope):", bold=True)
    add_bullet_list(doc, [
        "Proses bisnis inti: prediksi penerimaan, rekomendasi pilihan, anti-bentrok",
        "Model operasional B2C (siswa individual) dan B2B (sekolah/Guru BK)",
        "Value chain dari data acquisition hingga insight delivery",
        "Organizational capabilities dan role mapping",
        "Business service catalog dan service level agreements",
    ])

    add_paragraph(doc, "Data Architecture (In Scope):", bold=True)
    add_bullet_list(doc, [
        "Logical data model untuk entitas utama (siswa, sekolah, prodi, prediksi)",
        "Data flow diagram untuk pipeline ML dan real-time processing",
        "Data governance framework dan data quality standards",
        "Master data management untuk data referensi (PTN, prodi, kuota)",
        "Data lifecycle management dan retention policies",
    ])

    add_paragraph(doc, "Application Architecture (In Scope):", bold=True)
    add_bullet_list(doc, [
        "Microservices architecture untuk backend (FastAPI)",
        "Frontend application architecture (Next.js SPA/SSR)",
        "ML model serving architecture dan MLOps pipeline",
        "Integration patterns antar services (sync/async)",
        "API design dan versioning strategy",
    ])

    add_paragraph(doc, "Technology Architecture (In Scope):", bold=True)
    add_bullet_list(doc, [
        "Cloud infrastructure architecture (compute, storage, network)",
        "Container orchestration dan deployment strategy",
        "Database infrastructure (PostgreSQL, Redis, caching)",
        "Security architecture (authentication, authorization, encryption)",
        "Monitoring, logging, dan observability stack",
    ])

    add_paragraph(doc, "Out of Scope:", bold=True)
    add_bullet_list(doc, [
        "Supporting business functions (HR, finance, legal, procurement)",
        "Physical office/facility architecture",
        "Detailed UX/UI design (hanya high-level application landscape)",
        "Detailed source code atau implementasi teknis per fitur",
        "Third-party vendor evaluation dan procurement process",
    ])

    # 3.2 Sumber Daya
    add_heading(doc, "3.2 Sumber Daya", level=2)
    add_paragraph(doc,
        "Proyek ini dilaksanakan oleh tim beranggotakan empat orang mahasiswa dengan "
        "pembagian tanggung jawab berdasarkan domain arsitektur dan keahlian masing-masing. "
        "Berikut adalah alokasi sumber daya untuk proyek:"
    )

    resource_headers = ["Anggota", "Domain Arsitektur", "Deliverables Utama"]
    resource_rows = [
        ("Aflah Rafilah Zaki", "Business Architecture\n+ Project Lead",
         "Business Process Model, Value Chain,\nStakeholder Management, Project Coordination"),
        ("Azka Fathir Syarif", "Technology Architecture\n+ ML Architecture",
         "Infrastructure Diagram, Technology Standards,\nML Pipeline Architecture, Security Architecture"),
        ("Daffa Rizky Herdiawan", "Application Architecture",
         "Application Landscape, Integration Map,\nAPI Design, Frontend/Backend Architecture"),
        ("Muhammad Arifin Ilham", "Data Architecture\n+ Requirements",
         "Data Model, Data Flow Diagram,\nRequirements Catalog, Data Governance"),
    ]
    add_table(doc, resource_headers, resource_rows,
              title="Alokasi Sumber Daya Proyek", table_number=2)

    add_paragraph(doc,
        "Selain sumber daya manusia, proyek ini didukung oleh tools dan teknologi berikut:"
    )
    add_bullet_list(doc, [
        "ArchiMate / Draw.io: Pemodelan arsitektur dan diagram",
        "Microsoft Office / Google Docs: Dokumentasi dan presentasi",
        "Git/GitHub: Version control untuk artefak arsitektur",
        "TOGAF Standard 10th Edition: Referensi framework utama",
        "Python + python-docx: Automated document generation",
    ])

    # 3.3 Jadwal dan Timeline
    add_heading(doc, "3.3 Jadwal dan Timeline Proyek", level=2)
    add_paragraph(doc,
        "Jadwal proyek disusun mengikuti timeline perkuliahan Arsitektur Integrasi Sistem "
        "semester genap 2023/2024. Setiap stage memiliki durasi 2 minggu dengan submission "
        "deadline yang telah ditentukan. Berikut adalah timeline detail proyek:"
    )

    timeline_headers = ["Stage", "Periode", "Aktivitas Utama", "Deliverable"]
    timeline_rows = [
        ("Stage 1", "Minggu 1-2", "Proposal, identifikasi organisasi,\nanalisis awal",
         "Proposal Tugas Besar"),
        ("Stage 2", "Minggu 3-4", "Penyusunan metodologi,\nperencanaan proyek",
         "Methodology & Project Plan"),
        ("Stage 3", "Minggu 5-6", "Preliminary, Requirements,\nArchitecture Vision",
         "Preliminary & Vision Document"),
        ("Stage 4", "Minggu 7-8", "Analisis proses bisnis,\norganizational mapping",
         "Business Architecture Document"),
        ("Stage 5", "Minggu 9-10", "Data & Application\nArchitecture design",
         "IS Architecture Document"),
        ("Stage 6", "Minggu 11-12", "Infrastructure & technology\nplatform design",
         "Technology Architecture Document"),
    ]
    add_table(doc, timeline_headers, timeline_rows,
              title="Timeline Proyek Tugas Besar", table_number=3)

    add_paragraph(doc,
        "Setiap stage memiliki internal milestones yang memastikan progress yang terukur "
        "dan memungkinkan early detection terhadap potential delays. Tim menggunakan "
        "weekly sync meeting setiap hari Senin untuk review progress dan resolusi blockers."
    )

    # 3.4 Milestones
    add_heading(doc, "3.4 Milestones", level=2)
    add_paragraph(doc,
        "Berikut adalah milestones utama proyek beserta kriteria keberhasilan (success "
        "criteria) yang terukur untuk setiap milestone:"
    )

    milestone_headers = ["No.", "Milestone", "Target", "Success Criteria"]
    milestone_rows = [
        ("M1", "Proposal Approved", "Akhir Minggu 2",
         "Proposal diterima, organisasi disetujui dosen"),
        ("M2", "Methodology Defined", "Akhir Minggu 4",
         "Metodologi dan project plan tervalidasi"),
        ("M3", "Architecture Vision Complete", "Akhir Minggu 6",
         "Vision document, principles, dan requirements catalog selesai"),
        ("M4", "Business Architecture Complete", "Akhir Minggu 8",
         "Process model dan org map tervalidasi stakeholder"),
        ("M5", "IS Architecture Complete", "Akhir Minggu 10",
         "Data model dan application landscape terintegrasi"),
        ("M6", "Technology Architecture Complete", "Akhir Minggu 12",
         "Infrastructure diagram dan technology roadmap final"),
        ("M7", "Final Submission", "Minggu 13",
         "Seluruh dokumen terkonsolidasi dan dipresentasikan"),
    ]
    add_table(doc, milestone_headers, milestone_rows,
              title="Milestones Proyek", table_number=4)

    add_paragraph(doc,
        "Monitoring milestone dilakukan melalui checklist review pada setiap weekly sync "
        "meeting. Jika sebuah milestone berisiko terlambat, tim akan melakukan re-planning "
        "dan alokasi ulang sumber daya untuk memastikan deadline utama tetap terpenuhi."
    )

    # ==========================================================================
    # Section 4: Analisis Risiko dan Strategi Mitigasi
    # ==========================================================================
    add_heading(doc, "4. Analisis Risiko dan Strategi Mitigasi", level=1)

    # 4.1 Identifikasi Risiko
    add_heading(doc, "4.1 Identifikasi Risiko", level=2)
    add_paragraph(doc,
        "Identifikasi risiko dilakukan menggunakan pendekatan brainstorming terstruktur "
        "yang mempertimbangkan tiga kategori utama risiko: risiko proyek (terkait "
        "pelaksanaan tugas besar), risiko teknis (terkait kompleksitas arsitektur), dan "
        "risiko bisnis (terkait validitas arsitektur terhadap konteks nyata LangkahKampus)."
    )
    add_paragraph(doc,
        "Setiap risiko dinilai berdasarkan dua dimensi: probabilitas terjadinya "
        "(likelihood) dan dampak terhadap keberhasilan proyek (impact). Kedua dimensi "
        "menggunakan skala 1-5 dimana 1 adalah sangat rendah dan 5 adalah sangat tinggi. "
        "Risk score dihitung sebagai perkalian probability dan impact."
    )

    # 4.2 Matriks Risiko
    add_heading(doc, "4.2 Matriks Risiko", level=2)

    risk_headers = ["ID", "Risiko", "Prob.", "Impact", "Score", "Level"]
    risk_rows = [
        ("R01", "Keterbatasan waktu per stage (2 minggu)", "4", "4", "16", "Tinggi"),
        ("R02", "Kurangnya akses ke data riil SNBP", "3", "4", "12", "Tinggi"),
        ("R03", "Kompleksitas arsitektur ML sulit dimodelkan", "3", "3", "9", "Sedang"),
        ("R04", "Inkonsistensi antar stage karena paralel work", "3", "3", "9", "Sedang"),
        ("R05", "Ketidaktersediaan expert review untuk validasi", "2", "3", "6", "Sedang"),
        ("R06", "Perubahan requirement di tengah proyek", "2", "4", "8", "Sedang"),
        ("R07", "Tool/teknologi modeling mengalami kendala", "2", "2", "4", "Rendah"),
        ("R08", "Anggota tim berhalangan (sakit/kegiatan lain)", "3", "3", "9", "Sedang"),
        ("R09", "Scope creep pada domain arsitektur", "3", "3", "9", "Sedang"),
        ("R10", "Feedback dosen memerlukan rework signifikan", "2", "4", "8", "Sedang"),
    ]
    add_table(doc, risk_headers, risk_rows,
              title="Matriks Risiko Proyek", table_number=5)

    add_paragraph(doc,
        "Berdasarkan matriks risiko di atas, terdapat dua risiko dengan level Tinggi "
        "(R01 dan R02) yang memerlukan strategi mitigasi prioritas, serta tujuh risiko "
        "level Sedang yang perlu dimonitor secara aktif."
    )

    # 4.3 Strategi Mitigasi Detail
    add_heading(doc, "4.3 Strategi Mitigasi Detail", level=2)

    add_paragraph(doc, "R01 - Keterbatasan Waktu per Stage (Risk Level: Tinggi)", bold=True)
    add_paragraph(doc,
        "Strategi Mitigasi: Implementasi time management yang ketat dengan internal "
        "deadline 3 hari sebelum submission deadline resmi. Pembagian kerja yang jelas "
        "sejak awal setiap stage dengan weekly checkpoint. Penggunaan template dokumen "
        "terstandar (automated document generation) untuk mengurangi waktu formatting. "
        "Buffer time dialokasikan untuk review dan revisi.",
        indent=0.5
    )
    add_paragraph(doc,
        "Contingency Plan: Jika waktu tidak mencukupi, tim akan melakukan prioritization "
        "berdasarkan rubrik penilaian dan fokus pada deliverables dengan bobot tertinggi. "
        "Content yang bersifat nice-to-have akan ditandai untuk dikembangkan di iterasi "
        "berikutnya.",
        indent=0.5
    )

    add_paragraph(doc, "R02 - Kurangnya Akses ke Data Riil SNBP (Risk Level: Tinggi)", bold=True)
    add_paragraph(doc,
        "Strategi Mitigasi: Penggunaan data publik yang tersedia dari sumber resmi "
        "(laman SNPMB, data statistik Kemendikbudristek) sebagai basis. Supplementasi "
        "dengan data simulasi yang representatif untuk model arsitektur. Fokus pada "
        "architectural patterns yang data-agnostic sehingga arsitektur tetap valid "
        "terlepas dari sumber data spesifik.",
        indent=0.5
    )
    add_paragraph(doc,
        "Contingency Plan: Jika data publik tidak tersedia, tim akan menggunakan "
        "synthetic data yang dibuat berdasarkan parameter statistik yang reasonable "
        "dan clearly documented assumptions.",
        indent=0.5
    )

    add_paragraph(doc, "R03 - Kompleksitas Arsitektur ML (Risk Level: Sedang)", bold=True)
    add_paragraph(doc,
        "Strategi Mitigasi: Referensi ke established ML architecture patterns "
        "(Google MLOps Maturity Model, Microsoft ML Architecture). Konsultasi dengan "
        "literature akademis tentang ML system architecture. Dekomposisi sistem ML "
        "menjadi komponen-komponen yang lebih manageable (training, serving, monitoring).",
        indent=0.5
    )

    add_paragraph(doc, "R04 - Inkonsistensi Antar Stage (Risk Level: Sedang)", bold=True)
    add_paragraph(doc,
        "Strategi Mitigasi: Penggunaan shared architecture repository (Git) dimana "
        "semua artefak arsitektur tersimpan secara terpusat. Cross-review antar anggota "
        "tim sebelum submission. Traceability matrix yang menghubungkan requirements "
        "dengan setiap artefak arsitektur di semua stage.",
        indent=0.5
    )

    add_paragraph(doc, "R08 - Anggota Tim Berhalangan (Risk Level: Sedang)", bold=True)
    add_paragraph(doc,
        "Strategi Mitigasi: Buddy system dimana setiap anggota memiliki satu backup "
        "yang familiar dengan domain pekerjaannya. Dokumentasi progress yang konsisten "
        "di shared workspace sehingga anggota lain dapat melanjutkan pekerjaan jika "
        "diperlukan. Minimum 2 hari buffer sebelum deadline untuk mengakomodasi absence.",
        indent=0.5
    )

    add_paragraph(doc, "R09 - Scope Creep (Risk Level: Sedang)", bold=True)
    add_paragraph(doc,
        "Strategi Mitigasi: Definisi scope yang jelas dan tertulis di awal setiap "
        "stage (documented dalam section 3.1). Change request harus disetujui oleh "
        "minimal 2 anggota tim sebelum ditambahkan ke scope. Focus pada \"minimum "
        "viable architecture\" yang memenuhi rubrik penilaian tanpa over-engineering.",
        indent=0.5
    )

    # ==========================================================================
    # Daftar Pustaka
    # ==========================================================================
    references = [
        "The Open Group. (2022). TOGAF Standard, 10th Edition. The Open Group.",
        "Harrison, R. (2018). TOGAF 9 Foundation Study Guide (4th ed.). Van Haren Publishing.",
        "Lankhorst, M. (2017). Enterprise Architecture at Work: Modelling, Communication and Analysis (4th ed.). Springer.",
        "Josey, A. (2018). TOGAF 9.2 - A Pocket Guide. Van Haren Publishing.",
        "Leffingwell, D. (2020). SAFe 5.0 Distilled: Achieving Business Agility with the Scaled Agile Framework. Addison-Wesley.",
        "Ford, N., Parsons, R., & Kua, P. (2017). Building Evolutionary Architectures: Support Constant Change. O'Reilly Media.",
        "Richards, M. (2015). Software Architecture Patterns. O'Reilly Media.",
        "Sculley, D., Holt, G., Golovin, D., Davydov, E., Phillips, T., Ebner, D., ... & Dennison, D. (2015). Hidden Technical Debt in Machine Learning Systems. Advances in Neural Information Processing Systems, 28.",
        "Google Cloud. (2021). MLOps: Continuous Delivery and Automation Pipelines in Machine Learning. Google Cloud Architecture Center.",
        "Project Management Institute. (2021). A Guide to the Project Management Body of Knowledge (PMBOK Guide) (7th ed.). PMI.",
        "Hillson, D. (2009). Managing Risk in Projects. Routledge.",
        "Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi. (2024). Panduan Seleksi Nasional Berdasarkan Prestasi (SNBP) Tahun 2024. Kemendikbudristek.",
    ]
    add_references(doc, references)

    # Save document
    save_document(doc, "Stage2_Methodology_and_Project_Planning.docx")
    print("Stage 2: Methodology and Project Planning - Berhasil di-generate!")


if __name__ == "__main__":
    generate_stage2()
