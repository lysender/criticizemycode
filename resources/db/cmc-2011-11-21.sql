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
-- Table structure for table `cmc_codes`
--

DROP TABLE IF EXISTS `cmc_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_codes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `language_id` int(11) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug_title` varchar(100) NOT NULL,
  `post_content` text,
  `date_posted` int(10) unsigned NOT NULL,
  `date_modified` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  UNIQUE KEY `slug_title` (`slug_title`),
  KEY `user_id` (`user_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_codes`
--

LOCK TABLES `cmc_codes` WRITE;
/*!40000 ALTER TABLE `cmc_codes` DISABLE KEYS */;
INSERT INTO `cmc_codes` VALUES (1,4,16,'Optimized google +1','optimized-google-plus1','lolcat this is it men\r\n\r\nI could not believe it wrong spelling men?\r\n\r\n~~~\r\necho $this->is->it();\r\n~~~',1315206209,NULL),(2,4,16,'Kohana intro','kohana-intro','# Upgrading Kohana\n\nThis documentation project started when Kohana 3.0.7 was released. Therefore, all upgrade procedure and notes will be based from that version and up. Every new release, there is always a link on changes made to the latest release. Carefully read them and check if your current application is affected.\n\nThis page is organized in such a way that latest changes appeared on top.\n\nCurrently, there are no changes since we are still up to date.\n\n* __2010-07-12__ - 3.0.7\n	- Kohana update is tracked for the first time.\n\n',1315221510,NULL),(3,4,16,'Kohana Conventions','kohana-conventions','# Conventions\n\nIt is encouraged to follow Kohana\'s coding style. This uses [BSD/Allman style](http://en.wikipedia.org/wiki/Indent_style#BSD.2FAllman_style) bracing, among other things.\n\n## Class Names and File Location {#classes}\n\nClass names in Kohana follow a strict convention to facilitate [autoloading](using.autoloading). Class names should have uppercase first letters with underscores to separate words. Underscores are significant as they directly reflect the file location in the filesystem.\n\nThe following conventions apply:\n\n1. CamelCased class names should not be used, except when it is undesirable to create a new directory level.\n2. All class file names and directory names are __lowercase__.\n3. All classes should be in the `classes` directory. This may be at any level in the [cascading filesystem](about.filesystem).',1315221745,NULL),(4,4,16,'Kohana Conventions Revisited','kohana-conventions-revisited','# Conventions\n\nIt is encouraged to follow Kohana\'s coding style. This uses [BSD/Allman style](http://en.wikipedia.org/wiki/Indent_style#BSD.2FAllman_style) bracing, among other things.\n\n## Class Names and File Location {#classes}\n\nClass names in Kohana follow a strict convention to facilitate [autoloading](using.autoloading). Class names should have uppercase first letters with underscores to separate words. Underscores are significant as they directly reflect the file location in the filesystem.\n\nThe following conventions apply:\n\n1. CamelCased class names should not be used, except when it is undesirable to create a new directory level.\n2. All class file names and directory names are __lowercase__.\n3. All classes should be in the `classes` directory. This may be at any level in the [cascading filesystem](about.filesystem).\n\n[!!] Unlike Kohana v2.x, there is no separation between \"controllers\", \"models\", \"libraries\" and \"helpers\". All classes are placed in the \"classes/\" directory, regardless if they are static \"helpers\" or object \"libraries\". You can use whatever kind of class design you want: static, singleton, adapter, etc.\n\n## Examples\n\nRemember that in a class, an underscore means a new directory. Consider the following examples:\n\nClass Name            | File Path\n----------------------|-------------------------------\nController_Template   | classes/controller/template.php\nModel_User            | classes/model/user.php\nDatabase              | classes/database.php\nDatabase_Query        | classes/database/query.php\nForm                  | classes/form.php\n\n## Coding Standards {#coding_standards}\n\nIn order to produce highly consistent source code, we ask that everyone follow the coding standards as closely as possible.\n\n### Brackets\nPlease use [BSD/Allman Style](http://en.wikipedia.org/wiki/Indent_style#BSD.2FAllman_style) bracketing. Example:\n\n	// Recommended\n	if ($total > 0)\n	{\n		$success = true\n	}\n\nThe following code sample of bracket style is not recommended:\n\n	// Not recommended\n	if ($total > 0) {\n		$success = true;\n	}\n\n### Naming Conventions\n\nKohana uses under_score naming, not camelCase naming.\n\n	// Recommended\n	$table_prefix = \'ko_\';\n\n	// Not recommended\n	$tablePrefix = \'ko_\';\n\n	// Not recommended\n	$TablePrefix = \'ko_\';\n\n#### Classes\n\nFirst letter of the word should be upper case. When using multiple words, words are separated by underscore \"_\".\n\n	// Controller class\n	class Controller_Template extends Controller {\n\n	}\n\n	// Another controller class\n	class Controller_Site extends Controller_Template\n	\n	}\n\n	// Model class\n	class Model_User extends Model {\n\n	}\n\n	// Another model class\n	class Model_Product {\n\n	}\n\nWhen creating an instance of a class, don\'t use parentheses if you\'re not passing something on to the constructor:\n\n	// Correct:\n	$db = new User;\n\n	// Incorrect:\n	$db = new User();\n\n#### Functions and Methods\n\nFunctions should be all lowercase, and use under_scores to separate words:\n\n	public function find_user($name)\n	{\n\n	}\n',1315221863,NULL),(5,1,16,'asdasdad asdasd adasd','asdasdad-asdasd-adasd','asdadasa dasdasd this is lolcat men ano ngayon? asdad asda dasda da dasdasda sda dasdasdadasd asd asdasda',1315403321,NULL),(6,1,16,'I wanna wish you a merry christmas','i-wanna-wish-you-a-merry-christmas','I wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas\n\nI wanna wish you a merry chirstmas',1315789944,NULL),(7,8,16,'When I was a young boy, my father, brought me into the city, to see a marching band, and let me','when-i-was-a-young-boy-my-father-brought-me-into-the-city-to-see-a-marching-band-and-let-me','When I was a young boy, my father, brought me into the city, to see a marching band, and let me to the summer, to join the black parade...\n\nThat is all I can remember.\n\n    <?php\n        echo \'Hello world\';\n    ?>\n\nSimple as that!',1315799521,1319954495),(8,9,16,'Strong password hashing example','strong-password-hashing-example','Below is a really strong password hashing code in PHP\n\n~~~\n$password = strtoupper($input);\n~~~\n\nThat\'s it',1315804127,NULL),(9,10,16,'My Wicked Authentication snippet','my-wicked-authentication-snippet','Below is my wicked basic authentication in PHP\n\n~~~\nif ($_POST[\'username\'] == \'administrator\' && $_POST[\'password\'] == \'enginemotor\')\n{\n    $_COOKIE[\'logged_in\'] = TRUE;\n    $_COOKIE[\'username\'] = $_POST[\'username\'];\n    $_COOKIE[\'password\'] = $_POST[\'password\'];\n\n    header(\'Location: index,php\');\n}\n~~~\n\nAnd in `index.php` I just check like this:\n\n~~~\nif ($_COOKIE[\'logged_in\'] == TRUE)\n{\n    echo \'Welcome back \'.$_COOKIE[\'username\'];\n}\n~~~\n\nThat\'s it.',1315805422,NULL),(10,7,16,'When two become one','when-two-become-one','When two become one and one become two, how I wonder, whoever did this to you.\n\n~~~\nvar_dump($_SERVER);\n~~~\n\nThe best server hack.',1315806645,NULL),(11,7,16,'Dynamic Gender Library','dynamic-gender-library','Below is my dynamic gender library. It\'s purpose is to let you have a dynamic gender whenever you need it.\n\n',1315807408,NULL),(12,7,16,'Dynamic Gender Library - Naudlot','dynamic-gender-library---naudlot','This is my dynamic gender library that will let you change your gender anytime you want. No discrimination needed.\n\n~~~\n$con = mysql_connect(\'localhost\', \'root\', \'admin123\');\nmysql_select_db(\'website\');\n\n$sql = \"SELECT * FROM gender where status = \'active\' ORDER BY priority ASC\";\n\n$result = mysql_query($sql);\n\necho \'<select name=\"gender\">\';\n\nwhile ($row = mysql_fetch_assoc($result)\n{\n    echo \'<option>\'.$row[\'name\'].\'</option>\';\n}\n\necho \'</select>\';\n~~~\n\nSee, as simple as that, you can change your gender whenever you want.',1315808072,NULL),(13,7,16,'Kohana\'s Order By Column','kohanas-order-by-column','This is the code, it is up to you to judge.\n\n~~~\npublic function order_by($column, $direction = NULL)\n{\n    // Add pending database call which is executed after query type is determined\n    $this->_db_pending[] = array(\n        \'name\' => \'order_by\',\n        \'args\' => array($column, $direction),\n    );\n \n    return $this;\n}\n~~~',1315808191,NULL),(14,7,16,'Once again in a clear blue sky','once-again-in-a-clear-blue-sky','This is the code, it is up to you to judge.\n\n~~~\npublic function order_by($column, $direction = NULL)\n{\n    // Add pending database call which is executed after query type is determined\n    $this->_db_pending[] = array(\n        \'name\' => \'order_by\',\n        \'args\' => array($column, $direction),\n    );\n \n    return $this;\n}\n~~~',1315808240,NULL),(15,4,16,'This is a test','this-is-a-test','This is a sample XSS page\n\n<script>alert(\"XSS\");</script>',1316325217,NULL),(16,4,16,'This is a test for the brand new html purifier','this-is-a-test-for-the-brand-new-html-purifier','For headings\r\n\r\n# h1 here\r\n\r\n## h2 here\r\n\r\n### h3 here\r\n\r\nInline codes here `this` is an inline code\r\n\r\n> This is supposed to be a quote\r\n> also this\r\n\r\nAnd below is a list\r\n\r\n* one\r\n* two\r\n* three\r\n\r\nAnd links (http://www.google.com.ph/)\r\n\r\nAnd sample code\r\n\r\n~~~\r\n$var_dump($_SERVER);\r\n~~~\r\n\r\nweird tag <scr\r\nipt>alert(\"hi\")</scr\r\nipt>\r\n\r\nis that all? <a href=\"javascript:alert(\'hi\');\">Hi lol</a>\r\n\r\nand tha\'s all.',1316328507,NULL),(17,4,16,'Testing the brand new HTMLPurifier','testing-the-brand-new-htmlpurifier','I am posting some really bad XSS code\n\n~~~\n<div>\n    <p>Hi there</p>\n    <a href=\"javascript:alert(\"hi\");\">Click me</a>\n\n    <p>And another one\n        <script>alert(\"stop!\");</script>\n    </p>\n\n    <p style=\"width:expression(alert(\'hi\'));\">And a styled input</p>\n</div>\n~~~',1316329785,NULL),(18,4,16,'Sample stuff with table','sample-stuff-with-table','This is a sample table\r\n\r\nClass Name            | File Path\r\n----------------------|-------------------------------\r\nController_Template   | classes/controller/template.php\r\nModel_User            | classes/model/user.php\r\nDatabase              | classes/database.php\r\nDatabase_Query        | classes/database/query.php\r\nForm                  | classes/form.php',1316330468,NULL),(19,4,16,'Testing strong, em and others','testing-strong-em-and-others','This is to test Markdown and HTMLPurifier for basic inline text formatting like strong and emphasized.\n\nThis text is _emphasized_.\n\nAnd this text is *bolded*',1316392186,NULL),(20,4,25,'Another test for text formatting','another-test-for-text-formatting','Lolcat I really don\'t know top bold things.\n\nTry this __bolded__, **whatever**',1316392538,1316915572),(21,4,18,'Sample Python code','sample-python-code','This should be using python syntax highlighting\r\n\r\n~~~\r\nimport system\r\nimport os\r\nimport threading\r\n\r\ndef run_main:\r\n    x = 12.2\r\n    y = 0\r\n    \r\n    print \'We are at location %s,%s\' % (x, y)\r\n\r\nif __main__ == \'__main__:\r\n    run_main()\r\n~~~',1316396503,NULL),(23,4,12,'Lolcat is the name of the internet','lolcat-is-the-name-of-the-internet','This is a lolcat code, but the site does not allow me to set the langauge to lolcat, therefore, I\'m setting it to JavaScript.\n\n~~~\nfunction($){\n    $(function(){\n        alert(\"Lolcat alert!\");\n    });\n}(jQuery);\n~~~',1316411201,NULL),(24,4,3,'A Sample SlackBuild Script','a-sample-slackbuild-script','Below is a sample SlackBuild script:\n\n~~~\n#!/bin/sh\n\n# Slackware build script for power-architect\n\n# Copyright (c) 2010, Dhaby Xiloj <slack.dhabyx@gmail.com>\n# All rights reserved.\n#\n# Redistribution and use in source and binary forms, with or without\n# modification, are permitted provided that the following conditions are met:\n# 1.- Redistributions of source code must retain the above copyright\n#     notice, this list of conditions and the following disclaimer.\n#\n# THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS\'\' AND ANY\n# EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED\n# WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE\n# DISCLAIMED. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY\n# DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES\n# (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;\n# LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND\n# ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT\n# (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS\n# SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.\n\n# This script is just a binary repackaging.\n\nPRGNAM=power-architect\nVERSION=${VERSION:-1.0.6}\nARCH=noarch\nBUILD=${BUILD:-1}\nTAG=${TAG:-_SBo}\n\nCWD=$(pwd)\nTMP=${TMP:-/tmp/SBo}\nPKG=$TMP/package-$PRGNAM\nOUTPUT=${OUTPUT:-/tmp}\n\nDOCS=\"LICENSE README.generic\"\n\nset -e # Exit on most errors\n\nrm -rf $PKG\nmkdir -p $TMP $PKG $OUTPUT\ncd $TMP\nrm -rf architect-$VERSION\ntar xvf $CWD/Architect-generic-jdbc-$VERSION.tar.gz\ncd architect-$VERSION\nchown -R root:root .\nfind . \\\n \\( -perm 777 -o -perm 775 -o -perm 711 -o -perm 555 -o -perm 511 \\) \\\n -exec chmod 755 {} \\; -o \\\n \\( -perm 666 -o -perm 664 -o -perm 600 -o -perm 444 -o -perm 440 -o -perm 400 \\) \\\n -exec chmod 644 {} \\;\n\nmkdir -p $PKG/opt/$PRGNAM\ncp -R $TMP/architect-$VERSION/* $PKG/opt/$PRGNAM\n\n# Add a script to run power-architect in /usr/bin\nmkdir -p $PKG/usr/bin\ncat << EOF > $PKG/usr/bin/$PRGNAM\n#!/bin/sh\ncd /opt/$PRGNAM\njava -jar architect.jar\nEOF\nchmod 0755 $PKG/usr/bin/$PRGNAM\n\nmkdir -p $PKG/usr/doc/$PRGNAM-$VERSION\ncp -ar $DOCS $PKG/usr/doc/$PRGNAM-$VERSION\ncat $CWD/$PRGNAM.SlackBuild > $PKG/usr/doc/$PRGNAM-$VERSION/$PRGNAM.SlackBuild\n\nmkdir -p $PKG/install\ncat $CWD/slack-desc > $PKG/install/slack-desc\n\ncd $PKG\n/sbin/makepkg -l y -c n $OUTPUT/$PRGNAM-$VERSION-$ARCH-$BUILD$TAG.${PKGTYPE:-tgz}\n\n~~~\n\nThat\'s it.',1316412145,NULL),(25,4,25,'Plain text highlighting','plain-text-highlighting','This is going to be plain text\n\n~~~\n# Turn on URL rewriting\nRewriteEngine On\n\n# Installation directory\nRewriteBase /\n\n# Set environment\nSetEnv KOHANA_ENV \"development\"\n\n# Cache static resource for 1 year\n#<FilesMatch \"\\.(ico|pdf|flv|jpg|jpeg|png|gif|swf|js|css)$\">\n#Header set Cache-Control \"max-age=31536000, public, must-revalidate\"\n#Header set Expires \"Thu, 04 Aug 2011 08:47:32 GMT\"\n#FileETag -INode MTime Size\n#Header unset Last-Modified\n#</FilesMatch>\n\n# Protect hidden files from being viewed\n<Files .*>\n	Order Deny,Allow\n	Deny From All\n</Files>\n\n# BEGIN Page cache\n\n#RewriteRule ^/(.*)/$ /$1 [QSA]\n#RewriteRule ^$ media/pagecache/index.html [QSA]\n#RewriteRule ^([^.]+)/$ media/pagecache/$1/index.html [QSA]\n#RewriteRule ^([^.]+)$ media/pagecache/$1/index.html [QSA]\n\n# END Page cache\n\n# Protect application and system files from being viewed\nRewriteRule ^(?:application|modules|system)\\b.* index.php/$0 [L]\n\n# Allow any files or directories that exist to be displayed directly\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\n\n# Rewrite all other URLs to index.php/URL\nRewriteRule .* index.php/$0 [PT]\n\n~~~',1316414670,NULL),(26,11,6,'Sample C++ Code','sample-cplusplus-code','This is as far as I\'ve remembered.\n\n~~~\n#include <iostream.h>\n\nusing namespace std\n\nint main()\n{\n    // Say something to the standard output\n    cout <<\"Hello world!\\n\";\n    cout <<\"It takes me several days to figure this out...\\n\";\n\n    return 0;\n}\n~~~\n\nI actually pass that subject :D',1316415227,1316424581),(27,11,16,'The code for this page - controller only','the-code-for-this-page---controller-only','Below is the code:\n\n~~~\n<?php defined(\'SYSPATH\') or die(\'No direct access allowed.\');\n/**\n * Code post view page\n *\n */\nclass Controller_Browse_Code extends Controller_Site {\n	\n	/**\n	 * @var Model_Code\n	 */\n	protected $_code;\n	\n	/** \n	 * Initialize markdown environment\n	 */\n	public function before()\n	{\n		parent::before();\n		\n		if (defined(\'MARKDOWN_PARSER_CLASS\'))\n		{\n			throw new Kohana_Exception(\'Markdown parser already registered. Live documentation will not work in your environment.\');\n		}\n\n		if ( ! class_exists(\'Markdown\', FALSE))\n		{\n			// Load Markdown support\n			require Kohana::find_file(\'vendor\', \'markdown/markdown\');\n		}\n		\n		$this->template->styles[\'media/css/code.css\'] = \'all\';\n		$this->template->styles[\'media/sh/styles/shCore.css\'] = \'screen\';\n		$this->template->styles[\'media/sh/styles/shThemeRDark.css\'] = \'screen\';\n\n		$this->template->scripts[] = \'media/js/code.js\';\n		$this->template->scripts[] = \'media/sh/scripts/shCore.js\';\n	}\n	\n	/**\n	 * Code view page\n	 *\n	 */\n	public function action_index()\n	{\n		$this->_check_request();\n		\n		$this->template->title = $this->_code->title;\n		$this->view = View::factory(\'browse/code/index\');\n		\n		$this->template->scripts[] = \'media/sh/scripts/shBrush\'.$this->_code->language->name.\'.js\';\n		\n		$this->view->code = $this->_code;\n		\n		$purifier = new Purifier_Post;\n		$this->view->marked_up_content = $purifier->purify(Markdown($this->_code->post_content));\n	}\n	\n	/**\n	 * Checks the request if valid\n	 */\n	protected function _check_request()\n	{\n		// Retrieve code post\n		$id = $this->request->param(\'id\');\n		$slug = $this->request->param(\'slug\');\n		\n		if (empty($id) || empty($slug))\n		{\n			$this->session->set(\'error_message\', \'Code post not found\');\n			$this->request->redirect(\'/\');\n		}\n		\n		$this->_code = ORM::factory(\'code\', array(\n			\'id\' => $id,\n			\'slug_title\' => $slug\n		));\n		\n		if ( ! $this->_code->loaded())\n		{\n			$this->session->set(\'error_message\', \'Code post not found\');\n			$this->request->redirect(\'/\');\n		}\n	}\n}\n\n~~~',1316415400,NULL),(28,11,16,'The code for this page - controller only - edited edition','the-code-for-this-page---controller-only-edited-eidition','Below is the code:\n\n~~~\n<?php defined(\'SYSPATH\') or die(\'No direct access allowed.\');\n/**\n * Code post view page\n *\n */\nclass Controller_Browse_Code extends Controller_Site {\n	\n	/**\n	 * The coed model, you know\n	 * \n	 * @var Model_Code\n	 */\n	protected $_code;\n	\n	/** \n	 * Initialize markdown environment\n	 */\n	public function before()\n	{\n		parent::before();\n		\n		if (defined(\'MARKDOWN_PARSER_CLASS\'))\n		{\n			throw new Kohana_Exception(\'Markdown parser already registered. Live documentation will not work in your environment.\');\n		}\n\n		if ( ! class_exists(\'Markdown\', FALSE))\n		{\n			// Load Markdown support\n			require Kohana::find_file(\'vendor\', \'markdown/markdown\');\n		}\n		\n		$this->template->styles[\'media/css/code.css\'] = \'all\';\n		$this->template->styles[\'media/sh/styles/shCore.css\'] = \'screen\';\n		$this->template->styles[\'media/sh/styles/shThemeRDark.css\'] = \'screen\';\n\n		$this->template->scripts[] = \'media/js/code.js\';\n		$this->template->scripts[] = \'media/sh/scripts/shCore.js\';\n	}\n	\n	/**\n	 * Code view page\n	 *\n	 */\n	public function action_index()\n	{\n		$this->_check_request();\n		\n		$this->template->title = $this->_code->title;\n		$this->view = View::factory(\'browse/code/index\');\n		\n		$this->template->scripts[] = \'media/sh/scripts/shBrush\'.$this->_code->language->name.\'.js\';\n		\n		$this->view->code = $this->_code;\n		\n		$purifier = new Purifier_Post;\n		$this->view->marked_up_content = $purifier->purify(Markdown($this->_code->post_content));\n	}\n	\n	/**\n	 * Checks the request if valid\n	 */\n	protected function _check_request()\n	{\n		// Retrieve code post\n		$id = $this->request->param(\'id\');\n		$slug = $this->request->param(\'slug\');\n		\n		if (empty($id) || empty($slug))\n		{\n			$this->session->set(\'error_message\', \'Code post not found\');\n			$this->request->redirect(\'/\');\n		}\n		\n		$this->_code = ORM::factory(\'code\', array(\n			\'id\' => $id,\n			\'slug_title\' => $slug\n		));\n		\n		if ( ! $this->_code->loaded())\n		{\n			$this->session->set(\'error_message\', \'Code post not found\');\n			$this->request->redirect(\'/\');\n		}\n	}\n}\n\n~~~\n\nThat\'s it',1316422922,1316433921),(29,1,18,'I am the root of all','i-am-the-root-of-all','Sample python code\n\n~~~\nimport system\nimport os\nimport threading\nimport re\n\nclass Stuff:\n    def foo(self, value):\n        print \'Passing value %s\' % value\n\n    def bar(self, value):\n        self.foo(value)\n\n\nif __name__ == \'__main__\':\n    st = Stuff()\n    st.bar(\'blah blah blah\')\n~~~\n\nThat\'s it!',1316434312,NULL),(30,1,22,'Sample inner join in MySQL','sample-inner-join-in-mysql','~~~~\nSELECT\n    m.*,\n    mm.*\nFROM\n    make m\nINNER JOIN\n    model mm\nON\n    m.make_id = mm.model_id\nORDER BY\n    m.make_name ASC;\n\n~~~~',1316780753,1316780793),(33,4,25,'test post 001 - 002','test-post-001---002','You can use Markdown syntax to format your post. For more information, click here.You can use Markdown syntax to format your post. For more information, click here.You can use Markdown syntax to format your post. For more information, click here.You can use Markdown syntax to format your post. For more information, click here.You can use Markdown syntax to format your post. For more information, click here.\n\nCool',1318735789,1318736233),(34,4,16,'I am the root of all that\'s all','i-am-the-root-of-all-thats-all','This is it menThis is it menThis is it menThis is it menThis is it menThis is it menThis is it menThis is it menThis is it menThis is it men\n\n~~~\n<div class=\"block\">\n    <div class=\"lbl\">\n        <label for=\"username\">Username</label>\n    </div>\n    <div class=\"input\">\n        <input type=\"text\" name=\"username\" value=\"<?php echo $f[\'username\'] ?>\" />\n    </div>\n</div>\n\n<?php if (isset($multi) && $multi): ?>\n    <p>This is multi...</p>\n<?php endif ?>\n~~~',1318745989,1318817957),(35,4,18,'This is a malicious post men','this-is-a-malicious-post-men','Yes this is malicious, scandalous, I love the scandal.\n\n~~~\nimport os\nimport system\n\ndef run_main():\n    print \'Hello world!\'\n\nif __name__ == \'__main__\':\n    run_main()\n~~~',1318821534,1318827155),(37,12,25,'This is a malicious post men 2','this-is-a-malicious-post-men-2','This is a malicious post menThis is a malicious post menThis is a malicious post menThis is a malicious post menThis is a malicious post menThis is a malicious post menThis is a malicious post menThis is a malicious post menThis is a malicious post menThis is a malicious post menThis is a malicious post menThis is a malicious post men',1318832021,NULL),(38,16,25,'This is from lolcat universe','this-is-from-lolcat-universe','Yeah, I\'m really not into spelling things correctly.',1318833278,NULL),(39,1,25,'CriticizeMyCode.com is an online community','criticizemycode-com-is-an-online-community','CriticizeMyCode.com is an online community who showcase the best, worst and most wicked codes ever written.\n\nIt\'s ultimate goal is to tell what\'s the best practice, what is wrong and what should be the right for solving a certain problem.\n\nFear not to show your code!\n\nTo write codes, indent the line with 4 spaces.\nAlternatively, you can also wrap them inside ~~~ where each ~~~ is on a single line.\nFor inline codes, use back ticks (`).\nWrap with single underscore or asterisk for emphasized texts like *emphasized* or _also emphasized_.\nWrap with double underscore or asterisk for bolded texts like **bolded** or __also bolded__.\nFor lists, use asterisk in front of each item on a list (*), be sure to put a single space before the text.\nFor other Markdown syntax allowed, click here.',1318833423,NULL),(40,4,25,'Hello My Friends, we are having a new theme','hello-my-friends-we-are-having-a-new-theme','CriticizeMyCode.com is an online community who showcase the best, worst and most wicked codes ever written.\n\nIt\'s ultimate goal is to tell what\'s the best practice, what is wrong and what should be the right for solving a certain problem.\n\nFear not to show your code!\n\nCriticizeMyCode.com is an online community who showcase the best, worst and most wicked codes ever written.\n\nIt\'s ultimate goal is to tell what\'s the best practice, what is wrong and what should be the right for solving a certain problem.\n\nFear not to show your code!',1319463776,NULL),(41,8,16,'The Singleton Pattern','the-singleton-pattern','The Singleton pattern says that there will be only 1 instance of the class and no other. An analogy goes like this:\n\n> Singleton is like the highlander, \"There can be only one\"...\n<small>cruizer</small>\n\n~~~\n<?php\n\nclass Burf {\n    protected static $_instance;\n\n    protected function __construct()\n    {\n        // Burf here\n    }\n\n    public static function instance()\n    {\n        // Instance generator here\n    }\n}\n~~~',1320027494,1320031852);
/*!40000 ALTER TABLE `cmc_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmc_comments`
--

DROP TABLE IF EXISTS `cmc_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `comment` text NOT NULL,
  `date_posted` int(10) unsigned NOT NULL,
  `date_modified` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code_id` (`code_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_comments`
--

LOCK TABLES `cmc_comments` WRITE;
/*!40000 ALTER TABLE `cmc_comments` DISABLE KEYS */;
INSERT INTO `cmc_comments` VALUES (1,21,4,'Lolcat, this is why python rocks',1317012004,NULL),(2,21,4,'Test comment',1317013664,NULL),(3,21,4,'locat comment men',1317013685,NULL),(4,21,4,'another test comment',1317013790,NULL),(5,21,4,'This comment rocks men',1317013877,NULL),(6,21,4,'Another bunch of comments',1317013918,NULL),(7,21,4,'This rocks men\n\n<a href=\"lol\">Ahehehe</a>',1317015067,NULL),(8,21,4,'This is a sample comment with language post\n\n~~~\nsudo rm -rf\n~~~',1317015372,NULL),(9,21,4,'with php code\n\n~~~\n<?php\n    var_dump($_SERVER);\n?>\n~~~',1317015461,NULL),(10,25,1,'y u no syntax highlighting in comments!!!!',1317017357,NULL),(11,25,1,'Y u no refresh on post',1317017389,NULL),(12,25,1,'y u not clear form after submit comment!!!',1317017527,NULL),(13,25,1,'Lolcat this is another burf',1317017972,NULL),(14,21,4,'~~~\npython -c xxx\n~~~',1317020635,NULL),(15,30,4,'I would rather do:\n\n~~~\nSELECT CONCAT(...\n~~~',1317020702,NULL),(16,29,4,'Well, that\'s python, whatever',1317020805,NULL),(17,29,1,'> Well, that\'s python, whatever\n\nWhatever floats your boat.',1317020868,NULL),(18,29,4,'This is blasphemy!',1317020903,NULL),(19,29,1,'This is truth!!!!!!!!!',1317020914,NULL),(20,28,4,'Pangit ng code mo pre! :D',1317129605,NULL),(21,28,4,'Di nga pre?',1317129619,NULL),(22,30,4,'What are you waiting for!',1317901370,NULL),(23,30,4,'This werks!',1318425299,NULL),(24,34,4,'test test test',1318746014,NULL),(25,34,4,'test test test test',1318746026,NULL),(26,34,1,'o snap it\'s not working!',1318749827,NULL),(27,34,4,'This is with some codes\n\n~~~\n<?php\n    echo \'Hello world\';\n?>\n~~~',1318750378,NULL),(28,34,4,'* To write codes, indent the line with 4 spaces.\n* Alternatively, you can also wrap them inside ~~~ where each ~~~ is on a single line.\n* For inline codes, use back ticks (`).\nWrap with single underscore or asterisk for emphasized texts like *emphasized* or _also emphasized_.\n* Wrap with double underscore or asterisk for bolded texts like **bolded** or __also bolded__.\n* For lists, use asterisk in front of each item on a list (*), be sure to put a single space before the text.\n* For other Markdown syntax allowed, click here.',1318750508,NULL),(29,34,4,'<blockquote>\nI don;\'t think so...\n</blockquote>\n\nThis is it...',1318750564,NULL),(30,34,4,'this\nis\nthe\nway\nit\nis',1318751106,NULL),(31,34,1,'Whoah! There was a bug on fuzzy span method :D',1318770822,NULL),(32,34,1,'this is it men, cool and stupid',1318770925,NULL),(33,34,1,'test again, using github\'s flavor of fuzzy span',1318771299,NULL),(34,34,4,'I miss my python code men',1318816910,NULL),(35,34,4,'Rewriting stuff:\n\n~~~\n<div class=\"block\">\n    <div class=\"lbl\">\n        <label for=\"username\">Username</label>\n    </div>\n    <div class=\"input\">\n        <input type=\"text\" name=\"username\" value=\"<?php echo $f[\'username\'] ?>\" />\n    </div>\n</div>\n \n<?php if (isset($multi) && $multi): ?>\n    <p>This is multi...</p>\n<?php endif ?>\n~~~',1318819571,NULL),(36,24,4,'This is power architect. To run, simply type as root:\n\n~~~\n./power-architect.SlackBuild\n~~~',1318820115,NULL),(37,35,4,'Okay, This is my comment, are we good?',1318827803,NULL),(38,35,4,'I think we\'re good for launch!',1318827821,NULL),(39,35,4,'Again, testing comment returns\n',1318828052,NULL),(40,35,4,'Testing a couple of codes...\n\n~~~\ndef run_main(str1, str2):\n    print \'Hello %s, %s\' % (str1, str2)\n\nif __name__ == \'__main__\':\n    run_main(\'Lysender\', \'Dc Eros\')\n~~~',1318828361,NULL),(41,4,4,'This is something I feel natural when using Kohana framework.',1318828877,NULL),(42,4,4,'Yeah right, now what?',1318828890,NULL),(43,35,4,'                                                ',1318832131,NULL),(44,37,12,'this is a weird comment',1318832158,NULL),(45,38,16,'Opps, is it possible to edit this post?',1318833294,NULL),(46,38,16,'Can find the edit button!!!',1318833302,NULL),(47,34,4,'This is my quest, to follow that star!',1319462478,NULL),(48,34,4,'No matter how hopeless, no matter how far...\n\n~~~\n<?php\n    phpinfo();\n?>\n~~~',1319462514,NULL),(49,34,4,'This is my quest!',1319462667,NULL),(50,34,4,'Okay, fine, here is the longer version.',1319463660,NULL),(51,34,4,'Tired of so many bugs...',1319463715,NULL),(52,34,4,'Aain ang again',1319463723,NULL),(53,40,4,'May comments ba jan?',1319463789,NULL),(54,40,8,'Here is my awesome comment, do you like it?',1319953813,NULL),(55,7,8,'Speechless or nor?',1319954532,NULL),(56,7,8,'Of course not!',1319954539,NULL),(57,41,8,'The font looks so odd.',1320027986,NULL),(58,41,8,'But I\'m not a designer anyway.',1320028001,NULL),(59,41,8,'It is better to name it `getInstance` instead like this:\n\n~~~\npublic static function getInstance()\n{\n\n}\n~~~\n\nZF Style.',1320028049,NULL),(60,41,1,'Lol, commenting fail',1320156224,NULL);
/*!40000 ALTER TABLE `cmc_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmc_languages`
--

DROP TABLE IF EXISTS `cmc_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_languages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(12) NOT NULL,
  `label` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_languages`
--

LOCK TABLES `cmc_languages` WRITE;
/*!40000 ALTER TABLE `cmc_languages` DISABLE KEYS */;
INSERT INTO `cmc_languages` VALUES (1,'AS3','AS3'),(2,'AppleScript','AppleScript'),(3,'Bash','Bash'),(4,'CSharp','C#'),(5,'ColdFusion','ColdFusion'),(6,'Cpp','C++'),(7,'Css','CSS'),(8,'Delphi','Delphi'),(9,'Diff','Diff'),(10,'Erlang','Erlang'),(11,'Groovy','Groovy'),(12,'JScript','JavaScript'),(13,'Java','Java'),(14,'JavaFX','JavaFX'),(15,'Perl','Perl'),(16,'Php','PHP'),(17,'PowerShell','PowerShell'),(18,'Python','Python'),(19,'Ruby','Ruby'),(20,'Sass','SASS'),(21,'Scala','Scala'),(22,'Sql','SQL'),(23,'Vb','VB'),(24,'Xml','XML'),(25,'Plain','Plain Text');
/*!40000 ALTER TABLE `cmc_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmc_openconnect`
--

DROP TABLE IF EXISTS `cmc_openconnect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmc_openconnect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `third_party_name` varchar(10) NOT NULL,
  `third_party_identifier` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `third_party_name_identifier` (`third_party_name`,`third_party_identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_openconnect`
--

LOCK TABLES `cmc_openconnect` WRITE;
/*!40000 ALTER TABLE `cmc_openconnect` DISABLE KEYS */;
INSERT INTO `cmc_openconnect` VALUES (1,20,'facebook','1254952811'),(2,21,'facebook','1049650845');
/*!40000 ALTER TABLE `cmc_openconnect` ENABLE KEYS */;
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
INSERT INTO `cmc_roles_users` VALUES (1,1),(4,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(20,1),(21,1),(1,2);
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
  `password` varchar(64) DEFAULT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  `date_registered` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`),
  KEY `date_registered` (`date_registered`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmc_users`
--

LOCK TABLES `cmc_users` WRITE;
/*!40000 ALTER TABLE `cmc_users` DISABLE KEYS */;
INSERT INTO `cmc_users` VALUES (1,'dc.eros2@gmail.com','root','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',63,1321247405,0),(4,'leonel@lysender.com','lysender','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',34,1321164731,0),(6,'jig_saw@gmail.com','jig_saw','c71fdcf7796ac120a35f3f05237521b890b3d5b8f092f209dc7f3c9905e50b33',2,1315792459,0),(7,'two@become.com','twobecomeone','9d7cc59d9fad1983622b746a4275335d63303cfb81c56ce63d360f639da8a1fd',2,1315806471,0),(8,'welcome@rotonda.com','welcome','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',10,1320136325,0),(9,'welcome2@rotonda.com','welcome2','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',3,1315801345,0),(10,'welcome3@rotonda.com','welcome3','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',2,1315805109,0),(11,'welcome4@yahoo.com','welcome4','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',2,1316415144,0),(12,'lysenderbot@gmail.com','lysenderbot','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',1,1318829050,0),(13,'botter@lysender.com','botter','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',1,1319443716,0),(14,'lolcat@zend.com','lolcat','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',1,1321166355,1321166354),(15,'botbot@zend.com','botbot','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',2,1321170574,1321169819),(16,'bot1@zend.com','bot1','9e479c59dfad6c32bbcd17ba30a4bfedfad9469751193f03ff2fa95c83689a79',1,1321173376,1321173375),(20,'dc.eros@gmail.com','dceros','ed901982db012bed89f2733da87c2a24214d023988ae1364fb3a77c8e5e4b7c9',4,1321875662,0),(21,'nice_cris_me@yahoo.com','nice_cris_me','1ea4db8d0f2885ec6d9a04717a07ca828f3069050f458790d4d9365499f727e0',2,1321877006,0);
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

-- Dump completed on 2011-11-21 20:14:41
