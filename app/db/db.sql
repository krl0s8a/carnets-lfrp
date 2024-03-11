-- MySQL dump 10.17  Distrib 10.3.17-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cicarlos
-- ------------------------------------------------------
-- Server version	10.3.17-MariaDB-0+deb10u1

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
  `deleted` tinyint(12) NOT NULL DEFAULT 0,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,1,'logged in from: 127.0.0.1','users','2019-10-16 01:43:54',0),(2,1,'App settings saved from: 127.0.0.1','core','2019-10-16 01:44:38',0),(3,1,'modified user: admin','users','2019-10-16 01:45:32',0),(4,1,'logged in from: 127.0.0.1','users','2019-10-16 01:45:38',0),(5,1,'logged in from: 127.0.0.1','users','2019-10-16 20:05:08',0),(6,1,'logged in from: 127.0.0.1','users','2019-10-25 19:06:59',0),(7,1,'logged in from: 127.0.0.1','users','2019-10-28 01:33:57',0),(8,1,'logged in from: 127.0.0.1','users','2019-10-28 01:38:59',0),(9,1,'logged in from: 127.0.0.1','users','2019-10-28 01:39:56',0),(10,1,'logged in from: 127.0.0.1','users','2019-10-28 01:40:18',0),(11,1,'logged in from: 127.0.0.1','users','2019-10-28 21:31:33',0),(12,1,'logged in from: 127.0.0.1','users','2019-10-30 21:31:04',0),(13,1,'logged in from: 127.0.0.1','users','2019-10-31 14:17:55',0),(14,1,'logged in from: 127.0.0.1','users','2019-10-31 14:19:18',0),(15,1,'logged in from: 127.0.0.1','users','2019-10-31 21:41:41',0),(16,1,'App settings saved from: 127.0.0.1','core','2019-10-31 21:43:51',0),(17,1,'App settings saved from: 127.0.0.1','core','2019-10-31 21:50:37',0),(18,1,'App settings saved from: 127.0.0.1','core','2019-10-31 21:52:12',0),(19,1,'logged in from: 127.0.0.1','users','2019-11-02 09:29:10',0),(20,1,'logged in from: 127.0.0.1','users','2019-11-02 20:14:40',0),(21,1,'App settings saved from: 127.0.0.1','core','2019-11-04 09:20:03',0),(22,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-04 09:34:11',0),(23,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-04 09:36:12',0),(24,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-04 09:38:42',0),(25,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-04 10:13:45',0),(26,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-04 23:11:55',0),(27,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-04 23:38:32',0),(28,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 00:02:32',0),(29,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 00:59:27',0),(30,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 01:19:38',0),(31,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 01:21:33',0),(32,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 01:22:50',0),(33,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 01:25:02',0),(34,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 01:26:43',0),(35,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 01:27:55',0),(36,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 01:33:03',0),(37,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 01:37:25',0),(38,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 01:37:50',0),(39,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 01:45:49',0),(40,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 01:46:28',0),(41,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 06:55:20',0),(42,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 07:05:12',0),(43,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 07:08:43',0),(44,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 07:29:34',0),(45,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 07:30:19',0),(46,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 07:30:53',0),(47,1,'Configuración de la aplicación grabada desde: 127.0.0.1','core','2019-11-05 07:31:11',0),(48,1,'inicio de sesión desde: 127.0.0.1','users','2019-11-05 07:35:34',0),(49,1,'Configuración de la aplicación grabada desde: 127.0.0.1','core','2019-11-05 07:38:40',0),(50,1,'Configuración de la aplicación grabada desde: 127.0.0.1','core','2019-11-05 07:40:26',0),(51,1,'Configuración de la aplicación grabada desde: 127.0.0.1','core','2019-11-05 07:40:38',0);
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (2,'Site.Content.View','Allow users to view the Content Context','active'),(3,'Site.Reports.View','Allow users to view the Reports Context','active'),(4,'Site.Settings.View','Allow users to view the Settings Context','active'),(5,'Site.Developer.View','Allow users to view the Developer Context','active'),(6,'Bonfire.Roles.Manage','Allow users to manage the user Roles','active'),(7,'Bonfire.Users.Manage','Allow users to manage the site Users','active'),(8,'Bonfire.Users.View','Allow users access to the User Settings','active'),(9,'Bonfire.Users.Add','Allow users to add new Users','active'),(10,'Bonfire.Database.Manage','Allow users to manage the Database settings','active'),(11,'Bonfire.Emailer.Manage','Allow users to manage the Emailer settings','active'),(12,'Bonfire.Logs.View','Allow users access to the Log details','active'),(13,'Bonfire.Logs.Manage','Allow users to manage the Log files','active'),(14,'Bonfire.Emailer.View','Allow users access to the Emailer settings','active'),(15,'Site.Signin.Offline','Allow users to login to the site when the site is offline','active'),(16,'Bonfire.Permissions.View','Allow access to view the Permissions menu unders Settings Context','active'),(17,'Bonfire.Permissions.Manage','Allow access to manage the Permissions in the system','active'),(18,'Bonfire.Modules.Add','Allow creation of modules with the builder.','active'),(19,'Bonfire.Modules.Delete','Allow deletion of modules.','active'),(20,'Permissions.Administrator.Manage','To manage the access control permissions for the Administrator role.','active'),(21,'Permissions.Editor.Manage','To manage the access control permissions for the Editor role.','active'),(23,'Permissions.User.Manage','To manage the access control permissions for the User role.','active'),(24,'Permissions.Developer.Manage','To manage the access control permissions for the Developer role.','active'),(26,'Activities.Own.View','To view the users own activity logs','active'),(27,'Activities.Own.Delete','To delete the users own activity logs','active'),(28,'Activities.User.View','To view the user activity logs','active'),(29,'Activities.User.Delete','To delete the user activity logs, except own','active'),(30,'Activities.Module.View','To view the module activity logs','active'),(31,'Activities.Module.Delete','To delete the module activity logs','active'),(32,'Activities.Date.View','To view the users own activity logs','active'),(33,'Activities.Date.Delete','To delete the dated activity logs','active'),(34,'Bonfire.UI.Manage','Manage the Bonfire UI settings','active'),(35,'Bonfire.Settings.View','To view the site settings page.','active'),(36,'Bonfire.Settings.Manage','To manage the site settings.','active'),(37,'Bonfire.Activities.View','To view the Activities menu.','active'),(38,'Bonfire.Database.View','To view the Database menu.','active'),(39,'Bonfire.Migrations.View','To view the Migrations menu.','active'),(40,'Bonfire.Builder.View','To view the Modulebuilder menu.','active'),(41,'Bonfire.Roles.View','To view the Roles menu.','active'),(42,'Bonfire.Sysinfo.View','To view the System Information page.','active'),(43,'Bonfire.Translate.Manage','To manage the Language Translation.','active'),(44,'Bonfire.Translate.View','To view the Language Translate menu.','active'),(45,'Bonfire.UI.View','To view the UI/Keyboard Shortcut menu.','active'),(48,'Bonfire.Profiler.View','To view the Console Profiler Bar.','active'),(49,'Bonfire.Roles.Add','To add New Roles','active');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
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
INSERT INTO `role_permissions` VALUES (1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,23),(1,24),(1,26),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(1,40),(1,41),(1,42),(1,43),(1,44),(1,45),(1,48),(1,49),(2,2),(2,3),(6,2),(6,3),(6,4),(6,5),(6,6),(6,7),(6,8),(6,9),(6,10),(6,11),(6,12),(6,13),(6,48);
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
  `deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator','Has full control over every aspect of the site.',0,0,'','content',0),(2,'Editor','Can handle day-to-day management, but does not have full power.',0,1,'','content',0),(4,'User','This is the default user with access to login.',1,0,'','content',0),(6,'Developer','Developers typically are the only ones that can access the developer tools. Otherwise identical to Administrators, at least until the site is handed off.',0,1,'','content',0);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schema_version`
--

DROP TABLE IF EXISTS `schema_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schema_version` (
  `type` varchar(40) NOT NULL,
  `version` int(4) NOT NULL DEFAULT 0,
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
INSERT INTO `settings` VALUES ('auth.allow_name_change','core','1'),('auth.allow_register','core','1'),('auth.allow_remember','core','1'),('auth.do_login_redirect','core','1'),('auth.login_type','core','both'),('auth.name_change_frequency','core','1'),('auth.name_change_limit','core','1'),('auth.password_force_mixed_case','core','0'),('auth.password_force_numbers','core','0'),('auth.password_force_symbols','core','0'),('auth.password_min_length','core','8'),('auth.password_show_labels','core','0'),('auth.remember_length','core','1209600'),('auth.user_activation_method','core','0'),('auth.use_extended_profile','core','0'),('auth.use_usernames','core','1'),('ext.country','core','US'),('ext.state','core',''),('ext.street_name','core',''),('ext.type','core','small'),('form_save','core.ui','ctrl+s/⌘+s'),('goto_content','core.ui','alt+c'),('mailpath','email','/usr/sbin/sendmail'),('mailtype','email','text'),('password_iterations','users','8'),('protocol','email','mail'),('sender_email','email',''),('site.languages','core','a:2:{i:0;s:7:\"english\";i:1;s:7:\"spanish\";}'),('site.list_limit','core','25'),('site.offline_reason','core',''),('site.show_front_profiler','core','0'),('site.show_profiler','core','0'),('site.status','core','1'),('site.system_email','core','admin@tecnomati.co'),('site.title','core','Direccion de Inmuebles'),('smtp_host','email',''),('smtp_pass','email',''),('smtp_port','email',''),('smtp_timeout','email',''),('smtp_user','email','');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
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
  `meta_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
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
  `password_hash` char(60) DEFAULT NULL,
  `reset_hash` varchar(40) DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(45) NOT NULL DEFAULT '',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `reset_by` int(10) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT 0,
  `ban_message` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT '',
  `display_name_changed` date DEFAULT NULL,
  `timezone` varchar(40) NOT NULL DEFAULT 'UM3',
  `language` varchar(20) NOT NULL DEFAULT 'spanish',
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `activate_hash` varchar(40) NOT NULL DEFAULT '',
  `force_password_reset` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'admin@tecnomati.co','admin','$2a$08$yhwAREeIyIXpnB9SSDlkEOQjqbcPHqFxvN5kCnDGvJfRUHpUNnyfe',NULL,'2019-11-05 07:35:34','127.0.0.1','2019-10-16 01:39:35',0,NULL,0,NULL,'admin',NULL,'UM3','spanish',1,'',0);
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

-- Dump completed on 2019-11-05  7:46:26
