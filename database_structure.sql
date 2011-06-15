/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.5.8 : Database - wordpress
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`wordpress` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `wordpress`;

/*Table structure for table `wp_guidebook_entries` */

DROP TABLE IF EXISTS `wp_guidebook_entries`;

CREATE TABLE `wp_guidebook_entries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `climbing_wall_id` int(11) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `level` varchar(15) DEFAULT NULL,
  `description` longtext,
  `description_plain_text` longtext,
  `image` varchar(255) DEFAULT NULL,
  `passed_at` datetime DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `wp_guidebook_walls` */

DROP TABLE IF EXISTS `wp_guidebook_walls`;

CREATE TABLE `wp_guidebook_walls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `description_plain_text` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `wp_pages_images` */

DROP TABLE IF EXISTS `wp_pages_images`;

CREATE TABLE `wp_pages_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `comment` text,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `wp_rateable` */

DROP TABLE IF EXISTS `wp_rateable`;

CREATE TABLE `wp_rateable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rateable_id` int(11) DEFAULT NULL,
  `rateable_type` varchar(45) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
