<?php
include '../config.php';
include '../auth.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $admin_name = $_SESSION['username']; 

    if ($action === 'confirm') {
        $tgl_pinjam = date('Y-m-d');
        $sql = "UPDATE peminjaman SET status='Dipinjam', tanggal_pinjam='$tgl_pinjam' WHERE id='$id'";
        $msg = "Status: Peminjaman Dikonfirmasi";
        $aktivitas = "Admin $admin_name mengonfirmasi peminjaman buku (ID Pinjam: $id)";
    } elseif ($action === 'cancel') {
        $sql = "UPDATE peminjaman SET status='dibatalkan' WHERE id='$id'";
        $msg = "Status: Peminjaman Dibatalkan";
        $aktivitas = "Admin $admin_name membatalkan peminjaman buku (ID Pinjam: $id)";
    }

    if (mysqli_query($koneksi, $sql)) {
        mysqli_query($koneksi, "INSERT INTO log_aktivitas (nama_pelaku, aktivitas, waktu) VALUES ('$admin_name', '$aktivitas', NOW())");
        echo "<script>alert('$msg'); window.location='riwayat_peminjaman.php';</script>";
    }
}

$query = mysqli_query($koneksi, "
    SELECT peminjaman.*, buku.judul 
    FROM peminjaman
    JOIN buku ON peminjaman.id_buku = buku.id
    ORDER BY peminjaman.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #1a1c2e;
            --sidebar-hover: rgba(255, 255, 255, 0.05);
            --text-gray: #718096;
            --border-color: #edf2f7;
            --bg-light: #f4f7fe;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        body { background: var(--bg-light); color: #2d3748; }

        .wrapper { display: flex; min-height: 100vh; }

        .sidebar {
            width: 270px;
            background: var(--primary-dark);
            color: #a0aec0;
            padding: 30px 20px;
            position: fixed;
            height: 100vh;
        }

        .sidebar h3 {
            text-align: center; color: #fff; font-size: 20px; letter-spacing: 2px;
            margin-bottom: 40px; text-transform: uppercase;
            border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 20px;
        }

        .sidebar a {
            display: block; padding: 14px 18px; color: #cbd5e0;
            text-decoration: none; border-radius: 12px; margin-bottom: 8px;
            transition: all 0.3s ease; font-size: 14px;
        }

        .sidebar a:hover, .sidebar a.active { background: var(--sidebar-hover); color: #fff; }
        .sidebar .logout { background: rgba(231, 74, 59, 0.1); color: #ff7675; margin-top: 30px; }

        .content { flex: 1; padding: 40px; margin-left: 270px; }
        
        .container { 
            background: white; padding: 35px; border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid var(--border-color);
        }

        .header-flex { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 30px; 
        }
        .header-flex h2 { font-size: 24px; color: var(--primary-dark); }

        .btn-print {
            background: #4e73df;
            color: white;
            padding: 10px 25px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-print:hover { background: #2e59d9; }

        table { width: 100%; border-collapse: collapse; }
        th { 
            background: #f8f9fc; color: var(--primary-dark); font-weight: 600;
            text-transform: uppercase; font-size: 12px; padding: 15px;
            border-bottom: 2px solid var(--border-color); text-align: left;
        }
        td { padding: 18px 15px; border-bottom: 1px solid var(--border-color); font-size: 14px; }

        /* BADGES */
        .badge { padding: 5px 12px; border-radius: 4px; font-size: 10px; font-weight: 700; text-transform: uppercase; display: inline-block; }
        .status-menunggu { background: #fff3bf; color: #664d03; }
        .status-pinjam { background: #dbeafe; color: #1e40af; }
        .status-kembali { background: #cfdfd0; color: #1e4620; }
        .status-dibatalkan { background: #f8d7da; color: #842029; }

        .btn-group-vertical {
            display: flex;
            flex-direction: column;
            gap: 6px;
            width: fit-content;
        }

        .btn-action {
            padding: 7px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            transition: 0.3s;
        }

        .btn-confirm {
            background: var(--primary-dark);
            color: #fff;
            border: 1px solid var(--primary-dark);
        }

        .btn-cancel {
            background: #fff;
            color: var(--text-gray);
            border: 1px solid #cbd5e0;
        }

        .btn-action:hover {
            opacity: 0.8;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .date-info {
            font-size: 12px;
            color: var(--text-gray);
            line-height: 1.4;
        }

        .date-label { font-weight: 600; color: #4a5568; }

        @media print {
            .sidebar, .btn-print, .btn-group-vertical, th:last-child, td:last-child {
                display: none !important;
            }
            .content { margin-left: 0; padding: 0; }
            .container { border: none; box-shadow: none; }
            body { background: white; }
            table { border: 1px solid #000; }
            th, td { border: 1px solid #ddd; }
        }

    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h3>ADMIN PANEL</h3>
        <a href="dashboard_admin.php">Dashboard</a>
        <a href="data_buku.php">Data Buku</a>
        <a href="tambah_buku.php">Tambah Buku</a>
        <a href="riwayat_peminjaman.php" class="active">Riwayat Peminjaman</a>
        <a href="data_anggota.php">Data Anggota</a>
        <a href="tambah_anggota.php">Tambah Anggota</a>
        <a href="laporan_aktivitas.php">Laporan Aktivitas</a>
        <a href="../logout.php" class="logout">Logout</a>
    </div>

    <div class="content">
        <div class="container">
            <div class="header-flex">
                <h2>Riwayat Peminjaman</h2>
                <button onclick="window.print()" class="btn-print">
                    Cetak Laporan
                </button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="30%">JUDUL BUKU</th>
                        <th width="20%">PEMINJAM</th>
                        <th width="20%">DETAIL WAKTU</th>
                        <th width="10%">STATUS</th>
                        <th width="15%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if (mysqli_num_rows($query) > 0):
                        while($row = mysqli_fetch_assoc($query)): 
                            $status = trim($row['status'] ?? 'menunggu_konfirmasi');
                            $tgl_pinjam = ($row['tanggal_pinjam'] && $row['tanggal_pinjam'] != '0000-00-00') ? date('d/m/Y', strtotime($row['tanggal_pinjam'])) : '-';
                            $tgl_kembali = ($row['tanggal_kembali'] && $row['tanggal_kembali'] != '0000-00-00') ? date('d/m/Y', strtotime($row['tanggal_kembali'])) : '-';
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><strong style="color:#2d3748;"><?= htmlspecialchars($row['judul']); ?></strong></td>
                        <td><?= htmlspecialchars($row['nama_peminjam'] ?? $row['nama_anggota'] ?? 'User'); ?></td>
                        <td class="date-info">
                            <div><span class="date-label">Pinjam:</span> <?= $tgl_pinjam ?></div>
                            <div><span class="date-label">Kembali:</span> <?= $tgl_kembali ?></div>
                        </td>
                        <td>
                            <?php 
                                if ($status == 'menunggu_konfirmasi') {
                                    $badge_class = 'status-menunggu';
                                    $display_status = 'Menunggu';
                                } elseif ($status == 'Dipinjam') {
                                    $badge_class = 'status-pinjam';
                                    $display_status = 'Dipinjam';
                                } elseif ($status == 'Dikembalikan') {
                                    $badge_class = 'status-kembali';
                                    $display_status = 'Kembali';
                                } elseif ($status == 'dibatalkan') {
                                    $badge_class = 'status-dibatalkan';
                                    $display_status = 'Batal';
                                } else {
                                    $badge_class = 'status-pinjam';
                                    $display_status = $status;
                                }
                            ?>
                            <span class="badge <?= $badge_class ?>"><?= $display_status ?></span>
                        </td>
                        <td>
                            <?php if ($status === 'menunggu_konfirmasi'): ?>
                            <div class="btn-group-vertical">
                                <a href="?action=confirm&id=<?= $row['id'] ?>" 
                                   class="btn-action btn-confirm" 
                                   onclick="return confirm('Konfirmasi peminjaman ini?')">
                                    Konfirmasi
                                </a>

                                <a href="?action=cancel&id=<?= $row['id'] ?>" 
                                   class="btn-action btn-cancel" 
                                   onclick="return confirm('Batalkan peminjaman ini?')">
                                    Batal
                                </a>
                            </div>
                            <?php else: ?>
                            <span style="color:var(--text-gray); font-size:12px; font-style:italic;">Selesai</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center; padding:50px; color:#a0aec0;">
                            Belum ada riwayat peminjaman.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>