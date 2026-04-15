<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaandeg | Digital Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4e73df;
            --primary-dark: #3a56af;
            --dark-navy: #1a1c2e;
            --light-bg: #f8fafc;
            --text-gray: #718096;
            --white: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; scroll-behavior: smooth; }

        body {
            background: var(--white);
            color: var(--dark-navy);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* NAVBAR */
        nav {
            background: rgba(26, 28, 46, 0.98);
            backdrop-filter: blur(10px);
            padding: 18px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        nav h1 { color: #fff; font-size: 22px; font-weight: 700; letter-spacing: 1px; }
        nav h1 span { color: var(--primary); }

        nav .nav-links { display: flex; align-items: center; }
        nav .nav-links a {
            color: #cbd5e0;
            text-decoration: none;
            margin-left: 25px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.3s;
        }

        nav .nav-links a:hover { color: #fff; }

        .btn-reg {
            background: var(--primary);
            padding: 8px 20px;
            border-radius: 8px;
            color: white !important;
        }

        /* HERO SECTION */
        .hero {
            background: var(--light-bg);
            padding: 180px 8% 100px 8%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .hero-text h2 {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero-text h2 span { color: var(--primary); }

        .hero-text p {
            font-size: 17px;
            color: var(--text-gray);
            margin-bottom: 35px;
        }

        .btn-group { display: flex; gap: 15px; }

        .btn {
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-dark { background: var(--dark-navy); color: white; box-shadow: 0 10px 20px rgba(26,28,46,0.2); }
        .btn-dark:hover { transform: translateY(-3px); background: var(--primary); }

        .btn-outline { border: 2px solid var(--dark-navy); color: var(--dark-navy); }
        .btn-outline:hover { background: var(--dark-navy); color: white; }

        .hero-image img {
            width: 100%;
            max-width: 500px;
            border-radius: 30px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        section { padding: 100px 8%; }
        .section-title { text-align: center; margin-bottom: 60px; }
        .section-title h3 { font-size: 32px; margin-bottom: 10px; }
        .section-title div { width: 50px; height: 4px; background: var(--primary); margin: 0 auto; border-radius: 2px; }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            border: 1px solid #edf2f7;
            transition: 0.3s;
            text-align: center;
        }

        .card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.05); border-color: var(--primary); }
        .card .icon { font-size: 40px; margin-bottom: 20px; display: block; }

        /* CONTACT SECTION */
        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 50px;
            background: var(--light-bg);
            padding: 50px;
            border-radius: 30px;
        }

        .contact-info h4 { font-size: 24px; margin-bottom: 20px; }
        .contact-item { display: flex; align-items: center; margin-bottom: 20px; }
        .contact-item span { margin-right: 15px; font-size: 20px; color: var(--primary); }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            outline: none;
        }

        /* FOOTER */
        footer {
            background: var(--dark-navy);
            padding: 80px 8% 40px 8%;
            color: #a0aec0;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 50px;
            margin-bottom: 50px;
        }

        .footer-box h2 { color: white; margin-bottom: 20px; }
        .footer-box h4 { color: white; margin-bottom: 20px; }
        .footer-box ul { list-style: none; }
        .footer-box ul li { margin-bottom: 12px; }
        .footer-box ul li a { color: #a0aec0; text-decoration: none; transition: 0.3s; }
        .footer-box ul li a:hover { color: white; padding-left: 5px; }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 14px;
        }

        @media (max-width: 992px) {
            .hero { grid-template-columns: 1fr; text-align: center; }
            .hero-image { display: flex; justify-content: center; }
            .btn-group { justify-content: center; }
            .contact-container { grid-template-columns: 1fr; }
            .footer-content { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

<nav>
    <h1>PERPUS<span>DEG</span></h1>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="#features">Fitur</a>
        <?php if(isset($_SESSION['login'])): ?>
            <a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin/dashboard_admin.php' : 'member/dashboard_member.php'; ?>">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php" class="btn-reg">Register</a>
        <?php endif; ?>
    </div>
</nav>

<section class="hero" id="home">
    <div class="hero-text">
        <p style="color: var(--primary); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 13px;">Digital Learning Hub</p>
        <h2>Perpustakaan Digital: Akses Ilmu <span>Tanpa Batas</span></h2>
        <p>Platform modern untuk mempermudah siswa dan guru dalam menjelajahi ribuan koleksi buku secara digital, cepat, dan terorganisir.</p>
        
        <div class="btn-group">
            <a href="register.php" class="btn btn-dark">Mulai Membaca</a>
            <a href="#features" class="btn btn-outline">Pelajari Layanan</a>
        </div>
    </div>

    <div class="hero-image">
        <img src="upload/poto1.jpg" alt="Library Illustration">
    </div>
</section>

<section class="features" id="features">
    <div class="section-title">
        <p style="color: var(--primary); font-weight: 600;">Layanan Kami</p>
        <h3>Fitur Utama PerpusDeg</h3>
        <div></div>
    </div>
        <div class="card">
            <span class="icon"></span>
            <h4>Pinjam Kilat</h4>
            <p>Sistem peminjaman otomatis tanpa antre, cukup sekali klik dari perangkat Anda.</p>
        </div>
        <div class="card">
            <span class="icon"></span>
            <h4>Riwayat Terdata</h4>
            <p>Pantau semua buku yang pernah dipinjam dengan sistem manajemen yang rapi.</p>
        </div>
        <div class="card">
            <span class="icon"></span>
            <h4>Keamanan Data</h4>
            <p>Enkripsi data pengguna yang menjamin privasi aktivitas membaca Anda aman.</p>
        </div>
    </div>
</section>
<footer>
    <div class="footer-content">
        <div class="footer-box">
            <h2>PERPUS<span>DEG</span></h2>
            <p>Memberdayakan literasi digital untuk menciptakan generasi cerdas yang siap menghadapi masa depan melalui akses informasi yang mudah dan kredibel.</p>
        </div>
        
        <div class="footer-box">
            <h4>Navigasi</h4>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Fitur Utama</a></li>
                <li><a href="login.php">Masuk Akun</a></li>
            </ul>
        </div>

        <div class="footer-box">
            <h4>Bantuan</h4>
            <ul>
                <li><a href="#">Cara Meminjam</a></li>
                <li><a href="#">Ketentuan Layanan</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
            </ul>
        </div>
    </div>

    <div class="copyright">
        <p>© <?php echo date('Y'); ?> Perpustakaandeg Team</p>
    </div>
</footer>

</body>
</html>