-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2016 at 10:28 AM
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
  `u_email` varchar(32) NOT NULL,
  `u_phone` varchar(32) NOT NULL,
  `u_type` varchar(32) NOT NULL,
  `u_name` varchar(12) NOT NULL,
  `u_pword` varchar(12) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_fname`, `u_lname`, `u_email`, `u_phone`, `u_type`, `u_name`, `u_pword`) VALUES
(1, 'Fred', 'Flintstone', 'fred.flintstone@bedrock.com', '0251234567', 'Prehistoric', 'Prehistoric', 'Prehistoric'),
(2, 'vgsdsdb', 'agb', 'gsdhfm', 'eghj', 'ghj', 'gdhf', 'gsdhf'),
(3, 'fvsvb', 'assgsbdn', 'sghbn', 'gdf', 'ghdf', 'gsd', 'qgdhfng'),
(4, 'asgsdf', 'asd', 'SGDNF', 'AFSGDNF', 'ASDBF', 'SDBF', 'SDF'),
(5, 'eghdnf', 'asgd', 'agsdn', 'ghdng', 'qgshdf', 'qsgdhf', 'qgsdf'),
(6, 'fgthgy', 'wetre', 'etrt', 'swetrh', 'swetr', 'stdgher', 'setryhtj'),
(7, 'Floyd', 'Fletcher', 'floyd_fletcher@gmail.com', '0212345678', 'Admin', 'FloydF', 'FloydF');

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
