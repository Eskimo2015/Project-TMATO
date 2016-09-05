-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2016 at 01:28 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmato`
--
CREATE DATABASE IF NOT EXISTS `tmato` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tmato`;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(6) NOT NULL AUTO_INCREMENT,
  `u_fname` varchar(24) NOT NULL,
  `u_lname` varchar(24) NOT NULL,
  `u_dob` varchar(32) NOT NULL,
  `u_email` varchar(32) NOT NULL,
  `u_name` varchar(12) NOT NULL,
  `u_pword` varchar(12) NOT NULL,
  `u_creationdate` timestamp NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_name` (`u_name`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_fname`, `u_lname`, `u_dob`, `u_email`, `u_name`, `u_pword`, `u_creationdate`) VALUES
(1, 'Fred', 'Flintstone', '0251234567', 'fred.flintstone@bedrock.com', 'Prehistoric', 'Prehistoric', '2016-09-01 10:24:44'),
(2, 'vgsdsdb', 'agb', 'eghj', 'gsdhfm', 'ASSwew', 'gsdhf', '2016-08-31 10:03:41'),
(3, 'fvsvb', 'assgsbdn', 'gdf', 'sghbn', 'sfvgbd', 'qgdhfng', '2016-08-31 10:03:41'),
(4, 'asgsdf', 'asd', 'AFSGDNF', 'SGDNF', 'Qwwrefed', 'SDF', '2016-08-31 10:03:41'),
(5, 'eghdnf', 'asgd', 'ghdng', 'agsdn', 'rtrkyuh', 'qgsdf', '2016-08-31 10:03:41'),
(6, 'fgthgy', 'wetre', 'swetrh', 'etrt', 'AQwqaew', 'setryhtj', '2016-08-31 10:03:41'),
(7, 'Floyd', 'Fletcher', '0212345678', 'floyd_fletcher@gmail.com', 'FloydF', 'FloydF', '2016-08-31 10:03:41'),
(8, 'vvsbavs', 'fas', 'vbd', 'fsb', 'Htyhkkg', 'sgdf', '2016-08-31 10:03:41'),
(9, '', '', '', '', 'wreyhrtkjmn', '', '2016-08-31 10:03:41'),
(10, 'Dion', 'Rabone', '', '', 'zxvbcnvbn', '', '2016-08-31 10:03:41'),
(11, '', '', '', '', 'Rew', '', '2016-08-31 10:03:41'),
(12, 'simon', 'park', '020200220', 'doyouwannanno@gmail.com', 'rewl', 'slejke', '2016-08-31 10:03:41'),
(13, '', '', '', '', 'aaafgsdf', '', '2016-08-31 10:03:41'),
(14, '', '', '', '', 'gsrdf', '', '2016-08-31 10:03:41'),
(15, '', '', '', '', 'SER', '', '2016-08-31 10:03:41'),
(16, '', '', '', '', 'retewtyerh', '', '2016-08-31 10:03:41'),
(17, '', '', '', '', 'fgsdf', '', '2016-08-31 10:08:54'),
(18, '', '', '', '', 'Ass', '', '2016-08-31 10:08:54'),
(19, '', '', '', '', 'sfgdhdfjffg', '', '2016-08-31 10:20:59'),
(20, '', '', '', '', 'AWQ', '', '2016-08-30 12:00:00'),
(21, '', '', '', '', 'qwerty', '', '2016-08-31 10:51:36'),
(22, 'Freddie', 'Mercury', '16-09-1949', 'fred_merc@queen.com', 'Radio_Gaga', 'Innuendo', '2016-08-31 10:55:50'),
(23, 'Dion', 'Rabone', '29/09/2016', 'hi@hi.com', '=D', 'no', '2016-09-01 23:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `web_site_content`
--

DROP TABLE IF EXISTS `web_site_content`;
CREATE TABLE IF NOT EXISTS `web_site_content` (
  `wsc_id` int(4) NOT NULL AUTO_INCREMENT,
  `wsc_name` varchar(24) NOT NULL,
  `wsc_desc` varchar(64) NOT NULL,
  `wsc_content` varchar(1000) NOT NULL,
  PRIMARY KEY (`wsc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_site_content`
--

INSERT INTO `web_site_content` (`wsc_id`, `wsc_name`, `wsc_desc`, `wsc_content`) VALUES
(1, 'About', ' Intro to web site paragraph_1', 'Lorem ipsum dolor sit amet, cum ei quas dicit definitionem, agam inani facilisi no eam, nihil dicunt fuisset est in. Mel solet expetenda et, nonumes maluisset reformidans ut duo. Te amet error graecis sea, semper tacimates in ius. His semper facilisis evertitur no, vis fuisset assueverit efficiantur cu. Pri legendos adolescens dissentiet ex. Ne eos veniam feugiat deterruisset, eam in fierent evertitur. No est blandit iudicabit, ne vis solet delenit. Eam cu molestiae  ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
