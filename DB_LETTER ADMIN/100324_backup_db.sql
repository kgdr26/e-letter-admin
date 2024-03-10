/*
SQLyog Community v13.2.0 (64 bit)
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
  `kategori` varchar(255) DEFAULT NULL,
  `kepemilikan` varchar(255) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `mst_asset` */

insert  into `mst_asset`(`id`,`no_assets`,`name`,`merk`,`tahun`,`status`,`lokasi`,`kategori`,`kepemilikan`,`update_by`,`is_active`,`last_update`) values 
(1,'B 1064 FYU','Kijang Innova V','Inova','2013',0,'Delta Silicon 8','Mobil','ADASI',1,1,'2024-02-22 16:11:17'),
(2,'B 1231 FYV','F600RV-GMDF33','Xenia','2009',0,'Deltamas','Mobil','ADASI',1,1,'2024-02-22 16:11:27'),
(3,'B 1161 FLT','Fortuner 2.5 G M/T','Fortuner','2015',0,'Delta Silicon 8','Mobil','ADASI',1,1,'2024-02-22 11:17:49'),
(4,'B 1187 FYY','S4Q1RV-ZMDEJJ HJ','Grandmax','2013',0,'Delta Silicon 8','Mobil','ADASI',1,1,'2024-02-22 16:11:31'),
(5,'Room Meeting 1st','Room Meeting 1st','RM-1st',NULL,0,NULL,'Ruangan',NULL,1,1,'2024-02-24 13:43:28'),
(6,'Room Meeting 2st','Room Meeting 2st','RM-2st',NULL,0,NULL,'Ruangan',NULL,1,1,'2024-02-24 13:43:33');

/*Table structure for table `mst_role` */

DROP TABLE IF EXISTS `mst_role`;

CREATE TABLE `mst_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `mst_role` */

insert  into `mst_role`(`id`,`name`,`is_active`,`update_by`,`last_update`) values 
(1,'SUPERADMIN',1,1,'2024-03-10 13:05:58'),
(2,'HR',1,1,'2024-01-25 19:10:40'),
(3,'ADMINISTRASI',1,1,'2024-01-25 19:10:54'),
(4,'FINANCE',1,1,'2024-01-26 01:54:28'),
(5,'DIREKSI',1,1,'2024-03-10 13:06:05'),
(6,'MARKETING',1,1,'2024-01-31 02:06:21'),
(7,'SP MARKETING',1,1,'2024-02-04 19:30:37'),
(8,'SECURITY',1,1,'2024-02-24 14:15:55'),
(9,'GENERAL AFFAIR',1,1,'2024-03-10 12:37:04');

/*Table structure for table `trx_assets_landing` */

DROP TABLE IF EXISTS `trx_assets_landing`;

CREATE TABLE `trx_assets_landing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_dephed` int(11) DEFAULT NULL,
  `id_first` int(11) DEFAULT NULL,
  `id_second` int(11) DEFAULT NULL,
  `id_director` int(11) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `data_asset` int(11) DEFAULT NULL,
  `necessity` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_assets_landing` */

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_chceksheet_asset` */

insert  into `trx_chceksheet_asset`(`id`,`id_user`,`id_asset`,`type`,`tanggal`,`keterangan`) values 
(1,1,1,1,'2024-03-20',NULL),
(2,1,2,2,'2024-03-20','Tesssss'),
(3,1,3,1,'2024-03-29',NULL),
(4,1,2,2,'2024-03-07','Ganti Oli\nGanti Mobil'),
(5,1,1,1,'2024-03-15',NULL);

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
(1,'Tes',1,1,'2024-03-10 20:31:50'),
(2,'Document Control',1,1,'2024-03-10 20:44:48');

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_surat` */

insert  into `trx_surat`(`id`,`letter_admin`,`notes`,`date_release`,`employe`,`to_dept`,`role_id`,`name_file`,`update_by`,`is_active`,`last_update`) values 
(1,'001/ADDIR/I/2024','Surat Kiriman','2024-01-02',2,1,2,'49627.pdf',2,1,'2024-02-07 01:54:24'),
(2,'002/ADDIR/I/2024','PPSK','2024-01-02',2,1,2,'',2,1,'2024-02-02 01:14:37'),
(3,'003/ADDIR/I/2024','PPSK','2024-01-02',2,1,2,'',2,1,'2024-02-02 01:14:55'),
(4,'004/ADDIR/I/2024','SKPK MR','2024-01-02',2,1,2,'',2,1,'2024-02-02 01:15:09'),
(5,'005/ADDIR/I/2024','SKPK Security','2024-01-02',2,1,2,'',2,1,'2024-02-02 01:15:23'),
(6,'006/ADDIR/I/2024','PKWT','2024-01-02',2,1,2,'',2,1,'2024-02-02 01:15:36'),
(7,'007/ADDIR/I/2024','SKPKT','2024-01-02',2,1,2,'',2,1,'2024-02-02 01:16:12'),
(8,'008/ADDIR/I/2024','ITAS EB','2024-01-02',2,1,2,'63218.pdf',2,1,'2024-02-06 08:30:59'),
(9,'009/ADDIR/I/2024','PKWT','2024-01-02',2,1,2,'',2,1,'2024-02-02 01:16:48'),
(10,'010/ADDIR/I/2024','SK Tunj','2024-01-17',2,1,2,'',2,1,'2024-02-02 01:17:15'),
(11,'011/ADDIR/I/2024','SK Tunj','2024-01-17',2,1,2,'',2,1,'2024-02-02 01:17:48'),
(12,'012/ADDIR/I/2024','SK Core Value','2024-01-22',2,1,2,'',2,1,'2024-02-02 01:18:29'),
(13,'013/ADDIR/I/2024','SK Neop','2024-01-22',2,1,2,'',2,1,'2024-02-02 01:21:34'),
(14,'014/ADDIR/I/2024','PKWT','2024-01-22',2,1,2,'',2,1,'2024-02-02 01:21:45'),
(15,'015/ADDIR/I/2024','Payroll','2024-01-23',2,1,2,'',2,1,'2024-02-02 01:21:55'),
(16,'001/HRGA/I/2024','Pengantar MCU SE','2024-01-04',7,2,2,'',7,1,'2024-02-02 01:27:40'),
(17,'002/HRGA/I/2024','SK Magang Clerisela','2024-01-08',7,2,2,'',7,1,'2024-02-02 01:28:33'),
(18,'003/HRGA/I/2024','SK Permohonan Pak Sapto','2024-01-11',7,2,2,'',7,1,'2024-02-02 01:29:01'),
(19,'004/HRGA/I/2024','Pemberitahuan Tetangga (Simulasi)','2024-01-14',7,2,2,'',7,1,'2024-02-02 01:29:37'),
(20,'005/HRGA/I/2024','Pemberitahuan Tetangga (Simulasi)','2024-01-14',7,2,2,'',7,1,'2024-02-02 01:29:48'),
(21,'006/HRGA/I/2024','SK Erik','2024-01-25',7,2,2,'',7,1,'2024-02-02 01:30:05'),
(22,'007/HRGA/I/2024','Pengantar MCU','2024-01-26',7,2,2,'',7,1,'2024-02-02 01:30:27'),
(23,'008/HRGA/I/2024','Training','2024-01-29',7,2,2,'',7,1,'2024-02-02 01:31:34'),
(24,'009/HRGA/I/2024','SK - Bangun Sutopo','2024-01-29',7,2,2,'',7,1,'2024-02-02 01:32:30'),
(25,'010/HRGA/I/2024','SK Magang','2024-01-29',7,2,2,'',7,1,'2024-02-02 01:33:25'),
(26,'011/HRGA/I/2024','SK - Mugi Pramono K3','2024-01-30',7,2,2,'',7,1,'2024-02-02 01:34:08'),
(27,'001/ADADM/I/2024','Reiken','2024-01-02',5,3,3,'',5,1,'2024-02-02 03:28:56'),
(28,'002/ADADM/I/2024','Pengembalian Dana','2024-01-04',5,3,3,'',5,1,'2024-02-02 03:30:16'),
(29,'003/ADADM/I/2024','Surat Tagih Non PPH','2024-01-18',5,3,3,'',5,1,'2024-02-02 03:31:34'),
(30,'004/ADADM/I/2024','Surat Permohonan Pengembalian','2024-01-24',5,3,3,'',5,1,'2024-02-02 03:33:11'),
(31,'005/ADADM/I/2024','Surat Pernyataan Perbedaan','2024-01-30',5,3,3,'',5,1,'2024-02-02 03:33:49'),
(32,'006/ADADM/I/2024','Surat Pernyataan Perbedaan','2024-01-31',5,3,3,'49552.pdf',5,1,'2024-02-06 04:48:57'),
(33,'007/ADADM/II/2024','Surat Pernyataan Perbedaan','2024-02-02',5,3,3,'38102.pdf',5,1,'2024-02-06 08:03:11'),
(34,'012/HRGA/II/2024','SK Magang','2024-02-01',7,2,2,'',7,1,'2024-02-02 03:34:49'),
(35,'016/ADDIR/I/2024','PPSK','2024-01-23',2,1,2,'',2,1,'2024-02-02 03:36:08'),
(36,'017/ADDIR/I/2024','PKWT','2024-01-31',2,1,2,'',2,1,'2024-02-02 03:36:23'),
(37,'007/ADADM/II/2024','Surat Pernyataan Perbedaan Masa Invoice, Surat Jalan, dengan Faktur Pajak','2024-02-05',4,3,4,'Surat Keterangan Perbedaan Tanggal Invoice dan Faktur Pajak - CNC.pdf',4,1,'2024-02-08 21:02:54'),
(38,'008/ADADM/II/2024','Surat Pernyataan Perbedaan Invoice & Faktur Pajak - Indonesia Tooling Technology','2024-02-05',4,3,4,'',4,1,'2024-02-08 21:03:02'),
(39,'001/ADDMKT/II/2024','Surat Pemberitahuan Libur','2024-02-07',12,6,6,NULL,12,1,'2024-02-08 20:29:01');

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`pass`,`role_id`,`name`,`npk`,`email`,`no_tlp`,`foto`,`status`,`is_active`,`update_by`,`last_update`) values 
(1,'superadmin','$2y$12$mdUvzV.ofxf4mHuwj5apBOOj1A3v5m/MGXkdjiE54yVrJtn4io6MK','123',5,'Superadmin','5661','-','-','171.jpg',1,1,1,'2024-02-20 08:44:31'),
(2,'jessica','$2y$12$UDGQXLiA9NtKCV1ETd4ume8.V6IHh2Tg4dPFghRv5MwpCID2abRCG','adasi',2,'Jessica',NULL,'jessica@gmail.com','0888877772','default.jpg',0,1,1,'2024-02-07 14:53:45'),
(3,'tes','$2y$12$ztOPiTcW3E6gwetVtzojseB1VaageRmAg9vVu5gUpy6f4MM050O1u','123456',3,'tes 123',NULL,'tes@gmailo.com','88888','10569.png',0,0,1,'2024-01-25 12:12:03'),
(4,'Richardus','$2y$12$39nAmxHJlPYiOOMd6cy28e6EsKZAodJxLiHNVozPRxsmYn5DWc6YO','123',4,'Richardus',NULL,NULL,NULL,'default.jpg',0,1,1,'2024-01-31 02:45:44'),
(5,'Dinar','$2y$12$eq0ue0QZIKTXxsCdvrN/DeNUGt6cDU/Ph1UbgocVwFg00z9dtKiIe','123',3,'Dinar',NULL,NULL,NULL,'default.jpg',0,1,1,'2024-01-31 02:45:21'),
(6,'Direktur','$2y$12$oK14uvPa/h6r.DGdcfYoo.ru3ux1uRmOLbuPCZSZAuBVkrqE9WoY2','123',1,'Direktur',NULL,NULL,NULL,'default.jpg',NULL,1,1,'2024-01-31 02:45:12'),
(7,'Ulfa','$2y$12$ZxET1etoPSi8Hf1cAe3Ppuew40oaO.qKxsaQL8qbZPr50bd.Mc.wq','123',2,'Ulfa',NULL,NULL,NULL,'default.jpg',NULL,1,1,'2024-01-31 02:43:11'),
(8,'Hardi','$2y$12$8Iv.ebZ6lR4a23N8UPVNMeZqaOsGWtZKxEe/N71WfSJ8mmz1ypZLS','123',7,'Hardi',NULL,NULL,NULL,'default.jpg',NULL,1,1,'2024-02-04 12:59:04'),
(9,'Ridho','$2y$12$4dsjDbznrM4C.v.Z8LYEr.owJKCNZiOTea6rm6GsbVj3tyoSfzF3W','123',6,'Ridho',NULL,NULL,NULL,'default.jpg',NULL,1,1,'2024-02-04 12:18:56'),
(10,'Ilham','$2y$12$WJO8XID7MR.QpGsGxWguZOQi58VQiWcdieG4OeAX9lUd9GLT7iVaa','123',6,'Ilham',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-05 01:17:06'),
(11,'Hery','$2y$12$XRS169m9.BMyc8hyJIPwAuALg7.q5LQknguVwN70bKMfPBD6ccOSO','123',6,'Hery',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-05 01:18:23'),
(12,'Herliana','$2y$12$fU12mzv.AtcVjNBWKb42OuyBjtOmmASF5lqciz3xx4vq3nOd/BeMa','123',6,'Herliana',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-05 01:19:12'),
(13,'Claudia','$2y$12$inI0yf5V/pEthJQ5MBS6MO5tmP.QUYyeQ3e2rkre/3ha/43YRYWJG','123',6,'Claudia',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-05 01:26:08'),
(14,'Putri','$2y$12$sHbYwkOhVI2Ufzxp20lMr.7P9ilb3u5OEkvq4NO5s5pyVu/6OSYIC','123',6,'Putri',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-05 01:26:41'),
(15,'Erik','$2y$12$QbgUKDag20vZCcVgWiPXiO9QnSwfjzqqGXw51LrGcX9xIqSWK2Ue.','123',6,'Erik',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-05 01:33:11'),
(16,'Hexapa','$2y$12$N/h/fuCxGpELA8Y8WwcOf.n9/MnnnOMvdOiJWzzZRL7/PhDrbb/di','123',6,'Hexapa',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-05 01:33:34'),
(17,'Dania','$2y$12$o9G42PAdffdqdbnCifirG.AO.S.oxjWA3i.670n8UelkD/EDtFko2','123',6,'Dania',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-06 05:46:33'),
(18,'Jun','$2y$12$a.GvVwcUG4lXoIX00N4WheAibdM2OScg8RtBf6tN4MgTeK8Sge8Gi','123',6,'Jun',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-06 05:46:50'),
(19,'Wulyo','$2y$12$WdhI8y7DUllXO3PLmCTEyu6HwmDzb3dTJUzrL166ujdQmeawnnzbq','123',6,'Wulyo',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-06 05:47:12'),
(20,'Sendi','$2y$12$q5zNNafpuzwdqreQ/X6e9uAsH860kLql6X0R4BJ6xsaL1Cid6Xyy6','123',6,'Sendi',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-06 05:47:32'),
(21,'Welem','$2y$12$KijH2iRzIlFBDlNcK8uWm.icZ2H0Hpy.yVMz0lq2223JNP.FIuO0O','123',6,'Welem',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-06 05:47:52'),
(22,'Totok','$2y$12$bZcNA6KorE4jcKRUfKyM3uRVbobOBCAkO5Cw1GdPtGW1/I2vFnILe','123',7,'Totok',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-06 05:48:17'),
(23,'Dwi','$2y$12$OivzGDWlENcws2UJuxZuC.gMAaRzYjgV/WrLYh/lUzbaC5EaS07sm','123',6,'Dwi',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-06 05:48:31'),
(24,'Risfan','$2y$12$hWMOiZTNsD.sxs7bwfMs5u4zyOBd/PDhu4HZ/esK3U1nxkkTUHYZu','123',6,'Risfan',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-06 05:48:53'),
(25,'Harry','$2y$12$YdqaKjbanQv8riUfKu432useuIwHKwBjWyYnkQ/tLKtqgPP4n4cue','123',6,'Harry',NULL,'-','-','35088.jpg',NULL,1,1,'2024-02-07 03:17:45'),
(26,'Lina','$2y$12$OJ8kwvfypGKCrdrC8LEfkO3JZJjiTUu1E6XDUEySb7z6GbVIKDN7a','123',6,'Lina',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-06 05:49:25'),
(27,'Cahyo','$2y$12$M1yQPhrRS7E5e4aSmmlIKeViHL6EuZt/DREi9Xy1VlwlUBioyrk1q','123',4,'Cahyo',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-06 05:52:00'),
(28,'Adhi','$2y$12$aSkI8F4B/ROuHA1oWrHFGOWhR/eM2Pu3bZv1xHhR9OkIz58KkBGqK','123',4,'Adhi',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-06 05:52:19'),
(29,'Sarah','$2y$12$GrPySfDuTb5Say4UhP.oj.3J16D7qTd8QOik/3EBsQwhy3Xl9tJN.','123',6,'Sarah',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-08 20:33:45'),
(30,'Sony','$2y$12$qUTwwKPvi2vWiCbuvUr8nOF/OrupY4oupLMMjjppsbE4Ltwu0NBHq','123',6,'Sony',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-08 20:34:44'),
(31,'Dimas','$2y$12$vGb7M6CNt22Mk/ulV3Wc7.B.UwrUWxqh5BpLrxRCvmNqUuGW8kvV6','123',6,'Dimas',NULL,'-','-','default.jpg',NULL,1,1,'2024-02-08 20:35:02'),
(32,'Security','$2y$12$YDIJec4NhNmz5j03ENe6nOG5eUgT1ew9bexuB..TKI9UU2t2eqkPq','Security',8,'Security','0000','-','-','default.jpg',NULL,1,1,'2024-02-24 14:16:44');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
