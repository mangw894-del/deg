<?php 
include '../config.php';
include '../auth.php';

if($_SESSION['role'] != 'admin'){
    die("Akses dilarang!");
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    $ambil_user = mysqli_query($koneksi, "SELECT username FROM users WHERE id='$id'");
    $data_user = mysqli_fetch_assoc($ambil_user);
    $nama_dihapus = $data_user['username'];

    $query_hapus = mysqli_query($koneksi, "DELETE FROM users WHERE id='$id'");

    if ($query_hapus) {
        catat_log($koneksi, "Menghapus anggota: $nama_dihapus", "User");

        header("location:data_anggota.php?pesan=hapus_berhasil");
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    header("location:data_anggota.php");
    exit;
}
?>