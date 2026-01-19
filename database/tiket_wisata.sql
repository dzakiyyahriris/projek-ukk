-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2026 at 04:59 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiket_wisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `acara`
--

CREATE TABLE `acara` (
  `id_event` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `acara`
--

INSERT INTO `acara` (`id_event`, `image_path`, `admin_id`, `nama`, `tanggal`, `created_at`, `updated_at`, `stok`) VALUES
(2, 'uploads/acara/1766911855_pndidikan.jpg', 5, 'Museum Pendidikan', '2025-12-27 09:23:00', '2025-12-26 19:24:02', '2025-12-28 01:50:55', 100),
(3, 'uploads/acara/1766911795_nov.jpg', 5, 'Museum Sepuluh Nopember', '2025-12-27 09:25:00', '2025-12-26 19:25:46', '2025-12-28 01:49:55', 100),
(4, 'uploads/acara/1766911675_knjrn.jpg', 5, 'Taman Hiburan Pantai Kenjeran', '2026-01-10 09:28:00', '2025-12-26 19:28:25', '2025-12-28 01:47:55', 100),
(5, 'uploads/acara/1766911628_sprtmny.jpeg', 5, 'Museum W.R Supratman', '2025-12-27 09:33:00', '2025-12-26 19:29:50', '2025-12-28 01:47:08', 100),
(6, 'uploads/acara/1766911523_perahu.jpg', 5, 'Wisata Perahu Kalimas', '2025-12-01 09:30:00', '2025-12-26 19:31:04', '2025-12-28 01:45:23', 100),
(8, 'uploads/acara/1766911385_hos.jpg', 5, 'Museum H.O.S Tjokroaminoto', '2025-05-07 09:33:00', '2025-12-26 19:33:25', '2025-12-28 01:43:05', 100),
(9, 'uploads/acara/1766909729_tgu phlwwn.jpg', 1, 'Monumen Tugu Pahlawan', '2025-12-28 15:13:00', '2025-12-28 01:15:29', '2025-12-28 01:15:29', 100),
(10, 'uploads/acara/1768224739_bali kota.jpg', 1, 'Balai Pemuda', '2026-01-12 20:30:00', '2026-01-12 06:32:19', '2026-01-12 06:32:19', 100),
(11, 'uploads/acara/1768224964_tmn bhineka.jpeg', 1, 'Taman Bhineka', '2026-01-12 20:33:00', '2026-01-12 06:36:04', '2026-01-12 06:36:04', 100),
(12, 'uploads/acara/1768225250_kota lama.jpg', 1, 'Kota Lama', '2026-01-12 20:37:00', '2026-01-12 06:40:50', '2026-01-12 06:40:50', 100),
(15, 'uploads/acara/1768734373_zoo.jpg', 1, 'Kebun Binatang', '2026-01-19 18:06:00', '2026-01-18 04:06:13', '2026-01-18 04:06:13', 100),
(16, 'uploads/acara/1768734399_monum.jpg', 1, 'Monumen Kapal Selam', '2026-01-19 18:06:00', '2026-01-18 04:06:39', '2026-01-18 04:06:39', 100),
(18, 'uploads/acara/1768735360_dcfg.jpeg', 1, 'Surabaya North Quay', '2026-01-18 18:22:00', '2026-01-18 04:22:40', '2026-01-18 04:22:40', 100),
(19, 'uploads/acara/1768738139_ug.jpg', 13, 'Museum Bawah Tanah', '2026-01-20 19:06:00', '2026-01-18 05:08:59', '2026-01-18 05:08:59', 100);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@admin.com|127.0.0.1', 'i:1;', 1768626338),
('laravel-cache-admin@admin.com|127.0.0.1:timer', 'i:1768626338;', 1768626338),
('laravel-cache-admin@g|127.0.0.1', 'i:1;', 1768788340),
('laravel-cache-admin@g|127.0.0.1:timer', 'i:1768788340;', 1768788340),
('laravel-cache-admin@smkn2-mjk.sch.id|127.0.0.1', 'i:1;', 1768730013),
('laravel-cache-admin@smkn2-mjk.sch.id|127.0.0.1:timer', 'i:1768730013;', 1768730013);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_pesanan`
--

CREATE TABLE `item_pesanan` (
  `id_item_pesanan` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `ticket_type_id` bigint UNSIGNED NOT NULL,
  `kode_tiket` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_pesanan`
--

INSERT INTO `item_pesanan` (`id_item_pesanan`, `order_id`, `ticket_type_id`, `kode_tiket`, `status`, `created_at`, `updated_at`) VALUES
(23, 5, 4, 'TKT-TBKCA3FVQB', 'Aktif', '2025-12-28 01:53:28', '2025-12-28 01:53:28'),
(24, 5, 4, 'TKT-4UHHMU40DQ', 'Aktif', '2025-12-28 01:53:28', '2025-12-28 01:53:28'),
(25, 5, 4, 'TKT-DGBYXIJTC6', 'Aktif', '2025-12-28 01:53:28', '2025-12-28 01:53:28'),
(26, 5, 4, 'TKT-4FZHYRUIUZ', 'Aktif', '2025-12-28 01:53:28', '2025-12-28 01:53:28'),
(27, 5, 4, 'TKT-C8TVPWMLBD', 'Aktif', '2025-12-28 01:53:28', '2025-12-28 01:53:28'),
(28, 6, 5, 'TKT-1FFHJL6XIU', 'Aktif', '2026-01-04 07:18:39', '2026-01-04 07:18:39'),
(29, 6, 5, 'TKT-N0OUPJKEXH', 'Aktif', '2026-01-04 07:18:39', '2026-01-04 07:18:39'),
(30, 6, 5, 'TKT-7GJEC1D0VM', 'Aktif', '2026-01-04 07:18:39', '2026-01-04 07:18:39'),
(31, 6, 5, 'TKT-E3FDVD9BFH', 'Aktif', '2026-01-04 07:18:39', '2026-01-04 07:18:39'),
(32, 6, 5, 'TKT-JU5LIUREA3', 'Aktif', '2026-01-04 07:18:39', '2026-01-04 07:18:39'),
(33, 6, 5, 'TKT-65USVJULQR', 'Aktif', '2026-01-04 07:18:39', '2026-01-04 07:18:39'),
(34, 6, 5, 'TKT-7M9PME5CM8', 'Aktif', '2026-01-04 07:18:39', '2026-01-04 07:18:39'),
(35, 6, 5, 'TKT-OMYBH5VJXI', 'Aktif', '2026-01-04 07:18:39', '2026-01-04 07:18:39'),
(36, 6, 5, 'TKT-KCYIQBA322', 'Aktif', '2026-01-04 07:18:39', '2026-01-04 07:18:39'),
(37, 6, 5, 'TKT-YN4T4LU2RT', 'Aktif', '2026-01-04 07:18:39', '2026-01-04 07:18:39'),
(38, 6, 5, 'TKT-GJOC3HSB7B', 'Aktif', '2026-01-04 07:18:39', '2026-01-04 07:18:39'),
(39, 6, 5, 'TKT-S5QB8QWMYJ', 'Aktif', '2026-01-04 07:18:39', '2026-01-04 07:18:39'),
(40, 7, 4, 'TKT-9T4TTEJXI6', 'Aktif', '2026-01-04 19:21:05', '2026-01-04 19:21:05'),
(41, 8, 4, 'TKT-VSQOJNV5VR', 'Aktif', '2026-01-06 21:42:03', '2026-01-06 21:42:03'),
(42, 8, 4, 'TKT-ND2XBJHLY9', 'Aktif', '2026-01-06 21:42:03', '2026-01-06 21:42:03'),
(43, 9, 15, 'TKT-ULAZLO0P0V', 'Aktif', '2026-01-12 17:26:03', '2026-01-12 17:26:03'),
(44, 10, 16, 'TKT-NIMFZKACDR', 'Aktif', '2026-01-12 21:46:14', '2026-01-12 21:46:14'),
(45, 10, 16, 'TKT-PPIHIW6MBM', 'Aktif', '2026-01-12 21:46:14', '2026-01-12 21:46:14'),
(46, 10, 16, 'TKT-IVJFUGHGUI', 'Aktif', '2026-01-12 21:46:14', '2026-01-12 21:46:14'),
(47, 11, 16, 'TKT-UNXFGPCXZ2', 'Aktif', '2026-01-13 04:55:50', '2026-01-13 04:55:50'),
(48, 11, 16, 'TKT-O6ZTSMDAJM', 'Aktif', '2026-01-13 04:55:50', '2026-01-13 04:55:50'),
(49, 11, 16, 'TKT-NTG458DARA', 'Aktif', '2026-01-13 04:55:50', '2026-01-13 04:55:50'),
(50, 11, 16, 'TKT-MS0MCHPMUS', 'Aktif', '2026-01-13 04:55:50', '2026-01-13 04:55:50'),
(51, 12, 14, 'TKT-4IOME4RY6J', 'Aktif', '2026-01-13 05:13:10', '2026-01-13 05:13:10'),
(52, 12, 14, 'TKT-WZ7XVDZLJJ', 'Aktif', '2026-01-13 05:13:10', '2026-01-13 05:13:10'),
(53, 12, 14, 'TKT-TUEOMJAC86', 'Aktif', '2026-01-13 05:13:10', '2026-01-13 05:13:10'),
(54, 12, 14, 'TKT-AHX3ETMFFT', 'Aktif', '2026-01-13 05:13:10', '2026-01-13 05:13:10'),
(55, 13, 15, 'TKT-ALHYGT0C61', 'Aktif', '2026-01-13 05:15:19', '2026-01-13 05:15:19'),
(56, 14, 15, 'TKT-H7N0IVOSZF', 'Aktif', '2026-01-13 05:51:18', '2026-01-13 05:51:18'),
(57, 14, 15, 'TKT-LZQF1YEKDM', 'Aktif', '2026-01-13 05:51:18', '2026-01-13 05:51:18'),
(58, 14, 15, 'TKT-UOU5YYXP5Z', 'Aktif', '2026-01-13 05:51:18', '2026-01-13 05:51:18'),
(59, 14, 15, 'TKT-FPHKS3C0WC', 'Aktif', '2026-01-13 05:51:18', '2026-01-13 05:51:18'),
(60, 14, 15, 'TKT-PVCX7HAFO9', 'Aktif', '2026-01-13 05:51:18', '2026-01-13 05:51:18'),
(61, 15, 7, 'TKT-0ARQC07QKR', 'Aktif', '2026-01-13 06:17:13', '2026-01-13 06:17:13'),
(62, 15, 7, 'TKT-76HEDMY3OZ', 'Aktif', '2026-01-13 06:17:13', '2026-01-13 06:17:13'),
(63, 15, 7, 'TKT-JNHA5XGLYG', 'Aktif', '2026-01-13 06:17:13', '2026-01-13 06:17:13'),
(64, 16, 15, 'TKT-DT5S41PMSF', 'Aktif', '2026-01-13 06:26:29', '2026-01-15 23:01:49'),
(65, 16, 15, 'TKT-X6RAF1I6RP', 'Aktif', '2026-01-13 06:26:29', '2026-01-15 23:01:49'),
(67, 18, 15, 'TKT-XKIFLTJINC', 'Aktif', '2026-01-13 18:48:19', '2026-01-13 19:15:33'),
(68, 19, 15, 'TKT-HLSYRJLPLR', 'Aktif', '2026-01-13 18:55:12', '2026-01-13 18:55:12'),
(69, 19, 15, 'TKT-2D3SJMA56M', 'Aktif', '2026-01-13 18:55:12', '2026-01-13 18:55:12'),
(70, 19, 15, 'TKT-NZ1K1FUAA6', 'Aktif', '2026-01-13 18:55:12', '2026-01-13 18:55:12'),
(71, 19, 15, 'TKT-DJ2TZTCYQT', 'Aktif', '2026-01-13 18:55:12', '2026-01-13 18:55:12'),
(72, 19, 15, 'TKT-WN3A5GMKCI', 'Aktif', '2026-01-13 18:55:12', '2026-01-13 18:55:12'),
(73, 20, 16, 'TKT-RYMJLGFDUK', 'Aktif', '2026-01-13 18:57:28', '2026-01-13 19:15:24'),
(74, 20, 16, 'TKT-VUID4TABXW', 'Aktif', '2026-01-13 18:57:28', '2026-01-13 19:15:24'),
(75, 20, 16, 'TKT-F12OO0ZTRD', 'Aktif', '2026-01-13 18:57:28', '2026-01-13 19:15:24'),
(76, 20, 16, 'TKT-LI462PGR4S', 'Aktif', '2026-01-13 18:57:28', '2026-01-13 19:15:24'),
(77, 20, 16, 'TKT-IBU1Z4YJMB', 'Aktif', '2026-01-13 18:57:28', '2026-01-13 19:15:24'),
(78, 20, 16, 'TKT-J8I83HTTKQ', 'Aktif', '2026-01-13 18:57:28', '2026-01-13 19:15:24'),
(79, 20, 16, 'TKT-PDSXGVUKMG', 'Aktif', '2026-01-13 18:57:28', '2026-01-13 19:15:24'),
(80, 20, 16, 'TKT-MKYINIZMVC', 'Aktif', '2026-01-13 18:57:28', '2026-01-13 19:15:24'),
(81, 20, 16, 'TKT-LWJAMF0V0V', 'Aktif', '2026-01-13 18:57:28', '2026-01-13 19:15:24'),
(82, 21, 16, 'TKT-MOK0YNMHTC', 'Aktif', '2026-01-13 19:18:06', '2026-01-13 19:19:14'),
(83, 21, 16, 'TKT-SRKPBT9MC4', 'Aktif', '2026-01-13 19:18:06', '2026-01-13 19:19:14'),
(84, 21, 16, 'TKT-3RVUXUHIQM', 'Aktif', '2026-01-13 19:18:06', '2026-01-13 19:19:14'),
(85, 21, 16, 'TKT-6FYYZHDXV7', 'Aktif', '2026-01-13 19:18:06', '2026-01-13 19:19:14'),
(86, 22, 15, 'TKT-VVLWWAYOFW', 'Aktif', '2026-01-13 19:21:56', '2026-01-13 20:39:56'),
(87, 23, 13, 'TKT-RVILSULILD', 'Aktif', '2026-01-13 20:40:31', '2026-01-13 23:35:08'),
(88, 23, 13, 'TKT-LUIK5N5XDG', 'Aktif', '2026-01-13 20:40:31', '2026-01-13 23:35:08'),
(89, 24, 14, 'TKT-VBQMYRE7EV', 'Aktif', '2026-01-13 22:56:17', '2026-01-13 23:35:03'),
(90, 24, 14, 'TKT-O12V6RM6MX', 'Aktif', '2026-01-13 22:56:17', '2026-01-13 23:35:03'),
(91, 24, 14, 'TKT-RZ44M5DCLW', 'Aktif', '2026-01-13 22:56:17', '2026-01-13 23:35:03'),
(92, 24, 14, 'TKT-CVJB63PPQC', 'Aktif', '2026-01-13 22:56:17', '2026-01-13 23:35:03'),
(93, 25, 15, 'TKT-VQT9CCO0BZ', 'Aktif', '2026-01-13 23:44:36', '2026-01-13 23:45:20'),
(94, 25, 15, 'TKT-T5XBTNULOL', 'Aktif', '2026-01-13 23:44:36', '2026-01-13 23:45:20'),
(95, 26, 15, 'TKT-RSPGMDRGEU', 'Aktif', '2026-01-17 05:14:34', '2026-01-17 05:15:20'),
(96, 26, 15, 'TKT-T0D5ZM2E09', 'Aktif', '2026-01-17 05:14:34', '2026-01-17 05:15:20'),
(97, 26, 15, 'TKT-J6PTDJXWLA', 'Aktif', '2026-01-17 05:14:34', '2026-01-17 05:15:20'),
(98, 26, 15, 'TKT-9JAWJNKDCD', 'Aktif', '2026-01-17 05:14:34', '2026-01-17 05:15:20'),
(99, 27, 16, 'TKT-SHE0WPTV1S', 'Aktif', '2026-01-17 05:15:41', '2026-01-17 05:16:23'),
(100, 27, 16, 'TKT-6ZORJ4EHUH', 'Aktif', '2026-01-17 05:15:41', '2026-01-17 05:16:23'),
(101, 28, 7, 'TKT-1S8TKLA5BL', 'Aktif', '2026-01-17 21:24:38', '2026-01-17 21:27:35'),
(102, 28, 7, 'TKT-LD6MCDGCWT', 'Aktif', '2026-01-17 21:24:38', '2026-01-17 21:27:35'),
(103, 28, 7, 'TKT-VTTKXS7KI5', 'Aktif', '2026-01-17 21:24:38', '2026-01-17 21:27:35'),
(104, 29, 15, 'TKT-PEZLYNJH50', 'Aktif', '2026-01-17 22:15:32', '2026-01-17 22:17:42'),
(105, 29, 15, 'TKT-4XRWUZCIXQ', 'Aktif', '2026-01-17 22:15:32', '2026-01-17 22:17:42'),
(106, 29, 15, 'TKT-GGAMT1XZKI', 'Aktif', '2026-01-17 22:15:32', '2026-01-17 22:17:42'),
(107, 30, 16, 'TKT-MFQ0OQELTT', 'Aktif', '2026-01-17 22:15:45', '2026-01-17 22:17:47'),
(108, 30, 16, 'TKT-YVAU3V8X5X', 'Aktif', '2026-01-17 22:15:45', '2026-01-17 22:17:47'),
(109, 31, 15, 'TKT-OJAZUHGTKR', 'Aktif', '2026-01-17 22:53:25', '2026-01-17 22:53:25'),
(110, 32, 15, 'TKT-ONEQSEWJW6', 'Aktif', '2026-01-17 23:43:09', '2026-01-17 23:43:09'),
(111, 32, 15, 'TKT-7WCKHNZLXV', 'Aktif', '2026-01-17 23:43:09', '2026-01-17 23:43:09'),
(112, 32, 15, 'TKT-ICLLEKBG3R', 'Aktif', '2026-01-17 23:43:09', '2026-01-17 23:43:09'),
(113, 32, 15, 'TKT-JSPNOJTODI', 'Aktif', '2026-01-17 23:43:09', '2026-01-17 23:43:09'),
(114, 32, 15, 'TKT-DDUQ3OGIPG', 'Aktif', '2026-01-17 23:43:09', '2026-01-17 23:43:09'),
(115, 33, 15, 'TKT-X8AQZBZAT5', 'Aktif', '2026-01-18 00:04:01', '2026-01-18 00:04:01'),
(116, 34, 15, 'TKT-PEJJOGPAKX', 'Aktif', '2026-01-18 00:10:37', '2026-01-18 00:10:37'),
(117, 34, 15, 'TKT-MXWIWCTDGS', 'Aktif', '2026-01-18 00:10:37', '2026-01-18 00:10:37'),
(118, 35, 15, 'TKT-Z0RJQVJIUE', 'Aktif', '2026-01-18 00:11:28', '2026-01-18 00:11:28'),
(119, 36, 16, 'TKT-5ME6PCJ9TY', 'Aktif', '2026-01-18 00:13:14', '2026-01-18 00:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_07_044429_create_acaras_table', 1),
(5, '2025_12_07_044456_create_tipe_tikets_table', 1),
(6, '2025_12_07_044515_create_pesanans_table', 1),
(7, '2025_12_07_044529_create_item_pesanans_table', 1),
(8, '2026_01_13_053322_create_pembayarans_table', 2),
(9, '2026_01_13_063545_add_details_to_pembayarans_table', 3),
(10, '2026_01_16_032718_add_role_to_users_table', 4),
(11, '2026_01_17_040653_add_stok_to_acara_table', 5),
(12, '2026_01_17_041906_add_checkin_status_to_pesanan_table', 6),
(13, '2026_01_17_140405_create_transactions_table', 7),
(14, '2026_01_18_063801_add_tanggal_kunjungan_to_transactions_table', 8),
(15, '2026_01_18_075037_add_details_to_pesanan_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `pesanan_id` bigint UNSIGNED NOT NULL,
  `jumlah_bayar` decimal(15,2) NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pembayaran` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_bayar` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `pesanan_id`, `jumlah_bayar`, `metode_pembayaran`, `status_pembayaran`, `bukti_pembayaran`, `tanggal_bayar`, `created_at`, `updated_at`) VALUES
(1, 5, 25.00, 'cash', 'pending_cash', NULL, NULL, '2026-01-13 00:23:04', '2026-01-13 00:23:04'),
(2, 5, 25.00, 'cash', 'pending_cash', NULL, NULL, '2026-01-13 00:23:38', '2026-01-13 00:23:38'),
(3, 5, 25.00, 'cash', 'pending_cash', NULL, NULL, '2026-01-13 00:23:44', '2026-01-13 00:23:44'),
(4, 10, 100000.00, 'cash', 'success', NULL, '2026-01-13 23:17:12', '2026-01-13 00:30:58', '2026-01-13 23:17:12'),
(5, 10, 60.00, 'cash', 'pending_cash', NULL, NULL, '2026-01-13 00:45:08', '2026-01-13 00:45:08'),
(6, 10, 60.00, 'cash', 'pending_cash', NULL, NULL, '2026-01-13 00:48:55', '2026-01-13 00:48:55'),
(7, 5, 25.00, 'cash', 'pending_cash', NULL, NULL, '2026-01-13 00:49:47', '2026-01-13 00:49:47'),
(8, 11, 80.00, 'cash', 'pending_cash', NULL, NULL, '2026-01-13 04:56:08', '2026-01-13 04:56:08'),
(9, 12, 0.00, 'transfer', 'waiting_verification', 'bukti_bayar/hjthg3rndLTNPwC4Ev9WbvQq46yNiy3g3VpL7q4x.jpg', '2026-01-13 05:14:11', '2026-01-13 05:14:11', '2026-01-13 05:14:11'),
(10, 13, 20.00, 'cash', 'pending_cash', NULL, NULL, '2026-01-13 05:15:29', '2026-01-13 05:15:29'),
(11, 13, 20.00, 'cash', 'pending_cash', NULL, NULL, '2026-01-13 05:25:02', '2026-01-13 05:25:02'),
(12, 14, 100.00, 'cash', 'pending', NULL, '2026-01-13 05:51:30', '2026-01-13 05:51:30', '2026-01-13 05:51:30'),
(13, 15, 36.00, 'cash', 'pending', NULL, '2026-01-13 06:17:25', '2026-01-13 06:17:25', '2026-01-13 06:17:25'),
(14, 16, 40.00, 'cash', 'success', NULL, '2026-01-15 23:01:49', '2026-01-13 06:26:47', '2026-01-15 23:01:49'),
(15, 18, 20.00, 'cash', 'success', NULL, '2026-01-13 19:15:33', '2026-01-13 18:48:29', '2026-01-13 19:15:33'),
(16, 20, 180.00, 'cash', 'success', NULL, '2026-01-13 19:15:24', '2026-01-13 18:57:38', '2026-01-13 19:15:24'),
(17, 21, 80.00, 'cash', 'success', NULL, '2026-01-13 19:19:14', '2026-01-13 19:18:31', '2026-01-13 19:19:14'),
(18, 22, 20.00, 'transfer', 'success', 'bukti_bayar/94ax4K0ImAnSjEQP44mTOEtLztECX3UU0rWVQ8d9.jpg', '2026-01-13 20:39:56', '2026-01-13 19:22:16', '2026-01-13 20:39:56'),
(19, 23, 40000.00, 'cash', 'success', NULL, '2026-01-13 23:35:08', '2026-01-13 20:58:40', '2026-01-13 23:35:08'),
(20, 24, 0.00, 'cash', 'success', NULL, '2026-01-13 23:35:03', '2026-01-13 22:59:36', '2026-01-13 23:35:03'),
(21, 6, 144.00, 'cash', 'pending', NULL, '2026-01-13 23:01:00', '2026-01-13 23:00:22', '2026-01-13 23:01:00'),
(22, 25, 50.00, 'cash', 'success', NULL, '2026-01-13 23:45:20', '2026-01-13 23:44:49', '2026-01-13 23:45:20'),
(23, 26, 100.00, 'cash', 'success', NULL, '2026-01-17 05:15:20', '2026-01-17 05:14:49', '2026-01-17 05:15:20'),
(24, 27, 40.00, 'transfer', 'success', 'bukti_bayar/pPIpM8i8V6sddrbBNM2ztfMmrlwR9kaEfBvni8lu.jpg', '2026-01-17 05:16:23', '2026-01-17 05:16:07', '2026-01-17 05:16:23'),
(25, 28, 40.00, 'cash', 'success', NULL, '2026-01-17 21:27:35', '2026-01-17 21:24:48', '2026-01-17 21:27:35'),
(26, 30, 50.00, 'cash', 'success', NULL, '2026-01-17 22:17:47', '2026-01-17 22:16:08', '2026-01-17 22:17:47'),
(27, 29, 65.00, 'cash', 'success', NULL, '2026-01-17 22:17:42', '2026-01-17 22:16:46', '2026-01-17 22:17:42'),
(28, 37, 30.00, 'cash', 'success', NULL, '2026-01-18 02:59:38', '2026-01-18 01:08:11', '2026-01-18 02:59:38'),
(29, 39, 50.00, 'cash', 'success', NULL, '2026-01-18 03:05:56', '2026-01-18 03:04:19', '2026-01-18 03:05:56'),
(30, 40, 20.00, 'cash', 'success', NULL, '2026-01-18 03:19:44', '2026-01-18 03:15:20', '2026-01-18 03:19:44'),
(31, 41, 40.00, 'cash', 'success', NULL, '2026-01-18 04:11:08', '2026-01-18 03:20:43', '2026-01-18 04:11:08'),
(32, 44, 1.00, 'cash', 'success', NULL, '2026-01-18 20:55:25', '2026-01-18 20:55:14', '2026-01-18 20:55:25'),
(33, 43, 15.00, 'cash', 'success', NULL, '2026-01-18 20:56:29', '2026-01-18 20:56:12', '2026-01-18 21:01:58'),
(34, 45, 10.00, 'cash', 'success', NULL, '2026-01-18 21:05:25', '2026-01-18 21:03:58', '2026-01-18 21:05:25'),
(35, 46, 10000.00, 'cash', 'success', NULL, '2026-01-18 21:37:39', '2026-01-18 21:26:44', '2026-01-18 21:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `id_wisata` bigint UNSIGNED DEFAULT NULL,
  `id_ticket_type` bigint UNSIGNED DEFAULT NULL,
  `tanggal_kunjungan` date DEFAULT NULL,
  `jumlah_tiket` int NOT NULL DEFAULT '1',
  `kode_pesanan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_total` decimal(10,2) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_checkin` tinyint(1) NOT NULL DEFAULT '0',
  `waktu_checkin` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `user_id`, `id_wisata`, `id_ticket_type`, `tanggal_kunjungan`, `jumlah_tiket`, `kode_pesanan`, `jumlah_total`, `status`, `status_checkin`, `waktu_checkin`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, NULL, NULL, 1, 'ORD-WEZX2X2WT4', 10.00, 'Lunas', 0, NULL, '2025-12-07 00:41:10', '2025-12-07 00:41:10'),
(2, 3, NULL, NULL, NULL, 1, 'ORD-1LPLKTQ2XL', 130.00, 'Lunas', 0, NULL, '2025-12-26 18:44:25', '2025-12-26 18:44:25'),
(3, 5, NULL, NULL, NULL, 1, 'ORD-0D6TVXKH', 805000.00, 'Lunas', 0, NULL, '2025-12-26 20:39:19', '2026-01-13 04:52:39'),
(4, 5, NULL, NULL, NULL, 1, 'ORD-BHDPUAFV', 115000.00, 'Lunas', 0, NULL, '2025-12-26 20:40:30', '2025-12-26 20:45:48'),
(5, 5, NULL, NULL, NULL, 1, 'ORD-YCMFNVBZ', 25.00, 'waiting_cash', 0, NULL, '2025-12-28 01:53:28', '2026-01-13 00:23:04'),
(6, 5, NULL, NULL, NULL, 1, 'ORD-VYJ7DBIR', 144.00, 'Bayar di Tempat', 0, NULL, '2026-01-04 07:18:39', '2026-01-13 23:00:22'),
(7, 5, NULL, NULL, NULL, 1, 'ORD-ON7LSU1C', 5.00, 'Lunas', 0, NULL, '2026-01-04 19:21:04', '2026-01-04 19:29:10'),
(8, 5, NULL, NULL, NULL, 1, 'ORD-OQLQATJV', 10.00, 'Lunas', 0, NULL, '2026-01-06 21:42:03', '2026-01-13 04:53:33'),
(9, 5, NULL, NULL, NULL, 1, 'ORD-M1ZPYB5Y', 20.00, 'Pending', 0, NULL, '2026-01-12 17:26:03', '2026-01-12 17:26:03'),
(10, 5, NULL, NULL, NULL, 1, 'ORD-SLJCO3FL', 60.00, 'paid', 0, NULL, '2026-01-12 21:46:14', '2026-01-13 23:17:12'),
(11, 1, NULL, NULL, NULL, 1, 'ORD-YJVQIQJA', 80.00, 'waiting_cash', 0, NULL, '2026-01-13 04:55:50', '2026-01-13 04:56:08'),
(12, 1, NULL, NULL, NULL, 1, 'ORD-JJO64LU7', 0.00, 'waiting_verification', 0, NULL, '2026-01-13 05:13:10', '2026-01-13 05:14:11'),
(13, 1, NULL, NULL, NULL, 1, 'ORD-SGWUGOVD', 20.00, 'waiting_cash', 0, NULL, '2026-01-13 05:15:19', '2026-01-13 05:15:29'),
(14, 1, NULL, NULL, NULL, 1, 'ORD-ETQCPLAA', 100.00, 'Bayar di Tempat', 0, NULL, '2026-01-13 05:51:18', '2026-01-13 05:51:30'),
(15, 1, NULL, NULL, NULL, 1, 'ORD-SYBG7ZQK', 36.00, 'waiting_verification', 0, NULL, '2026-01-13 06:17:13', '2026-01-18 22:10:03'),
(16, 1, NULL, NULL, NULL, 1, 'ORD-QLQ92CAT', 40.00, 'Lunas', 0, NULL, '2026-01-13 06:26:29', '2026-01-15 23:01:49'),
(18, 5, NULL, NULL, NULL, 1, 'ORD-IGBR6J9N', 20.00, 'Lunas', 0, NULL, '2026-01-13 18:48:19', '2026-01-13 19:15:33'),
(19, 5, NULL, NULL, NULL, 1, 'ORD-DO94AIBG', 100.00, 'Lunas', 0, NULL, '2026-01-13 18:55:12', '2026-01-13 18:55:32'),
(20, 5, NULL, NULL, NULL, 1, 'ORD-0GKFJRFK', 180.00, 'Lunas', 0, NULL, '2026-01-13 18:57:28', '2026-01-13 19:15:24'),
(21, 5, NULL, NULL, NULL, 1, 'ORD-ZTX7QDD5', 80.00, 'Lunas', 0, NULL, '2026-01-13 19:18:06', '2026-01-13 19:19:14'),
(22, 5, NULL, NULL, NULL, 1, 'ORD-ALUXIT9L', 20.00, 'Lunas', 0, NULL, '2026-01-13 19:21:56', '2026-01-13 20:39:56'),
(23, 5, NULL, NULL, NULL, 1, 'ORD-03QK91FW', 30.00, 'Lunas', 0, NULL, '2026-01-13 20:40:31', '2026-01-13 23:35:08'),
(24, 5, NULL, NULL, NULL, 1, 'ORD-HJFQNTIF', 0.00, 'Lunas', 0, NULL, '2026-01-13 22:56:17', '2026-01-13 23:35:03'),
(25, 5, NULL, NULL, NULL, 1, 'ORD-RFICIHCE', 40.00, 'Lunas', 0, NULL, '2026-01-13 23:44:36', '2026-01-13 23:45:20'),
(26, 11, NULL, NULL, NULL, 1, 'ORD-WDMEEPPS', 80.00, 'Lunas', 0, NULL, '2026-01-17 05:14:34', '2026-01-17 05:15:20'),
(27, 11, NULL, NULL, NULL, 1, 'ORD-IXXGEC2Q', 40.00, 'Lunas', 0, NULL, '2026-01-17 05:15:41', '2026-01-17 05:16:23'),
(28, 11, NULL, NULL, NULL, 1, 'ORD-GQ81ICL7', 36.00, 'Lunas', 0, NULL, '2026-01-17 21:24:38', '2026-01-17 21:27:35'),
(29, 12, NULL, NULL, NULL, 1, 'ORD-9QYERFIR', 60.00, 'Lunas', 0, NULL, '2026-01-17 22:15:32', '2026-01-17 22:17:42'),
(30, 12, NULL, NULL, NULL, 1, 'ORD-KTKOCWHL', 40.00, 'Lunas', 0, NULL, '2026-01-17 22:15:45', '2026-01-17 22:17:47'),
(31, 12, NULL, NULL, NULL, 1, 'ORD-RBRWELM3', 20.00, 'Pending', 0, NULL, '2026-01-17 22:53:25', '2026-01-17 22:53:25'),
(32, 12, NULL, NULL, NULL, 1, 'ORD-A776MJDW', 100.00, 'Pending', 0, NULL, '2026-01-17 23:43:09', '2026-01-17 23:43:09'),
(33, 12, NULL, NULL, NULL, 1, 'ORD-P1TO1WOV', 20.00, 'Pending', 0, NULL, '2026-01-18 00:04:01', '2026-01-18 00:04:01'),
(34, 12, NULL, NULL, NULL, 1, 'ORD-XJIZCVRG', 40.00, 'Pending', 0, NULL, '2026-01-18 00:10:37', '2026-01-18 00:10:37'),
(35, 12, NULL, NULL, NULL, 1, 'ORD-ZRFWXQ26', 20.00, 'Pending', 0, NULL, '2026-01-18 00:11:28', '2026-01-18 00:11:28'),
(36, 12, NULL, NULL, NULL, 1, 'ORD-HK5JM30E', 20.00, 'Pending', 0, NULL, '2026-01-18 00:13:14', '2026-01-18 00:13:14'),
(37, 12, 12, 16, '2026-01-20', 1, 'ORD-696C92256CC89', 20.00, 'Lunas', 0, NULL, '2026-01-18 00:56:21', '2026-01-18 02:59:38'),
(38, 11, 11, 15, '2026-01-18', 1, 'ORD-696CAE8766BDD', 20.00, 'Lunas', 0, NULL, '2026-01-18 02:57:27', '2026-01-18 02:57:53'),
(39, 11, 12, 16, '2026-01-19', 2, 'ORD-696CAFD238B4A', 40.00, 'lunas', 0, NULL, '2026-01-18 03:02:58', '2026-01-18 03:05:56'),
(40, 11, 12, 16, '2026-01-30', 1, 'ORD-696CB2A97D48C', 20.00, 'Lunas', 0, NULL, '2026-01-18 03:15:05', '2026-01-18 18:56:57'),
(41, 11, 11, 15, '2026-01-20', 2, 'ORD-696CB3EF36160', 40.00, 'Lunas', 0, NULL, '2026-01-18 03:20:31', '2026-01-18 04:11:08'),
(42, 13, 11, 15, '2026-01-18', 1, 'ORD-696CC59F6753F', 20.00, 'Lunas', 0, NULL, '2026-01-18 04:35:59', '2026-01-18 17:50:20'),
(43, 14, 18, 18, '2026-01-19', 1, 'ORD-696DAAFBA9840', 15.00, 'Lunas', 0, NULL, '2026-01-18 20:54:35', '2026-01-18 21:01:58'),
(44, 14, 19, 21, '2026-01-19', 1, 'ORD-696DAB0AAB362', 0.00, 'Lunas', 0, NULL, '2026-01-18 20:54:50', '2026-01-18 21:02:03'),
(45, 14, 16, 19, '2026-01-19', 1, 'ORD-696DAD253BF08', 5.00, 'Lunas', 0, NULL, '2026-01-18 21:03:49', '2026-01-18 21:06:36'),
(46, 14, 8, 11, '2026-01-19', 1, 'ORD-696DB272B80E7', 5.00, 'Lunas', 0, NULL, '2026-01-18 21:26:26', '2026-01-18 22:07:07'),
(47, 14, 18, 18, '2026-01-19', 1, 'ORD-696DB66F4C8C0', 15.00, 'Lunas', 0, NULL, '2026-01-18 21:43:27', '2026-01-18 21:45:02'),
(48, 14, 18, 18, '2026-01-19', 1, 'ORD-696DBEBF685B4', 15.00, 'Lunas', 0, NULL, '2026-01-18 22:18:55', '2026-01-18 22:30:12'),
(49, 14, 18, 18, '2026-01-19', 1, 'ORD-696DF66CC2E2E', 15.00, 'Lunas', 0, NULL, '2026-01-19 02:16:28', '2026-01-19 02:38:59'),
(50, 13, 18, 18, '2026-01-19', 1, 'ORD-696DFCCC74103', 15.00, 'Lunas', 0, NULL, '2026-01-19 02:43:40', '2026-01-19 02:47:40'),
(51, 13, 18, 18, '2026-01-19', 1, 'ORD-696DFE6FC251D', 15.00, 'Lunas', 0, NULL, '2026-01-19 02:50:39', '2026-01-19 07:07:56'),
(52, 13, 18, 18, '2026-01-19', 1, 'ORD-696E231214331', 15.00, 'Lunas', 0, NULL, '2026-01-19 05:26:58', '2026-01-19 07:06:40'),
(53, 15, 18, 18, '2026-01-19', 1, 'ORD-696E376691A6B', 15.00, 'Lunas', 0, NULL, '2026-01-19 06:53:42', '2026-01-19 07:07:07'),
(54, 15, 2, 6, '2026-01-19', 1, 'ORD-696E39F897C9C', 7.00, 'Lunas', 0, NULL, '2026-01-19 07:04:40', '2026-01-19 07:07:33'),
(55, 15, 18, 18, '2026-01-19', 1, 'ORD-696E3DCAC20F0', 15.00, 'Lunas', 0, NULL, '2026-01-19 07:20:58', '2026-01-19 07:32:44'),
(56, 16, 18, 18, '2026-01-19', 1, 'ORD-696E404580738', 15.00, 'Lunas', 0, NULL, '2026-01-19 07:31:33', '2026-01-19 07:32:56'),
(57, 16, 16, 19, '2026-01-19', 1, 'ORD-696E40501E81E', 5.00, 'Lunas', 0, NULL, '2026-01-19 07:31:44', '2026-01-19 07:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('nnI7mcQimzS4exUiqSby7Eck9wKgoO9pAXBQjOEk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRHRwU1dVWjExbjRnWlRDdkdQZ21GWGRLc2pXeXBjNmNtVjA0TGUyMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2Jvb2tpbmcvOCI7fX0=', 1768016001);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_tiket`
--

CREATE TABLE `tipe_tiket` (
  `id_ticket_type` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipe_tiket`
--

INSERT INTO `tipe_tiket` (`id_ticket_type`, `event_id`, `nama`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(4, 9, 'reguler', 5.00, 24, '2025-12-28 01:53:05', '2026-01-18 04:09:05'),
(5, 3, 'reguler', 12.00, 21, '2026-01-04 07:17:59', '2026-01-18 04:08:51'),
(6, 2, 'reguler', 7.00, 10, '2026-01-04 19:31:05', '2026-01-18 02:21:48'),
(7, 4, 'reguler', 12.00, 32, '2026-01-04 19:31:29', '2026-01-18 04:08:36'),
(8, 5, 'reguler', 5.00, 30, '2026-01-04 19:31:44', '2026-01-18 04:08:24'),
(9, 6, 'reguler', 6.00, 20, '2026-01-04 19:32:04', '2026-01-18 04:08:14'),
(11, 8, 'reguler', 5.00, 40, '2026-01-04 19:33:15', '2026-01-18 04:08:05'),
(12, 8, 'vip', 10.00, 10, '2026-01-04 19:34:53', '2026-01-18 04:07:55'),
(13, 6, 'vip', 15.00, 10, '2026-01-04 19:39:24', '2026-01-18 04:07:44'),
(14, 10, 'reguler', 5.00, 30, '2026-01-12 06:32:40', '2026-01-18 04:07:27'),
(15, 11, 'reguler', 20.00, 90, '2026-01-12 06:36:27', '2026-01-18 02:31:29'),
(16, 12, 'reguler', 20.00, 20, '2026-01-12 06:41:29', '2026-01-18 02:22:57'),
(17, 10, 'reguler', 9.00, 10, '2026-01-18 02:22:37', '2026-01-18 02:22:37'),
(18, 18, 'reguler', 15.00, 12, '2026-01-18 04:58:50', '2026-01-18 04:58:50'),
(19, 16, 'reguler', 5.00, 16, '2026-01-18 04:59:13', '2026-01-18 04:59:13'),
(20, 15, 'reguler', 15.00, 20, '2026-01-18 04:59:42', '2026-01-19 07:33:54'),
(21, 19, 'booking', 0.00, 100, '2026-01-18 05:09:33', '2026-01-18 05:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `wisata_id` bigint UNSIGNED NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `jumlah_tiket` int NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `status` enum('pending','success','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `wisata_id`, `tanggal_kunjungan`, `jumlah_tiket`, `total_harga`, `status`, `snap_token`, `created_at`, `updated_at`) VALUES
(7, 1, 2, '2026-01-18', 2, 100000.00, 'pending', NULL, '2026-01-17 22:08:39', '2026-01-17 22:08:39'),
(8, 12, 2, '2026-01-21', 3, 150000.00, 'pending', NULL, '2026-01-17 22:47:45', '2026-01-17 22:47:45'),
(9, 12, 2, '2026-01-21', 3, 150000.00, 'pending', NULL, '2026-01-17 22:48:34', '2026-01-17 22:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Utama', 'admin@gmail.com', 'admin', '2025-12-06 21:56:36', '$2y$12$SO0Dl/TZKStHAwB7nUUhaOpK1yOjAdhR3MimyOxi9a.ctoVg1CUuK', NULL, '2025-12-06 21:56:36', '2025-12-28 00:29:45'),
(2, 'Pengguna Satu', 'user1@example.com', 'user', '2025-12-06 21:56:36', '$2y$12$FHGOP3uiZUiGskzV/HqwvOkQqSd1WoimUKvObieT1q/uHoCa4AJtO', NULL, '2025-12-06 21:56:36', '2025-12-06 21:56:36'),
(3, 'Pengguna Dua', 'user2@example.com', 'user', '2025-12-06 21:56:37', '$2y$12$laIw9qwTb3Tkl2cxB39rJOEFEyQ6F.37jpbead5lfBRKXiwemR7RC', NULL, '2025-12-06 21:56:37', '2025-12-06 21:56:37'),
(4, 'Admin', 'admin@example.com', 'user', NULL, '$2y$12$vk8ZfdQugTwEVstBwL8MMOnoKO.H8doHz8lbp9BWW.vR659cbR5i.', NULL, '2025-12-09 05:40:05', '2025-12-09 05:40:05'),
(5, 'Admin Tiket', 'admin@tiketasyikk.com', 'user', NULL, '$2y$12$QsiQQAIh0uz9Gvb/b9EC2uuwae20eowFLV2RYeSiskGCZs8ri3Yh.', NULL, '2025-12-09 05:48:28', '2025-12-09 05:48:28'),
(8, 'ririz', 'ririz@gmail.com', 'user', NULL, '$2y$12$piapU8UQSM7LF6u.N7NX3OivLAjls7OhpQkUveX2A7iPonYW37S7i', NULL, '2026-01-14 06:39:58', '2026-01-14 06:39:58'),
(9, 'atin', 'atin@gmail.com', 'user', NULL, '$2y$12$AW.d3ytkqTFxax9dkOmKCucM7Mx/zk0lIeci7BNpRs/5Xe.w36qA6', NULL, '2026-01-14 06:45:24', '2026-01-14 06:45:24'),
(10, 'faiq', 'faiq@gmail.com', 'user', NULL, '$2y$12$xg3Pf8llr.JrOmrUYCqiZuUPGx3iSLMtBzJaTZwz/6WRI2P72o40O', NULL, '2026-01-15 20:21:05', '2026-01-15 20:21:05'),
(11, 'lila', 'lila@gmail.com', 'user', NULL, '$2y$12$GKL1OiAUf9.ge5rDgH.2VutJqkLIfVjZk.i3atyNViKsCGgwCPI/e', NULL, '2026-01-15 21:16:32', '2026-01-15 21:16:32'),
(12, 'dafi', 'dafi@gmail.com', 'user', NULL, '$2y$12$B.dJG8fpnzNYvaUVEKKqTOP9BY8jPyX0xj/tl.TC01MXX/sco5EQm', NULL, '2026-01-17 22:15:16', '2026-01-17 22:15:16'),
(13, 'kia', 'kia@gmail.com', 'user', NULL, '$2y$12$cebLDFEV55kAchb2tmQpLuu7x9RP4iAKzIFfS8KmWUx1cJhGvoW.e', NULL, '2026-01-18 04:27:50', '2026-01-18 04:27:50'),
(14, 'atin', 'atin1@gmail.com', 'user', NULL, '$2y$12$0P5oIJwitvJdJ/gRONNmw.4q/nmvr0QivHY6pFYSm8QaVAO2VX30e', NULL, '2026-01-18 20:54:19', '2026-01-18 20:54:19'),
(15, 'lia', 'lia@gmail.com', 'user', NULL, '$2y$12$LaimQikli8YtF0XXeq9As.lKRanSoYpq2r0NTAHIoXtfDp1geQ39G', NULL, '2026-01-19 06:50:27', '2026-01-19 06:50:27'),
(16, 'harianto', 'harianto@gmail.com', 'user', NULL, '$2y$12$9T0ALEmjf4aHb.6NSXKVqeS/n4T1pf7zTDrGhXBGKQgropiKxovMm', NULL, '2026-01-19 07:31:23', '2026-01-19 07:31:23'),
(17, 'isa', 'isa@gmail.com', 'user', NULL, '$2y$12$u2lergTJPRIcSF7k0iyRDOBqDXLkcBYYB6kBYkOisalLbKjcKNmbq', NULL, '2026-01-19 07:36:24', '2026-01-19 07:36:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acara`
--
ALTER TABLE `acara`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `acara_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `item_pesanan`
--
ALTER TABLE `item_pesanan`
  ADD PRIMARY KEY (`id_item_pesanan`),
  ADD UNIQUE KEY `item_pesanan_kode_tiket_unique` (`kode_tiket`),
  ADD KEY `item_pesanan_order_id_foreign` (`order_id`),
  ADD KEY `item_pesanan_ticket_type_id_foreign` (`ticket_type_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_pesanan_id_foreign` (`pesanan_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD UNIQUE KEY `pesanan_kode_pesanan_unique` (`kode_pesanan`),
  ADD KEY `pesanan_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tipe_tiket`
--
ALTER TABLE `tipe_tiket`
  ADD PRIMARY KEY (`id_ticket_type`),
  ADD KEY `tipe_tiket_event_id_foreign` (`event_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_wisata_id_foreign` (`wisata_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acara`
--
ALTER TABLE `acara`
  MODIFY `id_event` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_pesanan`
--
ALTER TABLE `item_pesanan`
  MODIFY `id_item_pesanan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tipe_tiket`
--
ALTER TABLE `tipe_tiket`
  MODIFY `id_ticket_type` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acara`
--
ALTER TABLE `acara`
  ADD CONSTRAINT `acara_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_pesanan`
--
ALTER TABLE `item_pesanan`
  ADD CONSTRAINT `item_pesanan_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_pesanan_ticket_type_id_foreign` FOREIGN KEY (`ticket_type_id`) REFERENCES `tipe_tiket` (`id_ticket_type`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tipe_tiket`
--
ALTER TABLE `tipe_tiket`
  ADD CONSTRAINT `tipe_tiket_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `acara` (`id_event`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_wisata_id_foreign` FOREIGN KEY (`wisata_id`) REFERENCES `acara` (`id_event`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
