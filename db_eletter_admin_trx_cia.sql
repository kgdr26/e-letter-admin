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
  `update_by` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_cia` */

insert  into `trx_cia`(`id`,`no_cia`,`id_user`,`date_create`,`necessity`,`unit`,`amount`,`amount_actual`,`selisih`,`remark`,`status`,`id_dephead`,`id_finance`,`id_chasier`,`metode`,`bank`,`atas_nama`,`no_rek`,`bukti_tf_ambil`,`bukti_tf_terima`,`struk`,`update_by`,`is_active`,`last_update`) values 
(1,'CIA.2024-07.0001',1,'2024-07-14','Tes data','10 PCS',20000000,NULL,NULL,NULL,5,1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,1,1,'2024-07-14 20:58:00'),
(2,'CIA.2024-07.0002',1,'2024-07-14','dfsdfsd','6 pcs',600000,NULL,NULL,NULL,4,1,1,NULL,2,'BSI','Mediw','098888',NULL,NULL,NULL,1,1,'2024-07-14 20:44:08'),
(3,'CIA.2024-07.0003',1,'2024-07-14','rgrergwergre','6 pcs',600000,NULL,NULL,NULL,4,1,1,1,2,'BSI','dddddd','66666',NULL,NULL,NULL,1,1,'2024-07-14 22:19:23'),
(4,'CIA.2024-07.0004',1,'2024-07-14','sdagdsfdsdssd','5 PCS',600000000,NULL,NULL,NULL,3,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,'2024-07-14 18:43:39'),
(5,'CIA.2024-07.0005',1,'2024-07-14','pegajuan','1 PCS',30000000,NULL,NULL,NULL,4,1,1,NULL,2,'BSI','Medi','098876654',NULL,NULL,NULL,1,1,'2024-07-14 20:49:10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
