CREATE DATABASE  IF NOT EXISTS `tmato` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tmato`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: tmato
-- ------------------------------------------------------
-- Server version	5.7.11

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
  `User_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  `Org_ID` int(10) unsigned NOT NULL COMMENT 'Foreign key',
  `BList_Reason` varchar(512) NOT NULL,
  `BList_Date` date NOT NULL,
  `BList_End_Date` date DEFAULT NULL,
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
-- Table structure for table `membership`
--

DROP TABLE IF EXISTS `membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership` (
  `Mem_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `Msg_ID` int(10) unsigned DEFAULT NULL COMMENT 'Foreign key',
  `Mem_State` int(1) unsigned NOT NULL COMMENT 'Number assigned to membership state',
  `Mem_Private` int(1) unsigned NOT NULL COMMENT 'Digit used as bool to control displaying membership',
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
  `Org_ID` int(10) unsigned NOT NULL COMMENT 'Unique row ID',
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
  `Team_ID` int(10) unsigned NOT NULL COMMENT 'Unique row ID',
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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `User_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID',
  `User_FName` varchar(32) NOT NULL COMMENT 'First name',
  `User_LName` varchar(32) NOT NULL COMMENT 'Last name',
  `User_DOB` date NOT NULL COMMENT 'Date of birth',
  `User_Email` varchar(300) NOT NULL COMMENT 'Email address',
  `User_UName` varchar(32) NOT NULL COMMENT 'Display username',
  `User_Password` varchar(64) NOT NULL COMMENT 'Hashed password',
  `User_PwordHash` varchar(64) NOT NULL COMMENT 'Hash used to hash password',
  `User_Created` date NOT NULL COMMENT 'Date of creation',
  `User_Bio` text COMMENT 'Text for user to describe self',
  `User_DisplayName` int(1) unsigned NOT NULL COMMENT 'Digit used as bool to control displaying of name',
  `User_DisplayAge` int(1) unsigned NOT NULL COMMENT 'Digit used as bool to control displaying of age',
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `User_ID_UNIQUE` (`User_ID`),
  UNIQUE KEY `User_UName_UNIQUE` (`User_UName`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Roger','Ramjet','2001-03-17','roger.ramjet@jet.com','HotRod12','HotRod12','','2016-09-01',NULL,0,0),(2,'Fred','Flintstone','1947-08-31','fred.flintstone@bedrock.com','Prehistoric8','Prehistoric8','','2016-09-10',NULL,0,0),(3,'Kyle','Reese','2022-06-23','machines_rule@future.sky.net','WillNotStop2','UntillYouAreDead0','','2016-09-12',NULL,0,0),(4,'Maxwell','Smart','1944-04-25','maxwell.smart@getsmart.web','Secret3','Message4','','2016-09-12','',0,0),(5,'Michael','Jackson','1960-08-16','mj@neverland.todler','SmoothCriminal5','MoonWalk6','','2016-09-13',NULL,0,0),(6,'Noah','Nathan','1982-02-21','nwnathan@hotmail.com','Eskimo12','Iceberg12','','2016-09-15',NULL,0,0),(7,'Freddie','Kruger','1966-06-06','freddie.kruger@elmstreet.dream','NeverSleepAgain8','SweetDreams95','','2016-09-15',NULL,0,0),(8,'Dion','Rabone','1978-12-31','dion@weltec.org','HelloWorld69','WebTechRules1','','2016-09-16',NULL,0,0),(9,'Joseph','Stalin','1901-04-04','joseph.stalin@tyrant.web','Propaganda2','IronCurtain9','','2016-09-16',NULL,0,0),(10,'Arse','Wipe','1900-01-01','arse.wipe@backside.net','Unstained6','Unstained6','','2016-09-18',NULL,0,0);
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

-- Dump completed on 2016-09-18 23:33:39
