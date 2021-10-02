-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 02, 2021 at 10:16 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpusapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Riyan Satria', 'riyan@gmail.com', '$2y$10$lcUUwQFx/.InkO2/Y8Yy5uk7Ewnti2WOxTnnUkzTFjXFA6vv4O9t.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_klasifikasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `subyek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_fisik` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`id`, `no_klasifikasi`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `subyek`, `deskripsi_fisik`, `lokasi`, `foto`, `created_at`, `updated_at`) VALUES
(4, '004 Sen i', 'Information technology control and audit', 'Senft, Sandra', 'New York : CRC Press', 2009, 'Information Technology-Computer Science', 'xxxiv, 768hlm.27 cm', 'Perpustakaan Pusat - RBU KKC', NULL, '2021-09-23 10:45:50', '2021-09-23 10:45:50'),
(5, '004.068 MAI', 'M and A Information Technology Best Practices / Janice M. Roehl-Anderson', 'M. Roehl-Anderson, Janice (Edited)', 'New Jersey : A. John Wiley & Sons', 2013, 'Information Technology-Computer Science', 'xxv, 550 hlm. :ill. ;26 cm.', 'Perpustakaan Pusat - RBU KKC', NULL, '2021-09-23 10:46:12', '2021-09-23 10:46:12'),
(6, '300 Her i-1', 'Ilmu Sosial dan Budaya Dasar', 'Herimanto', 'Jakarta : Bumi Aksara', 2010, 'Social Science', NULL, 'Perpustakaan Pusat - RBU KKC', NULL, '2021-09-23 11:37:18', '2021-09-23 11:37:57'),
(7, '300 Hun s-', 'Social science : An introduction to the study of society', 'Hunt, Elgin F', 'Boston : Pearson', 2008, 'Social Science', NULL, 'Perpustakaan Pusat - RBU KKB', NULL, '2021-09-23 11:38:21', '2021-09-23 11:38:21'),
(8, '303 Raw t-1', 'A theory of justice : Teori keadilan dasar-dasar filsafat politik utuk mewujudkan kesejahteraan sosial dalam negara', 'Rawls, John', 'Jakarta : Pustaka Pelajar', 2006, 'Social Science', NULL, 'Perpustakaan Pusat - RBU KKB', NULL, '2021-09-23 11:38:42', '2021-09-23 11:38:42'),
(9, '300 Sup p-1', 'Pengantar Ilmu Sosial sebuah kajian pendekatan struktural', 'Supardan, Dadang H', 'Jakarta : Bumi Aksara', 2009, 'Social Science', NULL, 'Perpustakaan Pusat - RBU KKB', NULL, '2021-09-23 11:39:13', '2021-09-23 11:39:13'),
(10, '300.72 Met', 'Metode penelitian sosial : Berbagai alternatif pendekatan / Bagong Suyanto; Sutinah (editor)', 'Suyanto, Bagong (editor) Sutinah (editor)', 'Jakarta : Prenada Media', 2015, 'Social Science-Research', 'xviii, 318 p.: il. ;23 cm.', 'Perpustakaan Pusat - RBU KKB', NULL, '2021-09-23 11:39:44', '2021-09-23 11:39:44'),
(11, '300 Ilm 2', 'Ilmu Sosial di Indonesia : Perkembangan dan Tantangan / Editor Widjajanti Mulyono Santoso', 'Santoso, Widjajanti Mulyono', 'Jakarta : Yayasan Pustaka Obor Indonesia', 2016, 'Social Science', 'x, 484 hlm. :ilus. ;24 cm.', 'Perpustakaan Pusat - RBU KKB', NULL, '2021-09-23 11:40:10', '2021-09-23 11:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visitor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `interested_book` bigint(20) UNSIGNED DEFAULT NULL,
  `sent_by` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed_body` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `visitor_id`, `interested_book`, `sent_by`, `body`, `processed_body`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, 'visitor', 'Ryan', NULL, '2021-10-02 10:19:53', '2021-10-02 10:19:53'),
(2, 4, NULL, 'bot', 'Halo Ryan, senang berkenalan dengan kamu. Sekarang apa yang bisa saya bantu?', NULL, '2021-10-02 10:19:54', '2021-10-02 10:19:54'),
(4, 4, NULL, 'visitor', 'buku Information technology control and audit ada?', 'buku information technology control and audit ada', '2021-10-02 11:47:49', '2021-10-02 11:47:49'),
(7, 4, NULL, 'bot', 'Buku Information technology control and audit', NULL, '2021-10-02 11:52:05', '2021-10-02 11:52:05'),
(8, 4, NULL, 'visitor', 'buku Information technology control and audit ada?', 'buku information technology control and audit ada', '2021-10-02 11:53:31', '2021-10-02 11:53:31'),
(9, 4, NULL, 'bot', '<b>Information technology control and audit</b><br /><br />oleh :Senft, Sandra', NULL, '2021-10-02 11:53:32', '2021-10-02 11:53:32'),
(10, 4, NULL, 'visitor', 'buku Information technology control and audit ada?', 'buku information technology control and audit ada', '2021-10-02 11:53:59', '2021-10-02 11:53:59'),
(11, 4, NULL, 'bot', '<b>Information technology control and audit</b><br /><br />Senft, Sandra<br />New York : CRC Press<br />2009', NULL, '2021-10-02 11:54:00', '2021-10-02 11:54:00'),
(12, 4, NULL, 'visitor', 'hari senin buka jam berapa?', 'hari senin buka jam berapa', '2021-10-02 11:57:50', '2021-10-02 11:57:50'),
(13, 4, NULL, 'bot', 'Maaf saya ngga tau', NULL, '2021-10-02 11:57:51', '2021-10-02 11:57:51'),
(14, 4, NULL, 'visitor', 'hari senin buka jam berapa?', 'hari senin buka jam berapa', '2021-10-02 12:45:12', '2021-10-02 12:45:12'),
(15, 4, NULL, 'bot', 'Untuk hari senin buka jam ini', NULL, '2021-10-02 12:45:13', '2021-10-02 12:45:13'),
(16, 4, NULL, 'visitor', '$openTime = $jadwal->is_covid == 1 ? $jadwal->waktu_buka_covid : $jadwal->waktu_buka;', 'opentime jadwal- is covid 1 jadwal- waktu buka covid jadwal- waktu buka', '2021-10-02 12:46:58', '2021-10-02 12:46:58'),
(17, 4, NULL, 'bot', '', NULL, '2021-10-02 12:46:59', '2021-10-02 12:46:59'),
(18, 4, NULL, 'visitor', 'hari selasa buka jam berapa?', 'hari selasa buka jam berapa', '2021-10-02 12:47:07', '2021-10-02 12:47:07'),
(19, 4, NULL, 'bot', 'Untuk hari selasa buka jam 07.30 hingga 16.00', NULL, '2021-10-02 12:47:08', '2021-10-02 12:47:08'),
(20, 4, NULL, 'visitor', 'perpustakaan buka jam berapa?', 'pustaka buka jam berapa', '2021-10-02 12:47:20', '2021-10-02 12:47:20'),
(21, 4, NULL, 'bot', '', NULL, '2021-10-02 12:47:21', '2021-10-02 12:47:21'),
(22, 4, NULL, 'visitor', 'perpustakaan buka jam berapa?', 'pustaka buka jam berapa', '2021-10-02 12:47:34', '2021-10-02 12:47:34'),
(23, 4, NULL, 'bot', '', NULL, '2021-10-02 12:47:35', '2021-10-02 12:47:35'),
(24, 4, NULL, 'visitor', 'perpusnya buka jam berapa aja?', 'pus buka jam berapa aja', '2021-10-02 12:51:19', '2021-10-02 12:51:19'),
(25, 4, NULL, 'bot', '<b>Jadwal operasional perpustakaan</b><br /><br />Senin : 07.30 - 22.00 <br />Selasa : 07.30 - 16.00 <br />Rabu : 07.30 - 16.00 <br />Kamis : 07.30 - 16.00 <br />Jumat : 07.30 - 16.30 <br />', NULL, '2021-10-02 12:51:20', '2021-10-02 12:51:20'),
(26, 4, NULL, 'visitor', 'hari rabu perpusnya buka jam berapa?', 'hari rabu pus buka jam berapa', '2021-10-02 12:51:44', '2021-10-02 12:51:44'),
(27, 4, NULL, 'bot', 'Untuk hari rabu buka jam 07.30 hingga 16.00', NULL, '2021-10-02 12:51:45', '2021-10-02 12:51:45'),
(28, 4, NULL, 'visitor', 'layanan koleksi khusus', 'layan koleksi khusus', '2021-10-02 13:00:13', '2021-10-02 13:00:13'),
(29, 4, NULL, 'bot', 'Maaf saya ngga tau', NULL, '2021-10-02 13:00:14', '2021-10-02 13:00:14'),
(30, 4, NULL, 'visitor', 'bagaimana cara mendapatkan layanan koleksi khusus?', 'bagaimana cara dapat layan koleksi khusus', '2021-10-02 13:01:58', '2021-10-02 13:01:58'),
(31, 4, NULL, 'bot', 'Maaf saya ngga tau', NULL, '2021-10-02 13:01:59', '2021-10-02 13:01:59'),
(32, 4, NULL, 'visitor', 'bagaimana cara mendapatkan layanan koleksi khusus', 'bagaimana cara dapat layan koleksi khusus', '2021-10-02 13:03:30', '2021-10-02 13:03:30'),
(33, 4, NULL, 'visitor', 'bagaimana cara mendapatkan layanan koleksi khusus', 'bagaimana cara dapat layan koleksi khusus', '2021-10-02 13:04:42', '2021-10-02 13:04:42'),
(34, 4, NULL, 'bot', 'Maaf saya ngga tau', NULL, '2021-10-02 13:04:43', '2021-10-02 13:04:43'),
(35, 4, NULL, 'visitor', 'bagaimana cara mendapatkan layanan koleksi khusus', 'bagaimana cara dapat layan koleksi khusus', '2021-10-02 13:05:42', '2021-10-02 13:05:42'),
(36, 4, NULL, 'visitor', 'bagaimana cara mendapatkan layanan american corner', 'bagaimana cara dapat layan american corner', '2021-10-02 13:08:33', '2021-10-02 13:08:33'),
(37, 4, NULL, 'bot', 'Layanan : cara american corner', NULL, '2021-10-02 13:08:34', '2021-10-02 13:08:34'),
(38, 4, NULL, 'visitor', 'bagaimana cara mendapat layanan e-library', 'bagaimana cara dapat layan e-library', '2021-10-02 13:10:03', '2021-10-02 13:10:03'),
(39, 4, NULL, 'bot', 'Layanan : e-Library', NULL, '2021-10-02 13:10:04', '2021-10-02 13:10:04'),
(40, 4, NULL, 'visitor', 'info layanan e library', 'info layan e library', '2021-10-02 13:10:30', '2021-10-02 13:10:30'),
(41, 4, NULL, 'bot', 'Maaf, layanan info e library tidak dapat kami temukan', NULL, '2021-10-02 13:10:31', '2021-10-02 13:10:31'),
(42, 4, NULL, 'visitor', 'info american corner', 'info american corner', '2021-10-02 13:10:46', '2021-10-02 13:10:46'),
(43, 4, NULL, 'bot', 'Maaf saya ngga tau', NULL, '2021-10-02 13:10:47', '2021-10-02 13:10:47'),
(44, 4, NULL, 'visitor', 'info layanan american corner', 'info layan american corner', '2021-10-02 13:10:54', '2021-10-02 13:10:54'),
(45, 4, NULL, 'bot', 'Maaf, layanan info american corner tidak dapat kami temukan', NULL, '2021-10-02 13:10:55', '2021-10-02 13:10:55'),
(46, 4, NULL, 'visitor', 'info layanan american corner', 'info layan american corner', '2021-10-02 13:11:18', '2021-10-02 13:11:18'),
(47, 4, NULL, 'bot', 'Layanan : American Corner', NULL, '2021-10-02 13:11:19', '2021-10-02 13:11:19'),
(48, 4, NULL, 'visitor', 'info layanan american corner', 'info layan american corner', '2021-10-02 13:12:08', '2021-10-02 13:12:08'),
(49, 4, NULL, 'bot', '<b>Layanan American Corner </b><br /><br />\"American Corner\" Universitas Airlangga berada di pojok lantai 3 (tiga) Perpustakaan Universitas Airlangga Kampus B Jln Dharmawangsa Dalam. American Corner merupakan program kemitraan antara Kedutaan Amerika Serikat dengan Universitas Airlangga. AC menyediakan akses informasi yang terbaru dari berbagai bidang seperti politik, ekonomi, kebudayaan, pendidikan dan kehidupan sosial di Amerika melalui bahan pustaka seperti buku-buku, internet, CD-ROM, DVD, Database online dan kegiatan-kegiatan yang terbuka yang dapat diakses oleh masyarakat umum.', NULL, '2021-10-02 13:12:09', '2021-10-02 13:12:09'),
(50, 4, NULL, 'visitor', 'apa itu layanan koleksi khusus', 'apa itu layan koleksi khusus', '2021-10-02 13:12:37', '2021-10-02 13:12:37'),
(51, 4, NULL, 'bot', 'Maaf, layanan apa koleksi khusus tidak dapat kami temukan', NULL, '2021-10-02 13:12:39', '2021-10-02 13:12:39'),
(52, 4, NULL, 'visitor', 'apa itu layanan koleksi khusus', 'apa itu layan koleksi khusus', '2021-10-02 13:12:59', '2021-10-02 13:12:59'),
(53, 4, NULL, 'bot', '<b>Layanan Koleksi Khusus </b><br /><br /><div class=\'teks-kecil\'>Edited \"Koleksi Khusus merupakan koleksi yang terbatas secara jumlah dan hanya dapat dibaca di tempat saja maupun dapat di foto copy. Adapun koleksi Khusus meliputi :\r\n- Koleksi Khusus I\r\nMenyediakan sumber informasi berupa hasil karya civitas akademika Universitas Airlangga, meliputi skripsi, thesis, disertasi dan hasil penelitian.\r\n- Koleksi Khusus II\r\nMenyediakan sumber informasi dan bahan pustaka dengan jumlah terbatas (satu eksemplar). Bahan pustaka yang tersedia hanya dapat dibaca di tempat dan di foto copi saja. Namun untuk memenuhi kebutuhan pengguna, perpustakaan memberikan layanan over night. Dengan adanya layanan over night ini pengguna dapat meminjam koleksi khusus II pada hari sabtu dan mengembalikannya pada hari senin. \"</div>', NULL, '2021-10-02 13:13:00', '2021-10-02 13:13:00'),
(54, 4, NULL, 'visitor', 'info tentang buku Ilmu Sosial dan Budaya Dasar', 'info tentang buku ilmu sosial dan budaya dasar', '2021-10-02 13:13:29', '2021-10-02 13:13:29'),
(55, 4, NULL, 'bot', '<b>Ilmu Sosial dan Budaya Dasar</b><br /><br />Herimanto<br />Jakarta : Bumi Aksara<br />2010', NULL, '2021-10-02 13:13:30', '2021-10-02 13:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `jadwals`
--

CREATE TABLE `jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_buka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_tutup` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_buka_covid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waktu_tutup_covid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_covid` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwals`
--

INSERT INTO `jadwals` (`id`, `hari`, `waktu_buka`, `waktu_tutup`, `waktu_buka_covid`, `waktu_tutup_covid`, `is_covid`, `created_at`, `updated_at`) VALUES
(1, 'Senin', '07.30', '22.00', '07.30', '16.00', 0, NULL, '2021-09-29 20:57:01'),
(2, 'Selasa', '07.30', '22.00', '07.30', '16.00', 1, NULL, NULL),
(3, 'Rabu', '07.30', '22.00', '07.30', '16.00', 1, NULL, NULL),
(4, 'Kamis', '07.30', '22.00', '07.30', '16.00', 1, NULL, NULL),
(5, 'Jumat', '07.30', '21.30', '07.30', '16.30', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `layanan_perpustakaans`
--

CREATE TABLE `layanan_perpustakaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanan_perpustakaans`
--

INSERT INTO `layanan_perpustakaans` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'e-Library', 'eLibrary merupakan layanan yang menyediakan sumber-sumber informasi dalam bentuk digital, diantaranya:\r\nOPAC (Online Public Access Catalogue)\r\nADLN (Airlangga Digital Library Network)\r\nOnline Journal, diantaranya:\r\nProquest: Academic Research Library, Psychology Journals, Biology Journals, ABI/INFORM Dateline, ABI/INFORM Global, ABI/INFORM Trade & Industry, Health & Medical Complete.\r\nSpringerLink All Journal Collection\r\nElsevier ScienceDirect: Business, Management and Accounting', '2021-09-23 11:02:57', '2021-09-23 11:02:57'),
(3, 'Koleksi Khusus', 'Edited \"Koleksi Khusus merupakan koleksi yang terbatas secara jumlah dan hanya dapat dibaca di tempat saja maupun dapat di foto copy. Adapun koleksi Khusus meliputi :\r\n- Koleksi Khusus I\r\nMenyediakan sumber informasi berupa hasil karya civitas akademika Universitas Airlangga, meliputi skripsi, thesis, disertasi dan hasil penelitian.\r\n- Koleksi Khusus II\r\nMenyediakan sumber informasi dan bahan pustaka dengan jumlah terbatas (satu eksemplar). Bahan pustaka yang tersedia hanya dapat dibaca di tempat dan di foto copi saja. Namun untuk memenuhi kebutuhan pengguna, perpustakaan memberikan layanan over night. Dengan adanya layanan over night ini pengguna dapat meminjam koleksi khusus II pada hari sabtu dan mengembalikannya pada hari senin. \"', '2021-10-02 11:23:31', '2021-10-02 11:30:45'),
(4, 'American Corner', '\"American Corner\" Universitas Airlangga berada di pojok lantai 3 (tiga) Perpustakaan Universitas Airlangga Kampus B Jln Dharmawangsa Dalam. American Corner merupakan program kemitraan antara Kedutaan Amerika Serikat dengan Universitas Airlangga. AC menyediakan akses informasi yang terbaru dari berbagai bidang seperti politik, ekonomi, kebudayaan, pendidikan dan kehidupan sosial di Amerika melalui bahan pustaka seperti buku-buku, internet, CD-ROM, DVD, Database online dan kegiatan-kegiatan yang terbuka yang dapat diakses oleh masyarakat umum.', '2021-10-02 12:54:38', '2021-10-02 12:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2021_09_23_170330_create_layanan_perpustakaans_table', 1),
(3, '2021_09_23_170416_create_admins_table', 1),
(4, '2021_09_23_170521_create_bukus_table', 1),
(5, '2021_09_23_191056_create_jadwals_table', 2),
(8, '2021_09_30_035541_create_visitors_table', 2),
(9, '2021_10_02_170633_create_chats_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `name`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Riyan', 'OuckkYVF2qIeSuyH', '2021-10-02 10:01:06', '2021-10-02 10:01:06'),
(2, 'Satria', '4v8eXPuGl1o5FV8o', '2021-10-02 10:04:52', '2021-10-02 10:04:52'),
(3, 'Riyan', 'TngCgGjONygTljfB', '2021-10-02 10:19:31', '2021-10-02 10:19:31'),
(4, 'Ryan', 'lQMLYITwThUqJafh', '2021-10-02 10:19:53', '2021-10-02 10:19:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_visitor_id_index` (`visitor_id`),
  ADD KEY `chats_interested_book_index` (`interested_book`);

--
-- Indexes for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan_perpustakaans`
--
ALTER TABLE `layanan_perpustakaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `layanan_perpustakaans`
--
ALTER TABLE `layanan_perpustakaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_interested_book_foreign` FOREIGN KEY (`interested_book`) REFERENCES `bukus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
