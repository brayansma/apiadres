-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: adres
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `adquisiciones`
--

DROP TABLE IF EXISTS `adquisiciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adquisiciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `presupuesto` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `documentacion` text DEFAULT NULL,
  `unidad_id` bigint(20) unsigned NOT NULL,
  `tipo_id` bigint(20) unsigned NOT NULL,
  `proveedor_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `adquisiciones_unidad_id_foreign` (`unidad_id`),
  KEY `adquisiciones_tipo_id_foreign` (`tipo_id`),
  KEY `adquisiciones_proveedor_id_foreign` (`proveedor_id`),
  CONSTRAINT `adquisiciones_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`),
  CONSTRAINT `adquisiciones_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`),
  CONSTRAINT `adquisiciones_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `unidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adquisiciones`
--

LOCK TABLES `adquisiciones` WRITE;
/*!40000 ALTER TABLE `adquisiciones` DISABLE KEYS */;
INSERT INTO `adquisiciones` VALUES (1,100000.00,50000,3000.00,100000.00,'2023-07-25','Orden de compra No. 2023-07-25-001, factura No. 2023-07-25-001',3,1,3,'2024-03-16 17:52:17','2024-03-16 17:52:17',NULL),(2,500000.00,50000,5000.00,500000.00,'2023-07-25','Orden de compra No. 2023-07-25-001, factura No. 2023-07-25-001',1,1,4,'2024-03-16 17:52:49','2024-03-16 17:52:49',NULL),(3,60000000.00,60000,6000.00,60000000.00,'2023-07-26','Orden de compra No. 2023-07-26-001, factura No. 2023-07-26-001',2,2,3,'2024-03-16 17:54:01','2024-03-16 19:06:26',NULL),(4,500000.00,50000,5000.00,500000.00,'2023-07-25','Orden de compra No. 2023-07-25-001, factura No. 2023-07-25-001',1,1,4,'2024-03-16 17:54:36','2024-03-16 17:54:36',NULL),(5,500000.00,50000,5000.00,500000.00,'2023-07-25','Orden de compra No. 2023-07-25-001, factura No. 2023-07-25-001',1,1,4,'2024-03-16 17:54:57','2024-03-16 17:54:57',NULL),(6,500000.00,50000,5000.00,500000.00,'2023-07-25','Orden de compra No. 2023-07-25-001, factura No. 2023-07-25-001',1,1,4,'2024-03-16 17:56:10','2024-03-16 17:56:10',NULL),(7,500000.00,50000,5000.00,500000.00,'2023-07-25','Orden de compra No. 2023-07-25-001, factura No. 2023-07-25-001',1,1,4,'2024-03-16 17:56:29','2024-03-16 17:56:29',NULL),(8,500000.00,50000,5000.00,500000.00,'2023-07-25','Orden de compra No. 2023-07-25-001, factura No. 2023-07-25-001',1,1,4,'2024-03-16 17:56:54','2024-03-16 17:56:54',NULL),(9,500000.00,50000,5000.00,500000.00,'2023-07-25','Orden de compra No. 2023-07-25-001, factura No. 2023-07-25-001',1,1,4,'2024-03-16 17:57:47','2024-03-16 17:57:47',NULL),(10,500000.00,50000,5000.00,500000.00,'2023-07-25',NULL,1,1,4,'2024-03-16 17:57:47','2024-03-16 17:57:47',NULL),(11,500000.00,50000,5000.00,500000.00,'2023-07-25','Orden de compra No. 2023-07-25-001, factura No. 2023-07-25-001',3,2,2,'2024-03-16 18:02:07','2024-03-16 18:02:07',NULL),(12,7000000.00,70000,7000.00,700000.00,'2023-07-27','Orden de compra No. 2023-07-27-001, factura No. 2023-07-27-001',1,1,4,'2024-03-16 19:27:09','2024-03-16 19:27:09',NULL);
/*!40000 ALTER TABLE `adquisiciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2024_03_14_201922_create_unidades',1),(2,'2024_03_14_201958_create_tipos',1),(3,'2024_03_14_202015_create_proveedores',1),(4,'2024_03_14_202022_create_adquisiciones',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Sanitas','2024-03-16 17:47:20','2024-03-17 21:55:53',NULL),(2,'Famisanar','2024-03-16 17:47:35','2024-03-17 22:18:28',NULL),(3,'Compensar','2024-03-16 17:47:43','2024-03-16 17:47:43',NULL),(4,'EPS Sura','2024-03-16 17:47:52','2024-03-16 17:47:52',NULL),(5,'Laboratorios Bayer S.A.','2024-03-16 17:48:01','2024-03-16 17:48:01',NULL),(6,'Laboratorios Cambiado','2024-03-17 21:20:13','2024-03-17 22:29:16',NULL),(7,'Synlab Colombia','2024-03-17 21:25:44','2024-03-17 21:25:44',NULL),(8,'Cruz Roja Colombiana','2024-03-17 21:31:20','2024-03-17 21:31:20',NULL);
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos`
--

DROP TABLE IF EXISTS `tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `categoria` enum('Bien','Servicio') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos`
--

LOCK TABLES `tipos` WRITE;
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;
INSERT INTO `tipos` VALUES (1,'Entrega Medicamentos','Servicio','2024-03-16 17:45:59','2024-03-16 17:45:59',NULL),(2,'Medicamentos','Bien','2024-03-16 17:46:14','2024-03-16 17:46:14',NULL),(3,'Consulta medica','Servicio','2024-03-16 17:46:31','2024-03-16 17:46:31',NULL);
/*!40000 ALTER TABLE `tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidades`
--

DROP TABLE IF EXISTS `unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unidades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
INSERT INTO `unidades` VALUES (1,'Administrativa','2024-03-16 17:44:27','2024-03-16 17:44:27',NULL),(2,'Desarrollar e implementar estrategias de prevención y control de riesgos','2024-03-16 17:44:40','2024-03-16 17:44:40',NULL),(3,'Monitorear y evaluar el impacto de las estrategias de prevención y control de riesgos','2024-03-16 17:44:51','2024-03-16 17:44:51',NULL),(4,'Dirección de Medicamentos y Tecnologías en Salud','2024-03-16 17:45:45','2024-03-16 17:45:45',NULL);
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'adres'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-18  0:04:26
