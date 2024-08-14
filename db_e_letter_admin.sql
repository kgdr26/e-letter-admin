/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.11.8-MariaDB : Database - db_e_letter_admin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_e_letter_admin` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;

USE `db_e_letter_admin`;

/*Table structure for table `mst_asset` */

DROP TABLE IF EXISTS `mst_asset`;

CREATE TABLE `mst_asset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_assets` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `tahun` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `kategori` int(11) DEFAULT NULL,
  `kepemilikan` varchar(255) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `mst_asset` */

insert  into `mst_asset`(`id`,`no_assets`,`name`,`merk`,`tahun`,`status`,`lokasi`,`kategori`,`kepemilikan`,`update_by`,`is_active`,`last_update`) values 
(1,'B 1064 FYU','Inova','Kijang Innova V','2013',0,'Delta Silicon 8',1,'ADASI',1,1,'2024-03-18 08:51:49'),
(2,'B 1231 FYV','Xenia','F600RV-GMDF33','2009',0,'Deltamas',1,'ADASI',1,1,'2024-03-18 08:51:53'),
(3,'B 1161 FLT','Fortuner','Fortuner 2.5 G M/T','2015',0,'Delta Silicon 8',1,'ADASI',1,0,'2024-03-25 02:54:26'),
(4,'B 1187 FYY','Grandmax','Grandmax','2013',0,'Delta Silicon 8',1,'ADASI',1,1,'2024-03-18 08:52:00'),
(5,'B 2964 FOB','Avanza','W100RE-LBDFJ 1.3 E CVT','2024',0,'Delta Silicon 8',1,'KOPERASI',1,1,'2024-03-25 02:58:43'),
(6,'B 2108 UIL','Avanza','E1.3 AT B23','2023',0,'Delta Silicon 8',1,'TRAC',1,1,'2024-03-25 02:59:53'),
(7,'Ruang Meeting Lantai 2','Room Semangat Keprimaan','RM-1st','0000',0,'Delta Silicon 8',2,'ADASI',1,1,'2024-03-20 15:25:28'),
(8,'Ruang Meeting Lantai 2','Room Kerjasama','RM-2st','0000',0,'Delta Silicon 8',2,'ADASI',1,1,'2024-03-20 15:25:34'),
(9,'Ruang Meeting Lantai 2','Room Fokus Pada Customer','RM-4st','0000',0,'Delta Silicon 8',2,'ADASI',1,1,'2024-03-20 15:25:36'),
(10,'Ruang Meeting Lantai 1','Room Terpercaya','RM-4st','0000',0,'Delta Silicon 8',2,'ADASI',1,1,'2024-03-20 15:25:41'),
(11,'Ruang Meeting Lantai 1','Room Handal','RM-5st','0000',0,'Delta Silicon 8',2,'ADASI',1,1,'2024-03-20 15:25:43');

/*Table structure for table `mst_departement` */

DROP TABLE IF EXISTS `mst_departement`;

CREATE TABLE `mst_departement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `role_dh` varchar(255) DEFAULT NULL,
  `role_sc` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `mst_departement` */

insert  into `mst_departement`(`id`,`name`,`role_dh`,`role_sc`,`is_active`,`update_by`,`last_update`) values 
(1,'DEPT. SALES','7',NULL,1,1,'2024-06-11 21:17:05'),
(2,'DEPT. FIN ACC HRGA IT','8','11,16',1,1,'2024-06-11 21:19:20'),
(3,'DEPT. SUPPLY CHAIN','9','12,13,14,15',1,1,'2024-06-11 21:20:06'),
(4,'DEPT. PRODUCTIONS HT','10',NULL,1,1,'2024-06-11 21:17:15');

/*Table structure for table `mst_karyawan` */

DROP TABLE IF EXISTS `mst_karyawan`;

CREATE TABLE `mst_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `npk` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_tlp` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `mst_karyawan` */

insert  into `mst_karyawan`(`id`,`name`,`npk`,`email`,`no_tlp`,`status`,`is_active`,`update_by`,`last_update`) values 
(1,'ADHI PRASETIYO','5519',NULL,NULL,NULL,1,1,'2024-05-13 20:49:01'),
(2,'AHMAD RIDWAN','5473',NULL,NULL,NULL,1,1,'2024-05-13 20:49:08'),
(3,'ANDI SIMPONI','5426',NULL,NULL,NULL,1,1,'2024-05-13 20:49:13'),
(4,'ANDIK TOTOK SISWOYO','5456',NULL,NULL,NULL,1,1,'2024-05-13 20:49:17'),
(5,'ARY RODJO PRASETYO','5439',NULL,NULL,NULL,1,1,'2024-05-13 20:49:21'),
(6,'AVI SHENNA','5558',NULL,NULL,NULL,1,1,'2024-05-13 20:49:24'),
(7,'AWING','5538',NULL,NULL,NULL,1,1,'2024-05-13 20:49:29'),
(8,'BANGUN SUTOPO','5485',NULL,NULL,NULL,1,1,'2024-05-13 20:49:38'),
(9,'CECEP ISKANDAR','5647',NULL,NULL,NULL,1,1,'2024-05-13 20:49:43'),
(10,'DANIA ISNAWATI','5607',NULL,NULL,NULL,1,1,'2024-05-13 20:49:48'),
(11,'DIMAS ADITYA PRIANDANA','5655',NULL,NULL,NULL,1,1,'2024-05-13 20:49:50'),
(12,'DINA NIMAS AYU NAWAWULAN PRIHANTINI','5447',NULL,NULL,NULL,1,1,'2024-05-13 20:49:54'),
(13,'DWI KUNTORO','5644',NULL,NULL,NULL,1,1,'2024-05-13 20:49:56'),
(14,'ELI HANDOYO','5572',NULL,NULL,NULL,1,1,'2024-05-13 20:50:01'),
(15,'ERIK KHARISMA PUTRA','5653',NULL,NULL,NULL,1,1,'2024-05-13 20:50:04'),
(16,'FIKRI SYAHBANA','5559',NULL,NULL,NULL,1,1,'2024-05-13 20:50:08'),
(17,'FRISILIA CLAUDIA HUTAMA','5606',NULL,NULL,NULL,1,1,'2024-05-13 20:50:12'),
(18,'GUNAWAN','5421',NULL,NULL,NULL,1,1,'2024-05-13 20:50:18'),
(19,'HARDI SAPUTRA','5424',NULL,NULL,NULL,1,1,'2024-05-13 20:50:30'),
(20,'HARRY SUPRIYADI','5410',NULL,NULL,NULL,1,1,'2024-05-13 20:50:45'),
(21,'HERLIANA','5428',NULL,NULL,NULL,1,1,'2024-05-13 20:50:50'),
(22,'HERY HERMAWAN','5591',NULL,NULL,NULL,1,1,'2024-05-13 20:51:03'),
(23,'HEXAPA DARMADI','5658',NULL,NULL,NULL,1,1,'2024-05-13 20:51:08'),
(24,'HUSEIN ABDULLAH','5652',NULL,NULL,NULL,1,1,'2024-05-13 20:51:12'),
(25,'ILHAM CHOLID','5530',NULL,NULL,NULL,1,1,'2024-05-13 20:51:14'),
(26,'ILHAM SETIA DARMA','5651',NULL,NULL,NULL,1,1,'2024-05-13 20:51:18'),
(27,'IMAM PRASETYO','5543',NULL,NULL,NULL,1,1,'2024-05-13 20:51:20'),
(28,'IMAM SOPYAN','5641',NULL,NULL,NULL,1,1,'2024-05-13 20:51:23'),
(29,'JEFRY WASTON .E','5488',NULL,NULL,NULL,1,1,'2024-05-13 20:51:25'),
(30,'JESSICA PAUNE','5584',NULL,NULL,NULL,1,1,'2024-05-13 20:51:29'),
(31,'JONI SETIAWAN','5545',NULL,NULL,NULL,1,1,'2024-05-13 20:51:33'),
(32,'JUN JOHAMIN PD','5371',NULL,NULL,NULL,1,1,'2024-05-13 20:51:36'),
(33,'KUSTIONO','5560',NULL,NULL,NULL,1,1,'2024-05-13 20:51:38'),
(34,'LINA UNIARSIH','5580',NULL,NULL,NULL,1,1,'2024-05-13 20:51:40'),
(35,'LUKMAN AHMAD','5574',NULL,NULL,NULL,1,1,'2024-05-13 20:51:46'),
(36,'M. RIDWAN GUNAWAN','5525',NULL,NULL,NULL,1,1,'2024-05-13 20:51:54'),
(37,'MARTINUS CAHYO RAHASTO','5635',NULL,NULL,NULL,1,1,'2024-05-13 20:51:58'),
(38,'MOCHAMMAD ANDRIANSYAH','5659',NULL,NULL,NULL,1,1,'2024-05-13 20:52:00'),
(39,'MOHAMMAD FATKHURROHMAN','5576',NULL,NULL,NULL,1,1,'2024-05-13 20:52:12'),
(40,'MUHAMMAD DINAR FARISI','5648',NULL,NULL,NULL,1,1,'2024-05-13 20:52:21'),
(41,'MUHAMMAD MAHBUB','5552',NULL,NULL,NULL,1,1,'2024-05-13 20:52:24'),
(42,'NUR DWITA SURA WIJAYA','5531',NULL,NULL,NULL,1,1,'2024-05-13 20:52:26'),
(43,'PUTRI ANINDIA','5597',NULL,NULL,NULL,1,1,'2024-05-13 20:52:30'),
(44,'RAGIL ISHA RAHMANTO','5639',NULL,NULL,NULL,1,1,'2024-05-13 20:52:34'),
(45,'RIADUS SOLIHIN','5570',NULL,NULL,NULL,1,1,'2024-05-13 20:52:37'),
(46,'RICHARDUS','5660',NULL,NULL,NULL,1,1,'2024-05-13 20:52:40'),
(47,'RISFAN FAISAL','5387',NULL,NULL,NULL,1,1,'2024-05-13 20:52:48'),
(48,'RUSLAN M.ALI','5403',NULL,NULL,NULL,1,1,'2024-05-13 20:52:52'),
(49,'SENDY PRABOWO','5596',NULL,NULL,NULL,1,1,'2024-05-13 20:52:55'),
(50,'SETIYAWAN','5540',NULL,NULL,NULL,1,1,'2024-05-13 20:52:59'),
(51,'SITI MARIA ULFA','5657',NULL,NULL,NULL,1,1,'2024-05-13 20:53:11'),
(52,'SONY STIAWAN','5391',NULL,NULL,NULL,1,1,'2024-05-13 20:53:18'),
(53,'SUDIYATNO','5366',NULL,NULL,NULL,1,1,'2024-05-13 20:53:22'),
(54,'SUKIMIN','5430',NULL,NULL,NULL,1,1,'2024-05-13 20:53:25'),
(55,'WULYO EKO PRASETYO','5459',NULL,NULL,NULL,1,1,'2024-05-13 20:53:29'),
(56,'YAN WELEM MANGINSELA','5650',NULL,NULL,NULL,1,1,'2024-05-13 20:53:32'),
(57,'YANUARDIN SALEH SIREGAR','5537',NULL,NULL,NULL,1,1,'2024-05-13 20:53:35'),
(58,'YUDHI PRASETYO RAHMAWANTO','5548',NULL,NULL,NULL,1,1,'2024-05-13 20:53:39'),
(59,'YULMAI RIDO WINANDA','56',NULL,NULL,NULL,1,1,'2024-05-13 20:53:42'),
(60,'YUNASIS PALGUNADI','5375',NULL,NULL,NULL,1,1,'2024-05-13 20:54:00'),
(61,'ZAENAL ARIFIN','5486',NULL,NULL,NULL,1,1,'2024-05-13 20:54:05'),
(62,'ABDUR RAHMAN AL FAAIZ','5520',NULL,NULL,NULL,1,1,'2024-05-13 20:54:07'),
(63,'AFILIANDI','5487',NULL,NULL,NULL,1,1,'2024-05-13 20:54:12'),
(64,'AGUNG PANGESTU YUSUF','5535',NULL,NULL,NULL,1,1,'2024-05-13 20:54:17'),
(65,'AGUS PRIYANTO','5418',NULL,NULL,NULL,1,1,'2024-05-13 20:54:24'),
(66,'AGUS ROSIDIN','5600',NULL,NULL,NULL,1,1,'2024-05-13 20:54:26'),
(67,'ANDI SANTOSO','5533',NULL,NULL,NULL,1,1,'2024-05-13 20:54:28'),
(68,'ANDI SIMPONI','5426',NULL,NULL,NULL,1,1,'2024-05-13 20:54:35'),
(69,'ARRY SOEBHEKTI','5543',NULL,NULL,NULL,1,1,'2024-05-13 20:54:40'),
(70,'AWING','5538',NULL,NULL,NULL,1,1,'2024-05-13 20:54:42'),
(71,'DASUKI','5425',NULL,NULL,NULL,1,1,'2024-05-13 20:54:52'),
(72,'DEDY SETIAWAN','5388',NULL,NULL,NULL,1,1,'2024-05-13 20:54:56'),
(73,'DIAMAN DARMAWINATA','5551',NULL,NULL,NULL,1,1,'2024-05-13 20:55:00'),
(74,'ELI HANDOYO','5572',NULL,NULL,NULL,1,1,'2024-05-13 20:55:05'),
(75,'FAIZAL AFDAU','5578',NULL,NULL,NULL,1,1,'2024-05-13 20:55:08'),
(76,'FATUL MUKMIN','5616',NULL,NULL,NULL,1,1,'2024-05-13 20:55:10'),
(77,'HAERUL IKHSAN','5542',NULL,NULL,NULL,1,1,'2024-05-13 20:55:15'),
(78,'HENDRIO','5569',NULL,NULL,NULL,1,1,'2024-05-13 20:55:21'),
(79,'JAKA RARA SUKMA','5536',NULL,NULL,NULL,1,1,'2024-05-13 20:55:26'),
(80,'JAKARIA','5544',NULL,NULL,NULL,1,1,'2024-05-13 20:55:29'),
(81,'KARYA WIJAYA','5546',NULL,NULL,NULL,1,1,'2024-05-13 20:55:32'),
(82,'LUKMAN AHMAD','5574',NULL,NULL,NULL,1,1,'2024-05-13 20:55:35'),
(83,'MAMIK ABIDIN','5434',NULL,NULL,NULL,1,1,'2024-05-13 20:55:39'),
(84,'MEDI KRISNANTO','5661',NULL,NULL,NULL,1,1,'2024-05-11 17:58:17'),
(85,'MIFTAKHUROHMAN','5489',NULL,NULL,NULL,1,1,'2024-05-13 20:55:50'),
(86,'MUGI PRAMONO','5649',NULL,NULL,NULL,1,1,'2024-05-13 20:55:55'),
(87,'NUR SUPRIYANTO','5564',NULL,NULL,NULL,1,1,'2024-05-13 20:55:58'),
(88,'NURSAID','5264',NULL,NULL,NULL,1,1,'2024-05-13 20:56:01'),
(89,'NURSALIM','5539',NULL,NULL,NULL,1,1,'2024-05-13 20:56:08'),
(90,'R.WAWAN HIMAWAN','5457',NULL,NULL,NULL,1,1,'2024-05-13 20:56:22'),
(91,'RAHMAT NUGROHO','5582',NULL,NULL,NULL,1,1,'2024-05-13 20:56:25'),
(92,'RANGGA FADILLAH','5605',NULL,NULL,NULL,1,1,'2024-05-13 20:56:28'),
(93,'RIZKY ANDREA RAHMAWAN','5586',NULL,NULL,NULL,1,1,'2024-05-13 20:56:34'),
(94,'RUKMAN','5419',NULL,NULL,NULL,1,1,'2024-05-13 20:56:38'),
(95,'RUSITO','5397',NULL,NULL,NULL,1,1,'2024-05-13 20:56:42'),
(96,'SABAR WASIRAN','5646',NULL,NULL,NULL,1,1,'2024-05-13 20:56:48'),
(97,'SEPTIADI PRATOMO','5466',NULL,NULL,NULL,1,1,'2024-05-13 20:56:50'),
(98,'SUDIYATNO','5366',NULL,NULL,NULL,1,1,'2024-05-13 20:56:53'),
(99,'UMAR HADI','5541',NULL,NULL,NULL,1,1,'2024-05-13 20:56:56'),
(100,'VITRI HANDAYANI','5632',NULL,NULL,NULL,1,1,'2024-05-13 20:57:02'),
(101,'YANUARDIN SALEH SIREGAR','5537',NULL,NULL,NULL,1,1,'2024-05-13 20:57:08'),
(102,'YUSUF SYAFAAT','5472',NULL,NULL,NULL,1,1,'2024-05-13 20:57:20');

/*Table structure for table `mst_role` */

DROP TABLE IF EXISTS `mst_role`;

CREATE TABLE `mst_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `whr_input_surat` varchar(255) DEFAULT NULL,
  `whr_show_surat` varchar(255) DEFAULT NULL,
  `whr_show_assets` varchar(255) DEFAULT NULL,
  `whr_show_ticket` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `mst_role` */

insert  into `mst_role`(`id`,`name`,`whr_input_surat`,`whr_show_surat`,`whr_show_assets`,`whr_show_ticket`,`is_active`,`update_by`,`last_update`) values 
(1,'SUPERADMIN','2,3,4,5,6','1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25','1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25','1,2,3,4,5',1,1,'2024-06-13 08:22:22'),
(2,'HR','5,2',NULL,NULL,NULL,1,1,'2024-05-11 15:46:21'),
(3,'ADMINISTRASI','3',NULL,NULL,NULL,1,1,'2024-05-11 15:46:25'),
(4,'FINANCE','4',NULL,NULL,NULL,1,1,'2024-05-11 15:46:33'),
(5,'DIREKSI','5',NULL,NULL,NULL,1,1,'2024-05-11 15:46:41'),
(6,'MARKETING','6',NULL,NULL,NULL,1,1,'2024-05-11 15:46:46'),
(7,'DH-SALES','6','7,17','17','2',1,1,'2024-06-13 08:22:44'),
(8,'DH-FIN ACC HRGA IT','5,2,4','8,11,16,21,22','11,16,20,21,22','2',1,1,'2024-06-13 08:22:47'),
(9,'DH-SUPPLY CHAIN',NULL,NULL,'12,13,14,15,18,19','2',1,1,'2024-06-13 08:22:48'),
(10,'DH-HT PROD',NULL,NULL,'25','2',1,1,'2024-06-13 08:22:55'),
(11,'SC-FIN','2,4','11,22',NULL,'3',1,1,'2024-06-13 08:22:58'),
(12,'SC-CT PROD',NULL,NULL,NULL,'3',1,1,'2024-06-13 08:22:59'),
(13,'SC-MC PROD',NULL,NULL,NULL,'3',1,1,'2024-06-13 08:23:01'),
(14,'SC-PPC',NULL,NULL,NULL,'3',1,1,'2024-06-13 08:23:02'),
(15,'SC-WHS',NULL,NULL,NULL,'3',1,1,'2024-06-13 08:23:03'),
(16,'SC-HRGA','5,2','5,2,16','11,16,20,21,22','3',1,1,'2024-06-13 08:23:04'),
(17,'UR-SALES','6','17',NULL,NULL,1,1,'2024-05-12 21:10:10'),
(18,'UR-CT PROD',NULL,NULL,NULL,NULL,1,1,'2024-05-11 15:47:29'),
(19,'UR-MC PROD',NULL,NULL,NULL,NULL,1,1,'2024-05-11 15:47:32'),
(20,'UR-ADMIN FIN','3,4','20',NULL,NULL,1,1,'2024-05-12 21:06:03'),
(21,'UR-HR','5,2','21',NULL,NULL,1,1,'2024-05-12 21:08:34'),
(22,'UR-GA','3','22',NULL,NULL,1,1,'2024-05-12 21:06:17'),
(23,'UR-DOCUMENT','3','23',NULL,NULL,1,1,'2024-05-12 21:08:40'),
(24,'UR-SECURITY',NULL,NULL,NULL,NULL,1,1,'2024-05-11 15:47:50'),
(25,'UR-HT PROD',NULL,NULL,NULL,NULL,1,1,'2024-05-11 15:47:54');

/*Table structure for table `mst_status_ticket` */

DROP TABLE IF EXISTS `mst_status_ticket`;

CREATE TABLE `mst_status_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `mst_status_ticket` */

insert  into `mst_status_ticket`(`id`,`name`,`is_active`,`update_by`,`last_update`) values 
(1,'CREATE',1,1,'2024-06-04 06:05:58'),
(2,'APPRIVE SECHEAD',1,1,'2024-06-11 21:08:13'),
(3,'APPRIVE DEPHEAD',1,1,'2024-06-11 21:08:06'),
(4,'ON PROGRESS BY IT',1,1,'2024-06-11 21:09:18'),
(5,'RESOLVED BY IT',1,1,'2024-06-11 21:09:06'),
(6,'CLOSED BY IT',1,1,'2024-06-11 21:08:41'),
(7,'REJECT',1,1,'2024-06-11 21:09:27');

/*Table structure for table `trx_assets_landing` */

DROP TABLE IF EXISTS `trx_assets_landing`;

CREATE TABLE `trx_assets_landing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `date_create` text DEFAULT NULL,
  `id_dephed` int(11) DEFAULT NULL,
  `dephed_detail` text DEFAULT NULL,
  `id_first` int(11) DEFAULT NULL,
  `first_detail` text DEFAULT NULL,
  `id_second` int(11) DEFAULT NULL,
  `second_detail` text DEFAULT NULL,
  `id_director` int(11) DEFAULT NULL,
  `director_detail` text DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `arrtgl` text DEFAULT NULL,
  `data_asset` int(11) DEFAULT NULL,
  `necessity` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_assets_landing` */

insert  into `trx_assets_landing`(`id`,`id_user`,`date_create`,`id_dephed`,`dephed_detail`,`id_first`,`first_detail`,`id_second`,`second_detail`,`id_director`,`director_detail`,`date_start`,`date_end`,`arrtgl`,`data_asset`,`necessity`,`status`,`update_by`,`last_update`) values 
(3,15,NULL,8,'',7,'',33,'',33,'','2024-04-18 09:30:18','2024-04-18 17:00:38','[\"2024-04-18\"]',6,'Visit customer mekar langgeng & arwina',5,0,'2024-04-18 09:15:09'),
(4,37,NULL,8,'',7,'',33,'',33,'','2024-04-18 10:00:46','2024-04-18 16:00:59','[\"2024-04-18\"]',5,'Visit misuzima',5,0,'2024-04-18 09:15:01'),
(5,7,NULL,27,'',7,'',33,'',33,'','2024-04-19 14:30:45','2024-04-19 17:00:00','[\"2024-04-19\"]',5,'Meeting di EDC',5,0,'2024-04-19 03:05:42'),
(6,15,NULL,1,'',1,'',1,'',1,'','2024-04-19 09:30:58','2024-04-19 17:00:03','[\"2024-04-19\"]',6,'Visit customer jembar maju persada & maju bersama manufacturing',5,0,'2024-04-19 10:26:38'),
(7,1,NULL,1,'',1,'',1,'',33,'','2024-04-19 17:30:01','2024-04-19 19:30:04','[\"2024-04-19\"]',1,'ke Deltamas pakai mobil Inova...',5,0,'2024-04-19 15:04:40'),
(8,2,NULL,27,'',2,'',33,'',33,'','2024-04-22 16:00:53','2024-04-22 22:00:04','[\"2024-04-22\"]',1,'Ke Kelapa Gading acara Farewell',5,0,'2024-04-22 14:58:56'),
(9,36,NULL,40,'',2,'',33,'',33,'','2024-04-22 16:00:53','2024-04-22 22:00:50','[\"2024-04-22\"]',5,'Farewell Pak Handri di kelapa gading',5,0,'2024-04-22 14:42:04'),
(10,30,NULL,8,'',2,'',33,'',33,'','2024-04-23 10:00:00','2024-04-23 16:30:00','[\"2024-04-23\"]',1,'Adhikari Presisi Man., Arfindo Cipta Tek., Andalas makmur',5,0,'2024-04-23 09:43:14'),
(12,37,NULL,8,'',2,'',33,'',33,'','2024-04-23 08:45:39','2024-04-22 16:00:00','[\"2024-04-23\"]',5,'Visit pastek',5,0,'2024-04-23 09:28:10'),
(13,16,NULL,1,'',2,'',33,'',33,'','2024-04-23 08:37:03','2024-04-23 16:30:53','[\"2024-04-23\"]',6,'visit customer : nikitools, batum sarana',5,0,'2024-04-23 09:01:12'),
(14,30,NULL,8,'',2,'',33,'',33,'','2024-04-24 10:00:00','2024-04-24 16:00:00','[\"2024-04-24\"]',1,'Customer DPT, Yuratek',5,0,'2024-04-24 09:38:17'),
(15,5,NULL,27,'',2,'',33,'',33,'','2024-04-24 10:00:31','2024-04-24 15:00:53','[\"2024-04-24\"]',5,'visit deltamas, cek AC ke vendor, beli peralatan kamar mandi',5,0,'2024-04-25 01:40:18'),
(16,16,NULL,8,'',2,'',33,'',33,'','2024-04-24 09:30:41','2024-04-24 17:00:54','[\"2024-04-24\"]',6,'visit matahari terbit dan maju teknik utama',5,0,'2024-04-24 09:38:22'),
(17,2,NULL,27,'',2,'',33,'',33,'','2024-04-26 08:00:50','2024-04-26 14:00:01','[\"2024-04-26\"]',1,'RAT KOPERASI ASTRA',5,0,'2024-04-25 09:40:11'),
(18,36,NULL,40,'',2,'',33,'',33,'','2024-04-25 08:00:20','2024-04-22 13:00:53','[\"2024-04-25\"]',1,'Benchmark AOP Cibitung',5,0,'2024-04-25 07:01:15'),
(19,37,NULL,8,'',2,'',33,'',33,'','2024-04-25 09:15:11','2024-04-25 17:00:35','[\"2024-04-25\"]',6,'Visit,naratama,dan gesang',5,0,'2024-04-25 09:37:38'),
(20,15,NULL,8,'',2,'',33,'',33,'','2024-04-25 09:00:15','2024-04-25 16:45:20','[\"2024-04-25\"]',5,'Visit customer nusa pratama teknik dan maju bersama manufacturing',5,1,'2024-05-29 09:42:58'),
(21,2,NULL,27,'',2,'',33,'',33,'','2024-04-26 11:00:03','2024-04-26 17:00:15','[\"2024-04-26\"]',5,'RAT KOPKAR ke Jakarta',5,1,'2024-05-29 09:42:57'),
(22,15,NULL,8,'',2,'',33,'',33,'','2024-04-26 09:15:37','2024-04-26 16:45:46','[\"2024-04-26\"]',6,'Visit customer sewis dan mitra tehnik',5,1,'2024-05-29 09:42:59'),
(23,37,NULL,8,'',2,'',33,'',33,'','2024-04-26 09:45:50','2024-04-26 16:45:06','[\"2024-04-26\"]',4,'Inkoasku',5,1,'2024-05-29 09:43:00'),
(24,37,NULL,8,'',2,'',33,'',33,'','2024-04-29 09:30:53','2024-04-25 08:14:45','[]',5,'Naratamaxjembar',5,1,'2024-05-29 09:43:00'),
(25,30,NULL,8,'',2,'',33,'',33,'','2024-04-29 09:30:47','2024-04-29 16:30:10','[\"2024-04-29\"]',1,'Customer IMS, MSmold, Daiho',5,1,'2024-05-29 09:43:01'),
(26,15,NULL,8,'',2,'',33,'',33,'','2024-04-29 08:30:53','2024-04-29 16:45:57','[\"2024-04-29\"]',6,'Visit customer gunjaya dan selaras migunani',5,1,'2024-05-29 09:43:02'),
(27,1,NULL,1,'',NULL,'',NULL,'',NULL,'','2024-04-29 09:02:22','2024-04-29 10:00:26','[\"2024-04-29\"]',4,'-',6,1,'2024-05-29 09:43:02'),
(28,29,NULL,8,'[\"2024-04-30 08:27:30\",\"-\"]',1,'[\"2024-04-30 08:46:24\",\"-\"]',33,'[\"2024-04-30 08:54:54\",\"-\"]',33,'[\"2024-04-30 15:36:24\",\"-\"]','2024-04-30 08:30:02','2024-04-30 16:45:11','[\"2024-04-30\"]',5,'kirim barang dan kunjungan ke PT. Pretec , PT. Koito',5,1,'2024-05-29 09:43:03'),
(30,5,NULL,1,'[\"2024-05-02 07:10:44\",\"rejected, expired\"]',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-30 10:00:17','2024-04-30 14:00:22','[\"2024-04-30 10\",\"2024-04-30 11\",\"2024-04-30 12\",\"2024-04-30 13\",\"2024-04-30 14\"]',5,'cek kipas',6,1,'2024-05-29 09:43:04'),
(31,15,NULL,8,'[\"2024-04-30 09:02:42\",\"-\"]',1,'[\"2024-04-30 09:29:45\",\"-\"]',33,'[\"2024-04-30 09:30:28\",\"-\"]',33,'[\"2024-05-02 09:37:20\",\"-\"]','2024-04-30 09:00:48','2024-04-30 16:45:51','[\"2024-04-30 09\",\"2024-04-30 10\",\"2024-04-30 11\",\"2024-04-30 12\",\"2024-04-30 13\",\"2024-04-30 14\",\"2024-04-30 15\",\"2024-04-30 16\"]',6,'Visit customer putra karya teknik dan jaya mandiri indotech',5,33,'2024-05-02 02:37:20'),
(32,30,NULL,8,'[\"2024-04-30 09:03:57\",\"-\"]',1,'[\"2024-04-30 09:29:51\",\"-\"]',33,'[\"2024-04-30 10:21:51\",\"-\"]',33,'[\"2024-04-30 14:47:05\",\"-\"]','2024-04-30 10:00:50','2024-04-30 16:00:57','[\"2024-04-30 10\",\"2024-04-30 11\",\"2024-04-30 12\",\"2024-04-30 13\",\"2024-04-30 14\",\"2024-04-30 15\",\"2024-04-30 16\"]',1,'Visit Andalas, Oritsu, Cakrawala',5,1,'2024-05-29 09:43:05'),
(33,1,'2024-05-02 05:33:53',1,'[\"2024-05-02 07:09:21\",\"hanya testing data\"]',NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-02 05:30:41','2024-05-02 08:45:45','[\"2024-05-02 05\",\"2024-05-02 06\",\"2024-05-02 07\",\"2024-05-02 08\"]',1,'asdasdasd',6,1,'2024-05-02 00:09:22'),
(34,1,'2024-05-02 07:11:17',1,'[\"2024-05-02 07:11:49\",\"Reject.. Testing basis data\"]',NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-02 07:15:54','2024-05-02 07:30:00','[\"2024-05-02 07\"]',4,'test data',6,1,'2024-05-02 00:11:49'),
(35,15,'2024-05-02 09:00:28',8,'[\"2024-05-02 09:28:31\",\"-\"]',2,'[\"2024-05-02 10:02:04\",\"-\"]',33,'[\"2024-05-02 11:37:07\",\"-\"]',33,'[\"2024-05-02 16:48:22\",\"-\"]','2024-05-02 09:30:33','2024-05-02 16:45:46','[\"2024-05-02 09\",\"2024-05-02 10\",\"2024-05-02 11\",\"2024-05-02 12\",\"2024-05-02 13\",\"2024-05-02 14\",\"2024-05-02 15\",\"2024-05-02 16\"]',6,'Visit customer kosen seiko dan quantumplast industry',5,33,'2024-05-02 09:48:21'),
(36,7,'2024-05-02 09:20:36',27,'[\"2024-05-03 09:24:34\",\"-\"]',7,'[\"2024-05-03 09:33:29\",\"-\"]',33,'[\"2024-05-03 10:07:16\",\"-\"]',33,'[\"2024-05-03 18:42:08\",\"-\"]','2024-05-03 07:30:02','2024-05-03 17:00:10','[\"2024-05-03 07\",\"2024-05-03 08\",\"2024-05-03 09\",\"2024-05-03 10\",\"2024-05-03 11\",\"2024-05-03 12\",\"2024-05-03 13\",\"2024-05-03 14\",\"2024-05-03 15\",\"2024-05-03 16\"]',5,'Acara HR',5,33,'2024-05-03 11:42:08'),
(37,40,'2024-05-02 09:27:37',8,'[\"2024-05-02 09:29:12\",\"-\"]',2,'[\"2024-05-02 10:02:09\",\"-\"]',33,'[\"2024-05-02 10:04:33\",\"-\"]',33,'[\"2024-05-02 16:47:48\",\"-\"]','2024-05-02 10:00:55','2024-05-02 17:00:09','[\"2024-05-02 10\",\"2024-05-02 11\",\"2024-05-02 12\",\"2024-05-02 13\",\"2024-05-02 14\",\"2024-05-02 15\",\"2024-05-02 16\"]',5,'visit coustamer,gesang.kasen',5,33,'2024-05-02 09:47:47'),
(38,30,'2024-05-02 11:15:06',8,'[\"2024-05-02 11:39:05\",\"-\"]',7,'[\"2024-05-02 11:54:42\",\"-\"]',33,'[\"2024-05-02 11:54:59\",\"-\"]',33,'[\"2024-05-02 16:49:04\",\"-\"]','2024-05-02 11:45:17','2024-05-02 16:00:35','[\"2024-05-02 11\",\"2024-05-02 12\",\"2024-05-02 13\",\"2024-05-02 14\",\"2024-05-02 15\"]',1,'Customer Arfindo, Hastech',5,33,'2024-05-02 09:49:03'),
(39,15,'2024-05-03 08:01:31',8,'[\"2024-05-03 08:29:05\",\"-\"]',7,'[\"2024-05-03 08:47:16\",\"-\"]',33,'[\"2024-05-03 10:09:07\",\"-\"]',33,'[\"2024-05-03 16:42:02\",\"-\"]','2024-05-03 09:00:01','2024-05-03 16:45:06','[\"2024-05-03 09\",\"2024-05-03 10\",\"2024-05-03 11\",\"2024-05-03 12\",\"2024-05-03 13\",\"2024-05-03 14\",\"2024-05-03 15\",\"2024-05-03 16\"]',6,'Visit customer nikitools dan kallita engineering',5,33,'2024-05-03 09:42:01'),
(40,30,'2024-05-03 08:47:44',8,'[\"2024-05-03 09:19:13\",\"-\"]',7,'[\"2024-05-03 09:33:58\",\"-\"]',33,'[\"2024-05-03 11:57:06\",\"-\"]',33,'[\"2024-05-03 16:26:55\",\"-\"]','2024-05-03 11:00:30','2024-05-03 16:30:41','[\"2024-05-03 11\",\"2024-05-03 12\",\"2024-05-03 13\",\"2024-05-03 14\",\"2024-05-03 15\",\"2024-05-03 16\"]',1,'Customer Excel Rim, Sinergi Smart',5,33,'2024-05-03 09:26:54'),
(41,29,'2024-05-06 06:51:28',8,'[\"2024-05-06 09:17:22\",\"-\"]',7,'[\"2024-05-06 09:41:58\",\"-\"]',33,'[\"2024-05-06 09:48:17\",\"-\"]',33,'[\"2024-05-06 16:24:00\",\"-\"]','2024-05-06 08:30:29','2024-05-06 16:45:20','[\"2024-05-06 08\",\"2024-05-06 09\",\"2024-05-06 10\",\"2024-05-06 11\",\"2024-05-06 12\",\"2024-05-06 13\",\"2024-05-06 14\",\"2024-05-06 15\",\"2024-05-06 16\"]',5,'Visit indonesia kyouei saikyu & mitra metal perkasa',5,33,'2024-05-06 09:24:00'),
(42,15,'2024-05-06 08:54:30',8,'[\"2024-05-06 09:17:26\",\"-\"]',7,'[\"2024-05-06 09:42:02\",\"-\"]',33,'[\"2024-05-06 11:03:59\",\"-\"]',33,'[\"2024-05-06 16:25:36\",\"-\"]','2024-05-06 09:00:45','2024-05-06 16:30:49','[\"2024-05-06 09\",\"2024-05-06 10\",\"2024-05-06 11\",\"2024-05-06 12\",\"2024-05-06 13\",\"2024-05-06 14\",\"2024-05-06 15\",\"2024-05-06 16\"]',6,'Visit customer Sewis dan mekar langgeng Bogor',5,33,'2024-05-06 09:25:36'),
(43,7,'2024-05-06 09:44:30',27,'[\"2024-05-06 10:16:12\",\"-\"]',7,'[\"2024-05-06 10:20:36\",\"-\"]',33,'[\"2024-05-08 10:33:01\",\"-\"]',33,'[\"2024-05-08 16:46:57\",\"-\"]','2024-05-08 10:30:09','2024-05-08 14:00:18','[\"2024-05-08 10\",\"2024-05-08 11\",\"2024-05-08 12\",\"2024-05-08 13\"]',5,'Meeting CSR Regional Bekasi di TACI',5,33,'2024-05-08 09:46:56'),
(44,30,'2024-05-06 10:26:10',8,'[\"2024-05-06 10:28:36\",\"-\"]',7,'[\"2024-05-06 10:29:43\",\"-\"]',33,'[\"2024-05-06 11:19:42\",\"-\"]',33,'[\"2024-05-06 16:24:13\",\"-\"]','2024-05-06 11:00:59','2024-05-06 16:00:13','[\"2024-05-06 11\",\"2024-05-06 12\",\"2024-05-06 13\",\"2024-05-06 14\",\"2024-05-06 15\"]',1,'Customer Standard Smart, SES, Oritsu',5,33,'2024-05-06 09:24:13'),
(45,5,'2024-05-06 16:25:02',27,'[\"2024-05-07 17:20:03\",\"cancel\"]',NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-07 09:00:43','2024-05-07 16:00:53','[\"2024-05-07 09\",\"2024-05-07 10\",\"2024-05-07 11\",\"2024-05-07 12\",\"2024-05-07 13\",\"2024-05-07 14\",\"2024-05-07 15\",\"2024-05-07 16\"]',5,'ke aeon mall - cek alat keperluan renovasi kamar mandi',6,5,'2024-05-07 10:20:03'),
(46,4,'2024-05-06 16:57:50',27,'[\"2024-05-07 17:19:31\",\"sudah dibooking\"]',NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-08 06:00:19','2024-05-08 18:15:24','[\"2024-05-08 06\",\"2024-05-08 07\",\"2024-05-08 08\",\"2024-05-08 09\",\"2024-05-08 10\",\"2024-05-08 11\",\"2024-05-08 12\",\"2024-05-08 13\",\"2024-05-08 14\",\"2024-05-08 15\",\"2024-05-08 16\",\"2024-05-08 17\",\"2024-05-08 18\"]',5,'Consolidation and Tax Forum 2024 (AOP)',6,4,'2024-05-07 10:19:31'),
(47,16,'2024-05-07 08:35:32',8,'[\"2024-05-07 08:53:18\",\"-\"]',7,'[\"2024-05-07 09:43:54\",\"-\"]',33,'[\"2024-05-07 09:56:02\",\"-\"]',33,'[\"2024-05-07 16:43:11\",\"-\"]','2024-05-07 09:30:51','2024-05-07 16:45:58','[\"2024-05-07 09\",\"2024-05-07 10\",\"2024-05-07 11\",\"2024-05-07 12\",\"2024-05-07 13\",\"2024-05-07 14\",\"2024-05-07 15\",\"2024-05-07 16\"]',6,'Visit customer : hasari cipta gemilang & gema tools precision',1,33,'2024-05-30 08:09:22'),
(48,40,'2024-05-07 09:01:02',8,'[\"2024-05-07 09:25:53\",\"-\"]',7,'[\"2024-05-07 09:43:59\",\"-\"]',33,'[\"2024-05-07 10:32:36\",\"-\"]',33,'[\"2024-05-07 15:27:28\",\"-\"]','2024-05-07 10:00:55','2024-05-07 16:45:09','[\"2024-05-07 10\",\"2024-05-07 11\",\"2024-05-07 12\",\"2024-05-07 13\",\"2024-05-07 14\",\"2024-05-07 15\",\"2024-05-07 16\"]',5,'pt.indosafty,pt jembar',1,33,'2024-05-30 08:09:23'),
(49,30,'2024-05-07 09:57:13',8,'[\"2024-05-07 10:17:46\",\"-\"]',7,'[\"2024-05-07 10:20:36\",\"-\"]',33,'[\"2024-05-07 10:54:08\",\"-\"]',33,'[\"2024-05-07 15:33:35\",\"-\"]','2024-05-07 10:30:43','2024-05-07 16:00:56','[\"2024-05-07 10\",\"2024-05-07 11\",\"2024-05-07 12\",\"2024-05-07 13\",\"2024-05-07 14\",\"2024-05-07 15\"]',1,'Customer Kirana Citra, SES, Asia Selaras',1,33,'2024-05-30 08:09:23'),
(50,7,'2024-05-07 17:03:37',27,'[\"2024-05-07 17:19:39\",\"-\"]',7,'[\"2024-05-08 09:59:45\",\"-\"]',1,'[\"2024-05-13 11:44:13\",\"-\"]',33,'[\"2024-05-13 13:00:11\",\"-\"]','2024-05-08 10:30:09','2024-05-08 16:00:18','[\"2024-05-08 10\",\"2024-05-08 11\",\"2024-05-08 12\",\"2024-05-08 13\",\"2024-05-08 14\",\"2024-05-08 15\"]',4,'Meeting AOP',1,33,'2024-05-30 08:09:24'),
(51,16,'2024-05-08 08:36:00',8,'[\"2024-05-08 09:49:39\",\"-\"]',7,'[\"2024-05-08 09:59:50\",\"-\"]',33,'[\"2024-05-08 10:53:26\",\"-\"]',33,'[\"2024-05-08 18:45:40\",\"-\"]','2024-05-08 10:00:03','2024-05-08 17:00:11','[\"2024-05-08 10\",\"2024-05-08 11\",\"2024-05-08 12\",\"2024-05-08 13\",\"2024-05-08 14\",\"2024-05-08 15\",\"2024-05-08 16\",\"2024-05-08 17\"]',6,'visit customer : Matahari terbit dan Tomo san wire',1,33,'2024-05-30 08:09:25'),
(52,29,'2024-05-08 10:32:46',8,'[\"2024-05-08 10:37:40\",\"-\"]',7,'[\"2024-05-08 10:48:40\",\"-\"]',33,'[\"2024-05-08 11:49:14\",\"-\"]',33,'[\"2024-05-08 16:10:14\",\"-\"]','2024-05-08 10:45:09','2024-05-08 17:00:13','[\"2024-05-08 10\",\"2024-05-08 11\",\"2024-05-08 12\",\"2024-05-08 13\",\"2024-05-08 14\",\"2024-05-08 15\",\"2024-05-08 16\"]',1,'S-FACTORY KARAWANG\nRKN FORGE',1,33,'2024-05-30 08:09:25'),
(53,16,'2024-05-08 13:05:15',8,'[\"2024-05-10 08:27:43\",\"-\"]',7,'[\"2024-05-10 08:40:29\",\"-\"]',NULL,NULL,NULL,NULL,'2024-05-08 13:30:33','2024-05-08 15:00:41','[\"2024-05-08 13\",\"2024-05-08 14\"]',10,'Meeting dg PT FIM',1,7,'2024-05-30 08:09:26'),
(54,29,'2024-05-08 16:21:56',8,'[\"2024-05-10 08:27:51\",\"-\"]',7,'[\"2024-05-10 08:40:33\",\"-\"]',33,'[\"2024-05-10 11:38:11\",\"-\"]',33,'[\"2024-05-10 17:13:34\",\"-\"]','2024-05-10 08:30:32','2024-05-10 17:00:49','[\"2024-05-10 08\",\"2024-05-10 09\",\"2024-05-10 10\",\"2024-05-10 11\",\"2024-05-10 12\",\"2024-05-10 13\",\"2024-05-10 14\",\"2024-05-10 15\",\"2024-05-10 16\"]',5,'Cap mold, toyo dies, fujilloy',1,33,'2024-05-30 08:09:27'),
(55,15,'2024-05-10 08:13:35',8,'[\"2024-05-10 08:27:55\",\"-\"]',7,'[\"2024-05-10 08:40:39\",\"-\"]',33,'[\"2024-05-10 08:51:36\",\"-\"]',33,'[\"2024-05-10 16:38:53\",\"-\"]','2024-05-10 08:30:00','2024-05-10 16:45:06','[\"2024-05-10 08\",\"2024-05-10 09\",\"2024-05-10 10\",\"2024-05-10 11\",\"2024-05-10 12\",\"2024-05-10 13\",\"2024-05-10 14\",\"2024-05-10 15\",\"2024-05-10 16\"]',6,'Visit customer metalisha dan prima guna',1,33,'2024-05-30 08:09:27'),
(56,4,'2024-05-10 09:59:42',27,'[\"2024-05-10 10:09:41\",\"-\"]',7,'[\"2024-05-10 10:15:44\",\"-\"]',33,'[\"2024-05-10 10:17:21\",\"-\"]',33,'[\"2024-05-10 12:49:48\",\"-\"]','2024-05-10 10:00:22','2024-05-10 14:00:26','[\"2024-05-10 10\",\"2024-05-10 11\",\"2024-05-10 12\",\"2024-05-10 13\",\"2024-05-10 14\"]',4,'Tukar Faktur ke YMMI',1,33,'2024-05-30 08:09:28'),
(57,2,'2024-05-13 11:20:48',8,'[\"2024-05-13 11:22:05\",\"-\"]',2,'[\"2024-05-13 11:22:29\",\"-\"]',33,'[\"2024-05-13 11:23:19\",\"-\"]',1,'[\"2024-05-13 11:45:41\",\"-\"]','2024-05-13 11:20:26','2024-05-13 13:00:32','[\"2024-05-13 11\",\"2024-05-13 12\"]',1,'123',1,1,'2024-05-30 08:09:29'),
(58,2,'2024-05-13 13:07:17',27,'[\"2024-05-13 13:16:46\",\"-\"]',2,'[\"2024-05-13 13:17:03\",\"-\"]',33,'[\"2024-05-13 13:17:39\",\"-\"]',33,'[\"2024-05-13 13:17:54\",\"-\"]','2024-05-13 13:07:00','2024-05-14 13:00:06','[\"2024-05-13 13\",\"2024-05-13 14\",\"2024-05-13 15\",\"2024-05-13 16\",\"2024-05-13 17\",\"2024-05-13 18\",\"2024-05-13 19\",\"2024-05-13 20\",\"2024-05-13 21\",\"2024-05-13 22\",\"2024-05-13 23\",\"2024-05-14 00\",\"2024-05-14 01\",\"2024-05-14 02\",\"2024-05-14 03\",\"2024-05-14 04\",\"2024-05-14 05\",\"2024-05-14 06\",\"2024-05-14 07\",\"2024-05-14 08\",\"2024-05-14 09\",\"2024-05-14 10\",\"2024-05-14 11\",\"2024-05-14 12\"]',1,'321',1,33,'2024-05-30 08:09:29'),
(59,7,'2024-05-13 14:12:12',27,'[\"2024-05-13 14:12:39\",\"-\"]',7,'[\"2024-05-13 14:14:06\",\"-\"]',33,'[\"2024-05-13 14:14:32\",\"-\"]',NULL,NULL,'2024-05-13 14:15:53','2024-05-13 15:00:56','[\"2024-05-13 14\"]',2,'ke bank 123',1,7,'2024-05-30 08:09:30'),
(60,5,'2024-05-13 15:55:48',27,'[\"2024-05-13 15:56:15\",\"-\"]',2,'[\"2024-05-13 15:56:39\",\"-\"]',33,'[\"2024-05-13 15:59:54\",\"-\"]',33,'[\"2024-05-13 16:00:46\",\"-\"]','2024-05-13 15:55:29','2024-05-13 16:30:35','[\"2024-05-13 15\"]',4,'ke bank 234',1,33,'2024-05-30 08:09:32');

/*Table structure for table `trx_chceksheet_asset` */

DROP TABLE IF EXISTS `trx_chceksheet_asset`;

CREATE TABLE `trx_chceksheet_asset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_asset` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_chceksheet_asset` */

/*Table structure for table `trx_cia` */

DROP TABLE IF EXISTS `trx_cia`;

CREATE TABLE `trx_cia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_cia` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `necessity` text DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `amount_actual` int(11) DEFAULT NULL,
  `selisih` int(11) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `id_dephead` int(11) DEFAULT NULL,
  `id_finance` int(11) DEFAULT NULL,
  `id_chasier` int(11) DEFAULT NULL,
  `metode` int(11) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `atas_nama` varchar(255) DEFAULT NULL,
  `no_rek` varchar(255) DEFAULT NULL,
  `bukti_tf_ambil` varchar(255) DEFAULT NULL,
  `bukti_tf_terima` varchar(255) DEFAULT NULL,
  `struk` varchar(255) DEFAULT NULL,
  `methode_selisih` int(11) DEFAULT NULL,
  `bank_selisih` varchar(255) DEFAULT NULL,
  `atas_nama_selisih` varchar(255) DEFAULT NULL,
  `norek_selisih` varchar(255) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_cia` */

insert  into `trx_cia`(`id`,`no_cia`,`id_user`,`date_create`,`necessity`,`unit`,`amount`,`amount_actual`,`selisih`,`remark`,`status`,`id_dephead`,`id_finance`,`id_chasier`,`metode`,`bank`,`atas_nama`,`no_rek`,`bukti_tf_ambil`,`bukti_tf_terima`,`struk`,`methode_selisih`,`bank_selisih`,`atas_nama_selisih`,`norek_selisih`,`update_by`,`is_active`,`last_update`) values 
(1,'CIA.2024-08.0001',1,'2024-08-10','Tes input','1 Paket',1000000,500000,500000,NULL,8,1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1,1,'2024-08-11 00:07:00'),
(2,'CIA.2024-08.0002',1,'2024-08-10','Tes 2','1 Paket',10000000,10000000,0,'Tes 2',6,1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,'2024-08-10 21:54:20');

/*Table structure for table `trx_employe_loan` */

DROP TABLE IF EXISTS `trx_employe_loan`;

CREATE TABLE `trx_employe_loan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT NULL,
  `nominal_loan` int(11) DEFAULT NULL,
  `bulan_loan` int(11) DEFAULT NULL,
  `loan_perbulan` int(11) DEFAULT NULL,
  `start_bulan` varchar(255) DEFAULT NULL,
  `list_pembayaran` mediumtext DEFAULT NULL,
  `golongan` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_employe_loan` */

insert  into `trx_employe_loan`(`id`,`id_karyawan`,`nominal_loan`,`bulan_loan`,`loan_perbulan`,`start_bulan`,`list_pembayaran`,`golongan`,`is_active`,`update_by`,`last_update`) values 
(1,30,57000000,70,814286,'2024-05','[{\"bulan\": \"2024-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"814286\",\"sisa\": \"56185714\"},{\"bulan\": \"2024-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"1628572\",\"sisa\": \"55371428\"},{\"bulan\": \"2024-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"2442858\",\"sisa\": \"54557142\"},{\"bulan\": \"2024-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"3257144\",\"sisa\": \"53742856\"},{\"bulan\": \"2024-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"4071430\",\"sisa\": \"52928570\"},{\"bulan\": \"2024-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"4885716\",\"sisa\": \"52114284\"},{\"bulan\": \"2024-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"5700002\",\"sisa\": \"51299998\"},{\"bulan\": \"2024-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"7328574\",\"sisa\": \"49671426\"},{\"bulan\": \"2025-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"8142860\",\"sisa\": \"48857140\"},{\"bulan\": \"2025-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"8957146\",\"sisa\": \"48042854\"},{\"bulan\": \"2025-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"9771432\",\"sisa\": \"47228568\"},{\"bulan\": \"2025-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"10585718\",\"sisa\": \"46414282\"},{\"bulan\": \"2025-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"11400004\",\"sisa\": \"45599996\"},{\"bulan\": \"2025-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"12214290\",\"sisa\": \"44785710\"},{\"bulan\": \"2025-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"13028576\",\"sisa\": \"43971424\"},{\"bulan\": \"2025-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"13842862\",\"sisa\": \"43157138\"},{\"bulan\": \"2025-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"14657148\",\"sisa\": \"42342852\"},{\"bulan\": \"2025-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"15471434\",\"sisa\": \"41528566\"},{\"bulan\": \"2025-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"16285720\",\"sisa\": \"40714280\"},{\"bulan\": \"2025-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"17914292\",\"sisa\": \"39085708\"},{\"bulan\": \"2026-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"18728578\",\"sisa\": \"38271422\"},{\"bulan\": \"2026-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"19542864\",\"sisa\": \"37457136\"},{\"bulan\": \"2026-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"20357150\",\"sisa\": \"36642850\"},{\"bulan\": \"2026-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"21171436\",\"sisa\": \"35828564\"},{\"bulan\": \"2026-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"21985722\",\"sisa\": \"35014278\"},{\"bulan\": \"2026-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"22800008\",\"sisa\": \"34199992\"},{\"bulan\": \"2026-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"23614294\",\"sisa\": \"33385706\"},{\"bulan\": \"2026-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"24428580\",\"sisa\": \"32571420\"},{\"bulan\": \"2026-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"25242866\",\"sisa\": \"31757134\"},{\"bulan\": \"2026-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"26057152\",\"sisa\": \"30942848\"},{\"bulan\": \"2026-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"26871438\",\"sisa\": \"30128562\"},{\"bulan\": \"2026-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"28500010\",\"sisa\": \"28499990\"},{\"bulan\": \"2027-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"29314296\",\"sisa\": \"27685704\"},{\"bulan\": \"2027-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"30128582\",\"sisa\": \"26871418\"},{\"bulan\": \"2027-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"30942868\",\"sisa\": \"26057132\"},{\"bulan\": \"2027-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"31757154\",\"sisa\": \"25242846\"},{\"bulan\": \"2027-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"32571440\",\"sisa\": \"24428560\"},{\"bulan\": \"2027-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"33385726\",\"sisa\": \"23614274\"},{\"bulan\": \"2027-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"34200012\",\"sisa\": \"22799988\"},{\"bulan\": \"2027-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"35014298\",\"sisa\": \"21985702\"},{\"bulan\": \"2027-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"35828584\",\"sisa\": \"21171416\"},{\"bulan\": \"2027-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"36642870\",\"sisa\": \"20357130\"},{\"bulan\": \"2027-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"37457156\",\"sisa\": \"19542844\"},{\"bulan\": \"2027-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"39085728\",\"sisa\": \"17914272\"},{\"bulan\": \"2028-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"39900014\",\"sisa\": \"17099986\"},{\"bulan\": \"2028-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"40714300\",\"sisa\": \"16285700\"},{\"bulan\": \"2028-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"41528586\",\"sisa\": \"15471414\"},{\"bulan\": \"2028-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"42342872\",\"sisa\": \"14657128\"},{\"bulan\": \"2028-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"43157158\",\"sisa\": \"13842842\"},{\"bulan\": \"2028-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"43971444\",\"sisa\": \"13028556\"},{\"bulan\": \"2028-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"44785730\",\"sisa\": \"12214270\"},{\"bulan\": \"2028-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"45600016\",\"sisa\": \"11399984\"},{\"bulan\": \"2028-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"46414302\",\"sisa\": \"10585698\"},{\"bulan\": \"2028-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"47228588\",\"sisa\": \"9771412\"},{\"bulan\": \"2028-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"48042874\",\"sisa\": \"8957126\"},{\"bulan\": \"2028-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"49671446\",\"sisa\": \"7328554\"},{\"bulan\": \"2029-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"50485732\",\"sisa\": \"6514268\"},{\"bulan\": \"2029-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"51300018\",\"sisa\": \"5699982\"},{\"bulan\": \"2029-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"52114304\",\"sisa\": \"4885696\"},{\"bulan\": \"2029-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"52928590\",\"sisa\": \"4071410\"},{\"bulan\": \"2029-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"53742876\",\"sisa\": \"3257124\"},{\"bulan\": \"2029-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"54557162\",\"sisa\": \"2442838\"},{\"bulan\": \"2029-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"55371448\",\"sisa\": \"1628552\"},{\"bulan\": \"2029-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"56185734\",\"sisa\": \"814266\"},{\"bulan\": \"2029-09\",\"jml\": \"1\",\"nominal\": \"814266\",\"terbayarkan\": \"57000000\",\"sisa\": \"0\"}]','4A',1,2,'2024-05-27 00:41:57'),
(2,84,25000000,20,1250000,'2024-03','[{\"bulan\": \"2024-03\",\"jml\": \"1\",\"nominal\": \"1250000\",\"terbayarkan\": \"1250000\",\"sisa\": \"23750000\"},{\"bulan\": \"2024-04\",\"jml\": \"2\",\"nominal\": \"2500000\",\"terbayarkan\": \"3750000\",\"sisa\": \"21250000\"},{\"bulan\": \"2024-05\",\"jml\": \"1\",\"nominal\": \"21250000\",\"terbayarkan\": \"25000000\",\"sisa\": \"0\"}]','3F',2,2,'2024-05-27 01:39:56'),
(3,37,100000000,70,1428571,'2024-06','[{\"bulan\": \"2024-06\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"1428571\",\"sisa\": \"98571429\"},{\"bulan\": \"2024-07\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"2857142\",\"sisa\": \"97142858\"},{\"bulan\": \"2024-08\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"4285713\",\"sisa\": \"95714287\"},{\"bulan\": \"2024-09\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"5714284\",\"sisa\": \"94285716\"},{\"bulan\": \"2024-10\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"7142855\",\"sisa\": \"92857145\"},{\"bulan\": \"2024-11\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"8571426\",\"sisa\": \"91428574\"},{\"bulan\": \"2024-12\",\"jml\": \"2\",\"nominal\": \"2857142\",\"terbayarkan\": \"11428568\",\"sisa\": \"88571432\"},{\"bulan\": \"2025-01\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"12857139\",\"sisa\": \"87142861\"},{\"bulan\": \"2025-02\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"14285710\",\"sisa\": \"85714290\"},{\"bulan\": \"2025-03\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"15714281\",\"sisa\": \"84285719\"},{\"bulan\": \"2025-04\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"17142852\",\"sisa\": \"82857148\"},{\"bulan\": \"2025-05\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"18571423\",\"sisa\": \"81428577\"},{\"bulan\": \"2025-06\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"19999994\",\"sisa\": \"80000006\"},{\"bulan\": \"2025-07\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"21428565\",\"sisa\": \"78571435\"},{\"bulan\": \"2025-08\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"22857136\",\"sisa\": \"77142864\"},{\"bulan\": \"2025-09\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"24285707\",\"sisa\": \"75714293\"},{\"bulan\": \"2025-10\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"25714278\",\"sisa\": \"74285722\"},{\"bulan\": \"2025-11\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"27142849\",\"sisa\": \"72857151\"},{\"bulan\": \"2025-12\",\"jml\": \"2\",\"nominal\": \"2857142\",\"terbayarkan\": \"29999991\",\"sisa\": \"70000009\"},{\"bulan\": \"2026-01\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"31428562\",\"sisa\": \"68571438\"},{\"bulan\": \"2026-02\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"32857133\",\"sisa\": \"67142867\"},{\"bulan\": \"2026-03\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"34285704\",\"sisa\": \"65714296\"},{\"bulan\": \"2026-04\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"35714275\",\"sisa\": \"64285725\"},{\"bulan\": \"2026-05\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"37142846\",\"sisa\": \"62857154\"},{\"bulan\": \"2026-06\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"38571417\",\"sisa\": \"61428583\"},{\"bulan\": \"2026-07\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"39999988\",\"sisa\": \"60000012\"},{\"bulan\": \"2026-08\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"41428559\",\"sisa\": \"58571441\"},{\"bulan\": \"2026-09\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"42857130\",\"sisa\": \"57142870\"},{\"bulan\": \"2026-10\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"44285701\",\"sisa\": \"55714299\"},{\"bulan\": \"2026-11\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"45714272\",\"sisa\": \"54285728\"},{\"bulan\": \"2026-12\",\"jml\": \"2\",\"nominal\": \"2857142\",\"terbayarkan\": \"48571414\",\"sisa\": \"51428586\"},{\"bulan\": \"2027-01\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"49999985\",\"sisa\": \"50000015\"},{\"bulan\": \"2027-02\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"51428556\",\"sisa\": \"48571444\"},{\"bulan\": \"2027-03\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"52857127\",\"sisa\": \"47142873\"},{\"bulan\": \"2027-04\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"54285698\",\"sisa\": \"45714302\"},{\"bulan\": \"2027-05\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"55714269\",\"sisa\": \"44285731\"},{\"bulan\": \"2027-06\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"57142840\",\"sisa\": \"42857160\"},{\"bulan\": \"2027-07\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"58571411\",\"sisa\": \"41428589\"},{\"bulan\": \"2027-08\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"59999982\",\"sisa\": \"40000018\"},{\"bulan\": \"2027-09\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"61428553\",\"sisa\": \"38571447\"},{\"bulan\": \"2027-10\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"62857124\",\"sisa\": \"37142876\"},{\"bulan\": \"2027-11\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"64285695\",\"sisa\": \"35714305\"},{\"bulan\": \"2027-12\",\"jml\": \"2\",\"nominal\": \"2857142\",\"terbayarkan\": \"67142837\",\"sisa\": \"32857163\"},{\"bulan\": \"2028-01\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"68571408\",\"sisa\": \"31428592\"},{\"bulan\": \"2028-02\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"69999979\",\"sisa\": \"30000021\"},{\"bulan\": \"2028-03\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"71428550\",\"sisa\": \"28571450\"},{\"bulan\": \"2028-04\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"72857121\",\"sisa\": \"27142879\"},{\"bulan\": \"2028-05\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"74285692\",\"sisa\": \"25714308\"},{\"bulan\": \"2028-06\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"75714263\",\"sisa\": \"24285737\"},{\"bulan\": \"2028-07\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"77142834\",\"sisa\": \"22857166\"},{\"bulan\": \"2028-08\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"78571405\",\"sisa\": \"21428595\"},{\"bulan\": \"2028-09\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"79999976\",\"sisa\": \"20000024\"},{\"bulan\": \"2028-10\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"81428547\",\"sisa\": \"18571453\"},{\"bulan\": \"2028-11\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"82857118\",\"sisa\": \"17142882\"},{\"bulan\": \"2028-12\",\"jml\": \"2\",\"nominal\": \"2857142\",\"terbayarkan\": \"85714260\",\"sisa\": \"14285740\"},{\"bulan\": \"2029-01\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"87142831\",\"sisa\": \"12857169\"},{\"bulan\": \"2029-02\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"88571402\",\"sisa\": \"11428598\"},{\"bulan\": \"2029-03\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"89999973\",\"sisa\": \"10000027\"},{\"bulan\": \"2029-04\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"91428544\",\"sisa\": \"8571456\"},{\"bulan\": \"2029-05\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"92857115\",\"sisa\": \"7142885\"},{\"bulan\": \"2029-06\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"94285686\",\"sisa\": \"5714314\"},{\"bulan\": \"2029-07\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"95714257\",\"sisa\": \"4285743\"},{\"bulan\": \"2029-08\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"97142828\",\"sisa\": \"2857172\"},{\"bulan\": \"2029-09\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"98571399\",\"sisa\": \"1428601\"},{\"bulan\": \"2029-10\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"99999970\",\"sisa\": \"30\"},{\"bulan\": \"2029-11\",\"jml\": \"1\",\"nominal\": \"30\",\"terbayarkan\": \"100000000\",\"sisa\": \"0\"}]','5A',1,2,'2024-05-19 22:49:26'),
(4,1,100000000,70,1428571,'2024-02','[{\"bulan\": \"2024-02\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"1428571\",\"sisa\": \"98571429\"},{\"bulan\": \"2024-03\",\"jml\": \"1\",\"nominal\": \"1428571\",\"terbayarkan\": \"2857142\",\"sisa\": \"97142858\"},{\"bulan\": \"2024-04\",\"jml\": \"2\",\"nominal\": \"2857142\",\"terbayarkan\": \"5714284\",\"sisa\": \"94285716\"},{\"bulan\": \"2024-05\",\"jml\": \"1\",\"nominal\": \"94285716\",\"terbayarkan\": \"100000000\",\"sisa\": \"0\"}]','4C',2,27,'2024-05-27 01:41:08'),
(5,84,57000000,70,814286,'2023-05','[{\"bulan\": \"2023-05\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"1628572\",\"sisa\": \"55371428\"},{\"bulan\": \"2023-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"2442858\",\"sisa\": \"54557142\"},{\"bulan\": \"2023-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"3257144\",\"sisa\": \"53742856\"},{\"bulan\": \"2023-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"4071430\",\"sisa\": \"52928570\"},{\"bulan\": \"2023-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"4885716\",\"sisa\": \"52114284\"},{\"bulan\": \"2023-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"5700002\",\"sisa\": \"51299998\"},{\"bulan\": \"2023-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"6514288\",\"sisa\": \"50485712\"},{\"bulan\": \"2023-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"8142860\",\"sisa\": \"48857140\"},{\"bulan\": \"2024-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"8957146\",\"sisa\": \"48042854\"},{\"bulan\": \"2024-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"9771432\",\"sisa\": \"47228568\"},{\"bulan\": \"2024-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"10585718\",\"sisa\": \"46414282\"},{\"bulan\": \"2024-04\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"12214290\",\"sisa\": \"44785710\"},{\"bulan\": \"2024-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"13028576\",\"sisa\": \"43971424\"},{\"bulan\": \"2024-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"13842862\",\"sisa\": \"43157138\"},{\"bulan\": \"2024-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"14657148\",\"sisa\": \"42342852\"},{\"bulan\": \"2024-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"15471434\",\"sisa\": \"41528566\"},{\"bulan\": \"2024-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"16285720\",\"sisa\": \"40714280\"},{\"bulan\": \"2024-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"17100006\",\"sisa\": \"39899994\"},{\"bulan\": \"2024-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"17914292\",\"sisa\": \"39085708\"},{\"bulan\": \"2024-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"19542864\",\"sisa\": \"37457136\"},{\"bulan\": \"2025-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"20357150\",\"sisa\": \"36642850\"},{\"bulan\": \"2025-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"21171436\",\"sisa\": \"35828564\"},{\"bulan\": \"2025-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"21985722\",\"sisa\": \"35014278\"},{\"bulan\": \"2025-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"22800008\",\"sisa\": \"34199992\"},{\"bulan\": \"2025-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"23614294\",\"sisa\": \"33385706\"},{\"bulan\": \"2025-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"24428580\",\"sisa\": \"32571420\"},{\"bulan\": \"2025-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"25242866\",\"sisa\": \"31757134\"},{\"bulan\": \"2025-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"26057152\",\"sisa\": \"30942848\"},{\"bulan\": \"2025-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"26871438\",\"sisa\": \"30128562\"},{\"bulan\": \"2025-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"27685724\",\"sisa\": \"29314276\"},{\"bulan\": \"2025-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"28500010\",\"sisa\": \"28499990\"},{\"bulan\": \"2025-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"30128582\",\"sisa\": \"26871418\"},{\"bulan\": \"2026-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"30942868\",\"sisa\": \"26057132\"},{\"bulan\": \"2026-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"31757154\",\"sisa\": \"25242846\"},{\"bulan\": \"2026-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"32571440\",\"sisa\": \"24428560\"},{\"bulan\": \"2026-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"33385726\",\"sisa\": \"23614274\"},{\"bulan\": \"2026-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"34200012\",\"sisa\": \"22799988\"},{\"bulan\": \"2026-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"35014298\",\"sisa\": \"21985702\"},{\"bulan\": \"2026-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"35828584\",\"sisa\": \"21171416\"},{\"bulan\": \"2026-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"36642870\",\"sisa\": \"20357130\"},{\"bulan\": \"2026-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"37457156\",\"sisa\": \"19542844\"},{\"bulan\": \"2026-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"38271442\",\"sisa\": \"18728558\"},{\"bulan\": \"2026-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"39085728\",\"sisa\": \"17914272\"},{\"bulan\": \"2026-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"40714300\",\"sisa\": \"16285700\"},{\"bulan\": \"2027-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"41528586\",\"sisa\": \"15471414\"},{\"bulan\": \"2027-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"42342872\",\"sisa\": \"14657128\"},{\"bulan\": \"2027-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"43157158\",\"sisa\": \"13842842\"},{\"bulan\": \"2027-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"43971444\",\"sisa\": \"13028556\"},{\"bulan\": \"2027-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"44785730\",\"sisa\": \"12214270\"},{\"bulan\": \"2027-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"45600016\",\"sisa\": \"11399984\"},{\"bulan\": \"2027-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"46414302\",\"sisa\": \"10585698\"},{\"bulan\": \"2027-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"47228588\",\"sisa\": \"9771412\"},{\"bulan\": \"2027-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"48042874\",\"sisa\": \"8957126\"},{\"bulan\": \"2027-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"48857160\",\"sisa\": \"8142840\"},{\"bulan\": \"2027-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"49671446\",\"sisa\": \"7328554\"},{\"bulan\": \"2027-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"51300018\",\"sisa\": \"5699982\"},{\"bulan\": \"2028-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"52114304\",\"sisa\": \"4885696\"},{\"bulan\": \"2028-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"52928590\",\"sisa\": \"4071410\"},{\"bulan\": \"2028-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"53742876\",\"sisa\": \"3257124\"},{\"bulan\": \"2028-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"54557162\",\"sisa\": \"2442838\"},{\"bulan\": \"2028-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"55371448\",\"sisa\": \"1628552\"},{\"bulan\": \"2028-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"56185734\",\"sisa\": \"814266\"},{\"bulan\": \"2028-07\",\"jml\": \"1\",\"nominal\": \"814266\",\"terbayarkan\": \"57000000\",\"sisa\": \"0\"}]','3A',1,27,'2024-05-27 01:36:44'),
(6,21,57000000,70,814286,'2019-04','[{\"bulan\": \"2019-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"814286\",\"sisa\": \"56185714\"},{\"bulan\": \"2019-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"1628572\",\"sisa\": \"55371428\"},{\"bulan\": \"2019-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"2442858\",\"sisa\": \"54557142\"},{\"bulan\": \"2019-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"3257144\",\"sisa\": \"53742856\"},{\"bulan\": \"2019-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"4071430\",\"sisa\": \"52928570\"},{\"bulan\": \"2019-09\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"5700002\",\"sisa\": \"51299998\"},{\"bulan\": \"2019-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"6514288\",\"sisa\": \"50485712\"},{\"bulan\": \"2019-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"7328574\",\"sisa\": \"49671426\"},{\"bulan\": \"2019-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"8957146\",\"sisa\": \"48042854\"},{\"bulan\": \"2020-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"9771432\",\"sisa\": \"47228568\"},{\"bulan\": \"2020-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"10585718\",\"sisa\": \"46414282\"},{\"bulan\": \"2020-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"11400004\",\"sisa\": \"45599996\"},{\"bulan\": \"2020-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"12214290\",\"sisa\": \"44785710\"},{\"bulan\": \"2020-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"13028576\",\"sisa\": \"43971424\"},{\"bulan\": \"2020-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"13842862\",\"sisa\": \"43157138\"},{\"bulan\": \"2020-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"14657148\",\"sisa\": \"42342852\"},{\"bulan\": \"2020-08\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"16285720\",\"sisa\": \"40714280\"},{\"bulan\": \"2020-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"17100006\",\"sisa\": \"39899994\"},{\"bulan\": \"2020-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"17914292\",\"sisa\": \"39085708\"},{\"bulan\": \"2020-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"18728578\",\"sisa\": \"38271422\"},{\"bulan\": \"2020-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"20357150\",\"sisa\": \"36642850\"},{\"bulan\": \"2021-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"21171436\",\"sisa\": \"35828564\"},{\"bulan\": \"2021-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"21985722\",\"sisa\": \"35014278\"},{\"bulan\": \"2021-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"22800008\",\"sisa\": \"34199992\"},{\"bulan\": \"2021-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"23614294\",\"sisa\": \"33385706\"},{\"bulan\": \"2021-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"24428580\",\"sisa\": \"32571420\"},{\"bulan\": \"2021-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"25242866\",\"sisa\": \"31757134\"},{\"bulan\": \"2021-07\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"26871438\",\"sisa\": \"30128562\"},{\"bulan\": \"2021-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"27685724\",\"sisa\": \"29314276\"},{\"bulan\": \"2021-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"28500010\",\"sisa\": \"28499990\"},{\"bulan\": \"2021-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"29314296\",\"sisa\": \"27685704\"},{\"bulan\": \"2021-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"30128582\",\"sisa\": \"26871418\"},{\"bulan\": \"2021-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"31757154\",\"sisa\": \"25242846\"},{\"bulan\": \"2022-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"32571440\",\"sisa\": \"24428560\"},{\"bulan\": \"2022-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"33385726\",\"sisa\": \"23614274\"},{\"bulan\": \"2022-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"34200012\",\"sisa\": \"22799988\"},{\"bulan\": \"2022-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"35014298\",\"sisa\": \"21985702\"},{\"bulan\": \"2022-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"35828584\",\"sisa\": \"21171416\"},{\"bulan\": \"2022-06\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"37457156\",\"sisa\": \"19542844\"},{\"bulan\": \"2022-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"38271442\",\"sisa\": \"18728558\"},{\"bulan\": \"2022-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"39085728\",\"sisa\": \"17914272\"},{\"bulan\": \"2022-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"39900014\",\"sisa\": \"17099986\"},{\"bulan\": \"2022-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"40714300\",\"sisa\": \"16285700\"},{\"bulan\": \"2022-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"41528586\",\"sisa\": \"15471414\"},{\"bulan\": \"2022-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"43157158\",\"sisa\": \"13842842\"},{\"bulan\": \"2023-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"43971444\",\"sisa\": \"13028556\"},{\"bulan\": \"2023-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"44785730\",\"sisa\": \"12214270\"},{\"bulan\": \"2023-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"45600016\",\"sisa\": \"11399984\"},{\"bulan\": \"2023-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"46414302\",\"sisa\": \"10585698\"},{\"bulan\": \"2023-05\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"48042874\",\"sisa\": \"8957126\"},{\"bulan\": \"2023-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"48857160\",\"sisa\": \"8142840\"},{\"bulan\": \"2023-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"49671446\",\"sisa\": \"7328554\"},{\"bulan\": \"2023-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"50485732\",\"sisa\": \"6514268\"},{\"bulan\": \"2023-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"51300018\",\"sisa\": \"5699982\"},{\"bulan\": \"2023-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"52114304\",\"sisa\": \"4885696\"},{\"bulan\": \"2023-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"52928590\",\"sisa\": \"4071410\"},{\"bulan\": \"2023-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"54557162\",\"sisa\": \"2442838\"},{\"bulan\": \"2024-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"55371448\",\"sisa\": \"1628552\"},{\"bulan\": \"2024-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"56185734\",\"sisa\": \"814266\"},{\"bulan\": \"2024-03\",\"jml\": \"1\",\"nominal\": \"814266\",\"terbayarkan\": \"57000000\",\"sisa\": \"0\"}]','3B',2,1,'2024-05-26 15:10:56'),
(7,11,57000000,70,814286,'2019-01','[{\"bulan\": \"2019-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"814286\",\"sisa\": \"56185714\"},{\"bulan\": \"2019-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"1628572\",\"sisa\": \"55371428\"},{\"bulan\": \"2019-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"2442858\",\"sisa\": \"54557142\"},{\"bulan\": \"2019-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"3257144\",\"sisa\": \"53742856\"},{\"bulan\": \"2019-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"4071430\",\"sisa\": \"52928570\"},{\"bulan\": \"2019-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"4885716\",\"sisa\": \"52114284\"},{\"bulan\": \"2019-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"5700002\",\"sisa\": \"51299998\"},{\"bulan\": \"2019-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"6514288\",\"sisa\": \"50485712\"},{\"bulan\": \"2019-09\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"8142860\",\"sisa\": \"48857140\"},{\"bulan\": \"2019-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"8957146\",\"sisa\": \"48042854\"},{\"bulan\": \"2019-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"9771432\",\"sisa\": \"47228568\"},{\"bulan\": \"2019-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"11400004\",\"sisa\": \"45599996\"},{\"bulan\": \"2020-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"12214290\",\"sisa\": \"44785710\"},{\"bulan\": \"2020-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"13028576\",\"sisa\": \"43971424\"},{\"bulan\": \"2020-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"13842862\",\"sisa\": \"43157138\"},{\"bulan\": \"2020-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"14657148\",\"sisa\": \"42342852\"},{\"bulan\": \"2020-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"15471434\",\"sisa\": \"41528566\"},{\"bulan\": \"2020-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"16285720\",\"sisa\": \"40714280\"},{\"bulan\": \"2020-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"17100006\",\"sisa\": \"39899994\"},{\"bulan\": \"2020-08\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"18728578\",\"sisa\": \"38271422\"},{\"bulan\": \"2020-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"19542864\",\"sisa\": \"37457136\"},{\"bulan\": \"2020-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"20357150\",\"sisa\": \"36642850\"},{\"bulan\": \"2020-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"21171436\",\"sisa\": \"35828564\"},{\"bulan\": \"2020-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"22800008\",\"sisa\": \"34199992\"},{\"bulan\": \"2021-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"23614294\",\"sisa\": \"33385706\"},{\"bulan\": \"2021-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"24428580\",\"sisa\": \"32571420\"},{\"bulan\": \"2021-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"25242866\",\"sisa\": \"31757134\"},{\"bulan\": \"2021-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"26057152\",\"sisa\": \"30942848\"},{\"bulan\": \"2021-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"26871438\",\"sisa\": \"30128562\"},{\"bulan\": \"2021-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"27685724\",\"sisa\": \"29314276\"},{\"bulan\": \"2021-07\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"29314296\",\"sisa\": \"27685704\"},{\"bulan\": \"2021-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"30128582\",\"sisa\": \"26871418\"},{\"bulan\": \"2021-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"30942868\",\"sisa\": \"26057132\"},{\"bulan\": \"2021-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"31757154\",\"sisa\": \"25242846\"},{\"bulan\": \"2021-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"32571440\",\"sisa\": \"24428560\"},{\"bulan\": \"2021-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"34200012\",\"sisa\": \"22799988\"},{\"bulan\": \"2022-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"35014298\",\"sisa\": \"21985702\"},{\"bulan\": \"2022-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"35828584\",\"sisa\": \"21171416\"},{\"bulan\": \"2022-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"36642870\",\"sisa\": \"20357130\"},{\"bulan\": \"2022-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"37457156\",\"sisa\": \"19542844\"},{\"bulan\": \"2022-05\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"38271442\",\"sisa\": \"18728558\"},{\"bulan\": \"2022-06\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"39900014\",\"sisa\": \"17099986\"},{\"bulan\": \"2022-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"40714300\",\"sisa\": \"16285700\"},{\"bulan\": \"2022-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"41528586\",\"sisa\": \"15471414\"},{\"bulan\": \"2022-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"42342872\",\"sisa\": \"14657128\"},{\"bulan\": \"2022-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"43157158\",\"sisa\": \"13842842\"},{\"bulan\": \"2022-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"43971444\",\"sisa\": \"13028556\"},{\"bulan\": \"2022-12\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"45600016\",\"sisa\": \"11399984\"},{\"bulan\": \"2023-01\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"46414302\",\"sisa\": \"10585698\"},{\"bulan\": \"2023-02\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"47228588\",\"sisa\": \"9771412\"},{\"bulan\": \"2023-03\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"48042874\",\"sisa\": \"8957126\"},{\"bulan\": \"2023-04\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"48857160\",\"sisa\": \"8142840\"},{\"bulan\": \"2023-05\",\"jml\": \"2\",\"nominal\": \"1628572\",\"terbayarkan\": \"50485732\",\"sisa\": \"6514268\"},{\"bulan\": \"2023-06\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"51300018\",\"sisa\": \"5699982\"},{\"bulan\": \"2023-07\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"52114304\",\"sisa\": \"4885696\"},{\"bulan\": \"2023-08\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"52928590\",\"sisa\": \"4071410\"},{\"bulan\": \"2023-09\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"53742876\",\"sisa\": \"3257124\"},{\"bulan\": \"2023-10\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"54557162\",\"sisa\": \"2442838\"},{\"bulan\": \"2023-11\",\"jml\": \"1\",\"nominal\": \"814286\",\"terbayarkan\": \"55371448\",\"sisa\": \"1628552\"},{\"bulan\": \"2023-12\",\"jml\": \"2\",\"nominal\": \"1628552\",\"terbayarkan\": \"57000000\",\"sisa\": \"0\"}]','4B',2,1,'2024-05-26 15:09:36');

/*Table structure for table `trx_file` */

DROP TABLE IF EXISTS `trx_file`;

CREATE TABLE `trx_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_folder` int(11) DEFAULT NULL,
  `tittle` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `ukuran` varchar(255) DEFAULT NULL,
  `to_dept` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `revisi` varchar(10) DEFAULT NULL,
  `tgl_efektif` date DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_file` */

/*Table structure for table `trx_folder` */

DROP TABLE IF EXISTS `trx_folder`;

CREATE TABLE `trx_folder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_name` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_folder` */

insert  into `trx_folder`(`id`,`folder_name`,`is_active`,`update_by`,`last_update`) values 
(1,'S.O.P',0,1,'2024-03-22 02:34:52'),
(2,'I.K',0,1,'2024-03-25 06:02:32'),
(3,'FORM',0,1,'2024-03-28 06:10:12'),
(4,'I.K',0,32,'2024-04-01 02:59:25'),
(5,'SOP ISO',1,32,'2024-04-01 03:13:06'),
(6,'SERTIFIKAT KALIBRASI - HT',1,32,'2024-05-06 04:29:04');

/*Table structure for table `trx_setting_bulan_thr` */

DROP TABLE IF EXISTS `trx_setting_bulan_thr`;

CREATE TABLE `trx_setting_bulan_thr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) DEFAULT NULL,
  `bulan` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `trx_setting_bulan_thr` */

insert  into `trx_setting_bulan_thr`(`id`,`tahun`,`bulan`,`is_active`,`update_by`,`last_update`) values 
(1,2024,'04',1,2,'2024-05-14 08:40:14'),
(2,2023,'05',1,1,'2024-05-18 12:44:30'),
(3,2022,'06',1,1,'2024-05-18 12:44:52'),
(4,2021,'07',1,1,'2024-05-18 12:45:06'),
(5,2020,'08',1,1,'2024-05-18 12:45:17'),
(6,2019,'09',1,1,'2024-05-18 12:45:37');

/*Table structure for table `trx_surat` */

DROP TABLE IF EXISTS `trx_surat`;

CREATE TABLE `trx_surat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letter_admin` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `date_release` date DEFAULT NULL,
  `employe` int(11) DEFAULT NULL,
  `to_dept` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name_file` varchar(255) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_surat` */

insert  into `trx_surat`(`id`,`letter_admin`,`notes`,`date_release`,`employe`,`to_dept`,`role_id`,`name_file`,`update_by`,`is_active`,`last_update`) values 
(1,'001/ADDIR/I/2024','Surat Kiriman','2024-01-02',2,5,16,'49627.pdf',2,1,'2024-05-12 16:29:02'),
(2,'002/ADDIR/I/2024','PPSK','2024-01-02',2,5,16,'',2,1,'2024-05-12 16:29:04'),
(3,'003/ADDIR/I/2024','PPSK','2024-01-02',2,5,16,'',2,1,'2024-05-12 16:29:04'),
(4,'004/ADDIR/I/2024','SKPK MR','2024-01-02',2,5,16,'',2,1,'2024-05-12 16:29:05'),
(5,'005/ADDIR/I/2024','SKPK Security','2024-01-02',2,5,16,'',2,1,'2024-05-12 16:29:06'),
(6,'006/ADDIR/I/2024','PKWT','2024-01-02',2,5,16,'',2,1,'2024-05-12 16:29:06'),
(7,'007/ADDIR/I/2024','SKPKT','2024-01-02',2,5,16,'',2,1,'2024-05-12 16:29:07'),
(8,'008/ADDIR/I/2024','ITAS EB','2024-01-02',2,5,16,'63218.pdf',2,1,'2024-05-12 16:29:08'),
(9,'009/ADDIR/I/2024','PKWT','2024-01-02',2,5,16,'',2,1,'2024-05-12 16:29:08'),
(10,'010/ADDIR/I/2024','SK Tunj','2024-01-17',2,5,16,'',2,1,'2024-05-12 16:29:09'),
(11,'011/ADDIR/I/2024','SK Tunj','2024-01-17',2,5,16,'',2,1,'2024-05-12 16:29:09'),
(12,'012/ADDIR/I/2024','SK Core Value','2024-01-22',2,5,16,'',2,1,'2024-05-12 16:29:10'),
(13,'013/ADDIR/I/2024','SK Neop','2024-01-22',2,5,16,'',2,1,'2024-05-12 16:29:10'),
(14,'014/ADDIR/I/2024','PKWT','2024-01-22',2,5,16,'',2,1,'2024-05-12 16:29:11'),
(15,'015/ADDIR/I/2024','Payroll','2024-01-23',2,5,16,'',2,1,'2024-05-12 16:29:11'),
(16,'001/HRGA/I/2024','Pengantar MCU SE','2024-01-04',7,2,21,'',7,1,'2024-05-12 16:32:23'),
(17,'002/HRGA/I/2024','SK Magang Clerisela','2024-01-08',7,2,21,'',7,1,'2024-05-12 16:32:19'),
(18,'003/HRGA/I/2024','SK Permohonan Pak Sapto','2024-01-11',7,2,21,'',7,1,'2024-05-12 16:33:15'),
(19,'004/HRGA/I/2024','Pemberitahuan Tetangga (Simulasi)','2024-01-14',7,2,21,'',7,1,'2024-05-12 16:33:16'),
(20,'005/HRGA/I/2024','Pemberitahuan Tetangga (Simulasi)','2024-01-14',7,2,21,'',7,1,'2024-05-12 16:33:18'),
(21,'006/HRGA/I/2024','SK Erik','2024-01-25',7,2,21,'',7,1,'2024-05-12 16:33:20'),
(22,'007/HRGA/I/2024','Pengantar MCU','2024-01-26',7,2,21,'',7,1,'2024-05-12 16:33:21'),
(23,'008/HRGA/I/2024','Training','2024-01-29',7,2,21,'',7,1,'2024-05-12 16:33:21'),
(24,'009/HRGA/I/2024','SK - Bangun Sutopo','2024-01-29',7,2,21,'',7,1,'2024-05-12 16:33:22'),
(25,'010/HRGA/I/2024','SK Magang','2024-01-29',7,2,21,'',7,1,'2024-05-12 16:33:23'),
(26,'011/HRGA/I/2024','SK - Mugi Pramono K3','2024-01-30',7,2,21,'',7,1,'2024-05-12 16:33:24'),
(27,'001/ADADM/I/2024','Reikenn','2024-01-02',5,3,22,'',1,1,'2024-05-12 21:17:33'),
(28,'002/ADADM/I/2024','Pengembalian Dana','2024-01-04',5,3,22,'',5,1,'2024-05-12 21:17:50'),
(29,'003/ADADM/I/2024','Surat Tagih Non PPH','2024-01-18',5,3,22,'',5,1,'2024-05-12 21:17:51'),
(30,'004/ADADM/I/2024','Surat Permohonan Pengembalian','2024-01-24',5,3,22,'',5,1,'2024-05-12 21:17:52'),
(31,'005/ADADM/I/2024','Surat Pernyataan Perbedaan','2024-01-30',5,3,22,'',5,1,'2024-05-12 21:17:53'),
(32,'006/ADADM/I/2024','Surat Pernyataan Perbedaan','2024-01-31',5,3,22,'49552.pdf',5,1,'2024-05-12 21:17:54'),
(33,'007/ADADM/II/2024','Surat Pernyataan Perbedaan','2024-02-02',5,3,22,'38102.pdf',5,1,'2024-05-12 21:17:55'),
(34,'012/HRGA/II/2024','SK Magang','2024-02-01',7,2,21,'',7,1,'2024-05-12 16:34:03'),
(35,'016/ADDIR/I/2024','PPSK','2024-01-23',2,5,16,'',2,1,'2024-05-12 16:34:07'),
(36,'017/ADDIR/I/2024','PKWT','2024-01-31',2,5,16,'',2,1,'2024-05-12 16:34:08'),
(37,'007/ADADM/II/2024','Surat Pernyataan Perbedaan Masa Invoice, Surat Jalan, dengan Faktur Pajak','2024-02-05',4,3,22,'Surat Keterangan Perbedaan Tanggal Invoice dan Faktur Pajak - CNC.pdf',4,1,'2024-05-12 21:17:57'),
(38,'008/ADADM/II/2024','Surat Pernyataan Perbedaan Invoice & Faktur Pajak - Indonesia Tooling Technology','2024-02-05',4,3,22,'Surat Pernyataan Perbedaan Invoice & Faktur Pajak - PT. Indonesia Tooling Technology.pdf',4,1,'2024-05-12 21:17:58'),
(39,'001/ADDMKT/II/2024','Surat Pemberitahuan Libur','2024-02-07',12,6,17,NULL,12,1,'2024-05-12 21:14:54'),
(40,'013/HRGA/II/2024','SURAT PERSETUJUAN LINGKUNGAN PPH21 SIDOARJO','2024-02-13',7,2,16,'Permohonan Arahan Persetujuan Lingkungan.pdf',7,1,'2024-05-12 16:34:34'),
(41,'014/HRGA/II/2024','Payroll Feb\'24','2024-02-16',2,2,16,NULL,2,1,'2024-05-12 16:34:35'),
(42,'002/ADDMKT/II/2024','Surat Pemberitahuan Sosialisasi Pemilihan Material di FIM','2024-02-26',15,6,17,'Surat Pemberitahuan Sosialisasi Material di FIM.pdf',15,1,'2024-05-12 21:14:57'),
(43,'015/HRGA/II/2024','Surat Keterangan Kerja & Rekomendasi Pelatihan PLB3 - Faaiz','2024-02-28',7,2,16,'Surat Keterangan Bekerja dan Rekomendasi Training PLB3 - Faaiz.pdf',7,1,'2024-05-12 16:34:42'),
(44,'016/HRGA/II/2024','Surat Keterangan Kerja & Rekomendasi Pelatihan OPLB3 - Gunawan','2024-02-28',7,2,16,'Surat Keterangan Bekerja dan Rekomendasi Training OPLB3 - Gunawan.pdf',7,1,'2024-05-12 16:34:45'),
(45,'017/HRGA/III/2024','Permohonan Arahan Rintek Penyimpanan LB3 cabang Sidoarjo','2024-03-04',7,2,16,'Permohonan Arahan Rintek Penyimpanan LB3 Cabang Sidoarjo.pdf',7,1,'2024-05-12 16:34:45'),
(46,'018/ADDIR/III/2024','PKWTT','2024-03-08',2,1,16,NULL,2,1,'2024-05-12 16:34:51'),
(47,'019/ADDIR/III/2024','PPSK','2024-03-08',2,1,16,NULL,2,1,'2024-05-12 16:34:52'),
(48,'018/HRGA/III/2024','SP2','2024-03-08',2,2,16,NULL,2,1,'2024-05-12 16:34:54'),
(49,'019/HRGA/III/2024','Surat Permohonan Benchmark PT ASKI','2024-03-15',7,2,21,NULL,7,1,'2024-05-12 16:34:56'),
(50,'020/HRGA/III/2024','surat keterangan COP','2024-03-18',27,2,16,NULL,27,1,'2024-05-12 16:35:05'),
(51,'021/HRGA/III/2024','Informasi Libur Hari Raya 1445 H','2024-03-19',7,2,21,NULL,7,1,'2024-05-12 16:35:09'),
(52,'022/HRGA/III/2024','Surat Pemberitahuan Tetangga (Rekonstruksi MC. Custom Step II)','2024-03-21',7,2,21,NULL,7,1,'2024-05-12 16:35:11'),
(53,'001/ADDIR/III/2024','Payroll Maret 2024','2024-03-21',1,5,16,NULL,1,1,'2024-05-12 16:35:15'),
(54,'002/ADDIR/III/2024','THR Mar 2024','2024-03-21',2,5,16,NULL,2,1,'2024-05-12 16:35:17'),
(55,'003/ADDIR/III/2024','Payroll Mar 2024','2024-03-21',2,5,16,NULL,2,1,'2024-05-12 16:35:17'),
(56,'023/HRGA/III/2024','Surat Pengajuan Peralihan Deposito - Lippo Cikarang','2024-03-21',7,2,21,NULL,7,1,'2024-05-12 16:35:21'),
(57,'004/ADDIR/III/2024','PKWT','2024-03-21',2,5,16,NULL,2,1,'2024-05-12 16:35:28'),
(58,'001/ADFIN/III/2024','Surat Pernyataan Perbedaan Masa Invoice, Surat Jalan dengan Faktur Pajak','2024-03-22',4,4,11,NULL,4,1,'2024-05-12 16:40:41'),
(59,'002/ADFIN/III/2024','Surat Pernyataan Kesiapan dalam Menanggung Sanksi Pajak','2024-03-22',4,4,11,NULL,4,1,'2024-05-12 16:40:40'),
(60,'003/ADDMKT/III/2024','Surat pemberitahuan Libur Lebaran 2024','2024-03-25',12,6,17,NULL,12,1,'2024-05-12 21:15:04'),
(61,'003/ADFIN/III/2024','Surat Pernyataan Tagihan Non PPN','2024-03-28',4,4,11,'Surat Pernyataan Tagih Non PPN - Musashi.pdf',4,1,'2024-05-12 16:40:38'),
(62,'001/NULL/III/2024','Dokumen HT -- Test','2024-03-28',7,1,1,'Customer Card-74.pdf',7,1,'2024-05-12 20:59:27'),
(63,'005/ADDIR/IV/2024','PKWT','2024-04-04',2,5,16,NULL,2,1,'2024-05-12 16:35:39'),
(64,'002/NULL/IV/2024','Surat Test','2024-04-05',1,1,21,'PO-0489 Makmur Mandiri.pdf',1,1,'2024-05-12 18:24:33'),
(65,'024/HRGA/IV/2024','Surat Keterangan COP','2024-04-04',27,2,16,NULL,27,1,'2024-05-12 16:36:05'),
(66,'001/NULL/IV/2024','Laptop','2024-04-17',37,6,15,NULL,37,0,'2024-05-12 18:24:29'),
(67,'002/ADDMKT/IV/2024','Visit passtek','2024-04-23',37,6,17,NULL,37,1,'2024-05-12 21:15:08'),
(68,'003/ADDMKT/IV/2024','Visit passtek','2024-04-23',37,6,17,NULL,37,0,'2024-05-12 21:15:09'),
(69,'004/ADDMKT/IV/2024','Visit pastek','2024-04-23',37,6,17,NULL,37,0,'2024-05-12 21:15:11'),
(70,'006/ADDIR/IV/2024','Payroll April 2024','2024-04-24',2,5,16,NULL,2,1,'2024-05-12 16:36:15'),
(71,'004/ADFIN/IV/2024','Surat Tagihan Non PPN - PT. NRZ Prima Gasket','2024-04-24',12,4,11,'Surat NRZ 24-4-24.pdf',12,1,'2024-05-12 20:59:13'),
(72,'005/NULL/IV/2024','Visitv, gesang danbnaratama','2024-04-24',12,1,6,NULL,12,0,'2024-05-12 20:59:12'),
(73,'006/ADDMKT/IV/2024','Visit, gesang dan naratama','2024-04-24',12,6,17,NULL,12,0,'2024-05-12 21:15:15'),
(74,'007/ADDMKT/IV/2024','Visit gesang, naratama','2024-04-24',12,6,17,NULL,12,0,'2024-05-12 21:15:16'),
(75,'004/ADDMKT/IV/2024','Peminjaman kendaraan mobil, untuk ke PT. Chiyoda pick up barang\nDriver Bp. Norman','2024-04-26',41,6,17,NULL,41,1,'2024-05-12 21:15:17'),
(76,'005/ADFIN/IV/2024','Konfirmasi Penggunaan Jasa Aktuaris Untuk Perhitungan Kewajiban Diestimasi Tahun 2024','2024-04-30',41,4,20,'005ADFINIV2024 - KONFIRMASI PENGGUNAAN JASA AKTUARIS 2024 (ADASI).pdf',41,1,'2024-05-12 20:58:59'),
(77,'006/ADFIN/V/2024','Surat Permohonan Pengembalian Dana atas Double Transfer - Kopkar AI','2024-05-02',4,4,11,NULL,4,1,'2024-05-02 03:39:39'),
(78,'007/ADFIN/V/2024','Testew','2024-05-14',28,4,11,NULL,28,1,'2024-05-14 09:59:21'),
(79,'010/ADADM/VI/2024','hgfhgch','2024-06-12',1,3,1,NULL,1,1,'2024-06-16 20:19:57'),
(80,'011/ADADM/VI/2024','gnfjhvj','2024-06-21',1,3,1,NULL,1,1,'2024-06-16 20:20:43'),
(81,'012/ADADM/VI/2024','ghfhg','2024-06-13',1,3,1,NULL,1,1,'2024-06-16 20:21:47'),
(82,'008/ADFIN/VI/2024','hhkjhkij','2024-06-12',1,4,1,NULL,1,1,'2024-06-16 20:22:33'),
(83,'013/ADADM/VI/2024','Test','2024-06-22',1,3,1,NULL,1,1,'2024-06-22 21:22:45');

/*Table structure for table `trx_ticket_request` */

DROP TABLE IF EXISTS `trx_ticket_request`;

CREATE TABLE `trx_ticket_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` varchar(255) DEFAULT NULL,
  `departement` int(11) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT current_timestamp(),
  `due_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_ticket_request` */

insert  into `trx_ticket_request`(`id`,`id_ticket`,`departement`,`summary`,`description`,`file_name`,`user_create`,`date_create`,`due_date`,`status`,`note`,`is_active`,`update_by`,`last_update`) values 
(1,'ADS.20240611.00001',2,'Tes request 1','Tes request fungsi','619_290424_AIR ENGINE.pdf',1,'2024-06-11 21:27:01',NULL,6,'close dong',1,1,'2024-06-13 08:26:05'),
(2,'ADS.20240613.00002',2,'tes lagi','ffffff','619_290424_AIR ENGINE.pdf',1,'2024-06-13 08:24:30',NULL,6,'cek dasfasfas asfadfd',1,1,'2024-06-13 08:27:15'),
(3,'ADS.240613.0003',2,'asdsd','sdasdas','ADASI POB (1).pdf',1,'2024-06-13 08:32:42',NULL,6,'asdasd',1,1,'2024-06-13 08:33:20'),
(4,'ADS.240614.0004',2,'1fhfdghgf','dgdfsgsdfg','ADASI POB (1).pdf',1,'2024-06-14 09:31:41',NULL,6,NULL,1,1,'2024-06-14 09:32:18'),
(5,'ADS.240614.0005',2,'fdgbfdgb','dfbsdffgd','619_290424_AIR ENGINE.pdf',1,'2024-06-14 09:32:32',NULL,4,NULL,1,1,'2024-06-14 09:32:39');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `npk` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_tlp` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`pass`,`role_id`,`name`,`npk`,`email`,`no_tlp`,`foto`,`status`,`is_active`,`update_by`,`last_update`) values 
(1,'SUPERADMIN','$2y$12$5FULY9NX47FE4BJ5EiM2GetVcQJIob15mDYipce08CE9wzrb8anOG','Super123',1,'MEDI KRISNANTO','5661','-','0','74648.jpg',1,1,1,'2024-05-14 08:37:55'),
(2,'JESSICA','$2y$12$Dui/.Vpid.HkFSZxWGl0mOZuDS7k7ckM/OdyFzW/lreb1iEFxkmia','adasi',16,'JESSICA PAUNE','5584','astra-daido.co.id','0','default.jpg',0,1,1,'2024-05-12 17:39:57'),
(3,'MEDI','$2y$12$0cV0/5Fy7gCIxK1T5iZ8penMy.0HPoFzdIeRbdhdI/Ez7yP.W2Y86','Super123',1,'MEDI KRISNANTO','1131','astra-daido.co.id','0','10569.png',1,0,1,'2024-05-14 08:38:16'),
(4,'RICHARDUS','$2y$12$39nAmxHJlPYiOOMd6cy28e6EsKZAodJxLiHNVozPRxsmYn5DWc6YO','123',11,'RICHARDUS','5660','astra-daido.co.id','0','default.jpg',0,1,1,'2024-05-12 17:21:11'),
(5,'DINAR','$2y$12$eq0ue0QZIKTXxsCdvrN/DeNUGt6cDU/Ph1UbgocVwFg00z9dtKiIe','123',22,'MUHAMMAD DINAR FARISI','5648','astra-daido.co.id','0','default.jpg',0,1,1,'2024-05-12 17:21:13'),
(6,'DIREKTUR','$2y$12$oK14uvPa/h6r.DGdcfYoo.ru3ux1uRmOLbuPCZSZAuBVkrqE9WoY2','123',5,'DIREKTUR','1111','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-13 21:17:24'),
(7,'ULFA','$2y$12$ZxET1etoPSi8Hf1cAe3Ppuew40oaO.qKxsaQL8qbZPr50bd.Mc.wq','123',21,'SITI ULFA ULFA','5657','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:13'),
(8,'HARDI','$2y$12$8Iv.ebZ6lR4a23N8UPVNMeZqaOsGWtZKxEe/N71WfSJ8mmz1ypZLS','123',7,'HARDI SAPUTRA','5424','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-13 21:17:08'),
(9,'RIDHO','$2y$12$4dsjDbznrM4C.v.Z8LYEr.owJKCNZiOTea6rm6GsbVj3tyoSfzF3W','123',14,'RIDHO','5633','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:15'),
(10,'ILHAM','$2y$12$WJO8XID7MR.QpGsGxWguZOQi58VQiWcdieG4OeAX9lUd9GLT7iVaa','123',17,'ILHAM CHOLID','5530\r\n','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:15'),
(11,'HERY','$2y$12$XRS169m9.BMyc8hyJIPwAuALg7.q5LQknguVwN70bKMfPBD6ccOSO','123',17,'HERY','5591','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:15'),
(12,'HERLIANA','$2y$12$fU12mzv.AtcVjNBWKb42OuyBjtOmmASF5lqciz3xx4vq3nOd/BeMa','123',17,'HERLIANA','5428','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:16'),
(13,'CLAUDIA','$2y$12$inI0yf5V/pEthJQ5MBS6MO5tmP.QUYyeQ3e2rkre/3ha/43YRYWJG','123',17,'FRISILIA CLAUDIA HUTAMA','5506','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:16'),
(14,'PUTRI','$2y$12$sHbYwkOhVI2Ufzxp20lMr.7P9ilb3u5OEkvq4NO5s5pyVu/6OSYIC','123',17,'PUTRI ANINDIA','5597','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:18'),
(15,'ERIK','$2y$12$QbgUKDag20vZCcVgWiPXiO9QnSwfjzqqGXw51LrGcX9xIqSWK2Ue.','123',17,'ERIK KHARISMA PUTRA','5653','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:17'),
(16,'HEXAPA','$2y$12$N/h/fuCxGpELA8Y8WwcOf.n9/MnnnOMvdOiJWzzZRL7/PhDrbb/di','123',17,'HEXAPA DARMADI','5658\r\n','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:17'),
(17,'DANIA','$2y$12$o9G42PAdffdqdbnCifirG.AO.S.oxjWA3i.670n8UelkD/EDtFko2','123',17,'DANIA ISMAWATI','5607','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:19'),
(18,'JUN','$2y$12$a.GvVwcUG4lXoIX00N4WheAibdM2OScg8RtBf6tN4MgTeK8Sge8Gi','123',17,'JUN JOHAMIN PD','5471','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:46'),
(19,'WULYO','$2y$12$WdhI8y7DUllXO3PLmCTEyu6HwmDzb3dTJUzrL166ujdQmeawnnzbq','123',17,'WULYO EKO PRASETYO','5459','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:20'),
(20,'SENDI','$2y$12$q5zNNafpuzwdqreQ/X6e9uAsH860kLql6X0R4BJ6xsaL1Cid6Xyy6','123',17,'SENDY PRABOWO','5596','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:20'),
(21,'WELEM','$2y$12$KijH2iRzIlFBDlNcK8uWm.icZ2H0Hpy.yVMz0lq2223JNP.FIuO0O','123',17,'YAN WELEM MANGINSELA','5650','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:22'),
(22,'TOTOK','$2y$12$bZcNA6KorE4jcKRUfKyM3uRVbobOBCAkO5Cw1GdPtGW1/I2vFnILe','123',17,'ANDIK TOTOK SISWOYO','5456','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:21'),
(23,'DWI','$2y$12$OivzGDWlENcws2UJuxZuC.gMAaRzYjgV/WrLYh/lUzbaC5EaS07sm','123',17,'DWI KUNTORO','5644','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:22'),
(24,'RISFAN','$2y$12$hWMOiZTNsD.sxs7bwfMs5u4zyOBd/PDhu4HZ/esK3U1nxkkTUHYZu','123',17,'RISFAN FAISAL','5387','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:23'),
(25,'HARRY','$2y$12$YdqaKjbanQv8riUfKu432useuIwHKwBjWyYnkQ/tLKtqgPP4n4cue','123',17,'HARRY SUPRIYADI','5410','astra-daido.co.id','0','35088.jpg',NULL,1,1,'2024-05-12 17:21:23'),
(26,'LINA','$2y$12$OJ8kwvfypGKCrdrC8LEfkO3JZJjiTUu1E6XDUEySb7z6GbVIKDN7a','123',17,'LINA','3333','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-13 21:17:35'),
(27,'CAHYO','$2y$12$M1yQPhrRS7E5e4aSmmlIKeViHL6EuZt/DREi9Xy1VlwlUBioyrk1q','123',8,'MARTINUS CAHYO RAHASTO','5635','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-14 08:29:05'),
(28,'ADHI','$2y$12$aSkI8F4B/ROuHA1oWrHFGOWhR/eM2Pu3bZv1xHhR9OkIz58KkBGqK','123',11,'ADHI PRASETIYO','5519','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-14 08:26:28'),
(29,'SARAH','$2y$12$GrPySfDuTb5Say4UhP.oj.3J16D7qTd8QOik/3EBsQwhy3Xl9tJN.','123',17,'SARAH','1243','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-13 21:18:18'),
(30,'SONY','$2y$12$qUTwwKPvi2vWiCbuvUr8nOF/OrupY4oupLMMjjppsbE4Ltwu0NBHq','123',17,'SONY STIAWAN','5391\r\n','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:25'),
(31,'DIMAS','$2y$12$vGb7M6CNt22Mk/ulV3Wc7.B.UwrUWxqh5BpLrxRCvmNqUuGW8kvV6','123',17,'DIMAS ADITYA PRIANDANA','5655','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:26'),
(32,'GUNAWAN','$2y$12$mLX4HWsusgUMeHqT30PPHOuOCl4pGTTZ0BvXwsyvTEAHjkT399W4e','Gunawan',23,'GUNAWAN','5421','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:26'),
(33,'SECURITY','$2y$12$zkcdxrn0QovsMZxQ1.1Jve77DMcZ28EF1XiHkG5nXjHWpg4vUiZIe','Security',24,'SECURITY DS8','4444','security.sigap@astra-daido.co.id','0','32970.png',NULL,1,1,'2024-05-13 21:17:38'),
(34,'RANGGA','$2y$12$rLwaGvod6kJVYLOEesb7w.ajVEdYU/9vWgG9lIJsXwq95Q/DEDAgu','Rangga',14,'RANGGA FADILLAH','5605','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:27'),
(35,'FAAIZ','$2y$12$2sYKViEce6HF0y0YO.IAc.piQTXFsLEzos2vQr2/x6UwdSx8yvQqq','Faiz',15,'ABDUR RAHMAN AL FAAIZ','5520','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:27'),
(36,'RAGIL','$2y$12$BBUQ/uIFH.QNxXdWumsjR.mw2jJQb/MtPJHZzhrEwfgbEiH3ovEqO','Rafil',19,'RAGIL ISHA RAHMANTO','5639','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:27'),
(37,'MUGI','$2y$12$oWWnt1b6Ws1.hv.7Q1PFJOphISkC4ERS0dA4osi8lP9yrmaprS7tG','Mugi',12,'MUGI PRAMONO','5649','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:28'),
(38,'KOMANG','$2y$12$8gZr572ff1evLNAx4T8Mh.MKTBvf/qQfmwE9z2yFJS/7/VBp9EZhu','Komang',12,'KOMANG HANDIKA','1234','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-13 21:17:47'),
(39,'VITRI','$2y$12$ykkrJUpqC/FeiBkFUfSgkOmu0jAmMXFIJvVGnFXG1VQu.hyYMKbVG','Vitri',9,'VITRI HANDAYANI','5632','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:28'),
(40,'YUNASIS','$2y$12$n6Nns78VzepRfBnTlHciWe5k0Ftbu74./bMhog09W3l1ovBB3mvZG','Yunasis',17,'YUNASIS','5375','astra-daido.co.id','0','default.jpg',NULL,1,1,'2024-05-12 17:21:29'),
(41,'GILANG','$2y$12$q8MYiCIv9g5wKkB..nIqh.Gwe5EgmCvgbRBFlbwTIQgk94urBbDZi','Gilang',20,'GILANG','4321','-','0','default.jpg',NULL,1,1,'2024-05-13 21:17:50');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
