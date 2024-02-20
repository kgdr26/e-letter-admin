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
  `status` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `mst_asset` */

insert  into `mst_asset`(`id`,`no_assets`,`name`,`status`,`update_by`,`is_active`,`last_update`) values 
(1,'B 123 XYZ','Avanza Veloz',0,1,1,'2024-02-10 16:02:45'),
(2,'B 321 XYZ','Avanza Veloz',0,1,1,'2024-02-10 16:02:49'),
(3,'R 0001','Room Floor 1st',0,1,1,'2024-02-13 22:31:21');

/*Table structure for table `mst_role` */

DROP TABLE IF EXISTS `mst_role`;

CREATE TABLE `mst_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `mst_role` */

insert  into `mst_role`(`id`,`name`,`is_active`,`update_by`,`last_update`) values 
(1,'DIREKSI',1,1,'2024-01-25 19:10:28'),
(2,'HR',1,1,'2024-01-25 19:10:40'),
(3,'ADMINISTRASI',1,1,'2024-01-25 19:10:54'),
(4,'FINANCE',1,1,'2024-01-26 01:54:28'),
(5,'SUPERADMIN',1,1,'2024-01-28 12:27:28'),
(6,'MARKETING',1,1,'2024-01-31 02:06:21'),
(7,'SP MARKETING',1,1,'2024-02-04 19:22:48');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_assets_landing` */

insert  into `trx_assets_landing`(`id`,`id_user`,`id_dephed`,`id_first`,`id_second`,`id_director`,`date_start`,`date_end`,`data_asset`,`necessity`,`status`,`last_update`) values 
(1,1,1,1,1,1,'2024-02-14 08:00:21','2024-02-14 23:15:34',1,'Tesss iput',5,'2024-02-18 10:44:20'),
(2,1,NULL,NULL,NULL,NULL,'2024-02-15 09:00:39','2024-02-24 23:15:50',1,'tes',1,'2024-02-18 11:38:15'),
(3,1,NULL,NULL,NULL,NULL,'2024-02-16 23:03:33','2024-02-17 23:03:36',1,'tessss',1,'2024-02-13 23:19:01');

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
(1,'001/ADDIR/I/2024','Surat Kiriman','2024-01-01',2,1,2,'unta-di-depan-masjid.pdf',2,1,'2024-02-08 19:54:43'),
(2,'002/ADDIR/I/2024','PPSK','2024-01-01',2,1,2,NULL,2,1,'2024-02-02 01:14:37'),
(3,'003/ADDIR/I/2024','PPSK','2024-01-01',2,1,2,NULL,2,1,'2024-02-02 01:14:55'),
(4,'004/ADDIR/I/2024','SKPK MR','2024-01-01',2,1,2,NULL,2,1,'2024-02-02 01:15:09'),
(5,'005/ADDIR/I/2024','SKPK Security','2024-01-01',2,1,2,NULL,2,1,'2024-02-02 01:15:23'),
(6,'006/ADDIR/I/2024','PKWT','2024-01-01',2,1,2,NULL,2,1,'2024-02-02 01:15:36'),
(7,'007/ADDIR/I/2024','SKPKT','2024-01-01',2,1,2,NULL,2,1,'2024-02-02 01:16:12'),
(8,'008/ADDIR/I/2024','ITAS EB','2024-01-01',2,1,2,NULL,2,1,'2024-02-02 01:16:25'),
(9,'009/ADDIR/I/2024','PKWT','2024-01-01',2,1,2,NULL,2,1,'2024-02-02 01:16:48'),
(10,'010/ADDIR/I/2024','SK Tunj','2024-01-16',2,1,2,NULL,2,1,'2024-02-02 01:17:15'),
(11,'011/ADDIR/I/2024','SK Tunj','2024-01-16',2,1,2,NULL,2,1,'2024-02-02 01:17:48'),
(12,'012/ADDIR/I/2024','SK Core Value','2024-01-21',2,1,2,NULL,2,1,'2024-02-02 01:18:29'),
(13,'013/ADDIR/I/2024','SK Neop','2024-01-21',2,1,2,NULL,2,1,'2024-02-02 01:21:34'),
(14,'014/ADDIR/I/2024','PKWT','2024-01-21',2,1,2,NULL,2,1,'2024-02-02 01:21:45'),
(15,'015/ADDIR/I/2024','Payroll','2024-01-22',2,1,2,NULL,2,1,'2024-02-02 01:21:55'),
(16,'001/HRGA/I/2024','Pengantar MCU SE','2024-01-03',7,2,2,NULL,7,1,'2024-02-02 01:27:40'),
(17,'002/HRGA/I/2024','SK Magang Clerisela','2024-01-07',7,2,2,NULL,7,1,'2024-02-02 01:28:33'),
(18,'003/HRGA/I/2024','SK Permohonan Pak Sapto','2024-01-10',7,2,2,NULL,7,1,'2024-02-02 01:29:01'),
(19,'004/HRGA/I/2024','Pemberitahuan Tetangga (Simulasi)','2024-01-13',7,2,2,NULL,7,1,'2024-02-02 01:29:37'),
(20,'005/HRGA/I/2024','Pemberitahuan Tetangga (Simulasi)','2024-01-13',7,2,2,NULL,7,1,'2024-02-02 01:29:48'),
(21,'006/HRGA/I/2024','SK Erik','2024-01-24',7,2,2,NULL,7,1,'2024-02-02 01:30:05'),
(22,'007/HRGA/I/2024','Pengantar MCU','2024-01-25',7,2,2,NULL,7,1,'2024-02-02 01:30:27'),
(23,'008/HRGA/I/2024','Training','2024-01-28',7,2,2,NULL,7,1,'2024-02-02 01:31:34'),
(24,'009/HRGA/I/2024','SK - Bangun Sutopo','2024-01-28',7,2,2,NULL,7,1,'2024-02-02 01:32:30'),
(25,'010/HRGA/I/2024','SK Magang','2024-01-28',7,2,2,NULL,7,1,'2024-02-02 01:33:25'),
(26,'011/HRGA/I/2024','SK - Mugi Pramono K3','2024-01-29',7,2,2,NULL,7,1,'2024-02-02 01:34:08'),
(27,'001/ADADM/I/2024','Reiken','2024-01-01',5,3,3,'16843.pdf',5,1,'2024-02-06 09:53:14'),
(28,'002/ADADM/I/2024','Pengembalian Dana','2024-01-03',5,3,3,NULL,5,1,'2024-02-02 03:30:16'),
(29,'003/ADADM/I/2024','Surat Tagih Non PPH','2024-01-17',5,3,3,NULL,5,1,'2024-02-02 03:31:34'),
(30,'004/ADADM/I/2024','Surat Permohonan Pengembalian','2024-01-23',5,3,3,NULL,5,1,'2024-02-02 03:33:11'),
(31,'005/ADADM/I/2024','Surat Pernyataan Perbedaan','2024-01-29',5,3,3,NULL,5,1,'2024-02-02 03:33:49'),
(32,'006/ADADM/I/2024','Surat Pernyataan Perbedaan','2024-01-30',5,3,3,NULL,5,1,'2024-02-02 03:33:39'),
(33,'007/ADADM/II/2024','Surat Pernyataan Perbedaan','2024-02-01',5,3,3,NULL,5,1,'2024-02-02 03:33:59'),
(34,'012/HRGA/II/2024','SK Magang','2024-01-31',7,2,2,NULL,7,1,'2024-02-02 03:34:49'),
(35,'016/ADDIR/I/2024','PPSK','2024-01-22',2,1,2,NULL,2,1,'2024-02-02 03:36:08'),
(36,'017/ADDIR/I/2024','PKWT','2024-01-30',2,1,2,NULL,2,1,'2024-02-02 03:36:23'),
(37,'001/ADDMKT/III/2024','-','2024-03-13',8,6,7,NULL,8,1,'2024-02-04 19:39:09'),
(38,'002/ADDMKT/II/2024','dedw','2024-02-08',8,6,7,NULL,8,1,'2024-02-04 19:45:52'),
(39,'018/ADDIR/II/2024','dsdsd','2024-02-07',1,1,5,NULL,1,1,'2024-02-06 15:28:24');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`pass`,`role_id`,`name`,`npk`,`email`,`no_tlp`,`foto`,`status`,`is_active`,`update_by`,`last_update`) values 
(1,'superadmin','$2y$12$FnK4ACd8SljPJlusUlAIsOQtatwq1GcXBaB91Gon3FwYplQwcM286','123',5,'Superadmin','1123456','-','-','19737.jpg',1,1,1,'2024-02-10 15:20:08'),
(2,'jessica','$2y$12$acttIZrFxuspedt6zEru4uhYHCkMPme/2jGzoaJSlfA8U0rsoJmcO','123',2,'Jessica',NULL,'jessica@gmail.com','0888877772','default.jpg',0,1,1,'2024-01-26 01:12:39'),
(3,'tes','$2y$12$ztOPiTcW3E6gwetVtzojseB1VaageRmAg9vVu5gUpy6f4MM050O1u','123456',3,'tes 123',NULL,'tes@gmailo.com','88888','10569.png',0,0,1,'2024-01-25 19:12:03'),
(4,'Richardus','$2y$12$39nAmxHJlPYiOOMd6cy28e6EsKZAodJxLiHNVozPRxsmYn5DWc6YO','123',4,'Richardus',NULL,NULL,NULL,'default.jpg',0,1,1,'2024-01-31 09:45:44'),
(5,'Dinar','$2y$12$eq0ue0QZIKTXxsCdvrN/DeNUGt6cDU/Ph1UbgocVwFg00z9dtKiIe','123',3,'Dinar',NULL,NULL,NULL,'default.jpg',0,1,1,'2024-01-31 09:45:21'),
(6,'Direktur','$2y$12$oK14uvPa/h6r.DGdcfYoo.ru3ux1uRmOLbuPCZSZAuBVkrqE9WoY2','123',1,'Direktur',NULL,NULL,NULL,'default.jpg',NULL,1,1,'2024-01-31 09:45:12'),
(7,'Ulfa','$2y$12$ZxET1etoPSi8Hf1cAe3Ppuew40oaO.qKxsaQL8qbZPr50bd.Mc.wq','123',2,'Ulfa',NULL,NULL,NULL,'default.jpg',NULL,1,1,'2024-01-31 09:43:11'),
(8,'Hardi','$2y$12$PNbx2VHdxRbxoouZUPSL5e5v0gbFY2o.QXIf5F6/KobXY2aBe541C','123',7,'Hardi',NULL,'-','0812','45964.jpg',NULL,1,1,'2024-02-04 20:16:12'),
(9,'Ridho','$2y$12$4dsjDbznrM4C.v.Z8LYEr.owJKCNZiOTea6rm6GsbVj3tyoSfzF3W','123',6,'Ridho',NULL,NULL,NULL,'default.jpg',NULL,1,1,'2024-02-04 19:18:56');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
