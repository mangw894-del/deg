<?php
include '../config.php';
include '../auth.php';

if($_SESSION['role']!='admin'){
    die("Akses ditolak!");
}

$jbuku = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM buku"))['total'];
$juser = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM users"))['total'];
$jadmin = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM users WHERE role='admin'"))['total'];
$juser_biasa = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM users WHERE role='user'"))['total'];

$riwayat = mysqli_query($koneksi, "SELECT peminjaman.*, buku.judul 
                                   FROM peminjaman 
                                   LEFT JOIN buku ON peminjaman.id_buku = buku.id 
                                   ORDER BY peminjaman.id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Eleghan Style</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f4f7fe; 
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 270px;
            background: #1a1c2e; 
            color: #a0aec0;
            padding: 30px 20px;
            min-height: 100vh;
            position: fixed; 
        }

        .sidebar h3 {
            text-align: center;
            color: #fff;
            font-size: 20px;
            letter-spacing: 2px;
            margin-bottom: 40px;
            text-transform: uppercase;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 14px 18px;
            color: #cbd5e0;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.05);
            color: #fff;
            padding-left: 25px;
        }

        .sidebar a.active {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: #fff;
            box-shadow: 0 4px 15px rgba(78, 115, 223, 0.3);
        }

        /* CSS LOGOUT MERAH */
        .sidebar .logout {
            background: rgba(231, 74, 59, 0.1);
            color: #e74a3b;
            margin-top: 30px;
        }

        .sidebar .logout:hover {
            background: #e74a3b;
            color: #fff;
        }

        .content {
            flex: 1;
            padding: 40px;
            margin-left: 270px; 
        }

        .header {
            background: #fff;
            padding: 25px 35px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            margin-bottom: 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h2 { color: #2d3748; font-size: 24px; }
        .header b { color: #4e73df; }

        .date-box {
            background: #f8f9fc;
            padding: 10px 20px;
            border-radius: 10px;
            color: #4e73df;
            font-size: 14px;
            font-weight: 600;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
        }

        .card {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.02);
            transition: transform 0.3s ease;
            border: 1px solid #edf2f7;
            position: relative;
            overflow: hidden;
        }

        .card:hover { transform: translateY(-5px); }
        .card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 100%; height: 5px;
            background: #4e73df;
        }

        .card h3 { font-size: 42px; font-weight: 700; margin-bottom: 5px; }
        .card p { color: #a0aec0; font-size: 12px; font-weight: 600; text-transform: uppercase; }

        .card:nth-child(1) h3 { color: #4e73df; } 
        .card:nth-child(2) h3 { color: #1cc88a; } 
        .card:nth-child(3) h3 { color: #f6ad55; } 
        .card:nth-child(4) h3 { color: #9f7aea; } 

        .history-section {
            margin-top: 40px;
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.02);
            border: 1px solid #edf2f7;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            background: #f8f9fc;
            padding: 15px;
            color: #4e73df;
            font-size: 13px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #edf2f7;
            font-size: 14px;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
        }

        .bg-warning { background: #fff3cd; color: #856404; }
        .bg-success { background: #d4edda; color: #155724; }
        .bg-info { background: #e1e7ff; color: #4e73df; }

        .footer {
            margin-top: 50px;
            text-align: center;
            color: #a0aec0;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <?php include 'sidebar.php'; ?>

    <div class="content">
        <div class="header">
            <div>
                <h2>Dashboard Utama</h2>
                <p>Selamat datang kembali, <b><?= $_SESSION['username']; ?></b></p>
            </div>
            <div class="date-box">
                <?= date('d F Y') ?>
            </div>
        </div>

        <div class="dashboard">
            <div class="card">
                <h3><?= $jbuku ?></h3>
                <p>Total Koleksi Buku</p>
            </div>
            <div class="card">
                <h3><?= $juser ?></h3>
                <p>Total Anggota</p>
            </div>
            <div class="card">
                <h3><?= $jadmin ?></h3>
                <p>Staf Admin</p>
            </div>
            <div class="card">
                <h3><?= $juser_biasa ?></h3>
                <p>Anggota Aktif</p>
            </div>
        </div>

        <div class="history-section">
            <h3>Riwayat Peminjaman Terbaru</h3>
            <table>
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($riwayat)): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($row['nama_peminjam'] ?: 'Guest') ?></strong></td>
                        <td><?= htmlspecialchars($row['judul'] ?: 'Buku Terhapus') ?></td>
                        <td><?= date('d/m/Y', strtotime($row['tanggal_pinjam'])) ?></td>
                        <td>
                            <?php 
                                $s = $row['status'];
                                $cls = ($s == 'Dipinjam') ? 'bg-warning' : (($s == 'Dikembalikan' || $s == 'kembali') ? 'bg-success' : 'bg-info');
                            ?>
                            <span class="badge <?= $cls ?>"><?= strtoupper($s) ?></span>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="footer">
            Sistem Informasi Perpustakaan Digital &bull; &copy; <?= date('Y') ?>
        </div>
    </div>
</div>

</body>
</html>