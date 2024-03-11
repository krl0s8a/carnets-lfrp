-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: futurosrl
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `abonos`
--

DROP TABLE IF EXISTS `abonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abonos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number_abono` int(6) unsigned zerofill NOT NULL,
  `passenger_school_id` int(10) NOT NULL,
  `period` char(7) DEFAULT NULL,
  `ida` tinyint(2) NOT NULL DEFAULT 0 COMMENT 'Cantidad de pasajes de ida',
  `vta` tinyint(2) NOT NULL DEFAULT 0,
  `discount` decimal(2,0) DEFAULT NULL COMMENT 'Descuento',
  `status` tinyint(1) DEFAULT 0 COMMENT '1:pendiente, 2: impreso; 3:anulado',
  `price_id` int(10) NOT NULL COMMENT 'Identificador del precio del boleto',
  `created_on` datetime NOT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number_ticket` (`number_abono`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abonos`
--

LOCK TABLES `abonos` WRITE;
/*!40000 ALTER TABLE `abonos` DISABLE KEYS */;
/*!40000 ALTER TABLE `abonos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `activity_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `activity` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,1,'cierre de sesión desde: 127.0.0.1','users','2020-05-23 17:18:16',0),(2,1,'inicio de sesión desde: 127.0.0.1','users','2020-05-23 17:18:23',0),(3,1,'cierre de sesión desde: 127.0.0.1','users','2020-05-23 18:36:14',0),(4,1,'inicio de sesión desde: 127.0.0.1','users','2020-05-23 18:36:34',0),(5,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-05 03:55:08',0),(6,1,'cierre de sesión desde: 127.0.0.1','users','2020-06-05 04:37:16',0),(7,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-05 05:17:04',0),(8,1,'cierre de sesión desde: 127.0.0.1','users','2020-06-05 06:54:13',0),(9,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-05 07:37:20',0),(10,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-05 20:51:13',0),(11,1,'cierre de sesión desde: 127.0.0.1','users','2020-06-05 20:51:58',0),(12,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-05 20:52:02',0),(13,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-05 23:55:09',0),(14,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-06 09:24:30',0),(15,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-06 21:03:31',0),(16,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-07 11:39:34',0),(17,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-07 21:32:48',0),(18,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-08 11:25:19',0),(19,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-08 21:18:04',0),(20,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-09 06:12:08',0),(21,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-09 21:39:42',0),(22,1,'inicio de sesión desde: 127.0.0.1','users','2020-06-22 22:55:40',0);
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buses`
--

DROP TABLE IF EXISTS `buses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `registration` varchar(100) NOT NULL,
  `model` varchar(50) NOT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'T',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buses`
--

LOCK TABLES `buses` WRITE;
/*!40000 ALTER TABLE `buses` DISABLE KEYS */;
INSERT INTO `buses` VALUES (1,'Colectivo 1','87GUY','Chevrolet','T'),(2,'Colectivo 2','GJGDUHK','SKania','T');
/*!40000 ALTER TABLE `buses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci3_sessions`
--

DROP TABLE IF EXISTS `ci3_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci3_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci3_sessions`
--

LOCK TABLES `ci3_sessions` WRITE;
/*!40000 ALTER TABLE `ci3_sessions` DISABLE KEYS */;
INSERT INTO `ci3_sessions` VALUES ('7n0d2pqtjb7jds4n59fv8rnmb94nl1qh','127.0.0.1',1572051793,'__ci_last_regenerate|i:1572051793;requested_page|s:22:\"http://cicarlos.local/\";previous_page|s:22:\"http://cicarlos.local/\";'),('bo5f45fk8uu20570e3s40d92f6i9iga0','127.0.0.1',1571201132,'__ci_last_regenerate|i:1571201132;requested_page|s:46:\"http://bonfire.local/admin/settings/users/edit\";previous_page|s:46:\"http://bonfire.local/admin/settings/users/edit\";user_id|s:1:\"1\";auth_custom|s:5:\"admin\";user_token|s:40:\"00f6fdc6cff9d792ab41456646edc3f100d4a8b7\";identity|s:19:\"admin@mybonfire.com\";role_id|s:1:\"1\";logged_in|b:1;language|s:7:\"english\";'),('dv38899b16uk0ogdesjl1gnhgajl0gvn','127.0.0.1',1572036745,'__ci_last_regenerate|i:1572036745;requested_page|s:22:\"http://cicarlos.local/\";previous_page|s:22:\"http://cicarlos.local/\";'),('ee4sgs6npq2bvcfnra3h3h10gtb1gp41','127.0.0.1',1572040743,'__ci_last_regenerate|i:1572040743;requested_page|s:22:\"http://cicarlos.local/\";previous_page|s:22:\"http://cicarlos.local/\";'),('fl3ofcbhhbiildprhtacisnsskb46e91','127.0.0.1',1572041760,'__ci_last_regenerate|i:1572041642;requested_page|s:55:\"http://cicarlos.local/admin/settings/permissions/edit/6\";previous_page|s:55:\"http://cicarlos.local/admin/settings/permissions/edit/6\";user_id|s:1:\"1\";auth_custom|s:5:\"admin\";user_token|s:40:\"4308cfb7dce21c1c1977ace327828196dfa1f2f6\";identity|s:19:\"admin@mybonfire.com\";role_id|s:1:\"1\";logged_in|b:1;language|s:10:\"spanish_am\";'),('gfssb9416ecbtjqeig13i7rokosnrctb','127.0.0.1',1572041161,'__ci_last_regenerate|i:1572041161;requested_page|s:22:\"http://cicarlos.local/\";previous_page|s:22:\"http://cicarlos.local/\";'),('mev4vna6t1epd3dvkivrruvpm0skog6k','127.0.0.1',1572051812,'__ci_last_regenerate|i:1572051793;requested_page|s:22:\"http://cicarlos.local/\";previous_page|s:22:\"http://cicarlos.local/\";'),('n58v2710nongtrv4bp1qbhciokrt3kd3','127.0.0.1',1571267118,'__ci_last_regenerate|i:1571267074;requested_page|s:41:\"http://bonfire.local/admin/settings/users\";previous_page|s:41:\"http://bonfire.local/admin/settings/users\";user_id|s:1:\"1\";auth_custom|s:5:\"admin\";user_token|s:40:\"4308cfb7dce21c1c1977ace327828196dfa1f2f6\";identity|s:19:\"admin@mybonfire.com\";role_id|s:1:\"1\";logged_in|b:1;language|s:10:\"spanish_am\";'),('nldtd019nrnhta410sc6crki23sm2hko','127.0.0.1',1571201198,'__ci_last_regenerate|i:1571201132;requested_page|s:34:\"http://bonfire.local/admin/content\";previous_page|s:34:\"http://bonfire.local/admin/content\";user_id|s:1:\"1\";auth_custom|s:5:\"admin\";user_token|s:40:\"4308cfb7dce21c1c1977ace327828196dfa1f2f6\";identity|s:19:\"admin@mybonfire.com\";role_id|s:1:\"1\";logged_in|b:1;language|s:10:\"spanish_am\";'),('pobfuorjk0karri0h413btm46sms5i8i','127.0.0.1',1572038490,'__ci_last_regenerate|i:1572038490;requested_page|s:22:\"http://cicarlos.local/\";previous_page|s:22:\"http://cicarlos.local/\";'),('sbdg6lgu37pl4v79pt2jeptb76rfaldp','127.0.0.1',1572041642,'__ci_last_regenerate|i:1572041642;requested_page|s:42:\"http://cicarlos.local/admin/settings/users\";previous_page|s:42:\"http://cicarlos.local/admin/settings/users\";user_id|s:1:\"1\";auth_custom|s:5:\"admin\";user_token|s:40:\"4308cfb7dce21c1c1977ace327828196dfa1f2f6\";identity|s:19:\"admin@mybonfire.com\";role_id|s:1:\"1\";logged_in|b:1;language|s:10:\"spanish_am\";'),('tqooh6din07vl57ka51rcq34768b38b0','127.0.0.1',1572038074,'__ci_last_regenerate|i:1572038074;requested_page|s:22:\"http://cicarlos.local/\";previous_page|s:22:\"http://cicarlos.local/\";'),('ts313qn07u8dfhfqa6bbe148oui7ognr','127.0.0.1',1572040387,'__ci_last_regenerate|i:1572040387;requested_page|s:22:\"http://cicarlos.local/\";previous_page|s:22:\"http://cicarlos.local/\";'),('vhph838ln2ncn2trkdevc2k7po2u8jav','127.0.0.1',1572051409,'__ci_last_regenerate|i:1572051409;requested_page|s:22:\"http://cicarlos.local/\";previous_page|s:22:\"http://cicarlos.local/\";');
/*!40000 ALTER TABLE `ci3_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(3) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `status` enum('T','F') DEFAULT 'T',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'SSJ','San Salvador de Jujuy','T'),(2,'ALC','Alto Comedero','T'),(3,'ALI','Los Alisos','T'),(4,'AVA','Los Avalos','T'),(5,'CAR','El Carmen','T'),(6,'FCA','Finca Carrizo','T'),(7,'SVI','San Vicente','T'),(8,'MON','Monterrico','T'),(9,'LOV','La Ovejeria','T'),(10,'LAP','Los Lapachos','T'),(11,'SRC','Cruce Scaro','T'),(12,'CLT','Campo la tuna','T'),(13,'CAR','Coronel Arias','T'),(14,'SDO','Santo Domingo','T'),(15,'CPE','Ciudad Perico','T'),(16,'SAP','San Pedro','T'),(17,'ROD','Rodeito','T'),(18,'PTL','Pte Lavallen','T'),(19,'ELA','El Arenal','T'),(20,'CHA','Chamical','T'),(21,'CRC','Cruce Cañadas','T'),(22,'ELP','El Piquete','T'),(23,'SAC','Santa Clara','T'),(24,'ELC','El Canal','T'),(25,'EMI','El Milagro','T'),(26,'PAL','Palpala','T'),(27,'SUN','El sunchal','T'),(28,'CAT','Catamontaña','T'),(29,'LPO','La Posta','T'),(30,'LPA','Las Pampitas','T'),(31,'SEV','Severino','T'),(32,'CEI','El Ceibal','T'),(33,'CLM','Colonia las Mercedes','T'),(34,'ROB','Roble','T');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_queue`
--

DROP TABLE IF EXISTS `email_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(254) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `alt_message` text DEFAULT NULL,
  `max_attempts` int(11) NOT NULL DEFAULT 3,
  `attempts` int(11) NOT NULL DEFAULT 0,
  `success` tinyint(1) NOT NULL DEFAULT 0,
  `date_published` datetime DEFAULT NULL,
  `last_attempt` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `csv_attachment` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_queue`
--

LOCK TABLES `email_queue` WRITE;
/*!40000 ALTER TABLE `email_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passengers`
--

DROP TABLE IF EXISTS `passengers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passengers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:docente, 2:Estudiante,  3 : Particular',
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `dni` int(8) unsigned NOT NULL,
  `from_default` int(10) NOT NULL DEFAULT 0 COMMENT 'Origen por defecto',
  `to_default` int(10) NOT NULL DEFAULT 0 COMMENT 'Destino por defecto',
  `address_city` int(10) NOT NULL COMMENT 'Domicilio Localidad',
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_dni_IDX` (`dni`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passengers`
--

LOCK TABLES `passengers` WRITE;
/*!40000 ALTER TABLE `passengers` DISABLE KEYS */;
INSERT INTO `passengers` VALUES (1,1,'Hector Matias','Barro',35911363,15,25,8,NULL),(2,1,'Pablo Nicolas','Choque',29320428,15,25,15,NULL),(3,1,'Marcela','Choque',23923191,5,15,5,NULL),(4,1,'Miriam Deolinda','Farfan',24990359,15,25,16,NULL),(5,1,'Sara Esther','Sandoval',14312964,15,5,5,NULL),(6,1,'Hector Armando','Carrizo',26793699,15,25,15,NULL),(7,1,'Monica','Vargas',29978235,15,25,15,NULL),(8,1,'Norma','Nico',21194666,15,5,5,NULL),(9,1,'Gloria Vanesa','Juarez',28187361,15,5,5,NULL),(10,1,'Maria Eugenia','Mamani',23434761,15,8,26,NULL),(11,1,'Carmen Judith','Acsama',34022118,15,7,15,NULL),(12,3,'Carlos','Ochoa',28977467,1,1,1,'2020-05-20 17:13:20'),(13,1,'Flavia','Tolaba',23985618,1,2,1,'2020-05-20 19:22:31');
/*!40000 ALTER TABLE `passengers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passengers_schools`
--

DROP TABLE IF EXISTS `passengers_schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passengers_schools` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `passenger_id` int(10) NOT NULL,
  `school_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passengers_schools`
--

LOCK TABLES `passengers_schools` WRITE;
/*!40000 ALTER TABLE `passengers_schools` DISABLE KEYS */;
INSERT INTO `passengers_schools` VALUES (1,1,2),(2,2,2),(3,3,2),(4,4,2),(5,5,2),(6,6,2),(7,7,2),(8,8,2),(9,9,2),(10,10,2),(11,11,5),(12,12,0),(13,13,0);
/*!40000 ALTER TABLE `passengers_schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (2,'Site.Content.View','Allow users to view the Content Context','active'),(3,'Site.Reports.View','Allow users to view the Reports Context','active'),(4,'Site.Settings.View','Allow users to view the Settings Context','active'),(5,'Site.Developer.View','Allow users to view the Developer Context','active'),(6,'Bonfire.Roles.Manage','Allow users to manage the user Roles','active'),(7,'Bonfire.Users.Manage','Allow users to manage the site Users','active'),(8,'Bonfire.Users.View','Allow users access to the User Settings','active'),(9,'Bonfire.Users.Add','Allow users to add new Users','active'),(10,'Bonfire.Database.Manage','Allow users to manage the Database settings','active'),(11,'Bonfire.Emailer.Manage','Allow users to manage the Emailer settings','active'),(12,'Bonfire.Logs.View','Allow users access to the Log details','active'),(13,'Bonfire.Logs.Manage','Allow users to manage the Log files','active'),(14,'Bonfire.Emailer.View','Allow users access to the Emailer settings','active'),(15,'Site.Signin.Offline','Allow users to login to the site when the site is offline','active'),(16,'Bonfire.Permissions.View','Allow access to view the Permissions menu unders Settings Context','active'),(17,'Bonfire.Permissions.Manage','Allow access to manage the Permissions in the system','active'),(18,'Bonfire.Modules.Add','Allow creation of modules with the builder.','active'),(19,'Bonfire.Modules.Delete','Allow deletion of modules.','active'),(20,'Permissions.Administrator.Manage','To manage the access control permissions for the Administrator role.','active'),(21,'Permissions.Editor.Manage','To manage the access control permissions for the Editor role.','active'),(23,'Permissions.User.Manage','To manage the access control permissions for the User role.','active'),(24,'Permissions.Developer.Manage','To manage the access control permissions for the Developer role.','active'),(26,'Activities.Own.View','To view the users own activity logs','active'),(27,'Activities.Own.Delete','To delete the users own activity logs','active'),(28,'Activities.User.View','To view the user activity logs','active'),(29,'Activities.User.Delete','To delete the user activity logs, except own','active'),(30,'Activities.Module.View','To view the module activity logs','active'),(31,'Activities.Module.Delete','To delete the module activity logs','active'),(32,'Activities.Date.View','To view the users own activity logs','active'),(33,'Activities.Date.Delete','To delete the dated activity logs','active'),(34,'Bonfire.UI.Manage','Manage the Bonfire UI settings','active'),(35,'Bonfire.Settings.View','To view the site settings page.','active'),(36,'Bonfire.Settings.Manage','To manage the site settings.','active'),(37,'Bonfire.Activities.View','To view the Activities menu.','active'),(38,'Bonfire.Database.View','To view the Database menu.','active'),(39,'Bonfire.Migrations.View','To view the Migrations menu.','active'),(40,'Bonfire.Builder.View','To view the Modulebuilder menu.','active'),(41,'Bonfire.Roles.View','To view the Roles menu.','active'),(42,'Bonfire.Sysinfo.View','To view the System Information page.','active'),(43,'Bonfire.Translate.Manage','To manage the Language Translation.','active'),(44,'Bonfire.Translate.View','To view the Language Translate menu.','active'),(45,'Bonfire.UI.View','To view the UI/Keyboard Shortcut menu.','active'),(48,'Bonfire.Profiler.View','To view the Console Profiler Bar.','active'),(49,'Bonfire.Roles.Add','To add New Roles','active'),(50,'Permissions.Inscriptor.Manage','To manage the access control permissions for the Inscriptor role.','active'),(51,'Traffic.Routes.Add','','active');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tariff_id` int(10) unsigned NOT NULL,
  `from` int(10) NOT NULL,
  `to` int(10) NOT NULL,
  `price` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (1,1,1,4,2.80),(2,1,1,5,3.10),(3,1,1,20,3.80),(4,1,1,7,3.70),(5,1,1,8,4.10),(6,1,1,13,4.80),(7,1,1,14,4.80),(8,1,1,9,5.10),(9,1,1,2,21.49),(10,1,1,3,23.70),(11,1,1,6,45.30),(12,1,1,10,34.80),(13,1,1,11,29.40),(14,1,1,12,67.40),(15,1,1,15,29.70),(16,1,1,16,54.00),(17,1,1,17,64.00),(18,1,15,25,68.30),(19,1,15,7,45.90),(20,1,15,8,56.00),(21,1,5,15,23.00);
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` VALUES (1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,23),(1,24),(1,26),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(1,40),(1,41),(1,42),(1,43),(1,44),(1,45),(1,48),(1,49),(1,50),(1,51),(2,2),(2,3),(6,2),(6,3),(6,4),(6,5),(6,6),(6,7),(6,8),(6,9),(6,10),(6,11),(6,12),(6,13),(6,48);
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(60) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT 0,
  `can_delete` tinyint(1) NOT NULL DEFAULT 1,
  `login_destination` varchar(255) NOT NULL DEFAULT '/',
  `default_context` varchar(255) DEFAULT 'content',
  `deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator','<p>\r\n	Tiene el control completo del sistema</p>',0,0,'/welcome','content',0),(4,'User','<p>Usuario con permisos limitados</p>',1,1,'/home','content',0);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `routes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `from_city_id` int(10) DEFAULT NULL,
  `to_city_id` int(10) DEFAULT NULL,
  `status` enum('T','F') DEFAULT 'T',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routes`
--

LOCK TABLES `routes` WRITE;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` VALUES (13,'Ciudad Perico - San Salvador de Jujuy',15,1,'T'),(14,'San Salvador de Jujuy - Ciudad Perico',1,15,'T');
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routes_cities`
--

DROP TABLE IF EXISTS `routes_cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `routes_cities` (
  `route_id` int(10) unsigned NOT NULL,
  `city_id` int(10) unsigned NOT NULL,
  `order` tinyint(3) NOT NULL,
  KEY `cities_FK` (`city_id`),
  KEY `routes_FK` (`route_id`),
  CONSTRAINT `routes_cities_FK` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routes_cities`
--

LOCK TABLES `routes_cities` WRITE;
/*!40000 ALTER TABLE `routes_cities` DISABLE KEYS */;
INSERT INTO `routes_cities` VALUES (13,15,1),(13,8,2),(13,5,3),(13,4,4),(13,3,5),(13,1,6),(14,1,1),(14,3,2),(14,4,3),(14,5,4),(14,8,5),(14,15,6);
/*!40000 ALTER TABLE `routes_cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rrhh`
--

DROP TABLE IF EXISTS `rrhh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rrhh` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `work_file` int(5) unsigned NOT NULL,
  `position` enum('Administracion','Chofer','Taller','Boleteria','Inspector','Socio') DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `cuil` varchar(13) NOT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'T',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cuil_unique` (`cuil`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rrhh`
--

LOCK TABLES `rrhh` WRITE;
/*!40000 ALTER TABLE `rrhh` DISABLE KEYS */;
INSERT INTO `rrhh` VALUES (1,105,'Taller','Abad','Guillermo','20-28455016-2','T'),(2,94,'Socio','Ayarde','Adrian','20-21322660-7','T'),(3,66,'Chofer','Humacata','Mirta','2710805893-0','T'),(4,95,'Boleteria','Alancay','Carlos','20-17146550-9','T'),(5,51,'Administracion','Adauto','Victor','20-25751140-6','T'),(7,71,'Taller','Alarcon','Atilio Facundo','20-35911253-0','T'),(8,65,'Taller','Aleman','Ruben Leonardo','23-24996886-9','T'),(9,88,'Taller','Buffil','Victor Hugo','23-14412368-9','T'),(10,98,'Taller','Cruz','Bernardo Alonso','20-30009736-8','T'),(11,59,'Taller','Cuellar','Jorge Luis','20-24423149-8','T'),(12,55,'Taller','Funes','Emilio Jose','20-13121604-2','T'),(13,16,'Taller','Gonzalez','Antonio','20-22985181-1','T');
/*!40000 ALTER TABLE `rrhh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schema_version`
--

DROP TABLE IF EXISTS `schema_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schema_version` (
  `type` varchar(40) NOT NULL,
  `version` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schema_version`
--

LOCK TABLES `schema_version` WRITE;
/*!40000 ALTER TABLE `schema_version` DISABLE KEYS */;
INSERT INTO `schema_version` VALUES ('core',44);
/*!40000 ALTER TABLE `schema_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schools` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `number` int(4) DEFAULT NULL,
  `cue` char(9) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `level` enum('Consejo','Digemas') DEFAULT 'Consejo',
  `city_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='Shools';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (1,'Secundario N° 35',35,NULL,NULL,'Consejo',3),(2,'Latinoamerica  n° 386',386,'','','Consejo',25),(3,'Coordinacion de Educacion para jovenes y adultos',0,'','123123123','Consejo',15),(4,'Colegio Nuevo Horizonte Mundo Magico de Susy',2,'','','Digemas',7),(5,'Colegio Nuevo Horizonte N° 2 San Vicente Monterrico',2,'','','Consejo',7),(8,'Ingeniero Ricardo Rueda',0,'280004700','3884916234','Consejo',2);
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` enum('comun','especial') NOT NULL DEFAULT 'comun',
  `route_id` int(10) unsigned NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `recurring` varchar(255) DEFAULT NULL,
  `set_seats_count` enum('T','F') NOT NULL,
  `discount` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (4,'SSJ-CiudadPerico 06.00','comun',14,'2020-06-09','0000-00-00','06:00:00','07:20:00','monday|tuesday|wednesday|thursday|friday|saturday|sunday','T',NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services_dates`
--

DROP TABLE IF EXISTS `services_dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services_dates` (
  `service_id` int(10) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`service_id`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services_dates`
--

LOCK TABLES `services_dates` WRITE;
/*!40000 ALTER TABLE `services_dates` DISABLE KEYS */;
/*!40000 ALTER TABLE `services_dates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services_locations`
--

DROP TABLE IF EXISTS `services_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services_locations` (
  `service_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  PRIMARY KEY (`service_id`,`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services_locations`
--

LOCK TABLES `services_locations` WRITE;
/*!40000 ALTER TABLE `services_locations` DISABLE KEYS */;
INSERT INTO `services_locations` VALUES (4,1,'06:00:00','00:00:00'),(4,3,'06:20:00','06:20:00'),(4,4,'06:25:00','06:25:00'),(4,5,'06:40:00','06:40:00'),(4,8,'07:00:00','07:00:00'),(4,15,'00:00:00','07:20:00');
/*!40000 ALTER TABLE `services_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT 0,
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `name` varchar(30) NOT NULL,
  `module` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES ('allow_print_number_ticket','core','1'),('auth.allow_name_change','core','1'),('auth.allow_register','core','1'),('auth.allow_remember','core','1'),('auth.do_login_redirect','core','1'),('auth.login_type','core','username'),('auth.name_change_frequency','core','1'),('auth.name_change_limit','core','1'),('auth.password_force_mixed_case','core','0'),('auth.password_force_numbers','core','0'),('auth.password_force_symbols','core','0'),('auth.password_min_length','core','8'),('auth.password_show_labels','core','0'),('auth.remember_length','core','1209600'),('auth.user_activation_method','core','0'),('auth.use_extended_profile','core','0'),('auth.use_usernames','core','1'),('ext.country','core','US'),('ext.state','core',''),('ext.street_name','core',''),('ext.type','core','small'),('form_save','core.ui','ctrl+s/⌘+s'),('goto_content','core.ui','alt+c'),('mailpath','email','/usr/sbin/sendmail'),('mailtype','email','text'),('password_iterations','users','8'),('protocol','email','mail'),('sender_email','email',''),('site.languages','core','a:1:{i:0;s:7:\"spanish\";}'),('site.list_limit','core','10'),('site.offline_reason','core',''),('site.show_front_profiler','core','0'),('site.show_profiler','core','0'),('site.status','core','1'),('site.system_email','core','admin@tecnomati.co'),('site.title','core','Futuro SRL'),('smtp_host','email',''),('smtp_pass','email',''),('smtp_port','email',''),('smtp_timeout','email',''),('smtp_user','email','');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tariffs`
--

DROP TABLE IF EXISTS `tariffs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tariffs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `route_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `status` enum('T','F') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tariffs`
--

LOCK TABLES `tariffs` WRITE;
/*!40000 ALTER TABLE `tariffs` DISABLE KEYS */;
INSERT INTO `tariffs` VALUES (1,1,'Tarifa 1','2020-04-27',NULL,'T');
/*!40000 ALTER TABLE `tariffs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `quantity` int(4) unsigned NOT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'T',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,'Boleto --05.00--',5.00,1000,'T'),(2,'Boleto --40.00--',40.00,1000,'T'),(3,'Boleto --80.00--',80.00,1000,'T'),(4,'Boleto --50.00--',50.00,1000,'T'),(5,'Boleto --70.00--',70.00,1000,'T'),(6,'Boleto A',30.00,1000,'T'),(7,'Boleto J.C.J',65.00,1000,'T'),(8,'Boleto --60.00--',60.00,1000,'T'),(9,'Boleto J.M.',85.00,1000,'T'),(10,'Boleto S.P-J.L',90.00,1000,'T'),(11,'Boleto Urbano --35.00--',35.00,1000,'T'),(12,'PASAJE GRAL',1.00,1000,'T'),(13,'PRIMARIO',5.00,1000,'T'),(14,'SECUNDARIO',10.00,1000,'T'),(15,'GRAL 25',25.00,1000,'T');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_cookies`
--

DROP TABLE IF EXISTS `user_cookies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_cookies` (
  `user_id` bigint(20) unsigned NOT NULL,
  `token` varchar(128) NOT NULL,
  `created_on` datetime NOT NULL,
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_cookies`
--

LOCK TABLES `user_cookies` WRITE;
/*!40000 ALTER TABLE `user_cookies` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_cookies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_meta`
--

DROP TABLE IF EXISTS `user_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_meta` (
  `meta_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) NOT NULL DEFAULT '',
  `meta_value` text DEFAULT NULL,
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_meta`
--

LOCK TABLES `user_meta` WRITE;
/*!40000 ALTER TABLE `user_meta` DISABLE KEYS */;
INSERT INTO `user_meta` VALUES (1,1,'state',''),(2,1,'country','US');
/*!40000 ALTER TABLE `user_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT 4,
  `email` varchar(254) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `gender` varchar(20) NOT NULL,
  `password_hash` char(60) DEFAULT NULL,
  `reset_hash` varchar(40) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_ip` varchar(45) NOT NULL DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `reset_by` int(11) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT 0,
  `ban_message` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT '',
  `display_name_changed` date DEFAULT NULL,
  `timezone` varchar(40) NOT NULL DEFAULT 'UM3',
  `language` varchar(20) NOT NULL DEFAULT 'spanish',
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `activate_hash` varchar(40) NOT NULL DEFAULT '',
  `force_password_reset` tinyint(1) DEFAULT 0,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'admin@admin.com','admin','male','$2a$08$lWeowQ0DwAtsY.OVELNvgeZl95Oe/Y5t2LyJGrSchj49CwDtoQ5wq',NULL,'2020-06-22 22:55:40','127.0.0.1','2019-10-16 01:39:35',0,NULL,0,NULL,'admin',NULL,'UM3','spanish',1,'',0,NULL),(4,1,'futuro@futurosrl.com','futuro','male','$2a$08$Ai9WwLWX0ZU4vcPpbgeZZeupcW.0tmvvxKV/GbMzv54Fr/l/.GvWO',NULL,'2020-05-23 12:51:15','127.0.0.1','2020-05-23 12:50:41',0,NULL,0,NULL,'Futuro',NULL,'UM3','spanish',1,'',0,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-27 12:02:54
