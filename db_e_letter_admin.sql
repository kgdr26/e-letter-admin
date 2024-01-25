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

/*Table structure for table `mst_role` */

DROP TABLE IF EXISTS `mst_role`;

CREATE TABLE `mst_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `mst_role` */

insert  into `mst_role`(`id`,`name`,`is_active`,`update_by`,`last_update`) values 
(1,'DIREKSI',1,1,'2024-01-26 02:10:28'),
(2,'HR',1,1,'2024-01-26 02:10:40'),
(3,'ADMINISTRASI',1,1,'2024-01-26 02:10:54');

/*Table structure for table `trx_surat` */

DROP TABLE IF EXISTS `trx_surat`;

CREATE TABLE `trx_surat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letter_admin` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `date_release` timestamp NULL DEFAULT NULL,
  `employe` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_surat` */

insert  into `trx_surat`(`id`,`letter_admin`,`notes`,`date_release`,`employe`,`role_id`,`update_by`,`is_active`,`last_update`) values 
(1,'001/HRGA/I/2024','Dokumen PS','2024-01-26 02:31:03',1,1,1,1,'2024-01-26 03:09:59'),
(2,'002/HRGA/I/2024','dfsdfadfasf','2024-01-01 00:00:00',1,1,1,1,'2024-01-26 03:10:00'),
(3,'003/ADDIR/I/2024','dadsfadsfasdfds','2024-01-24 00:00:00',1,1,1,1,'2024-01-26 03:10:00'),
(4,'004/ADDIR/I/2024','erserergerger','2024-01-18 00:00:00',1,1,1,1,'2024-01-26 03:10:01'),
(5,'005/ADDIR/I/2024','dfasdfsd','2024-01-30 00:00:00',1,1,1,1,'2024-01-26 03:10:03'),
(6,'006/ADDIR/I/2024','sdfsdasfdassa','2024-01-25 00:00:00',1,1,1,0,'2024-01-26 03:10:49');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_tlp` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`pass`,`role_id`,`name`,`email`,`no_tlp`,`foto`,`status`,`is_active`,`update_by`,`last_update`) values 
(1,'kgdr','$2y$10$c3W.UkaWWfqg53Xl7esRT.RckZLC/r2vREKedHl/GroQMIJb2WBvO','1',1,'Kang Dru','kgdr@gmail.com','081211159962','default.jpg',1,1,1,'2024-01-21 18:07:55'),
(2,'medi','$2y$10$bMwpEXewYPlWeSQIJZxsWOUH6EEtgUPL.iC566XdepOemCAPUO2dO','1',2,'Medi123','medi@gmail.com','0888877772','default.jpg',0,1,1,'2024-01-21 16:52:39'),
(3,'tes','$2y$12$ztOPiTcW3E6gwetVtzojseB1VaageRmAg9vVu5gUpy6f4MM050O1u','123456',3,'tes 123','tes@gmailo.com','88888','10569.png',0,0,1,'2024-01-26 02:12:03');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
