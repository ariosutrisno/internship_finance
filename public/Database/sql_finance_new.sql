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

-- Dumping data for table finance.migrations: ~3 rows (approximately)
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

-- Dumping data for table finance.tbl_buku_kas: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_buku_kas` DISABLE KEYS */;
INSERT INTO `tbl_buku_kas` (`id_kas`, `id_users`, `nama_buku_kas`, `deskripsi_buku_kas`, `saldo_buku_awal`, `saldo_buku_akhir`, `created_at`, `updated_at`) VALUES
	(1, 1, 'KAS MANDIRI', 'kas sendiri', '10000000', '3820000', '2022-05-10 15:22:07', '2022-06-21 00:02:01'),
	(2, 1, 'Kas BCA', 'Punya bisnisman', '5000000', '13790000', '2022-05-10 18:16:58', '2022-06-23 18:54:24'),
	(3, 2, 'BRI', 'Tabungan Sendiri', '30000000', '30010000', '2022-05-26 00:10:19', '2022-05-26 00:11:12'),
	(4, 1, 'KAS BNI', 'Untuk Menabung', '50000000', '10600000', '2022-06-14 21:11:27', '2022-06-24 21:19:57');
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
	(36, 1, 1, 7, NULL, 4, '50000', 'v', 'Pemasukan', '2022-06-20 04:43:54', NULL),
	(38, 1, 1, 9, NULL, 2, '50000', 'Sax', 'Pemasukan', '2022-06-19 07:00:00', '2022-06-20 05:09:29'),
	(39, 1, 1, 10, NULL, 3, '500000', 'coba', 'Pemasukan', '2022-06-20 05:46:51', NULL),
	(40, 1, 1, 11, NULL, 4, '50000', 'sa', 'Pemasukan', '2022-06-08 18:35:04', NULL),
	(41, 1, 1, NULL, 4, 9, '489', 'c', 'Pengeluaran', '2022-06-20 07:00:00', NULL),
	(42, 1, 1, NULL, 5, 10, '600000', 'aw', 'Pengeluaran', '2022-06-20 07:00:00', NULL),
	(43, 1, 1, NULL, 6, 10, '700000', 'aw', 'Pengeluaran', '2022-06-21 00:02:01', '2022-06-21 00:02:01'),
	(44, 1, 1, NULL, 7, 10, '200000', 'aw', 'Pengeluaran', '2022-06-21 00:00:23', '2022-06-21 00:00:23'),
	(45, 1, 4, NULL, NULL, 2, '430000', 'asda', 'Pemasukan', '2022-06-22 05:36:00', NULL),
	(46, 1, 2, NULL, NULL, 1, '5000000', 's', 'Pemasukan', '2022-06-23 18:52:00', NULL),
	(47, 1, 2, NULL, NULL, 10, '1000000', 'fg', 'Pengeluaran', '2022-06-23 18:54:00', NULL),
	(48, 1, 4, NULL, NULL, 3, '400000', 'sa', 'Pemasukan', '2022-06-24 21:19:00', NULL),
	(49, 1, 4, NULL, NULL, 10, '20000', 'z', 'Pengeluaran', '2022-06-24 21:19:00', NULL);
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
	(3, 1, 'rini@gmail.com', 'rini maharani', '0897-0987-7657', 'PT.Gojek', 'Jakarta Utara', '2022-05-22 21:17:55', '2022-05-22 22:42:11'),
	(4, 1, 'sutrisnoario@gmail.com', 'ario sutrisno', '0822-1092-3215', 'PT. Ario mask', 'KP.PEDURENAN RT.05/RW.011 NO.141', '2022-05-22 21:38:51', '2022-05-23 00:23:08'),
	(6, 1, 'indah@gmail.com', 'indah', '0883-2133-3242', 'pt.wow', 'bekasi barat', '2022-05-23 00:32:23', NULL),
	(7, 1, 'io@gmail.com', 'io', '0934783278462', 'PT Sukses', 'jatiasih', '2022-06-25 00:30:21', '2022-06-25 01:30:39');
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
	(10, 1, 1, 'caca', '500000', 'coba', '2022-06-22 05:46:51', '2022-06-20 05:46:51', NULL),
	(11, 1, 1, 'wawa', '50000', 'sa', '2022-06-20 18:35:04', '2022-06-08 18:35:04', NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_invoice: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_invoice` DISABLE KEYS */;
INSERT INTO `tbl_invoice` (`id_invoice`, `id_users`, `id_customer`, `nomor_surat`, `perihal`, `catatan_keterangan`, `pembayaran`, `created_at`, `jatuh_tempo_invoice`, `updated_at`) VALUES
	(57, 1, 4, '001/ALAN-C/VII/2022', 'Game Online', 'Pembayaran Game Online & maintenance', 10500000, '2022-05-22 10:07:58', '2022-08-02 10:07:58', '2022-07-31 10:07:58');
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
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_item_project: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbl_item_project` DISABLE KEYS */;
INSERT INTO `tbl_item_project` (`id_item`, `id_quotation`, `id_invoice`, `nama_project`, `biaya_project`, `created_at`, `updated_at`) VALUES
	(105, 11, NULL, 'u', '500000', '2022-07-21 16:22:51', NULL),
	(106, 11, NULL, 'i', '900000', '2022-07-21 16:22:51', NULL),
	(139, NULL, 57, 'Server', '4000000', '2022-07-31 10:07:58', NULL),
	(140, NULL, 57, 'Mobile', '6000000', '2022-07-31 10:07:58', NULL),
	(141, NULL, 57, 'Maintenance', '500000', '2022-07-31 10:07:58', NULL);
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

-- Dumping data for table finance.tbl_kategori: ~13 rows (approximately)
/*!40000 ALTER TABLE `tbl_kategori` DISABLE KEYS */;
INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`, `keterangan_kategori`, `created_at`, `updated_at`) VALUES
	(1, 'Penjualan', 'Pemasukan', '2022-05-10 15:47:05', NULL),
	(2, 'Komisi/Fee', 'Pemasukan', '2022-05-10 15:47:16', NULL),
	(3, 'Penerimaan Piutang', 'Pemasukan', '2022-05-10 15:47:34', NULL),
	(4, 'Modal', 'Pemasukan', '2022-05-10 15:47:47', NULL),
	(6, 'Hibah', 'Pemasukan', '2022-05-10 15:50:31', NULL),
	(7, 'Pinjaman', 'Pemasukan', '2022-05-10 15:50:47', NULL),
	(8, 'Pembelian Persediaan', 'Pengeluaran', '2022-05-10 15:51:02', NULL),
	(9, 'Pembelian Bahan Baku', 'Pengeluaran', '2022-05-10 15:51:16', NULL),
	(10, 'Biaya Kemasan', 'Pengeluaran', '2022-05-10 15:51:27', NULL),
	(11, 'Beban Ongkos Kirim', 'Pengeluaran', '2022-05-10 15:51:36', NULL),
	(12, 'Beban Iklan/Promosi', 'Pengeluaran', '2022-05-10 15:51:52', NULL),
	(13, 'Beban Gaji Pegawai', 'Pengeluaran', '2022-05-10 15:52:08', NULL),
	(14, 'Beban Gedung', 'Pengeluaran', '2022-05-10 15:52:31', NULL);
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
  KEY `id_users` (`id_users`),
  CONSTRAINT `FK_tbl_offering_letter_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_offering_letter: ~10 rows (approximately)
/*!40000 ALTER TABLE `tbl_offering_letter` DISABLE KEYS */;
INSERT INTO `tbl_offering_letter` (`id_letter`, `id_users`, `nomor_surat`, `letter_nama`, `letter_email`, `letter_telepon`, `letter_alamat`, `letter_peruntukan`, `letter_date_mulai`, `letter_date_selesai`, `letter_pembimbing`, `letter_telepon_pembimbing`, `created_at`, `updated_at`) VALUES
	(7, 1, '001/ALAN-MI/VI/2022', 'ario sutrisno c', 'sutrisnoario@gmail.com', '082210923215', 'KP.PEDURENAN RT.05/RW.011 NO.141', 'Internship', '2022-06-13 09:10:00', '2022-07-26 17:10:00', 'indah', '082210923215', '2022-06-07 20:40:14', '2022-07-02 15:06:07'),
	(8, 1, '002/ALAN-MI/VII/2022', 'rio', 'rio@gmail.com', '08221923424', 'Puri Gading', 'Internship', '2022-07-03 14:40:00', '2022-07-27 15:40:00', 'indah', '0847583748', '2022-07-03 15:05:13', '2022-07-03 15:05:13'),
	(9, 1, '003/ALAN-MI/VII/2022', 'sisca', 'sisca@gmail.com', '0865565224', 'kp.sawah', 'Karyawan', '2022-07-10 18:42:00', NULL, 'reni', '086456', '2022-07-03 16:42:00', NULL),
	(10, 1, NULL, 'indah', 'indah@gmail.com', '0873463', 'Kp.Sawo', 'Internship', '2022-07-10 15:14:00', NULL, 'wanda', '08735472', '2022-07-03 13:14:00', NULL),
	(11, 1, NULL, 'wanda', 'wanda@gmail.com', '08221923424', 'Kp.Rambutan', 'Karyawan', '2022-07-04 15:22:00', NULL, 'sari', '03724893785', '2022-07-03 19:35:00', '2022-07-03 15:41:42'),
	(13, 1, NULL, 'laili', 'lailo@gmail.com', '08332423', 'pondok gede', 'Internship', '2022-07-20 13:49:00', NULL, 'asd', '03745893', '2022-07-11 02:44:00', NULL),
	(14, 1, '004/ALAN-MI/VII/2022', 'wiwit', 'wiwit@gmail.com', '08387462378', 'jawa tengah', 'Internship', '2022-07-10 19:31:00', '2022-07-18 20:31:00', 'erin', '3543546', '2022-07-03 14:31:24', NULL),
	(15, 1, NULL, 'dul', 'dul@gmil.com', '359347', 'dimn', 'Karyawan', '2022-07-17 20:34:00', NULL, 'asdas', '435', '2022-07-03 16:33:00', NULL),
	(16, 1, '005/ALAN-MI/VII/2022', 'c', 'a@gmail.com', '4546', 'sda', 'Internship', '2022-07-04 14:34:00', '2022-07-27 20:35:00', 'asd', '3454', '2022-07-04 14:35:36', NULL);
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

-- Dumping data for table finance.tbl_piutang: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbl_piutang` DISABLE KEYS */;
INSERT INTO `tbl_piutang` (`id_piutang`, `id_users`, `id_buku_kas`, `piutang_client`, `piutang_deskripsi`, `catatan_saldo_piutang`, `jatuh_tempo_piutang`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'fifi nur hayati', 'telah masuk cek dulu..', '1000000', '2022-05-18 14:17:58', '2022-05-04 14:17:58', '2022-05-15 14:16:56'),
	(2, 1, 2, 'rara', 'coba dong', '1000000', '2022-05-19 14:20:59', '2022-05-15 14:20:59', NULL),
	(5, 1, 1, 'ryo', 'aw', '600000', '2022-06-20 07:00:00', '2022-06-20 07:00:00', NULL),
	(6, 1, 1, 'ryo', 'aw', '700000', '2022-06-20 07:00:00', '2022-06-20 07:00:00', NULL),
	(7, 1, 1, 'ryo', 'aw', '200000', '2022-06-20 07:00:00', '2022-06-20 07:00:00', NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_quotation_letter: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_quotation_letter` DISABLE KEYS */;
INSERT INTO `tbl_quotation_letter` (`id_quotation`, `id_users`, `id_customer`, `nomor_surat`, `perihal`, `catatan_keterangan`, `pembayaran`, `tgl_jatuh_tempo`, `created_at`, `updated_at`) VALUES
	(10, 1, 6, '001/ALAN-C/VII/2022', 'Tagihan Pengembangan aplikasi Kruu berbasis web dan mobile', 'sadsa', '540000', '2022-07-30 17:42:11', '2022-07-07 17:42:11', NULL),
	(11, 1, 7, '002/ALAN-C/VII/2022', 'dss11', 'd', '1400000', '2022-07-12 16:22:51', '2022-06-25 16:22:51', '2022-07-21 16:22:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

-- Dumping data for table finance.tbl_term: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_term` DISABLE KEYS */;
INSERT INTO `tbl_term` (`id_term`, `id_invoice`, `standar_pembayaran`, `DP`, `term`, `created_at`, `updated_at`) VALUES
	(68, 57, 'high', '6930000', '4620000', '2022-07-31 10:07:58', NULL);
/*!40000 ALTER TABLE `tbl_term` ENABLE KEYS */;

-- Dumping structure for table finance.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk_users` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_users` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_users` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `phone_users` (`phone_users`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table finance.users: ~8 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `jk_users`, `phone_users`, `email`, `email_verified_at`, `password`, `remember_token`, `img_users`, `created_at`, `updated_at`) VALUES
	(1, 'Ario Sutrisno', NULL, NULL, 'sutrisnoario@gmail.com', NULL, '$2y$10$JSmNwlakRjj2dxz3dTng0uCn8PMObF/RRSk9oKIePaMQUIlnTX01G', NULL, NULL, '2022-05-09 10:27:05', '2022-05-09 10:27:05'),
	(2, 'ario', NULL, NULL, 'ario@gmail.com', NULL, '$2y$10$9NXrWWbUqy8AHyKpddhY4OcquIhcKpPG8m51.IeUP6Uwwbl0pzpt.', NULL, NULL, '2022-05-09 10:32:30', '2022-05-09 10:32:30'),
	(3, 'rio', NULL, NULL, 'rio@gmail.com', NULL, '$2y$10$jp8osbEQT2AdYfRN35Fc2uD56OpkOLklL9XceQouRUFsqV6s2V1CW', NULL, NULL, '2022-05-09 10:34:17', '2022-05-09 10:34:17'),
	(4, 'io', NULL, NULL, 'io@gmail.com', NULL, '$2y$10$5xOSWTcd1yJ21R3Q8hDZjO4UCStjvyMTImUReiHShldeckSehmsr.', NULL, NULL, '2022-05-09 10:48:33', '2022-05-09 10:48:33'),
	(5, 'niken', NULL, NULL, 'nikenayupr143@gmail.com', NULL, '$2y$10$pAqZAqIqBui1XcjesckdpOR17wJMPQoCOyM.ntrilBzBnGSUdIl06', NULL, NULL, '2022-05-09 10:51:49', '2022-05-09 10:51:49'),
	(6, 'salwa', NULL, NULL, 'salwa@gmail.com', NULL, '$2y$10$7JKDtHs86SbAOTPUzV0bje1IjDky0NQlqd14cr8jOEMMwOuLDWByW', NULL, NULL, '2022-05-09 10:54:36', '2022-05-09 10:54:36'),
	(7, 'kaori oda', NULL, NULL, 'kaori@gmail.com', NULL, '$2y$10$gL8wbrkI41jQ7HAXdNkThORtfsNGYgC1LguIGpAW/rTjR7YL4dAGW', NULL, NULL, '2022-05-09 10:55:55', '2022-05-09 10:55:55'),
	(8, 'keiko', NULL, NULL, 'keiko@gmail.com', NULL, '$2y$10$hh5gtbqZ6omRap2wWayDK.HM1vSfZdiIc3.jd2l6I/cDYTMsi32eG', NULL, NULL, '2022-07-10 21:34:46', '2022-07-10 21:34:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
