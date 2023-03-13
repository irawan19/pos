-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2023 at 05:07 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

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
-- Table structure for table `master_akses`
--

CREATE TABLE `master_akses` (
  `id_akses` int UNSIGNED NOT NULL,
  `level_sistems_id` int UNSIGNED NOT NULL,
  `fiturs_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_akses`
--

INSERT INTO `master_akses` (`id_akses`, `level_sistems_id`, `fiturs_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2023-03-12 19:00:53', NULL, NULL),
(2, 1, 2, '2023-03-12 19:00:53', NULL, NULL),
(3, 1, 3, '2023-03-12 19:00:53', NULL, NULL),
(4, 1, 4, '2023-03-12 19:00:53', NULL, NULL),
(5, 1, 5, '2023-03-12 19:00:53', NULL, NULL),
(6, 1, 6, '2023-03-12 19:00:53', NULL, NULL),
(7, 1, 7, '2023-03-12 19:00:53', NULL, NULL),
(8, 1, 8, '2023-03-12 19:00:53', NULL, NULL),
(9, 1, 9, '2023-03-12 19:00:53', NULL, NULL),
(10, 1, 10, '2023-03-12 19:00:53', NULL, NULL),
(11, 1, 11, '2023-03-12 19:00:53', NULL, NULL),
(12, 1, 12, '2023-03-12 19:00:53', NULL, NULL),
(13, 1, 13, '2023-03-12 19:00:53', NULL, NULL),
(14, 1, 14, '2023-03-12 19:00:53', NULL, NULL),
(15, 1, 15, '2023-03-12 19:00:53', NULL, NULL),
(16, 1, 16, '2023-03-12 19:00:53', NULL, NULL),
(17, 1, 17, '2023-03-12 19:00:53', NULL, NULL),
(18, 1, 18, '2023-03-12 19:00:53', NULL, NULL),
(19, 1, 19, '2023-03-12 19:00:53', NULL, NULL),
(20, 1, 20, '2023-03-12 19:00:53', NULL, NULL),
(21, 1, 21, '2023-03-12 19:00:53', NULL, NULL),
(22, 1, 22, '2023-03-12 19:00:53', NULL, NULL),
(23, 1, 23, '2023-03-12 19:00:53', NULL, NULL),
(24, 1, 24, '2023-03-12 19:00:53', NULL, NULL),
(25, 1, 25, '2023-03-12 19:00:53', NULL, NULL),
(26, 1, 26, '2023-03-12 19:00:53', NULL, NULL),
(27, 1, 27, '2023-03-12 19:00:53', NULL, NULL),
(28, 1, 28, '2023-03-12 19:00:53', NULL, NULL),
(29, 1, 29, '2023-03-12 19:00:53', NULL, NULL),
(30, 1, 30, '2023-03-12 19:00:53', NULL, NULL),
(31, 1, 31, '2023-03-12 19:00:53', NULL, NULL),
(32, 1, 32, '2023-03-12 19:00:53', NULL, NULL),
(33, 1, 33, '2023-03-12 19:00:53', NULL, NULL),
(34, 1, 34, '2023-03-12 19:00:53', NULL, NULL),
(35, 1, 35, '2023-03-12 19:00:53', NULL, NULL),
(36, 1, 36, '2023-03-12 19:00:53', NULL, NULL),
(37, 1, 37, '2023-03-12 19:00:53', NULL, NULL),
(38, 1, 38, '2023-03-12 19:00:53', NULL, NULL),
(39, 1, 39, '2023-03-12 19:00:53', NULL, NULL),
(40, 1, 40, '2023-03-12 19:00:53', NULL, NULL),
(41, 1, 41, '2023-03-12 19:00:53', NULL, NULL),
(42, 1, 42, '2023-03-12 19:00:53', NULL, NULL),
(43, 1, 43, '2023-03-12 19:00:53', NULL, NULL),
(44, 1, 44, '2023-03-12 19:00:53', NULL, NULL),
(45, 1, 45, '2023-03-12 19:00:53', NULL, NULL),
(46, 1, 46, '2023-03-12 19:00:53', NULL, NULL),
(47, 1, 47, '2023-03-12 19:00:53', NULL, NULL),
(48, 1, 48, '2023-03-12 19:00:53', NULL, NULL),
(49, 1, 49, '2023-03-12 19:00:53', NULL, NULL),
(50, 1, 50, '2023-03-12 19:00:53', NULL, NULL),
(51, 1, 51, '2023-03-12 19:00:53', NULL, NULL),
(52, 1, 52, '2023-03-12 19:00:53', NULL, NULL),
(53, 1, 53, '2023-03-12 19:00:53', NULL, NULL),
(54, 1, 54, '2023-03-12 19:00:53', NULL, NULL),
(55, 1, 55, '2023-03-12 19:00:53', NULL, NULL),
(56, 1, 56, '2023-03-12 19:00:53', NULL, NULL),
(57, 1, 57, '2023-03-12 19:00:53', NULL, NULL),
(58, 1, 58, '2023-03-12 19:00:53', NULL, NULL),
(59, 1, 59, '2023-03-12 19:00:53', NULL, NULL),
(60, 1, 60, '2023-03-12 19:00:53', NULL, NULL),
(61, 1, 61, '2023-03-12 19:00:53', NULL, NULL),
(62, 1, 62, '2023-03-12 19:00:53', NULL, NULL),
(63, 1, 63, '2023-03-12 19:00:53', NULL, NULL),
(64, 1, 64, '2023-03-12 19:00:53', NULL, NULL),
(65, 1, 65, '2023-03-12 19:00:53', NULL, NULL),
(66, 1, 66, '2023-03-12 19:00:53', NULL, NULL),
(67, 1, 67, '2023-03-12 19:00:53', NULL, NULL),
(68, 1, 68, '2023-03-12 19:00:53', NULL, NULL),
(69, 1, 69, '2023-03-12 19:00:53', NULL, NULL),
(70, 1, 70, '2023-03-12 19:00:53', NULL, NULL),
(71, 1, 71, '2023-03-12 19:00:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_customers`
--

CREATE TABLE `master_customers` (
  `id_customers` int UNSIGNED NOT NULL,
  `tokos_id` int UNSIGNED DEFAULT NULL,
  `nama_customers` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_fiturs`
--

CREATE TABLE `master_fiturs` (
  `id_fiturs` int UNSIGNED NOT NULL,
  `menus_id` int UNSIGNED NOT NULL,
  `nama_fiturs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_fiturs`
--

INSERT INTO `master_fiturs` (`id_fiturs`, `menus_id`, `nama_fiturs`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'lihat', '2023-03-12 18:43:04', NULL, NULL),
(2, 2, 'lihat', '2023-03-12 18:43:59', NULL, NULL),
(3, 2, 'baca', '2023-03-12 18:44:14', NULL, NULL),
(4, 2, 'tambah', '2023-03-12 18:44:14', NULL, NULL),
(5, 2, 'edit', '2023-03-12 18:44:14', NULL, NULL),
(6, 2, 'hapus', '2023-03-12 18:44:14', NULL, NULL),
(7, 3, 'lihat', '2023-03-12 18:44:50', NULL, NULL),
(8, 3, 'baca', '2023-03-12 18:44:50', NULL, NULL),
(9, 3, 'tambah', '2023-03-12 18:44:50', NULL, NULL),
(10, 3, 'edit', '2023-03-12 18:44:50', NULL, NULL),
(11, 3, 'hapus', '2023-03-12 18:44:50', NULL, NULL),
(12, 4, 'lihat', '2023-03-12 18:45:52', NULL, NULL),
(13, 4, 'baca', '2023-03-12 18:45:52', NULL, NULL),
(14, 4, 'tambah', '2023-03-12 18:45:52', NULL, NULL),
(15, 4, 'edit', '2023-03-12 18:45:52', NULL, NULL),
(16, 4, 'hapus', '2023-03-12 18:45:52', NULL, NULL),
(17, 5, 'lihat', '2023-03-12 18:45:52', NULL, NULL),
(18, 6, 'lihat', '2023-03-12 18:45:52', NULL, NULL),
(19, 7, 'lihat', '2023-03-12 18:45:52', NULL, NULL),
(20, 7, 'tambah', '2023-03-12 18:45:52', NULL, NULL),
(21, 7, 'edit', '2023-03-12 18:45:52', NULL, NULL),
(22, 7, 'hapus', '2023-03-12 18:45:52', NULL, NULL),
(23, 8, 'lihat', '2023-03-12 18:45:52', NULL, NULL),
(24, 8, 'tambah', '2023-03-12 18:45:52', NULL, NULL),
(25, 8, 'edit', '2023-03-12 18:45:52', NULL, NULL),
(26, 8, 'hapus', '2023-03-12 18:45:52', NULL, NULL),
(27, 9, 'lihat', '2023-03-12 18:48:21', NULL, NULL),
(28, 9, 'tambah', '2023-03-12 18:48:21', NULL, NULL),
(29, 9, 'edit', '2023-03-12 18:48:21', NULL, NULL),
(30, 9, 'hapus', '2023-03-12 18:48:21', NULL, NULL),
(31, 10, 'lihat', '2023-03-12 18:48:21', NULL, NULL),
(32, 10, 'baca', '2023-03-12 18:48:21', NULL, NULL),
(33, 10, 'tambah', '2023-03-12 18:48:21', NULL, NULL),
(34, 10, 'edit', '2023-03-12 18:48:21', NULL, NULL),
(35, 10, 'hapus', '2023-03-12 18:48:21', NULL, NULL),
(36, 11, 'lihat', '2023-03-12 18:48:21', NULL, NULL),
(37, 12, 'lihat', '2023-03-12 18:48:21', NULL, NULL),
(38, 12, 'tambah', '2023-03-12 18:48:21', NULL, NULL),
(39, 12, 'edit', '2023-03-12 18:48:21', NULL, NULL),
(40, 12, 'hapus', '2023-03-12 18:48:21', NULL, NULL),
(41, 13, 'lihat', '2023-03-12 18:48:21', NULL, NULL),
(42, 13, 'tambah', '2023-03-12 18:48:21', NULL, NULL),
(43, 13, 'edit', '2023-03-12 18:48:21', NULL, NULL),
(44, 13, 'hapus', '2023-03-12 18:48:21', NULL, NULL),
(45, 14, 'lihat', '2023-03-12 18:48:21', NULL, NULL),
(46, 14, 'baca', '2023-03-12 18:48:21', NULL, NULL),
(47, 14, 'tambah', '2023-03-12 18:48:21', NULL, NULL),
(48, 14, 'edit', '2023-03-12 18:48:21', NULL, NULL),
(49, 14, 'hapus', '2023-03-12 18:48:21', NULL, NULL),
(50, 15, 'lihat', '2023-03-12 18:48:21', NULL, NULL),
(51, 15, 'baca', '2023-03-12 18:48:21', NULL, NULL),
(52, 15, 'tambah', '2023-03-12 18:48:21', NULL, NULL),
(53, 15, 'edit', '2023-03-12 18:48:21', NULL, NULL),
(54, 15, 'hapus', '2023-03-12 18:48:21', NULL, NULL),
(55, 16, 'lihat', '2023-03-12 18:48:21', NULL, NULL),
(56, 17, 'lihat', '2023-03-12 18:48:21', NULL, NULL),
(57, 17, 'baca', '2023-03-12 18:52:03', NULL, NULL),
(58, 17, 'cetak', '2023-03-12 18:48:21', NULL, NULL),
(59, 18, 'lihat', '2023-03-12 18:48:21', NULL, NULL),
(60, 18, 'baca', NULL, NULL, NULL),
(61, 18, 'cetak', '2023-03-12 18:48:21', NULL, NULL),
(62, 19, 'lihat', '2023-03-12 18:48:21', NULL, NULL),
(63, 19, 'baca', '2023-03-12 18:48:21', NULL, NULL),
(64, 19, 'cetak', '2023-03-12 18:48:21', NULL, NULL),
(65, 20, 'lihat', '2023-03-12 18:48:21', NULL, NULL),
(66, 20, 'baca', '2023-03-12 18:48:21', NULL, NULL),
(67, 20, 'cetak', '2023-03-12 18:48:21', NULL, NULL),
(68, 21, 'lihat', '2023-03-12 18:53:51', NULL, NULL),
(69, 21, 'tambah', '2023-03-12 18:53:51', NULL, NULL),
(70, 21, 'edit', '2023-03-12 18:53:51', NULL, NULL),
(71, 21, 'hapus', '2023-03-12 18:53:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_items`
--

CREATE TABLE `master_items` (
  `id_items` int UNSIGNED NOT NULL,
  `tokos_id` int UNSIGNED NOT NULL,
  `kategori_items_id` int UNSIGNED NOT NULL,
  `satuans_id` int UNSIGNED NOT NULL,
  `kode_items` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_items` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_items` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_items` double NOT NULL,
  `deskripsi_items` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_items` double NOT NULL,
  `stok_awal_items` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_kategori_items`
--

CREATE TABLE `master_kategori_items` (
  `id_kategori_items` int UNSIGNED NOT NULL,
  `nama_kategori_items` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_kategori_items`
--

INSERT INTO `master_kategori_items` (`id_kategori_items`, `nama_kategori_items`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mouse', '2023-03-12 17:52:07', NULL, NULL),
(2, 'Memory', '2023-03-12 17:52:07', NULL, NULL),
(3, 'Hardisk', '2023-03-12 17:52:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_konfigurasi_aplikasis`
--

CREATE TABLE `master_konfigurasi_aplikasis` (
  `id_konfigurasi_aplikasis` int UNSIGNED NOT NULL,
  `nama_konfigurasi_aplikasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_konfigurasi_aplikasis` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords_konfigurasi_aplikasis` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_konfigurasi_aplikasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_konfigurasi_aplikasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_text_konfigurasi_aplikasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background_website_konfigurasi_aplikasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_konfigurasi_aplikasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_konfigurasi_aplikasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram_konfigurasi_aplikasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_konfigurasi_aplikasis` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_konfigurasi_aplikasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon_konfigurasi_aplikasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_konfigurasi_aplikasis`
--

INSERT INTO `master_konfigurasi_aplikasis` (`id_konfigurasi_aplikasis`, `nama_konfigurasi_aplikasis`, `deskripsi_konfigurasi_aplikasis`, `keywords_konfigurasi_aplikasis`, `icon_konfigurasi_aplikasis`, `logo_konfigurasi_aplikasis`, `logo_text_konfigurasi_aplikasis`, `background_website_konfigurasi_aplikasis`, `facebook_konfigurasi_aplikasis`, `twitter_konfigurasi_aplikasis`, `instagram_konfigurasi_aplikasis`, `alamat_konfigurasi_aplikasis`, `email_konfigurasi_aplikasis`, `telepon_konfigurasi_aplikasis`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bae POS', 'Bae Point Of Sales', 'Bae, Computer, Bae Computer, POS, Point Of Sales, Bae POS, Bae Point Of Sales, Bae Computer', 'logo/icon.png', 'logo/logo.png', 'logo/logotext.png', 'logo/20230307232409bg.jpg', '', '', '', 'Jl. Lkr. Utara, Bacin, Kec. Bae, Kabupaten Kudus, Jawa Tengah 59325', 'info@baecomputer.com', '085643167946', '2023-03-12 17:46:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_level_sistems`
--

CREATE TABLE `master_level_sistems` (
  `id_level_sistems` int UNSIGNED NOT NULL,
  `nama_level_sistems` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_level_sistems`
--

INSERT INTO `master_level_sistems` (`id_level_sistems`, `nama_level_sistems`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Administrator', '2023-03-12 17:45:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_menus`
--

CREATE TABLE `master_menus` (
  `id_menus` int UNSIGNED NOT NULL,
  `menus_id` int UNSIGNED DEFAULT NULL,
  `nama_menus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_menus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_menus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_menus` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_menus`
--

INSERT INTO `master_menus` (`id_menus`, `menus_id`, `nama_menus`, `icon_menus`, `link_menus`, `order_menus`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Konfigurasi Dashboard', 'cil-settings', '', 4, '2023-03-12 17:54:12', NULL, NULL),
(2, 1, 'Menu', 'cil-border-all', 'menu', 1, '2023-03-12 17:56:01', NULL, NULL),
(3, 1, 'Level Sistem', 'cil-lan', 'level_sistem', 2, '2023-03-12 17:56:01', NULL, NULL),
(4, 1, 'Admin', 'cil-user', 'admin', 3, '2023-03-12 17:56:01', NULL, NULL),
(5, 1, 'Konfigurasi Aplikasi', 'cil-applications-settings', 'konfigurasi_aplikasi', 4, '2023-03-12 17:56:01', NULL, NULL),
(6, NULL, 'Master Data', 'cil-layers', '', 1, '2023-03-12 17:58:46', NULL, NULL),
(7, 6, 'Toko', 'cil-home', 'toko', 1, '2023-03-12 17:59:30', NULL, NULL),
(8, 6, 'Satuan', 'cil-3d', 'satuan', 2, '2023-03-12 17:59:30', NULL, NULL),
(9, 6, 'Kategori Item', 'cil-tags', 'kategori_item', 3, '2023-03-12 18:00:10', NULL, NULL),
(10, 6, 'Item', 'cil-list-rich', 'item', 4, '2023-03-12 18:00:10', NULL, NULL),
(11, NULL, 'Transaksi', 'cil-cart', 'transaksi', 2, '2023-03-12 18:00:53', NULL, NULL),
(12, 11, 'Customer', 'cil-user', 'customer', 1, '2023-03-12 18:01:20', NULL, NULL),
(13, 11, 'Supplier', 'cil-user', 'supplier', 2, '2023-03-12 18:01:20', NULL, NULL),
(14, 11, 'Penjualan', 'cil-monitor', 'penjualan', 3, '2023-03-12 18:02:12', NULL, NULL),
(15, 11, 'Pembelian', 'cil-cart', 'pembelian', 4, '2023-03-12 18:02:12', NULL, NULL),
(16, NULL, 'Laporan', 'cil-chart', '', 3, '2023-03-12 18:03:01', NULL, NULL),
(17, 16, 'Penjualan', 'cil-chart', 'laporan_penjualan', 1, '2023-03-12 18:05:40', NULL, NULL),
(18, 16, 'Pembelian', 'cil-chart-line', 'laporan_pembelian', 2, '2023-03-12 18:05:40', NULL, NULL),
(19, 16, 'Stok', 'cil-file', 'laporan_stok', 3, '2023-03-12 18:06:50', NULL, NULL),
(20, 16, 'Keuangan', 'cil-money', 'laporan_keuangan', 4, '2023-03-12 18:06:50', NULL, NULL),
(21, 6, 'Pembayaran', 'cil-money', 'pembayaran', 5, '2023-03-12 18:19:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_pembayarans`
--

CREATE TABLE `master_pembayarans` (
  `id_pembayarans` int UNSIGNED NOT NULL,
  `tokos_id` int UNSIGNED DEFAULT NULL,
  `nama_pembayarans` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `akun_pembayarans` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening_pembayarans` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_pembayarans`
--

INSERT INTO `master_pembayarans` (`id_pembayarans`, `tokos_id`, `nama_pembayarans`, `akun_pembayarans`, `no_rekening_pembayarans`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Tunai', '', '', '2023-03-12 17:53:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_pesans`
--

CREATE TABLE `master_pesans` (
  `id_pesans` bigint UNSIGNED NOT NULL,
  `nama_pesans` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_pesans` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon_pesans` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten_pesans` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_baca_pesans` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_satuans`
--

CREATE TABLE `master_satuans` (
  `id_satuans` int UNSIGNED NOT NULL,
  `nama_satuans` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_satuans`
--

INSERT INTO `master_satuans` (`id_satuans`, `nama_satuans`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'pcs', '2023-03-12 17:52:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_suppliers`
--

CREATE TABLE `master_suppliers` (
  `id_suppliers` int UNSIGNED NOT NULL,
  `tokos_id` int UNSIGNED DEFAULT NULL,
  `nama_suppliers` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_tokos`
--

CREATE TABLE `master_tokos` (
  `id_tokos` int UNSIGNED NOT NULL,
  `nama_tokos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_tokos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_tokos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_tokos`
--

INSERT INTO `master_tokos` (`id_tokos`, `nama_tokos`, `logo_tokos`, `alamat_tokos`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bae Computer', 'logo/logo.png', ' Jl. Lkr. Utara, Bacin, Kec. Bae, Kabupaten Kudus, Jawa Tengah 59325', '2023-03-12 17:51:44', NULL, NULL);

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
(1, '2014_10_00_000000_create_master_level_sistems_table', 1),
(2, '2014_10_01_000000_create_master_tokos_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(5, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2020_05_21_100000_create_teams_table', 1),
(9, '2020_05_21_200000_create_team_user_table', 1),
(10, '2020_05_21_300000_create_team_invitations_table', 1),
(11, '2023_03_04_122808_create_sessions_table', 1),
(12, '2023_03_04_142120_create_master_konfigurasi_aplikasis_table', 1),
(13, '2023_03_04_142128_create_master_menus_table', 1),
(14, '2023_03_04_142135_create_master_fiturs_table', 1),
(15, '2023_03_04_142142_create_master_akses_table', 1),
(16, '2023_03_07_101754_create_master_satuans_table', 1),
(17, '2023_03_07_102551_create_master_kategori_items_table', 1),
(18, '2023_03_07_102556_create_master_items_table', 1),
(19, '2023_03_07_234945_create_master_pesans_table', 1),
(20, '2023_03_08_175429_create_master_customers_table', 1),
(21, '2023_03_08_175438_create_master_suppliers_table', 1),
(22, '2023_03_08_190512_create_master_pembayarans_table', 1),
(23, '2023_03_08_190529_create_transaksi_penjualans_table', 1),
(24, '2023_03_08_190532_create_transaksi_penjualan_details_table', 1),
(25, '2023_03_08_190538_create_transaksi_pembelians_table', 1),
(26, '2023_03_08_190542_create_transaksi_pembelian_details_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('7eNdWgmYiE0esrhBTLL1yGdbR8adXfYt5pPNNzNg', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoidkdyTGgxeWdvUmFmMVhQSWNGdXZTTkdHdDJXSk9BS0ZsTWJWVEp5aSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvZGFzaGJvYXJkL3NhdHVhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkMWQxcDRjTldhZ1lJTFlqQXg5dmthLjFvbmo2ZmcvOWM2RUZzYWhDczY0aU9xRkJNblZNTGUiO3M6NzoiaGFsYW1hbiI7czozODoiaHR0cDovLzEyNy4wLjAuMTo4MDAxL2Rhc2hib2FyZC9zYXR1YW4iO30=', 1678647947),
('arkLzsYI5ofuaTkP8mTV4fUA3cKZGLD9assttDFo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaExnN3BVTllIWUVnUFNUSThBbXFkdFlJQVd5czRUcWVNYUUxZHMwUSI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkMWQxcDRjTldhZ1lJTFlqQXg5dmthLjFvbmo2ZmcvOWM2RUZzYWhDczY0aU9xRkJNblZNTGUiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1678644489),
('J4QUJ3vShp1B4vGAoyqCFrNOn0kXidRO7e5Elr5Q', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTNOWjFXaTZqUkJQdG5zNXRCdWVJeDRBWU43Uk9vSzNXaGpra1VlZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9sb2NhbGhvc3QvcG9zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1678649866);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_invitations`
--

CREATE TABLE `team_invitations` (
  `id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pembelians`
--

CREATE TABLE `transaksi_pembelians` (
  `id_pembelians` int UNSIGNED NOT NULL,
  `tokos_id` int UNSIGNED DEFAULT NULL,
  `suppliers_id` int UNSIGNED DEFAULT NULL,
  `pembayarans_id` int UNSIGNED DEFAULT NULL,
  `users_id` bigint UNSIGNED DEFAULT NULL,
  `no_pembelians` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referensi_no_nota_pembelians` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pembelians` datetime NOT NULL,
  `keterangan_pembelians` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total_pembelians` double NOT NULL,
  `diskon_pembelians` double NOT NULL,
  `pajak_pembelians` double NOT NULL,
  `total_pembelians` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pembelian_details`
--

CREATE TABLE `transaksi_pembelian_details` (
  `id_transaksi_pembelian_details` int UNSIGNED NOT NULL,
  `pembelians_id` int UNSIGNED DEFAULT NULL,
  `items_id` int UNSIGNED DEFAULT NULL,
  `jumlah_pembelian_details` double NOT NULL,
  `harga_pembelian_details` double NOT NULL,
  `total_pembelian_details` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualans`
--

CREATE TABLE `transaksi_penjualans` (
  `id_penjualans` int UNSIGNED NOT NULL,
  `tokos_id` int UNSIGNED DEFAULT NULL,
  `customers_id` int UNSIGNED DEFAULT NULL,
  `pembayarans_id` int UNSIGNED DEFAULT NULL,
  `users_id` bigint UNSIGNED DEFAULT NULL,
  `no_penjualans` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_penjualans` datetime NOT NULL,
  `keterangan_penjualans` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total_penjualans` double NOT NULL,
  `diskon_penjualans` double NOT NULL,
  `pajak_penjualans` double NOT NULL,
  `total_penjualans` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan_details`
--

CREATE TABLE `transaksi_penjualan_details` (
  `id_transaksi_penjualan_details` int UNSIGNED NOT NULL,
  `penjualans_id` int UNSIGNED DEFAULT NULL,
  `items_id` int UNSIGNED DEFAULT NULL,
  `jumlah_penjualan_details` double NOT NULL,
  `harga_penjualan_details` double NOT NULL,
  `total_penjualan_details` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `level_sistems_id` int UNSIGNED DEFAULT NULL,
  `tokos_id` int UNSIGNED DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `level_sistems_id`, `tokos_id`, `username`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'superadmin', 'Super Administrator', 'superadmin@baecomputer.com', NULL, '$2y$10$1d1p4cNWagYILYjAx9vka.1onj6fg/9c6EFsahCs64iOqFBMnVMLe', NULL, NULL, NULL, '', NULL, NULL, '2023-03-12 17:50:06', '2023-03-12 18:08:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `master_akses`
--
ALTER TABLE `master_akses`
  ADD PRIMARY KEY (`id_akses`),
  ADD KEY `master_akses_level_sistems_id_index` (`level_sistems_id`),
  ADD KEY `master_akses_fiturs_id_index` (`fiturs_id`);

--
-- Indexes for table `master_customers`
--
ALTER TABLE `master_customers`
  ADD PRIMARY KEY (`id_customers`),
  ADD KEY `master_customers_tokos_id_index` (`tokos_id`);

--
-- Indexes for table `master_fiturs`
--
ALTER TABLE `master_fiturs`
  ADD PRIMARY KEY (`id_fiturs`),
  ADD KEY `master_fiturs_menus_id_index` (`menus_id`);

--
-- Indexes for table `master_items`
--
ALTER TABLE `master_items`
  ADD PRIMARY KEY (`id_items`),
  ADD KEY `master_items_tokos_id_index` (`tokos_id`),
  ADD KEY `master_items_kategori_items_id_index` (`kategori_items_id`),
  ADD KEY `master_items_satuans_id_index` (`satuans_id`);

--
-- Indexes for table `master_kategori_items`
--
ALTER TABLE `master_kategori_items`
  ADD PRIMARY KEY (`id_kategori_items`);

--
-- Indexes for table `master_konfigurasi_aplikasis`
--
ALTER TABLE `master_konfigurasi_aplikasis`
  ADD PRIMARY KEY (`id_konfigurasi_aplikasis`);

--
-- Indexes for table `master_level_sistems`
--
ALTER TABLE `master_level_sistems`
  ADD PRIMARY KEY (`id_level_sistems`);

--
-- Indexes for table `master_menus`
--
ALTER TABLE `master_menus`
  ADD PRIMARY KEY (`id_menus`),
  ADD KEY `master_menus_menus_id_index` (`menus_id`);

--
-- Indexes for table `master_pembayarans`
--
ALTER TABLE `master_pembayarans`
  ADD PRIMARY KEY (`id_pembayarans`),
  ADD KEY `master_pembayarans_tokos_id_index` (`tokos_id`);

--
-- Indexes for table `master_pesans`
--
ALTER TABLE `master_pesans`
  ADD PRIMARY KEY (`id_pesans`);

--
-- Indexes for table `master_satuans`
--
ALTER TABLE `master_satuans`
  ADD PRIMARY KEY (`id_satuans`);

--
-- Indexes for table `master_suppliers`
--
ALTER TABLE `master_suppliers`
  ADD PRIMARY KEY (`id_suppliers`),
  ADD KEY `master_suppliers_tokos_id_index` (`tokos_id`);

--
-- Indexes for table `master_tokos`
--
ALTER TABLE `master_tokos`
  ADD PRIMARY KEY (`id_tokos`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Indexes for table `transaksi_pembelians`
--
ALTER TABLE `transaksi_pembelians`
  ADD PRIMARY KEY (`id_pembelians`),
  ADD KEY `transaksi_pembelians_tokos_id_index` (`tokos_id`),
  ADD KEY `transaksi_pembelians_suppliers_id_index` (`suppliers_id`),
  ADD KEY `transaksi_pembelians_pembayarans_id_index` (`pembayarans_id`),
  ADD KEY `transaksi_pembelians_users_id_index` (`users_id`);

--
-- Indexes for table `transaksi_pembelian_details`
--
ALTER TABLE `transaksi_pembelian_details`
  ADD PRIMARY KEY (`id_transaksi_pembelian_details`),
  ADD KEY `transaksi_pembelian_details_pembelians_id_index` (`pembelians_id`),
  ADD KEY `transaksi_pembelian_details_items_id_index` (`items_id`);

--
-- Indexes for table `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  ADD PRIMARY KEY (`id_penjualans`),
  ADD KEY `transaksi_penjualans_tokos_id_index` (`tokos_id`),
  ADD KEY `transaksi_penjualans_customers_id_index` (`customers_id`),
  ADD KEY `transaksi_penjualans_pembayarans_id_index` (`pembayarans_id`),
  ADD KEY `transaksi_penjualans_users_id_index` (`users_id`);

--
-- Indexes for table `transaksi_penjualan_details`
--
ALTER TABLE `transaksi_penjualan_details`
  ADD PRIMARY KEY (`id_transaksi_penjualan_details`),
  ADD KEY `transaksi_penjualan_details_penjualans_id_index` (`penjualans_id`),
  ADD KEY `transaksi_penjualan_details_items_id_index` (`items_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_level_sistems_id_index` (`level_sistems_id`),
  ADD KEY `users_tokos_id_index` (`tokos_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_akses`
--
ALTER TABLE `master_akses`
  MODIFY `id_akses` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `master_customers`
--
ALTER TABLE `master_customers`
  MODIFY `id_customers` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_fiturs`
--
ALTER TABLE `master_fiturs`
  MODIFY `id_fiturs` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `master_items`
--
ALTER TABLE `master_items`
  MODIFY `id_items` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_kategori_items`
--
ALTER TABLE `master_kategori_items`
  MODIFY `id_kategori_items` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_konfigurasi_aplikasis`
--
ALTER TABLE `master_konfigurasi_aplikasis`
  MODIFY `id_konfigurasi_aplikasis` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_level_sistems`
--
ALTER TABLE `master_level_sistems`
  MODIFY `id_level_sistems` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_menus`
--
ALTER TABLE `master_menus`
  MODIFY `id_menus` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `master_pembayarans`
--
ALTER TABLE `master_pembayarans`
  MODIFY `id_pembayarans` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_pesans`
--
ALTER TABLE `master_pesans`
  MODIFY `id_pesans` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_satuans`
--
ALTER TABLE `master_satuans`
  MODIFY `id_satuans` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_suppliers`
--
ALTER TABLE `master_suppliers`
  MODIFY `id_suppliers` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_tokos`
--
ALTER TABLE `master_tokos`
  MODIFY `id_tokos` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_pembelians`
--
ALTER TABLE `transaksi_pembelians`
  MODIFY `id_pembelians` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_pembelian_details`
--
ALTER TABLE `transaksi_pembelian_details`
  MODIFY `id_transaksi_pembelian_details` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  MODIFY `id_penjualans` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_penjualan_details`
--
ALTER TABLE `transaksi_penjualan_details`
  MODIFY `id_transaksi_penjualan_details` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_akses`
--
ALTER TABLE `master_akses`
  ADD CONSTRAINT `master_akses_fiturs_id_foreign` FOREIGN KEY (`fiturs_id`) REFERENCES `master_fiturs` (`id_fiturs`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `master_akses_level_sistems_id_foreign` FOREIGN KEY (`level_sistems_id`) REFERENCES `master_level_sistems` (`id_level_sistems`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_customers`
--
ALTER TABLE `master_customers`
  ADD CONSTRAINT `master_customers_tokos_id_foreign` FOREIGN KEY (`tokos_id`) REFERENCES `master_tokos` (`id_tokos`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `master_fiturs`
--
ALTER TABLE `master_fiturs`
  ADD CONSTRAINT `master_fiturs_menus_id_foreign` FOREIGN KEY (`menus_id`) REFERENCES `master_menus` (`id_menus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_items`
--
ALTER TABLE `master_items`
  ADD CONSTRAINT `master_items_kategori_items_id_foreign` FOREIGN KEY (`kategori_items_id`) REFERENCES `master_kategori_items` (`id_kategori_items`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `master_items_satuans_id_foreign` FOREIGN KEY (`satuans_id`) REFERENCES `master_satuans` (`id_satuans`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `master_items_tokos_id_foreign` FOREIGN KEY (`tokos_id`) REFERENCES `master_tokos` (`id_tokos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_menus`
--
ALTER TABLE `master_menus`
  ADD CONSTRAINT `master_menus_menus_id_foreign` FOREIGN KEY (`menus_id`) REFERENCES `master_menus` (`id_menus`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `master_pembayarans`
--
ALTER TABLE `master_pembayarans`
  ADD CONSTRAINT `master_pembayarans_tokos_id_foreign` FOREIGN KEY (`tokos_id`) REFERENCES `master_tokos` (`id_tokos`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `master_suppliers`
--
ALTER TABLE `master_suppliers`
  ADD CONSTRAINT `master_suppliers_tokos_id_foreign` FOREIGN KEY (`tokos_id`) REFERENCES `master_tokos` (`id_tokos`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_pembelians`
--
ALTER TABLE `transaksi_pembelians`
  ADD CONSTRAINT `transaksi_pembelians_pembayarans_id_foreign` FOREIGN KEY (`pembayarans_id`) REFERENCES `master_pembayarans` (`id_pembayarans`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `transaksi_pembelians_suppliers_id_foreign` FOREIGN KEY (`suppliers_id`) REFERENCES `master_suppliers` (`id_suppliers`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `transaksi_pembelians_tokos_id_foreign` FOREIGN KEY (`tokos_id`) REFERENCES `master_tokos` (`id_tokos`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `transaksi_pembelians_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `transaksi_pembelian_details`
--
ALTER TABLE `transaksi_pembelian_details`
  ADD CONSTRAINT `transaksi_pembelian_details_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `master_items` (`id_items`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `transaksi_pembelian_details_pembelians_id_foreign` FOREIGN KEY (`pembelians_id`) REFERENCES `transaksi_pembelians` (`id_pembelians`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  ADD CONSTRAINT `transaksi_penjualans_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `master_customers` (`id_customers`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `transaksi_penjualans_pembayarans_id_foreign` FOREIGN KEY (`pembayarans_id`) REFERENCES `master_pembayarans` (`id_pembayarans`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `transaksi_penjualans_tokos_id_foreign` FOREIGN KEY (`tokos_id`) REFERENCES `master_tokos` (`id_tokos`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `transaksi_penjualans_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `transaksi_penjualan_details`
--
ALTER TABLE `transaksi_penjualan_details`
  ADD CONSTRAINT `transaksi_penjualan_details_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `master_items` (`id_items`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `transaksi_penjualan_details_penjualans_id_foreign` FOREIGN KEY (`penjualans_id`) REFERENCES `transaksi_penjualans` (`id_penjualans`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_level_sistems_id_foreign` FOREIGN KEY (`level_sistems_id`) REFERENCES `master_level_sistems` (`id_level_sistems`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `users_tokos_id_foreign` FOREIGN KEY (`tokos_id`) REFERENCES `master_tokos` (`id_tokos`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
