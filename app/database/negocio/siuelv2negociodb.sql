-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
--
-- Host: localhost    Database: siuelv2negociodb
-- ------------------------------------------------------
-- Server version	8.0.46-0ubuntu0.20.04.1+esm3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contato`
--

DROP TABLE IF EXISTS `contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contato` (
  `contato_id` int NOT NULL AUTO_INCREMENT,
  `pessoa_id` int DEFAULT NULL,
  `telefone1` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `telefone2` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`contato_id`),
  KEY `fk_contato_pessoa` (`pessoa_id`),
  CONSTRAINT `fk_contato_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`pessoa_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contato`
--

LOCK TABLES `contato` WRITE;
/*!40000 ALTER TABLE `contato` DISABLE KEYS */;
INSERT INTO `contato` VALUES (1,3,'84999999999',NULL,'bczion@hotmail.com'),(2,4,'84999999999',NULL,'agatha@email.com'),(3,5,'84999999999',NULL,'agatha@email.com'),(4,6,'84999999999',NULL,'adriel@email.com');
/*!40000 ALTER TABLE `contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `endereco` (
  `endereco_id` int NOT NULL AUTO_INCREMENT,
  `pessoa_id` int DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `numero` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `bairro` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `complemento` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cidade` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`endereco_id`),
  KEY `fk_endereco_pessoa` (`pessoa_id`),
  CONSTRAINT `fk_endereco_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`pessoa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (1,3,'Rua São Miguel','4','Cidade da Esperança',NULL,'Natal','59071-220','2026-05-08 21:39:59',NULL),(2,4,'Rua São Miguel','4','Cidade da Esperança',NULL,'Natal','59071-220','2026-05-08 23:17:53',NULL),(3,5,'Rua São Miguel','4','Cidade da Esperança',NULL,'Natal','59071-220','2026-06-29 15:56:35',NULL),(4,6,'Rua Vicente Celestino','7','Nossa Senhora de Nazaré',NULL,'Natal','59060-450','2026-06-29 16:10:22',NULL);
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pessoa` (
  `pessoa_id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `genero` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tipo_pessoa` varchar(30) DEFAULT NULL,
  `status` varchar(20) DEFAULT '1',
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`pessoa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (3,'Bruno',NULL,'2026-05-08','M',NULL,'1','2026-05-08 21:39:59',NULL),(4,'Ágatha',NULL,'2012-05-12','F',NULL,'1','2026-05-08 23:17:53',NULL),(5,'Ágatha Gabrielly',NULL,'2012-05-12','F',NULL,'1','2026-06-29 15:56:35',NULL),(6,'Adriel Cauã',NULL,'2020-02-04','M',NULL,'1','2026-06-29 16:10:22',NULL);
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa_perfil`
--

DROP TABLE IF EXISTS `pessoa_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pessoa_perfil` (
  `pessoa_perfil_id` bigint NOT NULL AUTO_INCREMENT,
  `pessoa_id` bigint NOT NULL,
  `perfil` int NOT NULL,
  PRIMARY KEY (`pessoa_perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa_perfil`
--

LOCK TABLES `pessoa_perfil` WRITE;
/*!40000 ALTER TABLE `pessoa_perfil` DISABLE KEYS */;
/*!40000 ALTER TABLE `pessoa_perfil` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-30 17:22:41
