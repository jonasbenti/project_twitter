/*
SQLyog Enterprise v12.13 (64 bit)
MySQL - 5.7.28 : Database - cad_twitter
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cad_twitter` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `cad_twitter`;

/*Table structure for table `hashtag` */

DROP TABLE IF EXISTS `hashtag`;

CREATE TABLE `hashtag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `hashtag` */

insert  into `hashtag`(`id`,`description`,`created_at`,`updated_at`) values (1,'#dev','2020-08-29 10:55:03','2020-08-29 13:21:50'),(2,'#job','2020-08-29 10:55:14','2020-08-29 14:41:21'),(4,'#corona_virus','2020-08-29 13:19:07','2020-08-29 13:22:08'),(5,'#test','2020-08-29 14:41:34',NULL),(6,'#brasil','2020-08-30 22:34:27',NULL);

/*Table structure for table `tweet` */

DROP TABLE IF EXISTS `tweet`;

CREATE TABLE `tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user_id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tweet` */

insert  into `tweet`(`id`,`description`,`user_id`,`created_at`,`updated_at`) values (2,'Tweet corona2',2,'2020-08-29 13:18:43','2020-08-30 15:59:49'),(4,'Nova tech',5,'2020-08-30 22:46:26',NULL),(5,'Nova tech',4,'2020-08-30 22:46:26',NULL),(6,'Twitter brasil 2020',2,'2020-08-30 22:46:26',NULL),(7,'Novos trabalhos',5,'2020-08-30 22:46:26',NULL),(8,'Corona Virus',4,'2020-08-30 22:46:26',NULL);

/*Table structure for table `tweet_hashtag` */

DROP TABLE IF EXISTS `tweet_hashtag`;

CREATE TABLE `tweet_hashtag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) DEFAULT NULL,
  `hashtag_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_tweet` (`tweet_id`),
  KEY `fk_hashtag` (`hashtag_id`),
  CONSTRAINT `fk_hashtag` FOREIGN KEY (`hashtag_id`) REFERENCES `hashtag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tweet` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tweet_hashtag` */

insert  into `tweet_hashtag`(`id`,`tweet_id`,`hashtag_id`,`created_at`,`updated_at`) values (2,2,4,'2020-08-29 13:19:46','2020-08-29 13:20:23'),(4,4,1,'2020-08-30 22:51:52',NULL),(5,4,2,'2020-08-30 22:51:52',NULL),(6,4,5,'2020-08-30 22:51:52',NULL),(7,5,1,'2020-08-30 22:51:52',NULL),(8,5,2,'2020-08-30 22:51:52',NULL),(9,5,5,'2020-08-30 22:51:52',NULL),(10,6,6,'2020-08-30 22:51:52',NULL),(11,7,1,'2020-08-30 22:51:52',NULL),(12,7,2,'2020-08-30 22:51:52',NULL),(13,8,4,'2020-08-30 22:51:52',NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`login`,`email`,`created_at`,`updated_at`) values (2,'Teste 2021','teste_2020','teste@teste.com','2020-08-27 17:22:41','2020-08-30 22:36:02'),(4,'Novo 2020','novo_2020','novo2020@teste.com','2020-08-30 22:37:29',NULL),(5,'João da Silva','joao_silva','joao@silva.br','2020-08-30 22:38:25',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
