-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 03, 2024 at 06:31 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dblaundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_paket` int NOT NULL,
  `qty` double NOT NULL,
  `total_harga` double NOT NULL,
  `keterangan` text NOT NULL,
  `total_bayar` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_paket`, `qty`, `total_harga`, `keterangan`, `total_bayar`) VALUES
(16, 36, 20, 20, 44000, '', 500000),
(17, 37, 20, 50, 110000, '', 200000),
(18, 39, 21, 15, 21000, '', 25000),
(19, 40, 20, 10, 22000, '', 22000),
(20, 41, 20, 10, 22000, '', 50000),
(21, 42, 20, 5, 11000, '', 20000),
(22, 43, 23, 2, 5000, '', 6000),
(23, 44, 20, 3, 6600, '', 10000),
(24, 45, 20, 1, 2200, '', 0),
(25, 46, 20, 3, 6600, '', 0),
(26, 48, 20, 5, 11000, '', 12000),
(27, 49, 20, 5, 11000, '', 15000),
(28, 50, 20, 3, 6600, '', 6600),
(29, 51, 20, 6, 13200, '', 15000),
(30, 52, 23, 10, 25000, '', 30000),
(31, 53, 20, 12, 26400, '', 30000),
(32, 54, 20, 50, 110000, '', 200000),
(33, 56, 20, 1, 2200, '', 3000),
(34, 57, 20, 5, 11000, '', 20000),
(35, 58, 20, 20000, 44000000, '', 44000000),
(36, 59, 25, 6, 30000, '', 30000),
(37, 83, 21, 2, 2800, '', 2800),
(38, 84, 23, 3, 7500, '', 7500),
(39, 85, 25, 10, 50000, '', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `id_outlet` int NOT NULL,
  `nama_outlet` varchar(228) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat_outlet` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `telp_outlet` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`id_outlet`, `nama_outlet`, `alamat_outlet`, `telp_outlet`) VALUES
(9, 'Outlet Merah', 'Yogyakarta, Indonesia', '08555555555'),
(10, 'Outlet Putih', 'Bantul, Yogyakarta, Indonesia', '081222222222'),
(11, 'Outlet Biru', 'Bantul, Daerah Istimewa Yogyakarta', '081223446312'),
(12, 'Outlet Abu-abu', 'Bantul, Yogyakarta', '0826377453886'),
(14, 'Oulet Sumbersari', 'Jalan Karimata No. 15', '08920083'),
(30, 'Owner Mastrip', 'Jalan Mastrip No.2', '0358965'),
(31, 'Oulet Jawa 9', 'Jalan Jawa', '08920083');

-- --------------------------------------------------------

--
-- Table structure for table `paket_cuci`
--

CREATE TABLE `paket_cuci` (
  `id_paket` int NOT NULL,
  `jenis_paket` enum('kiloan','selimut','bedcover','kaos','lain') NOT NULL,
  `nama_paket` varchar(228) NOT NULL,
  `harga` int NOT NULL,
  `outlet_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket_cuci`
--

INSERT INTO `paket_cuci` (`id_paket`, `jenis_paket`, `nama_paket`, `harga`, `outlet_id`) VALUES
(20, 'kiloan', 'Paket Wangi Tahan Lama', 2200, 9),
(21, 'kaos', 'Paket Cepat Kering', 1400, 10),
(22, 'selimut', 'Paket Harum', 1500, 11),
(23, 'kiloan', 'Paket Kering Wangi', 2500, 9),
(25, 'bedcover', 'Paket Ramadhan ', 5000, 9),
(27, 'lain', 'Paket Idul Fitri', 5000, 30),
(30, 'selimut', 'Paket Juni Pancasila', 2500, 12);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `nama_pelanggan` varchar(228) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp_pelanggan` varchar(15) NOT NULL,
  `no_ktp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `jenis_kelamin`, `telp_pelanggan`, `no_ktp`) VALUES
(23, 'Lulu', 'Imogiri', 'P', '088888888888', '123456789'),
(24, 'Lolo', 'Jl Bantul, Yogyakarta', 'L', '0821123311131', '0987654321'),
(25, 'Apip Luki', 'Imogiri, Bantul', 'L', '08123456244567', '1234567890'),
(29, 'Lukman', 'Jalan Kalimantan No.18', 'L', '058974523215', '353263225324'),
(30, 'Shavira', 'Jalan Mastrip', 'P', '013248762', '03454863148'),
(31, 'Ilyas', 'Jalan Kalimantan No.10', 'L', '25532633', '0356355245'),
(32, 'Toto', 'Sumberjo', 'L', '0834567890', '3508085609089'),
(33, 'Abdullah', 'Jalan Kaliurang', 'L', '121212121', '235563223');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `outlet_id` int DEFAULT NULL,
  `kode_invoice` varchar(228) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_pelanggan` int DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `batas_waktu` datetime DEFAULT NULL,
  `tgl_pembayaran` datetime DEFAULT NULL,
  `biaya_tambahan` int DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `pajak` int DEFAULT NULL,
  `keterangan` text,
  `status` enum('baru','proses','selesai','diambil') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_bayar` enum('dibayar','belum') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `outlet_id`, `kode_invoice`, `id_pelanggan`, `tgl`, `batas_waktu`, `tgl_pembayaran`, `biaya_tambahan`, `diskon`, `pajak`, `keterangan`, `status`, `status_bayar`, `id_user`) VALUES
(36, 9, 'CLN202009033737', 23, '2020-09-03 04:37:43', '2020-09-10 12:00:00', '2020-09-03 04:40:03', 0, 0, 0, NULL, 'selesai', 'dibayar', 1),
(37, 9, 'CLN202009035702', 23, '2020-09-03 05:03:37', '2020-09-10 12:00:00', '2020-09-03 05:08:28', 0, 0, 0, NULL, 'baru', 'dibayar', 1),
(39, 10, 'CLN202009034317', 24, '2020-09-03 05:19:12', '2020-09-10 12:00:00', '2020-09-03 05:21:41', 0, 0, 0, NULL, 'baru', 'dibayar', NULL),
(40, 9, 'CLN202009040521', 24, '2020-09-04 03:21:09', '2020-09-11 12:00:00', '2024-05-09 05:39:46', 0, 0, 0, NULL, 'baru', 'dibayar', 1),
(41, 9, 'CLN202009040528', 25, '2020-09-04 03:28:21', '2020-09-11 12:00:00', '2020-09-04 03:29:00', 0, 0, 0, NULL, 'baru', 'dibayar', 1),
(42, 9, 'CLN202405301050', 23, '2024-05-30 02:50:19', '2024-06-06 12:00:00', '2024-05-30 02:50:47', 0, 0, 0, NULL, 'baru', 'dibayar', 6),
(43, 9, 'CLN202405300652', NULL, '2024-05-30 02:52:23', '2024-06-06 12:00:00', '2024-05-30 02:52:38', 10, 2, 0, NULL, 'baru', 'dibayar', 6),
(44, 9, 'CLN202405300337', 23, '2024-05-30 04:37:12', '2024-06-06 12:00:00', '2024-06-01 02:43:31', 0, 0, 0, NULL, 'baru', 'dibayar', 6),
(45, 9, 'CLN202405303737', NULL, '2024-05-30 04:37:51', '2024-06-06 12:00:00', NULL, 7000, 20, 0, NULL, 'baru', 'belum', 6),
(46, 9, 'CLN202405302438', NULL, '2024-05-30 04:38:35', '2024-06-06 12:00:00', NULL, 7888, 4, 0, NULL, 'baru', 'belum', 6),
(47, 9, 'CLN202406015820', 23, '2024-06-01 02:21:12', '2024-06-08 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 6),
(48, 9, 'CLN202406011622', 23, '2024-06-01 02:37:13', '2024-06-08 12:00:00', '2024-06-01 03:43:37', 0, 0, 0, NULL, 'baru', 'dibayar', 6),
(49, 9, 'CLN202406014841', 23, '2024-06-01 02:41:57', '2024-06-08 12:00:00', '2024-06-01 21:11:09', 0, 0, 0, NULL, 'selesai', 'dibayar', 6),
(50, 9, 'CLN202406014742', 25, '2024-06-01 02:42:57', '2024-06-08 12:00:00', '2024-06-03 15:18:58', 1000, 0, 0, NULL, 'baru', 'dibayar', 6),
(51, 9, 'CLN202406014743', 25, '2024-06-01 03:27:38', '2024-06-08 12:00:00', '2024-06-02 09:03:35', 2000, 0, 0, NULL, 'baru', 'dibayar', 6),
(52, 9, 'CLN202406013044', 25, '2024-06-01 03:44:42', '2024-06-08 12:00:00', '2024-06-01 03:44:59', 12000, 0, 0, NULL, 'baru', 'dibayar', 6),
(53, 9, 'CLN202009033738', 29, '2024-06-02 03:39:58', '2024-06-09 12:00:00', '2024-06-03 02:59:34', 1000, 0, 0, NULL, 'diambil', 'dibayar', 6),
(54, 9, 'CLN202009033780', 29, '2024-06-02 03:50:35', '2024-06-09 12:00:00', '2024-06-03 02:41:35', 0, 0, 0, NULL, 'proses', 'dibayar', 6),
(56, 9, 'CLN202009033783', 23, '2024-06-03 04:42:04', '2024-06-10 12:00:00', '2024-06-03 15:34:39', 0, 0, 0, NULL, 'baru', 'dibayar', 6),
(57, 9, 'CLN202406031226', 23, '2024-06-03 02:26:33', '2024-06-10 12:00:00', '2024-06-03 15:28:19', 0, 0, 0, NULL, 'baru', 'dibayar', 6),
(58, 9, 'CLN202406031012', 25, '2024-06-03 03:12:17', '2024-06-10 12:00:00', '2024-06-03 15:19:23', 0, 0, 0, NULL, 'diambil', 'dibayar', 6),
(59, 9, 'CLN202406030758', 30, '2024-06-03 04:58:21', '2024-06-10 12:00:00', '2024-06-03 16:58:41', 1000, 0, 0, NULL, 'diambil', 'dibayar', 6),
(60, 9, 'CLN202406031919', 29, '2024-06-03 03:19:30', '2024-06-10 12:00:00', NULL, 5000, 0, 0, NULL, 'baru', 'belum', 6),
(61, 9, 'CLN202406033519', 29, '2024-06-03 03:19:38', '2024-06-10 12:00:00', NULL, 5000, 0, 0, NULL, 'baru', 'belum', 6),
(62, 9, 'CLN202406035619', 29, '2024-06-03 03:20:38', '2024-06-10 12:00:00', NULL, 1000, 0, 0, NULL, 'baru', 'belum', 6),
(63, 9, 'CLN202406033121', 31, '2024-06-03 03:21:40', '2024-06-10 12:00:00', NULL, 1000, 0, 0, NULL, 'baru', 'belum', 6),
(64, 9, 'CLN202406031723', 31, '2024-06-03 03:23:25', '2024-06-10 12:00:00', NULL, 1000, 0, 0, NULL, 'baru', 'belum', 6),
(65, 9, 'CLN202406030425', 31, '2024-06-03 03:25:09', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 6),
(66, 9, 'CLN202406030132', 31, '2024-06-03 03:32:13', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 6),
(67, 9, 'CLN202406031732', 31, '2024-06-03 03:32:28', '2024-06-10 12:00:00', NULL, 2000, 0, 0, NULL, 'baru', 'belum', 6),
(68, 9, 'CLN202406033932', 23, '2024-06-03 03:32:51', '2024-06-10 12:00:00', NULL, 0, 5000, 0, NULL, 'baru', 'belum', 6),
(69, 9, 'CLN202406033633', 23, '2024-06-03 03:33:50', '2024-06-10 12:00:00', NULL, 0, 0, 1000, NULL, 'baru', 'belum', 6),
(70, 10, 'CLN202406030635', 31, '2024-06-03 03:35:18', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(71, 10, 'CLN202406033351', 31, '2024-06-03 03:51:42', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(72, 10, 'CLN202406034003', 31, '2024-06-03 04:03:47', '2024-06-10 12:00:00', NULL, 1000, 0, 0, NULL, 'baru', 'belum', 3),
(73, 10, 'CLN202406032605', 31, '2024-06-03 04:05:30', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(74, 10, 'CLN202406030207', 31, '2024-06-03 04:07:05', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(75, 10, 'CLN202406033607', 31, '2024-06-03 04:07:39', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(76, 10, 'CLN202406030608', 31, '2024-06-03 04:08:09', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(77, 10, 'CLN202406030410', 31, '2024-06-03 04:10:09', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(78, 10, 'CLN202406034110', 31, '2024-06-03 04:10:44', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(79, 10, 'CLN202406035613', 31, '2024-06-03 04:14:00', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(80, 10, 'CLN202406033718', 31, '2024-06-03 04:18:40', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(81, 10, 'CLN202406033919', 31, '2024-06-03 04:19:43', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(82, 10, 'CLN202406032020', 31, '2024-06-03 04:20:23', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(83, 10, 'CLN202406033825', 31, '2024-06-03 04:25:50', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 3),
(84, 9, 'CLN202406031326', 32, '2024-06-03 04:26:19', '2024-06-10 12:00:00', NULL, 0, 0, 0, NULL, 'baru', 'belum', 6),
(85, 9, 'CLN202406031927', 33, '2024-06-03 04:27:29', '2024-06-10 12:00:00', '2024-06-03 16:27:43', 1000, 0, 0, NULL, 'diambil', 'dibayar', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama_user` varchar(228) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(228) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(228) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `outlet_id` int DEFAULT NULL,
  `role` enum('admin','kasir','owner') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `outlet_id`, `role`) VALUES
(1, 'adminku', 'admin', '21232f297a57a5a743894a0e4a801fc3', 9, 'admin'),
(3, 'ownerku', 'owner', '72122ce96bfec66e2396d2e25225d70a', 10, 'owner'),
(6, 'Kasir Merah', 'kasirmerah', 'cdd9b843e296b9ff6745d122f19809d4', 9, 'kasir'),
(11, 'Kasir Kuning', 'kasirkuning', '5be5da17d3a581ccf7f5a73a0532b718', NULL, 'kasir'),
(13, 'admin 2', 'admin2', 'c84258e9c39059a89ab77d846ddab909', NULL, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indexes for table `paket_cuci`
--
ALTER TABLE `paket_cuci`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `outlet_id` (`outlet_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `outlet_id` (`outlet_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `outlet_id` (`outlet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `id_outlet` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `paket_cuci`
--
ALTER TABLE `paket_cuci`
  MODIFY `id_paket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_4` FOREIGN KEY (`id_paket`) REFERENCES `paket_cuci` (`id_paket`) ON UPDATE CASCADE;

--
-- Constraints for table `paket_cuci`
--
ALTER TABLE `paket_cuci`
  ADD CONSTRAINT `paket_cuci_ibfk_1` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`id_outlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paket_cuci_ibfk_2` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`id_outlet`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_6` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`id_outlet`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`id_outlet`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
