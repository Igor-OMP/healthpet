-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: bdhealthpet
-- ------------------------------------------------------
-- Server version	5.7.11-log

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
-- Table structure for table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL AUTO_INCREMENT,
  `id_petshop` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `id_pet` int(11) NOT NULL,
  `dt_servico` date DEFAULT NULL,
  `flag_status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_agenda`),
  KEY `fk_agenda_petshop1_idx` (`id_petshop`),
  KEY `fk_agenda_servico1_idx` (`id_servico`),
  KEY `fk_agenda_pet1_idx` (`id_pet`),
  CONSTRAINT `fk_agenda_pet1` FOREIGN KEY (`id_pet`) REFERENCES `pet` (`id_pet`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_agenda_petshop1` FOREIGN KEY (`id_petshop`) REFERENCES `petshop` (`id_petshop`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_agenda_servico1` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agenda`
--

LOCK TABLES `agenda` WRITE;
/*!40000 ALTER TABLE `agenda` DISABLE KEYS */;
/*!40000 ALTER TABLE `agenda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cartao_vacina`
--

DROP TABLE IF EXISTS `cartao_vacina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_vacina` (
  `id_cartao_vacina` int(11) NOT NULL AUTO_INCREMENT,
  `id_petshop` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `dt_evento` datetime DEFAULT NULL,
  `txt_desc` text,
  PRIMARY KEY (`id_cartao_vacina`),
  KEY `fk_cartao_vacina_petshop1_idx` (`id_petshop`),
  KEY `fk_cartao_vacina_servico1_idx` (`id_servico`),
  CONSTRAINT `fk_cartao_vacina_petshop1` FOREIGN KEY (`id_petshop`) REFERENCES `petshop` (`id_petshop`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cartao_vacina_servico1` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartao_vacina`
--

LOCK TABLES `cartao_vacina` WRITE;
/*!40000 ALTER TABLE `cartao_vacina` DISABLE KEYS */;
INSERT INTO `cartao_vacina` VALUES (1,1,2,'2017-11-14 00:00:00',NULL),(2,2,2,'2017-11-29 00:00:00','{\"observacoes\":null}'),(5,2,3,'2017-11-30 00:00:00','{\"observacoes\":null}');
/*!40000 ALTER TABLE `cartao_vacina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cidade`
--

DROP TABLE IF EXISTS `cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cidade` (
  `id_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `nm_cidade` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_cidade`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cidade`
--

LOCK TABLES `cidade` WRITE;
/*!40000 ALTER TABLE `cidade` DISABLE KEYS */;
INSERT INTO `cidade` VALUES (1,'taguatinga'),(2,'brasília'),(3,'ceilândia');
/*!40000 ALTER TABLE `cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `nm_logradouro` varchar(50) NOT NULL,
  `nm_bairro` varchar(50) NOT NULL,
  `nr_cep` varchar(15) NOT NULL,
  `nr_num` varchar(10) DEFAULT NULL,
  `nm_complemento` varchar(25) DEFAULT NULL,
  `id_cidade` int(11) NOT NULL,
  PRIMARY KEY (`id_endereco`),
  KEY `fk_endereco_cidade1_idx` (`id_cidade`),
  CONSTRAINT `fk_endereco_cidade1` FOREIGN KEY (`id_cidade`) REFERENCES `cidade` (`id_cidade`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (3,'SQN 213, bloco D7','Asa Norte','70.872-777','11/13','Cln, 11/13',2),(4,'SQN 213, bloco D','Asa Norte','70.872-540','105','Cln, 11/13',2),(12,'Quadra 4 lote 10','Setor Norte','72.760-082','10','Lote 10',1);
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especie`
--

DROP TABLE IF EXISTS `especie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especie` (
  `id_especie` int(11) NOT NULL AUTO_INCREMENT,
  `nm_especie` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_especie`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especie`
--

LOCK TABLES `especie` WRITE;
/*!40000 ALTER TABLE `especie` DISABLE KEYS */;
INSERT INTO `especie` VALUES (1,'cachorro'),(2,'gato'),(3,'xxx'),(4,'cavalo'),(5,'yyyy');
/*!40000 ALTER TABLE `especie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `nm_user` varchar(100) NOT NULL,
  `em_email` varchar(100) NOT NULL,
  `pw_senha` varchar(45) DEFAULT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_login`),
  KEY `fk_login_tipo_usuario1_idx` (`id_tipo_usuario`),
  CONSTRAINT `fk_login_tipo_usuario1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'Administrador','admin@admin.com','21232f297a57a5a743894a0e4a801fc3',1);
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet`
--

DROP TABLE IF EXISTS `pet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet` (
  `id_pet` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_raca` int(11) NOT NULL,
  `nm_pet` varchar(45) NOT NULL,
  `dt_nasc` datetime DEFAULT NULL,
  `ft_pet` varchar(200) DEFAULT NULL,
  `flag_porte` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_pet`),
  KEY `fk_pet_raca1_idx` (`id_raca`),
  KEY `fk_pet_usuario1_idx` (`id_usuario`),
  CONSTRAINT `fk_pet_raca1` FOREIGN KEY (`id_raca`) REFERENCES `raca` (`id_raca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pet_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet`
--

LOCK TABLES `pet` WRITE;
/*!40000 ALTER TABLE `pet` DISABLE KEYS */;
INSERT INTO `pet` VALUES (20,9,4,'Thor4','2017-11-08 00:00:00',NULL,2);
/*!40000 ALTER TABLE `pet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet_cartao`
--

DROP TABLE IF EXISTS `pet_cartao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet_cartao` (
  `id_pet_cartao` int(11) NOT NULL AUTO_INCREMENT,
  `id_cartao_vacina` int(11) NOT NULL,
  `id_pet` int(11) NOT NULL,
  PRIMARY KEY (`id_pet_cartao`),
  KEY `fk_pet_cartao_cartao_vacina1_idx` (`id_cartao_vacina`),
  KEY `fk_pet_cartao_pet1_idx` (`id_pet`),
  CONSTRAINT `fk_pet_cartao_cartao_vacina1` FOREIGN KEY (`id_cartao_vacina`) REFERENCES `cartao_vacina` (`id_cartao_vacina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pet_cartao_pet1` FOREIGN KEY (`id_pet`) REFERENCES `pet` (`id_pet`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet_cartao`
--

LOCK TABLES `pet_cartao` WRITE;
/*!40000 ALTER TABLE `pet_cartao` DISABLE KEYS */;
/*!40000 ALTER TABLE `pet_cartao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `petshop`
--

DROP TABLE IF EXISTS `petshop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `petshop` (
  `id_petshop` int(11) NOT NULL AUTO_INCREMENT,
  `nm_petshop` varchar(45) NOT NULL,
  `nr_telefone` varchar(15) DEFAULT NULL,
  `em_email` varchar(100) DEFAULT NULL,
  `id_endereco` int(11) NOT NULL,
  PRIMARY KEY (`id_petshop`),
  KEY `fk_petshop_endereco1_idx` (`id_endereco`),
  CONSTRAINT `fk_petshop_endereco1` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id_endereco`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `petshop`
--

LOCK TABLES `petshop` WRITE;
/*!40000 ALTER TABLE `petshop` DISABLE KEYS */;
INSERT INTO `petshop` VALUES (1,'cão kilate66','(61) 3349-6777','caokilate66@gmail.com',3),(2,'gato qmia','(61) 3349-0799','caokilate@gmail.com',4),(8,'vaca qmuge','(61) 3540-1275','vacaqmuge@gmail.com',12);
/*!40000 ALTER TABLE `petshop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `petshop_servico`
--

DROP TABLE IF EXISTS `petshop_servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `petshop_servico` (
  `id_petshop_servico` int(11) NOT NULL AUTO_INCREMENT,
  `id_petshop` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  PRIMARY KEY (`id_petshop_servico`),
  KEY `fk_petshop_servico_petshop1_idx` (`id_petshop`),
  KEY `fk_petshop_servico_servico1_idx` (`id_servico`),
  CONSTRAINT `fk_petshop_servico_petshop1` FOREIGN KEY (`id_petshop`) REFERENCES `petshop` (`id_petshop`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_petshop_servico_servico1` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `petshop_servico`
--

LOCK TABLES `petshop_servico` WRITE;
/*!40000 ALTER TABLE `petshop_servico` DISABLE KEYS */;
INSERT INTO `petshop_servico` VALUES (16,2,1),(17,2,2),(18,2,3),(20,8,3),(28,1,1),(29,1,2);
/*!40000 ALTER TABLE `petshop_servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `raca`
--

DROP TABLE IF EXISTS `raca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `raca` (
  `id_raca` int(11) NOT NULL AUTO_INCREMENT,
  `nm_raca` varchar(50) DEFAULT NULL,
  `id_especie` int(11) NOT NULL,
  PRIMARY KEY (`id_raca`),
  KEY `fk_raca_especie1_idx` (`id_especie`),
  CONSTRAINT `fk_raca_especie1` FOREIGN KEY (`id_especie`) REFERENCES `especie` (`id_especie`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `raca`
--

LOCK TABLES `raca` WRITE;
/*!40000 ALTER TABLE `raca` DISABLE KEYS */;
INSERT INTO `raca` VALUES (1,'dobermann',1),(2,'pastor alemão',1),(3,'beagle',1),(4,'tarzan',3),(5,'arábe',4),(6,'cacatua',5);
/*!40000 ALTER TABLE `raca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servico`
--

DROP TABLE IF EXISTS `servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servico` (
  `id_servico` int(11) NOT NULL AUTO_INCREMENT,
  `id_servico_pai` int(11) DEFAULT NULL,
  `nm_servico` varchar(45) NOT NULL,
  PRIMARY KEY (`id_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico`
--

LOCK TABLES `servico` WRITE;
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
INSERT INTO `servico` VALUES (1,NULL,'consulta'),(2,NULL,'exame'),(3,NULL,'tosa e banho');
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_tipo_usuario` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'Administrador'),(2,'PetShop'),(3,'Usuário');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_usuario` varchar(100) NOT NULL,
  `em_email` varchar(100) NOT NULL,
  `pw_pass` varchar(32) DEFAULT NULL,
  `nr_tel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (9,'igor oliveira mota rico','igor.oliveira.rico@gmail.com','e50fc2e3e6e4f7103203c4c539f6ef83','(61) 98598-7777'),(10,'Igor Oliveira Mota Pires','igor.oliveira.m@gmail.com','e50fc2e3e6e4f7103203c4c539f6ef83','(61) 98598-6125');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_agenda`
--

DROP TABLE IF EXISTS `usuario_agenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_agenda` (
  `id_usuario_agenda` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_agenda` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario_agenda`),
  KEY `fk_usuario_agenda_usuario1_idx` (`id_usuario`),
  KEY `fk_usuario_agenda_agenda1_idx` (`id_agenda`),
  CONSTRAINT `fk_usuario_agenda_agenda1` FOREIGN KEY (`id_agenda`) REFERENCES `agenda` (`id_agenda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_agenda_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_agenda`
--

LOCK TABLES `usuario_agenda` WRITE;
/*!40000 ALTER TABLE `usuario_agenda` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_agenda` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-13 17:14:39
