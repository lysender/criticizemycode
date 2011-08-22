-- MySQL dump 10.13  Distrib 5.1.56, for slackware-linux-gnu (i486)
--
-- Host: localhost    Database: cmc
-- ------------------------------------------------------
-- Server version	5.1.56-log

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
-- Table structure for table `cmc_code`
--

DROP TABLE IF EXISTS `cmc_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `code` text NOT NULL,
  `date_posted` int(10) unsigned NOT NULL,
  `date_modified` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_code`
--

LOCK TABLES `cmc_code` WRITE;
/*!40000 ALTER TABLE `cmc_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmc_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmc_code_comment`
--

DROP TABLE IF EXISTS `cmc_code_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_code_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `date_posted` int(10) unsigned NOT NULL,
  `date_modified` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code_id` (`code_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_code_comment`
--

LOCK TABLES `cmc_code_comment` WRITE;
/*!40000 ALTER TABLE `cmc_code_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmc_code_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmc_language`
--

DROP TABLE IF EXISTS `cmc_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_language`
--

LOCK TABLES `cmc_language` WRITE;
/*!40000 ALTER TABLE `cmc_language` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmc_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmc_token`
--

DROP TABLE IF EXISTS `cmc_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_token` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `user_agent` varchar(64) NOT NULL,
  `token` int(32) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_token`
--

LOCK TABLES `cmc_token` WRITE;
/*!40000 ALTER TABLE `cmc_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmc_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmc_user`
--

DROP TABLE IF EXISTS `cmc_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nickname` varchar(16) NOT NULL,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_registered` int(10) unsigned NOT NULL,
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_user`
--

LOCK TABLES `cmc_user` WRITE;
/*!40000 ALTER TABLE `cmc_user` DISABLE KEYS */;
INSERT INTO `cmc_user` VALUES (2,'dc.eros@gmail.com','77f5375503481c16e8cef91a9c5217ac370903c525cdf9d6360f4df9bffe6c92','Lysender',0,1313990598,NULL);
/*!40000 ALTER TABLE `cmc_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-08-22 20:17:58
