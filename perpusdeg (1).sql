-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Apr 2026 pada 07.07
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpusdeg`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `stok` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `stok`, `foto`) VALUES
(23, 'The Secret Of The Old Book', 'Godeg', 'PT.Makmur', 2000, 21, '1775786287_The secret of the old book.png'),
(24, 'The Shadow Hunter', 'Arthur', 'PT.Alim Rugi', 2001, 1, '1775786795_The shadow hunter team united.png'),
(25, 'Chrono Signal', 'Hj Dendi', 'PT.Ayam', 2002, 10, '1775786945_Chrono Signal_ Time-travel team in action.png'),
(26, 'The Crimson Engine', 'ukad resing', 'PT.Alim Rugi', 2020, 1, '1775787227_The crimson engine riders.png'),
(27, 'Strike to the top', 'hafiedz', 'PT.bobon', 2004, 21, '1775787582_Strike to the Top cover art.png'),
(28, 'After scholl melody', 'aceng', 'PT.Jaya', 2025, 18, '1775787833_After school band jam session (1).png'),
(29, 'Chasing Your Smile', 'apid bhizer', 'PT.Jaya', 2025, 18, '1775790556_Chasing your smile at sunset.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `nama_pelaku` varchar(100) DEFAULT NULL,
  `aktivitas` varchar(255) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id`, `nama_pelaku`, `aktivitas`, `kategori`, `waktu`) VALUES
(1, 'Sistem/Guest', 'Menambahkan buku baru: qedsa', 'Buku', '2026-04-09 07:53:55'),
(2, 'Sistem/Guest', 'Menghapus buku: 123', 'Buku', '2026-04-09 08:07:01'),
(3, 'Sistem/Guest', 'Menghapus anggota: atur', 'User', '2026-04-09 08:07:19'),
(4, 'Sistem/Guest', 'Meminjam buku: doraemon', 'Peminjaman', '2026-04-09 08:10:02'),
(5, 'Sistem/Guest', 'Meminjam buku: qedsa', 'Peminjaman', '2026-04-09 08:19:21'),
(6, 'Sistem/Guest', 'Meminjam buku: qedsa', 'Peminjaman', '2026-04-09 08:20:00'),
(7, 'Sistem/Guest', 'Meminjam buku: doraemon', 'Peminjaman', '2026-04-09 08:20:23'),
(8, 'Sistem/Guest', 'Meminjam buku: doraemon', 'Peminjaman', '2026-04-09 08:20:33'),
(9, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-09 08:22:50'),
(10, 'rafli', 'Mengubah data anggota: acil', 'User', '2026-04-09 08:33:55'),
(11, 'rafli', 'Mengubah data anggota: acil', 'User', '2026-04-09 08:34:09'),
(12, 'rafli', 'Menghapus anggota: acil', 'User', '2026-04-09 08:37:55'),
(13, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 00:45:23'),
(14, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 00:46:17'),
(15, 'godeg', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 00:46:43'),
(16, 'godeg', 'Meminjam buku: doraemon', 'Peminjaman', '2026-04-10 01:00:47'),
(17, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 01:00:53'),
(18, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 01:00:55'),
(19, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 01:04:00'),
(20, 'godeg', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 01:04:06'),
(21, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 01:04:58'),
(22, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 01:05:00'),
(23, 'rafli', 'Menghapus buku: qedsa', 'Buku', '2026-04-10 01:08:58'),
(24, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 01:44:07'),
(25, 'godeg', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 01:44:23'),
(26, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 01:44:31'),
(27, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 01:44:32'),
(28, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 01:44:59'),
(29, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 01:45:53'),
(30, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 01:46:00'),
(31, 'godeg', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 01:46:04'),
(32, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 01:49:44'),
(33, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 01:49:49'),
(34, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 01:50:18'),
(35, 'godeg', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 01:50:29'),
(36, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 01:56:50'),
(37, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 01:56:52'),
(38, 'rafli', 'Menambahkan buku baru: The Secret Of The Old Book', 'Buku', '2026-04-10 01:58:07'),
(39, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 02:00:35'),
(40, 'godeg', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 02:00:43'),
(41, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 02:01:21'),
(42, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 02:01:22'),
(43, 'rafli', 'Menghapus buku: doraemon', 'Buku', '2026-04-10 02:01:29'),
(44, 'rafli', 'Menambahkan buku baru: The Shadow Hunter', 'Buku', '2026-04-10 02:06:35'),
(45, 'rafli', 'Menambahkan buku baru: Chrono Signal', 'Buku', '2026-04-10 02:09:05'),
(46, 'rafli', 'Menambahkan buku baru: The Crimson Engine', 'Buku', '2026-04-10 02:13:47'),
(47, 'rafli', 'Menambahkan buku baru: Strike to the top', 'Buku', '2026-04-10 02:19:42'),
(48, 'rafli', 'Menambahkan buku baru: After scholl melody', 'Buku', '2026-04-10 02:23:53'),
(49, 'rafli', 'Menambahkan buku baru: Chasing Your Smile', 'Buku', '2026-04-10 03:09:16'),
(50, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 03:09:42'),
(51, 'godeg', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 03:09:46'),
(52, 'godeg', 'Meminjam buku: Chasing Your Smile', 'Peminjaman', '2026-04-10 03:09:58'),
(53, 'godeg', 'Meminjam buku: Strike to the top', 'Peminjaman', '2026-04-10 03:10:13'),
(54, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 03:10:21'),
(55, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 03:10:23'),
(56, 'rafli', 'Menghapus anggota: rafli', 'User', '2026-04-10 03:21:12'),
(57, 'rafli', 'Menghapus anggota: dendi', 'User', '2026-04-10 03:23:16'),
(58, 'rafli', 'Menambahkan anggota baru: dendi (Role: user)', NULL, '2026-04-10 03:23:29'),
(59, 'rafli', 'Mengubah data anggota: artur', 'User', '2026-04-10 03:23:58'),
(60, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 03:25:39'),
(61, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 03:27:44'),
(62, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 03:27:46'),
(63, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 03:49:04'),
(64, 'rafli', 'Mengubah data buku: After scholl melody', 'Buku', '2026-04-10 03:49:51'),
(65, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 03:52:58'),
(66, 'godeg', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 03:53:04'),
(67, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 03:53:16'),
(68, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 03:53:21'),
(69, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 04:01:02'),
(70, 'godeg', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 04:01:08'),
(71, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 04:01:17'),
(72, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 04:01:22'),
(73, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 04:07:09'),
(74, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 04:10:51'),
(75, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 04:10:56'),
(76, 'atur', 'Mengubah data buku: After scholl melody', 'Buku', '2026-04-10 07:41:09'),
(77, 'atur', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 07:46:47'),
(78, 'godeg', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 07:47:05'),
(79, 'godeg', 'Meminjam buku: Chasing Your Smile', 'Peminjaman', '2026-04-10 07:47:15'),
(80, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 07:47:58'),
(81, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 07:48:25'),
(82, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 07:49:37'),
(83, 'godeg', 'Berhasil Login ke Sistem', 'Auth', '2026-04-10 07:49:55'),
(84, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 07:51:57'),
(85, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 07:52:55'),
(86, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 08:11:50'),
(87, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 08:14:13'),
(88, 'godeg', 'Meminjam buku: Chasing Your Smile', 'Peminjaman', '2026-04-10 08:14:29'),
(89, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 08:14:43'),
(90, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 08:15:15'),
(91, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 08:19:13'),
(92, 'godeg', 'Meminjam buku: After scholl melody', 'Peminjaman', '2026-04-10 08:19:32'),
(93, 'godeg', 'Meminjam buku: Chrono Signal', 'Peminjaman', '2026-04-10 08:19:40'),
(94, 'godeg', 'Meminjam buku: Strike to the top', 'Peminjaman', '2026-04-10 08:19:45'),
(95, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 08:19:49'),
(96, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 08:21:11'),
(97, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 08:22:05'),
(98, '', 'Mengembalikan buku: Chrono Signal', NULL, '2026-04-10 08:22:24'),
(99, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 08:22:30'),
(100, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 10:50:31'),
(101, '', 'Mengembalikan buku: After scholl melody', NULL, '2026-04-10 10:51:05'),
(102, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 10:51:09'),
(103, 'rivalll', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 10:53:40'),
(104, 'godeg', 'Meminjam buku: Chasing Your Smile', 'Peminjaman', '2026-04-10 10:54:01'),
(105, 'godeg', 'Mengembalikan buku: Chasing Your Smile', NULL, '2026-04-10 10:54:59'),
(106, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 12:25:49'),
(107, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 16:35:28'),
(108, 'godeg', 'Meminjam buku: The Crimson Engine', 'Peminjaman', '2026-04-10 16:35:56'),
(109, 'rafli', 'Admin rafli mengonfirmasi pengembalian buku (ID Pinjam: 33)', NULL, '2026-04-10 16:37:55'),
(110, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 16:38:28'),
(111, 'godeg', 'Meminjam buku: Chasing Your Smile', 'Peminjaman', '2026-04-10 16:39:40'),
(112, 'godeg', 'Mengembalikan buku: Chasing Your Smile', NULL, '2026-04-10 16:41:06'),
(113, 'godeg', 'Meminjam buku: After scholl melody', 'Peminjaman', '2026-04-10 16:41:36'),
(114, 'godeg', 'Meminjam buku: Strike to the top', 'Peminjaman', '2026-04-10 16:41:41'),
(115, 'godeg', 'Meminjam buku: The Shadow Hunter', 'Peminjaman', '2026-04-10 16:41:48'),
(116, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-10 16:41:56'),
(117, 'rafli', 'Admin rafli membatalkan peminjaman buku (ID Pinjam: 35)', NULL, '2026-04-10 16:42:32'),
(118, 'godeg', 'Mengembalikan buku: The Shadow Hunter', NULL, '2026-04-10 16:50:15'),
(119, 'godeg', 'Meminjam buku: The Secret Of The Old Book', 'Peminjaman', '2026-04-10 16:50:32'),
(120, 'rafli', 'Admin rafli mengonfirmasi peminjaman buku (ID Pinjam: 38)', NULL, '2026-04-10 16:51:01'),
(121, 'rafli', 'Mengubah data buku: The Crimson Engine', NULL, '2026-04-10 19:46:30'),
(122, 'godeg', 'Meminjam buku: After scholl melody', 'Peminjaman', '2026-04-11 01:00:36'),
(123, 'godeg', 'Meminjam buku: Strike to the top', 'Peminjaman', '2026-04-11 01:00:42'),
(124, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-11 01:00:52'),
(125, 'rafli', 'Admin rafli mengonfirmasi peminjaman buku (ID Pinjam: 40)', NULL, '2026-04-11 01:01:19'),
(126, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-11 01:01:29'),
(127, 'godeg', 'Mengembalikan buku: Strike to the top', NULL, '2026-04-11 01:02:03'),
(128, 'godeg', 'Mengembalikan buku: The Secret Of The Old Book', NULL, '2026-04-11 01:02:38'),
(129, 'godeg', 'Mengembalikan buku: Strike to the top', NULL, '2026-04-11 01:02:52'),
(130, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-11 01:02:59'),
(131, 'rafli', 'Admin rafli mengonfirmasi peminjaman buku (ID Pinjam: 39)', NULL, '2026-04-11 01:03:33'),
(132, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-11 01:09:14'),
(133, 'godeg', 'Meminjam buku: Chasing Your Smile', 'Peminjaman', '2026-04-11 01:09:31'),
(134, 'godeg', 'Meminjam buku: Chrono Signal', 'Peminjaman', '2026-04-11 01:09:37'),
(135, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-11 01:09:48'),
(136, 'rafli', 'Admin rafli mengonfirmasi peminjaman buku (ID Pinjam: 42)', NULL, '2026-04-11 01:13:41'),
(137, 'rafli', 'Admin rafli mengonfirmasi peminjaman buku (ID Pinjam: 41)', NULL, '2026-04-11 01:13:46'),
(138, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-11 01:17:38'),
(139, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-11 01:37:01'),
(140, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-11 17:20:48'),
(141, 'godeg', 'Meminjam buku: Chasing Your Smile', 'Peminjaman', '2026-04-11 17:21:27'),
(142, 'godeg', 'Meminjam buku: After scholl melody', 'Peminjaman', '2026-04-11 17:21:37'),
(143, 'godeg', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-11 17:21:57'),
(144, 'rafli', 'Admin rafli mengonfirmasi peminjaman buku (ID Pinjam: 43)', NULL, '2026-04-11 17:22:37'),
(145, 'rafli', 'Mengubah data buku: Chasing Your Smile', NULL, '2026-04-13 17:29:59'),
(146, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-13 17:35:42'),
(147, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-13 17:37:47'),
(148, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-13 17:45:46'),
(149, 'rafli', 'Mengubah data anggota: user (Role: user)', NULL, '2026-04-13 17:46:17'),
(150, 'rafli', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-13 17:46:41'),
(151, 'user', 'Berhasil Login ke Sistem', 'Auth', '2026-04-13 17:46:52'),
(152, 'user', 'Meminjam buku: Chasing Your Smile', 'Peminjaman', '2026-04-13 17:47:18'),
(153, 'user', 'Berhasil Logout dari Sistem', 'Auth', '2026-04-13 17:47:25'),
(154, 'rafli', 'Berhasil Login ke Sistem', 'Auth', '2026-04-13 17:47:40'),
(155, 'rafli', 'Admin rafli membatalkan peminjaman buku (ID Pinjam: 44)', NULL, '2026-04-13 17:47:47'),
(156, 'rafli', 'Admin rafli mengonfirmasi peminjaman buku (ID Pinjam: 45)', NULL, '2026-04-13 17:47:54'),
(157, 'user', 'Berhasil Login ke Sistem', 'Auth', '2026-04-13 17:50:39'),
(158, 'user', 'Mengembalikan buku: Chasing Your Smile', NULL, '2026-04-13 17:50:52'),
(159, 'user', 'Meminjam buku: Chrono Signal', 'Peminjaman', '2026-04-13 18:05:23'),
(160, 'rafli', 'Admin rafli membatalkan peminjaman buku (ID Pinjam: 46)', NULL, '2026-04-13 18:05:54'),
(161, 'user', 'Meminjam buku: Chasing Your Smile', 'Peminjaman', '2026-04-13 18:11:04'),
(162, 'rafli', 'Admin rafli membatalkan peminjaman buku (ID Pinjam: 47)', NULL, '2026-04-13 18:11:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `nama_peminjam` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` varchar(20) DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_buku`, `nama_peminjam`, `jumlah`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(46, 25, 'user', 1, '2026-04-13', '0000-00-00', 'dibatalkan'),
(47, 29, 'user', 1, '2026-04-13', '0000-00-00', 'dibatalkan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(41, 'rafli', '202cb962ac59075b964b07152d234b70', 'admin'),
(42, 'user', '202cb962ac59075b964b07152d234b70', 'user'),
(45, 'artur', '$2y$10$t5I7Ex781BfAZNMh5soE1umuXBhtKV683HZ3CFDgnocUs4thLfq06', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
