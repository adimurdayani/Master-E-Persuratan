-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2022 at 12:39 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_persuratan`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'darat', 'Bidang Darat'),
(3, 'laut', 'Bidang Laut'),
(4, 'umum', 'Bidang Umum'),
(5, 'rekayasa', 'Bidang Rekayasa'),
(6, 'pimpinan', 'Kepala Dinas');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` bigint(10) UNSIGNED NOT NULL,
  `id_menu_groups` bigint(10) UNSIGNED NOT NULL,
  `serial_number` int(10) UNSIGNED NOT NULL,
  `menu_title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `folder` varchar(128) NOT NULL,
  `dropdown_active` tinyint(1) UNSIGNED NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL DEFAULT 1,
  `active` tinyint(1) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `id_menu_groups`, `serial_number`, `menu_title`, `url`, `icon`, `folder`, `dropdown_active`, `user_id`, `active`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 'Menu Settings', 'menu', 'fe-menu', 'menu', 0, 1, 1, '0000-00-00 00:00:00', '2022-11-13 22:06:11'),
(7, 4, 1, 'Sesuaikan web', 'konfigurasi', 'fe-globe', '', 0, 1, 1, '2022-11-11 16:00:00', '2022-11-13 22:06:11'),
(8, 4, 2, 'Akun Pengguna', 'users', 'fe-users', '', 0, 1, 1, '2022-11-11 16:00:00', '2022-11-13 22:06:11'),
(9, 4, 3, 'Log Pengguna', 'log_user', 'fe-git-pull-request', '', 0, 1, 1, '2022-11-11 16:00:00', '2022-11-13 22:06:11'),
(11, 2, 1, 'Referensi Surat', 'master', 'fe-git-pull-request', 'basemap', 1, 1, 1, '2022-11-11 16:00:00', '2022-11-13 22:06:11'),
(12, 1, 1, 'Dashboard', 'dashboard', 'fe-airplay', 'bangunan_name', 0, 1, 1, '2022-11-10 16:00:00', '2022-11-13 22:06:11'),
(15, 2, 2, 'Surat Masuk', 'surat_masuk', 'mdi mdi-email-receive-outline', '', 0, 1, 1, '2022-11-11 16:00:00', '2022-11-13 22:06:11'),
(16, 2, 4, 'Surat Keluar', 'surat_keluar', 'mdi mdi-email-send-outline', '', 0, 1, 1, '2022-11-11 16:00:00', '2022-11-13 22:06:11'),
(17, 6, 1, 'Rekap Surat Masuk', 'rekap_surat_masuk', 'fe-calendar', '', 0, 1, 1, '2022-11-11 16:00:00', '2022-11-13 22:06:11'),
(18, 6, 2, 'Rekap Surat Keluar', 'rekap_surat_keluar', 'fe-calendar', '', 0, 1, 1, '2022-11-11 16:00:00', '2022-11-13 22:06:11'),
(19, 5, 1, 'Dashboard', 'dashboard_surat', 'mdi mdi-monitor-dashboard', '', 0, 1, 1, '2022-11-11 16:00:00', '2022-11-13 22:06:11'),
(21, 2, 3, 'Disposisi Surat', 'disposisi', 'fe-list', '', 0, 1, 1, '2022-11-18 12:49:01', '2022-11-18 12:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `menu_access`
--

CREATE TABLE `menu_access` (
  `id_menu_access` int(11) NOT NULL,
  `id_groups` mediumint(8) UNSIGNED NOT NULL,
  `id_menu_groups` bigint(10) UNSIGNED NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_access`
--

INSERT INTO `menu_access` (`id_menu_access`, `id_groups`, `id_menu_groups`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2022-10-17 16:00:00', '2022-11-13 22:02:02'),
(2, 1, 2, 1, '2022-10-17 16:00:00', '2022-11-13 22:02:02'),
(3, 1, 3, 1, '2022-10-17 16:00:00', '2022-11-13 22:02:02'),
(17, 2, 2, 1, '2022-10-17 16:00:00', '2022-11-13 22:02:02'),
(18, 1, 4, 1, '2022-10-17 16:00:00', '2022-11-13 22:02:02'),
(19, 1, 5, 1, '2022-10-17 16:00:00', '2022-11-13 22:02:02'),
(20, 1, 6, 1, '2022-11-11 16:00:00', '2022-11-13 22:02:02'),
(21, 6, 5, 1, '2022-11-19 18:33:18', '2022-11-19 18:33:18'),
(22, 6, 2, 1, '2022-11-19 18:33:25', '2022-11-19 18:33:25'),
(23, 5, 5, 1, '2022-11-19 18:33:38', '2022-11-19 18:33:38'),
(24, 5, 2, 1, '2022-11-19 18:33:40', '2022-11-19 18:33:40'),
(25, 5, 6, 1, '2022-11-19 18:33:43', '2022-11-19 18:33:43'),
(27, 4, 5, 1, '2022-11-19 18:34:16', '2022-11-19 18:34:16'),
(28, 4, 2, 1, '2022-11-19 18:34:18', '2022-11-19 18:34:18'),
(29, 4, 6, 1, '2022-11-19 18:34:22', '2022-11-19 18:34:22'),
(30, 4, 4, 1, '2022-11-19 18:34:24', '2022-11-19 18:34:24'),
(31, 3, 5, 1, '2022-11-19 18:34:36', '2022-11-19 18:34:36'),
(32, 3, 2, 1, '2022-11-19 18:34:38', '2022-11-19 18:34:38'),
(33, 3, 6, 1, '2022-11-19 18:34:41', '2022-11-19 18:34:41'),
(34, 2, 5, 1, '2022-11-19 18:34:54', '2022-11-19 18:34:54'),
(35, 2, 6, 1, '2022-11-19 18:34:58', '2022-11-19 18:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `menu_groups`
--

CREATE TABLE `menu_groups` (
  `id_menu_group` bigint(10) UNSIGNED NOT NULL,
  `serial_number` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_groups`
--

INSERT INTO `menu_groups` (`id_menu_group`, `serial_number`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Navigasi', 1, '2022-11-13 16:00:00', '2022-11-13 22:00:00'),
(2, 3, 'Transaksi Surat', 1, '2022-11-13 16:00:00', '2022-11-13 22:00:00'),
(3, 6, 'Manajemen Menu', 1, '2022-11-13 16:00:00', '2022-11-13 22:00:00'),
(4, 7, 'Pengaturan', 1, '2022-11-13 16:00:00', '2022-11-13 22:00:00'),
(5, 2, 'Statistik', 1, '2022-11-13 16:00:00', '2022-11-13 22:00:00'),
(6, 4, 'Rekap Agenda', 1, '2022-11-13 16:00:00', '2022-11-13 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id_sub_menu` bigint(10) UNSIGNED NOT NULL,
  `id_menus` bigint(10) UNSIGNED NOT NULL,
  `id_menu_groups` bigint(10) UNSIGNED NOT NULL,
  `serial_number` int(10) UNSIGNED NOT NULL,
  `submenu_title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL DEFAULT 1,
  `active` tinyint(1) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id_sub_menu`, `id_menus`, `id_menu_groups`, `serial_number`, `submenu_title`, `url`, `user_id`, `active`, `created_at`, `updated_at`) VALUES
(4, 4, 2, 2, 'Data Berita', 'berita', 1, 1, '2022-10-17 16:00:00', '2022-11-13 21:57:47'),
(5, 4, 2, 1, 'Kategori Berita', 'berita/kategori', 1, 1, '2022-10-17 16:00:00', '2022-11-13 21:57:47'),
(6, 10, 2, 1, 'Data Drainase', 'drainase', 1, 1, '2022-10-19 16:00:00', '2022-11-13 21:57:47'),
(7, 10, 2, 2, 'Base Maps', 'basemap', 1, 1, '2022-10-19 16:00:00', '2022-11-13 21:57:47'),
(13, 10, 2, 3, 'Bangunan Drainase', 'bangunan_name', 1, 1, '2022-10-25 16:00:00', '2022-11-13 21:57:47'),
(14, 11, 2, 1, 'Penerima', 'penerima', 1, 1, '2022-11-10 16:00:00', '2022-11-13 21:57:47'),
(20, 14, 2, 1, 'Surat masuk', 'surat_masuk', 1, 1, '2022-11-10 16:00:00', '2022-11-13 21:57:47'),
(21, 14, 2, 2, 'Surat Keluar', 'surat_kelura', 1, 1, '2022-11-10 16:00:00', '2022-11-13 21:57:47'),
(22, 11, 2, 2, 'Bidang', 'bidang', 1, 1, '2022-11-11 16:00:00', '2022-11-13 21:57:47'),
(23, 11, 2, 3, 'Jenis Surat', 'jenis_surat', 1, 1, '2022-11-11 16:00:00', '2022-11-13 21:57:47'),
(24, 11, 2, 4, 'Klasifikasi Surat', 'klasifikasi', 1, 1, '2022-11-11 16:00:00', '2022-11-13 21:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bidang`
--

CREATE TABLE `tb_bidang` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `nama` varchar(128) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(11) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bidang`
--

INSERT INTO `tb_bidang` (`id`, `nama`, `created_at`, `user_id`) VALUES
(2, 'Pesta Wirausaha', '2022-11-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_disposisi`
--

CREATE TABLE `tb_disposisi` (
  `id_disposisi` bigint(11) UNSIGNED NOT NULL,
  `kode_surat` varchar(50) NOT NULL,
  `tujuan_disposisi` varchar(100) NOT NULL,
  `isi_disposisi` text NOT NULL,
  `sifat_disposisi` enum('Biasa','Segera','Penting','Rahasia') NOT NULL,
  `batas_waktu` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(11) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_disposisi`
--

INSERT INTO `tb_disposisi` (`id_disposisi`, `kode_surat`, `tujuan_disposisi`, `isi_disposisi`, `sifat_disposisi`, `batas_waktu`, `tgl_selesai`, `created_at`, `updated_at`, `user_id`) VALUES
(5, 'DSM-002', 'Adi Murdayani', 'Seegera di tindaklanjuti', 'Segera', '2022-11-21', '2022-11-22', '2022-11-19 03:24:43', '2022-11-19 03:24:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_surat`
--

CREATE TABLE `tb_jenis_surat` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `kode` varchar(50) NOT NULL,
  `jenis_surat` varchar(128) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(11) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jenis_surat`
--

INSERT INTO `tb_jenis_surat` (`id`, `kode`, `jenis_surat`, `created_at`, `user_id`) VALUES
(4, '001', 'Surat Pemberitahuan', '2022-11-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_klasifikasi_surat`
--

CREATE TABLE `tb_klasifikasi_surat` (
  `id_klasifikasi` int(11) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `klasifikasi` varchar(128) NOT NULL,
  `uraian` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(11) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_klasifikasi_surat`
--

INSERT INTO `tb_klasifikasi_surat` (`id_klasifikasi`, `kode`, `klasifikasi`, `uraian`, `created_at`, `user_id`) VALUES
(1, '001', 'Surat Izin', 'surat izin tidak masuk kantor', '2022-11-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_konfigurasi`
--

CREATE TABLE `tb_konfigurasi` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `nama_web` varchar(128) DEFAULT NULL,
  `instansi` varchar(128) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pimpinan` varchar(100) DEFAULT NULL,
  `nidn_pimpinan` varchar(50) DEFAULT NULL,
  `link_website` text DEFAULT NULL,
  `alamat` text NOT NULL,
  `icon_web` varchar(255) DEFAULT NULL,
  `logo_web` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_konfigurasi`
--

INSERT INTO `tb_konfigurasi` (`id`, `nama_web`, `instansi`, `phone`, `email`, `pimpinan`, `nidn_pimpinan`, `link_website`, `alamat`, `icon_web`, `logo_web`, `created_at`, `updated_at`) VALUES
(2, 'E-Persuratan', 'Dinas Perhubungan', '255', 'adimurdayani@gmail.com', 'Adi Murdayani', '125412312123', 'https://facebook.com', 'Jl. Rambutan No.20 Kel. Mungkajang, Kec. Mungkajang Kota Palopo', 'd084f061de1c97e8dd34e352d55d2cb2.png', '7338be694a9ee8d52f58e20b6f8d0f46.png', '2022-11-11 16:00:00', '2022-11-13 21:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penerima_surat`
--

CREATE TABLE `tb_penerima_surat` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `nama` varchar(128) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(11) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penerima_surat`
--

INSERT INTO `tb_penerima_surat` (`id`, `nama`, `created_at`, `user_id`) VALUES
(1, 'Adi Murdayani', '2022-11-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_keluar`
--

CREATE TABLE `tb_surat_keluar` (
  `id_skeluar` bigint(11) UNSIGNED NOT NULL,
  `no_agenda` varchar(100) NOT NULL,
  `tujuan_surat` varchar(128) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `tgl_surat` date DEFAULT NULL,
  `isi_surat` text NOT NULL,
  `jenis_surat` varchar(128) NOT NULL,
  `sifat_surat` enum('UMUM','RAHASIA') NOT NULL,
  `kode_klasifikasi` varchar(128) NOT NULL,
  `pembuat_surat` varchar(128) NOT NULL,
  `bidang` varchar(128) NOT NULL,
  `file_surat` text NOT NULL,
  `link_file` text NOT NULL,
  `keterangan` enum('Sudah Ter-Arsip','Belum Ter-Arsip') NOT NULL,
  `tahun` year(4) DEFAULT current_timestamp(),
  `catatan_kelengkapan` text NOT NULL,
  `status_verifikasi` int(1) UNSIGNED NOT NULL DEFAULT 0,
  `dibaca` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_surat_keluar`
--

INSERT INTO `tb_surat_keluar` (`id_skeluar`, `no_agenda`, `tujuan_surat`, `no_surat`, `tgl_surat`, `isi_surat`, `jenis_surat`, `sifat_surat`, `kode_klasifikasi`, `pembuat_surat`, `bidang`, `file_surat`, `link_file`, `keterangan`, `tahun`, `catatan_kelengkapan`, `status_verifikasi`, `dibaca`, `created_at`, `updated_at`, `user_id`) VALUES
(2, '001', 'Dinas Komunikasi dan Informatika', '001', '2022-11-18', 'Demo Aplikasi', 'Surat Pemberitahuan', 'UMUM', '001', 'Adi Murdayani', '', '2290b51e33860210e5ca33a03f777848.jpg', 'tidak ada', 'Sudah Ter-Arsip', 2022, '0', 0, 1, '2022-11-18 10:37:30', '2022-11-18 17:37:30', 1),
(3, '002', 'BPKAD', '002', '2022-11-18', 'Demo Aplikasi E-Persuratan', 'Surat Pemberitahuan', 'UMUM', '001', 'Adi Murdayani', '', '541ed9adc604e4861a487d478d5195d7.jpg', 'tidak ada', 'Sudah Ter-Arsip', 2022, '', 0, 1, '2022-11-18 11:31:11', '2022-11-18 20:25:54', 1),
(4, '004', 'Dinas Perikanan', '010', '2022-11-18', 'Demo Sistem Persuratan', 'Surat Pemberitahuan', 'RAHASIA', '001', 'Adi Murdayani', 'Pesta Wirausaha', '62a414fd230af047f4c6703d355bdf16.jpg', 'tidak ada', 'Belum Ter-Arsip', 2022, 'Tidak Baik', 0, 0, '2022-11-19 08:41:11', '2022-11-19 10:52:22', 1),
(5, '004', 'Dinas Perikanan', '043', '2022-11-20', 'Uji coba aplikasi e-persuratan untuk dinas perhubungan', 'Surat Pemberitahuan', 'UMUM', '001', 'Adi Murdayani', 'Pesta Wirausaha', '217160fd66133cbdba66ae134a33d11a.jpg', 'tidak ada', 'Sudah Ter-Arsip', 2022, '', 0, 0, '2022-11-19 19:16:12', '2022-11-20 02:16:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_masuk`
--

CREATE TABLE `tb_surat_masuk` (
  `id_smasuk` bigint(11) UNSIGNED NOT NULL,
  `no_agenda` varchar(100) NOT NULL,
  `asal_surat` varchar(128) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `tgl_surat` date DEFAULT NULL,
  `isi_surat` text NOT NULL,
  `jenis_surat` varchar(128) NOT NULL,
  `sifat_surat` enum('UMUM','RAHASIA') NOT NULL,
  `kode_klasifikasi` varchar(128) NOT NULL,
  `penerima` varchar(128) NOT NULL,
  `file_surat` text NOT NULL,
  `link_file` text NOT NULL,
  `keterangan` enum('Sudah Ter-Arsip','Belum Ter-Arsip') NOT NULL,
  `tahun` year(4) DEFAULT current_timestamp(),
  `status_disposisi` int(1) UNSIGNED NOT NULL DEFAULT 0,
  `status_verifikasi` int(1) UNSIGNED NOT NULL DEFAULT 0,
  `kode_disposisi` varchar(50) NOT NULL,
  `dibaca` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_surat_masuk`
--

INSERT INTO `tb_surat_masuk` (`id_smasuk`, `no_agenda`, `asal_surat`, `no_surat`, `tgl_surat`, `isi_surat`, `jenis_surat`, `sifat_surat`, `kode_klasifikasi`, `penerima`, `file_surat`, `link_file`, `keterangan`, `tahun`, `status_disposisi`, `status_verifikasi`, `kode_disposisi`, `dibaca`, `created_at`, `updated_at`, `user_id`) VALUES
(2, '001', 'Dinas Komunikasi dan Informatika', '001', '2022-11-18', 'Demo Aplikasi', 'Surat Pemberitahuan', 'UMUM', '001', 'Adi Murdayani', '2290b51e33860210e5ca33a03f777848.jpg', 'tidak ada', 'Sudah Ter-Arsip', 2022, 0, 0, 'DSM-001', 0, '2022-11-18 10:37:30', '2022-11-18 17:37:30', 1),
(3, '002', 'BPKAD', '002', '2022-11-18', 'Demo Aplikasi E-Persuratan', 'Surat Pemberitahuan', 'UMUM', '001', 'Adi Murdayani', '541ed9adc604e4861a487d478d5195d7.jpg', 'tidak ada', 'Sudah Ter-Arsip', 2022, 1, 1, 'DSM-002', 0, '2022-11-18 11:31:11', '2022-11-18 20:25:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(10) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(10) UNSIGNED NOT NULL,
  `last_login` int(10) UNSIGNED DEFAULT NULL,
  `active` tinyint(3) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nidn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `nidn`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$10$M1GTkhaEFa3UTZQh.m7wzeG9M9.FmVU6Qgxx5XTzG6QvjW2Ag3pX2', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1668883971, 1, 'Admin', 'istrator', 'ADMIN', '1243124123', '1234567890'),
(2, '', 'bid.darat', '$2y$10$akTzROX9VDsz3v45j.aDbe3nw.cgP2OASXKZwE8GMVMcUDWVjzsMy', 'bid.darat@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1668196250, NULL, 1, 'Bidang', 'Darat', 'Dinas Perhubungan', '0', ''),
(3, '', 'bid.laut', '$2y$10$.Z6VkSSyzBYGGpbLHgtgjuaoH/3bGqDXiqb15jvb4.AwCBNWKq6ny', 'bid.laut@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1668196235, 1668884082, 1, 'Bidang', 'Laut', 'Dinas Perhubungan', '0', ''),
(4, '', 'bid.umum', '$2y$10$4M3Lh3B.gOoDH3nBsOsRQOIWmgTJBPkkr8W0KkGzqQJHksnzg8cDi', 'bid.umum@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1668196279, 1668883689, 1, 'Bidang', 'Umum', 'Dinas Perhubungan', '0', ''),
(5, '', 'bid.rekayasa', '$2y$10$E./kA/nG4icVyO/EUvJ2DeVVV5a05DGDhk1M7dyOJGNF6RimsB1am', 'bid.rekayasa@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1668196317, 1668883895, 1, 'Bidang', 'Rekayasa', 'Dinas Perhubungan', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(6, 2, 2),
(5, 3, 3),
(4, 4, 4),
(3, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users_visitor`
--

CREATE TABLE `users_visitor` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `os` varchar(128) NOT NULL,
  `browser` varchar(128) NOT NULL,
  `versi` varchar(128) NOT NULL,
  `online` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `mac_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_visitor`
--

INSERT INTO `users_visitor` (`id`, `ip`, `date`, `hits`, `os`, `browser`, `versi`, `online`, `time`, `mac_address`) VALUES
(1, '::1', '2022-11-13', 1, 'Windows 10', 'Chrome', '107.0.0.0', '1668377510', '2022-11-13 23:11:50', ''),
(2, '::1', '2022-11-18', 33, 'Windows 10', 'Chrome', '107.0.0.0', '1668801535', '2022-11-18 04:43:31', 'F8-0D-AC-6D-42-F0'),
(3, '::1', '2022-11-19', 152, 'Windows 10', 'Chrome', '107.0.0.0', '1668884415', '2022-11-19 04:59:37', 'F8-0D-AC-6D-42-F0'),
(4, '::1', '2022-11-21', 1, 'Windows 10', 'Chrome', '107.0.0.0', '1669030740', '2022-11-21 12:39:00', 'F8-0D-AC-6D-42-F0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `menu_ibfk_1` (`id_menu_groups`);

--
-- Indexes for table `menu_access`
--
ALTER TABLE `menu_access`
  ADD PRIMARY KEY (`id_menu_access`),
  ADD KEY `id_groups` (`id_groups`),
  ADD KEY `id_menu_groups` (`id_menu_groups`);

--
-- Indexes for table `menu_groups`
--
ALTER TABLE `menu_groups`
  ADD PRIMARY KEY (`id_menu_group`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`);

--
-- Indexes for table `tb_bidang`
--
ALTER TABLE `tb_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  ADD PRIMARY KEY (`id_disposisi`);

--
-- Indexes for table `tb_jenis_surat`
--
ALTER TABLE `tb_jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_klasifikasi_surat`
--
ALTER TABLE `tb_klasifikasi_surat`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indexes for table `tb_konfigurasi`
--
ALTER TABLE `tb_konfigurasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penerima_surat`
--
ALTER TABLE `tb_penerima_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  ADD PRIMARY KEY (`id_skeluar`);

--
-- Indexes for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  ADD PRIMARY KEY (`id_smasuk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `users_visitor`
--
ALTER TABLE `users_visitor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `menu_access`
--
ALTER TABLE `menu_access`
  MODIFY `id_menu_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `menu_groups`
--
ALTER TABLE `menu_groups`
  MODIFY `id_menu_group` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id_sub_menu` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_bidang`
--
ALTER TABLE `tb_bidang`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  MODIFY `id_disposisi` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_jenis_surat`
--
ALTER TABLE `tb_jenis_surat`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_klasifikasi_surat`
--
ALTER TABLE `tb_klasifikasi_surat`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_konfigurasi`
--
ALTER TABLE `tb_konfigurasi`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_penerima_surat`
--
ALTER TABLE `tb_penerima_surat`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  MODIFY `id_skeluar` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  MODIFY `id_smasuk` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_visitor`
--
ALTER TABLE `users_visitor`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
