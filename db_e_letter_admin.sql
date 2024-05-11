/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.11.4-MariaDB : Database - db_e_letter_admin
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `mst_asset` */

insert  into `mst_asset`(`id`,`no_assets`,`name`,`merk`,`tahun`,`status`,`lokasi`,`kategori`,`kepemilikan`,`update_by`,`is_active`,`last_update`) values 
(1,'B 1064 FYU','Kijang Innova V','Inova','2013',0,'Delta Silicon 8',1,'ADASI',1,1,'2024-03-17 10:39:21'),
(2,'B 1231 FYV','F600RV-GMDF33','Xenia','2009',0,'Deltamas',1,'ADASI',1,1,'2024-03-17 10:39:21'),
(3,'B 1161 FLT','Fortuner 2.5 G M/T','Fortuner','2015',0,'Delta Silicon 8',1,'ADASI',1,1,'2024-03-17 10:39:22'),
(4,'B 1187 FYY','S4Q1RV-ZMDEJJ HJ','Grandmax','2013',0,'Delta Silicon 8',1,'ADASI',1,1,'2024-03-17 10:39:23'),
(5,'Room Meeting 1st','Room Meeting 1st','RM-1st',NULL,0,NULL,2,NULL,1,1,'2024-03-17 10:39:23'),
(6,'Room Meeting 2st','Room Meeting 2st','RM-2st',NULL,0,NULL,2,NULL,1,1,'2024-03-17 10:39:31');

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
(1,'ADHI PRASETIYO',' 5519',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(2,'AHMAD RIDWAN',' 5473',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(3,'ANDI SIMPONI',' 5426',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(4,'ANDIK TOTOK SISWOYO',' 5456',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(5,'ARY RODJO PRASETYO',' 5439',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(6,'AVI SHENNA',' 5558',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(7,'AWING',' 5538',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(8,'BANGUN SUTOPO',' 5485',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(9,'CECEP ISKANDAR',' 5647',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(10,'DANIA ISNAWATI',' 5607',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(11,'DIMAS ADITYA PRIANDANA',' 5655',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(12,'DINA NIMAS AYU NAWAWULAN PRIHANTINI',' 5447',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(13,'DWI KUNTORO',' 5644',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(14,'ELI HANDOYO',' 5572',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(15,'ERIK KHARISMA PUTRA',' 5653',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(16,'FIKRI SYAHBANA',' 5559',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(17,'FRISILIA CLAUDIA HUTAMA',' 5606',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(18,'GUNAWAN',' 5421',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(19,'HARDI SAPUTRA',' 5424',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(20,'HARRY SUPRIYADI',' 5410',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(21,'HERLIANA',' 5428',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(22,'HERY HERMAWAN',' 5591',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(23,'HEXAPA DARMADI',' 5658',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(24,'HUSEIN ABDULLAH',' 5652',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(25,'ILHAM CHOLID',' 5530',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(26,'ILHAM SETIA DARMA',' 5651',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(27,'IMAM PRASETYO',' 5543',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(28,'IMAM SOPYAN',' 5641',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(29,'JEFRY WASTON .E',' 5488',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(30,'JESSICA PAUNE',' 5584',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(31,'JONI SETIAWAN',' 5545',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(32,'JUN JOHAMIN PD',' 5471',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(33,'KUSTIONO',' 5560',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(34,'LINA UNIARSIH',' 5580',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(35,'LUKMAN AHMAD',' 5574',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(36,'M. RIDWAN GUNAWAN',' 5525',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(37,'MARTINUS CAHYO RAHASTO',' 5635',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(38,'MOCHAMMAD ANDRIANSYAH',' 5659',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(39,'MOHAMMAD FATKHURROHMAN',' 5576',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(40,'MUHAMMAD DINAR FARISI',' 5648',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(41,'MUHAMMAD MAHBUB',' 5552',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(42,'NUR DWITA SURA WIJAYA',' 5531',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(43,'PUTRI ANINDIA',' 5597',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(44,'RAGIL ISHA RAHMANTO',' 5639',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(45,'RIADUS SOLIHIN',' 5570',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(46,'RICHARDUS',' 5660',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(47,'RISFAN FAISAL',' 5387',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(48,'RUSLAN M.ALI',' 5403',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(49,'SENDY PRABOWO',' 5596',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(50,'SETIYAWAN',' 5540',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(51,'SITI MARIA ULFA',' 5657',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(52,'SONY STIAWAN',' 5391',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(53,'SUDIYATNO',' 5366',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(54,'SUKIMIN',' 5430',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(55,'WULYO EKO PRASETYO',' 5459',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(56,'YAN WELEM MANGINSELA',' 5650',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(57,'YANUARDIN SALEH SIREGAR',' 5537',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(58,'YUDHI PRASETYO RAHMAWANTO',' 5548',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(59,'YULMAI RIDO WINANDA',' 5633',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(60,'YUNASIS PALGUNADI',' 5375',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(61,'ZAENAL ARIFIN',' 5486',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(62,'ABDUR RAHMAN AL FAAIZ',' 5520',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(63,'AFILIANDI',' 5487',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(64,'AGUNG PANGESTU YUSUF',' 5535',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(65,'AGUS PRIYANTO',' 5418',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(66,'AGUS ROSIDIN',' 5600',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(67,'ANDI SANTOSO',' 5532',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(68,'ANDI SIMPONI',' 5426',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(69,'ARRY SOEBHEKTI',' 5443',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(70,'AWING',' 5538',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(71,'DASUKI',' 5425',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(72,'DEDY SETIAWAN',' 5388',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(73,'DIAMAN DARMAWINATA',' 5551',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(74,'ELI HANDOYO',' 5572',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(75,'FAIZAL AFDAU',' 5578',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(76,'FATUL MUKMIN',' 5616',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(77,'HAERUL IKHSAN',' 5542',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(78,'HENDRIO',' 5569',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(79,'JAKA RARA SUKMA',' 5536',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(80,'JAKARIA',' 5544',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(81,'KARYA WIJAYA',' 5546',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(82,'LUKMAN AHMAD',' 5574',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(83,'MAMIK ABIDIN',' 5434',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(84,'MEDI KRISNANTO','5661',NULL,NULL,NULL,1,1,'2024-05-11 17:58:17'),
(85,'MIFTAKHUROHMAN',' 5489',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(86,'MUGI PRAMONO',' 5649',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(87,'NUR SUPRIYANTO',' 5564',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(88,'NURSAID',' 5264',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(89,'NURSALIM',' 5539',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(90,'R.WAWAN HIMAWAN',' 5457',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(91,'RAHMAT NUGROHO',' 5582',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(92,'RANGGA FADILLAH',' 5605',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(93,'RIZKY ANDREA RAHMAWAN',' 5586',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(94,'RUKMAN',' 5419',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(95,'RUSITO',' 5397',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(96,'SABAR WASIRAN',' 5646',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(97,'SEPTIADI PRATOMO',' 5466',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(98,'SUDIYATNO',' 5366',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(99,'UMAR HADI',' 5541',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(100,'VITRI HANDAYANI',' 5632',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(101,'YANUARDIN SALEH SIREGAR',' 5537',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50'),
(102,'YUSUF SYAFAAT',' 5472',NULL,NULL,NULL,1,1,'2024-05-01 08:27:50');

/*Table structure for table `mst_role` */

DROP TABLE IF EXISTS `mst_role`;

CREATE TABLE `mst_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `whr_input_surat` varchar(255) DEFAULT NULL,
  `whr_show_surat` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `mst_role` */

insert  into `mst_role`(`id`,`name`,`whr_input_surat`,`whr_show_surat`,`is_active`,`update_by`,`last_update`) values 
(1,'SUPERADMIN','2,3,4,5,6','1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25',1,1,'2024-05-11 16:35:24'),
(2,'HR','5,2',NULL,1,1,'2024-05-11 15:46:21'),
(3,'ADMINISTRASI','3',NULL,1,1,'2024-05-11 15:46:25'),
(4,'FINANCE','4',NULL,1,1,'2024-05-11 15:46:33'),
(5,'DIREKSI','5',NULL,1,1,'2024-05-11 15:46:41'),
(6,'MARKETING','6',NULL,1,1,'2024-05-11 15:46:46'),
(7,'DH-SALES','6','17',1,1,'2024-05-11 16:21:24'),
(8,'DH-FIN ACC HRGA IT','5,2,4','11,16,21,22',1,1,'2024-05-11 16:21:11'),
(9,'DH-SUPPLY CHAIN',NULL,NULL,1,1,'2024-05-11 15:46:58'),
(10,'DH-HT PROD',NULL,NULL,1,1,'2024-05-11 15:47:00'),
(11,'SC-FIN','4',NULL,1,1,'2024-05-11 15:47:04'),
(12,'SC-CT PROD',NULL,NULL,1,1,'2024-05-11 15:47:06'),
(13,'SC-MC PROD',NULL,NULL,1,1,'2024-05-11 15:47:09'),
(14,'SC-PPC',NULL,NULL,1,1,'2024-05-11 15:47:13'),
(15,'SC-WHS',NULL,NULL,1,1,'2024-05-11 15:47:17'),
(16,'SC-HRGA','5,2',NULL,1,1,'2024-05-11 15:47:23'),
(17,'UR-SALES','6',NULL,1,1,'2024-05-11 15:47:26'),
(18,'UR-CT PROD',NULL,NULL,1,1,'2024-05-11 15:47:29'),
(19,'UR-MC PROD',NULL,NULL,1,1,'2024-05-11 15:47:32'),
(20,'UR-ADMIN FIN','3,4',NULL,1,1,'2024-05-11 15:47:35'),
(21,'UR-HR','2',NULL,1,1,'2024-05-11 15:47:39'),
(22,'UR-GA','3',NULL,1,1,'2024-05-11 15:47:43'),
(23,'UR-DOCUMENT','3',NULL,1,1,'2024-05-11 15:47:46'),
(24,'UR-SECURITY',NULL,NULL,1,1,'2024-05-11 15:47:50'),
(25,'UR-HT PROD',NULL,NULL,1,1,'2024-05-11 15:47:54');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_assets_landing` */

insert  into `trx_assets_landing`(`id`,`id_user`,`date_create`,`id_dephed`,`dephed_detail`,`id_first`,`first_detail`,`id_second`,`second_detail`,`id_director`,`director_detail`,`date_start`,`date_end`,`arrtgl`,`data_asset`,`necessity`,`status`,`update_by`,`last_update`) values 
(1,1,NULL,1,NULL,1,NULL,NULL,NULL,1,NULL,'2024-03-23 08:00:31','2024-03-23 12:00:42','[\"2024-03-23 08\",\"2024-03-23 09\",\"2024-03-23 10\",\"2024-03-23 11\",\"2024-03-23 12\"]',5,'Tesss',5,1,'2024-05-01 17:57:22'),
(2,1,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-23 13:00:00','2024-03-23 17:00:13','[\"2024-03-23 13\",\"2024-03-23 14\",\"2024-03-23 15\",\"2024-03-23 16\",\"2024-03-23 17\"]',5,'Tes',6,1,'2024-05-01 17:57:23'),
(3,1,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-26 11:00:06','2024-04-26 15:00:14','[\"2024-04-26 11\",\"2024-04-26 12\",\"2024-04-26 13\",\"2024-04-26 14\",\"2024-04-26 15\"]',1,'Tesss',6,1,'2024-05-01 17:57:24'),
(4,1,NULL,1,NULL,1,NULL,1,NULL,NULL,NULL,'2024-04-26 17:00:35','2024-04-26 19:00:41','[\"2024-04-26 17\",\"2024-04-26 18\",\"2024-04-26 19\"]',1,'tesss',6,1,'2024-05-01 17:57:25'),
(5,1,NULL,1,NULL,1,NULL,1,NULL,1,'[\"2024-04-29 14:54:35\",\"Tesssss data cancel\"]','2024-04-27 19:15:25','2024-04-27 22:15:31','[\"2024-04-27 19\",\"2024-04-27 20\",\"2024-04-27 21\",\"2024-04-27 22\"]',1,'tess reurn',6,1,'2024-05-01 17:57:27'),
(6,1,NULL,1,'[\"2024-04-29 11:42:03\",\"Tess masuk g nich datanya\"]',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-27 20:00:00','2024-04-27 23:00:00','[\"2024-04-27 20\",\"2024-04-27 21\",\"2024-04-27 22\",\"2024-04-27 23\"]',2,'rtrt',6,1,'2024-05-01 17:57:28'),
(7,1,NULL,1,'[\"2024-04-29 11:41:36\",\"-\"]',1,'[\"2024-04-29 11:52:06\",\"-\"]',1,'[\"2024-04-29 12:00:39\",\"-\"]',1,'[\"2024-04-29 14:55:05\",\"wdadasdasd\"]','2024-04-29 09:30:55','2024-04-29 12:00:01','[\"2024-04-29 09\",\"2024-04-29 10\",\"2024-04-29 11\"]',1,'Tesss',5,1,'2024-05-01 17:57:33'),
(8,1,NULL,1,'[\"2024-04-30 14:02:39\",\"Coba isi note rejecty\"]',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-30 09:00:52','2024-04-30 11:15:56','[\"2024-04-30 09\",\"2024-04-30 10\",\"2024-04-30 11\"]',1,'eeerer',6,1,'2024-05-01 17:57:34'),
(9,1,'2024-04-30 13:51:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-30 14:00:10','2024-04-30 15:00:13','[\"2024-04-30 14\",\"2024-04-30 15\"]',1,'adsadsdsdsd',1,1,'2024-05-01 17:57:35'),
(10,1,'2024-04-30 13:51:56',1,'[\"2024-05-01 18:03:44\",\"mn mkjbkjbk\"]',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-30 14:45:25','2024-04-30 15:00:27','[\"2024-04-30 14\"]',2,'fefeewewew',6,1,'2024-05-01 18:03:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_chceksheet_asset` */

insert  into `trx_chceksheet_asset`(`id`,`id_user`,`id_asset`,`type`,`tanggal`,`keterangan`) values 
(1,1,1,1,'2024-03-20',NULL),
(2,1,2,2,'2024-03-20','Tesssss'),
(3,1,3,1,'2024-03-29',NULL),
(4,1,2,2,'2024-03-07','Ganti Oli\nGanti Mobil'),
(5,1,1,1,'2024-03-15',NULL),
(6,1,3,2,'2024-03-15','Ganti oli\nGanti Ban\nGanti Kopling');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_employe_loan` */

insert  into `trx_employe_loan`(`id`,`id_karyawan`,`nominal_loan`,`bulan_loan`,`loan_perbulan`,`start_bulan`,`list_pembayaran`,`golongan`,`is_active`,`update_by`,`last_update`) values 
(1,84,50000000,50,1000000,'2024-01','[{\"bulan\": \"2024-01\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"1000000\",\"sisa\": \"49000000\"},{\"bulan\": \"2024-02\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"2000000\",\"sisa\": \"48000000\"},{\"bulan\": \"2024-03\",\"jml\": \"2\",\"nominal\": \"2000000\",\"terbayarkan\": \"4000000\",\"sisa\": \"46000000\"},{\"bulan\": \"2024-04\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"5000000\",\"sisa\": \"45000000\"},{\"bulan\": \"2024-05\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"6000000\",\"sisa\": \"44000000\"},{\"bulan\": \"2024-06\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"7000000\",\"sisa\": \"43000000\"},{\"bulan\": \"2024-07\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"8000000\",\"sisa\": \"42000000\"},{\"bulan\": \"2024-08\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"9000000\",\"sisa\": \"41000000\"},{\"bulan\": \"2024-09\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"10000000\",\"sisa\": \"40000000\"},{\"bulan\": \"2024-10\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"11000000\",\"sisa\": \"39000000\"},{\"bulan\": \"2024-11\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"12000000\",\"sisa\": \"38000000\"},{\"bulan\": \"2024-12\",\"jml\": \"2\",\"nominal\": \"2000000\",\"terbayarkan\": \"14000000\",\"sisa\": \"36000000\"},{\"bulan\": \"2025-01\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"15000000\",\"sisa\": \"35000000\"},{\"bulan\": \"2025-02\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"16000000\",\"sisa\": \"34000000\"},{\"bulan\": \"2025-03\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"17000000\",\"sisa\": \"33000000\"},{\"bulan\": \"2025-04\",\"jml\": \"2\",\"nominal\": \"2000000\",\"terbayarkan\": \"19000000\",\"sisa\": \"31000000\"},{\"bulan\": \"2025-05\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"20000000\",\"sisa\": \"30000000\"},{\"bulan\": \"2025-06\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"21000000\",\"sisa\": \"29000000\"},{\"bulan\": \"2025-07\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"22000000\",\"sisa\": \"28000000\"},{\"bulan\": \"2025-08\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"23000000\",\"sisa\": \"27000000\"},{\"bulan\": \"2025-09\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"24000000\",\"sisa\": \"26000000\"},{\"bulan\": \"2025-10\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"25000000\",\"sisa\": \"25000000\"},{\"bulan\": \"2025-11\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"26000000\",\"sisa\": \"24000000\"},{\"bulan\": \"2025-12\",\"jml\": \"2\",\"nominal\": \"2000000\",\"terbayarkan\": \"28000000\",\"sisa\": \"22000000\"},{\"bulan\": \"2026-01\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"29000000\",\"sisa\": \"21000000\"},{\"bulan\": \"2026-02\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"30000000\",\"sisa\": \"20000000\"},{\"bulan\": \"2026-03\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"31000000\",\"sisa\": \"19000000\"},{\"bulan\": \"2026-04\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"32000000\",\"sisa\": \"18000000\"},{\"bulan\": \"2026-05\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"33000000\",\"sisa\": \"17000000\"},{\"bulan\": \"2026-06\",\"jml\": \"2\",\"nominal\": \"2000000\",\"terbayarkan\": \"35000000\",\"sisa\": \"15000000\"},{\"bulan\": \"2026-07\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"36000000\",\"sisa\": \"14000000\"},{\"bulan\": \"2026-08\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"37000000\",\"sisa\": \"13000000\"},{\"bulan\": \"2026-09\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"38000000\",\"sisa\": \"12000000\"},{\"bulan\": \"2026-10\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"39000000\",\"sisa\": \"11000000\"},{\"bulan\": \"2026-11\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"40000000\",\"sisa\": \"10000000\"},{\"bulan\": \"2026-12\",\"jml\": \"2\",\"nominal\": \"2000000\",\"terbayarkan\": \"42000000\",\"sisa\": \"8000000\"},{\"bulan\": \"2027-01\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"43000000\",\"sisa\": \"7000000\"},{\"bulan\": \"2027-02\",\"jml\": \"2\",\"nominal\": \"2000000\",\"terbayarkan\": \"45000000\",\"sisa\": \"5000000\"},{\"bulan\": \"2027-03\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"46000000\",\"sisa\": \"4000000\"},{\"bulan\": \"2027-04\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"47000000\",\"sisa\": \"3000000\"},{\"bulan\": \"2027-05\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"48000000\",\"sisa\": \"2000000\"},{\"bulan\": \"2027-06\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"49000000\",\"sisa\": \"1000000\"},{\"bulan\": \"2027-07\",\"jml\": \"1\",\"nominal\": \"1000000\",\"terbayarkan\": \"50000000\",\"sisa\": \"0\"}]','3A',1,1,'2024-05-11 16:52:24');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_file` */

insert  into `trx_file`(`id`,`id_folder`,`tittle`,`file_name`,`ukuran`,`to_dept`,`status`,`revisi`,`tgl_efektif`,`is_active`,`update_by`,`last_update`) values 
(1,1,'Surat Starworse','11422.pdf','1818.84','MARKETING',NULL,NULL,NULL,0,1,'2024-03-22 09:43:45'),
(2,1,'Surat D','22032024141000.pdf','246.79','DIREKSI',NULL,NULL,NULL,0,1,'2024-03-23 23:23:08'),
(3,1,'Avengers Letter','11422.pdf','1818.84','4',NULL,NULL,NULL,0,1,'2024-03-23 23:56:28'),
(4,1,'Surat Avenger','11422.pdf','1818.84','9',NULL,NULL,NULL,0,1,'2024-03-23 23:58:04'),
(5,1,'Sampel A','11422.pdf','1818.84','3',NULL,NULL,NULL,1,1,'2024-03-25 10:51:30'),
(6,1,'Sampel B','22032024141000.pdf','246.79','3',NULL,NULL,NULL,1,1,'2024-03-25 11:35:53'),
(7,1,'Sampel C','Invoice Pistol Grip 190324.pdf','2465.58','10',NULL,NULL,NULL,1,1,'2024-03-25 12:59:43'),
(8,1,'Dokumen','Work Order Machining-11.pdf','8.06','14',NULL,NULL,NULL,1,1,'2024-03-28 13:28:42'),
(9,1,'CustomerCard HMI01','TUNING SOFTWARE TX RX API STRUCTURE.pdf','3646.69',NULL,NULL,'4','2024-04-27',1,1,'2024-04-03 11:44:29'),
(10,1,'tes','SoftLayout Deltamas.pdf','296.81','8','AKTIVE','tes','2024-05-10',1,1,'2024-05-09 21:41:41');

/*Table structure for table `trx_folder` */

DROP TABLE IF EXISTS `trx_folder`;

CREATE TABLE `trx_folder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_name` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_folder` */

insert  into `trx_folder`(`id`,`folder_name`,`is_active`,`update_by`,`last_update`) values 
(1,'Tes Input',1,1,'2024-03-10 21:02:17'),
(2,'Tess Add Edit',1,1,'2024-03-11 11:08:18');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `trx_setting_bulan_thr` */

insert  into `trx_setting_bulan_thr`(`id`,`tahun`,`bulan`,`is_active`,`update_by`,`last_update`) values 
(1,2024,'03',1,1,'2024-05-11 14:39:30'),
(2,2026,'06',1,1,'2024-05-11 14:39:42'),
(3,2025,'04',1,1,'2024-05-11 14:48:35'),
(4,2027,'02',1,1,'2024-05-11 16:37:33');

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_surat` */

insert  into `trx_surat`(`id`,`letter_admin`,`notes`,`date_release`,`employe`,`to_dept`,`role_id`,`name_file`,`update_by`,`is_active`,`last_update`) values 
(1,'001/ADDIR/I/2024','Surat Kiriman','2024-01-02',2,1,2,'49627.pdf',2,1,'2024-02-06 18:54:24'),
(2,'002/ADDIR/I/2024','PPSK','2024-01-02',2,1,2,'',2,1,'2024-02-01 18:14:37'),
(3,'003/ADDIR/I/2024','PPSK','2024-01-02',2,1,2,'',2,1,'2024-02-01 18:14:55'),
(4,'004/ADDIR/I/2024','SKPK MR','2024-01-02',2,1,2,'',2,1,'2024-02-01 18:15:09'),
(5,'005/ADDIR/I/2024','SKPK Security','2024-01-02',2,1,2,'',2,1,'2024-02-01 18:15:23'),
(6,'006/ADDIR/I/2024','PKWT','2024-01-02',2,1,2,'',2,1,'2024-02-01 18:15:36'),
(7,'007/ADDIR/I/2024','SKPKT','2024-01-02',2,1,2,'',2,1,'2024-02-01 18:16:12'),
(8,'008/ADDIR/I/2024','ITAS EB','2024-01-02',2,1,2,'63218.pdf',2,1,'2024-02-06 01:30:59'),
(9,'009/ADDIR/I/2024','PKWT','2024-01-02',2,1,2,'',2,1,'2024-02-01 18:16:48'),
(10,'010/ADDIR/I/2024','SK Tunj','2024-01-17',2,1,2,'',2,1,'2024-02-01 18:17:15'),
(11,'011/ADDIR/I/2024','SK Tunj','2024-01-17',2,1,2,'',2,1,'2024-02-01 18:17:48'),
(12,'012/ADDIR/I/2024','SK Core Value','2024-01-22',2,1,2,'',2,1,'2024-02-01 18:18:29'),
(13,'013/ADDIR/I/2024','SK Neop','2024-01-22',2,1,2,'',2,1,'2024-02-01 18:21:34'),
(14,'014/ADDIR/I/2024','PKWT','2024-01-22',2,1,2,'',2,1,'2024-02-01 18:21:45'),
(15,'015/ADDIR/I/2024','Payroll','2024-01-23',2,1,2,'',2,1,'2024-02-01 18:21:55'),
(16,'001/HRGA/I/2024','Pengantar MCU SE','2024-01-04',7,2,2,'',7,1,'2024-02-01 18:27:40'),
(17,'002/HRGA/I/2024','SK Magang Clerisela','2024-01-08',7,2,2,'',7,1,'2024-02-01 18:28:33'),
(18,'003/HRGA/I/2024','SK Permohonan Pak Sapto','2024-01-11',7,2,2,'',7,1,'2024-02-01 18:29:01'),
(19,'004/HRGA/I/2024','Pemberitahuan Tetangga (Simulasi)','2024-01-14',7,2,2,'',7,1,'2024-02-01 18:29:37'),
(20,'005/HRGA/I/2024','Pemberitahuan Tetangga (Simulasi)','2024-01-14',7,2,2,'',7,1,'2024-02-01 18:29:48'),
(21,'006/HRGA/I/2024','SK Erik','2024-01-25',7,2,2,'',7,1,'2024-02-01 18:30:05'),
(22,'007/HRGA/I/2024','Pengantar MCU','2024-01-26',7,2,2,'',7,1,'2024-02-01 18:30:27'),
(23,'008/HRGA/I/2024','Training','2024-01-29',7,2,2,'',7,1,'2024-02-01 18:31:34'),
(24,'009/HRGA/I/2024','SK - Bangun Sutopo','2024-01-29',7,2,2,'',7,1,'2024-02-01 18:32:30'),
(25,'010/HRGA/I/2024','SK Magang','2024-01-29',7,2,2,'',7,1,'2024-02-01 18:33:25'),
(26,'011/HRGA/I/2024','SK - Mugi Pramono K3','2024-01-30',7,2,2,'',7,1,'2024-02-01 18:34:08'),
(27,'001/ADADM/I/2024','Reiken','2024-01-02',5,3,3,'',5,1,'2024-02-01 20:28:56'),
(28,'002/ADADM/I/2024','Pengembalian Dana','2024-01-04',5,3,3,'',5,1,'2024-02-01 20:30:16'),
(29,'003/ADADM/I/2024','Surat Tagih Non PPH','2024-01-18',5,3,3,'',5,1,'2024-02-01 20:31:34'),
(30,'004/ADADM/I/2024','Surat Permohonan Pengembalian','2024-01-24',5,3,3,'',5,1,'2024-02-01 20:33:11'),
(31,'005/ADADM/I/2024','Surat Pernyataan Perbedaan','2024-01-30',5,3,3,'',5,1,'2024-02-01 20:33:49'),
(32,'006/ADADM/I/2024','Surat Pernyataan Perbedaan','2024-01-31',5,3,3,'49552.pdf',5,1,'2024-02-05 21:48:57'),
(33,'007/ADADM/II/2024','Surat Pernyataan Perbedaan','2024-02-02',5,3,3,'38102.pdf',5,1,'2024-02-06 01:03:11'),
(34,'012/HRGA/II/2024','SK Magang','2024-02-01',7,2,2,'',7,1,'2024-02-01 20:34:49'),
(35,'016/ADDIR/I/2024','PPSK','2024-01-23',2,1,2,'',2,1,'2024-02-01 20:36:08'),
(36,'017/ADDIR/I/2024','PKWT','2024-01-31',2,1,2,'',2,1,'2024-02-01 20:36:23'),
(37,'007/ADADM/II/2024','Surat Pernyataan Perbedaan Masa Invoice, Surat Jalan, dengan Faktur Pajak','2024-02-05',4,3,4,'Surat Keterangan Perbedaan Tanggal Invoice dan Faktur Pajak - CNC.pdf',4,1,'2024-02-08 14:02:54'),
(38,'008/ADADM/II/2024','Surat Pernyataan Perbedaan Invoice & Faktur Pajak - Indonesia Tooling Technology','2024-02-05',4,3,4,'Surat Pernyataan Perbedaan Invoice & Faktur Pajak - PT. Indonesia Tooling Technology.pdf',4,1,'2024-02-08 14:07:08'),
(39,'001/ADDMKT/II/2024','Surat Pemberitahuan Libur','2024-02-07',12,6,6,NULL,12,1,'2024-02-08 13:29:01'),
(40,'013/HRGA/II/2024','SURAT PERSETUJUAN LINGKUNGAN PPH21 SIDOARJO','2024-02-13',7,2,2,'Permohonan Arahan Persetujuan Lingkungan.pdf',7,1,'2024-02-13 03:03:05'),
(41,'014/HRGA/II/2024','Payroll Feb\'24','2024-02-16',2,2,2,NULL,2,1,'2024-02-16 05:57:16'),
(42,'002/ADDMKT/II/2024','Surat Pemberitahuan Sosialisasi Pemilihan Material di FIM','2024-02-26',15,6,6,'Surat Pemberitahuan Sosialisasi Material di FIM.pdf',15,1,'2024-02-26 02:26:35'),
(43,'015/HRGA/II/2024','Surat Keterangan Kerja & Rekomendasi Pelatihan PLB3 - Faaiz','2024-02-28',7,2,2,'Surat Keterangan Bekerja dan Rekomendasi Training PLB3 - Faaiz.pdf',7,1,'2024-02-28 05:29:09'),
(44,'016/HRGA/II/2024','Surat Keterangan Kerja & Rekomendasi Pelatihan OPLB3 - Gunawan','2024-02-28',7,2,2,'Surat Keterangan Bekerja dan Rekomendasi Training OPLB3 - Gunawan.pdf',7,1,'2024-02-28 05:29:26'),
(45,'017/HRGA/III/2024','Permohonan Arahan Rintek Penyimpanan LB3 cabang Sidoarjo','2024-03-04',7,2,2,NULL,7,1,'2024-03-04 09:13:50'),
(46,'018/ADDIR/III/2024','PKWTT','2024-03-08',2,1,2,NULL,2,1,'2024-03-08 00:34:36'),
(47,'019/ADDIR/III/2024','PPSK','2024-03-08',2,1,2,NULL,2,1,'2024-03-08 00:46:21'),
(48,'018/HRGA/III/2024','SP2','2024-03-08',2,2,2,NULL,2,1,'2024-03-08 01:30:48'),
(49,'010/ADADM/V/2024','sadasfasasf','2024-05-16',1,3,1,NULL,1,1,'2024-05-10 07:12:52'),
(50,'011/ADADM/V/2024','ascsacs','2024-05-14',1,3,1,NULL,1,1,'2024-05-10 07:13:17'),
(51,'001/ADFIN/V/2024','ascascsacs','2024-05-17',1,4,1,NULL,1,1,'2024-05-10 07:13:27'),
(52,'001/ADDIR/V/2024','sacxascsasa','2024-05-20',1,5,1,NULL,1,1,'2024-05-10 07:13:43'),
(53,'003/ADDMKT/V/2024','sacacscas','2024-05-15',1,6,1,NULL,1,1,'2024-05-10 07:13:53'),
(54,'012/ADADM/V/2024','/lkjlkmlkml','2024-05-22',1,3,1,NULL,1,1,'2024-05-11 16:06:07'),
(55,'002/ADFIN/V/2024','dasdasd','2024-05-23',1,4,1,NULL,1,1,'2024-05-11 16:10:11');

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`pass`,`role_id`,`name`,`npk`,`email`,`no_tlp`,`foto`,`status`,`is_active`,`update_by`,`last_update`) values 
(1,'Superadmin','$2y$12$0cV0/5Fy7gCIxK1T5iZ8penMy.0HPoFzdIeRbdhdI/Ez7yP.W2Y86','Super123',1,'Superadmin','5661','-',NULL,'74648.jpg',1,1,1,'2024-04-30 11:46:35'),
(2,'Jessica','$2y$12$E.VaKgMUJHmTFOStJ9uUE.QCAZHYVoyzaKgV2igW2Uf4C0e7wEg8C','adasi',16,'Jessica','5584','astra-daido.co.id',NULL,'default.jpg',0,1,1,'2024-04-30 11:46:39'),
(3,'test','$2y$12$ztOPiTcW3E6gwetVtzojseB1VaageRmAg9vVu5gUpy6f4MM050O1u','123456',1,'tes 123','','astra-daido.co.id',NULL,'10569.png',0,0,1,'2024-04-30 11:46:39'),
(4,'Richardus','$2y$12$39nAmxHJlPYiOOMd6cy28e6EsKZAodJxLiHNVozPRxsmYn5DWc6YO','123',11,'Richardus','5660','astra-daido.co.id',NULL,'default.jpg',0,1,1,'2024-04-30 11:46:52'),
(5,'Dinar','$2y$12$eq0ue0QZIKTXxsCdvrN/DeNUGt6cDU/Ph1UbgocVwFg00z9dtKiIe','123',22,'Dinar','5648','astra-daido.co.id',NULL,'default.jpg',0,1,1,'2024-04-30 11:46:51'),
(6,'Direktur','$2y$12$oK14uvPa/h6r.DGdcfYoo.ru3ux1uRmOLbuPCZSZAuBVkrqE9WoY2','123',5,'Direktur','0','astra-daido.co.id',NULL,'default.jpg',NULL,1,1,'2024-04-30 11:46:51'),
(7,'Ulfa','$2y$12$ZxET1etoPSi8Hf1cAe3Ppuew40oaO.qKxsaQL8qbZPr50bd.Mc.wq','123',21,'Ulfa','5657','astra-daido.co.id',NULL,'default.jpg',NULL,1,1,'2024-04-30 11:46:51'),
(8,'Hardi','$2y$12$8Iv.ebZ6lR4a23N8UPVNMeZqaOsGWtZKxEe/N71WfSJ8mmz1ypZLS','123',7,'Hardi','5424','astra-daido.co.id',NULL,'default.jpg',NULL,1,1,'2024-04-30 11:46:51'),
(9,'Ridho','$2y$12$4dsjDbznrM4C.v.Z8LYEr.owJKCNZiOTea6rm6GsbVj3tyoSfzF3W','123',14,'Ridho','','astra-daido.co.id',NULL,'default.jpg',NULL,1,1,'2024-04-30 11:45:51'),
(10,'Ilham','$2y$12$WJO8XID7MR.QpGsGxWguZOQi58VQiWcdieG4OeAX9lUd9GLT7iVaa','123',17,'Ilham','5530\r\n','-',NULL,'default.jpg',NULL,1,1,'2024-04-30 11:46:41'),
(11,'Hery','$2y$12$XRS169m9.BMyc8hyJIPwAuALg7.q5LQknguVwN70bKMfPBD6ccOSO','123',17,'Hery','','astra-daido.co.id',NULL,'default.jpg',NULL,1,1,'2024-04-30 11:46:42'),
(12,'Herliana','$2y$12$fU12mzv.AtcVjNBWKb42OuyBjtOmmASF5lqciz3xx4vq3nOd/BeMa','123',17,'Herliana','','astra-daido.co.id',NULL,'default.jpg',NULL,1,1,'2024-04-30 11:46:42'),
(13,'Claudia','$2y$12$inI0yf5V/pEthJQ5MBS6MO5tmP.QUYyeQ3e2rkre/3ha/43YRYWJG','123',17,'Claudia','','astra-daido.co.id',NULL,'default.jpg',NULL,1,1,'2024-04-30 11:46:42'),
(14,'Putri','$2y$12$sHbYwkOhVI2Ufzxp20lMr.7P9ilb3u5OEkvq4NO5s5pyVu/6OSYIC','123',17,'Putri','','v',NULL,'default.jpg',NULL,1,1,'2024-04-30 11:46:42'),
(15,'Erik','$2y$12$QbgUKDag20vZCcVgWiPXiO9QnSwfjzqqGXw51LrGcX9xIqSWK2Ue.','123',17,'Erik','5653','-',NULL,'default.jpg',NULL,1,1,'2024-04-30 11:46:43'),
(16,'Hexapa','$2y$12$N/h/fuCxGpELA8Y8WwcOf.n9/MnnnOMvdOiJWzzZRL7/PhDrbb/di','123',17,'Hexapa','5658\r\n','-',NULL,'default.jpg',NULL,1,1,'2024-04-30 11:46:44'),
(17,'Dania','$2y$12$o9G42PAdffdqdbnCifirG.AO.S.oxjWA3i.670n8UelkD/EDtFko2','123',17,'Dania','','astra-daido.co.id',NULL,'default.jpg',NULL,1,1,'2024-04-30 11:46:44'),
(18,'Jun','$2y$12$a.GvVwcUG4lXoIX00N4WheAibdM2OScg8RtBf6tN4MgTeK8Sge8Gi','123',17,'Jun','','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:45:57'),
(19,'Wulyo','$2y$12$WdhI8y7DUllXO3PLmCTEyu6HwmDzb3dTJUzrL166ujdQmeawnnzbq','123',17,'Wulyo','','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:45:58'),
(20,'Sendi','$2y$12$q5zNNafpuzwdqreQ/X6e9uAsH860kLql6X0R4BJ6xsaL1Cid6Xyy6','123',17,'Sendi','','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:45:58'),
(21,'Welem','$2y$12$KijH2iRzIlFBDlNcK8uWm.icZ2H0Hpy.yVMz0lq2223JNP.FIuO0O','123',17,'Welem','','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:45:58'),
(22,'Totok','$2y$12$bZcNA6KorE4jcKRUfKyM3uRVbobOBCAkO5Cw1GdPtGW1/I2vFnILe','123',17,'Totok','','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:45:58'),
(23,'Dwi','$2y$12$OivzGDWlENcws2UJuxZuC.gMAaRzYjgV/WrLYh/lUzbaC5EaS07sm','123',17,'Dwi','','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:45:59'),
(24,'Risfan','$2y$12$hWMOiZTNsD.sxs7bwfMs5u4zyOBd/PDhu4HZ/esK3U1nxkkTUHYZu','123',17,'Risfan','','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:45:59'),
(25,'Harry','$2y$12$YdqaKjbanQv8riUfKu432useuIwHKwBjWyYnkQ/tLKtqgPP4n4cue','123',17,'Harry','','astra-daido.co.id','-','35088.jpg',NULL,1,1,'2024-04-30 11:46:01'),
(26,'Lina','$2y$12$OJ8kwvfypGKCrdrC8LEfkO3JZJjiTUu1E6XDUEySb7z6GbVIKDN7a','123',17,'Lina','','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:45:59'),
(27,'Cahyo','$2y$12$M1yQPhrRS7E5e4aSmmlIKeViHL6EuZt/DREi9Xy1VlwlUBioyrk1q','123',8,'Cahyo','5635\r\n','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:47:02'),
(28,'Adhi','$2y$12$aSkI8F4B/ROuHA1oWrHFGOWhR/eM2Pu3bZv1xHhR9OkIz58KkBGqK','123',11,'Adhi','5519\r\n','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:47:02'),
(29,'Sarah','$2y$12$GrPySfDuTb5Say4UhP.oj.3J16D7qTd8QOik/3EBsQwhy3Xl9tJN.','123',17,'Sarah','','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:46:00'),
(30,'Sony','$2y$12$qUTwwKPvi2vWiCbuvUr8nOF/OrupY4oupLMMjjppsbE4Ltwu0NBHq','123',17,'Sony','5391\r\n','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:47:01'),
(31,'Dimas','$2y$12$vGb7M6CNt22Mk/ulV3Wc7.B.UwrUWxqh5BpLrxRCvmNqUuGW8kvV6','123',17,'Dimas','','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:46:06'),
(32,'Gunawan','$2y$12$mLX4HWsusgUMeHqT30PPHOuOCl4pGTTZ0BvXwsyvTEAHjkT399W4e','Gunawan',17,'Gunawan','5421','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:47:01'),
(33,'Security','$2y$12$2BiUW5OXR7OKyeYbQ9DTweklxd/VtuvX4EylgIjvbKPrqJ2gv/0.2','Security',24,'Security DS8','-','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:46:06'),
(34,'Rangga','$2y$12$rLwaGvod6kJVYLOEesb7w.ajVEdYU/9vWgG9lIJsXwq95Q/DEDAgu','Rangga',14,'Rangga','5605','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:47:00'),
(35,'Faiz','$2y$12$2sYKViEce6HF0y0YO.IAc.piQTXFsLEzos2vQr2/x6UwdSx8yvQqq','Faiz',15,'Faiz','5520','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:47:00'),
(36,'Ragil','$2y$12$BBUQ/uIFH.QNxXdWumsjR.mw2jJQb/MtPJHZzhrEwfgbEiH3ovEqO','Rafil',19,'Ragil','5639','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:46:58'),
(37,'Mugi','$2y$12$oWWnt1b6Ws1.hv.7Q1PFJOphISkC4ERS0dA4osi8lP9yrmaprS7tG','Mugi',12,'Mugi','5649','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:46:58'),
(38,'Komang','$2y$12$8gZr572ff1evLNAx4T8Mh.MKTBvf/qQfmwE9z2yFJS/7/VBp9EZhu','Komang',12,'Komang','-','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:46:05'),
(39,'Vitri','$2y$12$ykkrJUpqC/FeiBkFUfSgkOmu0jAmMXFIJvVGnFXG1VQu.hyYMKbVG','Vitri',9,'Vitri','5632','astra-daido.co.id','-','default.jpg',NULL,1,1,'2024-04-30 11:46:57');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
