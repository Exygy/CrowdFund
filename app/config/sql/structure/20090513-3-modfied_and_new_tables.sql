-- MySQL dump 10.9
--
-- Host: localhost    Database: scexygy_eureka
-- ------------------------------------------------------
-- Server version	4.1.22-standard-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL default '0',
  `address` varchar(128) NOT NULL default '',
  `city` varchar(64) NOT NULL default '',
  `state` varchar(8) NOT NULL default '',
  `zip` int(11) NOT NULL default '0',
  `phone` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` int(11) NOT NULL auto_increment,
  `foreign_id` int(11) NOT NULL default '0',
  `title` varchar(128) NOT NULL default '',
  `description` text NOT NULL,
  `path` text NOT NULL,
  `type` enum('scientist_cv','project_doc') NOT NULL default 'scientist_cv',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `expertises`
--

DROP TABLE IF EXISTS `expertises`;
CREATE TABLE `expertises` (
  `id` int(11) NOT NULL auto_increment,
  `expertise` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL auto_increment,
  `foreign_id` int(11) NOT NULL default '0',
  `type` enum('profile','project') NOT NULL default 'profile',
  `path` varchar(128) NOT NULL default '',
  `description` varchar(128) NOT NULL default '',
  `title` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Table structure for table `interests`
--

DROP TABLE IF EXISTS `interests`;
CREATE TABLE `interests` (
  `id` int(11) NOT NULL auto_increment,
  `interest` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Table structure for table `interests_profiles`
--

DROP TABLE IF EXISTS `interests_profiles`;
CREATE TABLE `interests_profiles` (
  `user_id` int(11) NOT NULL default '0',
  `interest_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`interest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id` int(11) NOT NULL default '0',
  `dob` datetime NOT NULL default '0000-00-00 00:00:00',
  `gender` enum('male','female') NOT NULL default 'male',
  `description` longtext NOT NULL,
  `profession` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `scientist_expertises`
--

DROP TABLE IF EXISTS `scientist_expertises`;
CREATE TABLE `scientist_expertises` (
  `id` int(11) NOT NULL auto_increment,
  `scientist_id` int(11) NOT NULL default '0',
  `expertise_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `scientists`
--

DROP TABLE IF EXISTS `scientists`;
CREATE TABLE `scientists` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `university` text NOT NULL,
  `city` text NOT NULL,
  `state` varchar(8) NOT NULL default '',
  `details` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `fname` varchar(128) NOT NULL default '',
  `lname` varchar(128) NOT NULL default '',
  `email` varchar(128) NOT NULL default '',
  `password` text NOT NULL,
  `type` enum('donor','scientist') NOT NULL default 'donor',
  `active` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

