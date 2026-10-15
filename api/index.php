 
<?php
$namaMahasiswa = "";
$namaPerusahaan = "";
$statusPengajuan = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $namaMahasiswa = trim($_POST["nama_mahasiswa"] ?? "");
    $namaPerusahaan = trim($_POST["nama_perusahaan"] ?? "");

    if ($namaMahasiswa === "" || $namaPerusahaan === "") {
        $statusPengajuan = "Nama mahasiswa dan perusahaan wajib diisi.";
    } else {
        $statusPengajuan = "Pengajuan berhasil dibuat dan menunggu verifikasi admin.";
    }
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
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        header {
            background: #123b67;
            color: white;
            padding: 28px 20px;
            text-align: center;
        }

        header h1 {
            margin: 0 0 10px;
            font-size: 27px;
        }

        header p {
            margin: 0;
            color: #dbeafe;
        }

        main {
            width: min(700px, 92%);
            margin: 30px auto;
        }

        .card {
            background: white;
            padding: 24px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px #0000000d;
        }

        h2 {
            margin-top: 0;
            color: #123b67;
        }

        label {
            display: block;
            margin: 15px 0 7px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 15px;
        }

        button {
            margin-top: 20px;
            padding: 12px 18px;
            width: 100%;
            border: none;
            border-radius: 7px;
            background: #1769aa;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #123b67;
        }

        .hasil {
            margin-top: 20px;
            padding: 15px;
            background: #eff6ff;
            border-left: 4px solid #1769aa;
            border-radius: 5px;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #64748b;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Sistem Pengajuan Magang Mahasiswa</h1>
        <p>Prototipe aplikasi pengajuan magang berbasis web</p>
    </header>

    <main>
        <section class="card">
            <h2>Informasi Proyek</h2>
            <p>
                Sistem ini dirancang untuk membantu mahasiswa mengajukan
                magang dan mempermudah pengelolaan status pengajuan.
            </p>
            <p><strong>Teknologi:</strong> PHP, HTML, dan CSS</p>
            <p><strong>Pengguna:</strong> Mahasiswa dan admin magang</p>
        </section>

        <section class="card">
            <h2>Formulir Pengajuan Magang</h2>

            <form method="POST" action="">
                <label for="nama_mahasiswa">Nama Mahasiswa</label>
                <input
                    type="text"
                    id="nama_mahasiswa"
                    name="nama_mahasiswa"
                    value="<?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?>"
                    required
                >

                <label for="nama_perusahaan">Nama Perusahaan/Instansi</label>
                <input
                    type="text"
                    id="nama_perusahaan"
                    name="nama_perusahaan"
                    value="<?= htmlspecialchars($namaPerusahaan, ENT_QUOTES, 'UTF-8') ?>"
                    required
                >

                <button type="submit">Ajukan Magang</button>
            </form>

            <?php if ($statusPengajuan !== ""): ?>
                <div class="hasil" role="status">
                    <strong>Hasil Pemeriksaan:</strong>
                    <p><?= htmlspecialchars($statusPengajuan, ENT_QUOTES, 'UTF-8') ?></p>

                    <?php if (
                        $namaMahasiswa !== "" &&
                        $namaPerusahaan !== ""
                    ): ?>
                        <p>Nama: <?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?></p>
                        <p>Perusahaan: <?= htmlspecialchars($namaPerusahaan, ENT_QUOTES, 'UTF-8') ?></p>
                        <p>Status: Menunggu Verifikasi</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        UTS Rekayasa Perangkat Lunak &copy; 2026
    </footer>
</body>
</html>
