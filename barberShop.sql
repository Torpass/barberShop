CREATE DATABASE  IF NOT EXISTS `barber` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `barber`;
-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: barber
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id_Admin` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `id_Contacto` int NOT NULL,
  `Nombre_Usuario` varchar(45) NOT NULL,
  `Clave` varchar(55) NOT NULL,
  PRIMARY KEY (`id_Admin`),
  KEY `id_Fk_Contacto` (`id_Contacto`),
  CONSTRAINT `id_Fk_Contacto` FOREIGN KEY (`id_Contacto`) REFERENCES `contacto` (`Id_Contacto`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agenda_empleados`
--

DROP TABLE IF EXISTS `agenda_empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agenda_empleados` (
  `Id_Agenda` int NOT NULL AUTO_INCREMENT,
  `Id_Empleado` int NOT NULL,
  `id_Horario` int NOT NULL,
  PRIMARY KEY (`Id_Agenda`),
  KEY `id_Horario` (`id_Horario`),
  KEY `fk_id_Empleado` (`Id_Empleado`),
  CONSTRAINT `fk_id_Empleado` FOREIGN KEY (`Id_Empleado`) REFERENCES `empleado` (`Id_Empleado`) ON UPDATE CASCADE,
  CONSTRAINT `id_Horario` FOREIGN KEY (`id_Horario`) REFERENCES `horarios` (`id_Horario`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agenda_empleados`
--

LOCK TABLES `agenda_empleados` WRITE;
/*!40000 ALTER TABLE `agenda_empleados` DISABLE KEYS */;
INSERT INTO `agenda_empleados` VALUES (74,11,1),(75,11,2),(77,10,1),(78,12,2),(79,12,3);
/*!40000 ALTER TABLE `agenda_empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `id_Citas` int NOT NULL AUTO_INCREMENT,
  `Fecha_Creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Fecha_Cita` date NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `status` enum('En Espera','Terminado','Cancelado') NOT NULL COMMENT '0 for waiting citas\\n1 for realized citas\\n2 for canceled citas',
  `Razon_Cancelacion` text,
  `id_Cliente` int NOT NULL,
  `Id_Empleado` int NOT NULL,
  PRIMARY KEY (`id_Citas`),
  KEY `fk_ids_Cliente` (`id_Cliente`),
  KEY `fk_ids_Empleado` (`Id_Empleado`),
  CONSTRAINT `fk_ids_Cliente` FOREIGN KEY (`id_Cliente`) REFERENCES `clientes` (`id_Cliente`) ON UPDATE CASCADE,
  CONSTRAINT `fk_ids_Empleado` FOREIGN KEY (`Id_Empleado`) REFERENCES `empleado` (`Id_Empleado`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (12,'2024-04-05 04:21:50','2024-04-18','13:09:00','Cancelado',NULL,18,10),(13,'2024-04-05 04:21:54','2024-04-25','14:13:00','Cancelado',NULL,18,11),(14,'2024-04-03 10:48:55','2024-04-18','13:41:00','Terminado',NULL,24,11),(15,'2024-04-05 04:24:09','2024-04-13','14:53:00','Terminado',NULL,20,10),(16,'2024-04-05 04:24:11','2024-04-18','09:31:00','Terminado',NULL,18,10),(17,'2024-04-05 04:22:13','2024-04-18','10:32:00','Cancelado',NULL,18,11),(18,'2024-04-05 04:22:02','2024-04-16','10:32:00','Cancelado',NULL,18,11),(19,'2024-04-04 15:32:32','2024-04-10','11:32:00','En Espera',NULL,18,10),(20,'2024-04-05 04:21:59','2024-04-11','09:46:00','Cancelado',NULL,18,10);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id_Cliente` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Cedula` varchar(20) NOT NULL,
  `edad` int DEFAULT NULL,
  `id_Contacto` int NOT NULL,
  PRIMARY KEY (`id_Cliente`),
  KEY `fks_id_Contacto` (`id_Contacto`),
  CONSTRAINT `fks_id_Contacto` FOREIGN KEY (`id_Contacto`) REFERENCES `contacto` (`Id_Contacto`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (18,'usuario1','usuario1','11222333',23,41),(19,'admin','admin','12345678',15,42),(20,'Gianfranco','Munoz','31204450',24,46),(21,'Anderson','Villalonga','28690963',50,47),(22,'Angel','Duran','28204424',9,48),(23,'Luis','Herice','30615707',19,49),(24,'Karla','Gomez','12034256',95,50),(25,'Pedro','Perez','12345678',34,52);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacto`
--

DROP TABLE IF EXISTS `contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacto` (
  `Id_Contacto` int NOT NULL AUTO_INCREMENT,
  `Telefono` varchar(45) NOT NULL,
  `Gmail` varchar(100) NOT NULL,
  `role` int NOT NULL,
  PRIMARY KEY (`Id_Contacto`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacto`
--

LOCK TABLES `contacto` WRITE;
/*!40000 ALTER TABLE `contacto` DISABLE KEYS */;
INSERT INTO `contacto` VALUES (41,'04543758324','usuario@gmail.com',0),(42,'04125556343','admin@gmail.com',2),(43,'04123456789','Alberto@gmail.com',1),(45,'04123456789','luis@gmail.com',1),(46,'04241378464','mgianfranco61@gmail.com',2),(47,'04241378464','anderson@gmail.com',2),(48,'04160565489','angel00duran05@gmail.com',2),(49,'04245695637','chu@gmail.com',2),(50,'04249384732','Karla@gmail.com',0),(51,'04125556677','pedro@gmail.com',1),(52,'04125556677','pedro@gmail.com',0);
/*!40000 ALTER TABLE `contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_servicio`
--

DROP TABLE IF EXISTS `detalles_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalles_servicio` (
  `Id_Detalle` int NOT NULL AUTO_INCREMENT,
  `Id_Servicio` int NOT NULL,
  `Detalle` text NOT NULL,
  `img` text NOT NULL,
  `status` int NOT NULL COMMENT '0 para activo\n1 para inactivo',
  PRIMARY KEY (`Id_Detalle`),
  KEY `fk_idServicio` (`Id_Servicio`),
  CONSTRAINT `fk_idServicio` FOREIGN KEY (`Id_Servicio`) REFERENCES `servicios` (`id_Servicio`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_servicio`
--

LOCK TABLES `detalles_servicio` WRITE;
/*!40000 ALTER TABLE `detalles_servicio` DISABLE KEYS */;
INSERT INTO `detalles_servicio` VALUES (13,14,'corte de pelo al detal','660d5b55cefaf.jpg',0),(14,15,'Corte de barba, lavado','660d6e9717686.jpg',0),(15,16,'Corte de uñas','660eab463e010.jpg',0),(16,17,'Esta es un corte barba','660eab6984773.jpg',0);
/*!40000 ALTER TABLE `detalles_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleado` (
  `Id_Empleado` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Cedula` int NOT NULL,
  `id_Contacto` int NOT NULL,
  PRIMARY KEY (`Id_Empleado`),
  KEY `fk_id_Contacto` (`id_Contacto`),
  CONSTRAINT `fk_id_Contacto` FOREIGN KEY (`id_Contacto`) REFERENCES `contacto` (`Id_Contacto`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (10,'Alberto','Zubillaga',30434522,43),(11,'Luis','Herice',12345678,45),(12,'Pedro','Perez',12345678,51);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estadisticas`
--

DROP TABLE IF EXISTS `estadisticas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estadisticas` (
  `id_estadistica` int NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  `Promedio` int NOT NULL,
  PRIMARY KEY (`id_estadistica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadisticas`
--

LOCK TABLES `estadisticas` WRITE;
/*!40000 ALTER TABLE `estadisticas` DISABLE KEYS */;
/*!40000 ALTER TABLE `estadisticas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horarios` (
  `id_Horario` int NOT NULL AUTO_INCREMENT,
  `dia` varchar(10) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_Finalizacion` time NOT NULL,
  `status` enum('Activo','Inactivo') NOT NULL,
  PRIMARY KEY (`id_Horario`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` VALUES (1,'Lunes','08:00:00','17:00:00','Activo'),(2,'Martes','08:00:00','17:00:00','Activo'),(3,'Miércoles','08:00:00','17:00:00','Activo'),(4,'Jueves','08:00:00','17:00:00','Activo'),(5,'Sabado','08:00:00','17:00:00','Activo'),(6,'Sábado','08:00:00','15:00:00','Inactivo'),(13,'Miercoles','13:00:00','16:30:00','Activo');
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_empleado`
--

DROP TABLE IF EXISTS `info_empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `info_empleado` (
  `id_infoEmpleado` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `promedio_Puntuacion` tinyint NOT NULL,
  PRIMARY KEY (`id_infoEmpleado`),
  CONSTRAINT `fk_info_empleado` FOREIGN KEY (`id_infoEmpleado`) REFERENCES `empleado` (`Id_Empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_empleado`
--

LOCK TABLES `info_empleado` WRITE;
/*!40000 ALTER TABLE `info_empleado` DISABLE KEYS */;
INSERT INTO `info_empleado` VALUES (10,'                                        Excelente trabajador                                ',4),(11,'Excelente trabajador',1),(12,'Excelente empleado mejor persona',2);
/*!40000 ALTER TABLE `info_empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resenas_barberia`
--

DROP TABLE IF EXISTS `resenas_barberia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resenas_barberia` (
  `id_Resena_Barberia` int NOT NULL AUTO_INCREMENT,
  `id_Cliente` int NOT NULL,
  `Puntuacion` tinyint NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `status` enum('Activo','Inactivo') NOT NULL,
  PRIMARY KEY (`id_Resena_Barberia`),
  KEY `fk_Cliente` (`id_Cliente`),
  CONSTRAINT `fk_Cliente` FOREIGN KEY (`id_Cliente`) REFERENCES `clientes` (`id_Cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resenas_barberia`
--

LOCK TABLES `resenas_barberia` WRITE;
/*!40000 ALTER TABLE `resenas_barberia` DISABLE KEYS */;
INSERT INTO `resenas_barberia` VALUES (5,18,4,'ulda de bueno','Activo'),(6,24,5,'Muy buen servicio','Activo'),(7,25,3,'Excelentes servicios\r\n','Activo');
/*!40000 ALTER TABLE `resenas_barberia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resenas_empleados`
--

DROP TABLE IF EXISTS `resenas_empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resenas_empleados` (
  `Id_Resena_Empleado` int NOT NULL AUTO_INCREMENT,
  `Id_Cliente` int NOT NULL,
  `Id_Empleado` int NOT NULL,
  `Puntuacion` tinyint NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_Resena_Empleado`),
  KEY `Id_Cliente` (`Id_Cliente`),
  KEY `Id_Empleado` (`Id_Empleado`),
  CONSTRAINT `Id_Cliente` FOREIGN KEY (`Id_Cliente`) REFERENCES `clientes` (`id_Cliente`),
  CONSTRAINT `Id_Empleado` FOREIGN KEY (`Id_Empleado`) REFERENCES `empleado` (`Id_Empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resenas_empleados`
--

LOCK TABLES `resenas_empleados` WRITE;
/*!40000 ALTER TABLE `resenas_empleados` DISABLE KEYS */;
INSERT INTO `resenas_empleados` VALUES (9,18,11,4,'Muy buen servicio, mejor persona\r\n\r\n'),(10,18,11,2,'Muy mal sevicio'),(11,18,10,1,'malooo\r\n'),(12,18,10,2,'mediocreo'),(13,18,10,5,'mejorable'),(14,25,11,3,'Un duro\r\n');
/*!40000 ALTER TABLE `resenas_empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `id_Servicio` int NOT NULL AUTO_INCREMENT,
  `Precio` decimal(10,0) NOT NULL,
  `Duracion` int NOT NULL,
  `Id_Categoria` int NOT NULL,
  PRIMARY KEY (`id_Servicio`),
  KEY `fk_id_Categoria` (`Id_Categoria`),
  CONSTRAINT `fk_id_Categoria` FOREIGN KEY (`Id_Categoria`) REFERENCES `servicios_categoria` (`Id_Categoria`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (14,12,90,12),(15,7,40,13),(16,31,40,15),(17,40,21,13);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios_categoria`
--

DROP TABLE IF EXISTS `servicios_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios_categoria` (
  `Id_Categoria` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`Id_Categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios_categoria`
--

LOCK TABLES `servicios_categoria` WRITE;
/*!40000 ALTER TABLE `servicios_categoria` DISABLE KEYS */;
INSERT INTO `servicios_categoria` VALUES (12,'Corte de pelo'),(13,'Corte de barba'),(14,'Lavado capilar'),(15,'Corte de uñas'),(16,'Creatina');
/*!40000 ALTER TABLE `servicios_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios_reservados`
--

DROP TABLE IF EXISTS `servicios_reservados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios_reservados` (
  `id_Servicio_Reservado` int NOT NULL AUTO_INCREMENT,
  `Id_Cita` int NOT NULL,
  `Id_Servicio` int NOT NULL,
  PRIMARY KEY (`id_Servicio_Reservado`),
  KEY `fk_id_Cita` (`Id_Cita`),
  KEY `fk_id_Servicio` (`Id_Servicio`),
  CONSTRAINT `fk_id_Cita` FOREIGN KEY (`Id_Cita`) REFERENCES `citas` (`id_Citas`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_Servicio` FOREIGN KEY (`Id_Servicio`) REFERENCES `servicios` (`id_Servicio`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios_reservados`
--

LOCK TABLES `servicios_reservados` WRITE;
/*!40000 ALTER TABLE `servicios_reservados` DISABLE KEYS */;
INSERT INTO `servicios_reservados` VALUES (12,12,14),(13,13,14),(14,14,14),(15,15,14),(16,16,15),(17,17,16),(18,18,16),(19,19,15),(20,20,16);
/*!40000 ALTER TABLE `servicios_reservados` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-05  6:20:50
