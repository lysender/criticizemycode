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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug_title` varchar(100) NOT NULL,
  `post_content` text,
  `date_posted` int(10) unsigned NOT NULL,
  `date_modified` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_code`
--

LOCK TABLES `cmc_code` WRITE;
/*!40000 ALTER TABLE `cmc_code` DISABLE KEYS */;
INSERT INTO `cmc_code` VALUES (1,4,'Optimized google +1','optimized-google-plus1','lolcat this is it men\r\n\r\nI could not believe it wrong spelling men?\r\n\r\n~~~\r\necho $this->is->it();\r\n~~~',1315206209,NULL),(2,4,'Kohana intro','kohana-intro','# Upgrading Kohana\n\nThis documentation project started when Kohana 3.0.7 was released. Therefore, all upgrade procedure and notes will be based from that version and up. Every new release, there is always a link on changes made to the latest release. Carefully read them and check if your current application is affected.\n\nThis page is organized in such a way that latest changes appeared on top.\n\nCurrently, there are no changes since we are still up to date.\n\n* __2010-07-12__ - 3.0.7\n	- Kohana update is tracked for the first time.\n\n',1315221510,NULL),(3,4,'Kohana Conventions','kohana-conventions','# Conventions\n\nIt is encouraged to follow Kohana\'s coding style. This uses [BSD/Allman style](http://en.wikipedia.org/wiki/Indent_style#BSD.2FAllman_style) bracing, among other things.\n\n## Class Names and File Location {#classes}\n\nClass names in Kohana follow a strict convention to facilitate [autoloading](using.autoloading). Class names should have uppercase first letters with underscores to separate words. Underscores are significant as they directly reflect the file location in the filesystem.\n\nThe following conventions apply:\n\n1. CamelCased class names should not be used, except when it is undesirable to create a new directory level.\n2. All class file names and directory names are __lowercase__.\n3. All classes should be in the `classes` directory. This may be at any level in the [cascading filesystem](about.filesystem).',1315221745,NULL),(4,4,'Kohana Conventions Revisited','kohana-conventions-revisited','# Conventions\n\nIt is encouraged to follow Kohana\'s coding style. This uses [BSD/Allman style](http://en.wikipedia.org/wiki/Indent_style#BSD.2FAllman_style) bracing, among other things.\n\n## Class Names and File Location {#classes}\n\nClass names in Kohana follow a strict convention to facilitate [autoloading](using.autoloading). Class names should have uppercase first letters with underscores to separate words. Underscores are significant as they directly reflect the file location in the filesystem.\n\nThe following conventions apply:\n\n1. CamelCased class names should not be used, except when it is undesirable to create a new directory level.\n2. All class file names and directory names are __lowercase__.\n3. All classes should be in the `classes` directory. This may be at any level in the [cascading filesystem](about.filesystem).\n\n[!!] Unlike Kohana v2.x, there is no separation between \"controllers\", \"models\", \"libraries\" and \"helpers\". All classes are placed in the \"classes/\" directory, regardless if they are static \"helpers\" or object \"libraries\". You can use whatever kind of class design you want: static, singleton, adapter, etc.\n\n## Examples\n\nRemember that in a class, an underscore means a new directory. Consider the following examples:\n\nClass Name            | File Path\n----------------------|-------------------------------\nController_Template   | classes/controller/template.php\nModel_User            | classes/model/user.php\nDatabase              | classes/database.php\nDatabase_Query        | classes/database/query.php\nForm                  | classes/form.php\n\n## Coding Standards {#coding_standards}\n\nIn order to produce highly consistent source code, we ask that everyone follow the coding standards as closely as possible.\n\n### Brackets\nPlease use [BSD/Allman Style](http://en.wikipedia.org/wiki/Indent_style#BSD.2FAllman_style) bracketing. Example:\n\n	// Recommended\n	if ($total > 0)\n	{\n		$success = true\n	}\n\nThe following code sample of bracket style is not recommended:\n\n	// Not recommended\n	if ($total > 0) {\n		$success = true;\n	}\n\n### Naming Conventions\n\nKohana uses under_score naming, not camelCase naming.\n\n	// Recommended\n	$table_prefix = \'ko_\';\n\n	// Not recommended\n	$tablePrefix = \'ko_\';\n\n	// Not recommended\n	$TablePrefix = \'ko_\';\n\n#### Classes\n\nFirst letter of the word should be upper case. When using multiple words, words are separated by underscore \"_\".\n\n	// Controller class\n	class Controller_Template extends Controller {\n\n	}\n\n	// Another controller class\n	class Controller_Site extends Controller_Template\n	\n	}\n\n	// Model class\n	class Model_User extends Model {\n\n	}\n\n	// Another model class\n	class Model_Product {\n\n	}\n\nWhen creating an instance of a class, don\'t use parentheses if you\'re not passing something on to the constructor:\n\n	// Correct:\n	$db = new User;\n\n	// Incorrect:\n	$db = new User();\n\n#### Functions and Methods\n\nFunctions should be all lowercase, and use under_scores to separate words:\n\n	public function find_user($name)\n	{\n\n	}\n',1315221863,NULL),(5,1,'asdasdad asdasd adasd','asdasdad-asdasd-adasd','asdadasa dasdasd this is lolcat men ano ngayon? asdad asda dasda da dasdasda sda dasdasdadasd asd asdasda',1315403321,NULL);
/*!40000 ALTER TABLE `cmc_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmc_code_comment`
--

DROP TABLE IF EXISTS `cmc_code_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_code_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `cmc_roles`
--

DROP TABLE IF EXISTS `cmc_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_roles`
--

LOCK TABLES `cmc_roles` WRITE;
/*!40000 ALTER TABLE `cmc_roles` DISABLE KEYS */;
INSERT INTO `cmc_roles` VALUES (1,'login','Login privileges, granted after account confirmation'),(2,'admin','Administrative user, has access to everything.'),(3,'janitor','Allowed to delete spam contents'),(4,'moderator','Allowed to edit contents, delete spam ');
/*!40000 ALTER TABLE `cmc_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmc_roles_users`
--

DROP TABLE IF EXISTS `cmc_roles_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`),
  CONSTRAINT `cmc_roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cmc_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cmc_roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `cmc_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_roles_users`
--

LOCK TABLES `cmc_roles_users` WRITE;
/*!40000 ALTER TABLE `cmc_roles_users` DISABLE KEYS */;
INSERT INTO `cmc_roles_users` VALUES (1,1),(4,1),(5,1),(1,2);
/*!40000 ALTER TABLE `cmc_roles_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmc_user_tokens`
--

DROP TABLE IF EXISTS `cmc_user_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `cmc_user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cmc_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_user_tokens`
--

LOCK TABLES `cmc_user_tokens` WRITE;
/*!40000 ALTER TABLE `cmc_user_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmc_user_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmc_users`
--

DROP TABLE IF EXISTS `cmc_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_users`
--

LOCK TABLES `cmc_users` WRITE;
/*!40000 ALTER TABLE `cmc_users` DISABLE KEYS */;
INSERT INTO `cmc_users` VALUES (1,'dc.eros@gmail.com','root','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',36,1315403261),(4,'leonel@lysender.com','lysender','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',3,1315312141),(5,'nice_cris_me@yahoo.com','cris','e1283ececaf7aa84705d8b783991f8f222eeb5eb19e3d428a08adb572f042551',2,1315193042);
/*!40000 ALTER TABLE `cmc_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-09-07 21:51:30
