<?php
include '../config.php';
include '../auth.php';

if (!isset($_SESSION['login'])) {
    die("Akses ditolak");
}
logAktivitas($koneksi, $_SESSION['user'], "Menghapus buku ID: $id");

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan");
}

$id = intval($_GET['id']);

$cek = mysqli_query($koneksi, "
    SELECT * FROM peminjaman 
    WHERE id_buku = $id 
    AND (status = 'menunggu_konfirmasi' OR status = 'Dipinjam')
");

if (mysqli_num_rows($cek) > 0) {
    die("Buku tidak bisa dihapus karena sedang dipinjam atau menunggu konfirmasi!");
}

mysqli_query($koneksi, "DELETE FROM buku WHERE id=$id");

header("Location: data_buku.php");
exit;
?>