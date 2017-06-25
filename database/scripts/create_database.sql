-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2017 at 02:27 PM
-- Server version: 10.1.22-MariaDB-cll-lve
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `jareygec_socialnetwork`
--
CREATE DATABASE IF NOT EXISTS `socialnetwork` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `socialnetwork`;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `userid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` char(255) NOT NULL DEFAULT '',
  `password` char(255) NOT NULL DEFAULT '',
  `online` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `recipientid` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` varchar(500) DEFAULT NULL,
  `private` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ext` char(3) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `width` int(11) unsigned NOT NULL,
  `height` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE IF NOT EXISTS `relations` (
  `userid1` int(11) NOT NULL DEFAULT '0',
  `userid2` int(11) NOT NULL DEFAULT '0',
  `relation` smallint(1) DEFAULT '0',
  PRIMARY KEY (`userid1`,`userid2`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='0 = userid1 requesting userid2 - 1 = userid2 requesting user';

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `schoolid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(255) DEFAULT NULL,
  PRIMARY KEY (`schoolid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=397 ;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `userid` int(11) unsigned NOT NULL,
  `nickname` char(128) DEFAULT NULL,
  `fname` char(128) NOT NULL DEFAULT '',
  `mname` char(128) DEFAULT NULL,
  `lname` char(128) NOT NULL DEFAULT '',
  `gender` char(1) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `phonenum` char(11) DEFAULT NULL,
  `schoolid` int(11) DEFAULT NULL,
  `employerid` int(11) DEFAULT NULL,
  `addressline1` char(255) DEFAULT NULL,
  `addressline2` char(255) DEFAULT NULL,
  `city` char(60) DEFAULT NULL,
  `state` char(60) DEFAULT NULL,
  `postalcode` int(11) DEFAULT NULL,
  `defaultpicid` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;