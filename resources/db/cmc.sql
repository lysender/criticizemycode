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
-- Table structure for table `cmc_codes`
--

DROP TABLE IF EXISTS `cmc_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_codes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug_title` varchar(100) NOT NULL,
  `post_content` text,
  `date_posted` int(10) unsigned NOT NULL,
  `date_modified` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_codes`
--

LOCK TABLES `cmc_codes` WRITE;
/*!40000 ALTER TABLE `cmc_codes` DISABLE KEYS */;
INSERT INTO `cmc_codes` VALUES (1,4,'Optimized google +1','optimized-google-plus1','lolcat this is it men\r\n\r\nI could not believe it wrong spelling men?\r\n\r\n~~~\r\necho $this->is->it();\r\n~~~',1315206209,NULL),(2,4,'Kohana intro','kohana-intro','# Upgrading Kohana\n\nThis documentation project started when Kohana 3.0.7 was released. Therefore, all upgrade procedure and notes will be based from that version and up. Every new release, there is always a link on changes made to the latest release. Carefully read them and check if your current application is affected.\n\nThis page is organized in such a way that latest changes appeared on top.\n\nCurrently, there are no changes since we are still up to date.\n\n* __2010-07-12__ - 3.0.7\n	- Kohana update is tracked for the first time.\n\n',1315221510,NULL),(3,4,'Kohana Conventions','kohana-conventions','# Conventions\n\nIt is encouraged to follow Kohana\'s coding style. This uses [BSD/Allman style](http://en.wikipedia.org/wiki/Indent_style#BSD.2FAllman_style) bracing, among other things.\n\n## Class Names and File Location {#classes}\n\nClass names in Kohana follow a strict convention to facilitate [autoloading](using.autoloading). Class names should have uppercase first letters with underscores to separate words. Underscores are significant as they directly reflect the file location in the filesystem.\n\nThe following conventions apply:\n\n1. CamelCased class names should not be used, except when it is undesirable to create a new directory level.\n2. All class file names and directory names are __lowercase__.\n3. All classes should be in the `classes` directory. This may be at any level in the [cascading filesystem](about.filesystem).',1315221745,NULL),(4,4,'Kohana Conventions Revisited','kohana-conventions-revisited','# Conventions\n\nIt is encouraged to follow Kohana\'s coding style. This uses [BSD/Allman style](http://en.wikipedia.org/wiki/Indent_style#BSD.2FAllman_style) bracing, among other things.\n\n## Class Names and File Location {#classes}\n\nClass names in Kohana follow a strict convention to facilitate [autoloading](using.autoloading). Class names should have uppercase first letters with underscores to separate words. Underscores are significant as they directly reflect the file location in the filesystem.\n\nThe following conventions apply:\n\n1. CamelCased class names should not be used, except when it is undesirable to create a new directory level.\n2. All class file names and directory names are __lowercase__.\n3. All classes should be in the `classes` directory. This may be at any level in the [cascading filesystem](about.filesystem).\n\n[!!] Unlike Kohana v2.x, there is no separation between \"controllers\", \"models\", \"libraries\" and \"helpers\". All classes are placed in the \"classes/\" directory, regardless if they are static \"helpers\" or object \"libraries\". You can use whatever kind of class design you want: static, singleton, adapter, etc.\n\n## Examples\n\nRemember that in a class, an underscore means a new directory. Consider the following examples:\n\nClass Name            | File Path\n----------------------|-------------------------------\nController_Template   | classes/controller/template.php\nModel_User            | classes/model/user.php\nDatabase              | classes/database.php\nDatabase_Query        | classes/database/query.php\nForm                  | classes/form.php\n\n## Coding Standards {#coding_standards}\n\nIn order to produce highly consistent source code, we ask that everyone follow the coding standards as closely as possible.\n\n### Brackets\nPlease use [BSD/Allman Style](http://en.wikipedia.org/wiki/Indent_style#BSD.2FAllman_style) bracketing. Example:\n\n	// Recommended\n	if ($total > 0)\n	{\n		$success = true\n	}\n\nThe following code sample of bracket style is not recommended:\n\n	// Not recommended\n	if ($total > 0) {\n		$success = true;\n	}\n\n### Naming Conventions\n\nKohana uses under_score naming, not camelCase naming.\n\n	// Recommended\n	$table_prefix = \'ko_\';\n\n	// Not recommended\n	$tablePrefix = \'ko_\';\n\n	// Not recommended\n	$TablePrefix = \'ko_\';\n\n#### Classes\n\nFirst letter of the word should be upper case. When using multiple words, words are separated by underscore \"_\".\n\n	// Controller class\n	class Controller_Template extends Controller {\n\n	}\n\n	// Another controller class\n	class Controller_Site extends Controller_Template\n	\n	}\n\n	// Model class\n	class Model_User extends Model {\n\n	}\n\n	// Another model class\n	class Model_Product {\n\n	}\n\nWhen creating an instance of a class, don\'t use parentheses if you\'re not passing something on to the constructor:\n\n	// Correct:\n	$db = new User;\n\n	// Incorrect:\n	$db = new User();\n\n#### Functions and Methods\n\nFunctions should be all lowercase, and use under_scores to separate words:\n\n	public function find_user($name)\n	{\n\n	}\n',1315221863,NULL),(5,1,'asdasdad asdasd adasd','asdasdad-asdasd-adasd','asdadasa dasdasd this is lolcat men ano ngayon? asdad asda dasda da dasdasda sda dasdasdadasd asd asdasda',1315403321,NULL),(6,1,'I wanna wish you a merry christmas','i-wanna-wish-you-a-merry-christmas','I wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas',1315789944,NULL),(7,8,'When I was a young boy, my father, brought me into the city, to see a marching band, and let me','when-i-was-a-young-boy-my-father-brought-me-into-the-city-to-see-a-marching-band-and-let-me','When I was a young boy, my father, brought me into the city, to see a marching band, and let me to the summer, to join the black parade',1315799521,NULL),(8,9,'Strong password hashing example','strong-password-hashing-example','Below is a really strong password hashing code in PHP\n\n~~~\n$password = strtoupper($input);\n~~~\n\nThat\'s it',1315804127,NULL),(9,10,'My Wicked Authentication snippet','my-wicked-authentication-snippet','Below is my wicked basic authentication in PHP\n\n~~~\nif ($_POST[\'username\'] == \'administrator\' && $_POST[\'password\'] == \'enginemotor\')\n{\n    $_COOKIE[\'logged_in\'] = TRUE;\n    $_COOKIE[\'username\'] = $_POST[\'username\'];\n    $_COOKIE[\'password\'] = $_POST[\'password\'];\n\n    header(\'Location: index,php\');\n}\n~~~\n\nAnd in `index.php` I just check like this:\n\n~~~\nif ($_COOKIE[\'logged_in\'] == TRUE)\n{\n    echo \'Welcome back \'.$_COOKIE[\'username\'];\n}\n~~~\n\nThat\'s it.',1315805422,NULL),(10,7,'When two become one','when-two-become-one','When two become one and one become two, how I wonder, whoever did this to you.\n\n~~~\nvar_dump($_SERVER);\n~~~\n\nThe best server hack.',1315806645,NULL),(11,7,'Dynamic Gender Library','dynamic-gender-library','Below is my dynamic gender library. It\'s purpose is to let you have a dynamic gender whenever you need it.\n\n',1315807408,NULL),(12,7,'Dynamic Gender Library - Naudlot','dynamic-gender-library---naudlot','This is my dynamic gender library that will let you change your gender anytime you want. No discrimination needed.\n\n~~~\n$con = mysql_connect(\'localhost\', \'root\', \'admin123\');\nmysql_select_db(\'website\');\n\n$sql = \"SELECT * FROM gender where status = \'active\' ORDER BY priority ASC\";\n\n$result = mysql_query($sql);\n\necho \'<select name=\"gender\">\';\n\nwhile ($row = mysql_fetch_assoc($result)\n{\n    echo \'<option>\'.$row[\'name\'].\'</option>\';\n}\n\necho \'</select>\';\n~~~\n\nSee, as simple as that, you can change your gender whenever you want.',1315808072,NULL),(13,7,'Kohana\'s Order By Column','kohanas-order-by-column','This is the code, it is up to you to judge.\n\n~~~\npublic function order_by($column, $direction = NULL)\n{\n    // Add pending database call which is executed after query type is determined\n    $this->_db_pending[] = array(\n        \'name\' => \'order_by\',\n        \'args\' => array($column, $direction),\n    );\n \n    return $this;\n}\n~~~',1315808191,NULL),(14,7,'Once again in a clear blue sky','once-again-in-a-clear-blue-sky','This is the code, it is up to you to judge.\n\n~~~\npublic function order_by($column, $direction = NULL)\n{\n    // Add pending database call which is executed after query type is determined\n    $this->_db_pending[] = array(\n        \'name\' => \'order_by\',\n        \'args\' => array($column, $direction),\n    );\n \n    return $this;\n}\n~~~',1315808240,NULL);
/*!40000 ALTER TABLE `cmc_codes` ENABLE KEYS */;
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
INSERT INTO `cmc_roles_users` VALUES (1,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(1,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_users`
--

LOCK TABLES `cmc_users` WRITE;
/*!40000 ALTER TABLE `cmc_users` DISABLE KEYS */;
INSERT INTO `cmc_users` VALUES (1,'dc.eros@gmail.com','root','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',38,1315789763),(4,'leonel@lysender.com','lysender','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',5,1315835334),(5,'nice_cris_me@yahoo.com','cris','e1283ececaf7aa84705d8b783991f8f222eeb5eb19e3d428a08adb572f042551',2,1315193042),(6,'jig_saw@gmail.com','jig_saw','c71fdcf7796ac120a35f3f05237521b890b3d5b8f092f209dc7f3c9905e50b33',2,1315792459),(7,'two@become.com','twobecomeone','9d7cc59d9fad1983622b746a4275335d63303cfb81c56ce63d360f639da8a1fd',2,1315806471),(8,'welcome@rotonda.com','welcome','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',2,1315798726),(9,'welcome2@rotonda.com','welcome2','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',3,1315801345),(10,'welcome3@rotonda.com','welcome3','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',2,1315805109),(11,'welcome4@yahoo.com','welcome4','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',1,1315805687);
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

-- Dump completed on 2011-09-12 21:53:36
