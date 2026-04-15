<?php
include '../config.php';
include '../auth.php';

if($_SESSION['role'] != 'admin'){
    die("Akses dilarang!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul     = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($koneksi, $_POST['pengarang']);
    $penerbit  = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tahun     = $_POST['tahun_terbit'];
    $stok      = $_POST['stok'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $nama_file = $_FILES['foto']['name'];
        $tmp       = $_FILES['foto']['tmp_name'];
        
        $nama_baru = time() . '_' . $nama_file;
        $path      = "../upload/" . $nama_baru;

        if (move_uploaded_file($tmp, $path)) {
            
            $sql = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, stok, foto) 
                    VALUES ('$judul', '$pengarang', '$penerbit', '$tahun', '$stok', '$nama_baru')";
            
            if (mysqli_query($koneksi, $sql)) {
                
                catat_log($koneksi, "Menambah buku baru: $judul", "Buku");

                header("Location: data_buku.php?status=sukses");
                exit;
            } else {
                echo "Gagal menyimpan data ke database: " . mysqli_error($koneksi);
            }
        } else {
            echo "Gagal mengunggah foto ke folder tujuan.";
        }
    } else {
        echo "Harap pilih foto buku terlebih dahulu.";
    }
} else {
    header("Location: tambah_buku.php");
    exit;
}
?>