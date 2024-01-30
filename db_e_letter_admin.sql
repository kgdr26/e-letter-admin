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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `mst_role` */

insert  into `mst_role`(`id`,`name`,`is_active`,`update_by`,`last_update`) values 
(1,'DIREKSI',1,1,'2024-01-26 02:10:28'),
(2,'HR',1,1,'2024-01-26 02:10:40'),
(3,'ADMINISTRASI',1,1,'2024-01-26 02:10:54'),
(4,'FINANCE',1,1,'2024-01-26 08:54:28'),
(5,'SUPERADMIN',1,1,'2024-01-28 19:27:28');

/*Table structure for table `trx_surat` */

DROP TABLE IF EXISTS `trx_surat`;

CREATE TABLE `trx_surat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letter_admin` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `date_release` timestamp NULL DEFAULT NULL,
  `employe` int(11) DEFAULT NULL,
  `to_dept` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_surat` */

insert  into `trx_surat`(`id`,`letter_admin`,`notes`,`date_release`,`employe`,`to_dept`,`role_id`,`update_by`,`is_active`,`last_update`) values 
(1,'001/ADDIR/I/2024','Data-Test','2024-01-27 00:00:00',1,1,1,1,1,'2024-01-30 09:41:48'),
(2,'002/ADFIN/I/2024','Data-Test 2','2024-01-27 00:00:00',5,1,4,5,1,'2024-01-30 09:41:49'),
(3,'003/ADFIN/I/2024','Data-Test 3','2024-01-27 00:00:00',5,1,4,5,1,'2024-01-30 09:41:49'),
(4,'004/ADADM/I/2024','Data-Test 4','2024-01-27 00:00:00',4,1,3,4,1,'2024-01-30 09:41:51'),
(5,'001/ADDIR/II/2024','asdsdasdasdasd','2024-02-06 00:00:00',1,1,1,1,1,'2024-01-30 09:29:33');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`pass`,`role_id`,`name`,`email`,`no_tlp`,`foto`,`status`,`is_active`,`update_by`,`last_update`) values 
(1,'superadmin','$2y$12$dZBewE74BT/hir9Y81eugOlAWjnIoDmUedTmGXjJ83pvbIuP2.5Yy','123',1,'Superadmin','superadmin@gmail.com','081211159962','default.jpg',1,1,1,'2024-01-26 09:03:44'),
(2,'jessica','$2y$12$acttIZrFxuspedt6zEru4uhYHCkMPme/2jGzoaJSlfA8U0rsoJmcO','123',2,'Jessica','jessica@gmail.com','0888877772','default.jpg',0,1,1,'2024-01-26 08:12:39'),
(3,'tes','$2y$12$ztOPiTcW3E6gwetVtzojseB1VaageRmAg9vVu5gUpy6f4MM050O1u','123456',3,'tes 123','tes@gmailo.com','88888','10569.png',0,0,1,'2024-01-26 02:12:03'),
(4,'Richardus','$2y$12$BwNlomFI.VuR311/QozG5O6QSzPUbzxn3I18CAKKY0xM4XFbCGNvy','123',4,'Richardus','Richardus@gmail.com','0812312234214','default.jpg',0,1,1,'2024-01-27 14:48:42'),
(5,'Dinar','$2y$12$FhNAW.36ymZB/Xs22lsw1uwGkIt9WOybOpqm/tCSYcw.JAEiu9vwi','123',3,'Dinar','Dinar@gmail.com','081231213','default.jpg',0,1,1,'2024-01-27 14:48:52'),
(6,'Direktur','$2y$12$OCc4eIMLgH0G1/9eS.suOep/z6N3eZh2/3YBxJqNzE1ZwQ1OnqQOe','123',1,'Direktur','XXXXX@gmail.com','0812XXXXXXX','default.jpg',NULL,1,1,'2024-01-27 14:40:10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
