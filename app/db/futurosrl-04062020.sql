-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-05-2020 a las 05:58:53
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `futurosrl`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

CREATE TABLE `abonos` (
  `id` int(10) UNSIGNED NOT NULL,
  `number_abono` int(6) UNSIGNED ZEROFILL NOT NULL,
  `passenger_school_id` int(10) NOT NULL,
  `period` char(7) DEFAULT NULL,
  `ida` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Cantidad de pasajes de ida',
  `vta` tinyint(2) NOT NULL DEFAULT '0',
  `discount` decimal(2,0) DEFAULT NULL COMMENT 'Descuento',
  `status` tinyint(1) DEFAULT '0' COMMENT '1:pendiente, 2: impreso; 3:anulado',
  `price_id` int(10) NOT NULL COMMENT 'Identificador del precio del boleto',
  `created_on` datetime NOT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `abonos`
--

INSERT INTO `abonos` (`id`, `number_abono`, `passenger_school_id`, `period`, `ida`, `vta`, `discount`, `status`, `price_id`, `created_on`, `modified_on`) VALUES
(30, 000001, 1, '05/2020', 1, 1, '0', 2, 18, '2020-05-23 14:34:40', '2020-05-23 14:34:54'),
(31, 000002, 6, '05/2020', 1, 1, '0', 2, 18, '2020-05-23 14:34:40', '2020-05-23 14:34:54'),
(32, 000003, 2, '05/2020', 1, 1, '0', 2, 18, '2020-05-23 14:34:40', '2020-05-23 14:34:54'),
(33, 000004, 3, '05/2020', 1, 1, '0', 2, 21, '2020-05-23 14:34:40', '2020-05-23 14:34:54'),
(34, 000005, 4, '05/2020', 1, 1, '0', 2, 18, '2020-05-23 14:34:40', '2020-05-23 14:34:55'),
(35, 000007, 10, '05/2020', 1, 1, '0', 2, 20, '2020-05-23 14:34:40', '2020-05-23 14:34:55'),
(36, 000010, 7, '05/2020', 1, 1, '0', 1, 18, '2020-05-23 14:34:40', '2020-05-23 14:44:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activities`
--

CREATE TABLE `activities` (
  `activity_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `activity` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `activities`
--

INSERT INTO `activities` (`activity_id`, `user_id`, `activity`, `module`, `created_on`, `deleted`) VALUES
(1, 1, 'cierre de sesión desde: 127.0.0.1', 'users', '2020-05-23 17:18:16', 0),
(2, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2020-05-23 17:18:23', 0),
(3, 1, 'cierre de sesión desde: 127.0.0.1', 'users', '2020-05-23 18:36:14', 0),
(4, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2020-05-23 18:36:34', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buses`
--

CREATE TABLE `buses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `registration` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('T','F') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `buses`
--

INSERT INTO `buses` (`id`, `name`, `registration`, `model`, `status`) VALUES
(1, 'Colectivo 1', '87GUY', 'Chevrolet', 'T'),
(2, 'Colectivo 2', 'GJGDUHK', 'SKania', 'T');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci3_sessions`
--

CREATE TABLE `ci3_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ci3_sessions`
--

INSERT INTO `ci3_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('7n0d2pqtjb7jds4n59fv8rnmb94nl1qh', '127.0.0.1', 1572051793, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323035313739333b7265717565737465645f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b70726576696f75735f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b),
('bo5f45fk8uu20570e3s40d92f6i9iga0', '127.0.0.1', 1571201132, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537313230313133323b7265717565737465645f706167657c733a34363a22687474703a2f2f626f6e666972652e6c6f63616c2f61646d696e2f73657474696e67732f75736572732f65646974223b70726576696f75735f706167657c733a34363a22687474703a2f2f626f6e666972652e6c6f63616c2f61646d696e2f73657474696e67732f75736572732f65646974223b757365725f69647c733a313a2231223b617574685f637573746f6d7c733a353a2261646d696e223b757365725f746f6b656e7c733a34303a2230306636666463366366663964373932616234313435363634366564633366313030643461386237223b6964656e746974797c733a31393a2261646d696e406d79626f6e666972652e636f6d223b726f6c655f69647c733a313a2231223b6c6f676765645f696e7c623a313b6c616e67756167657c733a373a22656e676c697368223b),
('dv38899b16uk0ogdesjl1gnhgajl0gvn', '127.0.0.1', 1572036745, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323033363734353b7265717565737465645f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b70726576696f75735f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b),
('ee4sgs6npq2bvcfnra3h3h10gtb1gp41', '127.0.0.1', 1572040743, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323034303734333b7265717565737465645f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b70726576696f75735f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b),
('fl3ofcbhhbiildprhtacisnsskb46e91', '127.0.0.1', 1572041760, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323034313634323b7265717565737465645f706167657c733a35353a22687474703a2f2f63696361726c6f732e6c6f63616c2f61646d696e2f73657474696e67732f7065726d697373696f6e732f656469742f36223b70726576696f75735f706167657c733a35353a22687474703a2f2f63696361726c6f732e6c6f63616c2f61646d696e2f73657474696e67732f7065726d697373696f6e732f656469742f36223b757365725f69647c733a313a2231223b617574685f637573746f6d7c733a353a2261646d696e223b757365725f746f6b656e7c733a34303a2234333038636662376463653231633163313937376163653332373832383139366466613166326636223b6964656e746974797c733a31393a2261646d696e406d79626f6e666972652e636f6d223b726f6c655f69647c733a313a2231223b6c6f676765645f696e7c623a313b6c616e67756167657c733a31303a227370616e6973685f616d223b),
('gfssb9416ecbtjqeig13i7rokosnrctb', '127.0.0.1', 1572041161, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323034313136313b7265717565737465645f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b70726576696f75735f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b),
('mev4vna6t1epd3dvkivrruvpm0skog6k', '127.0.0.1', 1572051812, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323035313739333b7265717565737465645f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b70726576696f75735f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b),
('n58v2710nongtrv4bp1qbhciokrt3kd3', '127.0.0.1', 1571267118, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537313236373037343b7265717565737465645f706167657c733a34313a22687474703a2f2f626f6e666972652e6c6f63616c2f61646d696e2f73657474696e67732f7573657273223b70726576696f75735f706167657c733a34313a22687474703a2f2f626f6e666972652e6c6f63616c2f61646d696e2f73657474696e67732f7573657273223b757365725f69647c733a313a2231223b617574685f637573746f6d7c733a353a2261646d696e223b757365725f746f6b656e7c733a34303a2234333038636662376463653231633163313937376163653332373832383139366466613166326636223b6964656e746974797c733a31393a2261646d696e406d79626f6e666972652e636f6d223b726f6c655f69647c733a313a2231223b6c6f676765645f696e7c623a313b6c616e67756167657c733a31303a227370616e6973685f616d223b),
('nldtd019nrnhta410sc6crki23sm2hko', '127.0.0.1', 1571201198, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537313230313133323b7265717565737465645f706167657c733a33343a22687474703a2f2f626f6e666972652e6c6f63616c2f61646d696e2f636f6e74656e74223b70726576696f75735f706167657c733a33343a22687474703a2f2f626f6e666972652e6c6f63616c2f61646d696e2f636f6e74656e74223b757365725f69647c733a313a2231223b617574685f637573746f6d7c733a353a2261646d696e223b757365725f746f6b656e7c733a34303a2234333038636662376463653231633163313937376163653332373832383139366466613166326636223b6964656e746974797c733a31393a2261646d696e406d79626f6e666972652e636f6d223b726f6c655f69647c733a313a2231223b6c6f676765645f696e7c623a313b6c616e67756167657c733a31303a227370616e6973685f616d223b),
('pobfuorjk0karri0h413btm46sms5i8i', '127.0.0.1', 1572038490, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323033383439303b7265717565737465645f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b70726576696f75735f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b),
('sbdg6lgu37pl4v79pt2jeptb76rfaldp', '127.0.0.1', 1572041642, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323034313634323b7265717565737465645f706167657c733a34323a22687474703a2f2f63696361726c6f732e6c6f63616c2f61646d696e2f73657474696e67732f7573657273223b70726576696f75735f706167657c733a34323a22687474703a2f2f63696361726c6f732e6c6f63616c2f61646d696e2f73657474696e67732f7573657273223b757365725f69647c733a313a2231223b617574685f637573746f6d7c733a353a2261646d696e223b757365725f746f6b656e7c733a34303a2234333038636662376463653231633163313937376163653332373832383139366466613166326636223b6964656e746974797c733a31393a2261646d696e406d79626f6e666972652e636f6d223b726f6c655f69647c733a313a2231223b6c6f676765645f696e7c623a313b6c616e67756167657c733a31303a227370616e6973685f616d223b),
('tqooh6din07vl57ka51rcq34768b38b0', '127.0.0.1', 1572038074, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323033383037343b7265717565737465645f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b70726576696f75735f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b),
('ts313qn07u8dfhfqa6bbe148oui7ognr', '127.0.0.1', 1572040387, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323034303338373b7265717565737465645f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b70726576696f75735f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b),
('vhph838ln2ncn2trkdevc2k7po2u8jav', '127.0.0.1', 1572051409, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323035313430393b7265717565737465645f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b70726576696f75735f706167657c733a32323a22687474703a2f2f63696361726c6f732e6c6f63616c2f223b);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` char(3) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `status` enum('T','F') DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `code`, `name`, `status`) VALUES
(1, 'SSJ', 'San Salvador de Jujuy', 'T'),
(2, 'ALC', 'Alto Comedero', 'T'),
(3, 'ALI', 'Los Alisos', 'T'),
(4, 'AVA', 'Los Avalos', 'T'),
(5, 'CAR', 'El Carmen', 'T'),
(6, 'FCA', 'Finca Carrizo', 'T'),
(7, 'SVI', 'San Vicente', 'T'),
(8, 'MON', 'Monterrico', 'T'),
(9, 'LOV', 'La Ovejeria', 'T'),
(10, 'LAP', 'Los Lapachos', 'T'),
(11, 'SRC', 'Cruce Scaro', 'T'),
(12, 'CLT', 'Campo la tuna', 'T'),
(13, 'CAR', 'Coronel Arias', 'T'),
(14, 'SDO', 'Santo Domingo', 'T'),
(15, 'CPE', 'Ciudad Perico', 'T'),
(16, 'SAP', 'San Pedro', 'T'),
(17, 'ROD', 'Rodeito', 'T'),
(18, 'PTL', 'Pte Lavallen', 'T'),
(19, 'ELA', 'El Arenal', 'T'),
(20, 'CHA', 'Chamical', 'T'),
(21, 'CRC', 'Cruce Cañadas', 'T'),
(22, 'ELP', 'El Piquete', 'T'),
(23, 'SAC', 'Santa Clara', 'T'),
(24, 'ELC', 'El Canal', 'T'),
(25, 'EMI', 'El Milagro', 'T'),
(26, 'PAL', 'Palpala', 'T'),
(27, 'SUN', 'El sunchal', 'T'),
(28, 'CAT', 'Catamontaña', 'T'),
(29, 'LPO', 'La Posta', 'T'),
(30, 'LPA', 'Las Pampitas', 'T'),
(31, 'SEV', 'Severino', 'T'),
(32, 'CEI', 'El Ceibal', 'T'),
(33, 'CLM', 'Colonia las Mercedes', 'T'),
(34, 'ROB', 'Roble', 'T');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_queue`
--

CREATE TABLE `email_queue` (
  `id` int(11) NOT NULL,
  `to_email` varchar(254) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `alt_message` text,
  `max_attempts` int(11) NOT NULL DEFAULT '3',
  `attempts` int(11) NOT NULL DEFAULT '0',
  `success` tinyint(1) NOT NULL DEFAULT '0',
  `date_published` datetime DEFAULT NULL,
  `last_attempt` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `csv_attachment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` bigint(20) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `passengers`
--

CREATE TABLE `passengers` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:docente, 2:Estudiante,  3 : Particular',
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `dni` int(8) UNSIGNED NOT NULL,
  `from_default` int(10) NOT NULL DEFAULT '0' COMMENT 'Origen por defecto',
  `to_default` int(10) NOT NULL DEFAULT '0' COMMENT 'Destino por defecto',
  `address_city` int(10) NOT NULL COMMENT 'Domicilio Localidad',
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `passengers`
--

INSERT INTO `passengers` (`id`, `type`, `first_name`, `last_name`, `dni`, `from_default`, `to_default`, `address_city`, `created_on`) VALUES
(1, 1, 'Hector Matias', 'Barro', 35911363, 15, 25, 8, NULL),
(2, 1, 'Pablo Nicolas', 'Choque', 29320428, 15, 25, 15, NULL),
(3, 1, 'Marcela', 'Choque', 23923191, 5, 15, 5, NULL),
(4, 1, 'Miriam Deolinda', 'Farfan', 24990359, 15, 25, 16, NULL),
(5, 1, 'Sara Esther', 'Sandoval', 14312964, 15, 5, 5, NULL),
(6, 1, 'Hector Armando', 'Carrizo', 26793699, 15, 25, 15, NULL),
(7, 1, 'Monica', 'Vargas', 29978235, 15, 25, 15, NULL),
(8, 1, 'Norma', 'Nico', 21194666, 15, 5, 5, NULL),
(9, 1, 'Gloria Vanesa', 'Juarez', 28187361, 15, 5, 5, NULL),
(10, 1, 'Maria Eugenia', 'Mamani', 23434761, 15, 8, 26, NULL),
(11, 1, 'Carmen Judith', 'Acsama', 34022118, 15, 7, 15, NULL),
(12, 3, 'Carlos', 'Ochoa', 28977467, 1, 1, 1, '2020-05-20 17:13:20'),
(13, 1, 'Flavia', 'Tolaba', 23985618, 1, 2, 1, '2020-05-20 19:22:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `passengers_schools`
--

CREATE TABLE `passengers_schools` (
  `id` int(10) NOT NULL,
  `passenger_id` int(10) NOT NULL,
  `school_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `passengers_schools`
--

INSERT INTO `passengers_schools` (`id`, `passenger_id`, `school_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 4, 2),
(5, 5, 2),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2),
(9, 9, 2),
(10, 10, 2),
(11, 11, 5),
(12, 12, 0),
(13, 13, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`permission_id`, `name`, `description`, `status`) VALUES
(2, 'Site.Content.View', 'Allow users to view the Content Context', 'active'),
(3, 'Site.Reports.View', 'Allow users to view the Reports Context', 'active'),
(4, 'Site.Settings.View', 'Allow users to view the Settings Context', 'active'),
(5, 'Site.Developer.View', 'Allow users to view the Developer Context', 'active'),
(6, 'Bonfire.Roles.Manage', 'Allow users to manage the user Roles', 'active'),
(7, 'Bonfire.Users.Manage', 'Allow users to manage the site Users', 'active'),
(8, 'Bonfire.Users.View', 'Allow users access to the User Settings', 'active'),
(9, 'Bonfire.Users.Add', 'Allow users to add new Users', 'active'),
(10, 'Bonfire.Database.Manage', 'Allow users to manage the Database settings', 'active'),
(11, 'Bonfire.Emailer.Manage', 'Allow users to manage the Emailer settings', 'active'),
(12, 'Bonfire.Logs.View', 'Allow users access to the Log details', 'active'),
(13, 'Bonfire.Logs.Manage', 'Allow users to manage the Log files', 'active'),
(14, 'Bonfire.Emailer.View', 'Allow users access to the Emailer settings', 'active'),
(15, 'Site.Signin.Offline', 'Allow users to login to the site when the site is offline', 'active'),
(16, 'Bonfire.Permissions.View', 'Allow access to view the Permissions menu unders Settings Context', 'active'),
(17, 'Bonfire.Permissions.Manage', 'Allow access to manage the Permissions in the system', 'active'),
(18, 'Bonfire.Modules.Add', 'Allow creation of modules with the builder.', 'active'),
(19, 'Bonfire.Modules.Delete', 'Allow deletion of modules.', 'active'),
(20, 'Permissions.Administrator.Manage', 'To manage the access control permissions for the Administrator role.', 'active'),
(21, 'Permissions.Editor.Manage', 'To manage the access control permissions for the Editor role.', 'active'),
(23, 'Permissions.User.Manage', 'To manage the access control permissions for the User role.', 'active'),
(24, 'Permissions.Developer.Manage', 'To manage the access control permissions for the Developer role.', 'active'),
(26, 'Activities.Own.View', 'To view the users own activity logs', 'active'),
(27, 'Activities.Own.Delete', 'To delete the users own activity logs', 'active'),
(28, 'Activities.User.View', 'To view the user activity logs', 'active'),
(29, 'Activities.User.Delete', 'To delete the user activity logs, except own', 'active'),
(30, 'Activities.Module.View', 'To view the module activity logs', 'active'),
(31, 'Activities.Module.Delete', 'To delete the module activity logs', 'active'),
(32, 'Activities.Date.View', 'To view the users own activity logs', 'active'),
(33, 'Activities.Date.Delete', 'To delete the dated activity logs', 'active'),
(34, 'Bonfire.UI.Manage', 'Manage the Bonfire UI settings', 'active'),
(35, 'Bonfire.Settings.View', 'To view the site settings page.', 'active'),
(36, 'Bonfire.Settings.Manage', 'To manage the site settings.', 'active'),
(37, 'Bonfire.Activities.View', 'To view the Activities menu.', 'active'),
(38, 'Bonfire.Database.View', 'To view the Database menu.', 'active'),
(39, 'Bonfire.Migrations.View', 'To view the Migrations menu.', 'active'),
(40, 'Bonfire.Builder.View', 'To view the Modulebuilder menu.', 'active'),
(41, 'Bonfire.Roles.View', 'To view the Roles menu.', 'active'),
(42, 'Bonfire.Sysinfo.View', 'To view the System Information page.', 'active'),
(43, 'Bonfire.Translate.Manage', 'To manage the Language Translation.', 'active'),
(44, 'Bonfire.Translate.View', 'To view the Language Translate menu.', 'active'),
(45, 'Bonfire.UI.View', 'To view the UI/Keyboard Shortcut menu.', 'active'),
(48, 'Bonfire.Profiler.View', 'To view the Console Profiler Bar.', 'active'),
(49, 'Bonfire.Roles.Add', 'To add New Roles', 'active'),
(50, 'Permissions.Inscriptor.Manage', 'To manage the access control permissions for the Inscriptor role.', 'active'),
(51, 'Traffic.Routes.Add', '', 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prices`
--

CREATE TABLE `prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `tariff_id` int(10) UNSIGNED NOT NULL,
  `from` int(10) NOT NULL,
  `to` int(10) NOT NULL,
  `price` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prices`
--

INSERT INTO `prices` (`id`, `tariff_id`, `from`, `to`, `price`) VALUES
(1, 1, 1, 4, '2.80'),
(2, 1, 1, 5, '3.10'),
(3, 1, 1, 20, '3.80'),
(4, 1, 1, 7, '3.70'),
(5, 1, 1, 8, '4.10'),
(6, 1, 1, 13, '4.80'),
(7, 1, 1, 14, '4.80'),
(8, 1, 1, 9, '5.10'),
(9, 1, 1, 2, '21.49'),
(10, 1, 1, 3, '23.70'),
(11, 1, 1, 6, '45.30'),
(12, 1, 1, 10, '34.80'),
(13, 1, 1, 11, '29.40'),
(14, 1, 1, 12, '67.40'),
(15, 1, 1, 15, '29.70'),
(16, 1, 1, 16, '54.00'),
(17, 1, 1, 17, '64.00'),
(18, 1, 15, 25, '68.30'),
(19, 1, 15, 7, '45.90'),
(20, 1, 15, 8, '56.00'),
(21, 1, 5, 15, '23.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(60) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '1',
  `login_destination` varchar(255) NOT NULL DEFAULT '/',
  `default_context` varchar(255) DEFAULT 'content',
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `description`, `default`, `can_delete`, `login_destination`, `default_context`, `deleted`) VALUES
(1, 'Administrator', '<p>\r\n	Tiene el control completo del sistema</p>', 0, 0, '/home', 'content', 0),
(4, 'User', '<p>Usuario con permisos limitados</p>', 1, 1, '/home', 'content', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 23),
(1, 24),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(2, 2),
(2, 3),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(6, 7),
(6, 8),
(6, 9),
(6, 10),
(6, 11),
(6, 12),
(6, 13),
(6, 48);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `routes`
--

CREATE TABLE `routes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `from_city_id` int(10) DEFAULT NULL,
  `to_city_id` int(10) DEFAULT NULL,
  `status` enum('T','F') DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `routes`
--

INSERT INTO `routes` (`id`, `name`, `from_city_id`, `to_city_id`, `status`) VALUES
(1, 'San Salvador de Jujuy a El Milagro', 1, 25, 'T');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `routes_cities`
--

CREATE TABLE `routes_cities` (
  `route_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `order` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `routes_cities`
--

INSERT INTO `routes_cities` (`route_id`, `city_id`, `order`) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 3, 3),
(1, 4, 4),
(1, 5, 5),
(1, 6, 6),
(1, 7, 7),
(1, 8, 8),
(1, 9, 9),
(1, 10, 10),
(1, 11, 11),
(1, 12, 12),
(1, 13, 13),
(1, 14, 14),
(1, 15, 15),
(1, 16, 16),
(1, 17, 17),
(1, 18, 18),
(1, 21, 21),
(1, 22, 22),
(1, 23, 23),
(1, 24, 24),
(1, 25, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rrhh`
--

CREATE TABLE `rrhh` (
  `id` int(10) UNSIGNED NOT NULL,
  `work_file` int(5) UNSIGNED NOT NULL,
  `position` tinyint(2) UNSIGNED NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cuil` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('T','F') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rrhh`
--

INSERT INTO `rrhh` (`id`, `work_file`, `position`, `last_name`, `first_name`, `cuil`, `status`) VALUES
(1, 105, 3, 'Abad', 'Guillermo', '20-28455016-2', 'T'),
(2, 94, 6, 'Ayarde', 'Adrian', '20-21322660-7', 'T'),
(3, 66, 2, 'Humacata', 'Mirta', '2710805893-0', 'T'),
(4, 95, 4, 'Alancay', 'Carlos', '20-17146550-9', 'T'),
(5, 51, 1, 'Adauto', 'Victor', '20-25751140-6', 'T'),
(7, 71, 3, 'Alarcon', 'Atilio Facundo', '20-35911253-0', 'T'),
(8, 65, 3, 'Aleman', 'Ruben Leonardo', '23-24996886-9', 'T'),
(9, 88, 3, 'Buffil', 'Victor Hugo', '23-14412368-9', 'T'),
(10, 98, 3, 'Cruz', 'Bernardo Alonso', '20-30009736-8', 'T'),
(11, 59, 3, 'Cuellar', 'Jorge Luis', '20-24423149-8', 'T'),
(12, 55, 3, 'Funes', 'Emilio Jose', '20-13121604-2', 'T'),
(13, 16, 3, 'Gonzalez', 'Antonio', '20-22985181-1', 'T');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schema_version`
--

CREATE TABLE `schema_version` (
  `type` varchar(40) NOT NULL,
  `version` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `schema_version`
--

INSERT INTO `schema_version` (`type`, `version`) VALUES
('core', 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schools`
--

CREATE TABLE `schools` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` int(4) DEFAULT NULL,
  `city_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Shools';

--
-- Volcado de datos para la tabla `schools`
--

INSERT INTO `schools` (`id`, `name`, `number`, `city_id`) VALUES
(1, 'Secundario N° 35', 35, 3),
(2, 'Latinoamerica  n° 386', 386, 25),
(3, 'Coordinacion de Educacion para jovenes y adultos', NULL, 15),
(4, 'Colegio Nuevo Horizonte Mundo Magico de Susy', 2, 7),
(5, 'Colegio Nuevo Horizonte N° 2 San Vicente Monterrico', NULL, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `category` enum('comun','especial') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'comun',
  `route_id` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `recurring` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `set_seats_count` enum('T','F') COLLATE utf8mb4_general_ci NOT NULL,
  `discount` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_dates`
--

CREATE TABLE `services_dates` (
  `service_id` int(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_locations`
--

CREATE TABLE `services_locations` (
  `service_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `name` varchar(30) NOT NULL,
  `module` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`name`, `module`, `value`) VALUES
('allow_print_number_ticket', 'core', '1'),
('auth.allow_name_change', 'core', '1'),
('auth.allow_register', 'core', '1'),
('auth.allow_remember', 'core', '1'),
('auth.do_login_redirect', 'core', '1'),
('auth.login_type', 'core', 'username'),
('auth.name_change_frequency', 'core', '1'),
('auth.name_change_limit', 'core', '1'),
('auth.password_force_mixed_case', 'core', '0'),
('auth.password_force_numbers', 'core', '0'),
('auth.password_force_symbols', 'core', '0'),
('auth.password_min_length', 'core', '8'),
('auth.password_show_labels', 'core', '0'),
('auth.remember_length', 'core', '1209600'),
('auth.user_activation_method', 'core', '0'),
('auth.use_extended_profile', 'core', '0'),
('auth.use_usernames', 'core', '1'),
('ext.country', 'core', 'US'),
('ext.state', 'core', ''),
('ext.street_name', 'core', ''),
('ext.type', 'core', 'small'),
('form_save', 'core.ui', 'ctrl+s/⌘+s'),
('goto_content', 'core.ui', 'alt+c'),
('mailpath', 'email', '/usr/sbin/sendmail'),
('mailtype', 'email', 'text'),
('password_iterations', 'users', '8'),
('protocol', 'email', 'mail'),
('sender_email', 'email', ''),
('site.languages', 'core', 'a:1:{i:0;s:7:\"spanish\";}'),
('site.list_limit', 'core', '10'),
('site.offline_reason', 'core', ''),
('site.show_front_profiler', 'core', '0'),
('site.show_profiler', 'core', '0'),
('site.status', 'core', '1'),
('site.system_email', 'core', 'admin@tecnomati.co'),
('site.title', 'core', 'Futuro SRL'),
('smtp_host', 'email', ''),
('smtp_pass', 'email', ''),
('smtp_port', 'email', ''),
('smtp_timeout', 'email', ''),
('smtp_user', 'email', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tariffs`
--

CREATE TABLE `tariffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `route_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `status` enum('T','F') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tariffs`
--

INSERT INTO `tariffs` (`id`, `route_id`, `name`, `date_start`, `date_end`, `status`) VALUES
(1, 1, 'Tarifa 1', '2020-04-27', NULL, 'T');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `quantity` int(4) UNSIGNED NOT NULL,
  `status` enum('T','F') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `name`, `price`, `quantity`, `status`) VALUES
(1, 'Boleto --05.00--', '5.00', 1000, 'T'),
(2, 'Boleto --40.00--', '40.00', 1000, 'T'),
(3, 'Boleto --80.00--', '80.00', 1000, 'T'),
(4, 'Boleto --50.00--', '50.00', 1000, 'T'),
(5, 'Boleto --70.00--', '70.00', 1000, 'T'),
(6, 'Boleto A', '30.00', 1000, 'T'),
(7, 'Boleto J.C.J', '65.00', 1000, 'T'),
(8, 'Boleto --60.00--', '60.00', 1000, 'T'),
(9, 'Boleto J.M.', '85.00', 1000, 'T'),
(10, 'Boleto S.P-J.L', '90.00', 1000, 'T'),
(11, 'Boleto Urbano --35.00--', '35.00', 1000, 'T'),
(12, 'PASAJE GRAL', '1.00', 1000, 'T'),
(13, 'PRIMARIO', '5.00', 1000, 'T'),
(14, 'SECUNDARIO', '10.00', 1000, 'T'),
(15, 'GRAL 25', '25.00', 1000, 'T');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '4',
  `email` varchar(254) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `gender` varchar(20) NOT NULL,
  `password_hash` char(60) DEFAULT NULL,
  `reset_hash` varchar(40) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_ip` varchar(45) NOT NULL DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `reset_by` int(11) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_message` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT '',
  `display_name_changed` date DEFAULT NULL,
  `timezone` varchar(40) NOT NULL DEFAULT 'UM3',
  `language` varchar(20) NOT NULL DEFAULT 'spanish',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activate_hash` varchar(40) NOT NULL DEFAULT '',
  `force_password_reset` tinyint(1) DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role_id`, `email`, `username`, `gender`, `password_hash`, `reset_hash`, `last_login`, `last_ip`, `created_on`, `deleted`, `reset_by`, `banned`, `ban_message`, `display_name`, `display_name_changed`, `timezone`, `language`, `active`, `activate_hash`, `force_password_reset`, `avatar`) VALUES
(1, 1, 'admin@admin.com', 'admin', 'male', '$2a$08$lWeowQ0DwAtsY.OVELNvgeZl95Oe/Y5t2LyJGrSchj49CwDtoQ5wq', NULL, '2020-05-23 18:36:34', '127.0.0.1', '2019-10-16 01:39:35', 0, NULL, 0, NULL, 'admin', NULL, 'UM3', 'spanish', 1, '', 0, NULL),
(4, 1, 'futuro@futurosrl.com', 'futuro', 'male', '$2a$08$Ai9WwLWX0ZU4vcPpbgeZZeupcW.0tmvvxKV/GbMzv54Fr/l/.GvWO', NULL, '2020-05-23 12:51:15', '127.0.0.1', '2020-05-23 12:50:41', 0, NULL, 0, NULL, 'Futuro', NULL, 'UM3', 'spanish', 1, '', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_cookies`
--

CREATE TABLE `user_cookies` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(128) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_meta`
--

CREATE TABLE `user_meta` (
  `meta_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) NOT NULL DEFAULT '',
  `meta_value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_meta`
--

INSERT INTO `user_meta` (`meta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'state', ''),
(2, 1, 'country', 'US');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number_ticket` (`number_abono`);

--
-- Indices de la tabla `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indices de la tabla `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ci3_sessions`
--
ALTER TABLE `ci3_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `email_queue`
--
ALTER TABLE `email_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_dni_IDX` (`dni`) USING BTREE;

--
-- Indices de la tabla `passengers_schools`
--
ALTER TABLE `passengers_schools`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indices de la tabla `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indices de la tabla `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`);

--
-- Indices de la tabla `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `routes_cities`
--
ALTER TABLE `routes_cities`
  ADD KEY `cities_FK` (`city_id`),
  ADD KEY `routes_FK` (`route_id`);

--
-- Indices de la tabla `rrhh`
--
ALTER TABLE `rrhh`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cuil_unique` (`cuil`);

--
-- Indices de la tabla `schema_version`
--
ALTER TABLE `schema_version`
  ADD PRIMARY KEY (`type`);

--
-- Indices de la tabla `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `services_dates`
--
ALTER TABLE `services_dates`
  ADD PRIMARY KEY (`service_id`,`date`);

--
-- Indices de la tabla `services_locations`
--
ALTER TABLE `services_locations`
  ADD PRIMARY KEY (`service_id`,`location_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `tariffs`
--
ALTER TABLE `tariffs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indices de la tabla `user_cookies`
--
ALTER TABLE `user_cookies`
  ADD KEY `token` (`token`);

--
-- Indices de la tabla `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`meta_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `email_queue`
--
ALTER TABLE `email_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `passengers`
--
ALTER TABLE `passengers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `passengers_schools`
--
ALTER TABLE `passengers_schools`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rrhh`
--
ALTER TABLE `rrhh`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `meta_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `routes_cities`
--
ALTER TABLE `routes_cities`
  ADD CONSTRAINT `cities_FK` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `routes_FK` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
