<?php 
include '../config.php';
include '../auth.php';

if($_SESSION['role'] != 'admin'){
    die("Akses dilarang!");
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    $cek_buku = mysqli_query($koneksi, "SELECT judul, foto FROM buku WHERE id='$id'");
    $data_buku = mysqli_fetch_assoc($cek_buku);

    if ($data_buku) {
        $judul_buku = $data_buku['judul'];
        $foto_buku  = $data_buku['foto'];

        if (!empty($foto_buku) && file_exists("../upload/" . $foto_buku)) {
            unlink("../upload/" . $foto_buku);
        }

        $query_hapus = mysqli_query($koneksi, "DELETE FROM buku WHERE id='$id'");

        if ($query_hapus) {
            catat_log($koneksi, "Menghapus buku: $judul_buku", "Buku");
            
            header("Location: data_buku.php?pesan=hapus_berhasil");
            exit;
        } else {
            echo "Gagal menghapus data: " . mysqli_error($koneksi);
        }
    } else {
        header("Location: data_buku.php?pesan=data_tidak_ada");
        exit;
    }
} else {
    header("Location: data_buku.php");
    exit;
}
?>