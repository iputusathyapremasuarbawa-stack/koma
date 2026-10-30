<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - PMB Online</title>
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/3135/3135810.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --warna-utama: #0d9488;
            --warna-gelap: #0f2a3d;
        }
        body {
            background: #eef3f6;
        }
        .navbar-pmb {
            background: var(--warna-gelap);
            border-bottom: 4px solid var(--warna-utama);
        }
        .navbar-pmb .logo {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--warna-utama);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .navbar-pmb .nav-link {
            border-radius: 20px;
            padding: 6px 16px !important;
        }
        .navbar-pmb .nav-link.active {
            background: var(--warna-utama);
        }
        .judul-halaman {
            background: linear-gradient(135deg, var(--warna-gelap), var(--warna-utama));
            color: #fff;
            padding: 30px 0 70px;
        }
        .kartu {
            margin-top: -50px;
            border: none;
            border-radius: 12px;
        }
        .judul-bagian {
            color: var(--warna-utama);
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 6px;
            margin-bottom: 16px;
        }
        .input-group-text {
            background: #f0fdfa;
            color: var(--warna-utama);
        }
        .pilih-jk {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 6px 12px;
        }
        .btn-utama {
            background: var(--warna-utama);
            color: #fff;
        }
        .btn-utama:hover {
            background: #0f766e;
            color: #fff;
        }
        .footer-pmb {
            background: var(--warna-gelap);
            color: #cbd5e1;
        }
        .footer-pmb a {
            color: #cbd5e1;
            text-decoration: none;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark navbar-pmb py-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="form_tambah.php">
                <span class="logo me-2"><i class="fa-solid fa-graduation-cap"></i></span>
                <span>
                    <strong>PMB Online</strong><br>
                    <small class="fw-light" style="font-size: 12px;">Penerimaan Mahasiswa Baru</small>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto gap-1">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-house me-1"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="form_tambah.php"><i class="fa-solid fa-pen-to-square me-1"></i> Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-circle-info me-1"></i> Informasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="judul-halaman">
        <div class="container">
            <h3 class="mb-1"><?= $title ?></h3>
            <p class="mb-0 opacity-75">Tahun Akademik <?= date('Y') ?>/<?= date('Y') + 1 ?></p>
        </div>
    </div>

    <main class="container mb-5 flex-grow-1">
