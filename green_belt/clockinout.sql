CREATE DATABASE  IF NOT EXISTS `clockinout` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `clockinout`;
-- MySQL dump 10.13  Distrib 5.6.13, for osx10.6 (i386)
--
-- Host: 127.0.0.1    Database: clockinout
-- ------------------------------------------------------
-- Server version	5.5.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clocks`
--

DROP TABLE IF EXISTS `clocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `clockintime` datetime DEFAULT NULL,
  `clockouttime` datetime DEFAULT NULL,
  `note` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_clocks_students_idx` (`student_id`),
  CONSTRAINT `fk_clocks_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clocks`
--

LOCK TABLES `clocks` WRITE;
/*!40000 ALTER TABLE `clocks` DISABLE KEYS */;
INSERT INTO `clocks` VALUES (1,1,'2013-11-02 09:58:15','2013-11-02 10:21:09','1st clockin!','2013-11-02 09:58:15','2013-11-02 09:58:15'),(2,1,'2013-11-02 10:25:16','2013-11-02 12:19:15','long clock?','2013-11-02 10:25:16','2013-11-02 10:25:16'),(3,2,'2013-11-02 11:26:35','2013-11-02 11:54:22','testnote','2013-11-02 11:26:35','2013-11-02 11:26:35'),(4,3,'2013-11-02 11:28:54','2013-11-02 11:55:03','clocking out!','2013-11-02 11:28:54','2013-11-02 11:28:54'),(5,8,'2013-11-02 12:01:09','2013-11-02 12:02:32','that was fun','2013-11-02 12:01:09','2013-11-02 12:01:09'),(6,7,'2013-11-02 12:03:11',NULL,NULL,'2013-11-02 12:03:11','2013-11-02 12:03:11'),(7,8,'2013-11-02 12:05:13','2013-11-02 16:39:59','','2013-11-02 12:05:13','2013-11-02 12:05:13'),(8,9,'2013-11-02 12:05:35','2013-11-02 12:05:50','that was my first session!','2013-11-02 12:05:35','2013-11-02 12:05:35'),(9,9,'2013-11-02 12:06:11','2013-11-02 12:06:25','that was my second session!','2013-11-02 12:06:11','2013-11-02 12:06:11'),(10,9,'2013-11-02 12:06:36',NULL,NULL,'2013-11-02 12:06:36','2013-11-02 12:06:36'),(11,1,'2013-11-02 12:23:44','2013-11-02 12:30:01','','2013-11-02 12:23:44','2013-11-02 12:23:44'),(12,4,'2013-11-02 12:30:14',NULL,NULL,'2013-11-02 12:30:14','2013-11-02 12:30:14'),(13,5,'2013-11-02 12:47:57','2013-11-02 12:48:21','that was fun!','2013-11-02 12:47:57','2013-11-02 12:47:57'),(14,8,'2013-11-02 16:40:09',NULL,NULL,'2013-11-02 16:40:09','2013-11-02 16:40:09'),(15,2,'2013-11-06 17:28:42','2013-11-06 17:28:52','','2013-11-06 17:28:42','2013-11-06 17:28:42'),(16,1,'2013-11-09 20:48:04','2013-11-09 20:48:10','','2013-11-09 20:48:04','2013-11-09 20:48:04');
/*!40000 ALTER TABLE `clocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Harry','Potter','2013-11-02 09:56:27','2013-11-02 09:56:27'),(2,'Ron','Weasley','2013-11-02 09:56:41','2013-11-02 09:56:41'),(3,'Hermione','Granger','2013-11-02 09:56:54','2013-11-02 09:56:54'),(4,'Luna','Lovegood','2013-11-02 10:39:48','2013-11-02 10:39:48'),(5,'Ginny','Weasley','2013-11-02 10:40:02','2013-11-02 10:40:02'),(6,'Neville','Longbottom','2013-11-02 10:40:11','2013-11-02 10:40:11'),(7,'Cho','Chang','2013-11-02 10:40:21','2013-11-02 10:40:21'),(8,'Draco','Malfoy','2013-11-02 10:40:36','2013-11-02 10:40:36'),(9,'Dean','Thomas','2013-11-02 10:40:44','2013-11-02 10:40:44'),(10,'Cedric','Diggory','2013-11-02 10:41:10','2013-11-02 10:41:10');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-29 21:02:02
