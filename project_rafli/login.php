<?php
session_start(); 
include 'config.php';

if (isset($_POST['login'])) {
    $u = mysqli_real_escape_string($koneksi, $_POST['username']);
    $p = md5($_POST['password']);

    $q = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$u' AND password='$p'");

    if (!$q) {
        die("Query error: " . mysqli_error($koneksi));
    }

    $d = mysqli_fetch_assoc($q);

    if ($d) {
        // 1. Set Session
        $_SESSION['login']    = true;
        $_SESSION['id']       = $d['id'];
        $_SESSION['username'] = $d['username'];
        $_SESSION['role']     = $d['role'];

        // 2. Log Aktivitas (Disesuaikan dengan struktur tabel log_aktivitas)
        $nama_pelaku = $d['username'];
        $aktivitas = "Berhasil Login ke Sistem";
        $kategori = "Auth";
        
        // Perbaikan Query: Menggunakan nama kolom yang ada di perpusdeg.sql
        mysqli_query($koneksi, "INSERT INTO log_aktivitas (nama_pelaku, aktivitas, kategori) 
                                VALUES ('$nama_pelaku', '$aktivitas', '$kategori')");

        // 3. Redirect
        if ($d['role'] === 'admin') {
            header("Location: admin/dashboard_admin.php");
        } else {
            header("Location: member/dashboard_member.php");
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Perpustakaan - Clean Dark</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
            font-family: 'Inter', sans-serif; 
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #000000;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 400px;
            padding: 50px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(255, 255, 255, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: scale(0.95); 
            }
            to { 
                opacity: 1; 
                transform: scale(1); 
            }
        }

        .login-card h2 {
            color: #000000;
            font-weight: 700;
            font-size: 24px;
            text-align: center;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        .login-card p.subtitle {
            color: #666666;
            text-align: center;
            font-size: 14px;
            margin-bottom: 40px;
        }

        .form-label {
            display: block;
            color: #000000;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .input-group {
            margin-bottom: 25px;
        }

        .login-card input {
            width: 100%;
            padding: 12px 0; 
            background: transparent;
            border: none;
            border-bottom: 2px solid #eeeeee;
            color: #000000;
            font-size: 15px;
            outline: none;
            transition: all 0.3s ease;
        }

        .login-card input:focus {
            border-bottom-color: #000000;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: #000000;
            color: #ffffff;
            border: 1px solid #000000;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
            text-transform: uppercase;
        }

        .btn-login:hover {
            background: #333333;
            transform: translateY(-2px);
        }

        .error-box {
            background: #fff0f0;
            color: #d00000;
            padding: 12px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #ffdada;
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #888888;
        }

        .footer-text a {
            color: #000000;
            text-decoration: none;
            font-weight: 700;
            border-bottom: 1px solid #000000;
        }

        .footer-text a:hover {
            color: #444444;
            border-bottom-color: #444444;
        }
    </style>
</head>
<body>

<div class="login-card">
    <form method="post">
        <h2>Login</h2>
        <p class="subtitle">Perpustakaan</p>

        <?php if (isset($error)): ?>
            <div class="error-box">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <div class="input-group">
            <label class="form-label">Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
        </div>

        <div class="input-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>
        
        <button type="submit" name="login" class="btn-login">MASUK</button>
        
        <div class="footer-text">
            Belum punya akun? <a href="register.php">Daftar sekarang</a>
        </div>
    </form>
</div>

</body>
</html>