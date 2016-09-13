-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2016 at 12:22 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmato_db`
--
CREATE DATABASE IF NOT EXISTS `tmato_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tmato_db`;

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

DROP TABLE IF EXISTS `blacklist`;
CREATE TABLE `blacklist` (
  `blacklist_ID` int(6) NOT NULL,
  `blacklist_User_ID` int(6) NOT NULL,
  `blacklist_Org_ID` int(6) NOT NULL,
  `blacklist_Reason` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bracket_type`
--

DROP TABLE IF EXISTS `bracket_type`;
CREATE TABLE `bracket_type` (
  `tbrk_ID` int(6) NOT NULL,
  `brk_type` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `brackets`
--

DROP TABLE IF EXISTS `brackets`;
CREATE TABLE `brackets` (
  `brk_ID` int(6) NOT NULL,
  `brk_TBrk_ID` int(6) NOT NULL,
  `brk_Seed` int(2) DEFAULT NULL,
  `brk_Played` int(2) DEFAULT NULL,
  `brk_Win` int(2) DEFAULT NULL,
  `brk_Loss` int(2) DEFAULT NULL,
  `brk_Draw` int(2) DEFAULT NULL,
  `brk_Points` int(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `custom_sport`
--

DROP TABLE IF EXISTS `custom_sport`;
CREATE TABLE `custom_sport` (
  `custom_ID` int(6) NOT NULL,
  `custom_name` varchar(32) NOT NULL,
  `custom_Type` text NOT NULL,
  `custom_Ruleset` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

DROP TABLE IF EXISTS `organisation`;
CREATE TABLE `organisation` (
  `org_ID` int(6) NOT NULL,
  `org_User_ID` int(6) NOT NULL,
  `org_Tour_ID` int(6) NOT NULL,
  `org_Team_ID` int(6) NOT NULL,
  `org_Blacklist_ID` int(6) NOT NULL,
  `org_Name` varchar(32) NOT NULL,
  `org_Bio` text,
  `org_DateCreated` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sportlist`
--

DROP TABLE IF EXISTS `sportlist`;
CREATE TABLE `sportlist` (
  `sport_ID` int(6) NOT NULL,
  `sport_name` varchar(32) NOT NULL,
  `sport_Default_Type` text NOT NULL,
  `sport_Ruleset` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `team_ID` int(6) NOT NULL,
  `team_User_ID` int(6) NOT NULL,
  `team_Org_ID` int(6) NOT NULL,
  `team_Sport_ID` int(6) NOT NULL,
  `team_Name` varchar(32) NOT NULL,
  `team_Age` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

DROP TABLE IF EXISTS `tournament`;
CREATE TABLE `tournament` (
  `tour_ID` int(6) NOT NULL,
  `tour_Org_ID` int(6) NOT NULL,
  `tour_Brk_ID` int(6) NOT NULL,
  `tour_Name` varchar(32) NOT NULL,
  `tour_StartDate` date NOT NULL,
  `tour_EndDate` date DEFAULT NULL,
  `tour_StartTime` time DEFAULT NULL,
  `tour_EndTime` time DEFAULT NULL,
  `tour_Bio` text,
  `tour_Location` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `User_ID` int(8) NOT NULL,
  `User_FName` varchar(32) NOT NULL,
  `User_LName` varchar(32) NOT NULL,
  `User_DOB` date NOT NULL,
  `User_Email` varchar(48) NOT NULL,
  `User_UName` varchar(20) NOT NULL,
  `User_Password` varchar(20) NOT NULL,
  `User_PwordHash` varchar(64) NOT NULL,
  `User_Created` date NOT NULL,
  `User_Bio` text,
  `User_DisplayName` int(1) NOT NULL DEFAULT '0',
  `User_DisplayAge` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `User_FName`, `User_LName`, `User_DOB`, `User_Email`, `User_UName`, `User_Password`, `User_PwordHash`, `User_Created`, `User_Bio`, `User_DisplayName`, `User_DisplayAge`) VALUES
(1, 'Roger', 'Ramjet', '2001-03-17', 'roger.ramjet@jet.com', 'Rod12', 'Rod12', '', '2016-09-01', NULL, 0, 0),
(2, 'Fred', 'Flintstone', '1947-08-31', 'fred.flintstone@bedrock.com', 'Prehistoric', 'Prehistoric', '', '2016-09-10', NULL, 0, 0),
(3, 'Kyle', 'Reese', '2022-06-23', 'machines_rule@future.sky.net', 'WillNotStop', 'UntillYouAreDead!', '', '2016-09-12', NULL, 0, 0),
(4, 'Maxwell', 'Smart', '1944-04-25', 'maxwell.smart@getsmart.web', 'Secret', 'Message', '', '2016-09-12', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`blacklist_ID`),
  ADD KEY `fk_user_ID` (`blacklist_User_ID`),
  ADD KEY `fk_org_ID` (`blacklist_Org_ID`);

--
-- Indexes for table `bracket_type`
--
ALTER TABLE `bracket_type`
  ADD PRIMARY KEY (`tbrk_ID`);

--
-- Indexes for table `brackets`
--
ALTER TABLE `brackets`
  ADD PRIMARY KEY (`brk_ID`),
  ADD KEY `fk_bracket_type_ID` (`brk_TBrk_ID`);

--
-- Indexes for table `custom_sport`
--
ALTER TABLE `custom_sport`
  ADD PRIMARY KEY (`custom_ID`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`org_ID`),
  ADD KEY `fk_user_ID` (`org_User_ID`),
  ADD KEY `fk_tournament_ID` (`org_Tour_ID`),
  ADD KEY `fk_team_ID` (`org_Team_ID`),
  ADD KEY `fk_blacklist_ID` (`org_Blacklist_ID`);

--
-- Indexes for table `sportlist`
--
ALTER TABLE `sportlist`
  ADD PRIMARY KEY (`sport_ID`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_ID`),
  ADD KEY `fk_user_ID` (`team_User_ID`),
  ADD KEY `fk_organisation_ID` (`team_Org_ID`),
  ADD KEY `fk_sport_ID` (`team_Sport_ID`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`tour_ID`),
  ADD KEY `fk_organisation_ID` (`tour_Org_ID`),
  ADD KEY `fk_bracket_ID` (`tour_Brk_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `user_UserName` (`User_UName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `blacklist_ID` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bracket_type`
--
ALTER TABLE `bracket_type`
  MODIFY `tbrk_ID` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `brackets`
--
ALTER TABLE `brackets`
  MODIFY `brk_ID` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_sport`
--
ALTER TABLE `custom_sport`
  MODIFY `custom_ID` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `org_ID` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sportlist`
--
ALTER TABLE `sportlist`
  MODIFY `sport_ID` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_ID` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `tour_ID` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
