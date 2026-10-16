<?php
$namaMahasiswa = "";
$namaPerusahaan = "";
$statusPengajuan = "";
$isValid = false;

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $namaMahasiswa = trim($_POST["nama_mahasiswa"] ?? "");
    $namaPerusahaan = trim($_POST["nama_perusahaan"] ?? "");

    if ($namaMahasiswa === "" || $namaPerusahaan === "") {
        $statusPengajuan = "Nama mahasiswa dan nama perusahaan wajib diisi.";
    } else {
        $isValid = true;
        $statusPengajuan = "Pengajuan berhasil dibuat dan menunggu verifikasi admin.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Pengajuan dan Monitoring Magang Mahasiswa">
    <title>Sistem Magang Mahasiswa</title>

    <style>
        :root {
            --primary: #2457d6;
            --primary-dark: #183fa8;
            --primary-light: #edf3ff;
            --background: #f5f7fb;
            --surface: #ffffff;
            --text: #17233d;
            --muted: #718096;
            --border: #e5eaf2;
            --success: #16835d;
            --warning: #a76508;
            --radius: 18px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            background: var(--background);
            color: var(--text);
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button, input {
            font: inherit;
        }

        .layout {
            display: grid;
            grid-template-columns: 250px minmax(0, 1fr);
            min-height: 100vh;
        }

        .sidebar {
            background: #fff;
            border-right: 1px solid var(--border);
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
            gap: 34px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 8px;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            color: white;
            font-size: 23px;
            font-weight: 800;
            background: linear-gradient(135deg, #3877ff, #2046bd);
            box-shadow: 0 8px 20px #2457d62b;
        }

        .brand-name {
            font-size: 16px;
            font-weight: 800;
            line-height: 1.3;
        }

        .brand-subtitle {
            font-size: 11px;
            color: var(--muted);
            margin-top: 4px;
        }

        .nav-label {
            color: #98a3b6;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.2px;
            padding: 0 12px;
            margin-bottom: 12px;
        }

        .nav-menu {
            display: grid;
            gap: 7px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            color: #65728a;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            transition: .2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary);
            background: var(--primary-light);
        }

        .nav-icon {
            width: 23px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-note {
            margin-top: auto;
            padding: 18px;
            border-radius: 15px;
            background: #f2f6ff;
            border: 1px solid #e0e9ff;
        }

        .sidebar-note strong {
            font-size: 13px;
        }

        .sidebar-note p {
            color: var(--muted);
            font-size: 12px;
            margin-top: 7px;
        }

        .main {
            min-width: 0;
        }

        .topbar {
            min-height: 83px;
            padding: 18px 36px;
            background: rgba(255,255,255,.92);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .breadcrumb {
            color: var(--muted);
            font-size: 12px;
        }

        .topbar h1 {
            font-size: 21px;
            line-height: 1.35;
            margin-top: 3px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 41px;
            height: 41px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: var(--primary);
            background: var(--primary-light);
            font-weight: 800;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
        }

        .user-role {
            font-size: 11px;
            color: var(--muted);
        }

        .content {
            width: 100%;
            max-width: 1500px;
            margin: auto;
            padding: 32px 36px 40px;
        }

        .welcome {
            padding: 30px;
            border-radius: 22px;
            background: linear-gradient(120deg, #2149ba, #3677f6);
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 25px;
        }

        .welcome::after {
            content: "";
            position: absolute;
            width: 240px;
            height: 240px;
            border: 42px solid #ffffff12;
            border-radius: 50%;
            right: -60px;
            top: -100px;
        }

        .welcome-label {
            font-size: 12px;
            letter-spacing: 1.4px;
            font-weight: 700;
            opacity: .8;
            text-transform: uppercase;
        }

        .welcome h2 {
            font-size: clamp(23px, 3vw, 31px);
            line-height: 1.25;
            margin: 9px 0;
            max-width: 650px;
        }

        .welcome p {
            font-size: 14px;
            max-width: 600px;
            color: #e7eeff;
        }

        .welcome-button {
            display: inline-flex;
            margin-top: 20px;
            padding: 11px 17px;
            background: white;
            color: var(--primary-dark);
            border-radius: 10px;
            font-size: 13px;
            font-weight: 800;
            position: relative;
            z-index: 1;
            transition: transform .2s;
        }

        .welcome-button:hover {
            transform: translateY(-2px);
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 12px;
            margin: 29px 0 15px;
        }

        .section-heading h2 {
            font-size: 18px;
        }

        .section-heading p {
            font-size: 12px;
            color: var(--muted);
            margin-top: 3px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .info-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 21px;
            box-shadow: 0 4px 16px #1c315308;
        }

        .info-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .info-card-title {
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
        }

        .info-icon {
            display: grid;
            place-items: center;
            width: 39px;
            height: 39px;
            border-radius: 12px;
            background: var(--primary-light);
            font-size: 19px;
        }

        .info-card h3 {
            font-size: 17px;
            margin-top: 16px;
        }

        .info-card p {
            color: var(--muted);
            font-size: 12px;
            margin-top: 5px;
        }

        .workspace {
            display: grid;
            grid-template-columns: minmax(0, 1.45fr) minmax(260px, .85fr);
            gap: 20px;
            margin-top: 25px;
            align-items: start;
        }

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 25px;
            min-width: 0;
            box-shadow: 0 4px 16px #1c315308;
        }

        .panel-heading {
            margin-bottom: 22px;
        }

        .panel-heading h2 {
            font-size: 18px;
        }

        .panel-heading p {
            color: var(--muted);
            font-size: 12px;
            margin-top: 4px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .required {
            color: #d34444;
        }

        .form-group input {
            width: 100%;
            border: 1px solid #dce3ee;
            border-radius: 11px;
            padding: 13px 14px;
            outline: none;
            color: var(--text);
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-group input::placeholder {
            color: #a3adbd;
        }

        .form-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px #2457d615;
        }

        .field-help {
            font-size: 11px;
            color: var(--muted);
            margin-top: 6px;
        }

        .submit-button {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            width: 100%;
            border: none;
            border-radius: 11px;
            padding: 14px 18px;
            color: white;
            background: var(--primary);
            font-weight: 800;
            font-size: 13px;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .submit-button:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .notice {
            padding: 13px 15px;
            border-radius: 11px;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .notice.success {
            background: #eaf8f1;
            border: 1px solid #c7edda;
            color: var(--success);
        }

        .notice.error {
            background: #fff1f0;
            border: 1px solid #ffd6d2;
            color: #b52d2d;
        }

        .notice strong {
            display: block;
            margin-bottom: 3px;
        }

        .status-card {
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 18px;
        }

        .status-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .status-top h3 {
            font-size: 14px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 30px;
            padding: 5px 9px;
            background: #fff4df;
            color: var(--warning);
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #e6a12b;
        }

        .status-description {
            color: var(--muted);
            font-size: 12px;
            margin-top: 9px;
        }

        .progress-track {
            height: 6px;
            border-radius: 10px;
            background: #edf0f6;
            overflow: hidden;
            margin: 19px 0 7px;
        }

        .progress-fill {
            height: 100%;
            width: 35%;
            background: var(--primary);
            border-radius: 10px;
        }

        .progress-caption {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            font-size: 10px;
            color: var(--muted);
        }

        .steps {
            margin-top: 23px;
        }

        .step {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding-bottom: 22px;
            position: relative;
        }

        .step:last-child {
            padding-bottom: 0;
        }

        .step:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 32px;
            left: 15px;
            height: calc(100% - 32px);
            border-left: 1px dashed #d4dcea;
        }

        .step-number {
            width: 31px;
            height: 31px;
            flex: 0 0 31px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #8490a5;
            background: #f0f3f8;
            font-size: 12px;
            font-weight: 800;
            position: relative;
            z-index: 1;
        }

        .step.done .step-number {
            color: white;
            background: var(--success);
        }

        .step.current .step-number {
            color: white;
            background: var(--primary);
            box-shadow: 0 0 0 4px #2457d615;
        }

        .step h4 {
            font-size: 12px;
            margin-top: 2px;
        }

        .step p {
            color: var(--muted);
            font-size: 11px;
            margin-top: 3px;
        }

        .footer {
            text-align: center;
            color: #8b96a9;
            font-size: 11px;
            padding: 30px 10px 5px;
        }

        @media (max-width: 1100px) {
            .layout {
                grid-template-columns: 210px minmax(0, 1fr);
            }

            .content {
                padding: 25px 22px;
            }

            .topbar {
                padding: 17px 22px;
            }

            .workspace {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 760px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                padding: 15px 16px;
                gap: 15px;
                border-right: none;
                border-bottom: 1px solid var(--border);
            }

            .sidebar .nav-label,
            .sidebar-note {
                display: none;
            }

            .brand {
                padding: 0 3px;
            }

            .nav-menu {
                display: flex;
                overflow-x: auto;
                padding-bottom: 2px;
            }

            .nav-link {
                padding: 9px 11px;
                white-space: nowrap;
                font-size: 12px;
            }

            .nav-icon {
                font-size: 15px;
                width: auto;
            }

            .topbar {
                min-height: 70px;
                padding: 15px 18px;
            }

            .topbar h1 {
                font-size: 18px;
            }

            .user-name,
            .user-role {
                display: none;
            }

            .content {
                padding: 20px 15px 28px;
            }

            .welcome {
                padding: 24px 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .info-card {
                padding: 17px;
            }

            .info-card h3 {
                margin-top: 8px;
            }

            .panel {
                padding: 19px;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                transition: none !important;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    <aside class="sidebar">
        <a href="#beranda" class="brand">
            <div class="brand-icon">M</div>
            <div>
                <div class="brand-name">Sistem Magang</div>
                <div class="brand-subtitle">Layanan Akademik Mahasiswa</div>
            </div>
        </a>

        <div>
            <div class="nav-label">MENU UTAMA</div>
            <nav class="nav-menu" aria-label="Navigasi utama">
                <a href="#beranda" class="nav-link active">
                    <span class="nav-icon">⌂</span> Beranda
                </a>
                <a href="#pengajuan" class="nav-link">
                    <span class="nav-icon">▤</span> Pengajuan Magang
                </a>
                <a href="#status" class="nav-link">
                    <span class="nav-icon">◷</span> Monitoring Status
                </a>
                <a href="#alur" class="nav-link">
                    <span class="nav-icon">☷</span> Alur Pengajuan
                </a>
            </nav>
        </div>

        <div class="sidebar-note">
            <strong>Butuh bantuan?</strong>
            <p>Pastikan nama mahasiswa dan perusahaan diisi dengan benar sebelum mengirim formulir.</p>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <div class="breadcrumb">Layanan Akademik / Magang</div>
                <h1 id="beranda">Dashboard Mahasiswa</h1>
            </div>

            <div class="user-profile">
                <div class="avatar">M</div>
                <div>
                    <div class="user-name">Mahasiswa</div>
                    <div class="user-role">Portal Pengajuan Magang</div>
                </div>
            </div>
        </header>

        <div class="content">

            <section class="welcome">
                <div class="welcome-label">Portal Layanan Magang</div>
                <h2>Mulai langkah profesionalmu dari sini.</h2>
                <p>
                    Ajukan rencana magang dan pantau tahapan prosesnya melalui
                    satu halaman yang mudah digunakan.
                </p>
                <a href="#pengajuan" class="welcome-button">Buat Pengajuan <span>→</span></a>
            </section>

            <div class="section-heading">
                <div>
                    <h2>Ringkasan Layanan</h2>
                    <p>Informasi utama dalam proses pengajuan magang.</p>
                </div>
            </div>

            <section class="info-grid" aria-label="Ringkasan layanan">
                <article class="info-card">
                    <div class="info-card-top">
                        <span class="info-card-title">Layanan 01</span>
                        <span class="info-icon">📝</span>
                    </div>
                    <h3>Pengajuan Magang</h3>
                    <p>Isi data mahasiswa dan perusahaan tujuan.</p>
                </article>

                <article class="info-card">
                    <div class="info-card-top">
                        <span class="info-card-title">Layanan 02</span>
                        <span class="info-icon">🔎</span>
                    </div>
                    <h3>Monitoring Status</h3>
                    <p>Lihat informasi status dari hasil pengajuan.</p>
                </article>

                <article class="info-card">
                    <div class="info-card-top">
                        <span class="info-card-title">Layanan 03</span>
                        <span class="info-icon">✓</span>
                    </div>
                    <h3>Verifikasi Admin</h3>
                    <p>Pengajuan perlu diperiksa oleh pihak berwenang.</p>
                </article>
            </section>

            <section class="workspace">

                <div class="panel" id="pengajuan">
                    <div class="panel-heading">
                        <h2>Formulir Pengajuan Magang</h2>
                        <p>Lengkapi informasi berikut untuk membuat pengajuan.</p>
                    </div>

                    <?php if ($statusPengajuan !== ""): ?>
                        <div class="notice <?= $isValid ? 'success' : 'error' ?>" role="status">
                            <strong>
                                <?= $isValid ? '✓ Pengajuan berhasil' : 'Periksa kembali data' ?>
                            </strong>
                            <?= e($statusPengajuan) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="#pengajuan">
                        <div class="form-group">
                            <label for="nama_mahasiswa">
                                Nama Mahasiswa <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                id="nama_mahasiswa"
                                name="nama_mahasiswa"
                                placeholder="Masukkan nama lengkap"
                                value="<?= e($namaMahasiswa) ?>"
                                maxlength="100"
                                autocomplete="name"
                                required
                            >
                            <div class="field-help">Gunakan nama lengkap sesuai data akademik.</div>
                        </div>

                        <div class="form-group">
                            <label for="nama_perusahaan">
                                Nama Perusahaan Tujuan <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                id="nama_perusahaan"
                                name="nama_perusahaan"
                                placeholder="Contoh: PT Teknologi Indonesia"
                                value="<?= e($namaPerusahaan) ?>"
                                maxlength="150"
                                required
                            >
                            <div class="field-help">Masukkan nama perusahaan tempat kamu merencanakan magang.</div>
                        </div>

                        <button type="submit" class="submit-button">
                            Kirim Pengajuan <span>→</span>
                        </button>
                    </form>
                </div>

                <div class="panel" id="status">
                    <div class="panel-heading">
                        <h2>Status & Alur Pengajuan</h2>
                        <p>Gambaran tahapan yang perlu dilalui mahasiswa.</p>
                    </div>

                    <div class="status-card">
                        <div class="status-top">
                            <h3>Status Pengajuan</h3>
                            <span class="status-pill">
                                <span class="status-dot"></span>
                                <?= $isValid ? 'Menunggu Verifikasi' : 'Belum Diajukan' ?>
                            </span>
                        </div>

                        <p class="status-description">
                            <?php if ($isValid): ?>
                                Pengajuan untuk <strong><?= e($namaMahasiswa) ?></strong>
                                ke <strong><?= e($namaPerusahaan) ?></strong> telah diproses oleh prototipe.
                                Verifikasi admin belum terhubung ke sistem nyata.
                            <?php else: ?>
                                Status akan berubah setelah formulir diisi dengan lengkap dan dikirim.
                            <?php endif; ?>
                        </p>

                        <div class="progress-track">
                            <div class="progress-fill"
                                 style="width: <?= $isValid ? '50%' : '0%' ?>"></div>
                        </div>
                        <div class="progress-caption">
                            <span>Proses pengajuan</span>
                            <span><?= $isValid ? 'Menunggu verifikasi' : 'Belum dimulai' ?></span>
                        </div>
                    </div>

                    <div class="steps" id="alur">
                        <div class="step done">
                            <div class="step-number">1</div>
                            <div>
                                <h4>Isi Formulir</h4>
                                <p>Masukkan identitas dan perusahaan tujuan.</p>
                            </div>
                        </div>

                        <div class="step <?= $isValid ? 'current' : '' ?>">
                            <div class="step-number">2</div>
                            <div>
                                <h4>Verifikasi Pengajuan</h4>
                                <p>Admin memeriksa data dan persyaratan magang.</p>
                            </div>
                        </div>

                        <div class="step">
                            <div class="step-number">3</div>
                            <div>
                                <h4>Informasi Hasil</h4>
                                <p>Mahasiswa memperoleh informasi hasil verifikasi.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <footer class="footer">
                Sistem Informasi Pengajuan dan Monitoring Magang Mahasiswa
                <br>
                Prototipe proyek Rekayasa Perangkat Lunak
            </footer>
        </div>
    </main>
</div>
</body>
</html>