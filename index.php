```php
<?php
$namaMahasiswa = "";
$namaPerusahaan = "";
$statusPengajuan = "";
$isValid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $namaMahasiswa = trim($_POST["nama_mahasiswa"] ?? "");
    $namaPerusahaan = trim($_POST["nama_perusahaan"] ?? "");

    if ($namaMahasiswa === "" || $namaPerusahaan === "") {
        $statusPengajuan = "Nama mahasiswa dan perusahaan wajib diisi.";
    } else {
        $isValid = true;
        $statusPengajuan = "Pengajuan berhasil dibuat dan menunggu verifikasi admin.";
    }
}

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengajuan Magang Mahasiswa</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1e293b;
            line-height: 1.6;
        }

        header {
            background: linear-gradient(135deg, #123b67, #1769aa);
            color: white;
            padding: 42px 20px;
            text-align: center;
        }

        .label-atas {
            display: inline-block;
            padding: 5px 12px;
            border: 1px solid #ffffff70;
            border-radius: 30px;
            font-size: 12px;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        header h1 {
            margin: 0 0 10px;
            font-size: clamp(24px, 4vw, 34px);
        }

        header p {
            margin: 0;
            color: #dbeafe;
        }

        main {
            width: min(760px, 92%);
            margin: 32px auto;
        }

        .card {
            background: white;
            padding: 28px;
            margin-bottom: 22px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 8px 24px #0f172a0a;
        }

        .judul-kecil {
            color: #1769aa;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        h2 {
            margin: 5px 0 12px;
            color: #123b67;
            font-size: 22px;
        }

        .info {
            color: #64748b;
            margin-bottom: 20px;
        }

        .fitur {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 20px;
        }

        .fitur-item {
            padding: 15px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        .fitur-item strong {
            display: block;
            color: #123b67;
            margin-bottom: 4px;
        }

        .fitur-item span {
            font-size: 13px;
            color: #64748b;
        }

        label {
            display: block;
            margin: 18px 0 7px;
            font-weight: bold;
            font-size: 14px;
        }

        input {
            display: block;
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            font-size: 15px;
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
        }

        input:focus {
            outline: none;
            border-color: #1769aa;
            box-shadow: 0 0 0 3px #1769aa20;
        }

        button {
            margin-top: 24px;
            padding: 14px 18px;
            width: 100%;
            border: none;
            border-radius: 9px;
            background: #1769aa;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        button:hover {
            background: #123b67;
            transform: translateY(-1px);
        }

        .hasil {
            margin-top: 22px;
            padding: 17px;
            border-radius: 10px;
            overflow-wrap: anywhere;
        }

        .hasil.sukses {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .hasil.gagal {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
        }

        .hasil p {
            margin: 7px 0;
        }

        footer {
            text-align: center;
            padding: 24px 16px;
            color: #64748b;
            font-size: 13px;
        }

        @media (max-width: 520px) {
            header {
                padding: 32px 16px;
            }

            .card {
                padding: 21px;
            }

            .fitur {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="label-atas">PORTAL AKADEMIK</div>
        <h1>Sistem Pengajuan Magang Mahasiswa</h1>
        <p>Ajukan rencana magang dengan proses yang lebih terstruktur.</p>
    </header>

    <main>
        <section class="card">
            <div class="judul-kecil">Tentang Sistem</div>
            <h2>Informasi Proyek</h2>
            <p class="info">
                Prototipe aplikasi berbasis web untuk membantu mahasiswa
                mengajukan magang dan melihat hasil pemeriksaan awal
                pengajuan.
            </p>

            <div class="fitur">
                <div class="fitur-item">
                    <strong>Formulir Digital</strong>
                    <span>Masukkan identitas mahasiswa dan perusahaan tujuan.</span>
                </div>
                <div class="fitur-item">
                    <strong>Status Pengajuan</strong>
                    <span>Menampilkan hasil pemeriksaan awal formulir.</span>
                </div>
            </div>

            <p><strong>Teknologi:</strong> PHP, HTML, CSS</p>
            <p><strong>Pengguna:</strong> Mahasiswa dan admin magang</p>
        </section>

        <section class="card">
            <div class="judul-kecil">Formulir Online</div>
            <h2>Pengajuan Magang</h2>
            <p class="info">Lengkapi data berikut dengan benar.</p>

            <form method="POST" action="">
                <label for="nama_mahasiswa">Nama Mahasiswa</label>
                <input
                    type="text"
                    id="nama_mahasiswa"
                    name="nama_mahasiswa"
                    value="<?= e($namaMahasiswa) ?>"
                    placeholder="Masukkan nama lengkap"
                    maxlength="100"
                    required
                >

                <label for="nama_perusahaan">Nama Perusahaan/Instansi</label>
                <input
                    type="text"
                    id="nama_perusahaan"
                    name="nama_perusahaan"
                    value="<?= e($namaPerusahaan) ?>"
                    placeholder="Masukkan nama perusahaan tujuan"
                    maxlength="150"
                    required
                >

                <button type="submit">Kirim Pengajuan Magang</button>
            </form>

            <?php if ($statusPengajuan !== ""): ?>
                <div
                    class="hasil <?= $isValid ? 'sukses' : 'gagal' ?>"
                    role="status"
                >
                    <strong>
                        <?= $isValid ? 'Pengajuan Tercatat' : 'Periksa Kembali Data' ?>
                    </strong>
                    <p><?= e($statusPengajuan) ?></p>

                    <?php if ($isValid): ?>
                        <p><strong>Nama:</strong> <?= e($namaMahasiswa) ?></p>
                        <p><strong>Perusahaan:</strong> <?= e($namaPerusahaan) ?></p>
                        <p><strong>Status:</strong> Menunggu Verifikasi</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        UTS Rekayasa Perangkat Lunak &copy; 2026
        <br>
        Sistem Informasi Pengajuan dan Monitoring Magang Mahasiswa
    </footer>
</body>
</html>
```