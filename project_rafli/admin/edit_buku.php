<?php
include '../config.php';
include '../auth.php';

if($_SESSION['role'] != 'admin'){
    header("location:../login.php");
    exit;
}

if (isset($_POST['update'])) {
    $id        = $_POST['id'];
    $judul     = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($koneksi, $_POST['pengarang']);
    $penerbit  = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tahun     = $_POST['tahun_terbit'];
    $stok      = $_POST['stok'];
    $foto_lama = $_POST['foto_lama'];

    if ($_FILES['foto']['name'] != "") {
        $nama_file = $_FILES['foto']['name'];
        $tmp       = $_FILES['foto']['tmp_name'];
        $nama_baru = time() . '_' . $nama_file;
        
        if (move_uploaded_file($tmp, "../upload/" . $nama_baru)) {
            if (file_exists("../upload/" . $foto_lama)) {
                unlink("../upload/" . $foto_lama);
            }
            $foto_final = $nama_baru;
        }
    } else {
        $foto_final = $foto_lama;
    }

    $sql = "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun', stok='$stok', foto='$foto_final' WHERE id='$id'";

    if (mysqli_query($koneksi, $sql)) {
        $pelaku = $_SESSION['username'];
        $aktivitas = "Mengubah data buku: $judul";
        mysqli_query($koneksi, "INSERT INTO log_aktivitas (nama_pelaku, aktivitas, waktu) VALUES ('$pelaku', '$aktivitas', NOW())");
        
        echo "<script>alert('Data Berhasil Diupdate!'); window.location='data_buku.php';</script>";
        exit;
    }
}

if(!isset($_GET['id'])) { header("location:data_buku.php"); exit; }
$id_ambil = mysqli_real_escape_string($koneksi, $_GET['id']);
$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id_ambil'");
$row = mysqli_fetch_assoc($data);
if(!$row) { die("Data buku tidak ditemukan!"); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* STYLE DISAMAKAN DENGAN HALAMAN EDIT ANGGOTA */
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }

        body {
            min-height: 100vh;
            background: #f4f7fe;
        }

        .wrapper { display: flex; min-height: 100vh; }


        .sidebar {
            width: 270px;
            background: #1a1c2e;
            color: #a0aec0;
            padding: 30px 20px;
            height: 100vh;
            position: fixed;
            left: 0; top: 0;
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

        .sidebar a:hover, .sidebar a.active {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        .sidebar .logout {
            background: rgba(231, 74, 59, 0.15); 
            color: #ff7675; 
            margin-top: 30px;
            text-align: left;
            border: 1px solid rgba(231, 74, 59, 0.2);
        }

        /* CONTENT AREA */
        .content {
            flex: 1;
            padding: 40px;
            margin-left: 270px;
            display: flex;
            justify-content: center;
        }

        .container {
            background: white;
            padding: 35px;
            border-radius: 20px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border: 1px solid #edf2f7;
            height: fit-content;
        }

        h2 {
            margin-bottom: 25px;
            color: #2d3748;
            font-weight: 700;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
            font-size: 13px;
            font-weight: 600;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            margin-top: 8px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            outline: none;
            transition: 0.3s;
            background: #f8fafc;
            font-size: 14px;
        }

        input:focus {
            border-color: #4e73df;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
        }

        .img-preview {
            margin-top: 10px;
            border-radius: 10px;
            border: 2px solid #edf2f7;
            padding: 5px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        button {
            flex: 2;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(78, 115, 223, 0.3);
        }

        .btn-batal {
            flex: 1;
            padding: 14px;
            background: #f1f5f9;
            color: #64748b;
            text-align: center;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-batal:hover { background: #e2e8f0; }

        small { color: #a0aec0; font-size: 11px; }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h3>ADMIN PANEL</h3>
        <a href="dashboard_admin.php">Dashboard</a>
        <a href="data_buku.php" class="active">Data Buku</a>
        <a href="tambah_buku.php">Tambah Buku</a>
        <a href="riwayat_peminjaman.php">Riwayat Peminjaman</a>
        <a href="data_anggota.php">Data Anggota</a>
        <a href="tambah_anggota.php">Tambah Anggota</a>
        <a href="laporan_aktivitas.php">Laporan Aktivitas</a>
        <a href="../logout.php" class="logout">Logout</a>
    </div>

    <div class="content">
        <div class="container">
            <h2>Edit Data Buku</h2>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                <input type="hidden" name="foto_lama" value="<?= $row['foto']; ?>">

                <label>Judul Buku</label>
                <input type="text" name="judul" value="<?= htmlspecialchars($row['judul']); ?>" required>

                <label>Pengarang</label>
                <input type="text" name="pengarang" value="<?= htmlspecialchars($row['pengarang']); ?>" required>

                <label>Penerbit</label>
                <input type="text" name="penerbit" value="<?= htmlspecialchars($row['penerbit']); ?>" required>

                <div style="display:flex; gap:15px;">
                    <div style="flex:1;">
                        <label>Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" value="<?= $row['tahun_terbit']; ?>" required>
                    </div>
                    <div style="flex:1;">
                        <label>Stok</label>
                        <input type="number" name="stok" value="<?= $row['stok']; ?>" required>
                    </div>
                </div>

                <label>Foto Saat Ini</label>
                <img src="../upload/<?= $row['foto']; ?>" width="120" class="img-preview">

                <label>Ganti Cover Buku</label>
                <input type="file" name="foto">
                <small>*Kosongkan jika tidak ingin mengubah gambar</small>

                <div class="btn-group">
                    <button type="submit" name="update">Simpan Perubahan</button>
                    <a href="data_buku.php" class="btn-batal">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>