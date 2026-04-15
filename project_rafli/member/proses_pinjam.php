<?php
include '../config.php';
// Pastikan auth check ada, atau pakai session_start yang sudah ada di config
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    header("location:../login.php");
    exit;
}

$id_buku = mysqli_real_escape_string($koneksi, $_GET['id']);
$user    = $_SESSION['username']; // Sesuaikan dengan key session login abang
$tgl     = date('Y-m-d'); 
$status  = "menunggu_konfirmasi";  // Status awal: menunggu konfirmasi admin

$cekStok = mysqli_query($koneksi, "SELECT stok, judul FROM buku WHERE id = '$id_buku'");
$dataBuku = mysqli_fetch_assoc($cekStok);

if (!$dataBuku) {
    echo "<script>alert('Buku tidak ditemukan!'); window.location='dashboard_member.php';</script>";
    exit;
}

$stokSekarang = $dataBuku['stok'];
$judulBuku    = $dataBuku['judul'];

if ($stokSekarang > 0) {
    $updateStok = mysqli_query($koneksi, "UPDATE buku SET stok = stok - 1 WHERE id = '$id_buku'");

    if ($updateStok) {
        $insertPinjam = mysqli_query($koneksi, "INSERT INTO peminjaman (id_buku, nama_peminjam, tanggal_pinjam, status) 
                                               VALUES ('$id_buku', '$user', '$tgl', '$status')");
        
        if ($insertPinjam) {
            // 4. CATAT LOG AKTIVITAS (Member meminjam buku)
            catat_log($koneksi, "Meminjam buku: $judulBuku", "Peminjaman");

            echo "<script>
                    alert('Berhasil meminjam buku $judulBuku!');
                    window.location='dashboard_member.php';
                  </script>";
        } else {
            echo "Gagal memproses peminjaman: " . mysqli_error($koneksi);
        }
    }
} else {
    echo "<script>
            alert('Waduh, stok buku $judulBuku sudah habis bos!');
            window.location='dashboard_member.php';
          </script>";
}
?>