-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for finance
CREATE DATABASE IF NOT EXISTS `finance` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `finance`;

-- Dumping structure for table finance.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table finance.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table finance.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table finance.migrations: ~2 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table finance.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table finance.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table finance.tbl_buku_kas
CREATE TABLE IF NOT EXISTS `tbl_buku_kas` (
  `id_kas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` bigint(20) unsigned DEFAULT NULL,
  `nama_buku_kas` varchar(50) DEFAULT NULL,
  `deskripsi_buku_kas` varchar(50) DEFAULT NULL,
  `saldo_buku_awal` varchar(50) DEFAULT NULL,
  `saldo_buku_akhir` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_kas`),
  KEY `id_users` (`id_users`),
  CONSTRAINT `FK__users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_buku_kas: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_buku_kas` DISABLE KEYS */;
INSERT INTO `tbl_buku_kas` (`id_kas`, `id_users`, `nama_buku_kas`, `deskripsi_buku_kas`, `saldo_buku_awal`, `saldo_buku_akhir`, `created_at`, `updated_at`) VALUES
	(1, 1, 'KAS MANDIRI', 'kas sendiri', '10000000', '3820000', '2022-05-10 08:22:07', '2022-06-20 17:02:01'),
	(2, 1, 'Kas BCA', 'Punya bisnisman', '5000000', '13790000', '2022-05-10 11:16:58', '2022-06-23 11:54:24'),
	(3, 2, 'BRI', 'Tabungan Sendiri', '30000000', '30010000', '2022-05-25 17:10:19', '2022-05-25 17:11:12'),
	(4, 1, 'KAS BNI', 'Untuk Menabung', '50000000', '10600000', '2022-06-14 14:11:27', '2022-06-24 14:19:57');
/*!40000 ALTER TABLE `tbl_buku_kas` ENABLE KEYS */;

-- Dumping structure for table finance.tbl_catatan_buku
CREATE TABLE IF NOT EXISTS `tbl_catatan_buku` (
  `id_catatan` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` bigint(20) unsigned DEFAULT NULL,
  `id_buku_kas` int(11) unsigned DEFAULT NULL,
  `id_hutang` int(11) DEFAULT NULL,
  `id_piutang` int(11) DEFAULT NULL,
  `id_kategori` int(11) unsigned DEFAULT NULL,
  `catatan_saldo_kas` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(50) DEFAULT NULL,
  `catatan_keterangan` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_catatan`),
  KEY `id_buku_kas` (`id_buku_kas`),
  KEY `id_kategori` (`id_kategori`),
  KEY `FK_tbl_catatan_buku_users` (`id_users`),
  CONSTRAINT `FK_tbl_catatan_buku_tbl_buku_kas` FOREIGN KEY (`id_buku_kas`) REFERENCES `tbl_buku_kas` (`id_kas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_catatan_buku_tbl_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_catatan_buku_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_catatan_buku: ~13 rows (approximately)
/*!40000 ALTER TABLE `tbl_catatan_buku` DISABLE KEYS */;
INSERT INTO `tbl_catatan_buku` (`id_catatan`, `id_users`, `id_buku_kas`, `id_hutang`, `id_piutang`, `id_kategori`, `catatan_saldo_kas`, `deskripsi`, `catatan_keterangan`, `created_at`, `updated_at`) VALUES
	(36, 1, 1, 7, NULL, 4, '50000', 'v', 'Pemasukan', '2022-06-19 21:43:54', NULL),
	(38, 1, 1, 9, NULL, 2, '50000', 'Sax', 'Pemasukan', '2022-06-19 00:00:00', '2022-06-19 22:09:29'),
	(39, 1, 1, 10, NULL, 3, '500000', 'coba', 'Pemasukan', '2022-06-19 22:46:51', NULL),
	(40, 1, 1, 11, NULL, 4, '50000', 'sa', 'Pemasukan', '2022-06-08 11:35:04', NULL),
	(41, 1, 1, NULL, 4, 9, '489', 'c', 'Pengeluaran', '2022-06-20 00:00:00', NULL),
	(42, 1, 1, NULL, 5, 10, '600000', 'aw', 'Pengeluaran', '2022-06-20 00:00:00', NULL),
	(43, 1, 1, NULL, 6, 10, '700000', 'aw', 'Pengeluaran', '2022-06-20 17:02:01', '2022-06-20 17:02:01'),
	(44, 1, 1, NULL, 7, 10, '200000', 'aw', 'Pengeluaran', '2022-06-20 17:00:23', '2022-06-20 17:00:23'),
	(45, 1, 4, NULL, NULL, 2, '430000', 'asda', 'Pemasukan', '2022-06-21 22:36:00', NULL),
	(46, 1, 2, NULL, NULL, 1, '5000000', 's', 'Pemasukan', '2022-06-23 11:52:00', NULL),
	(47, 1, 2, NULL, NULL, 10, '1000000', 'fg', 'Pengeluaran', '2022-06-23 11:54:00', NULL),
	(48, 1, 4, NULL, NULL, 3, '400000', 'sa', 'Pemasukan', '2022-06-24 14:19:00', NULL),
	(49, 1, 4, NULL, NULL, 10, '20000', 'z', 'Pengeluaran', '2022-06-24 14:19:00', NULL);
/*!40000 ALTER TABLE `tbl_catatan_buku` ENABLE KEYS */;

-- Dumping structure for table finance.tbl_customer
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id_customer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` bigint(20) unsigned DEFAULT NULL,
  `email_customer` varchar(50) DEFAULT NULL,
  `name_customer` varchar(50) DEFAULT NULL,
  `phone_customer` varchar(50) DEFAULT NULL,
  `company_customer` varchar(50) DEFAULT NULL,
  `address_company_customer` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_customer`),
  UNIQUE KEY `email_customer` (`email_customer`),
  UNIQUE KEY `phone_customer` (`phone_customer`),
  KEY `id_users` (`id_users`),
  CONSTRAINT `FK_tbl_customer_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_customer: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_customer` DISABLE KEYS */;
INSERT INTO `tbl_customer` (`id_customer`, `id_users`, `email_customer`, `name_customer`, `phone_customer`, `company_customer`, `address_company_customer`, `created_at`, `updated_at`) VALUES
	(3, 1, 'rini@gmail.com', 'rini maharani', '0897-0987-7657', 'PT.Gojek', 'Jakarta Utara', '2022-05-22 14:17:55', '2022-05-22 15:42:11'),
	(4, 1, 'sutrisnoario@gmail.com', 'ario sutrisno', '0822-1092-3215', 'PT. Ario mask', 'KP.PEDURENAN RT.05/RW.011 NO.141', '2022-05-22 14:38:51', '2022-05-22 17:23:08'),
	(6, 1, 'indah@gmail.com', 'indah', '0883-2133-3242', 'pt.wow', 'bekasi barat', '2022-05-22 17:32:23', NULL),
	(7, 1, 'io@gmail.com', 'io', '0934783278462', 'PT Sukses', 'jatiasih', '2022-06-24 17:30:21', '2022-06-24 18:30:39');
/*!40000 ALTER TABLE `tbl_customer` ENABLE KEYS */;

-- Dumping structure for table finance.tbl_hutang
CREATE TABLE IF NOT EXISTS `tbl_hutang` (
  `id_hutang` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` bigint(20) unsigned DEFAULT NULL,
  `id_buku` int(11) unsigned DEFAULT NULL,
  `hutang_client` varchar(50) DEFAULT NULL,
  `catatan_saldo_hutang` varchar(50) DEFAULT NULL,
  `hutang_deskripsi` varchar(50) DEFAULT NULL,
  `jatuh_tempo_hutang` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_hutang`),
  KEY `id_users` (`id_users`),
  KEY `id_buku_kas` (`id_buku`) USING BTREE,
  CONSTRAINT `FK_tbl_hutang_tbl_buku_kas` FOREIGN KEY (`id_buku`) REFERENCES `tbl_buku_kas` (`id_kas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_hutang_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_hutang: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_hutang` DISABLE KEYS */;
INSERT INTO `tbl_hutang` (`id_hutang`, `id_users`, `id_buku`, `hutang_client`, `catatan_saldo_hutang`, `hutang_deskripsi`, `jatuh_tempo_hutang`, `created_at`, `updated_at`) VALUES
	(10, 1, 1, 'caca', '500000', 'coba', '2022-06-21 22:46:51', '2022-06-19 22:46:51', NULL),
	(11, 1, 1, 'wawa', '50000', 'sa', '2022-06-20 11:35:04', '2022-06-08 11:35:04', NULL);
/*!40000 ALTER TABLE `tbl_hutang` ENABLE KEYS */;

-- Dumping structure for table finance.tbl_invoice
CREATE TABLE IF NOT EXISTS `tbl_invoice` (
  `id_invoice` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` bigint(20) unsigned NOT NULL,
  `id_customer` int(10) unsigned DEFAULT NULL,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `catatan_keterangan` text DEFAULT NULL,
  `pembayaran` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `jatuh_tempo_invoice` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_invoice`),
  KEY `id_users` (`id_users`),
  KEY `id_customer` (`id_customer`),
  CONSTRAINT `FK_tbl_invoice_tbl_customer` FOREIGN KEY (`id_customer`) REFERENCES `tbl_customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_invoice: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_invoice` DISABLE KEYS */;
INSERT INTO `tbl_invoice` (`id_invoice`, `id_users`, `id_customer`, `nomor_surat`, `perihal`, `catatan_keterangan`, `pembayaran`, `created_at`, `jatuh_tempo_invoice`, `updated_at`) VALUES
	(11, 1, 3, '001/ALAN-C/VI/2022', 'Tagihan Pengembangan aplikasi Kruu berbasis web dan mobile', 'Sisa pembayaran aplikasi kruu', 136300000, '2022-06-12 11:54:20', '2022-06-12 11:54:20', '2022-06-12 11:54:20');
/*!40000 ALTER TABLE `tbl_invoice` ENABLE KEYS */;

-- Dumping structure for table finance.tbl_item_project
CREATE TABLE IF NOT EXISTS `tbl_item_project` (
  `id_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_quotation` int(11) unsigned DEFAULT NULL,
  `id_invoice` int(11) DEFAULT NULL,
  `nama_project` varchar(50) DEFAULT NULL,
  `biaya_project` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_item`),
  KEY `id_quotation` (`id_quotation`),
  KEY `id_invoice` (`id_invoice`),
  CONSTRAINT `FK_tbl_item_project_tbl_quotation_letter` FOREIGN KEY (`id_quotation`) REFERENCES `tbl_quotation_letter` (`id_quotation`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_item_project: ~10 rows (approximately)
/*!40000 ALTER TABLE `tbl_item_project` DISABLE KEYS */;
INSERT INTO `tbl_item_project` (`id_item`, `id_quotation`, `id_invoice`, `nama_project`, `biaya_project`, `created_at`, `updated_at`) VALUES
	(28, NULL, 0, 'Tagihan terbayar aplikasi Kruu (+ PPN)', '76300000', '2022-06-12 11:20:07', NULL),
	(29, NULL, 0, 'Sisa Pembayaran aplikasi Kruu (+PPN)', '50000000', '2022-06-12 11:20:07', NULL),
	(30, NULL, 0, 'Tagihan terbayar aplikasi Kruu (+ PPN)', '76300000', '2022-06-12 11:20:44', NULL),
	(31, NULL, 0, 'Sisa Pembayaran aplikasi Kruu (+PPN)', '50000000', '2022-06-12 11:20:44', NULL),
	(32, NULL, 0, 'Tagihan terbayar aplikasi Kruu (+ PPN)', '76300000', '2022-06-12 11:21:00', NULL),
	(33, NULL, 0, 'Sisa Pembayaran aplikasi Kruu (+PPN)', '50000000', '2022-06-12 11:21:00', NULL),
	(50, NULL, 11, 'Tagihan terbayar aplikasi Kruu (+ PPN)', '76300000', '2022-06-12 11:54:20', NULL),
	(51, NULL, 11, 'Sisa Pembayaran Aplikasi Kruu (+PPN)', '60000000', '2022-06-12 11:54:20', NULL),
	(52, NULL, 12, 'as', '6000', '2022-06-12 13:11:55', NULL),
	(53, NULL, 12, 't', '65745', '2022-06-12 13:11:55', NULL);
/*!40000 ALTER TABLE `tbl_item_project` ENABLE KEYS */;

-- Dumping structure for table finance.tbl_kategori
CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `id_kategori` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) DEFAULT NULL,
  `keterangan_kategori` enum('Pemasukan','Pengeluaran') DEFAULT 'Pemasukan',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_kategori: ~11 rows (approximately)
/*!40000 ALTER TABLE `tbl_kategori` DISABLE KEYS */;
INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`, `keterangan_kategori`, `created_at`, `updated_at`) VALUES
	(1, 'Penjualan', 'Pemasukan', '2022-05-10 08:47:05', NULL),
	(2, 'Komisi/Fee', 'Pemasukan', '2022-05-10 08:47:16', NULL),
	(3, 'Penerimaan Piutang', 'Pemasukan', '2022-05-10 08:47:34', NULL),
	(4, 'Modal', 'Pemasukan', '2022-05-10 08:47:47', NULL),
	(6, 'Hibah', 'Pemasukan', '2022-05-10 08:50:31', NULL),
	(7, 'Pinjaman', 'Pemasukan', '2022-05-10 08:50:47', NULL),
	(8, 'Pembelian Persediaan', 'Pengeluaran', '2022-05-10 08:51:02', NULL),
	(9, 'Pembelian Bahan Baku', 'Pengeluaran', '2022-05-10 08:51:16', NULL),
	(10, 'Biaya Kemasan', 'Pengeluaran', '2022-05-10 08:51:27', NULL),
	(11, 'Beban Ongkos Kirim', 'Pengeluaran', '2022-05-10 08:51:36', NULL),
	(12, 'Beban Iklan/Promosi', 'Pengeluaran', '2022-05-10 08:51:52', NULL),
	(13, 'Beban Gaji Pegawai', 'Pengeluaran', '2022-05-10 08:52:08', NULL),
	(14, 'Beban Gedung', 'Pengeluaran', '2022-05-10 08:52:31', NULL);
/*!40000 ALTER TABLE `tbl_kategori` ENABLE KEYS */;

-- Dumping structure for table finance.tbl_offering_letter
CREATE TABLE IF NOT EXISTS `tbl_offering_letter` (
  `id_letter` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` bigint(20) unsigned DEFAULT 0,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `letter_nama` varchar(50) DEFAULT NULL,
  `letter_email` varchar(255) NOT NULL,
  `letter_telepon` varchar(50) DEFAULT NULL,
  `letter_alamat` varchar(50) DEFAULT NULL,
  `letter_peruntukan` varchar(50) DEFAULT NULL,
  `letter_date_mulai` datetime DEFAULT current_timestamp(),
  `letter_date_selesai` datetime DEFAULT current_timestamp(),
  `letter_pembimbing` varchar(50) DEFAULT NULL,
  `letter_telepon_pembimbing` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_letter`),
  UNIQUE KEY `letter_email` (`letter_email`),
  KEY `id_users` (`id_users`),
  CONSTRAINT `FK_tbl_offering_letter_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_offering_letter: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_offering_letter` DISABLE KEYS */;
INSERT INTO `tbl_offering_letter` (`id_letter`, `id_users`, `nomor_surat`, `letter_nama`, `letter_email`, `letter_telepon`, `letter_alamat`, `letter_peruntukan`, `letter_date_mulai`, `letter_date_selesai`, `letter_pembimbing`, `letter_telepon_pembimbing`, `created_at`, `updated_at`) VALUES
	(7, 1, '001/ALAN-MI/VI/2022', 'ario sutrisno c', 'sutrisnoario@gmail.com', '082210923215', 'KP.PEDURENAN RT.05/RW.011 NO.141', 'internship', '2022-06-13 09:10:00', '2022-07-26 17:10:00', 'indah', '082210923215', '2022-06-07 13:40:14', '2022-06-25 12:19:29');
/*!40000 ALTER TABLE `tbl_offering_letter` ENABLE KEYS */;

-- Dumping structure for table finance.tbl_piutang
CREATE TABLE IF NOT EXISTS `tbl_piutang` (
  `id_piutang` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` bigint(20) unsigned DEFAULT NULL,
  `id_buku_kas` int(11) unsigned DEFAULT NULL,
  `piutang_client` varchar(50) DEFAULT NULL,
  `piutang_deskripsi` varchar(50) DEFAULT NULL,
  `catatan_saldo_piutang` varchar(50) DEFAULT NULL,
  `jatuh_tempo_piutang` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_piutang`),
  KEY `id_buku_kas` (`id_buku_kas`),
  KEY `id_users` (`id_users`),
  CONSTRAINT `FK_tbl_piutang_tbl_buku_kas` FOREIGN KEY (`id_buku_kas`) REFERENCES `tbl_buku_kas` (`id_kas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_piutang_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_piutang: ~6 rows (approximately)
/*!40000 ALTER TABLE `tbl_piutang` DISABLE KEYS */;
INSERT INTO `tbl_piutang` (`id_piutang`, `id_users`, `id_buku_kas`, `piutang_client`, `piutang_deskripsi`, `catatan_saldo_piutang`, `jatuh_tempo_piutang`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'fifi nur hayati', 'telah masuk cek dulu..', '1000000', '2022-05-18 07:17:58', '2022-05-04 07:17:58', '2022-05-15 07:16:56'),
	(2, 1, 2, 'rara', 'coba dong', '1000000', '2022-05-19 07:20:59', '2022-05-15 07:20:59', NULL),
	(5, 1, 1, 'ryo', 'aw', '600000', '2022-06-20 00:00:00', '2022-06-20 00:00:00', NULL),
	(6, 1, 1, 'ryo', 'aw', '700000', '2022-06-20 00:00:00', '2022-06-20 00:00:00', NULL),
	(7, 1, 1, 'ryo', 'aw', '200000', '2022-06-20 00:00:00', '2022-06-20 00:00:00', NULL);
/*!40000 ALTER TABLE `tbl_piutang` ENABLE KEYS */;

-- Dumping structure for table finance.tbl_quotation_letter
CREATE TABLE IF NOT EXISTS `tbl_quotation_letter` (
  `id_quotation` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` bigint(20) unsigned NOT NULL,
  `id_customer` int(11) unsigned NOT NULL,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `catatan_keterangan` varchar(50) DEFAULT NULL,
  `pembayaran` varchar(50) DEFAULT NULL,
  `tgl_jatuh_tempo` datetime DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_quotation`),
  KEY `id_users` (`id_users`),
  KEY `id_customer` (`id_customer`),
  CONSTRAINT `FK_tbl_quotation_letter_tbl_customer` FOREIGN KEY (`id_customer`) REFERENCES `tbl_customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_quotation_letter_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_quotation_letter: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_quotation_letter` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_quotation_letter` ENABLE KEYS */;

-- Dumping structure for table finance.tbl_term
CREATE TABLE IF NOT EXISTS `tbl_term` (
  `id_term` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_invoice` int(10) unsigned DEFAULT NULL,
  `standar_pembayaran` varchar(50) DEFAULT NULL,
  `DP` varchar(50) DEFAULT NULL,
  `term` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_term`),
  KEY `id_invoice` (`id_invoice`),
  CONSTRAINT `FK__tbl_invoice` FOREIGN KEY (`id_invoice`) REFERENCES `tbl_invoice` (`id_invoice`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_term: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_term` DISABLE KEYS */;
INSERT INTO `tbl_term` (`id_term`, `id_invoice`, `standar_pembayaran`, `DP`, `term`, `created_at`, `updated_at`) VALUES
	(45, 11, 'standar', '74965000', '18741250', '2022-06-12 11:54:20', NULL),
	(46, 11, 'standar', '74965000', '18741250', '2022-06-12 11:54:20', NULL),
	(47, 11, 'standar', '74965000', '18741250', '2022-06-12 11:54:20', NULL),
	(48, 11, 'standar', '74965000', '18741250', '2022-06-12 11:54:20', NULL);
/*!40000 ALTER TABLE `tbl_term` ENABLE KEYS */;

-- Dumping structure for table finance.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table finance.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Ario Sutrisno', 'sutrisnoario@gmail.com', NULL, '$2y$10$JSmNwlakRjj2dxz3dTng0uCn8PMObF/RRSk9oKIePaMQUIlnTX01G', NULL, '2022-05-09 03:27:05', '2022-05-09 03:27:05'),
	(2, 'ario', 'ario@gmail.com', NULL, '$2y$10$9NXrWWbUqy8AHyKpddhY4OcquIhcKpPG8m51.IeUP6Uwwbl0pzpt.', NULL, '2022-05-09 03:32:30', '2022-05-09 03:32:30'),
	(3, 'rio', 'rio@gmail.com', NULL, '$2y$10$jp8osbEQT2AdYfRN35Fc2uD56OpkOLklL9XceQouRUFsqV6s2V1CW', NULL, '2022-05-09 03:34:17', '2022-05-09 03:34:17'),
	(4, 'io', 'io@gmail.com', NULL, '$2y$10$5xOSWTcd1yJ21R3Q8hDZjO4UCStjvyMTImUReiHShldeckSehmsr.', NULL, '2022-05-09 03:48:33', '2022-05-09 03:48:33'),
	(5, 'niken', 'nikenayupr143@gmail.com', NULL, '$2y$10$pAqZAqIqBui1XcjesckdpOR17wJMPQoCOyM.ntrilBzBnGSUdIl06', NULL, '2022-05-09 03:51:49', '2022-05-09 03:51:49'),
	(6, 'salwa', 'salwa@gmail.com', NULL, '$2y$10$7JKDtHs86SbAOTPUzV0bje1IjDky0NQlqd14cr8jOEMMwOuLDWByW', NULL, '2022-05-09 03:54:36', '2022-05-09 03:54:36'),
	(7, 'kaori oda', 'kaori@gmail.com', NULL, '$2y$10$gL8wbrkI41jQ7HAXdNkThORtfsNGYgC1LguIGpAW/rTjR7YL4dAGW', NULL, '2022-05-09 03:55:55', '2022-05-09 03:55:55');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
