/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 5.7.25-log : Database - codf8823_afterdom
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `auction` */

DROP TABLE IF EXISTS `auction`;

CREATE TABLE `auction` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `domain` varchar(500) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `price` decimal(30,2) DEFAULT NULL,
  `register` date DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `traffic` bigint(20) DEFAULT NULL,
  `about` text,
  `sellernote` text,
  `verificationcode` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `iduser` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `auction` */

insert  into `auction`(`id`,`domain`,`category`,`price`,`register`,`endtime`,`country`,`traffic`,`about`,`sellernote`,`verificationcode`,`status`,`iduser`,`created_at`,`updated_at`) values 
(1,'tes123.com','E-commerce',3.00,'2024-07-17','2024-08-28 12:20:00','Indonesia',12341,'tes','tes',NULL,'1',1,'2024-08-05 16:28:16','2024-08-05 16:28:16'),
(2,'tes123.com','E-commerce',1.50,'2024-07-17','2024-08-28 12:20:00','Indonesia',19999,'tes','tes',NULL,'1',1,'2024-08-05 16:28:41','2024-08-05 16:28:41'),
(3,'er12.com','Entertainment',2.10,'2024-06-11','2024-08-30 08:10:00','Indonesia',10000,'tes','tes',NULL,'1',1,'2024-08-06 01:37:18','2024-08-06 01:37:18'),
(4,'sala1.org','Newspaper',2.00,'2024-03-11','2024-08-30 20:03:00','Indonesia',567,'tes','tez',NULL,'1',1,'2024-08-06 05:12:40','2024-08-06 05:12:40'),
(5,'hallo.com','Travel',1.80,'2024-05-08','2024-08-06 11:20:00','Indonesia',45600,'tes','tes',NULL,'1',1,'2024-08-06 07:44:44','2024-08-06 07:44:44'),
(6,'tes1234.com','Sport',2.40,'2024-04-16','2024-08-05 22:30:00','Indonesia',2300,'tes','tes',NULL,'1',1,'2024-08-06 07:49:02','2024-08-06 07:49:02'),
(7,'haha2024.com','Sport',2.00,'2024-04-18','2024-09-27 12:00:00','Indonesia',3400,'tes','tes',NULL,'1',1,'2024-08-06 08:47:12','2024-08-06 08:47:12'),
(8,'tes1111.com','Travel',1.90,'2024-03-18','2024-08-15 12:00:00','Indonesia',125000,'tes','tes',NULL,'1',5,'2024-08-06 13:45:00','2024-08-06 13:45:00'),
(9,'tes22.com','Sport',2.00,'2024-05-14','2024-08-30 12:00:00','Indonesia',123456,'tes','tes',NULL,'1',1,'2024-08-09 09:23:09','2024-08-09 09:23:09');

/*Table structure for table `auctionbids` */

DROP TABLE IF EXISTS `auctionbids`;

CREATE TABLE `auctionbids` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idauction` bigint(20) DEFAULT NULL,
  `iduser` bigint(20) DEFAULT NULL,
  `bidprice` decimal(30,2) DEFAULT NULL,
  `bidstatus` int(11) DEFAULT '0',
  `merchantorderid` varchar(200) DEFAULT NULL,
  `payment_ref` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `auctionbids` */

insert  into `auctionbids`(`id`,`idauction`,`iduser`,`bidprice`,`bidstatus`,`merchantorderid`,`payment_ref`,`created_at`,`updated_at`) values 
(16,3,5,2.20,3,NULL,'DS19918243CCQHSK2CC6ZRI1','2024-08-10 01:39:52','2024-08-10 02:00:31'),
(17,7,5,2.00,3,NULL,'DS1991824PXA3ACWC842B5NE','2024-08-10 13:49:39','2024-08-12 04:37:32');

/*Table structure for table `authentication_logs` */

DROP TABLE IF EXISTS `authentication_logs`;

CREATE TABLE `authentication_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `context` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `authentication_logs` */

insert  into `authentication_logs`(`id`,`event_name`,`email`,`user_id`,`ip_address`,`user_agent`,`context`,`created_at`) values 
(12,'Attempting','prajaw@gmail.com',NULL,'2001:448a:50e0:864b:7c5f:2da8:c069:17e0','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-22 16:54:44'),
(13,'Login',NULL,1,'2001:448a:50e0:864b:7c5f:2da8:c069:17e0','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-22 16:54:44'),
(14,'Attempting','prajaw@gmail.com',NULL,'2001:448a:50e0:864b:cc6d:97ad:b20:85fb','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Mobile Safari/537.36',NULL,'2024-08-22 16:56:17'),
(15,'Login',NULL,1,'2001:448a:50e0:864b:cc6d:97ad:b20:85fb','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Mobile Safari/537.36',NULL,'2024-08-22 16:56:17'),
(16,'Attempting','prajaw@gmail.com',NULL,'2001:448a:50e0:864b:cc6d:97ad:b20:85fb','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Mobile Safari/537.36',NULL,'2024-08-22 16:56:22'),
(17,'Login',NULL,1,'2001:448a:50e0:864b:cc6d:97ad:b20:85fb','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Mobile Safari/537.36',NULL,'2024-08-22 16:56:22'),
(18,'Logout',NULL,1,'2001:448a:50e0:864b:7c5f:2da8:c069:17e0','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-22 17:11:00'),
(19,'Attempting','prajaw@gmail.com',NULL,'2001:448a:50e0:864b:7c5f:2da8:c069:17e0','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-22 17:11:03'),
(20,'Login',NULL,1,'2001:448a:50e0:864b:7c5f:2da8:c069:17e0','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-22 17:11:03'),
(21,'Logout',NULL,1,'2001:448a:50e0:864b:7c5f:2da8:c069:17e0','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-22 17:12:20'),
(22,'Attempting','prajaw@gmail.com',NULL,'2001:448a:50e0:864b:7c5f:2da8:c069:17e0','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-22 17:14:56'),
(23,'Login',NULL,1,'2001:448a:50e0:864b:7c5f:2da8:c069:17e0','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-22 17:14:56'),
(24,'Logout',NULL,1,'2001:448a:50e0:864b:7c5f:2da8:c069:17e0','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-22 17:17:26'),
(25,'Attempting','prajaw@gmail.com',NULL,'2001:448a:50e0:864b:7c5f:2da8:c069:17e0','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-22 17:17:29'),
(26,'Login',NULL,1,'2001:448a:50e0:864b:7c5f:2da8:c069:17e0','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-22 17:17:29'),
(27,'Attempting','prajaw@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-23 00:51:15'),
(28,'Login',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-23 00:51:15'),
(29,'Logout',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-23 01:54:19'),
(30,'Attempting','prajaw@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-23 01:54:27'),
(31,'Login',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-23 01:54:27'),
(32,'Logout',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-23 05:36:45'),
(33,'Attempting','prajaw@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-23 05:36:52'),
(34,'Login',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-23 05:36:53'),
(35,'Attempting','prajaw@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-27 09:54:29'),
(36,'Login',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-27 09:54:29'),
(37,'Attempting','prajaw@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-29 08:39:30'),
(38,'Failed','prajaw@gmail.com',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-29 08:39:30'),
(39,'Attempting','prajaw@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-29 08:39:37'),
(40,'Login',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-29 08:39:37'),
(41,'Logout',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-29 08:47:51'),
(42,'Attempting','prajaw@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-29 08:48:04'),
(43,'Failed','prajaw@gmail.com',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-29 08:48:04'),
(44,'Attempting','prajaw@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-29 08:48:15'),
(45,'Login',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-29 08:48:15'),
(46,'Attempting','prajaw@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-30 00:56:32'),
(47,'Login',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-30 00:56:32'),
(48,'Attempting','prajaw@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-30 06:12:24'),
(49,'Login',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-08-30 06:12:25'),
(50,'Attempting','prajaw@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-09-04 06:23:42'),
(51,'Login',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-09-04 06:23:42'),
(52,'Logout',NULL,1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-09-04 08:30:13'),
(53,'Attempting','tes1@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-09-04 08:30:22'),
(54,'Failed','tes1@gmail.com',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-09-04 08:30:22'),
(55,'Attempting','tes1@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-09-04 08:30:32'),
(56,'Login',NULL,5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0',NULL,'2024-09-04 08:30:32'),
(57,'Attempting','tes1@gmail.com',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',NULL,'2024-09-04 08:40:55'),
(58,'Login',NULL,5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',NULL,'2024-09-04 08:40:55');

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `category` */

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

/*Data for the table `country` */

insert  into `country`(`id`,`iso`,`name`,`nicename`,`iso3`,`numcode`,`phonecode`) values 
(1,'AF','AFGHANISTAN','Afghanistan','AFG',4,93),
(2,'AL','ALBANIA','Albania','ALB',8,355),
(3,'DZ','ALGERIA','Algeria','DZA',12,213),
(4,'AS','AMERICAN SAMOA','American Samoa','ASM',16,1684),
(5,'AD','ANDORRA','Andorra','AND',20,376),
(6,'AO','ANGOLA','Angola','AGO',24,244),
(7,'AI','ANGUILLA','Anguilla','AIA',660,1264),
(8,'AQ','ANTARCTICA','Antarctica',NULL,NULL,0),
(9,'AG','ANTIGUA AND BARBUDA','Antigua and Barbuda','ATG',28,1268),
(10,'AR','ARGENTINA','Argentina','ARG',32,54),
(11,'AM','ARMENIA','Armenia','ARM',51,374),
(12,'AW','ARUBA','Aruba','ABW',533,297),
(13,'AU','AUSTRALIA','Australia','AUS',36,61),
(14,'AT','AUSTRIA','Austria','AUT',40,43),
(15,'AZ','AZERBAIJAN','Azerbaijan','AZE',31,994),
(16,'BS','BAHAMAS','Bahamas','BHS',44,1242),
(17,'BH','BAHRAIN','Bahrain','BHR',48,973),
(18,'BD','BANGLADESH','Bangladesh','BGD',50,880),
(19,'BB','BARBADOS','Barbados','BRB',52,1246),
(20,'BY','BELARUS','Belarus','BLR',112,375),
(21,'BE','BELGIUM','Belgium','BEL',56,32),
(22,'BZ','BELIZE','Belize','BLZ',84,501),
(23,'BJ','BENIN','Benin','BEN',204,229),
(24,'BM','BERMUDA','Bermuda','BMU',60,1441),
(25,'BT','BHUTAN','Bhutan','BTN',64,975),
(26,'BO','BOLIVIA','Bolivia','BOL',68,591),
(27,'BA','BOSNIA AND HERZEGOVINA','Bosnia and Herzegovina','BIH',70,387),
(28,'BW','BOTSWANA','Botswana','BWA',72,267),
(29,'BV','BOUVET ISLAND','Bouvet Island',NULL,NULL,0),
(30,'BR','BRAZIL','Brazil','BRA',76,55),
(31,'IO','BRITISH INDIAN OCEAN TERRITORY','British Indian Ocean Territory',NULL,NULL,246),
(32,'BN','BRUNEI DARUSSALAM','Brunei Darussalam','BRN',96,673),
(33,'BG','BULGARIA','Bulgaria','BGR',100,359),
(34,'BF','BURKINA FASO','Burkina Faso','BFA',854,226),
(35,'BI','BURUNDI','Burundi','BDI',108,257),
(36,'KH','CAMBODIA','Cambodia','KHM',116,855),
(37,'CM','CAMEROON','Cameroon','CMR',120,237),
(38,'CA','CANADA','Canada','CAN',124,1),
(39,'CV','CAPE VERDE','Cape Verde','CPV',132,238),
(40,'KY','CAYMAN ISLANDS','Cayman Islands','CYM',136,1345),
(41,'CF','CENTRAL AFRICAN REPUBLIC','Central African Republic','CAF',140,236),
(42,'TD','CHAD','Chad','TCD',148,235),
(43,'CL','CHILE','Chile','CHL',152,56),
(44,'CN','CHINA','China','CHN',156,86),
(45,'CX','CHRISTMAS ISLAND','Christmas Island',NULL,NULL,61),
(46,'CC','COCOS (KEELING) ISLANDS','Cocos (Keeling) Islands',NULL,NULL,672),
(47,'CO','COLOMBIA','Colombia','COL',170,57),
(48,'KM','COMOROS','Comoros','COM',174,269),
(49,'CG','CONGO','Congo','COG',178,242),
(50,'CD','CONGO, THE DEMOCRATIC REPUBLIC OF THE','Congo, the Democratic Republic of the','COD',180,242),
(51,'CK','COOK ISLANDS','Cook Islands','COK',184,682),
(52,'CR','COSTA RICA','Costa Rica','CRI',188,506),
(53,'CI','COTE D\'IVOIRE','Cote D\'Ivoire','CIV',384,225),
(54,'HR','CROATIA','Croatia','HRV',191,385),
(55,'CU','CUBA','Cuba','CUB',192,53),
(56,'CY','CYPRUS','Cyprus','CYP',196,357),
(57,'CZ','CZECH REPUBLIC','Czech Republic','CZE',203,420),
(58,'DK','DENMARK','Denmark','DNK',208,45),
(59,'DJ','DJIBOUTI','Djibouti','DJI',262,253),
(60,'DM','DOMINICA','Dominica','DMA',212,1767),
(61,'DO','DOMINICAN REPUBLIC','Dominican Republic','DOM',214,1809),
(62,'EC','ECUADOR','Ecuador','ECU',218,593),
(63,'EG','EGYPT','Egypt','EGY',818,20),
(64,'SV','EL SALVADOR','El Salvador','SLV',222,503),
(65,'GQ','EQUATORIAL GUINEA','Equatorial Guinea','GNQ',226,240),
(66,'ER','ERITREA','Eritrea','ERI',232,291),
(67,'EE','ESTONIA','Estonia','EST',233,372),
(68,'ET','ETHIOPIA','Ethiopia','ETH',231,251),
(69,'FK','FALKLAND ISLANDS (MALVINAS)','Falkland Islands (Malvinas)','FLK',238,500),
(70,'FO','FAROE ISLANDS','Faroe Islands','FRO',234,298),
(71,'FJ','FIJI','Fiji','FJI',242,679),
(72,'FI','FINLAND','Finland','FIN',246,358),
(73,'FR','FRANCE','France','FRA',250,33),
(74,'GF','FRENCH GUIANA','French Guiana','GUF',254,594),
(75,'PF','FRENCH POLYNESIA','French Polynesia','PYF',258,689),
(76,'TF','FRENCH SOUTHERN TERRITORIES','French Southern Territories',NULL,NULL,0),
(77,'GA','GABON','Gabon','GAB',266,241),
(78,'GM','GAMBIA','Gambia','GMB',270,220),
(79,'GE','GEORGIA','Georgia','GEO',268,995),
(80,'DE','GERMANY','Germany','DEU',276,49),
(81,'GH','GHANA','Ghana','GHA',288,233),
(82,'GI','GIBRALTAR','Gibraltar','GIB',292,350),
(83,'GR','GREECE','Greece','GRC',300,30),
(84,'GL','GREENLAND','Greenland','GRL',304,299),
(85,'GD','GRENADA','Grenada','GRD',308,1473),
(86,'GP','GUADELOUPE','Guadeloupe','GLP',312,590),
(87,'GU','GUAM','Guam','GUM',316,1671),
(88,'GT','GUATEMALA','Guatemala','GTM',320,502),
(89,'GN','GUINEA','Guinea','GIN',324,224),
(90,'GW','GUINEA-BISSAU','Guinea-Bissau','GNB',624,245),
(91,'GY','GUYANA','Guyana','GUY',328,592),
(92,'HT','HAITI','Haiti','HTI',332,509),
(93,'HM','HEARD ISLAND AND MCDONALD ISLANDS','Heard Island and Mcdonald Islands',NULL,NULL,0),
(94,'VA','HOLY SEE (VATICAN CITY STATE)','Holy See (Vatican City State)','VAT',336,39),
(95,'HN','HONDURAS','Honduras','HND',340,504),
(96,'HK','HONG KONG','Hong Kong','HKG',344,852),
(97,'HU','HUNGARY','Hungary','HUN',348,36),
(98,'IS','ICELAND','Iceland','ISL',352,354),
(99,'IN','INDIA','India','IND',356,91),
(100,'ID','INDONESIA','Indonesia','IDN',360,62),
(101,'IR','IRAN, ISLAMIC REPUBLIC OF','Iran, Islamic Republic of','IRN',364,98),
(102,'IQ','IRAQ','Iraq','IRQ',368,964),
(103,'IE','IRELAND','Ireland','IRL',372,353),
(104,'IL','ISRAEL','Israel','ISR',376,972),
(105,'IT','ITALY','Italy','ITA',380,39),
(106,'JM','JAMAICA','Jamaica','JAM',388,1876),
(107,'JP','JAPAN','Japan','JPN',392,81),
(108,'JO','JORDAN','Jordan','JOR',400,962),
(109,'KZ','KAZAKHSTAN','Kazakhstan','KAZ',398,7),
(110,'KE','KENYA','Kenya','KEN',404,254),
(111,'KI','KIRIBATI','Kiribati','KIR',296,686),
(112,'KP','KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','Korea, Democratic People\'s Republic of','PRK',408,850),
(113,'KR','KOREA, REPUBLIC OF','Korea, Republic of','KOR',410,82),
(114,'KW','KUWAIT','Kuwait','KWT',414,965),
(115,'KG','KYRGYZSTAN','Kyrgyzstan','KGZ',417,996),
(116,'LA','LAO PEOPLE\'S DEMOCRATIC REPUBLIC','Lao People\'s Democratic Republic','LAO',418,856),
(117,'LV','LATVIA','Latvia','LVA',428,371),
(118,'LB','LEBANON','Lebanon','LBN',422,961),
(119,'LS','LESOTHO','Lesotho','LSO',426,266),
(120,'LR','LIBERIA','Liberia','LBR',430,231),
(121,'LY','LIBYAN ARAB JAMAHIRIYA','Libyan Arab Jamahiriya','LBY',434,218),
(122,'LI','LIECHTENSTEIN','Liechtenstein','LIE',438,423),
(123,'LT','LITHUANIA','Lithuania','LTU',440,370),
(124,'LU','LUXEMBOURG','Luxembourg','LUX',442,352),
(125,'MO','MACAO','Macao','MAC',446,853),
(126,'MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','Macedonia, the Former Yugoslav Republic of','MKD',807,389),
(127,'MG','MADAGASCAR','Madagascar','MDG',450,261),
(128,'MW','MALAWI','Malawi','MWI',454,265),
(129,'MY','MALAYSIA','Malaysia','MYS',458,60),
(130,'MV','MALDIVES','Maldives','MDV',462,960),
(131,'ML','MALI','Mali','MLI',466,223),
(132,'MT','MALTA','Malta','MLT',470,356),
(133,'MH','MARSHALL ISLANDS','Marshall Islands','MHL',584,692),
(134,'MQ','MARTINIQUE','Martinique','MTQ',474,596),
(135,'MR','MAURITANIA','Mauritania','MRT',478,222),
(136,'MU','MAURITIUS','Mauritius','MUS',480,230),
(137,'YT','MAYOTTE','Mayotte',NULL,NULL,269),
(138,'MX','MEXICO','Mexico','MEX',484,52),
(139,'FM','MICRONESIA, FEDERATED STATES OF','Micronesia, Federated States of','FSM',583,691),
(140,'MD','MOLDOVA, REPUBLIC OF','Moldova, Republic of','MDA',498,373),
(141,'MC','MONACO','Monaco','MCO',492,377),
(142,'MN','MONGOLIA','Mongolia','MNG',496,976),
(143,'MS','MONTSERRAT','Montserrat','MSR',500,1664),
(144,'MA','MOROCCO','Morocco','MAR',504,212),
(145,'MZ','MOZAMBIQUE','Mozambique','MOZ',508,258),
(146,'MM','MYANMAR','Myanmar','MMR',104,95),
(147,'NA','NAMIBIA','Namibia','NAM',516,264),
(148,'NR','NAURU','Nauru','NRU',520,674),
(149,'NP','NEPAL','Nepal','NPL',524,977),
(150,'NL','NETHERLANDS','Netherlands','NLD',528,31),
(151,'AN','NETHERLANDS ANTILLES','Netherlands Antilles','ANT',530,599),
(152,'NC','NEW CALEDONIA','New Caledonia','NCL',540,687),
(153,'NZ','NEW ZEALAND','New Zealand','NZL',554,64),
(154,'NI','NICARAGUA','Nicaragua','NIC',558,505),
(155,'NE','NIGER','Niger','NER',562,227),
(156,'NG','NIGERIA','Nigeria','NGA',566,234),
(157,'NU','NIUE','Niue','NIU',570,683),
(158,'NF','NORFOLK ISLAND','Norfolk Island','NFK',574,672),
(159,'MP','NORTHERN MARIANA ISLANDS','Northern Mariana Islands','MNP',580,1670),
(160,'NO','NORWAY','Norway','NOR',578,47),
(161,'OM','OMAN','Oman','OMN',512,968),
(162,'PK','PAKISTAN','Pakistan','PAK',586,92),
(163,'PW','PALAU','Palau','PLW',585,680),
(164,'PS','PALESTINIAN TERRITORY, OCCUPIED','Palestinian Territory, Occupied',NULL,NULL,970),
(165,'PA','PANAMA','Panama','PAN',591,507),
(166,'PG','PAPUA NEW GUINEA','Papua New Guinea','PNG',598,675),
(167,'PY','PARAGUAY','Paraguay','PRY',600,595),
(168,'PE','PERU','Peru','PER',604,51),
(169,'PH','PHILIPPINES','Philippines','PHL',608,63),
(170,'PN','PITCAIRN','Pitcairn','PCN',612,0),
(171,'PL','POLAND','Poland','POL',616,48),
(172,'PT','PORTUGAL','Portugal','PRT',620,351),
(173,'PR','PUERTO RICO','Puerto Rico','PRI',630,1787),
(174,'QA','QATAR','Qatar','QAT',634,974),
(175,'RE','REUNION','Reunion','REU',638,262),
(176,'RO','ROMANIA','Romania','ROM',642,40),
(177,'RU','RUSSIAN FEDERATION','Russian Federation','RUS',643,70),
(178,'RW','RWANDA','Rwanda','RWA',646,250),
(179,'SH','SAINT HELENA','Saint Helena','SHN',654,290),
(180,'KN','SAINT KITTS AND NEVIS','Saint Kitts and Nevis','KNA',659,1869),
(181,'LC','SAINT LUCIA','Saint Lucia','LCA',662,1758),
(182,'PM','SAINT PIERRE AND MIQUELON','Saint Pierre and Miquelon','SPM',666,508),
(183,'VC','SAINT VINCENT AND THE GRENADINES','Saint Vincent and the Grenadines','VCT',670,1784),
(184,'WS','SAMOA','Samoa','WSM',882,684),
(185,'SM','SAN MARINO','San Marino','SMR',674,378),
(186,'ST','SAO TOME AND PRINCIPE','Sao Tome and Principe','STP',678,239),
(187,'SA','SAUDI ARABIA','Saudi Arabia','SAU',682,966),
(188,'SN','SENEGAL','Senegal','SEN',686,221),
(189,'CS','SERBIA AND MONTENEGRO','Serbia and Montenegro',NULL,NULL,381),
(190,'SC','SEYCHELLES','Seychelles','SYC',690,248),
(191,'SL','SIERRA LEONE','Sierra Leone','SLE',694,232),
(192,'SG','SINGAPORE','Singapore','SGP',702,65),
(193,'SK','SLOVAKIA','Slovakia','SVK',703,421),
(194,'SI','SLOVENIA','Slovenia','SVN',705,386),
(195,'SB','SOLOMON ISLANDS','Solomon Islands','SLB',90,677),
(196,'SO','SOMALIA','Somalia','SOM',706,252),
(197,'ZA','SOUTH AFRICA','South Africa','ZAF',710,27),
(198,'GS','SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','South Georgia and the South Sandwich Islands',NULL,NULL,0),
(199,'ES','SPAIN','Spain','ESP',724,34),
(200,'LK','SRI LANKA','Sri Lanka','LKA',144,94),
(201,'SD','SUDAN','Sudan','SDN',736,249),
(202,'SR','SURINAME','Suriname','SUR',740,597),
(203,'SJ','SVALBARD AND JAN MAYEN','Svalbard and Jan Mayen','SJM',744,47),
(204,'SZ','SWAZILAND','Swaziland','SWZ',748,268),
(205,'SE','SWEDEN','Sweden','SWE',752,46),
(206,'CH','SWITZERLAND','Switzerland','CHE',756,41),
(207,'SY','SYRIAN ARAB REPUBLIC','Syrian Arab Republic','SYR',760,963),
(208,'TW','TAIWAN, PROVINCE OF CHINA','Taiwan, Province of China','TWN',158,886),
(209,'TJ','TAJIKISTAN','Tajikistan','TJK',762,992),
(210,'TZ','TANZANIA, UNITED REPUBLIC OF','Tanzania, United Republic of','TZA',834,255),
(211,'TH','THAILAND','Thailand','THA',764,66),
(212,'TL','TIMOR-LESTE','Timor-Leste',NULL,NULL,670),
(213,'TG','TOGO','Togo','TGO',768,228),
(214,'TK','TOKELAU','Tokelau','TKL',772,690),
(215,'TO','TONGA','Tonga','TON',776,676),
(216,'TT','TRINIDAD AND TOBAGO','Trinidad and Tobago','TTO',780,1868),
(217,'TN','TUNISIA','Tunisia','TUN',788,216),
(218,'TR','TURKEY','Turkey','TUR',792,90),
(219,'TM','TURKMENISTAN','Turkmenistan','TKM',795,7370),
(220,'TC','TURKS AND CAICOS ISLANDS','Turks and Caicos Islands','TCA',796,1649),
(221,'TV','TUVALU','Tuvalu','TUV',798,688),
(222,'UG','UGANDA','Uganda','UGA',800,256),
(223,'UA','UKRAINE','Ukraine','UKR',804,380),
(224,'AE','UNITED ARAB EMIRATES','United Arab Emirates','ARE',784,971),
(225,'GB','UNITED KINGDOM','United Kingdom','GBR',826,44),
(226,'US','UNITED STATES','United States','USA',840,1),
(227,'UM','UNITED STATES MINOR OUTLYING ISLANDS','United States Minor Outlying Islands',NULL,NULL,1),
(228,'UY','URUGUAY','Uruguay','URY',858,598),
(229,'UZ','UZBEKISTAN','Uzbekistan','UZB',860,998),
(230,'VU','VANUATU','Vanuatu','VUT',548,678),
(231,'VE','VENEZUELA','Venezuela','VEN',862,58),
(232,'VN','VIET NAM','Viet Nam','VNM',704,84),
(233,'VG','VIRGIN ISLANDS, BRITISH','Virgin Islands, British','VGB',92,1284),
(234,'VI','VIRGIN ISLANDS, U.S.','Virgin Islands, U.s.','VIR',850,1340),
(235,'WF','WALLIS AND FUTUNA','Wallis and Futuna','WLF',876,681),
(236,'EH','WESTERN SAHARA','Western Sahara','ESH',732,212),
(237,'YE','YEMEN','Yemen','YEM',887,967),
(238,'ZM','ZAMBIA','Zambia','ZMB',894,260),
(239,'ZW','ZIMBABWE','Zimbabwe','ZWE',716,263);

/*Table structure for table `deposit` */

DROP TABLE IF EXISTS `deposit`;

CREATE TABLE `deposit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `iduser` bigint(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kurs` decimal(30,2) DEFAULT '16000.00',
  `amount` decimal(30,2) DEFAULT '0.00',
  `tipebayar` varchar(100) DEFAULT NULL,
  `note` text,
  `reference` varchar(100) DEFAULT NULL,
  `paymentorderid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `deposit` */

insert  into `deposit`(`id`,`iduser`,`tanggal`,`kurs`,`amount`,`tipebayar`,`note`,`reference`,`paymentorderid`,`created_at`,`updated_at`) values 
(43,5,'2024-08-10',17000.00,2.50,'VC','tes','DS1991824KATBNNTSXN1CW84','VC24FFBKD6GVO4JFIPJ','2024-08-10 01:22:22','2024-08-10 01:22:22'),
(44,5,'2024-08-10',17000.00,3.20,'VC','tes','DS1991824X7BTYEYN16H3UR4','VC247EMB3DT5MFLJSAU','2024-08-10 01:31:54','2024-08-10 01:31:54'),
(45,5,'2024-08-10',17000.00,6.00,'VC','tes','DS199182468LCR21MGDA1YIP','VC24U4HD1U1SXU0KIB0','2024-08-10 01:33:50','2024-08-10 01:33:50'),
(46,1,'2024-08-12',17000.00,3.00,'PAYPAL','DEPOSIT','5FJ2BCJJ6EEAG','PAYID-M24YLUA83R568578F3629128','2024-08-12 03:48:40','2024-08-12 03:48:40'),
(47,1,'2024-08-12',17000.00,2.00,'PAYPAL','DEPOSIT','5FJ2BCJJ6EEAG','PAYID-M24YM3Q6CE14182TY777192U','2024-08-12 03:50:13','2024-08-12 03:50:13'),
(48,1,'2024-08-12',17000.00,5.00,'PAYPAL','DEPOSIT','5FJ2BCJJ6EEAG','PAYID-M24YNMQ85E825381B628193Y','2024-08-12 03:51:22','2024-08-12 03:51:22');

/*Table structure for table `extensions` */

DROP TABLE IF EXISTS `extensions`;

CREATE TABLE `extensions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `extensions` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `iduser` bigint(20) DEFAULT NULL,
  `idauctionbids` bigint(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kurs` decimal(30,2) NOT NULL DEFAULT '16000.00',
  `amountdp` decimal(30,2) DEFAULT '0.00',
  `amount` decimal(30,2) DEFAULT '0.00',
  `tipebayar` varchar(100) DEFAULT NULL,
  `note` text,
  `reference` varchar(100) DEFAULT NULL,
  `paymentorderid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `payment` */

insert  into `payment`(`id`,`iduser`,`idauctionbids`,`tanggal`,`kurs`,`amountdp`,`amount`,`tipebayar`,`note`,`reference`,`paymentorderid`,`created_at`,`updated_at`) values 
(6,5,16,'2024-08-10',17000.00,1.00,1.20,'VC','tes','DS19918243CCQHSK2CC6ZRI1','VC24U2XI1U71QLB26GV','2024-08-10 02:00:31','2024-08-10 02:00:31'),
(7,5,17,'2024-08-12',17000.00,1.00,1.00,'PAYPAL','PAYMENT','NJ88THZBF3FLQ','PAYID-M24ZBMQ42D98605YV240230J','2024-08-12 04:37:32','2024-08-12 04:37:32');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('cdo3PSdJYCsEzgBLJhGUZ2MqrXCrhKcAHet8WANw',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZFlTUG1aSDI0dXF1NW90bzhlOEk0cm9PZ0twcWhrcXlQcFBFWldGViI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3VzZXJzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==',1725442154),
('vnmMeXu38LAXDDsiMJ00L9AlxWZOYWorHcugdYs0',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNnZpZWpZZ0RPNUVDdFZGS0NoQmRJdkFWRkRKNFdPdXZMbndVc2lzdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==',1725440343);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `profile_photo_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT 'assets/img/avatars/1.png',
  `saldo` decimal(30,2) NOT NULL DEFAULT '0.00',
  `kurs` decimal(30,2) NOT NULL DEFAULT '16000.00',
  `admin` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`firstname`,`lastname`,`email`,`email_verified_at`,`password`,`remember_token`,`country`,`mobile`,`address`,`state`,`zipcode`,`city`,`active`,`profile_photo_url`,`saldo`,`kurs`,`admin`,`created_at`,`updated_at`) values 
(1,'tes123','tes','praja','prajaw@gmail.com',NULL,'$2y$12$A6qldobzFL7lmhcqzudgoOqwEY8DtXLXrFD.l0TiviuNtFKIf6pVS','ssZTr5e7R2LIIosDKN2uGu5Dv9mbK1USom6s9PyaKLahh11Fh6wC4Fl1AaBx','ID','081515328045','Jl. Tes saja','Jawa Timur','60194','Surabaya',1,'assets/img/avatars/1.png',10.00,17000.00,1,'2024-08-04 03:11:57','2024-08-12 03:51:22'),
(4,'tes1','tes1','praja','prajaw1@gmail.com',NULL,'$2y$12$OvMt9OKtlYQay7qlQenYg.WevxG716CLCEA7dPoBmeOODBNRLuBau',NULL,'ID','081515328045','Jl. Tes saja','Jawa Timur','60194','Surabaya',1,'assets/img/avatars/1.png',0.00,17000.00,0,'2024-08-04 03:14:59','2024-08-04 03:14:59'),
(5,'tes12024','tes1','tes1','tes1@gmail.com',NULL,'$2y$12$4/YQzEth.w/oa3UrthlhcuMUp3kzx4yfrJ5w81ncdrXxR.07D1Fx.',NULL,'ID','081515328045','tes','jawa timur','60184','surabaya',1,'assets/img/avatars/1.png',9.70,17000.00,0,'2024-08-06 13:43:15','2024-08-12 04:37:32'),
(6,'tes1','tes','tes1','prajaw.jkt@gmail.com',NULL,'$2y$12$qxGLinrhZDrCT0to2xCIQerHfAeAXwcFsLAg1bYML8OoA23hI.Eui',NULL,'ID','0191919','jsnsj','jsjjs','018878','nNNs',1,'assets/img/avatars/1.png',0.00,17000.00,0,'2024-08-07 08:21:29','2024-08-07 08:21:29'),
(7,'tes','tes','tes','wibisonopraja@gmail.com',NULL,'$2y$12$UPRiqtNcVkuDpDjMuCGauuWvR4Zlqq1AUPe.vLNmoQ58uQTtH7byW',NULL,'ID','9181817','h','h','617171','h',1,'assets/img/avatars/1.png',0.00,17000.00,0,'2024-08-09 08:25:53','2024-08-09 08:25:53');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
