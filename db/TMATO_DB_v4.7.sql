CREATE DATABASE  IF NOT EXISTS `tmato` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tmato`;
-- MySQL dump 10.13  Distrib 5.7.15, for Win64 (x86_64)
--
-- Host: localhost    Database: tmato
-- ------------------------------------------------------
-- Server version	5.7.15-log

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
-- Table structure for table `blacklisted_by`
--

DROP TABLE IF EXISTS `blacklisted_by`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blacklisted_by` (
  `User_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary',
  `Org_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary',
  `BList_Reason` varchar(512) NOT NULL COMMENT 'Reason for blacklisting',
  `BList_Date` date NOT NULL COMMENT 'Date of blacklisting',
  `BList_End_Date` date DEFAULT NULL COMMENT 'Date of blacklist end',
  PRIMARY KEY (`User_ID`,`Org_ID`),
  KEY `Org_ID` (`Org_ID`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `blacklisted_by_fk_org` FOREIGN KEY (`Org_ID`) REFERENCES `organisation` (`Org_ID`),
  CONSTRAINT `blacklisted_by_fk_user` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blacklisted_by`
--

LOCK TABLES `blacklisted_by` WRITE;
/*!40000 ALTER TABLE `blacklisted_by` DISABLE KEYS */;
/*!40000 ALTER TABLE `blacklisted_by` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enroll_in`
--

DROP TABLE IF EXISTS `enroll_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enroll_in` (
  `Team_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary',
  `Tour_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary',
  `Mem_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  PRIMARY KEY (`Team_ID`,`Tour_ID`),
  KEY `Team_ID` (`Team_ID`),
  KEY `Tour_ID` (`Tour_ID`),
  KEY `Mem_ID` (`Mem_ID`),
  CONSTRAINT `enroll_in_fk_mem` FOREIGN KEY (`Mem_ID`) REFERENCES `membership` (`Mem_ID`),
  CONSTRAINT `enroll_in_fk_team` FOREIGN KEY (`Team_ID`) REFERENCES `team` (`Team_ID`),
  CONSTRAINT `enroll_in_fk_tour` FOREIGN KEY (`Tour_ID`) REFERENCES `tournament` (`Tour_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enroll_in`
--

LOCK TABLES `enroll_in` WRITE;
/*!40000 ALTER TABLE `enroll_in` DISABLE KEYS */;
/*!40000 ALTER TABLE `enroll_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `match`
--

DROP TABLE IF EXISTS `match`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `match` (
  `Match_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `MResult_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  `Match_Num` int(2) unsigned NOT NULL COMMENT 'Number of match in round',
  `Match_Draw` int(1) unsigned NOT NULL COMMENT 'Digit representing bool for draw',
  PRIMARY KEY (`Match_ID`),
  UNIQUE KEY `Match_ID_UNIQUE` (`Match_ID`),
  KEY `MResult_ID` (`MResult_ID`),
  CONSTRAINT `match_fk_mresult` FOREIGN KEY (`MResult_ID`) REFERENCES `match_result` (`MResult_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match`
--

LOCK TABLES `match` WRITE;
/*!40000 ALTER TABLE `match` DISABLE KEYS */;
/*!40000 ALTER TABLE `match` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `match_result`
--

DROP TABLE IF EXISTS `match_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `match_result` (
  `MResult_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `Team_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  `MResult_Points` int(10) DEFAULT NULL COMMENT 'Points from match',
  `MResult_Forfeit` int(1) unsigned DEFAULT NULL COMMENT 'Digit representing bool for forfeit',
  PRIMARY KEY (`MResult_ID`),
  UNIQUE KEY `MResult_ID_UNIQUE` (`MResult_ID`),
  KEY `Team_ID` (`Team_ID`),
  CONSTRAINT `match_result_fk_team` FOREIGN KEY (`Team_ID`) REFERENCES `team` (`Team_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match_result`
--

LOCK TABLES `match_result` WRITE;
/*!40000 ALTER TABLE `match_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `match_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `match_winner`
--

DROP TABLE IF EXISTS `match_winner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `match_winner` (
  `Match_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary\n',
  `Team_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary\n',
  PRIMARY KEY (`Match_ID`,`Team_ID`),
  KEY `Match_ID` (`Match_ID`),
  KEY `Team_ID` (`Team_ID`),
  CONSTRAINT `match_winner_fk_match` FOREIGN KEY (`Match_ID`) REFERENCES `match` (`Match_ID`),
  CONSTRAINT `match_winner_fk_team` FOREIGN KEY (`Team_ID`) REFERENCES `team` (`Team_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match_winner`
--

LOCK TABLES `match_winner` WRITE;
/*!40000 ALTER TABLE `match_winner` DISABLE KEYS */;
/*!40000 ALTER TABLE `match_winner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership`
--

DROP TABLE IF EXISTS `membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership` (
  `Mem_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `Msg_ID` int(10) unsigned DEFAULT NULL COMMENT 'Foreign key',
  `Mem_State` int(1) unsigned NOT NULL COMMENT 'Number assigned to membership state',
  `Mem_Private` int(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Digit used as bool to control displaying membership',
  `Mem_Description` varchar(256) NOT NULL COMMENT 'Description of membership',
  PRIMARY KEY (`Mem_ID`),
  UNIQUE KEY `Mem_ID_UNIQUE` (`Mem_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership`
--

LOCK TABLES `membership` WRITE;
/*!40000 ALTER TABLE `membership` DISABLE KEYS */;
/*!40000 ALTER TABLE `membership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `Msg_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `User_ID` int(10) unsigned DEFAULT NULL COMMENT 'Foreign key',
  `Team_ID` int(10) unsigned DEFAULT NULL COMMENT 'Foreign key',
  `Org_ID` int(10) unsigned DEFAULT NULL COMMENT 'Foreign key',
  `Tour_ID` int(10) unsigned DEFAULT NULL COMMENT 'Foreign key',
  `Msg_Title` varchar(128) NOT NULL COMMENT 'Message title',
  `Msg_Body` text NOT NULL COMMENT 'Message body',
  PRIMARY KEY (`Msg_ID`),
  UNIQUE KEY `Msg_ID_UNIQUE` (`Msg_ID`),
  KEY `User_ID` (`User_ID`),
  KEY `Team_ID` (`Team_ID`),
  KEY `Org_ID` (`Org_ID`),
  KEY `Tour_ID` (`Tour_ID`),
  CONSTRAINT `message_fk_org` FOREIGN KEY (`Org_ID`) REFERENCES `organisation` (`Org_ID`),
  CONSTRAINT `message_fk_team` FOREIGN KEY (`Team_ID`) REFERENCES `team` (`Team_ID`),
  CONSTRAINT `message_fk_tour` FOREIGN KEY (`Tour_ID`) REFERENCES `tournament` (`Tour_ID`),
  CONSTRAINT `message_fk_user` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_reciever`
--

DROP TABLE IF EXISTS `message_reciever`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_reciever` (
  `Msg_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary',
  `User_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary',
  `MRec_Seen` int(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Digit representing bool for message seen',
  KEY `Msg_ID` (`Msg_ID`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `message_reciever_fk_msg` FOREIGN KEY (`Msg_ID`) REFERENCES `message` (`Msg_ID`),
  CONSTRAINT `message_reciever_fk_user` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_reciever`
--

LOCK TABLES `message_reciever` WRITE;
/*!40000 ALTER TABLE `message_reciever` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_reciever` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `o_member_of`
--

DROP TABLE IF EXISTS `o_member_of`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `o_member_of` (
  `User_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary',
  `Org_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary',
  `Role_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  `Mem_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  PRIMARY KEY (`User_ID`,`Org_ID`),
  KEY `User_ID` (`User_ID`),
  KEY `Org_ID` (`Org_ID`),
  KEY `Role_ID` (`Role_ID`),
  KEY `Mem_ID` (`Mem_ID`),
  CONSTRAINT `o_member_of_fk_mem` FOREIGN KEY (`Mem_ID`) REFERENCES `membership` (`Mem_ID`),
  CONSTRAINT `o_member_of_fk_org` FOREIGN KEY (`Org_ID`) REFERENCES `organisation` (`Org_ID`),
  CONSTRAINT `o_member_of_fk_role` FOREIGN KEY (`Role_ID`) REFERENCES `role` (`Role_ID`),
  CONSTRAINT `o_member_of_fk_user` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `o_member_of`
--

LOCK TABLES `o_member_of` WRITE;
/*!40000 ALTER TABLE `o_member_of` DISABLE KEYS */;
/*!40000 ALTER TABLE `o_member_of` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisation`
--

DROP TABLE IF EXISTS `organisation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organisation` (
  `Org_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `Org_Name` varchar(64) NOT NULL COMMENT 'Name of organisation',
  `Org_Bio` text COMMENT 'Text for organisation to describe itself',
  PRIMARY KEY (`Org_ID`),
  UNIQUE KEY `Org_ID_UNIQUE` (`Org_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisation`
--

LOCK TABLES `organisation` WRITE;
/*!40000 ALTER TABLE `organisation` DISABLE KEYS */;
/*!40000 ALTER TABLE `organisation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `Role_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `Role_Level` int(1) unsigned NOT NULL COMMENT 'Number assigned to role privileges',
  `Role_Name` varchar(64) NOT NULL COMMENT 'Name of role type',
  `Role_Desc` varchar(512) NOT NULL COMMENT 'Description of role type',
  PRIMARY KEY (`Role_ID`),
  UNIQUE KEY `Role_ID_UNIQUE` (`Role_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `round`
--

DROP TABLE IF EXISTS `round`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `round` (
  `Round_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `Match_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  `Round_Num` int(3) unsigned NOT NULL COMMENT 'Number of round in tournament',
  PRIMARY KEY (`Round_ID`),
  UNIQUE KEY `Round_ID_UNIQUE` (`Round_ID`),
  KEY `Match_ID` (`Match_ID`),
  CONSTRAINT `round_fk_match` FOREIGN KEY (`Match_ID`) REFERENCES `match` (`Match_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `round`
--

LOCK TABLES `round` WRITE;
/*!40000 ALTER TABLE `round` DISABLE KEYS */;
/*!40000 ALTER TABLE `round` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_member_of`
--

DROP TABLE IF EXISTS `t_member_of`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_member_of` (
  `User_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary',
  `Team_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary',
  `Role_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  `Mem_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  PRIMARY KEY (`User_ID`,`Team_ID`),
  KEY `User_ID` (`User_ID`),
  KEY `Team_ID` (`Team_ID`),
  KEY `Role_ID` (`Role_ID`),
  KEY `Mem_ID` (`Mem_ID`),
  CONSTRAINT `t_member_of_fk_mem` FOREIGN KEY (`Mem_ID`) REFERENCES `membership` (`Mem_ID`),
  CONSTRAINT `t_member_of_fk_role` FOREIGN KEY (`Role_ID`) REFERENCES `role` (`Role_ID`),
  CONSTRAINT `t_member_of_fk_team` FOREIGN KEY (`Team_ID`) REFERENCES `team` (`Team_ID`),
  CONSTRAINT `t_member_of_fk_user` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_member_of`
--

LOCK TABLES `t_member_of` WRITE;
/*!40000 ALTER TABLE `t_member_of` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_member_of` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `Team_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `Org_ID` int(10) unsigned DEFAULT NULL COMMENT 'Foreign key',
  `Team_Sport` varchar(32) NOT NULL COMMENT 'Name of team''s sport',
  `Team_Name` varchar(64) NOT NULL COMMENT 'Name of team',
  `Team_Bio` text COMMENT 'Text for team to describe itself',
  PRIMARY KEY (`Team_ID`),
  UNIQUE KEY `Team_ID_UNIQUE` (`Team_ID`),
  KEY `Org_ID` (`Org_ID`),
  CONSTRAINT `team_fk_org` FOREIGN KEY (`Org_ID`) REFERENCES `organisation` (`Org_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament`
--

DROP TABLE IF EXISTS `tournament`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament` (
  `Tour_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `Org_ID` int(10) unsigned DEFAULT NULL COMMENT 'Foreign key',
  `TRules_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  `Round_ID` int(10) unsigned DEFAULT NULL COMMENT 'Foreign key',
  `Tour_Name` varchar(64) NOT NULL COMMENT 'Name of tournament',
  `Tour_Start_Date` date NOT NULL COMMENT 'Date of start of tournament',
  `Tour_End_Date` date DEFAULT NULL COMMENT 'Date of end of tournament',
  `Tour_Time` time NOT NULL COMMENT 'Time of tournament',
  `Tour_Location` varchar(256) DEFAULT NULL COMMENT 'Location of tournament',
  `Tour_Bio` text COMMENT 'Text for tournament to describe itself',
  `Tour_Sport_Rules` text COMMENT 'Text for tournament to describe custom sport rules',
  `Tour_Finished` int(1) unsigned NOT NULL COMMENT 'Digit representing bool for tournament finished',
  PRIMARY KEY (`Tour_ID`),
  UNIQUE KEY `Tour_ID_UNIQUE` (`Tour_ID`),
  KEY `TRules_ID` (`TRules_ID`),
  KEY `Round_ID` (`Round_ID`),
  KEY `Org_ID` (`Org_ID`),
  CONSTRAINT `tournament_fk_org` FOREIGN KEY (`Org_ID`) REFERENCES `organisation` (`Org_ID`),
  CONSTRAINT `tournament_fk_round` FOREIGN KEY (`Round_ID`) REFERENCES `round` (`Round_ID`),
  CONSTRAINT `tournament_fk_trules` FOREIGN KEY (`TRules_ID`) REFERENCES `tournament_rules` (`TRules_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament`
--

LOCK TABLES `tournament` WRITE;
/*!40000 ALTER TABLE `tournament` DISABLE KEYS */;
/*!40000 ALTER TABLE `tournament` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_admin`
--

DROP TABLE IF EXISTS `tournament_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_admin` (
  `User_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary',
  `Tour_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key, 1/2 of composite primary',
  `Role_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  `Mem_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  PRIMARY KEY (`User_ID`,`Tour_ID`),
  KEY `User_ID` (`User_ID`),
  KEY `Tour_ID` (`Tour_ID`),
  KEY `Role_ID` (`Role_ID`),
  KEY `Mem_ID` (`Mem_ID`),
  CONSTRAINT `tournament_admin_fk_mem` FOREIGN KEY (`Mem_ID`) REFERENCES `membership` (`Mem_ID`),
  CONSTRAINT `tournament_admin_fk_role` FOREIGN KEY (`Role_ID`) REFERENCES `role` (`Role_ID`),
  CONSTRAINT `tournament_admin_fk_tour` FOREIGN KEY (`Tour_ID`) REFERENCES `tournament` (`Tour_ID`),
  CONSTRAINT `tournament_admin_fk_user` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_admin`
--

LOCK TABLES `tournament_admin` WRITE;
/*!40000 ALTER TABLE `tournament_admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `tournament_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_presets`
--

DROP TABLE IF EXISTS `tournament_presets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_presets` (
  `TPre_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `TRules_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  `User_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  `TPre_Name` varchar(32) NOT NULL COMMENT 'Name of preset',
  PRIMARY KEY (`TPre_ID`),
  UNIQUE KEY `TPre_ID_UNIQUE` (`TPre_ID`),
  KEY `TRules_ID` (`TRules_ID`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `tournament_presets_fk_trules` FOREIGN KEY (`TRules_ID`) REFERENCES `tournament_rules` (`TRules_ID`),
  CONSTRAINT `tournament_presets_fk_user` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_presets`
--

LOCK TABLES `tournament_presets` WRITE;
/*!40000 ALTER TABLE `tournament_presets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tournament_presets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_rules`
--

DROP TABLE IF EXISTS `tournament_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_rules` (
  `TRules_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `TRules_Elim` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Digit representing bool for elimination rules',
  `TRules_RRobin` int(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Digit representing bool for round robin rules',
  `TRules_Points` int(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Digit representing bool for points rules',
  PRIMARY KEY (`TRules_ID`),
  UNIQUE KEY `TRules_ID_UNIQUE` (`TRules_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_rules`
--

LOCK TABLES `tournament_rules` WRITE;
/*!40000 ALTER TABLE `tournament_rules` DISABLE KEYS */;
/*!40000 ALTER TABLE `tournament_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `User_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `User_FName` varchar(32) NOT NULL COMMENT 'First name',
  `User_LName` varchar(32) NOT NULL COMMENT 'Last name',
  `User_UName` varchar(32) NOT NULL COMMENT 'Display username',
  `User_Password` varchar(64) NOT NULL COMMENT 'Hashed password',
  `User_PwordHash` varchar(64) NOT NULL COMMENT 'Hash used to hash password',
  `User_Email` varchar(300) NOT NULL COMMENT 'Email address',
  `User_DOB` date NOT NULL COMMENT 'Date of birth',
  `User_Created` date NOT NULL COMMENT 'Date of creation',
  `User_Bio` text COMMENT 'Text for user to describe self',
  `User_Display_Name` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Digit used as bool to control displaying of name',
  `User_Display_Age` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Digit used as bool to control displaying of age',
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `User_ID_UNIQUE` (`User_ID`),
  UNIQUE KEY `User_UName_UNIQUE` (`User_UName`),
  KEY `User_Email` (`User_Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'tmato'
--

--
-- Dumping routines for database 'tmato'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-27  0:44:50

insert into role(Role_Level, Role_Name, Role_Desc) values(1, 'Owner', 'Owner of entity.');

insert into role(Role_Level, Role_Name, Role_Desc) values(2, 'Admin', 'Admin of entity.');

insert into role(Role_Level, Role_Name, Role_Desc) values(3, 'Member', 'Normal member of entity.');