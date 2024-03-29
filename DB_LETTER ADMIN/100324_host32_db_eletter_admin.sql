-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2024 at 08:50 PM
-- Server version: 8.0.36
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `host32_db_eletter_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_asset`
--

CREATE TABLE `mst_asset` (
  `id` int NOT NULL,
  `no_assets` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `tahun` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `kepemilikan` varchar(255) DEFAULT NULL,
  `update_by` int DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_asset`
--

INSERT INTO `mst_asset` (`id`, `no_assets`, `name`, `merk`, `tahun`, `status`, `lokasi`, `kategori`, `kepemilikan`, `update_by`, `is_active`, `last_update`) VALUES
(1, 'B 1064 FYU', 'Kijang Innova V', 'Inova', '2013', 0, 'Delta Silicon 8', 'Mobil', 'ADASI', 1, 1, '2024-02-22 09:11:17'),
(2, 'B 1231 FYV', 'F600RV-GMDF33', 'Xenia', '2009', 0, 'Deltamas', 'Mobil', 'ADASI', 1, 1, '2024-02-22 09:11:27'),
(3, 'B 1161 FLT', 'Fortuner 2.5 G M/T', 'Fortuner', '2015', 0, 'Delta Silicon 8', 'Mobil', 'ADASI', 1, 1, '2024-02-22 04:17:49'),
(4, 'B 1187 FYY', 'S4Q1RV-ZMDEJJ HJ', 'Grandmax', '2013', 0, 'Delta Silicon 8', 'Mobil', 'ADASI', 1, 1, '2024-02-22 09:11:31'),
(5, 'Room Meeting 1st', 'Room Meeting 1st', 'RM-1st', NULL, 0, NULL, 'Ruangan', NULL, 1, 1, '2024-02-24 06:43:28'),
(6, 'Room Meeting 2st', 'Room Meeting 2st', 'RM-2st', NULL, 0, NULL, 'Ruangan', NULL, 1, 1, '2024-02-24 06:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `mst_role`
--

CREATE TABLE `mst_role` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `update_by` int DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mst_role`
--

INSERT INTO `mst_role` (`id`, `name`, `is_active`, `update_by`, `last_update`) VALUES
(1, 'DIREKSI', 1, 1, '2024-01-25 12:10:28'),
(2, 'HR', 1, 1, '2024-01-25 12:10:40'),
(3, 'ADMINISTRASI', 1, 1, '2024-01-25 12:10:54'),
(4, 'FINANCE', 1, 1, '2024-01-25 18:54:28'),
(5, 'SUPERADMIN', 1, 1, '2024-01-28 05:27:28'),
(6, 'MARKETING', 1, 1, '2024-01-30 19:06:21'),
(7, 'SP MARKETING', 1, 1, '2024-02-04 12:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `trx_assets_landing`
--

CREATE TABLE `trx_assets_landing` (
  `id` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_dephed` int DEFAULT NULL,
  `id_first` int DEFAULT NULL,
  `id_second` int DEFAULT NULL,
  `id_director` int DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `data_asset` int DEFAULT NULL,
  `necessity` text,
  `status` int DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_assets_landing`
--

INSERT INTO `trx_assets_landing` (`id`, `id_user`, `id_dephed`, `id_first`, `id_second`, `id_director`, `date_start`, `date_end`, `data_asset`, `necessity`, `status`, `last_update`) VALUES
(1, 1, 1, 1, 1, 1, '2024-03-06 13:38:10', '2024-03-06 13:38:12', 1, 'Test', 5, '2024-03-06 06:39:22'),
(2, 2, 2, 2, NULL, NULL, '2024-03-11 08:00:35', '2024-03-11 13:30:47', 4, 'ke bank', 3, '2024-03-08 06:42:22'),
(3, 2, 2, 2, NULL, NULL, '2024-03-08 13:50:20', '2024-03-08 13:50:24', 2, 'ke bank permata', 3, '2024-03-08 06:50:55'),
(4, 2, 2, 2, NULL, NULL, '2024-03-08 13:52:29', '2024-03-08 13:52:32', 4, 'ke customer', 3, '2024-03-08 06:52:46'),
(5, 2, 2, 2, NULL, NULL, '2024-03-11 20:00:36', '2024-03-11 21:00:42', 4, 'ke bank payroll', 3, '2024-03-08 12:42:34');

-- --------------------------------------------------------

--
-- Table structure for table `trx_surat`
--

CREATE TABLE `trx_surat` (
  `id` int NOT NULL,
  `letter_admin` varchar(255) DEFAULT NULL,
  `notes` text,
  `date_release` date DEFAULT NULL,
  `employe` int DEFAULT NULL,
  `to_dept` int DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `name_file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `update_by` int DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_surat`
--

INSERT INTO `trx_surat` (`id`, `letter_admin`, `notes`, `date_release`, `employe`, `to_dept`, `role_id`, `name_file`, `update_by`, `is_active`, `last_update`) VALUES
(1, '001/ADDIR/I/2024', 'Surat Kiriman', '2024-01-02', 2, 1, 2, '49627.pdf', 2, 1, '2024-02-06 18:54:24'),
(2, '002/ADDIR/I/2024', 'PPSK', '2024-01-02', 2, 1, 2, '', 2, 1, '2024-02-01 18:14:37'),
(3, '003/ADDIR/I/2024', 'PPSK', '2024-01-02', 2, 1, 2, '', 2, 1, '2024-02-01 18:14:55'),
(4, '004/ADDIR/I/2024', 'SKPK MR', '2024-01-02', 2, 1, 2, '', 2, 1, '2024-02-01 18:15:09'),
(5, '005/ADDIR/I/2024', 'SKPK Security', '2024-01-02', 2, 1, 2, '', 2, 1, '2024-02-01 18:15:23'),
(6, '006/ADDIR/I/2024', 'PKWT', '2024-01-02', 2, 1, 2, '', 2, 1, '2024-02-01 18:15:36'),
(7, '007/ADDIR/I/2024', 'SKPKT', '2024-01-02', 2, 1, 2, '', 2, 1, '2024-02-01 18:16:12'),
(8, '008/ADDIR/I/2024', 'ITAS EB', '2024-01-02', 2, 1, 2, '63218.pdf', 2, 1, '2024-02-06 01:30:59'),
(9, '009/ADDIR/I/2024', 'PKWT', '2024-01-02', 2, 1, 2, '', 2, 1, '2024-02-01 18:16:48'),
(10, '010/ADDIR/I/2024', 'SK Tunj', '2024-01-17', 2, 1, 2, '', 2, 1, '2024-02-01 18:17:15'),
(11, '011/ADDIR/I/2024', 'SK Tunj', '2024-01-17', 2, 1, 2, '', 2, 1, '2024-02-01 18:17:48'),
(12, '012/ADDIR/I/2024', 'SK Core Value', '2024-01-22', 2, 1, 2, '', 2, 1, '2024-02-01 18:18:29'),
(13, '013/ADDIR/I/2024', 'SK Neop', '2024-01-22', 2, 1, 2, '', 2, 1, '2024-02-01 18:21:34'),
(14, '014/ADDIR/I/2024', 'PKWT', '2024-01-22', 2, 1, 2, '', 2, 1, '2024-02-01 18:21:45'),
(15, '015/ADDIR/I/2024', 'Payroll', '2024-01-23', 2, 1, 2, '', 2, 1, '2024-02-01 18:21:55'),
(16, '001/HRGA/I/2024', 'Pengantar MCU SE', '2024-01-04', 7, 2, 2, '', 7, 1, '2024-02-01 18:27:40'),
(17, '002/HRGA/I/2024', 'SK Magang Clerisela', '2024-01-08', 7, 2, 2, '', 7, 1, '2024-02-01 18:28:33'),
(18, '003/HRGA/I/2024', 'SK Permohonan Pak Sapto', '2024-01-11', 7, 2, 2, '', 7, 1, '2024-02-01 18:29:01'),
(19, '004/HRGA/I/2024', 'Pemberitahuan Tetangga (Simulasi)', '2024-01-14', 7, 2, 2, '', 7, 1, '2024-02-01 18:29:37'),
(20, '005/HRGA/I/2024', 'Pemberitahuan Tetangga (Simulasi)', '2024-01-14', 7, 2, 2, '', 7, 1, '2024-02-01 18:29:48'),
(21, '006/HRGA/I/2024', 'SK Erik', '2024-01-25', 7, 2, 2, '', 7, 1, '2024-02-01 18:30:05'),
(22, '007/HRGA/I/2024', 'Pengantar MCU', '2024-01-26', 7, 2, 2, '', 7, 1, '2024-02-01 18:30:27'),
(23, '008/HRGA/I/2024', 'Training', '2024-01-29', 7, 2, 2, '', 7, 1, '2024-02-01 18:31:34'),
(24, '009/HRGA/I/2024', 'SK - Bangun Sutopo', '2024-01-29', 7, 2, 2, '', 7, 1, '2024-02-01 18:32:30'),
(25, '010/HRGA/I/2024', 'SK Magang', '2024-01-29', 7, 2, 2, '', 7, 1, '2024-02-01 18:33:25'),
(26, '011/HRGA/I/2024', 'SK - Mugi Pramono K3', '2024-01-30', 7, 2, 2, '', 7, 1, '2024-02-01 18:34:08'),
(27, '001/ADADM/I/2024', 'Reiken', '2024-01-02', 5, 3, 3, '', 5, 1, '2024-02-01 20:28:56'),
(28, '002/ADADM/I/2024', 'Pengembalian Dana', '2024-01-04', 5, 3, 3, '', 5, 1, '2024-02-01 20:30:16'),
(29, '003/ADADM/I/2024', 'Surat Tagih Non PPH', '2024-01-18', 5, 3, 3, '', 5, 1, '2024-02-01 20:31:34'),
(30, '004/ADADM/I/2024', 'Surat Permohonan Pengembalian', '2024-01-24', 5, 3, 3, '', 5, 1, '2024-02-01 20:33:11'),
(31, '005/ADADM/I/2024', 'Surat Pernyataan Perbedaan', '2024-01-30', 5, 3, 3, '', 5, 1, '2024-02-01 20:33:49'),
(32, '006/ADADM/I/2024', 'Surat Pernyataan Perbedaan', '2024-01-31', 5, 3, 3, '49552.pdf', 5, 1, '2024-02-05 21:48:57'),
(33, '007/ADADM/II/2024', 'Surat Pernyataan Perbedaan', '2024-02-02', 5, 3, 3, '38102.pdf', 5, 1, '2024-02-06 01:03:11'),
(34, '012/HRGA/II/2024', 'SK Magang', '2024-02-01', 7, 2, 2, '', 7, 1, '2024-02-01 20:34:49'),
(35, '016/ADDIR/I/2024', 'PPSK', '2024-01-23', 2, 1, 2, '', 2, 1, '2024-02-01 20:36:08'),
(36, '017/ADDIR/I/2024', 'PKWT', '2024-01-31', 2, 1, 2, '', 2, 1, '2024-02-01 20:36:23'),
(37, '007/ADADM/II/2024', 'Surat Pernyataan Perbedaan Masa Invoice, Surat Jalan, dengan Faktur Pajak', '2024-02-05', 4, 3, 4, 'Surat Keterangan Perbedaan Tanggal Invoice dan Faktur Pajak - CNC.pdf', 4, 1, '2024-02-08 14:02:54'),
(38, '008/ADADM/II/2024', 'Surat Pernyataan Perbedaan Invoice & Faktur Pajak - Indonesia Tooling Technology', '2024-02-05', 4, 3, 4, 'Surat Pernyataan Perbedaan Invoice & Faktur Pajak - PT. Indonesia Tooling Technology.pdf', 4, 1, '2024-02-08 14:07:08'),
(39, '001/ADDMKT/II/2024', 'Surat Pemberitahuan Libur', '2024-02-07', 12, 6, 6, NULL, 12, 1, '2024-02-08 13:29:01'),
(40, '013/HRGA/II/2024', 'SURAT PERSETUJUAN LINGKUNGAN PPH21 SIDOARJO', '2024-02-13', 7, 2, 2, 'Permohonan Arahan Persetujuan Lingkungan.pdf', 7, 1, '2024-02-13 03:03:05'),
(41, '014/HRGA/II/2024', 'Payroll Feb\'24', '2024-02-16', 2, 2, 2, NULL, 2, 1, '2024-02-16 05:57:16'),
(42, '002/ADDMKT/II/2024', 'Surat Pemberitahuan Sosialisasi Pemilihan Material di FIM', '2024-02-26', 15, 6, 6, 'Surat Pemberitahuan Sosialisasi Material di FIM.pdf', 15, 1, '2024-02-26 02:26:35'),
(43, '015/HRGA/II/2024', 'Surat Keterangan Kerja & Rekomendasi Pelatihan PLB3 - Faaiz', '2024-02-28', 7, 2, 2, 'Surat Keterangan Bekerja dan Rekomendasi Training PLB3 - Faaiz.pdf', 7, 1, '2024-02-28 05:29:09'),
(44, '016/HRGA/II/2024', 'Surat Keterangan Kerja & Rekomendasi Pelatihan OPLB3 - Gunawan', '2024-02-28', 7, 2, 2, 'Surat Keterangan Bekerja dan Rekomendasi Training OPLB3 - Gunawan.pdf', 7, 1, '2024-02-28 05:29:26'),
(45, '017/HRGA/III/2024', 'Permohonan Arahan Rintek Penyimpanan LB3 cabang Sidoarjo', '2024-03-04', 7, 2, 2, NULL, 7, 1, '2024-03-04 09:13:50'),
(46, '018/ADDIR/III/2024', 'PKWTT', '2024-03-08', 2, 1, 2, NULL, 2, 1, '2024-03-08 00:34:36'),
(47, '019/ADDIR/III/2024', 'PPSK', '2024-03-08', 2, 1, 2, NULL, 2, 1, '2024-03-08 00:46:21'),
(48, '018/HRGA/III/2024', 'SP2', '2024-03-08', 2, 2, 2, NULL, 2, 1, '2024-03-08 01:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `npk` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_tlp` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `update_by` int DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `pass`, `role_id`, `name`, `npk`, `email`, `no_tlp`, `foto`, `status`, `is_active`, `update_by`, `last_update`) VALUES
(1, 'superadmin', '$2y$12$0cV0/5Fy7gCIxK1T5iZ8penMy.0HPoFzdIeRbdhdI/Ez7yP.W2Y86', 'Super123', 5, 'Superadmin', '', '-', '-', '74648.jpg', 1, 1, 1, '2024-02-08 14:17:26'),
(2, 'jessica', '$2y$12$E.VaKgMUJHmTFOStJ9uUE.QCAZHYVoyzaKgV2igW2Uf4C0e7wEg8C', 'adasi', 2, 'Jessica', '5584', 'jessica@gmail.com', '0888877772', 'default.jpg', 0, 1, 1, '2024-03-08 00:47:50'),
(3, 'tes', '$2y$12$ztOPiTcW3E6gwetVtzojseB1VaageRmAg9vVu5gUpy6f4MM050O1u', '123456', 3, 'tes 123', '', 'tes@gmailo.com', '88888', '10569.png', 0, 0, 1, '2024-01-25 05:12:03'),
(4, 'Richardus', '$2y$12$39nAmxHJlPYiOOMd6cy28e6EsKZAodJxLiHNVozPRxsmYn5DWc6YO', '123', 4, 'Richardus', '', NULL, NULL, 'default.jpg', 0, 1, 1, '2024-01-30 19:45:44'),
(5, 'Dinar', '$2y$12$eq0ue0QZIKTXxsCdvrN/DeNUGt6cDU/Ph1UbgocVwFg00z9dtKiIe', '123', 3, 'Dinar', '', NULL, NULL, 'default.jpg', 0, 1, 1, '2024-01-30 19:45:21'),
(6, 'Direktur', '$2y$12$oK14uvPa/h6r.DGdcfYoo.ru3ux1uRmOLbuPCZSZAuBVkrqE9WoY2', '123', 1, 'Direktur', '', NULL, NULL, 'default.jpg', NULL, 1, 1, '2024-01-30 19:45:12'),
(7, 'Ulfa', '$2y$12$ZxET1etoPSi8Hf1cAe3Ppuew40oaO.qKxsaQL8qbZPr50bd.Mc.wq', '123', 2, 'Ulfa', '', NULL, NULL, 'default.jpg', NULL, 1, 1, '2024-01-30 19:43:11'),
(8, 'Hardi', '$2y$12$8Iv.ebZ6lR4a23N8UPVNMeZqaOsGWtZKxEe/N71WfSJ8mmz1ypZLS', '123', 7, 'Hardi', '', NULL, NULL, 'default.jpg', NULL, 1, 1, '2024-02-04 05:59:04'),
(9, 'Ridho', '$2y$12$4dsjDbznrM4C.v.Z8LYEr.owJKCNZiOTea6rm6GsbVj3tyoSfzF3W', '123', 6, 'Ridho', '', NULL, NULL, 'default.jpg', NULL, 1, 1, '2024-02-04 05:18:56'),
(10, 'Ilham', '$2y$12$WJO8XID7MR.QpGsGxWguZOQi58VQiWcdieG4OeAX9lUd9GLT7iVaa', '123', 6, 'Ilham', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-04 18:17:06'),
(11, 'Hery', '$2y$12$XRS169m9.BMyc8hyJIPwAuALg7.q5LQknguVwN70bKMfPBD6ccOSO', '123', 6, 'Hery', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-04 18:18:23'),
(12, 'Herliana', '$2y$12$fU12mzv.AtcVjNBWKb42OuyBjtOmmASF5lqciz3xx4vq3nOd/BeMa', '123', 6, 'Herliana', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-04 18:19:12'),
(13, 'Claudia', '$2y$12$inI0yf5V/pEthJQ5MBS6MO5tmP.QUYyeQ3e2rkre/3ha/43YRYWJG', '123', 6, 'Claudia', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-04 18:26:08'),
(14, 'Putri', '$2y$12$sHbYwkOhVI2Ufzxp20lMr.7P9ilb3u5OEkvq4NO5s5pyVu/6OSYIC', '123', 6, 'Putri', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-04 18:26:41'),
(15, 'Erik', '$2y$12$QbgUKDag20vZCcVgWiPXiO9QnSwfjzqqGXw51LrGcX9xIqSWK2Ue.', '123', 6, 'Erik', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-04 18:33:11'),
(16, 'Hexapa', '$2y$12$N/h/fuCxGpELA8Y8WwcOf.n9/MnnnOMvdOiJWzzZRL7/PhDrbb/di', '123', 6, 'Hexapa', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-04 18:33:34'),
(17, 'Dania', '$2y$12$o9G42PAdffdqdbnCifirG.AO.S.oxjWA3i.670n8UelkD/EDtFko2', '123', 6, 'Dania', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-05 22:46:33'),
(18, 'Jun', '$2y$12$a.GvVwcUG4lXoIX00N4WheAibdM2OScg8RtBf6tN4MgTeK8Sge8Gi', '123', 6, 'Jun', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-05 22:46:50'),
(19, 'Wulyo', '$2y$12$WdhI8y7DUllXO3PLmCTEyu6HwmDzb3dTJUzrL166ujdQmeawnnzbq', '123', 6, 'Wulyo', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-05 22:47:12'),
(20, 'Sendi', '$2y$12$q5zNNafpuzwdqreQ/X6e9uAsH860kLql6X0R4BJ6xsaL1Cid6Xyy6', '123', 6, 'Sendi', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-05 22:47:32'),
(21, 'Welem', '$2y$12$KijH2iRzIlFBDlNcK8uWm.icZ2H0Hpy.yVMz0lq2223JNP.FIuO0O', '123', 6, 'Welem', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-05 22:47:52'),
(22, 'Totok', '$2y$12$bZcNA6KorE4jcKRUfKyM3uRVbobOBCAkO5Cw1GdPtGW1/I2vFnILe', '123', 7, 'Totok', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-05 22:48:17'),
(23, 'Dwi', '$2y$12$OivzGDWlENcws2UJuxZuC.gMAaRzYjgV/WrLYh/lUzbaC5EaS07sm', '123', 6, 'Dwi', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-05 22:48:31'),
(24, 'Risfan', '$2y$12$hWMOiZTNsD.sxs7bwfMs5u4zyOBd/PDhu4HZ/esK3U1nxkkTUHYZu', '123', 6, 'Risfan', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-05 22:48:53'),
(25, 'Harry', '$2y$12$YdqaKjbanQv8riUfKu432useuIwHKwBjWyYnkQ/tLKtqgPP4n4cue', '123', 6, 'Harry', '', '-', '-', '35088.jpg', NULL, 1, 1, '2024-02-06 20:17:45'),
(26, 'Lina', '$2y$12$OJ8kwvfypGKCrdrC8LEfkO3JZJjiTUu1E6XDUEySb7z6GbVIKDN7a', '123', 6, 'Lina', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-05 22:49:25'),
(27, 'Cahyo', '$2y$12$M1yQPhrRS7E5e4aSmmlIKeViHL6EuZt/DREi9Xy1VlwlUBioyrk1q', '123', 4, 'Cahyo', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-05 22:52:00'),
(28, 'Adhi', '$2y$12$aSkI8F4B/ROuHA1oWrHFGOWhR/eM2Pu3bZv1xHhR9OkIz58KkBGqK', '123', 4, 'Adhi', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-05 22:52:19'),
(29, 'Sarah', '$2y$12$GrPySfDuTb5Say4UhP.oj.3J16D7qTd8QOik/3EBsQwhy3Xl9tJN.', '123', 6, 'Sarah', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-08 13:33:45'),
(30, 'Sony', '$2y$12$qUTwwKPvi2vWiCbuvUr8nOF/OrupY4oupLMMjjppsbE4Ltwu0NBHq', '123', 6, 'Sony', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-08 13:34:44'),
(31, 'Dimas', '$2y$12$vGb7M6CNt22Mk/ulV3Wc7.B.UwrUWxqh5BpLrxRCvmNqUuGW8kvV6', '123', 6, 'Dimas', '', '-', '-', 'default.jpg', NULL, 1, 1, '2024-02-08 13:35:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_asset`
--
ALTER TABLE `mst_asset`
  ADD KEY `id` (`id`);

--
-- Indexes for table `mst_role`
--
ALTER TABLE `mst_role`
  ADD KEY `id` (`id`);

--
-- Indexes for table `trx_assets_landing`
--
ALTER TABLE `trx_assets_landing`
  ADD KEY `id` (`id`);

--
-- Indexes for table `trx_surat`
--
ALTER TABLE `trx_surat`
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_asset`
--
ALTER TABLE `mst_asset`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mst_role`
--
ALTER TABLE `mst_role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trx_assets_landing`
--
ALTER TABLE `trx_assets_landing`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trx_surat`
--
ALTER TABLE `trx_surat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
