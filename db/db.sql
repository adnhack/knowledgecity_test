CREATE DATABASE  IF NOT EXISTS `testdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `testdb`;
-- MySQL dump 10.13  Distrib 8.0.21, for macos10.15 (x86_64)
--
-- Host: localhost    Database: testdb
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `api_users`
--

DROP TABLE IF EXISTS `api_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_users` (
  `email` varchar(254) NOT NULL COMMENT 'Email is unique and is the user',
  `password` varchar(50) NOT NULL,
  `token` varchar(60) DEFAULT NULL COMMENT 'sha1 combination of email and password',
  `valid` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created at time',
  PRIMARY KEY (`email`),
  KEY `toekn` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_users`
--

LOCK TABLES `api_users` WRITE;
/*!40000 ALTER TABLE `api_users` DISABLE KEYS */;
INSERT INTO `api_users` VALUES ('aaron.aceves@gmail.com','4f57181dcaade980555f2ce6755ca425f00658be','ec11d58778d58ffaf6c29cba8b68e1ba5211b567','2020-10-10','2020-09-08 18:35:08');
/*!40000 ALTER TABLE `api_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `usergroup` varchar(45) DEFAULT 'Default Group',
  `email` varchar(250) DEFAULT '--',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`),
  KEY `searchable` (`fname`,`lname`,`usergroup`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Aaron','Aceves','Default Group','aaron@gmail.com','2020-09-09 20:43:55'),(2,'Carlos','Flores','Default Group','cf@example.com','2020-09-09 20:43:55'),(3,'Ana','Esquivel','Default Group','--','2020-09-09 20:43:55'),(4,'Juan Jose','Noriega','Default Group','--','2020-09-09 20:43:55'),(5,'John','Smith','Default Group','--','2020-09-09 20:43:55'),(6,'Sylvester','Stallone','Default Group','--','2020-09-09 20:43:55'),(7,'Bruce','Willis','Default Group','bruce@action.com','2020-09-09 20:43:55'),(8,'Stephen','Hawking','Default Group','--','2020-09-09 20:43:55'),(9,'Charles','Baudelaire','Default Group','--','2020-09-09 20:43:55'),(10,'Allan','Poe','Default Group','--','2020-09-09 20:43:55'),(11,'Friedrich','Nietzsche','Default Group','zaratustra@iamgod.com','2020-09-09 20:43:55'),(12,'Pepito','Perez','Default Group','--','2020-09-09 20:43:55'),(13,'Ada','Lovelace','Default Group','first@womandeveloper.com','2020-09-09 20:43:55'),(14,'Grace','Hopper','Default Group','first@compilador.com','2020-09-09 20:43:55'),(15,'Lola','Trailera','Default Group','trailera@trailer.com','2020-09-09 20:43:55'),(16,'Guadalupe','Esparza','Default Group','bronco@music.com','2020-09-09 20:43:55'),(17,'Van','Halen','Default Group','--','2020-09-09 20:43:55'),(18,'Rigo','Tovar','Default Group','--','2020-09-09 20:43:55'),(19,'Polo','Polo','Default Group','polo@polo.com','2020-09-09 20:43:55');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-09 20:48:21
