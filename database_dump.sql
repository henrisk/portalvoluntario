/*
SQLyog Community v9.02 
MySQL - 5.5.28 : Database - portalvoluntario
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`portalvoluntario` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `portalvoluntario`;

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `Menu`;

CREATE TABLE `Menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `path` varchar(200) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Menu` */

/*Table structure for table `MenuProfile` */

DROP TABLE IF EXISTS `MenuProfile`;

CREATE TABLE `MenuProfile` (
  `menuId` int(10) unsigned NOT NULL,
  `profileId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`menuId`,`profileId`),
  KEY `FK_menuprofile_profile` (`profileId`),
  CONSTRAINT `FK_menuprofile_menu` FOREIGN KEY (`menuId`) REFERENCES `menu` (`id`),
  CONSTRAINT `FK_menuprofile_profile` FOREIGN KEY (`profileId`) REFERENCES `profile` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `MenuProfile` */

/*Table structure for table `Organization` */

DROP TABLE IF EXISTS `Organization`;

CREATE TABLE `Organization` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `contactName` varchar(100) NOT NULL,
  `contactEmail` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_organization_user` (`userId`),
  CONSTRAINT `FK_organization_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Organization` */

/*Table structure for table `Profile` */

DROP TABLE IF EXISTS `Profile`;

CREATE TABLE `Profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Profile` */

/*Table structure for table `User` */

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `User` */

insert  into `User`(`id`,`login`,`password`) values (1,'henrisk','202cb962ac59075b964b07152d234b70');

/*Table structure for table `UserProfile` */

DROP TABLE IF EXISTS `UserProfile`;

CREATE TABLE `UserProfile` (
  `userId` int(10) unsigned NOT NULL,
  `profileId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`userId`,`profileId`),
  KEY `FK_userprofile_profile` (`profileId`),
  CONSTRAINT `FK_userprofile_profile` FOREIGN KEY (`profileId`) REFERENCES `profile` (`id`),
  CONSTRAINT `FK_userprofile_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `UserProfile` */

/*Table structure for table `Volunteer` */

DROP TABLE IF EXISTS `Volunteer`;

CREATE TABLE `Volunteer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` char(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_volunteer_user` (`userId`),
  CONSTRAINT `FK_volunteer_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Volunteer` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
