<?php
include 'config.php';
session_start();

if (isset($_SESSION['username'])) {
    

    catat_log($koneksi, "Berhasil Logout dari Sistem", "Auth");

    $_SESSION = []; 
    session_unset();
    session_destroy();
}

header("Location: login.php?pesan=logout_berhasil");
exit;
?>