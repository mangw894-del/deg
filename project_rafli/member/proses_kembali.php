<?php
include '../config.php';
session_start();

if (!isset($_SESSION['login'])) {
    header("location:../login.php");
    exit;
}

$id_pinjam = mysqli_real_escape_string($koneksi, $_GET['id']);
$id_buku   = mysqli_real_escape_string($koneksi, $_GET['id_buku']);

$cekBuku = mysqli_query($koneksi, "SELECT judul FROM buku WHERE id = '$id_buku'");
$dataBuku = mysqli_fetch_assoc($cekBuku);
$judulBuku = $dataBuku['judul'];

$updateStatus = mysqli_query($koneksi, "UPDATE peminjaman SET status = 'Dikembalikan' WHERE id = '$id_pinjam'");

if ($updateStatus) {
    mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1 WHERE id = '$id_buku'");

    $nama_user = $_SESSION['username']; 
    $pesan_log = "Mengembalikan buku: " . $judulBuku;
    
    mysqli_query($koneksi, "INSERT INTO log_aktivitas (nama_pelaku, aktivitas, waktu) 
                 VALUES ('$nama_user', '$pesan_log', NOW())");

    echo "<script>
            alert('Buku berhasil dikembalikan!');
            window.location='riwayat_member.php';
          </script>";
}
?>