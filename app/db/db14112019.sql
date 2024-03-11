-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2019 a las 13:31:05
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cicarlos`
--

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
  `deleted` tinyint(12) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `activities`
--

INSERT INTO `activities` (`activity_id`, `user_id`, `activity`, `module`, `created_on`, `deleted`) VALUES
(1, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-16 01:43:54', 0),
(2, 1, 'App settings saved from: 127.0.0.1', 'core', '2019-10-16 01:44:38', 0),
(3, 1, 'modified user: admin', 'users', '2019-10-16 01:45:32', 0),
(4, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-16 01:45:38', 0),
(5, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-16 20:05:08', 0),
(6, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-25 19:06:59', 0),
(7, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-28 01:33:57', 0),
(8, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-28 01:38:59', 0),
(9, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-28 01:39:56', 0),
(10, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-28 01:40:18', 0),
(11, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-28 21:31:33', 0),
(12, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-30 21:31:04', 0),
(13, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-31 14:17:55', 0),
(14, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-31 14:19:18', 0),
(15, 1, 'logged in from: 127.0.0.1', 'users', '2019-10-31 21:41:41', 0),
(16, 1, 'App settings saved from: 127.0.0.1', 'core', '2019-10-31 21:43:51', 0),
(17, 1, 'App settings saved from: 127.0.0.1', 'core', '2019-10-31 21:50:37', 0),
(18, 1, 'App settings saved from: 127.0.0.1', 'core', '2019-10-31 21:52:12', 0),
(19, 1, 'logged in from: 127.0.0.1', 'users', '2019-11-02 09:29:10', 0),
(20, 1, 'logged in from: 127.0.0.1', 'users', '2019-11-02 20:14:40', 0),
(21, 1, 'App settings saved from: 127.0.0.1', 'core', '2019-11-04 09:20:03', 0),
(22, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-04 09:34:11', 0),
(23, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-04 09:36:12', 0),
(24, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-04 09:38:42', 0),
(25, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-04 10:13:45', 0),
(26, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-04 23:11:55', 0),
(27, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-04 23:38:32', 0),
(28, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 00:02:32', 0),
(29, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 00:59:27', 0),
(30, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 01:19:38', 0),
(31, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 01:21:33', 0),
(32, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 01:22:50', 0),
(33, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 01:25:02', 0),
(34, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 01:26:43', 0),
(35, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 01:27:55', 0),
(36, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 01:33:03', 0),
(37, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 01:37:25', 0),
(38, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 01:37:50', 0),
(39, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 01:45:49', 0),
(40, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 01:46:28', 0),
(41, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 06:55:20', 0),
(42, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 07:05:12', 0),
(43, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 07:08:43', 0),
(44, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 07:29:34', 0),
(45, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 07:30:19', 0),
(46, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 07:30:53', 0),
(47, 1, 'Configuración de la aplicación grabada desde: 127.0.0.1', 'core', '2019-11-05 07:31:11', 0),
(48, 1, 'inicio de sesión desde: 127.0.0.1', 'users', '2019-11-05 07:35:34', 0),
(49, 1, 'Configuración de la aplicación grabada desde: 127.0.0.1', 'core', '2019-11-05 07:38:40', 0),
(50, 1, 'Configuración de la aplicación grabada desde: 127.0.0.1', 'core', '2019-11-05 07:40:26', 0),
(51, 1, 'Configuración de la aplicación grabada desde: 127.0.0.1', 'core', '2019-11-05 07:40:38', 0),
(52, 1, 'inicio de sesión desde: ::1', 'users', '2019-11-05 14:36:48', 0),
(53, 1, 'inicio de sesión desde: ::1', 'users', '2019-11-05 19:49:22', 0),
(54, 1, 'inicio de sesión desde: ::1', 'users', '2019-11-08 14:58:21', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alu_nacionalidad`
--

CREATE TABLE `alu_nacionalidad` (
  `id_nacionalidad` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `alu_nacionalidad`
--

INSERT INTO `alu_nacionalidad` (`id_nacionalidad`, `nombre`) VALUES
(1, 'ARGENTINO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancehipo`
--

CREATE TABLE `cancehipo` (
  `CanReg` int(11) NOT NULL,
  `hiporeg` int(11) DEFAULT NULL,
  `Dpto` char(1) COLLATE utf8mb4_bin NOT NULL,
  `ParMat` int(11) DEFAULT NULL,
  `ParPad` int(11) DEFAULT NULL,
  `ParUF` char(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `Hcod_escrib` int(11) DEFAULT NULL,
  `CN_Orden` int(11) NOT NULL,
  `CNroEscPub` int(11) DEFAULT NULL,
  `Cfec_escrit` datetime(3) DEFAULT NULL,
  `Cfec_regist` datetime(3) DEFAULT NULL,
  `usr_cod` int(11) DEFAULT NULL,
  `usr_nom` char(10) COLLATE utf8mb4_bin NOT NULL,
  `usr_mod` datetime(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_accesos_directos`
--

CREATE TABLE `cfg_accesos_directos` (
  `id_usuario` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_auditoria`
--

CREATE TABLE `cfg_auditoria` (
  `id_auditoria` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_acceso` datetime(3) DEFAULT NULL,
  `ip_usuario` longtext COLLATE utf8mb4_bin,
  `nombre_equipo` longtext COLLATE utf8mb4_bin,
  `empresa_acceso` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `seccion_acceso` int(11) DEFAULT NULL,
  `seccion_nombre` longtext COLLATE utf8mb4_bin,
  `observacion` longtext COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_ayuda`
--

CREATE TABLE `cfg_ayuda` (
  `id_seccion` int(11) NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contenido` longtext COLLATE utf8mb4_bin,
  `url` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_feriados`
--

CREATE TABLE `cfg_feriados` (
  `id_feriado` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `observacion` varchar(50) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_grupos`
--

CREATE TABLE `cfg_grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `cfg_grupos`
--

INSERT INTO `cfg_grupos` (`id_grupo`, `nombre`, `id_modulo`, `orden`) VALUES
(1, 'Empresa', 1, 1),
(2, 'Sistema', 1, 2),
(3, 'Usuarios', 1, 3),
(4, 'Configuracion', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_modulos`
--

CREATE TABLE `cfg_modulos` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `path` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `cfg_modulos`
--

INSERT INTO `cfg_modulos` (`id_modulo`, `nombre`, `path`) VALUES
(1, 'Configuracion', 'Configuracion'),
(2, 'Expedientes', 'Expedientes'),
(3, 'Base Datos', 'objetos'),
(4, 'Imagenes', 'Imagenes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_permisos`
--

CREATE TABLE `cfg_permisos` (
  `id_usuario` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `cfg_permisos`
--

INSERT INTO `cfg_permisos` (`id_usuario`, `id_seccion`, `id`) VALUES
(1, 1, 1),
(53, 198, 11),
(53, 161, 12),
(53, 167, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_secciones`
--

CREATE TABLE `cfg_secciones` (
  `id_seccion` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `cfg_secciones`
--

INSERT INTO `cfg_secciones` (`id_seccion`, `nombre`, `url`, `id_grupo`, `orden`) VALUES
(1, 'Respaldo', 'construccion.asp', 1, 1),
(2, 'Modulos', 'abm_modulos.asp', 2, 1),
(3, 'Grupos', 'abm_grupos.asp', 2, 2),
(4, 'secciones', 'abm_secciones.asp', 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfg_usuarios`
--

CREATE TABLE `cfg_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `admin_exptes` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `tipo` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `imp_matricula` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `pertenece_registro` varchar(1) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `cfg_usuarios`
--

INSERT INTO `cfg_usuarios` (`id_usuario`, `username`, `password`, `nombre`, `email`, `admin_exptes`, `tipo`, `imp_matricula`, `pertenece_registro`) VALUES
(1, 'fede', 'Inmu44418Galan', 'Federico Galan', 'fgalan@gygsoft.com.ar', 'S', 'A', 'I', NULL),
(2, 'ariel', 'Inmu18Gonzalez$$00', 'Ariel Gonzalez', 'agonza@gygsoft.com.ar', 'S', 'A', 'I', NULL),
(3, 'administrador', 'angeles1', 'administrador', 'email@gygsoft.com.ar', 'N', 'A', 'I', NULL);

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
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id_parcela` bigint(20) NOT NULL,
  `Dpto` char(1) COLLATE utf8mb4_bin NOT NULL,
  `ParMat` int(11) NOT NULL,
  `ParPad` int(11) NOT NULL,
  `ParUF` char(3) COLLATE utf8mb4_bin NOT NULL,
  `ParCirc` smallint(6) DEFAULT NULL,
  `ParSecc` smallint(6) DEFAULT NULL,
  `ParManz` char(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParParc` char(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParUbic` char(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParUR` char(1) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParMnz` char(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParPiso` char(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParSup` decimal(15,4) DEFAULT NULL,
  `ParUMed` char(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParDomi` char(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParNomAnt` char(40) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParDomFis` char(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParObs` char(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParFecAlta` datetime(3) DEFAULT NULL,
  `ParUsr` smallint(6) DEFAULT NULL,
  `ParMANROP` char(2) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParUF2` char(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParTrasDom` smallint(6) DEFAULT NULL,
  `ParBVig` smallint(6) DEFAULT NULL,
  `ParFecBVig` datetime(3) DEFAULT NULL,
  `UsrCod` smallint(6) DEFAULT NULL,
  `msrepl_synctran_ts` binary(8) DEFAULT NULL,
  `ParUFAnt` char(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParPadAnt` int(11) DEFAULT NULL,
  `ParMatAnt` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `FechaBaja` datetime DEFAULT NULL,
  `id_dominio` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `porcentaje` char(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `fecha_inscripcion` datetime(3) DEFAULT NULL,
  `id_tipo_propietario` int(11) DEFAULT NULL,
  `id_usuario_dominios` int(11) DEFAULT NULL,
  `fecha_carga` datetime(3) DEFAULT NULL,
  `id_expediente` int(11) DEFAULT NULL,
  `nro_orden` char(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `fechabaja_dominio` datetime(3) DEFAULT NULL,
  `id_persona_documento` int(11) DEFAULT NULL,
  `numero` char(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `id_tipo_moneda` int(11) DEFAULT NULL,
  `monto` decimal(15,4) DEFAULT NULL,
  `nombre` char(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `nacionalidad` char(100) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dir_destino`
--

CREATE TABLE `dir_destino` (
  `id_dir_destino` int(11) NOT NULL,
  `path` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `fecha` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `dir_destino`
--

INSERT INTO `dir_destino` (`id_dir_destino`, `path`, `fecha`) VALUES
(131064, '0', '2019-11-13 00:00:00.000'),
(131065, '00', '2019-11-13 07:20:00.000'),
(131066, '15J101', '2019-11-13 00:00:00.000'),
(131067, '20G081', '2019-11-13 07:20:00.000'),
(131068, '20G082', '2019-11-13 00:00:00.000'),
(131069, '21O052', '2019-11-13 07:20:00.000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dir_origen`
--

CREATE TABLE `dir_origen` (
  `id_dir_origen` int(11) NOT NULL,
  `path` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `fecha` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `dir_origen`
--

INSERT INTO `dir_origen` (`id_dir_origen`, `path`, `fecha`) VALUES
(65517, '15J101', '2019-11-13 09:00:00.000'),
(65518, '20G081', '2019-11-13 09:00:00.000'),
(65519, '20G082', '2019-11-13 09:00:00.000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominios201802`
--

CREATE TABLE `dominios201802` (
  `Dpto` varchar(1) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParMat` varchar(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParPad` varchar(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParUF` varchar(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `nombre` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `id_tipo_propietario` int(11) DEFAULT NULL,
  `porcentaje` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `numero` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `domcui` varchar(13) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_inscripcion` datetime(3) DEFAULT NULL,
  `fecha_carga` datetime(3) DEFAULT NULL,
  `id_dominio` varchar(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `pasa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `dominios201802`
--

INSERT INTO `dominios201802` (`Dpto`, `ParMat`, `ParPad`, `ParUF`, `nombre`, `id_tipo_propietario`, `porcentaje`, `id_tipo_documento`, `numero`, `domcui`, `fecha_inscripcion`, `fecha_carga`, `id_dominio`, `pasa`) VALUES
('B', '17466', '19118', NULL, 'BATALLANOS JUAN TEOFILO', 1, '100%', 1, '12474925', NULL, '2019-11-13 08:00:00.000', '2019-11-13 08:00:00.000', '916967', 0),
('D', '6654', '20431', '234', 'RAMIREZ ILDA', 4, '1/2', 1, '10339719', '27-10339719-2', '2019-11-13 08:00:00.000', '2019-11-13 08:00:00.000', '117146', 0),
('D', '6654', '20431', '234', 'FARFAN RICARDO', 4, '1/2', 1, '10339754', '20-10339754-2', '2019-11-13 08:00:00.000', '2019-11-13 08:00:00.000', '117146', 0),
('B', '4824', '1960', '234', 'RAMIREZ MARCOS', 1, '100%', 1, '', '', '2019-11-13 08:00:00.000', '2019-11-13 08:00:00.000', '111886', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominos_exportados`
--

CREATE TABLE `dominos_exportados` (
  `Dpto` longtext COLLATE utf8mb4_bin,
  `ParMat` longtext COLLATE utf8mb4_bin,
  `ParPad` longtext COLLATE utf8mb4_bin,
  `ParUF` longtext COLLATE utf8mb4_bin,
  `AyN` longtext COLLATE utf8mb4_bin,
  `TipoProp` longtext COLLATE utf8mb4_bin,
  `Proporcion` longtext COLLATE utf8mb4_bin,
  `id_tipo_documento` int(11) NOT NULL,
  `DNI` longtext COLLATE utf8mb4_bin,
  `domcui` int(11) NOT NULL,
  `fecha_inscripcion` datetime(3) DEFAULT NULL,
  `fecha_carga` datetime(3) DEFAULT NULL,
  `IdDom` longtext COLLATE utf8mb4_bin,
  `pasa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `dominos_exportados`
--

INSERT INTO `dominos_exportados` (`Dpto`, `ParMat`, `ParPad`, `ParUF`, `AyN`, `TipoProp`, `Proporcion`, `id_tipo_documento`, `DNI`, `domcui`, `fecha_inscripcion`, `fecha_carga`, `IdDom`, `pasa`) VALUES
('D', '6654', '20431', '234', 'RAMIREZ ILDA', '4', '1/2', 0, '10339719', 0, '2019-11-13 11:00:00.000', '2019-11-13 11:00:00.000', '117146', 0);

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
-- Estructura de tabla para la tabla `estado_nacional`
--

CREATE TABLE `estado_nacional` (
  `Dpto` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `Matricula` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `Padron` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `estado_nacional`
--

INSERT INTO `estado_nacional` (`Dpto`, `Matricula`, `Padron`) VALUES
('A', '0', '4962'),
('A', '0', '4071'),
('A', '0', '4110'),
('A', '0', '4982'),
('E', '0', '405'),
('E', '0', '407');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exportardominios`
--

CREATE TABLE `exportardominios` (
  `Dpto` varchar(1) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParMat` varchar(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParPad` varchar(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParUF` varchar(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `nombre` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `id_tipo_propietario` int(11) DEFAULT NULL,
  `porcentaje` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `numero` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `domcui` varchar(13) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_inscripcion` datetime(3) DEFAULT NULL,
  `fecha_carga` datetime(3) DEFAULT NULL,
  `id_dominio` varchar(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `pasa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_anormalidades`
--

CREATE TABLE `fich_anormalidades` (
  `id_anormalidad` int(11) NOT NULL,
  `id_legajo` int(11) DEFAULT NULL,
  `id_concepto_justificacion` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_desde` datetime(3) DEFAULT NULL,
  `fecha_hasta` datetime(3) DEFAULT NULL,
  `hora` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `aplicado_a` int(11) DEFAULT NULL,
  `cod_fichador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fich_anormalidades`
--

INSERT INTO `fich_anormalidades` (`id_anormalidad`, `id_legajo`, `id_concepto_justificacion`, `fecha_desde`, `fecha_hasta`, `hora`, `aplicado_a`, `cod_fichador`) VALUES
(1, 6, 'ENFERM', '2019-11-13 09:00:00.000', '2019-11-14 09:00:00.000', '03:16:00', 1, 671),
(2, 5, 'DESINF', '2019-11-13 09:00:00.000', '2019-11-13 09:00:00.000', '03:16:00', 1, 671),
(3, 1, 'RETPRO', '2019-11-13 09:00:00.000', '2019-11-14 09:00:00.000', '03:16:00', 1, 747),
(4, 1, 'RETPRO', '2019-11-13 09:00:00.000', '2019-11-13 09:00:00.000', '03:16:00', 1, 747);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_ausencias`
--

CREATE TABLE `fich_ausencias` (
  `id_ausencia` int(11) NOT NULL,
  `cod_fichador` int(11) DEFAULT NULL,
  `id_legajo` int(11) DEFAULT NULL,
  `id_concepto_justificacion` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_desde` datetime(3) DEFAULT NULL,
  `fecha_hasta` datetime(3) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `observacion` longtext COLLATE utf8mb4_bin,
  `fecha_carga_modifica` datetime(3) DEFAULT NULL,
  `id_usuario_carga_modifica` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fich_ausencias`
--

INSERT INTO `fich_ausencias` (`id_ausencia`, `cod_fichador`, `id_legajo`, `id_concepto_justificacion`, `fecha_desde`, `fecha_hasta`, `cantidad`, `observacion`, `fecha_carga_modifica`, `id_usuario_carga_modifica`) VALUES
(2, 671, 5, 'ENFERM', '2019-11-13 09:00:00.000', '2019-11-14 09:00:00.000', 5, '2, 671, 5, N\'ENFERM\', CAST(0x0000A30800000000 AS DateTime), CAST(0x0000A30900000000 AS DateTime), NULL, NULL, NULL, NULL)', NULL, NULL),
(15, 747, 1, 'LICEN', '2019-11-13 09:00:00.000', '2019-11-13 09:00:00.000', 2, '15, 747, 1, N\'LICEN\', CAST(0x0000A39200000000 AS DateTime), CAST(0x0000A39B00000000 AS DateTime), NULL, NULL, NULL, NULL)', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_carpeta`
--

CREATE TABLE `fich_carpeta` (
  `id_carpeta` int(11) NOT NULL,
  `fecha_carpeta` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fich_carpeta`
--

INSERT INTO `fich_carpeta` (`id_carpeta`, `fecha_carpeta`) VALUES
(1, '2019-11-13 11:00:00.000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_conceptos_justificaciones`
--

CREATE TABLE `fich_conceptos_justificaciones` (
  `id_concepto_justificacion` varchar(6) CHARACTER SET utf8 DEFAULT NULL,
  `nombre` longtext COLLATE utf8mb4_bin,
  `justificado` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `coor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sinonimo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tango` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `habilitado` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fich_conceptos_justificaciones`
--

INSERT INTO `fich_conceptos_justificaciones` (`id_concepto_justificacion`, `nombre`, `justificado`, `coor`, `sinonimo`, `tango`, `habilitado`) VALUES
('ACCID', 'ACCIDDENTE', 'S', NULL, NULL, NULL, NULL),
('DONSAN', 'DONA SANNGRE', 'S', NULL, NULL, NULL, NULL),
('ENFERM', 'ENFERM', 'S', NULL, NULL, NULL, NULL),
('ESTU', 'ESTUDIO ', 'S', NULL, NULL, NULL, NULL),
('TARNOJ', 'TARDANZA NO JUSTIFICADA', 'n', NULL, NULL, NULL, NULL),
('LICEN', 'LICENCIA ', 'S', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_departamentos`
--

CREATE TABLE `fich_departamentos` (
  `id_departamento` varchar(6) CHARACTER SET utf8 DEFAULT NULL,
  `nombre` longtext COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fich_departamentos`
--

INSERT INTO `fich_departamentos` (`id_departamento`, `nombre`) VALUES
('REG', 'REGISTRO'),
('DIR', 'DIRECCION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_dptos_usuarios`
--

CREATE TABLE `fich_dptos_usuarios` (
  `id_dpto_usuario` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_departamento` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fich_dptos_usuarios`
--

INSERT INTO `fich_dptos_usuarios` (`id_dpto_usuario`, `id_usuario`, `id_departamento`) VALUES
(1, 31, 'REG'),
(3, 3, 'REG'),
(4, 4, 'REG'),
(5, 4, 'DIR'),
(6, 31, 'DIR'),
(7, 33, 'DIR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_estados_fichadas`
--

CREATE TABLE `fich_estados_fichadas` (
  `id_estado_fichada` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `nombre` longtext COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fich_estados_fichadas`
--

INSERT INTO `fich_estados_fichadas` (`id_estado_fichada`, `nombre`) VALUES
('AJU', 'AUSENTE JUSTIFIC'),
('ANJ', 'AUSENTE NO JUSTIFIC'),
('ERR', 'ERROR FALTAN CERRAR FICHADAS'),
('NJU', 'PRESETE CON NOVEDAD JUSTIFICADA'),
('OK', 'O.K.'),
('NNJ', 'PRESENTE CON NOVEDAD NO JUSTIFICADA'),
('OKN', 'PRESENTE CON NOVEDADES'),
('NNJ', 'PRESENTE CON NOVEDAD NO JUSTIFICADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_feriados`
--

CREATE TABLE `fich_feriados` (
  `id_feriado` int(11) NOT NULL,
  `fecha` datetime(3) DEFAULT NULL,
  `nombre` longtext COLLATE utf8mb4_bin,
  `repeticiones` int(11) DEFAULT NULL,
  `fecha_limite` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fich_feriados`
--

INSERT INTO `fich_feriados` (`id_feriado`, `fecha`, `nombre`, `repeticiones`, `fecha_limite`) VALUES
(1, '2019-12-30 00:00:00.000', 'AÑO NUEVO', 100, NULL),
(2, '2019-12-25 00:00:00.000', 'NAVIDAD', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_fichadas`
--

CREATE TABLE `fich_fichadas` (
  `id_fichada` int(11) NOT NULL,
  `hora` datetime(3) DEFAULT NULL,
  `path_foto` longtext COLLATE utf8mb4_bin,
  `id_legajo` int(11) DEFAULT NULL,
  `nro_legajo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cod_fichador` int(11) DEFAULT NULL,
  `id_departamento` longtext COLLATE utf8mb4_bin,
  `origen` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fich_fichadas`
--

INSERT INTO `fich_fichadas` (`id_fichada`, `hora`, `path_foto`, `id_legajo`, `nro_legajo`, `cod_fichador`, `id_departamento`, `origen`, `id_usuario`) VALUES
(14, '2019-11-13 11:00:00.000', '/ControlHorario/FotosFichadas/2012/7/12/f12072012_125345_15.jpg\'', 15, '813', 466, 'REG', 'KB', 33),
(16, '2019-11-13 11:00:00.000', '/ControlHorario/FotosFichadas/2012/7/12/f12072012_125452_2.jpg\'', 2, '101', 911, 'REG', 'KB', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_registros_rotativos`
--

CREATE TABLE `fich_registros_rotativos` (
  `id_registro_rotativo` int(11) NOT NULL,
  `id_tipo_rotativo` varchar(6) CHARACTER SET utf8 DEFAULT NULL,
  `nro_registro` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `e1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `s1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `e2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `s2` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_revisiones_fichadas`
--

CREATE TABLE `fich_revisiones_fichadas` (
  `id_revision_fichada` int(11) NOT NULL,
  `id_legajo` int(11) DEFAULT NULL,
  `nro_legajo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cod_fichador` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha` datetime(3) DEFAULT NULL,
  `id_tipo_asistencia` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `desvio_fichada` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_estado_fichada` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `normal_1e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `normal_1s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `normal_2e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `normal_2s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `real_1e` datetime(3) DEFAULT NULL,
  `real_1s` datetime(3) DEFAULT NULL,
  `real_2e` datetime(3) DEFAULT NULL,
  `real_2s` datetime(3) DEFAULT NULL,
  `real_extras` longtext COLLATE utf8mb4_bin,
  `estado_1e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `estado_1s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `estado_2e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `estado_2s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `origen_1e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `origen_1s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `origen_2e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `origen_2s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tolerancia1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tolerancia2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `temprano1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `temprano2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_concepto_justificacion_1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `hora_1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `aplicada_a_1` int(11) DEFAULT NULL,
  `id_concepto_justificacion_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `hora_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `aplicada_a_2` int(11) DEFAULT NULL,
  `esperadas` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `reales` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tardanza_J` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tardanza_n` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fich_revisiones_fichadas`
--

INSERT INTO `fich_revisiones_fichadas` (`id_revision_fichada`, `id_legajo`, `nro_legajo`, `cod_fichador`, `fecha`, `id_tipo_asistencia`, `desvio_fichada`, `id_estado_fichada`, `normal_1e`, `normal_1s`, `normal_2e`, `normal_2s`, `real_1e`, `real_1s`, `real_2e`, `real_2s`, `real_extras`, `estado_1e`, `estado_1s`, `estado_2e`, `estado_2s`, `origen_1e`, `origen_1s`, `origen_2e`, `origen_2s`, `tolerancia1`, `tolerancia2`, `temprano1`, `temprano2`, `id_concepto_justificacion_1`, `hora_1`, `aplicada_a_1`, `id_concepto_justificacion_2`, `hora_2`, `aplicada_a_2`, `esperadas`, `reales`, `tardanza_J`, `tardanza_n`) VALUES
(385, 9, '108', '1', '2019-11-13 11:00:00.000', 'TMM', '02:00:00', 'ANJ', '08:00:00', '13:00:00', '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, ', N\'TMM\', N\'02:00:00\', N\'ANJ\', N\'08:00:00\', N\'13:00:00\', N\'00:00:00\', N\'00:00:00\', NULL, NULL, NULL, NULL, N\'\', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, N\'00:10:00\', N\'00:05:00\', N\'00:05:00\', N\'00:05:00\', N\'\', N\'\', -1, N\'\', N\'\', -1, N\'05:00:00\', N\'00:00:00\', N\'00:00:00\', N\'00:00:00\')', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(389, 9, '108', '1', '2019-11-13 11:00:00.000', 'TMM', '02:00:00', 'OK', '08:00:00', '13:00:00', '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, 'DESCANSODESCANSO\r\nN\'02:00:00\', N\'ANJ\', N\'08:00:00\', N\'13:00:00\', N\'00:00:00\', N\'00:00:00\', NULL, NULL, NULL, NULL, N\'\', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, N\'00:10:00\', N\'00:05:00\', N\'00:05:00\', N\'00:05:00\', N\'\', N\'\', -1, N\'\', N\'\', -1, N\'05:00:00\', N\'00:00:00\', N\'00:00:00\', N\'00:00:00\')', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_tipos_asistencias`
--

CREATE TABLE `fich_tipos_asistencias` (
  `id_tipo_asistencia` varchar(6) CHARACTER SET utf8 DEFAULT NULL,
  `nombre` longtext COLLATE utf8mb4_bin,
  `lu_1e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lu_1s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lu_2e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lu_2s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ma_1e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ma_1s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ma_2e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ma_2s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mi_1e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mi_1s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mi_2e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mi_2s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ju_1e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ju_1s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ju_2e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ju_2s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vi_1e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vi_1s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vi_2e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vi_2s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sa_1e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sa_1s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sa_2e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sa_2s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `do_1e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `do_1s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `do_2e` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `do_2s` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tolerancia1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tolerancia2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `temprano1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `temprano2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `desvio_fichada` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `rotativo` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `transicion_cantidad` int(11) DEFAULT NULL,
  `transicion_tipo` longtext COLLATE utf8mb4_bin,
  `empieza` datetime(3) DEFAULT NULL,
  `lu_conv` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ma_conv` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mi_conv` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ju_conv` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vi_conv` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sa_conv` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `do_conv` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fich_tipos_asistencias`
--

INSERT INTO `fich_tipos_asistencias` (`id_tipo_asistencia`, `nombre`, `lu_1e`, `lu_1s`, `lu_2e`, `lu_2s`, `ma_1e`, `ma_1s`, `ma_2e`, `ma_2s`, `mi_1e`, `mi_1s`, `mi_2e`, `mi_2s`, `ju_1e`, `ju_1s`, `ju_2e`, `ju_2s`, `vi_1e`, `vi_1s`, `vi_2e`, `vi_2s`, `sa_1e`, `sa_1s`, `sa_2e`, `sa_2s`, `do_1e`, `do_1s`, `do_2e`, `do_2s`, `tolerancia1`, `tolerancia2`, `temprano1`, `temprano2`, `desvio_fichada`, `rotativo`, `transicion_cantidad`, `transicion_tipo`, `empieza`, `lu_conv`, `ma_conv`, `mi_conv`, `ju_conv`, `vi_conv`, `sa_conv`, `do_conv`) VALUES
('TM', 'TURNO MANANA', '07:00', '13:00', NULL, NULL, '07:00', '13:00', NULL, NULL, '07:00', '13:00', NULL, NULL, '07:00', '13:00', NULL, NULL, '07:00', '13:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '00:10', '00:05', '00:05', '00:05', '04:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TMM', 'TURNO MANANA MODIFICADO', '07:00', '13:00', NULL, NULL, '07:00', '13:00', NULL, NULL, '08:00', '13:00', NULL, NULL, '08:00', '13:00', NULL, NULL, '07:00', '13:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '00:10', '00:05', '00:05', '00:05', '04:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fich_tipos_rotativos`
--

CREATE TABLE `fich_tipos_rotativos` (
  `id_tipo_rotativo` varchar(6) CHARACTER SET utf8 NOT NULL,
  `nombre` longtext COLLATE utf8mb4_bin,
  `tolerancia1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tolerancia2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `temprano1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `temprano2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `desvio_fichada` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_inicio` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fol_macros`
--

CREATE TABLE `fol_macros` (
  `id_macro` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_tipo` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `texto` longtext COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fol_macros`
--

INSERT INTO `fol_macros` (`id_macro`, `nombre`, `id_tipo`, `texto`) VALUES
(2, 'asiecv02', 'GRA', '.- CONDOMINIO. \r\n1.1 ,  - arg.- DNI nº\r\n1.2 ,  - arg.- DNI nº - casados entre sí en 1º nupcias.-\r\nCOMPRA VENTA- $.- E.P. nº, de fecha //- Esc. -Pres. Nº el //- REGISTRADA: //.- Vende: .- '),
(3, 'asiecv03', 'TIT', '.- CONDOMINIO. \r\n1.1 ,  - arg.- DNI n - casado en 1 nupcias c/.-\r\n1.2 ,  - arg.- DNI n - casado en 1 nupcias c/.-\r\nCOMPRA VENTA- $.- E.P. n, de fecha //- Esc. -Pres. N el //- REGISTRADA: //.- Vende: .-'),
(45, 'PACTO DE PREFERENCIA', 'GRA', 'PACTO DE PREFERENCIA\r\nA favor del Instituto de Vivienda y Urbanismo de /\r\nJujuy-s/E.P.relac.en R.:7/ -REGISTRADA: ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fol_matriculas`
--

CREATE TABLE `fol_matriculas` (
  `id_matricula` int(11) NOT NULL,
  `dpto` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `matricula` int(11) DEFAULT NULL,
  `padron` int(11) DEFAULT NULL,
  `ubicacion` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nomen_circ` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `nomen_secc` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `nomen_mza` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `nomen_parcela` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `manzana` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `lote` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `ante_L1` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `ante_F1` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `ante_A1` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `ante_L2` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `ante_F2` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `ante_A2` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `antecedentes` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `plano` varchar(55) CHARACTER SET utf8 DEFAULT NULL,
  `descripcion` longtext COLLATE utf8mb4_bin,
  `sup_titulo` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `sup_plano` varchar(21) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_apertura` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_carga` datetime(3) DEFAULT NULL,
  `tipo` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `superficies` varchar(2200) CHARACTER SET utf8 DEFAULT NULL,
  `ph_unidad` varchar(18) CHARACTER SET utf8 DEFAULT NULL,
  `ph_piso` varchar(35) CHARACTER SET utf8 DEFAULT NULL,
  `tipo_matricula` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `hora_carga` datetime(3) DEFAULT NULL,
  `permite_modificar` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `activa` int(11) DEFAULT NULL,
  `cant_vista` int(11) DEFAULT NULL,
  `id_usr_activa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fol_matriculas`
--

INSERT INTO `fol_matriculas` (`id_matricula`, `dpto`, `matricula`, `padron`, `ubicacion`, `nomen_circ`, `nomen_secc`, `nomen_mza`, `nomen_parcela`, `manzana`, `lote`, `ante_L1`, `ante_F1`, `ante_A1`, `ante_L2`, `ante_F2`, `ante_A2`, `antecedentes`, `plano`, `descripcion`, `sup_titulo`, `sup_plano`, `fecha_apertura`, `fecha_carga`, `tipo`, `id_usuario`, `superficies`, `ph_unidad`, `ph_piso`, `tipo_matricula`, `hora_carga`, `permite_modificar`, `activa`, `cant_vista`, `id_usr_activa`) VALUES
(100, 'P', 1, 30249, 'CARAHUNCO', '2', '2', '6', '14', '6', '14', NULL, NULL, NULL, NULL, NULL, NULL, 'L°29bis Capital  F°413  A°285', 'Dcto.2180-H-65', 'EXTENSION:\r\nFte.  SO.: 37,17 m.   Ochava: 4,00 m.\r\nFte.  SE.: 22,17 m.\r\nC/fte.NE.: 40,00 m.\r\nC/fte.NO.: 25,00 m.\r\nLINDEROS:\r\nSE.: Calle.\r\nSO.: Calle.\r\nNE.: Lote 13.\r\nNO.: Lote 1.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\', NULL, N\'996,00m2.-    \', N\'6/06/1991.-\', CAST(0x00009B9F00000000 AS DateTime), NULL, 59, NULL, NULL, NULL, N\'UR\', CAST(0x00009B9F00A80B88 AS DateTime), N\'S\', 2, 2, 0)\r\n', NULL, '996,00m2.-', '6/06/1991', '2019-11-13 10:00:00.000', NULL, 59, NULL, NULL, NULL, 'UR', '2019-11-13 00:00:00.000', 'S', 2, 2, 0),
(71363, 'K', 3645, 5509, 'Abra Pampa', '1', '1', '29', '344', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAt.: K-1046', 'Nº13794', 'EXTENSION:\r\nFte.N.: 28,01 m. Una ochava de 4,00 m\r\nFte.E.: 22,17 m.\r\nC/fte.S.: 30,85 m.\r\nC/fte.O.: 25,00 m.\r\n\r\nLINDEROS:\r\nFte.N.: Calle Lavalle\r\nFte.E.: Calle San Martin\r\nC/fte.S.: Parcela 345\r\nC/fte.O.: p/Parc.343\r\n\r\nSuperficie: 767,06 m2.- \', NULL, N\'767,06\', N\'30/05/2016-jhy\', CAST(0x0000A61900000000 AS DateTime), NULL, 48, N\'SUPERFICIES PROPIAS\r\nPOLIG.:00-03\r\n\r\nCubierta: 63,86 m2\r\nSuperficieS Comunes de Uso Exclusivo:\r\nDescubierta: 87,62 m2\r\nTotal Polig.: 151,48 m2\r\n\r\nTOTAL U.F.: 151,48 m2\r\n\r\nSUPERFIES COMUNES TOTALES\r\n\r\nMuros y Tubos: 50,36 m2\r\nTOTAL: 50,36 m2\r\n\r\nPORCENTUAL 21,14 %\r\n\r\nDESTINO: U.F.1 a la U.F.4: Vivienda\r\n\r\nREGLAMENTO DE PROPIEDAD HORIZONTAL-E.P.nº 75 de fecha 20/11/2015-Esc.B.I.Alfaro-c/Cert.Nº19917 de fecha 03/11/2015-Pres.Nº22367 el 10/12/2015-INSC.PROVISORIA: 06/04/2016-INSC.DEFINITIVA: 30/05/2016.-jhy\r\n\r\n', '3', 'PB', 'PH', '2019-11-13 12:00:00.000', 'S', 3, '31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fol_matriculas_asientos`
--

CREATE TABLE `fol_matriculas_asientos` (
  `id_matricula_asiento` int(11) NOT NULL,
  `id_matricula` int(11) DEFAULT NULL,
  `nro_asiento` int(11) DEFAULT NULL,
  `texto` longtext COLLATE utf8mb4_bin,
  `id_estado` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario_ins` int(11) DEFAULT NULL,
  `id_usuario_ver` int(11) DEFAULT NULL,
  `tipo` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `observacion` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_ins` datetime(3) DEFAULT NULL,
  `fecha_ver` datetime(3) DEFAULT NULL,
  `hoja` int(11) DEFAULT NULL,
  `linea` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fol_matriculas_asientos_porc`
--

CREATE TABLE `fol_matriculas_asientos_porc` (
  `id_tabla` int(11) NOT NULL,
  `id_matricula_asiento` int(11) DEFAULT NULL,
  `id_matricula` int(11) DEFAULT NULL,
  `nro_asiento` int(11) DEFAULT NULL,
  `texto` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `id_estado` varchar(1) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fol_matriculas_asientos_porc`
--

INSERT INTO `fol_matriculas_asientos_porc` (`id_tabla`, `id_matricula_asiento`, `id_matricula`, `nro_asiento`, `texto`, `id_estado`) VALUES
(33, 258, 100, 1, '1/2 1/2', 'N'),
(34, 260, 100, 3, '1/2 1/2', 'N'),
(46, 350, 124, 5, '1/4 1/4 1/4 1/4', 'N'),
(47, 355, 125, 3, '1/2 1/2', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fol_matriculas_desbloqueadas`
--

CREATE TABLE `fol_matriculas_desbloqueadas` (
  `id_matricula_desbloqueada` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_matricula` int(11) DEFAULT NULL,
  `fecha` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fol_matriculas_desbloqueadas`
--

INSERT INTO `fol_matriculas_desbloqueadas` (`id_matricula_desbloqueada`, `id_usuario`, `id_matricula`, `fecha`) VALUES
(1, 33, 19818, '2019-11-13 00:00:00.000'),
(2, 33, 19970, '2019-11-13 07:20:00.000'),
(3, 19, 19896, '2019-11-13 00:00:00.000'),
(4, 19, 19448, '2019-11-13 07:20:00.000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fol_tipos_asiento`
--

CREATE TABLE `fol_tipos_asiento` (
  `id_tipo` varchar(3) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `asiento` varchar(1) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fol_tipos_asiento`
--

INSERT INTO `fol_tipos_asiento` (`id_tipo`, `nombre`, `orden`, `asiento`) VALUES
('CAN', 'CANCELACIONES', 3, 'S'),
('DES', 'DESCRIPCION', 5, 'N'),
('GRA', 'GRAVAMENES, RESTRIC. E INTERDICCIONES', 2, 'S'),
('OBS', 'OBSERVACIONES', 4, 'S'),
('SUP', 'SUPERFICIES', 6, 'N'),
('TIT', 'TITULARIDAD SOBRE EL DOMINIO', 1, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fol_tmp_matriculas_impresion`
--

CREATE TABLE `fol_tmp_matriculas_impresion` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `tipo` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `linea` int(11) DEFAULT NULL,
  `hoja` int(11) DEFAULT NULL,
  `nro_asiento` int(11) DEFAULT NULL,
  `linea_otrahoja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `fol_tmp_matriculas_impresion`
--

INSERT INTO `fol_tmp_matriculas_impresion` (`id`, `id_usuario`, `tipo`, `linea`, `hoja`, `nro_asiento`, `linea_otrahoja`) VALUES
(68624, 62, 'TIT', 3, 2, 5, 0),
(146239, 20, 'POR', 1, 1, 8699, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fol_usuarios_tipos`
--

CREATE TABLE `fol_usuarios_tipos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `tipo` varchar(1) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hipoteca`
--

CREATE TABLE `hipoteca` (
  `hiporeg` int(11) NOT NULL,
  `Dpto` char(1) COLLATE utf8mb4_bin NOT NULL,
  `ParMat` int(11) DEFAULT NULL,
  `ParPad` int(11) DEFAULT NULL,
  `ParUF` char(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `Hip_tip` int(11) NOT NULL,
  `MonCod` smallint(6) NOT NULL,
  `monto_hip` decimal(15,4) DEFAULT NULL,
  `Plazo` char(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `cod_escribano` int(11) DEFAULT NULL,
  `NroEscPub` int(11) DEFAULT NULL,
  `fec_escritura` datetime(3) DEFAULT NULL,
  `fec_registrado` datetime(3) DEFAULT NULL,
  `usr_cod` int(11) DEFAULT NULL,
  `usr_nom` char(10) COLLATE utf8mb4_bin NOT NULL,
  `usr_mod` datetime(3) NOT NULL,
  `ParUFAnt` char(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParPadAnt` int(11) DEFAULT NULL,
  `ParMatAnt` int(11) DEFAULT NULL,
  `N_Orden` int(11) NOT NULL,
  `Fec_Presen` datetime(3) NOT NULL,
  `GrdCod` smallint(6) NOT NULL,
  `HipBVig` smallint(6) DEFAULT NULL,
  `HipFecBVig` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `hipoteca`
--

INSERT INTO `hipoteca` (`hiporeg`, `Dpto`, `ParMat`, `ParPad`, `ParUF`, `Hip_tip`, `MonCod`, `monto_hip`, `Plazo`, `cod_escribano`, `NroEscPub`, `fec_escritura`, `fec_registrado`, `usr_cod`, `usr_nom`, `usr_mod`, `ParUFAnt`, `ParPadAnt`, `ParMatAnt`, `N_Orden`, `Fec_Presen`, `GrdCod`, `HipBVig`, `HipFecBVig`) VALUES
(1, 'A', 11806, 68056, NULL, 0, 5, '25380.0000', NULL, 17, 65, '2019-11-13 13:00:00.000', '2019-11-13 11:00:00.000', NULL, 'GONZALO', '2019-11-13 09:00:00.000', NULL, NULL, NULL, 13059, '2019-11-13 00:00:00.000', 0, 0, '0000-00-00 00:00:00.000'),
(2, 'A', 11808, 68058, NULL, 0, 5, '20777.0000', NULL, 35, 246, '2019-11-13 13:00:00.000', '2019-11-13 11:00:00.000', NULL, 'GONZALO', '2019-11-13 09:00:00.000', NULL, NULL, NULL, 16259, '2019-11-13 00:00:00.000', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hojxdoc`
--

CREATE TABLE `hojxdoc` (
  `COD_DOC` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `NRO_HOJA` varchar(7) CHARACTER SET utf8 DEFAULT NULL,
  `COD_LOTE` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `ARCHIVO` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `VOLUMEN` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `COD_SEG` double DEFAULT NULL,
  `FECHA` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `CAMPO1` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `CAMPO2` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `CAMPO3` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `CAMPO4` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `CAMPO5` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `CAMPO6` varchar(10) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `hojxdoc`
--

INSERT INTO `hojxdoc` (`COD_DOC`, `NRO_HOJA`, `COD_LOTE`, `ARCHIVO`, `VOLUMEN`, `COD_SEG`, `FECHA`, `CAMPO1`, `CAMPO2`, `CAMPO3`, `CAMPO4`, `CAMPO5`, `CAMPO6`) VALUES
('CP', '308901', 'M27G981', 'S000149B', 'VOL_014', 1, '1', 'A', '48536', NULL, NULL, ' 01-01-19', '8019800101'),
('CP', '39183', 'L6M972', 'S000124A', 'VOL_001', 1, '19970306', 'A', '02', '01', NULL, ' 01-01-198', '8019800101');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inhibici`
--

CREATE TABLE `inhibici` (
  `InhReg` int(11) NOT NULL,
  `InhLibro` char(2) COLLATE utf8mb4_bin DEFAULT NULL,
  `InhFolio` char(4) COLLATE utf8mb4_bin DEFAULT NULL,
  `InhAsiento` char(4) COLLATE utf8mb4_bin DEFAULT NULL,
  `InhNomApe` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `InhNDoc` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `InhFunc` char(40) COLLATE utf8mb4_bin DEFAULT NULL,
  `InhAutos` char(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `InhExJuz` char(12) COLLATE utf8mb4_bin DEFAULT NULL,
  `NatCod` smallint(6) DEFAULT NULL,
  `InhMonto` decimal(15,4) DEFAULT NULL,
  `InhExpte` int(11) DEFAULT NULL,
  `InhFPres` datetime(3) DEFAULT NULL,
  `InhFVenc` datetime(3) DEFAULT NULL,
  `InhUsr` smallint(6) DEFAULT NULL,
  `DocCod` smallint(6) DEFAULT NULL,
  `InhEstado` smallint(6) DEFAULT NULL,
  `InhCUI` decimal(11,0) DEFAULT NULL,
  `InhTCUI` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `inhibici`
--

INSERT INTO `inhibici` (`InhReg`, `InhLibro`, `InhFolio`, `InhAsiento`, `InhNomApe`, `InhNDoc`, `InhFunc`, `InhAutos`, `InhExJuz`, `NatCod`, `InhMonto`, `InhExpte`, `InhFPres`, `InhFVenc`, `InhUsr`, `DocCod`, `InhEstado`, `InhCUI`, `InhTCUI`) VALUES
(1, '1', '595', '596', 'BUSTAMANTE PEREZ Ernesto Rodolfo                           ', '0', NULL, NULL, NULL, 4, '0.0000', 0, NULL, NULL, 45, 0, 0, NULL, NULL),
(2, '1', '535', '536', 'CARRIZO DE LA PEÑA Mercedes                       ', '0', NULL, NULL, NULL, 4, '0.0000', 0, NULL, NULL, 45, 0, 0, NULL, NULL),
(13704, '6', '207', '943', 'CASTELLA MARE S.A.                       ', '0', 'FED.Nº1-STRIA.EJEC.FISC.-JUJUY', 'AFIP C/CASTELLA MARE S.A.', '42/1/04', 0, '0.0000', 16287, NULL, NULL, 49, 0, 0, NULL, NULL);

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
-- Estructura de tabla para la tabla `mescribanos`
--

CREATE TABLE `mescribanos` (
  `cod_escribanos` int(11) NOT NULL,
  `Nro_Registro` int(11) DEFAULT NULL,
  `DesEscribano` char(30) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `mescribanos`
--

INSERT INTO `mescribanos` (`cod_escribanos`, `Nro_Registro`, `DesEscribano`) VALUES
(58, 0, 'AGUILERA Patricia Teresa'),
(59, 0, 'CARRIZO Viviana E.'),
(51, 1, 'SNOPEK Celina Beatriz Teresa'),
(19, 2, 'BENITEZ  Alfredo Luis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ministerio`
--

CREATE TABLE `ministerio` (
  `Dpto` varchar(1) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParMat` varchar(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParPad` varchar(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParUF` varchar(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `AyN` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `TipoProp` varchar(1) COLLATE utf8mb4_bin DEFAULT NULL,
  `Proporcion` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `DNI` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `domcui` int(11) NOT NULL,
  `fecha_inscripcion` datetime(3) DEFAULT NULL,
  `fecha_carga` datetime(3) DEFAULT NULL,
  `IdDom` varchar(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `pasa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `ministerio`
--

INSERT INTO `ministerio` (`Dpto`, `ParMat`, `ParPad`, `ParUF`, `AyN`, `TipoProp`, `Proporcion`, `id_tipo_documento`, `DNI`, `domcui`, `fecha_inscripcion`, `fecha_carga`, `IdDom`, `pasa`) VALUES
('P', '5604', '9332', NULL, 'TINTE ENRIQUE', '4', '1/2', 1, '0', 0, '2019-11-13 10:00:00.000', '2019-11-13 13:00:00.000', '918421', 0),
('D', '3297', '12140', NULL, 'COLQUE TOMAS', '1', '100% ', 6, '7273714', 0, '2019-11-13 10:00:00.000', '2019-11-13 13:00:00.000', '918472', 0),
('D', '6654', '20431', '234', 'RAMIREZ ILDA', '4', '1/2 ', 1, '10339719', 0, '2019-11-13 10:00:00.000', '2019-11-13 13:00:00.000', '117146', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ministerio1`
--

CREATE TABLE `ministerio1` (
  `Dpto` varchar(1) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParMat` varchar(9) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParPad` varchar(9) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParUF` varchar(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParCirc` varchar(5) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParSecc` varchar(5) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParManz` varchar(5) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParParc` varchar(7) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParUbic` varchar(38) CHARACTER SET utf8 DEFAULT NULL,
  `ParUR` varchar(1) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParMnz` varchar(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParPiso` varchar(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParSup` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `ParUMed` varchar(2) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParDomi` varchar(35) CHARACTER SET utf8 DEFAULT NULL,
  `ParNomAnt` varchar(16) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParDomFis` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `ParObs` varchar(252) CHARACTER SET utf8 DEFAULT NULL,
  `ParFecAlta` datetime(3) DEFAULT NULL,
  `ParUsr` varchar(5) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParMANROP` varchar(2) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParUF2` varchar(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `PARTRSDOM` varchar(5) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParBVig` varchar(5) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParFecBVig` datetime(3) DEFAULT NULL,
  `UsrCod` varchar(5) COLLATE utf8mb4_bin DEFAULT NULL,
  `MSREPL_SYN` varchar(8) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParUFAnt` varchar(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParPadAnt` varchar(9) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParMatAnt` varchar(9) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `ministerio1`
--

INSERT INTO `ministerio1` (`Dpto`, `ParMat`, `ParPad`, `ParUF`, `ParCirc`, `ParSecc`, `ParManz`, `ParParc`, `ParUbic`, `ParUR`, `ParMnz`, `ParPiso`, `ParSup`, `ParUMed`, `ParDomi`, `ParNomAnt`, `ParDomFis`, `ParObs`, `ParFecAlta`, `ParUsr`, `ParMANROP`, `ParUF2`, `PARTRSDOM`, `ParBVig`, `ParFecBVig`, `UsrCod`, `MSREPL_SYN`, `ParUFAnt`, `ParPadAnt`, `ParMatAnt`) VALUES
('A', '55482', '25', NULL, '1', '1', '19', '14A', '                                      ', 'U', NULL, NULL, '328', 'M2', '38-177-168;  42BIS-83-82           ', 'M 10 L 14A ', 'OTERO Nº 1', 'PL.RES.38/76 Y 65/76 ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('A', '0', '2172', NULL, '0', '0', 'A', '20', 'VILLA GORRITI       ', 'U', NULL, NULL, '350', 'M2', '6BIS-73-65/66 Y MARG.              ', ' M A L 20   ', NULL, 'PLAZA DE LOS INMIGRANTES                                                                                                                                                                                                                       ', '2019-11-13 11:00:00.000', '11', NULL, NULL, '0', '1', '2019-11-13 11:00:00.000', '11', 'OCT', NULL, '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `text` text COLLATE utf8mb4_bin NOT NULL,
  `user_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `text`, `user_id`) VALUES
(1, 'nuevo', 'sdfs', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parcelas_exportadas`
--

CREATE TABLE `parcelas_exportadas` (
  `Dpto` longtext COLLATE utf8mb4_bin,
  `ParMat` longtext COLLATE utf8mb4_bin,
  `ParPad` longtext COLLATE utf8mb4_bin,
  `ParUF` longtext COLLATE utf8mb4_bin,
  `ParCirc` longtext COLLATE utf8mb4_bin,
  `ParSecc` longtext COLLATE utf8mb4_bin,
  `ParManz` longtext COLLATE utf8mb4_bin,
  `ParParc` longtext COLLATE utf8mb4_bin,
  `ParUbic` longtext COLLATE utf8mb4_bin,
  `ParUR` longtext COLLATE utf8mb4_bin,
  `ParMnz` longtext COLLATE utf8mb4_bin,
  `ParPiso` longtext COLLATE utf8mb4_bin,
  `ParSup` longtext COLLATE utf8mb4_bin,
  `ParUMed` longtext COLLATE utf8mb4_bin,
  `ParDomi` longtext COLLATE utf8mb4_bin,
  `ParNomAnt` longtext COLLATE utf8mb4_bin,
  `ParDomFis` longtext COLLATE utf8mb4_bin,
  `ParObs` longtext COLLATE utf8mb4_bin,
  `ParFecAlta` datetime(3) DEFAULT NULL,
  `ParUsr` longtext COLLATE utf8mb4_bin,
  `ParMANROP` longtext COLLATE utf8mb4_bin,
  `ParUF2` longtext COLLATE utf8mb4_bin,
  `PARTRSDOM` longtext COLLATE utf8mb4_bin,
  `ParBVig` longtext COLLATE utf8mb4_bin,
  `ParFecBVig` datetime(3) DEFAULT NULL,
  `UsrCod` longtext COLLATE utf8mb4_bin,
  `MSREPL_SYN` longtext COLLATE utf8mb4_bin,
  `ParUFAnt` longtext COLLATE utf8mb4_bin,
  `ParPadAnt` longtext COLLATE utf8mb4_bin,
  `ParMatAnt` longtext COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

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
(49, 'Bonfire.Roles.Add', 'To add New Roles', 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_actas_beneficiarios`
--

CREATE TABLE `reg_actas_beneficiarios` (
  `id_acta_beneficiario` int(11) NOT NULL,
  `id_acta_bien_familia` int(11) DEFAULT NULL,
  `id_beneficiario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_actas_beneficiarios`
--

INSERT INTO `reg_actas_beneficiarios` (`id_acta_beneficiario`, `id_acta_bien_familia`, `id_beneficiario`) VALUES
(3, 5, 3),
(4, 6, 4),
(5, 6, 5),
(6, 32, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_actas_bienes_familias`
--

CREATE TABLE `reg_actas_bienes_familias` (
  `id_acta_bien_familia` int(11) NOT NULL,
  `fecha_emision` datetime(3) DEFAULT NULL,
  `nro_orden` int(11) DEFAULT NULL,
  `jefe_dpto` longtext COLLATE utf8mb4_bin,
  `titular` longtext COLLATE utf8mb4_bin,
  `ubicado` longtext COLLATE utf8mb4_bin,
  `nro_padron` int(11) DEFAULT NULL,
  `matricula` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `inmueble` longtext COLLATE utf8mb4_bin,
  `presente` longtext COLLATE utf8mb4_bin,
  `fecha_carga` datetime(3) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_auditoria_union_personas`
--

CREATE TABLE `reg_auditoria_union_personas` (
  `id_auditoria` int(11) NOT NULL,
  `persona_anterior` int(11) DEFAULT NULL,
  `persona_unir` int(11) DEFAULT NULL,
  `tabla_afectada` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_auditoria_union_personas`
--

INSERT INTO `reg_auditoria_union_personas` (`id_auditoria`, `persona_anterior`, `persona_unir`, `tabla_afectada`, `id_usuario`) VALUES
(1, 817130, 817129, 'reg_personas_documentos', 5),
(2, 817130, 817129, 'reg_dominios', 5),
(4, 817130, 817129, 'reg_bienes_familias_personas', 5),
(3, 817130, 817129, 'reg_cesiones_personas', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_beneficiarios`
--

CREATE TABLE `reg_beneficiarios` (
  `id_beneficiario` int(11) NOT NULL,
  `nombre` longtext COLLATE utf8mb4_bin,
  `nro_doc` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_parentezco` int(11) DEFAULT NULL,
  `id_tipo_documento` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_alta` datetime(3) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_beneficiarios`
--

INSERT INTO `reg_beneficiarios` (`id_beneficiario`, `nombre`, `nro_doc`, `id_parentezco`, `id_tipo_documento`, `fecha_alta`, `id_usuario`) VALUES
(7, 'ledesma marcelo rolando daniel', '32001905', 10, '1', '2019-11-13 12:00:00.000', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_bienes_familias`
--

CREATE TABLE `reg_bienes_familias` (
  `id_bien_familia` int(11) NOT NULL,
  `id_parcela` int(11) DEFAULT NULL,
  `fecha_inscripcion` datetime(3) DEFAULT NULL,
  `fecha_levantamiento` datetime(3) DEFAULT NULL,
  `activo` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_carga` datetime(3) DEFAULT NULL,
  `id_expediente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_bienes_familias`
--

INSERT INTO `reg_bienes_familias` (`id_bien_familia`, `id_parcela`, `fecha_inscripcion`, `fecha_levantamiento`, `activo`, `id_usuario`, `fecha_carga`, `id_expediente`) VALUES
(102026, 0, NULL, '2019-11-13 00:00:00.000', 'N', 0, '2019-11-13 00:00:00.000', 0),
(102027, 0, NULL, NULL, 'N', 0, '2019-11-13 00:00:00.000', NULL),
(123544, 104174, NULL, '2019-11-13 00:00:00.000', 'N', 23, '2019-11-13 00:00:00.000', 12215),
(123545, 22425, NULL, NULL, 'N', 23, '2019-11-13 00:00:00.000', 18316);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_bienes_familias_personas`
--

CREATE TABLE `reg_bienes_familias_personas` (
  `id_bien_familia_persona` int(11) NOT NULL,
  `id_bien_familia` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_tipo_propietario` int(11) DEFAULT NULL,
  `porcentaje` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_bienes_familias_personas`
--

INSERT INTO `reg_bienes_familias_personas` (`id_bien_familia_persona`, `id_bien_familia`, `id_persona`, `id_tipo_propietario`, `porcentaje`, `orden`) VALUES
(199187, 102039, 510694, 1, '100%', 1),
(199188, 102040, 551117, 1, '100%', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_casos_estudios`
--

CREATE TABLE `reg_casos_estudios` (
  `id_caso_estudio` int(11) NOT NULL,
  `id_expediente` int(11) DEFAULT NULL,
  `nro_orden` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `padron` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `matricula` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `titular` longtext COLLATE utf8mb4_bin,
  `estudio` longtext COLLATE utf8mb4_bin,
  `id_usuario` int(11) DEFAULT NULL,
  `username` longtext COLLATE utf8mb4_bin,
  `fecha_carga` datetime(3) NOT NULL,
  `fecha_modifica` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_casos_estudios`
--

INSERT INTO `reg_casos_estudios` (`id_caso_estudio`, `id_expediente`, `nro_orden`, `padron`, `matricula`, `titular`, `estudio`, `id_usuario`, `username`, `fecha_carga`, `fecha_modifica`) VALUES
(7, NULL, NULL, 'A-46705', NULL, ' N\'\', N\'\', \r\n', 'REF.INFORME \"C\" Nº723/2015.-\r\n	Se informa que el inmueble individualizado como lote 22 manzana VI hoy parcela 1 manzana 90 - Sección 11 - Circunscripción 1, padrón A-46705 ubicado en Barrio Almirante Brown Dpto.Dr.Manuel Belgrano, surge del dominio en mayor extensión del Instituto Provincial de Previsión Social, inscripto al folio 389 asiento 5689 marginal del libro IX de Capital.\r\n	De acuerdo al informe que se adjunta de la División Archivo de Planos, las características y nomenclatura de la parcela surgen del Plano de Mensura aprobado por Res.nº83/73.\r\n	El inmueble no registra embargos, hipotecas, restricciones, interdicciones, ni otros derechos reales. Y que el Instituto Provincial de Previsión Social, (I.P.P.S.), no se encuentra inhibido para disponer de sus bienes.\r\nDPTO. REGISTRO INMOBILIARIO- 11 de setiembre de 2015.- o.m.', 27, 'omachaca', '2019-11-13 13:00:00.000', '2019-11-13 10:00:00.000'),
(21, NULL, NULL, 'k-124', NULL, '', 'REF.INFORME \"C\" Nº932/2017.-\r\n	Según antecedentes se informa que el inmueble ubicado en Abra Pampa Dpto.Cochinoca, individualizado como lote 97 y 98 manzana 9 padrón K-124 con límites en conjunto, se encuentra registrado en condominio entre Odon Lamas, Emilia Lamas de Ramos, Victor Lamas, Aldo Antonio Lamas, Fausta Elvira Lamas, Genaro Raúl Lamas, Andrea Estefanía Lamas y Leoncio Humberto Lamas, al folio 123 asiento 182 del libro 2 y Andrea Estefania Lamas también registra a los folios 307/309 del libro 6 de Cochinoca.\r\n	Cabe mencionar que en los dominios citados, no se determina la proporción que le corresponde a cada uno de los propietarios.\r\nDPTO. REGISTRO INMOBILIARIO- 21 de octubre de 2017.- o.m.', 27, 'omachaca', '2019-11-13 00:00:00.000', '2019-11-13 13:00:00.000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_cesiones`
--

CREATE TABLE `reg_cesiones` (
  `id_cesion` int(11) NOT NULL,
  `libro` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `folio` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `id_tipo_inscripcion` int(11) DEFAULT NULL,
  `fecha_inscripcion` datetime(3) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_carga` datetime(3) DEFAULT NULL,
  `activo` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_levantamiento` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_cesiones`
--

INSERT INTO `reg_cesiones` (`id_cesion`, `libro`, `folio`, `anio`, `id_tipo_inscripcion`, `fecha_inscripcion`, `id_usuario`, `fecha_carga`, `activo`, `fecha_levantamiento`) VALUES
(21583, 'M', 86, 2000, 1, '2019-11-13 10:00:00.000', 4, '2019-11-13 13:00:00.000', 'S', NULL),
(21584, '1', 1, 1, 0, '2019-11-13 09:00:00.000', 4, NULL, 'S', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_cesiones_parcelas`
--

CREATE TABLE `reg_cesiones_parcelas` (
  `id_cesion_parcela` int(11) NOT NULL,
  `id_cesion` int(11) DEFAULT NULL,
  `id_parcela` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_cesiones_parcelas`
--

INSERT INTO `reg_cesiones_parcelas` (`id_cesion_parcela`, `id_cesion`, `id_parcela`) VALUES
(25648, 21583, 141992),
(25649, 21584, 102097),
(25650, 21586, 109846),
(25651, 21587, 86045);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_cesiones_personas`
--

CREATE TABLE `reg_cesiones_personas` (
  `id_cesion_persona` int(11) NOT NULL,
  `id_cesion` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_tipo_cesion` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_cesiones_personas`
--

INSERT INTO `reg_cesiones_personas` (`id_cesion_persona`, `id_cesion`, `id_persona`, `id_tipo_cesion`, `orden`) VALUES
(159655, 21583, 636723, 1, 1),
(159656, 21583, 580590, 2, 2),
(159657, 21584, 503388, 1, 1),
(159658, 21584, 636730, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_cesiones_tipo_cesion`
--

CREATE TABLE `reg_cesiones_tipo_cesion` (
  `id_tipo_cesion` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_cesiones_tipo_cesion`
--

INSERT INTO `reg_cesiones_tipo_cesion` (`id_tipo_cesion`, `nombre`) VALUES
(1, 'CAUSANTE'),
(2, 'CESIONARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_cesiones_tipo_inscripcion`
--

CREATE TABLE `reg_cesiones_tipo_inscripcion` (
  `id_tipo_inscripcion` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_cesiones_tipo_inscripcion`
--

INSERT INTO `reg_cesiones_tipo_inscripcion` (`id_tipo_inscripcion`, `nombre`) VALUES
(1, 'INSCRIPCION DEFINITIVA'),
(2, 'INSCRIPCION PROVISORIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_departamentos`
--

CREATE TABLE `reg_departamentos` (
  `Dpto` char(1) COLLATE utf8mb4_bin NOT NULL,
  `DptoDes` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_departamentos`
--

INSERT INTO `reg_departamentos` (`Dpto`, `DptoDes`) VALUES
('A', 'DR. MANUEL BELGRANO'),
('B', 'EL CARMEN'),
('C', 'SAN ANTONIO'),
('D', 'SAN PEDRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_dominios`
--

CREATE TABLE `reg_dominios` (
  `id_dominio` int(11) NOT NULL,
  `id_parcela` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `porcentaje` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_inscripcion` datetime(3) DEFAULT NULL,
  `id_tipo_propietario` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_carga` datetime(3) DEFAULT NULL,
  `id_expediente` int(11) DEFAULT NULL,
  `nro_orden` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fechabaja` datetime(3) DEFAULT NULL,
  `id_persona_documento` int(11) DEFAULT NULL,
  `numero` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `id_tipo_moneda` int(11) DEFAULT NULL,
  `monto` decimal(15,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_dominios`
--

INSERT INTO `reg_dominios` (`id_dominio`, `id_parcela`, `id_persona`, `porcentaje`, `fecha_inscripcion`, `id_tipo_propietario`, `id_usuario`, `fecha_carga`, `id_expediente`, `nro_orden`, `fechabaja`, `id_persona_documento`, `numero`, `id_tipo_documento`, `id_tipo_moneda`, `monto`) VALUES
(916913, 26376, 653251, '1/2    ', '2019-11-13 10:00:00.000', 4, 19, '2019-11-13 13:00:00.000', 0, '6093      ', NULL, NULL, NULL, NULL, NULL, '0.0000'),
(916915, 80812, 653253, '1/2    ', '2019-11-13 10:00:00.000', 4, 19, '2019-11-13 13:00:00.000', 0, '6220      ', NULL, NULL, NULL, NULL, NULL, '0.0000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_dominios_viejo`
--

CREATE TABLE `reg_dominios_viejo` (
  `DomReg` int(11) NOT NULL,
  `Dpto` char(1) COLLATE utf8mb4_bin DEFAULT NULL,
  `DocCod` smallint(6) DEFAULT NULL,
  `DomNDoc` char(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `DomProp` char(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `DomNroOrde` char(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `DomFecIns` datetime(3) DEFAULT NULL,
  `DomUsr` smallint(6) DEFAULT NULL,
  `DomFecUsr` datetime(3) DEFAULT NULL,
  `PropTip` smallint(6) DEFAULT NULL,
  `MonCod` smallint(6) DEFAULT NULL,
  `DomMonto` decimal(15,4) DEFAULT NULL,
  `ParMat` int(11) DEFAULT NULL,
  `ParPad` int(11) DEFAULT NULL,
  `ParUF` char(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `DomApe` char(60) COLLATE utf8mb4_bin DEFAULT NULL,
  `DomCUI` decimal(11,0) DEFAULT NULL,
  `DomTCUI` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_dominios_viejo`
--

INSERT INTO `reg_dominios_viejo` (`DomReg`, `Dpto`, `DocCod`, `DomNDoc`, `DomProp`, `DomNroOrde`, `DomFecIns`, `DomUsr`, `DomFecUsr`, `PropTip`, `MonCod`, `DomMonto`, `ParMat`, `ParPad`, `ParUF`, `DomApe`, `DomCUI`, `DomTCUI`) VALUES
(80, 'A', 4, '822224', '1/2', '', '2019-11-13 00:00:00.000', 19, '2019-11-13 00:00:00.000', 5, 0, '0.0000', 0, 112, NULL, 'FLORES CELIA MARTINA', '0', 0),
(145, 'A', 0, 'A-229/1', '100%', '', '2019-11-13 00:00:00.000', 99, '2019-11-13 00:00:00.000', 3, 0, '0.0000', 0, 229, NULL, 'BLOIS OLGA ROSA', '0', 0),
(413475, 'P', 1, '20549303', '1/12', '1983', '2019-11-13 00:00:00.000', 19, '2019-11-13 00:00:00.000', 4, 5, '13572.0000', 12232, 65702, NULL, 'ARJONA SERGIO DANIEL', '0', 1),
(413476, 'P', 1, '18444094', '1/12', '1983', '2019-11-13 00:00:00.000', 19, '2019-11-13 00:00:00.000', 4, 5, '13572.0000', 12232, 65702, NULL, 'ARJONA RAMON ROBERTO', '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_estados`
--

CREATE TABLE `reg_estados` (
  `id_estado` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tipo` varchar(1) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_estados`
--

INSERT INTO `reg_estados` (`id_estado`, `nombre`, `tipo`) VALUES
(1, 'RECIBIDO', 'I'),
(2, 'COMIENZO GESTION', 'R'),
(3, 'FIN GESTION', 'R'),
(4, 'EGRESADO', 'E'),
(5, 'REINGRESADO', 'I'),
(6, 'OBSERVADO', 'F'),
(7, 'FINALIZADO', 'F'),
(8, 'RECHAZADO', 'F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_expedientes`
--

CREATE TABLE `reg_expedientes` (
  `id_expediente` bigint(20) NOT NULL,
  `anio` int(11) NOT NULL,
  `nro_orden` int(11) NOT NULL,
  `bis` smallint(6) DEFAULT NULL,
  `tipo` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `id_objeto` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `denominacion` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `monto_sello` double DEFAULT NULL,
  `monto_convenio` double DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `fecha_estado` datetime(3) DEFAULT NULL,
  `id_sector` int(11) DEFAULT NULL,
  `fecha_inicio` datetime(3) DEFAULT NULL,
  `fecha_fin` datetime(3) DEFAULT NULL,
  `id_tipo_salida` char(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `prioridad` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `origen` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_expediente_web` int(11) DEFAULT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `nro_escritura` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_escritura` datetime(3) DEFAULT NULL,
  `estado` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_expediente_ant` bigint(20) DEFAULT NULL,
  `fecha_volante_observado` datetime(3) DEFAULT NULL,
  `cant_formularios` int(11) DEFAULT NULL,
  `ley_5780_13` varchar(1) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_expedientes`
--

INSERT INTO `reg_expedientes` (`id_expediente`, `anio`, `nro_orden`, `bis`, `tipo`, `id_objeto`, `denominacion`, `monto_sello`, `monto_convenio`, `id_estado`, `fecha_estado`, `id_sector`, `fecha_inicio`, `fecha_fin`, `id_tipo_salida`, `prioridad`, `origen`, `id_expediente_web`, `id_solicitante`, `nro_escritura`, `fecha_escritura`, `estado`, `id_usuario`, `id_expediente_ant`, `fecha_volante_observado`, `cant_formularios`, `ley_5780_13`) VALUES
(309672, 2014, 1, 1, 'B', 'L', NULL, 0, 0, 7, '2019-11-13 00:00:00.000', 1, '2019-11-13 00:00:00.000', NULL, NULL, 'N', 'M', NULL, 11522, '0', '2019-11-13 00:00:00.000', 'N', 11, 0, '2019-11-13 00:00:00.000', NULL, NULL),
(309673, 2014, 2, 1, 'B', 'L', NULL, 0, 0, 7, '2019-11-13 00:00:00.000', 1, '2019-11-13 00:00:00.000', NULL, NULL, 'N', 'M', NULL, 11522, '0', '2019-11-13 00:00:00.000', 'N', 11, 0, '2019-11-13 00:00:00.000', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_expedientes_estados`
--

CREATE TABLE `reg_expedientes_estados` (
  `id_expediente_estado` int(11) NOT NULL,
  `id_expediente` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `fecha_estado` datetime(3) NOT NULL,
  `fecha` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `hora` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `id_sector` int(11) DEFAULT NULL,
  `observacion` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_expedientes_histo`
--

CREATE TABLE `reg_expedientes_histo` (
  `id_expediente` bigint(20) NOT NULL,
  `anio` int(11) NOT NULL,
  `nro_orden` int(11) NOT NULL,
  `bis` smallint(6) DEFAULT NULL,
  `tipo` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `id_objeto` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `denominacion` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `monto_sello` double DEFAULT NULL,
  `monto_convenio` double DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `fecha_estado` datetime(3) DEFAULT NULL,
  `id_sector` int(11) DEFAULT NULL,
  `fecha_inicio` datetime(3) DEFAULT NULL,
  `fecha_fin` datetime(3) DEFAULT NULL,
  `id_tipo_salida` char(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `prioridad` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `origen` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_expediente_web` int(11) DEFAULT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `nro_escritura` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_escritura` datetime(3) DEFAULT NULL,
  `estado` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_expediente_ant` bigint(20) DEFAULT NULL,
  `fecha_volante_observado` datetime(3) DEFAULT NULL,
  `cant_formularios` int(11) DEFAULT NULL,
  `ley_5780_13` varchar(1) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_expedientes_histo`
--

INSERT INTO `reg_expedientes_histo` (`id_expediente`, `anio`, `nro_orden`, `bis`, `tipo`, `id_objeto`, `denominacion`, `monto_sello`, `monto_convenio`, `id_estado`, `fecha_estado`, `id_sector`, `fecha_inicio`, `fecha_fin`, `id_tipo_salida`, `prioridad`, `origen`, `id_expediente_web`, `id_solicitante`, `nro_escritura`, `fecha_escritura`, `estado`, `id_usuario`, `id_expediente_ant`, `fecha_volante_observado`, `cant_formularios`, `ley_5780_13`) VALUES
(30, 2006, 1039, 1, 'B', 'L', NULL, 8.6, 18, 3, '2019-11-13 00:00:00.000', NULL, '2019-11-13 00:00:00.000', '2019-11-13 00:00:00.000', '1', 'N', 'M', 0, 70, '0', '2019-11-13 00:00:00.000', 'N', NULL, NULL, NULL, NULL, NULL),
(31, 2006, 0, 1, 'B', 'L', NULL, 0, 0, 3, '2019-11-13 00:00:00.000', NULL, '2019-11-13 00:00:00.000', '2019-11-13 00:00:00.000', '1', 'N', 'M', 0, 0, '0', '2019-11-13 00:00:00.000', 'N', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_expedientes_histo_estados`
--

CREATE TABLE `reg_expedientes_histo_estados` (
  `id_expediente_estado` int(11) NOT NULL,
  `id_expediente` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `fecha_estado` datetime(3) NOT NULL,
  `fecha` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `hora` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `id_sector` int(11) DEFAULT NULL,
  `observacion` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_expedientes_histo_parcelas`
--

CREATE TABLE `reg_expedientes_histo_parcelas` (
  `id_expediente_parcela` int(11) NOT NULL,
  `id_expediente` bigint(20) NOT NULL,
  `nro_orden` int(11) DEFAULT NULL,
  `id_parcela` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_expedientes_histo_parcelas`
--

INSERT INTO `reg_expedientes_histo_parcelas` (`id_expediente_parcela`, `id_expediente`, `nro_orden`, `id_parcela`) VALUES
(36822, 194109, 131, 94434),
(36861, 194111, 133, 152327),
(36862, 194111, 131, 152327),
(36870, 194118, 140, 154128);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_expedientes_histo_partes`
--

CREATE TABLE `reg_expedientes_histo_partes` (
  `id_expediente_parte` int(11) NOT NULL,
  `id_expediente` int(11) NOT NULL,
  `nro_parte` int(11) DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id_tipo_parte` int(11) DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `nro_documento` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_expedientes_histo_partes`
--

INSERT INTO `reg_expedientes_histo_partes` (`id_expediente_parte`, `id_expediente`, `nro_parte`, `nombre`, `id_tipo_parte`, `id_tipo_documento`, `nro_documento`) VALUES
(2065832, 210915, 1, 'AMADO MARIA DEL CARMEN RODELINDA o ROLANDIA\'', 1, 1, '11072127'),
(2065834, 210915, 1, 'ASARAPURA HILARIO', 1, 1, '5264391');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_expedientes_parcelas`
--

CREATE TABLE `reg_expedientes_parcelas` (
  `id_expediente_parcela` int(11) NOT NULL,
  `id_expediente` bigint(20) NOT NULL,
  `nro_orden` int(11) DEFAULT NULL,
  `id_parcela` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_expedientes_parcelas`
--

INSERT INTO `reg_expedientes_parcelas` (`id_expediente_parcela`, `id_expediente`, `nro_orden`, `id_parcela`) VALUES
(8, 569430, 13959, 0),
(9, 569431, 13959, 0),
(10, 569432, 13959, 0),
(11, 569431, 569430, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_expedientes_partes`
--

CREATE TABLE `reg_expedientes_partes` (
  `id_expediente_parte` int(11) NOT NULL,
  `id_expediente` int(11) NOT NULL,
  `nro_parte` int(11) DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id_tipo_parte` int(11) DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `nro_documento` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_expedientes_partes`
--

INSERT INTO `reg_expedientes_partes` (`id_expediente_parte`, `id_expediente`, `nro_parte`, `nombre`, `id_tipo_parte`, `id_tipo_documento`, `nro_documento`) VALUES
(3971408, 436737, 1, 'NAVIA SAAVEDRA BONIFACIO', 1, 3, '32629'),
(3971430, 436745, 1, 'VASQUEZ NICOLAS JAVIER', 1, 1, '28956778');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_hipotecas`
--

CREATE TABLE `reg_hipotecas` (
  `id_hipoteca` int(11) NOT NULL,
  `fecha_hipoteca` datetime(3) DEFAULT NULL,
  `id_expediente` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `nro_orden` int(11) DEFAULT NULL,
  `nro_escritura` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_escritura` datetime(3) DEFAULT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_hipoteca_estado` int(11) NOT NULL,
  `fecha_cancelacion` datetime(3) DEFAULT NULL,
  `id_expediente_can` int(11) DEFAULT NULL,
  `anio_can` int(11) DEFAULT NULL,
  `nro_orden_can` int(11) DEFAULT NULL,
  `nro_escritura_can` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_escritura_can` datetime(3) DEFAULT NULL,
  `id_solicitante_can` int(11) DEFAULT NULL,
  `id_usuario_can` int(11) DEFAULT NULL,
  `id_hipoteca_grado` int(11) NOT NULL,
  `id_hipoteca_tipo` int(11) NOT NULL,
  `id_tipo_moneda` int(11) NOT NULL,
  `plazo_ini` int(11) DEFAULT NULL,
  `plazo_fin` int(11) DEFAULT NULL,
  `id_plazo_unidad` int(11) DEFAULT NULL,
  `plazo_desc` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_presentacion` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_hipotecas`
--

INSERT INTO `reg_hipotecas` (`id_hipoteca`, `fecha_hipoteca`, `id_expediente`, `anio`, `nro_orden`, `nro_escritura`, `fecha_escritura`, `id_solicitante`, `id_usuario`, `id_hipoteca_estado`, `fecha_cancelacion`, `id_expediente_can`, `anio_can`, `nro_orden_can`, `nro_escritura_can`, `fecha_escritura_can`, `id_solicitante_can`, `id_usuario_can`, `id_hipoteca_grado`, `id_hipoteca_tipo`, `id_tipo_moneda`, `plazo_ini`, `plazo_fin`, `id_plazo_unidad`, `plazo_desc`, `fecha_presentacion`) VALUES
(335529, '2019-11-13 00:00:00.000', 1164, 2006, 93, '0', '2019-11-13 00:00:00.000', 56, 23, 1, '2019-11-13 00:00:00.000', 256048, 2011, 9245, '493', '2019-11-13 00:00:00.000', 41, 55, 0, 2, 5, 0, 8, 4, '8 AÑOS', '2019-11-13 00:00:00.000'),
(335530, '2019-11-13 00:00:00.000', 135265, 1998, 37, '398', '2019-11-13 00:00:00.000', 33, 23, 1, '2019-11-13 00:00:00.000', 512, 2007, 37, '493', '2019-11-13 00:00:00.000', 43, 23, 0, 1, 5, 0, 8, 4, 'NO ESPECIFICADO', '2019-11-13 00:00:00.000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_hipotecas_estados`
--

CREATE TABLE `reg_hipotecas_estados` (
  `id_hipoteca_estado` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_hipotecas_estados`
--

INSERT INTO `reg_hipotecas_estados` (`id_hipoteca_estado`, `nombre`) VALUES
(0, 'VIGENTE'),
(1, 'CANCELADA POR ESCRIBANO'),
(2, 'CANCELADA POR NOTA'),
(3, 'CANCELADA POR PLANO'),
(4, 'CANCELADA POR OFICIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_hipotecas_grados`
--

CREATE TABLE `reg_hipotecas_grados` (
  `id_hipoteca_grado` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_hipotecas_grados`
--

INSERT INTO `reg_hipotecas_grados` (`id_hipoteca_grado`, `nombre`) VALUES
(0, '1er Grado'),
(1, '2er Grado'),
(2, 'PRIVADO'),
(3, 'Ampliacion'),
(4, 'Con Letra Hip.'),
(5, '3er Grado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_hipotecas_grupos`
--

CREATE TABLE `reg_hipotecas_grupos` (
  `id_hipoteca_grupo` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_hipotecas_grupos`
--

INSERT INTO `reg_hipotecas_grupos` (`id_hipoteca_grupo`, `nombre`) VALUES
(0, 'NO DEFINIDO'),
(1, 'ESTATAL'),
(2, 'PRIVADO'),
(3, 'NACIONAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_hipotecas_parcelas`
--

CREATE TABLE `reg_hipotecas_parcelas` (
  `id_hipoteca_parcela` int(11) NOT NULL,
  `id_hipoteca` int(11) NOT NULL,
  `id_parcela` int(11) DEFAULT NULL,
  `Dpto` char(1) COLLATE utf8mb4_bin NOT NULL,
  `ParMat` int(11) NOT NULL,
  `ParPad` int(11) NOT NULL,
  `ParUF` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `monto` decimal(15,4) DEFAULT NULL,
  `ultima_modificacion` datetime(3) DEFAULT NULL,
  `hiporeg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_hipotecas_parcelas`
--

INSERT INTO `reg_hipotecas_parcelas` (`id_hipoteca_parcela`, `id_hipoteca`, `id_parcela`, `Dpto`, `ParMat`, `ParPad`, `ParUF`, `monto`, `ultima_modificacion`, `hiporeg`) VALUES
(234430, 335529, 67887, 'A', 67470, 91770, NULL, '150000.0000', NULL, NULL),
(234431, 335530, 79171, 'b', 10740, 9793, NULL, '24000.0000', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_hipotecas_sistant`
--

CREATE TABLE `reg_hipotecas_sistant` (
  `hiporeg` int(11) NOT NULL,
  `Dpto` char(1) COLLATE utf8mb4_bin NOT NULL,
  `ParMat` int(11) NOT NULL,
  `ParPad` int(11) NOT NULL,
  `ParUF` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `nro_orden` int(11) NOT NULL,
  `nro_escritura` int(11) NOT NULL,
  `fecha_escritura` datetime(3) DEFAULT NULL,
  `fecha_registro` datetime(3) DEFAULT NULL,
  `fecha_presentacion` datetime(3) NOT NULL,
  `fecha_cancelacion` datetime(3) DEFAULT NULL,
  `id_hipoteca_grado` int(11) NOT NULL,
  `id_hipoteca_tipo` int(11) NOT NULL,
  `id_tipo_moneda` int(11) NOT NULL,
  `monto` decimal(15,4) DEFAULT NULL,
  `cod_escribano` int(11) DEFAULT NULL,
  `plazo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `id_hipoteca_estado` int(11) NOT NULL,
  `ultima_modificacion` datetime(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_hipotecas_tipos`
--

CREATE TABLE `reg_hipotecas_tipos` (
  `id_hipoteca_tipo` int(11) NOT NULL,
  `id_hipoteca_grupo` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_hipotecas_tipos`
--

INSERT INTO `reg_hipotecas_tipos` (`id_hipoteca_tipo`, `id_hipoteca_grupo`, `nombre`) VALUES
(1, 3, 'Banco Hipotecario'),
(2, 3, 'Bco. Nacion Arg.'),
(3, 2, 'Particulares y otro o'),
(4, 2, 'Bco. Santander Rio Sociedad Anonima');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_imagenes`
--

CREATE TABLE `reg_imagenes` (
  `id_imagen` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_imagenes`
--

INSERT INTO `reg_imagenes` (`id_imagen`, `id_usuario`, `numero`, `cantidad`, `fecha`) VALUES
(1, 33, 1, 0, '2019-11-13 00:00:00.000'),
(2, 24, 156, 1, '2019-11-13 07:20:00.000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_imagenes_consultas`
--

CREATE TABLE `reg_imagenes_consultas` (
  `id_imagen_consulta` int(11) NOT NULL,
  `id_imagen` int(11) DEFAULT NULL,
  `dpto` varchar(1) COLLATE utf8mb4_bin DEFAULT NULL,
  `matricula` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_imagenes_consultas`
--

INSERT INTO `reg_imagenes_consultas` (`id_imagen_consulta`, `id_imagen`, `dpto`, `matricula`) VALUES
(1, 1, 'A', 2500),
(2, 1, 'A', 2500),
(3, 1, 'A', 2564),
(4, 1, 'E', 2351);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_inhibiciones`
--

CREATE TABLE `reg_inhibiciones` (
  `id_inhibicion` int(11) NOT NULL,
  `libro` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `folio` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `asiento` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_juzgado` int(11) DEFAULT NULL,
  `id_naturaleza` int(11) DEFAULT NULL,
  `fecha_mov` datetime(3) DEFAULT NULL,
  `fecha_vig` datetime(3) DEFAULT NULL,
  `id_expediente` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `nro_orden` int(11) DEFAULT NULL,
  `detalles` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `autos` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `expediente` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `monto` decimal(15,4) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha_inicio` datetime(3) DEFAULT NULL,
  `Razon` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_persona_documento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_inhibiciones`
--

INSERT INTO `reg_inhibiciones` (`id_inhibicion`, `libro`, `folio`, `asiento`, `id_juzgado`, `id_naturaleza`, `fecha_mov`, `fecha_vig`, `id_expediente`, `anio`, `nro_orden`, `detalles`, `id_usuario`, `autos`, `expediente`, `monto`, `estado`, `fecha_inicio`, `Razon`, `id_persona`, `id_persona_documento`) VALUES
(253008, '2', '4', '19   ', 7763, 1, '2019-11-13 00:00:00.000', '2019-11-13 00:00:00.000', 0, 2001, 1238, NULL, 3, 'QUIEBRA DE DORA ACME PARDIÑAS DE BUSTAMANTE PEREZ\', N\'A-61817/92  \', 0.0000, 0, CAST(0x0000904100000', 'A-61817/92', '0.0000', 0, '2019-11-13 00:00:00.000', 'BUSTAMANTE PEREZ ERNESTO RODOLFO', 653761, 681);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_inhibiciones_asientos`
--

CREATE TABLE `reg_inhibiciones_asientos` (
  `id_inhibiciones_asiento` int(11) NOT NULL,
  `id_inhibicion` int(11) DEFAULT NULL,
  `libro` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `folio` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `asiento` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_juzgado` int(11) DEFAULT NULL,
  `id_naturaleza` int(11) DEFAULT NULL,
  `fecha_mov` datetime(3) DEFAULT NULL,
  `fecha_vig` datetime(3) DEFAULT NULL,
  `id_expediente` bigint(20) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `nro_orden` int(11) DEFAULT NULL,
  `detalles` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `autos` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `expediente` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `monto` decimal(15,4) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha_inicio` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_inhibiciones_asientos`
--

INSERT INTO `reg_inhibiciones_asientos` (`id_inhibiciones_asiento`, `id_inhibicion`, `libro`, `folio`, `asiento`, `id_juzgado`, `id_naturaleza`, `fecha_mov`, `fecha_vig`, `id_expediente`, `anio`, `nro_orden`, `detalles`, `id_usuario`, `autos`, `expediente`, `monto`, `estado`, `fecha_inicio`) VALUES
(444555, 481726, '1', '595 ', '596  ', 10572, 8, '2019-11-13 00:00:00.000', NULL, 0, 0, 0, NULL, 3, NULL, NULL, '0.0000', 1, '2019-11-13 00:00:00.000'),
(444556, 481727, '1', '535 ', '536  ', 10572, 8, '2019-11-13 00:00:00.000', NULL, 0, 0, 0, NULL, 3, NULL, NULL, '0.0000', 1, '2019-11-13 00:00:00.000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_inhibiciones_naturalezas`
--

CREATE TABLE `reg_inhibiciones_naturalezas` (
  `id_naturaleza` int(11) NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tipo` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `unidad` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `cod_ant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_inhibiciones_naturalezas`
--

INSERT INTO `reg_inhibiciones_naturalezas` (`id_naturaleza`, `descripcion`, `tipo`, `cantidad`, `unidad`, `cod_ant`) VALUES
(1, 'INSCRIPCION DEFINITIVA', 'I', 5, 'A', 0),
(2, 'INSCRIPCION PROVISORIA', 'I', 180, 'D', 1),
(3, 'REINSCRIPCION DEFINITIVA', 'I', 5, 'A', 2),
(4, 'INHABILITADA POR TIEMPO INDETERMINADO', 'I', 99, 'A', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_inhibiciones_relaciones`
--

CREATE TABLE `reg_inhibiciones_relaciones` (
  `id` int(11) NOT NULL,
  `id_inhibicion` int(11) DEFAULT NULL,
  `id_inhibicion_relacionada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_inhibiciones_relaciones`
--

INSERT INTO `reg_inhibiciones_relaciones` (`id`, `id_inhibicion`, `id_inhibicion_relacionada`) VALUES
(18171, 264054, 278007),
(18172, 264049, 278008),
(18173, 264048, 278009),
(18174, 263909, 278010);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_inhibiciones_version1`
--

CREATE TABLE `reg_inhibiciones_version1` (
  `id_inhibicion` int(11) NOT NULL,
  `Razon` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_persona` int(11) NOT NULL,
  `id_persona_documento` int(11) NOT NULL,
  `fecha_fin` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_inhibiciones_version1`
--

INSERT INTO `reg_inhibiciones_version1` (`id_inhibicion`, `Razon`, `id_persona`, `id_persona_documento`, `fecha_fin`) VALUES
(481726, 'BUSTAMANTE PEREZ ERNESTO RODOLFO', 810070, 179481, '2019-11-13 00:00:00.000'),
(481727, 'CARRIZO DE LA PEÑA MERCEDES', 810036, 179444, '2019-11-13 00:00:00.000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_matriculas`
--

CREATE TABLE `reg_matriculas` (
  `fte` char(20) CHARACTER SET utf8 DEFAULT NULL,
  `cf` char(20) CHARACTER SET utf8 DEFAULT NULL,
  `cdo1` char(20) CHARACTER SET utf8 DEFAULT NULL,
  `cdo2` char(20) CHARACTER SET utf8 DEFAULT NULL,
  `n` char(20) CHARACTER SET utf8 DEFAULT NULL,
  `s` char(20) CHARACTER SET utf8 DEFAULT NULL,
  `e` char(20) CHARACTER SET utf8 DEFAULT NULL,
  `o` char(20) CHARACTER SET utf8 DEFAULT NULL,
  `nota` char(100) CHARACTER SET utf8 DEFAULT NULL,
  `id_parcela` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_objetos`
--

CREATE TABLE `reg_objetos` (
  `id_objeto` varchar(3) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `escritura` char(1) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_objetos`
--

INSERT INTO `reg_objetos` (`id_objeto`, `nombre`, `escritura`) VALUES
('AC', 'Aporte Capital', 'S'),
('AL', 'Anotación de Litis', 'N'),
('AR', 'Anulación de Reglamento', 'S'),
('BCV', 'Boleto Compra Venta', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_parcelas`
--

CREATE TABLE `reg_parcelas` (
  `id_parcela` bigint(20) NOT NULL,
  `Dpto` char(1) COLLATE utf8mb4_bin NOT NULL,
  `ParMat` int(11) NOT NULL,
  `ParPad` int(11) NOT NULL,
  `ParUF` char(3) COLLATE utf8mb4_bin NOT NULL,
  `ParCirc` smallint(6) DEFAULT NULL,
  `ParSecc` smallint(6) DEFAULT NULL,
  `ParManz` char(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParParc` char(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParUbic` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ParUR` char(1) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParMnz` char(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParPiso` char(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParSup` decimal(15,4) DEFAULT NULL,
  `ParUMed` char(6) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParDomi` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ParNomAnt` char(40) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParDomFis` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ParObs` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ParFecAlta` datetime(3) DEFAULT NULL,
  `ParUsr` smallint(6) DEFAULT NULL,
  `ParMANROP` char(2) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParUF2` char(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParTrasDom` smallint(6) DEFAULT NULL,
  `ParBVig` smallint(6) DEFAULT NULL,
  `ParFecBVig` datetime(3) DEFAULT NULL,
  `UsrCod` smallint(6) DEFAULT NULL,
  `msrepl_synctran_ts` binary(8) DEFAULT NULL,
  `ParUFAnt` char(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `ParPadAnt` int(11) DEFAULT NULL,
  `ParMatAnt` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `FechaBaja` datetime DEFAULT NULL,
  `fecha_carga_parcela` datetime(3) DEFAULT NULL,
  `fecha_modificacion_parcela` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_parcelas`
--

INSERT INTO `reg_parcelas` (`id_parcela`, `Dpto`, `ParMat`, `ParPad`, `ParUF`, `ParCirc`, `ParSecc`, `ParManz`, `ParParc`, `ParUbic`, `ParUR`, `ParMnz`, `ParPiso`, `ParSup`, `ParUMed`, `ParDomi`, `ParNomAnt`, `ParDomFis`, `ParObs`, `ParFecAlta`, `ParUsr`, `ParMANROP`, `ParUF2`, `ParTrasDom`, `ParBVig`, `ParFecBVig`, `UsrCod`, `msrepl_synctran_ts`, `ParUFAnt`, `ParPadAnt`, `ParMatAnt`, `id_usuario`, `FechaBaja`, `fecha_carga_parcela`, `fecha_modificacion_parcela`) VALUES
(1, 'K', 3682, 5330, '', 1, 1, '1', '220', 'ABRA PAMPA', 'U', '', NULL, '300.0000', 'M2', 'ART. 236 C. C. Y C.-', '', 'CALLE RACHAITE N 256 BARRIO BELLA VISTA ABRA PAMP', 'PLANO N 10239', '2019-11-13 11:00:00.000', 19, NULL, NULL, 0, 0, '2019-11-13 11:00:00.000', 19, 0x0000000000000000, '0', 157, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_parentezcos`
--

CREATE TABLE `reg_parentezcos` (
  `id_parentezco` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_parentezcos`
--

INSERT INTO `reg_parentezcos` (`id_parentezco`, `descripcion`) VALUES
(1, 'PADRE'),
(2, 'MADRE'),
(3, 'SUEGRO'),
(4, 'YERNO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_personas`
--

CREATE TABLE `reg_personas` (
  `id_persona` int(11) NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `nacionalidad` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_personas`
--

INSERT INTO `reg_personas` (`id_persona`, `nombre`, `nacionalidad`) VALUES
(653251, 'GUIÑAZU CLAUDIA MARIA DEL ROSARIO', NULL),
(653252, 'INSTITUTO DE VIVIENDA Y URBANISMO DE JUJUY', NULL),
(653253, 'CACERES RUBEN RAMON', NULL),
(653254, 'GIACOPPO ATILIO MIGUEL ANGEL', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_personas_documentos`
--

CREATE TABLE `reg_personas_documentos` (
  `id_persona_documento` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `numero` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_personas_documentos`
--

INSERT INTO `reg_personas_documentos` (`id_persona_documento`, `id_persona`, `id_tipo_documento`, `numero`) VALUES
(1, 653251, 1, '27232236'),
(2, 653251, 10, '27272322363'),
(4, 653252, 10, '30999204925'),
(5, 653253, 1, '11533667');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_plazos_unidades`
--

CREATE TABLE `reg_plazos_unidades` (
  `id_plazo_unidad` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_plazos_unidades`
--

INSERT INTO `reg_plazos_unidades` (`id_plazo_unidad`, `nombre`) VALUES
(0, 'NO ESPECIFICADO'),
(1, 'DIAS'),
(2, 'CUOTAS'),
(3, 'MESES'),
(4, 'AÑOS'),
(5, 'indeterminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_sectores`
--

CREATE TABLE `reg_sectores` (
  `id_sector` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_sectores`
--

INSERT INTO `reg_sectores` (`id_sector`, `nombre`) VALUES
(0, 'PREVENSION'),
(1, 'MESA ENTRADA'),
(2, 'PREVENSION'),
(3, 'FOLIO REAL DISTRIBUCION'),
(4, 'INSCRIPCION'),
(5, 'VERIFICACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_solicitantes`
--

CREATE TABLE `reg_solicitantes` (
  `id_solicitante` int(11) NOT NULL,
  `id_tipo_solicitante` int(11) DEFAULT NULL,
  `nro_registro` int(11) DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `orden` smallint(6) DEFAULT NULL,
  `escribania_gobierno` char(1) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_solicitantes`
--

INSERT INTO `reg_solicitantes` (`id_solicitante`, `id_tipo_solicitante`, `nro_registro`, `nombre`, `orden`, `escribania_gobierno`) VALUES
(1, 1, 1000, 'CONDE DE NEME Matilde A', NULL, 'N'),
(2, 1, 14, 'OTERO Olga Olivia', NULL, 'N'),
(3, 1, 17, 'DE BEDIA Ana María', NULL, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tipos_documentos`
--

CREATE TABLE `reg_tipos_documentos` (
  `id_tipo_documento` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_tipos_documentos`
--

INSERT INTO `reg_tipos_documentos` (`id_tipo_documento`, `nombre`) VALUES
(1, 'D.N.I'),
(2, 'C.I.P.Federal'),
(3, 'C.I.P.Provincial'),
(4, 'L.C.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tipos_monedas`
--

CREATE TABLE `reg_tipos_monedas` (
  `id_tipo_moneda` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_tipos_monedas`
--

INSERT INTO `reg_tipos_monedas` (`id_tipo_moneda`, `nombre`) VALUES
(1, 'Pesos Moneda Nacional'),
(2, 'Pesos Ley 18,188'),
(3, 'Pesos Argentinos'),
(4, 'AUSTRALES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tipos_partes`
--

CREATE TABLE `reg_tipos_partes` (
  `id_tipo_parte` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_tipos_partes`
--

INSERT INTO `reg_tipos_partes` (`id_tipo_parte`, `nombre`) VALUES
(1, 'PERSONA FISICA'),
(2, 'ESTADO'),
(3, 'IVUJ'),
(4, 'BANCOS'),
(5, 'A.F.I.P.'),
(6, 'PERSONA JURIDICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tipos_propietarios`
--

CREATE TABLE `reg_tipos_propietarios` (
  `id_tipo_propietario` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_tipos_propietarios`
--

INSERT INTO `reg_tipos_propietarios` (`id_tipo_propietario`, `nombre`) VALUES
(1, 'PROPIETARIO'),
(2, 'USUFUCTUARIO'),
(3, 'NUDO PROPIETARIO'),
(4, 'CONDOMINO'),
(5, 'CO-USUFRUCTUARIO'),
(6, 'CO-NUDO PROPIETARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tipos_solicitantes`
--

CREATE TABLE `reg_tipos_solicitantes` (
  `id_tipo_solicitante` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_tipos_solicitantes`
--

INSERT INTO `reg_tipos_solicitantes` (`id_tipo_solicitante`, `nombre`) VALUES
(1, 'ESCRIBANOS'),
(2, 'JUZGADOS'),
(3, 'ADMINISTRATIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tmp_beneficiarios`
--

CREATE TABLE `reg_tmp_beneficiarios` (
  `id_beneficiario` int(11) NOT NULL,
  `nombre` longtext COLLATE utf8mb4_bin,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `nro_doc` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_parentezco` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tmp_bienes_familias_personas`
--

CREATE TABLE `reg_tmp_bienes_familias_personas` (
  `id_bien_familia_persona` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_tipo_propietario` int(11) DEFAULT NULL,
  `porcentaje` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tmp_cesiones_parcelas`
--

CREATE TABLE `reg_tmp_cesiones_parcelas` (
  `id_cesion` int(11) DEFAULT NULL,
  `id_parcela` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_tmp_cesiones_parcelas`
--

INSERT INTO `reg_tmp_cesiones_parcelas` (`id_cesion`, `id_parcela`, `id_usuario`) VALUES
(23731, 13701, 4),
(23731, 91035, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tmp_cesiones_personas`
--

CREATE TABLE `reg_tmp_cesiones_personas` (
  `id_cesion` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_tipo_cesion` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_tmp_cesiones_personas`
--

INSERT INTO `reg_tmp_cesiones_personas` (`id_cesion`, `id_persona`, `id_tipo_cesion`, `orden`, `id_usuario`) VALUES
(23731, 68470, 1, 0, 4),
(23731, 72669, 2, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tmp_dominios`
--

CREATE TABLE `reg_tmp_dominios` (
  `id_dominio` int(11) NOT NULL,
  `id_parcela` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `porcentaje` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_inscripcion` datetime(3) DEFAULT NULL,
  `id_tipo_propietario` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_carga` datetime(3) DEFAULT NULL,
  `id_expediente` int(11) DEFAULT NULL,
  `id_persona_documento` int(11) DEFAULT NULL,
  `numero` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `monto` decimal(15,4) DEFAULT NULL,
  `id_tipo_moneda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_tmp_dominios`
--

INSERT INTO `reg_tmp_dominios` (`id_dominio`, `id_parcela`, `id_persona`, `porcentaje`, `fecha_inscripcion`, `id_tipo_propietario`, `id_usuario`, `fecha_carga`, `id_expediente`, `id_persona_documento`, `numero`, `id_tipo_documento`, `monto`, `id_tipo_moneda`) VALUES
(626283, 140937, 653257, '100%     ', NULL, 1, 24, NULL, 0, NULL, NULL, NULL, '0.0000', NULL),
(628604, 140937, 885210, '100%     ', NULL, 1, 55, NULL, 432260, 314450, '22188907', 1, '160000.0000', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tmp_expedientes`
--

CREATE TABLE `reg_tmp_expedientes` (
  `id_expediente` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `nro_orden` int(11) NOT NULL,
  `tipo` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `id_objeto` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `id_estado` int(11) NOT NULL,
  `fecha_estado` datetime(3) NOT NULL,
  `fecha_inicio` datetime(3) DEFAULT NULL,
  `id_sector_destino` int(11) DEFAULT NULL,
  `id_usuario_actual` int(11) NOT NULL,
  `id_usuario_destino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_tmp_expedientes`
--

INSERT INTO `reg_tmp_expedientes` (`id_expediente`, `anio`, `nro_orden`, `tipo`, `id_objeto`, `id_estado`, `fecha_estado`, `fecha_inicio`, `id_sector_destino`, `id_usuario_actual`, `id_usuario_destino`) VALUES
(434981, 2019, 13942, 'A', 'E', 1, '2019-11-13 00:00:00.000', '2019-11-13 00:00:00.000', 5, 158, 22),
(434983, 2019, 13944, 'A', 'E', 1, '2019-11-13 00:00:00.000', '2019-11-13 00:00:00.000', 5, 158, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tmp_expedientes_parcelas`
--

CREATE TABLE `reg_tmp_expedientes_parcelas` (
  `id_expediente_dominios` int(11) NOT NULL,
  `id_expediente` int(11) DEFAULT NULL,
  `nro_orden` int(11) DEFAULT NULL,
  `id_parcela` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_tmp_expedientes_parcelas`
--

INSERT INTO `reg_tmp_expedientes_parcelas` (`id_expediente_dominios`, `id_expediente`, `nro_orden`, `id_parcela`, `id_usuario`) VALUES
(748, 175924, 1110, 17749, 13),
(938, 176152, 1330, 160437, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_tmp_expedientes_partes`
--

CREATE TABLE `reg_tmp_expedientes_partes` (
  `id_expediente_parte` int(11) NOT NULL,
  `id_expediente` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `nro_parte` int(11) DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id_tipo_parte` int(11) DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `nro_documento` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_usuarios_sectores`
--

CREATE TABLE `reg_usuarios_sectores` (
  `id_usuario_sector` int(11) NOT NULL,
  `id_sector` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `habilitado` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `cantidad_maxima` int(11) DEFAULT NULL,
  `cantidad_asignada` int(11) DEFAULT NULL,
  `ultimo_asignado` varchar(1) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reg_usuarios_sectores`
--

INSERT INTO `reg_usuarios_sectores` (`id_usuario_sector`, `id_sector`, `id_usuario`, `habilitado`, `cantidad_maxima`, `cantidad_asignada`, `ultimo_asignado`) VALUES
(83, 6, 23, NULL, NULL, NULL, NULL),
(84, 7, 23, NULL, NULL, NULL, NULL),
(85, 4, 37, NULL, NULL, 5, 'N');

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
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `description`, `default`, `can_delete`, `login_destination`, `default_context`, `deleted`) VALUES
(1, 'Administrator', 'Has full control over every aspect of the site.', 0, 0, '', 'content', 0),
(2, 'Editor', 'Can handle day-to-day management, but does not have full power.', 0, 1, '', 'content', 0),
(4, 'User', 'This is the default user with access to login.', 1, 0, '', 'content', 0),
(6, 'Developer', 'Developers typically are the only ones that can access the developer tools. Otherwise identical to Administrators, at least until the site is handed off.', 0, 1, '', 'content', 0);

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
-- Estructura de tabla para la tabla `schema_version`
--

CREATE TABLE `schema_version` (
  `type` varchar(40) NOT NULL,
  `version` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `schema_version`
--

INSERT INTO `schema_version` (`type`, `version`) VALUES
('core', 44);

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
('auth.allow_name_change', 'core', '1'),
('auth.allow_register', 'core', '1'),
('auth.allow_remember', 'core', '1'),
('auth.do_login_redirect', 'core', '1'),
('auth.login_type', 'core', 'both'),
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
('site.languages', 'core', 'a:2:{i:0;s:7:\"english\";i:1;s:7:\"spanish\";}'),
('site.list_limit', 'core', '25'),
('site.offline_reason', 'core', ''),
('site.show_front_profiler', 'core', '0'),
('site.show_profiler', 'core', '0'),
('site.status', 'core', '1'),
('site.system_email', 'core', 'admin@tecnomati.co'),
('site.title', 'core', 'Direccion de Inmuebles'),
('smtp_host', 'email', ''),
('smtp_pass', 'email', ''),
('smtp_port', 'email', ''),
('smtp_timeout', 'email', ''),
('smtp_user', 'email', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sue_categorias`
--

CREATE TABLE `sue_categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` longtext COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `sue_categorias`
--

INSERT INTO `sue_categorias` (`id_categoria`, `nombre`) VALUES
(1, 'ADMINISTRATIVO'),
(2, 'INSCRIPTOR'),
(3, 'VERIFICADOR'),
(4, 'ESCRIBANO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sue_centros_costos`
--

CREATE TABLE `sue_centros_costos` (
  `id_centro_costo` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `nombre` longtext COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sue_conceptos`
--

CREATE TABLE `sue_conceptos` (
  `id_concepto` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `importe` double DEFAULT NULL,
  `porcentaje` double DEFAULT NULL,
  `formula_importe` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `formula_cantidad` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `cantidad_unidad` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `imprime_cantidad` varchar(1) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `sue_conceptos`
--

INSERT INTO `sue_conceptos` (`id_concepto`, `descripcion`, `importe`, `porcentaje`, `formula_importe`, `formula_cantidad`, `cantidad_unidad`, `imprime_cantidad`) VALUES
(2, 'N\'PRESENTISMO', 0, 0, 'SUELD*2/100', NULL, NULL, 'N'),
(200, 'JUBILACION  11', 0, 0, 'TOTHA*11/100', NULL, NULL, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sue_empleados`
--

CREATE TABLE `sue_empleados` (
  `id_empleado` int(11) NOT NULL,
  `nro_legajo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cod_fichador` int(11) DEFAULT NULL,
  `id_tipo_asistencia` longtext COLLATE utf8mb4_bin,
  `foto_empleado` longtext COLLATE utf8mb4_bin,
  `nombre` longtext COLLATE utf8mb4_bin,
  `direccion` longtext COLLATE utf8mb4_bin,
  `localidad` longtext COLLATE utf8mb4_bin,
  `provincia` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `c_postal` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `telefono` longtext COLLATE utf8mb4_bin,
  `fecha_alta` datetime(3) DEFAULT NULL,
  `fecha_baja` datetime(3) DEFAULT NULL,
  `cuil` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_estado_civil` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `nacionalidad` longtext COLLATE utf8mb4_bin,
  `fecha_nacimiento` datetime(3) DEFAULT NULL,
  `id_tipo_documento` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `nro_documento` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `condicion_contratacion` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `situacion` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `sueldo` double DEFAULT NULL,
  `mail` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_centro_costo` varchar(6) CHARACTER SET utf8 DEFAULT NULL,
  `id_categoria` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `tarea` longtext COLLATE utf8mb4_bin,
  `id_deposito` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `documentacion` longtext COLLATE utf8mb4_bin,
  `convenio` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `adicional` double DEFAULT NULL,
  `papeles` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `nro_pieza` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `activo` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `turno` int(11) DEFAULT NULL,
  `unidad_convenio` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `horas_trabajar` varchar(5) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `sue_empleados`
--

INSERT INTO `sue_empleados` (`id_empleado`, `nro_legajo`, `cod_fichador`, `id_tipo_asistencia`, `foto_empleado`, `nombre`, `direccion`, `localidad`, `provincia`, `c_postal`, `telefono`, `fecha_alta`, `fecha_baja`, `cuil`, `id_estado_civil`, `nacionalidad`, `fecha_nacimiento`, `id_tipo_documento`, `nro_documento`, `condicion_contratacion`, `situacion`, `sueldo`, `mail`, `id_centro_costo`, `id_categoria`, `tarea`, `id_deposito`, `documentacion`, `convenio`, `adicional`, `papeles`, `nro_pieza`, `activo`, `turno`, `unidad_convenio`, `horas_trabajar`) VALUES
(1, '100', 747, 'TM1', NULL, 'SOSA MARIO', '21007747', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21007747', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sue_estados_civiles`
--

CREATE TABLE `sue_estados_civiles` (
  `id_estado_civil` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `nombre` longtext COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `sue_estados_civiles`
--

INSERT INTO `sue_estados_civiles` (`id_estado_civil`, `nombre`) VALUES
('C', 'CASADO'),
('S', 'SOLTERO'),
('SE', 'SEPARADO'),
('V', 'VIUDO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sue_tipos_documentos`
--

CREATE TABLE `sue_tipos_documentos` (
  `id_tipo_documento` varchar(2) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `sue_tipos_documentos`
--

INSERT INTO `sue_tipos_documentos` (`id_tipo_documento`, `nombre`) VALUES
('CI', 'CEDULA DE IDENTIDAD'),
('DO', 'DOCUMENTO UNICO'),
('LC', 'LIBRETA CIVICA'),
('LE', 'LIBRETA DE ENROLAMIENTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab`
--

CREATE TABLE `tab` (
  `dpto` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `padron` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `circ` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `secc` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `mza` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `parc` varchar(30) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `tab`
--

INSERT INTO `tab` (`dpto`, `padron`, `circ`, `secc`, `mza`, `parc`) VALUES
('A', '93667', '05', '01', '000259', '000001'),
('A', '1', '01', '01', '000060', '00001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcausantes`
--

CREATE TABLE `tcausantes` (
  `Libro` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `Folio` smallint(6) DEFAULT NULL,
  `Año` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `Causante` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `TipoDocCausante` tinyint(3) UNSIGNED DEFAULT NULL,
  `NumDocCausante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `tcausantes`
--

INSERT INTO `tcausantes` (`Libro`, `Folio`, `Año`, `Causante`, `TipoDocCausante`, `NumDocCausante`) VALUES
('R', 1, '77', 'PEREYRA PAULINA', 0, 0),
('Q', 2, '77', 'QUISPE ALEJANDRO', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcesionario`
--

CREATE TABLE `tcesionario` (
  `Libro` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `Folio` smallint(6) DEFAULT NULL,
  `Año` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `Cesionario` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `TipoDocCesionario` tinyint(3) UNSIGNED DEFAULT NULL,
  `NumDocCesionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `tcesionario`
--

INSERT INTO `tcesionario` (`Libro`, `Folio`, `Año`, `Cesionario`, `TipoDocCesionario`, `NumDocCesionario`) VALUES
('A', 1, '92', 'JUAN I', 1, 12345),
('A', 1, '92', 'JUAN II', 2, 1234567);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcesionderechos`
--

CREATE TABLE `tcesionderechos` (
  `Libro` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `Folio` smallint(6) DEFAULT NULL,
  `Año` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `FechaInscripcion` datetime DEFAULT NULL,
  `TipoInscripcion` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `tcesionderechos`
--

INSERT INTO `tcesionderechos` (`Libro`, `Folio`, `Año`, `FechaInscripcion`, `TipoInscripcion`) VALUES
('C', 88, '94', '2019-11-14 00:00:00', 1),
('C', 89, '89', '2019-11-14 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_inh2_inhibici`
--

CREATE TABLE `tmp_inh2_inhibici` (
  `N_T_N` varchar(542) COLLATE utf8mb4_bin DEFAULT NULL,
  `NomJuz` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `MinInhReg` int(11) DEFAULT NULL,
  `InhLibro` varchar(2) COLLATE utf8mb4_bin DEFAULT NULL,
  `InhFolio` varchar(4) COLLATE utf8mb4_bin DEFAULT NULL,
  `InhAsiento` varchar(4) COLLATE utf8mb4_bin DEFAULT NULL,
  `InhAutos` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `InhExJuz` varchar(12) COLLATE utf8mb4_bin DEFAULT NULL,
  `NatCod` smallint(6) DEFAULT NULL,
  `InhMonto` decimal(15,4) DEFAULT NULL,
  `InhExpte` varchar(12) COLLATE utf8mb4_bin DEFAULT NULL,
  `InhFPres` datetime(3) DEFAULT NULL,
  `InhFVenc` datetime(3) DEFAULT NULL,
  `MaxInhUsr` smallint(6) DEFAULT NULL,
  `MaxInhEstado` smallint(6) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `Nombre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `numero` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `id_persona_documento` int(11) DEFAULT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `id_naturaleza` int(11) DEFAULT NULL,
  `Vig` int(11) DEFAULT NULL,
  `id_expediente` bigint(20) DEFAULT NULL,
  `Clave` varchar(79) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `tmp_inh2_inhibici`
--

INSERT INTO `tmp_inh2_inhibici` (`N_T_N`, `NomJuz`, `MinInhReg`, `InhLibro`, `InhFolio`, `InhAsiento`, `InhAutos`, `InhExJuz`, `NatCod`, `InhMonto`, `InhExpte`, `InhFPres`, `InhFVenc`, `MaxInhUsr`, `MaxInhEstado`, `id_persona`, `id_tipo_documento`, `Nombre`, `numero`, `id_persona_documento`, `id_solicitante`, `id_naturaleza`, `Vig`, `id_expediente`, `Clave`) VALUES
('RODRIGUEZ OSCAR ARMANDO*1*16307774', 'ADM.FED.ING.PUB.AG.F.ZURUETA', 9437, '3', '208', '932', 'AFIP C/RODRIGUEZ OSCAR ARMANDO', '242/1/03', 0, '0.0000', '5413', '2019-11-14 00:00:00.000', '2019-11-14 00:00:00.000', 49, 0, 784449, NULL, 'RODRIGUEZ OSCAR ARMANDO', '16307774', 149964, 8148, 1, 0, 784449, 'AFIP C/RODRIGUEZ OSCAR ARMANDO*242/1/03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_inh2_inh_levan_3`
--

CREATE TABLE `tmp_inh2_inh_levan_3` (
  `L_F_A` varchar(12) COLLATE utf8mb4_bin DEFAULT NULL,
  `NomJuz` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `MinLevReg` int(11) DEFAULT NULL,
  `LevLibro` varchar(2) COLLATE utf8mb4_bin DEFAULT NULL,
  `LevFolio` varchar(4) COLLATE utf8mb4_bin DEFAULT NULL,
  `LevAsiento` varchar(4) COLLATE utf8mb4_bin DEFAULT NULL,
  `LevObs` varchar(60) COLLATE utf8mb4_bin DEFAULT NULL,
  `LevExJuz` varchar(12) COLLATE utf8mb4_bin DEFAULT NULL,
  `NatLevCod` smallint(6) DEFAULT NULL,
  `LevExpte` varchar(12) COLLATE utf8mb4_bin DEFAULT NULL,
  `LevFPres` datetime(3) DEFAULT NULL,
  `MaxLevUsr` smallint(6) DEFAULT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `id_naturaleza` int(11) DEFAULT NULL,
  `Vig` int(11) DEFAULT NULL,
  `id_expediente` bigint(20) DEFAULT NULL,
  `Expr1` varchar(152) CHARACTER SET utf8 DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `id_inhibicion` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `fechaMovINH` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_inh2_juzant_nuevas`
--

CREATE TABLE `tmp_inh2_juzant_nuevas` (
  `id_tipo_solicitante` int(11) DEFAULT NULL,
  `nro_registro` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `orden` smallint(6) DEFAULT NULL,
  `escribania_gobierno` char(1) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_inh2_persact`
--

CREATE TABLE `tmp_inh2_persact` (
  `N_T_N` varchar(542) COLLATE utf8mb4_bin DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `Nombre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `id_persona_documento` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `tmp_inh2_persact`
--

INSERT INTO `tmp_inh2_persact` (`N_T_N`, `id_persona`, `Nombre`, `id_tipo_documento`, `numero`, `id_persona_documento`, `cantidad`) VALUES
('LUNA ANTONIO*6*8302016', 673543, 'LUNA ANTONIO', 6, '8302016', 24928, 1),
('GALIAN MONICA GRACIELA*1*24437354', 666043, 'GALIAN MONICA GRACIELA', 1, '24437354', 15936, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_inh2_persant`
--

CREATE TABLE `tmp_inh2_persant` (
  `N_T_N` varchar(542) COLLATE utf8mb4_bin DEFAULT NULL,
  `Nombre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `numero` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `tmp_inh2_persant`
--

INSERT INTO `tmp_inh2_persant` (`N_T_N`, `Nombre`, `id_tipo_documento`, `numero`) VALUES
('AGOSTINI MARIO ENZO*1*11113503', 'AGOSTINI MARIO ENZO', 1, '11113503'),
('AGUILAR CONSTANTINO*6*92001808', 'AGUILAR CONSTANTINO', 6, '92001808');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_inh2_persant_nuevas`
--

CREATE TABLE `tmp_inh2_persant_nuevas` (
  `Nombre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `numero` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `T_Numero` varchar(286) COLLATE utf8mb4_bin DEFAULT NULL,
  `N_T_N` varchar(542) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpadron_matricula`
--

CREATE TABLE `tpadron_matricula` (
  `Libro` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `Folio` smallint(6) DEFAULT NULL,
  `Año` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `Dpto` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `CatastroPadron` varchar(10) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `tpadron_matricula`
--

INSERT INTO `tpadron_matricula` (`Libro`, `Folio`, `Año`, `Dpto`, `CatastroPadron`) VALUES
('A', 1, '92', 'A', '12345'),
('R', 1, '77', 'N', '433');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttipoinscripcion`
--

CREATE TABLE `ttipoinscripcion` (
  `TipoInscripcion` tinyint(3) UNSIGNED DEFAULT NULL,
  `Descripcion` varchar(25) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `ttipoinscripcion`
--

INSERT INTO `ttipoinscripcion` (`TipoInscripcion`, `Descripcion`) VALUES
(1, 'INSCRIPCION DEFINITIVA'),
(2, 'INSCRIPCION PROVISORIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttipoprop`
--

CREATE TABLE `ttipoprop` (
  `PropTip` int(11) DEFAULT NULL,
  `Descripcion` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `ttipoprop`
--

INSERT INTO `ttipoprop` (`PropTip`, `Descripcion`) VALUES
(1, 'PROPIETARIO'),
(2, 'USUFUCTUARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttiposdocumentos`
--

CREATE TABLE `ttiposdocumentos` (
  `TipoDocumento` tinyint(3) UNSIGNED DEFAULT NULL,
  `Descripcion` varchar(20) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `ttiposdocumentos`
--

INSERT INTO `ttiposdocumentos` (`TipoDocumento`, `Descripcion`) VALUES
(1, 'D.N.I'),
(2, 'L.E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '4',
  `email` varchar(254) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password_hash` char(60) DEFAULT NULL,
  `reset_hash` varchar(40) DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(45) NOT NULL DEFAULT '',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `reset_by` int(10) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_message` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT '',
  `display_name_changed` date DEFAULT NULL,
  `timezone` varchar(40) NOT NULL DEFAULT 'UM3',
  `language` varchar(20) NOT NULL DEFAULT 'spanish',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activate_hash` varchar(40) NOT NULL DEFAULT '',
  `force_password_reset` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role_id`, `email`, `username`, `password_hash`, `reset_hash`, `last_login`, `last_ip`, `created_on`, `deleted`, `reset_by`, `banned`, `ban_message`, `display_name`, `display_name_changed`, `timezone`, `language`, `active`, `activate_hash`, `force_password_reset`) VALUES
(1, 1, 'admin@tecnomati.co', 'admin', '$2a$08$yhwAREeIyIXpnB9SSDlkEOQjqbcPHqFxvN5kCnDGvJfRUHpUNnyfe', NULL, '2019-11-08 14:58:21', '::1', '2019-10-16 01:39:35', 0, NULL, 0, NULL, 'admin', NULL, 'UM3', 'spanish', 1, '', 0),
(2, 4, 'marcko_23@hotmail.com', 'marcko', 'marcko_23', 'marcko_23', '2019-11-20 00:00:00', '192.168.1.1', '2019-11-06 00:00:00', 0, 0, 0, 'marcko_23', 'marcko_23', '0000-00-00', 'UM3', 'spanish', 0, 'marcko_23', 0);

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
  `meta_id` int(20) UNSIGNED NOT NULL,
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vta_provincias`
--

CREATE TABLE `vta_provincias` (
  `id_provincia` int(11) NOT NULL,
  `nombre` longtext COLLATE utf8mb4_bin,
  `nombre_provincia` longtext COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `vta_provincias`
--

INSERT INTO `vta_provincias` (`id_provincia`, `nombre`, `nombre_provincia`) VALUES
(1, 'JUJUY', 'JUJUY'),
(2, 'SALTA', 'SALTA'),
(3, 'CHACO', 'CHACO'),
(4, 'TUCUMAN', 'TUCUMAN');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indices de la tabla `alu_nacionalidad`
--
ALTER TABLE `alu_nacionalidad`
  ADD PRIMARY KEY (`id_nacionalidad`);

--
-- Indices de la tabla `cfg_auditoria`
--
ALTER TABLE `cfg_auditoria`
  ADD PRIMARY KEY (`id_auditoria`);

--
-- Indices de la tabla `cfg_grupos`
--
ALTER TABLE `cfg_grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `cfg_modulos`
--
ALTER TABLE `cfg_modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `cfg_permisos`
--
ALTER TABLE `cfg_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cfg_secciones`
--
ALTER TABLE `cfg_secciones`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `cfg_usuarios`
--
ALTER TABLE `cfg_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ci3_sessions`
--
ALTER TABLE `ci3_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dir_destino`
--
ALTER TABLE `dir_destino`
  ADD PRIMARY KEY (`id_dir_destino`);

--
-- Indices de la tabla `dir_origen`
--
ALTER TABLE `dir_origen`
  ADD PRIMARY KEY (`id_dir_origen`);

--
-- Indices de la tabla `email_queue`
--
ALTER TABLE `email_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fich_anormalidades`
--
ALTER TABLE `fich_anormalidades`
  ADD PRIMARY KEY (`id_anormalidad`);

--
-- Indices de la tabla `fich_ausencias`
--
ALTER TABLE `fich_ausencias`
  ADD PRIMARY KEY (`id_ausencia`);

--
-- Indices de la tabla `fich_carpeta`
--
ALTER TABLE `fich_carpeta`
  ADD PRIMARY KEY (`id_carpeta`);

--
-- Indices de la tabla `fich_dptos_usuarios`
--
ALTER TABLE `fich_dptos_usuarios`
  ADD PRIMARY KEY (`id_dpto_usuario`);

--
-- Indices de la tabla `fich_feriados`
--
ALTER TABLE `fich_feriados`
  ADD PRIMARY KEY (`id_feriado`);

--
-- Indices de la tabla `fich_fichadas`
--
ALTER TABLE `fich_fichadas`
  ADD PRIMARY KEY (`id_fichada`);

--
-- Indices de la tabla `fich_registros_rotativos`
--
ALTER TABLE `fich_registros_rotativos`
  ADD PRIMARY KEY (`id_registro_rotativo`);

--
-- Indices de la tabla `fich_revisiones_fichadas`
--
ALTER TABLE `fich_revisiones_fichadas`
  ADD PRIMARY KEY (`id_revision_fichada`);

--
-- Indices de la tabla `fich_tipos_rotativos`
--
ALTER TABLE `fich_tipos_rotativos`
  ADD PRIMARY KEY (`id_tipo_rotativo`);

--
-- Indices de la tabla `fol_macros`
--
ALTER TABLE `fol_macros`
  ADD PRIMARY KEY (`id_macro`);

--
-- Indices de la tabla `fol_matriculas`
--
ALTER TABLE `fol_matriculas`
  ADD PRIMARY KEY (`id_matricula`);

--
-- Indices de la tabla `fol_matriculas_asientos`
--
ALTER TABLE `fol_matriculas_asientos`
  ADD PRIMARY KEY (`id_matricula_asiento`);

--
-- Indices de la tabla `fol_matriculas_asientos_porc`
--
ALTER TABLE `fol_matriculas_asientos_porc`
  ADD PRIMARY KEY (`id_tabla`);

--
-- Indices de la tabla `fol_matriculas_desbloqueadas`
--
ALTER TABLE `fol_matriculas_desbloqueadas`
  ADD PRIMARY KEY (`id_matricula_desbloqueada`);

--
-- Indices de la tabla `fol_tipos_asiento`
--
ALTER TABLE `fol_tipos_asiento`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `fol_tmp_matriculas_impresion`
--
ALTER TABLE `fol_tmp_matriculas_impresion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fol_usuarios_tipos`
--
ALTER TABLE `fol_usuarios_tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indices de la tabla `reg_actas_beneficiarios`
--
ALTER TABLE `reg_actas_beneficiarios`
  ADD PRIMARY KEY (`id_acta_beneficiario`);

--
-- Indices de la tabla `reg_actas_bienes_familias`
--
ALTER TABLE `reg_actas_bienes_familias`
  ADD PRIMARY KEY (`id_acta_bien_familia`);

--
-- Indices de la tabla `reg_beneficiarios`
--
ALTER TABLE `reg_beneficiarios`
  ADD PRIMARY KEY (`id_beneficiario`);

--
-- Indices de la tabla `reg_bienes_familias`
--
ALTER TABLE `reg_bienes_familias`
  ADD PRIMARY KEY (`id_bien_familia`);

--
-- Indices de la tabla `reg_bienes_familias_personas`
--
ALTER TABLE `reg_bienes_familias_personas`
  ADD PRIMARY KEY (`id_bien_familia_persona`);

--
-- Indices de la tabla `reg_casos_estudios`
--
ALTER TABLE `reg_casos_estudios`
  ADD PRIMARY KEY (`id_caso_estudio`);

--
-- Indices de la tabla `reg_cesiones`
--
ALTER TABLE `reg_cesiones`
  ADD PRIMARY KEY (`id_cesion`);

--
-- Indices de la tabla `reg_cesiones_parcelas`
--
ALTER TABLE `reg_cesiones_parcelas`
  ADD PRIMARY KEY (`id_cesion_parcela`);

--
-- Indices de la tabla `reg_cesiones_personas`
--
ALTER TABLE `reg_cesiones_personas`
  ADD PRIMARY KEY (`id_cesion_persona`);

--
-- Indices de la tabla `reg_cesiones_tipo_cesion`
--
ALTER TABLE `reg_cesiones_tipo_cesion`
  ADD PRIMARY KEY (`id_tipo_cesion`);

--
-- Indices de la tabla `reg_cesiones_tipo_inscripcion`
--
ALTER TABLE `reg_cesiones_tipo_inscripcion`
  ADD PRIMARY KEY (`id_tipo_inscripcion`);

--
-- Indices de la tabla `reg_departamentos`
--
ALTER TABLE `reg_departamentos`
  ADD PRIMARY KEY (`Dpto`);

--
-- Indices de la tabla `reg_dominios`
--
ALTER TABLE `reg_dominios`
  ADD PRIMARY KEY (`id_dominio`);

--
-- Indices de la tabla `reg_dominios_viejo`
--
ALTER TABLE `reg_dominios_viejo`
  ADD PRIMARY KEY (`DomReg`);

--
-- Indices de la tabla `reg_estados`
--
ALTER TABLE `reg_estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `reg_expedientes`
--
ALTER TABLE `reg_expedientes`
  ADD PRIMARY KEY (`id_expediente`);

--
-- Indices de la tabla `reg_expedientes_estados`
--
ALTER TABLE `reg_expedientes_estados`
  ADD PRIMARY KEY (`id_expediente_estado`);

--
-- Indices de la tabla `reg_expedientes_parcelas`
--
ALTER TABLE `reg_expedientes_parcelas`
  ADD PRIMARY KEY (`id_expediente_parcela`);

--
-- Indices de la tabla `reg_hipotecas`
--
ALTER TABLE `reg_hipotecas`
  ADD PRIMARY KEY (`id_hipoteca`);

--
-- Indices de la tabla `reg_hipotecas_estados`
--
ALTER TABLE `reg_hipotecas_estados`
  ADD PRIMARY KEY (`id_hipoteca_estado`);

--
-- Indices de la tabla `reg_hipotecas_grados`
--
ALTER TABLE `reg_hipotecas_grados`
  ADD PRIMARY KEY (`id_hipoteca_grado`);

--
-- Indices de la tabla `reg_hipotecas_grupos`
--
ALTER TABLE `reg_hipotecas_grupos`
  ADD PRIMARY KEY (`id_hipoteca_grupo`);

--
-- Indices de la tabla `reg_hipotecas_parcelas`
--
ALTER TABLE `reg_hipotecas_parcelas`
  ADD PRIMARY KEY (`id_hipoteca_parcela`);

--
-- Indices de la tabla `reg_hipotecas_sistant`
--
ALTER TABLE `reg_hipotecas_sistant`
  ADD PRIMARY KEY (`hiporeg`);

--
-- Indices de la tabla `reg_hipotecas_tipos`
--
ALTER TABLE `reg_hipotecas_tipos`
  ADD PRIMARY KEY (`id_hipoteca_tipo`);

--
-- Indices de la tabla `reg_imagenes`
--
ALTER TABLE `reg_imagenes`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `reg_imagenes_consultas`
--
ALTER TABLE `reg_imagenes_consultas`
  ADD PRIMARY KEY (`id_imagen_consulta`);

--
-- Indices de la tabla `reg_inhibiciones_naturalezas`
--
ALTER TABLE `reg_inhibiciones_naturalezas`
  ADD PRIMARY KEY (`id_naturaleza`);

--
-- Indices de la tabla `reg_objetos`
--
ALTER TABLE `reg_objetos`
  ADD PRIMARY KEY (`id_objeto`);

--
-- Indices de la tabla `reg_parcelas`
--
ALTER TABLE `reg_parcelas`
  ADD PRIMARY KEY (`id_parcela`);

--
-- Indices de la tabla `reg_parentezcos`
--
ALTER TABLE `reg_parentezcos`
  ADD PRIMARY KEY (`id_parentezco`);

--
-- Indices de la tabla `reg_personas`
--
ALTER TABLE `reg_personas`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `reg_personas_documentos`
--
ALTER TABLE `reg_personas_documentos`
  ADD PRIMARY KEY (`id_persona_documento`),
  ADD UNIQUE KEY `IX_reg_personas_documentos` (`id_persona`,`id_tipo_documento`);

--
-- Indices de la tabla `reg_plazos_unidades`
--
ALTER TABLE `reg_plazos_unidades`
  ADD PRIMARY KEY (`id_plazo_unidad`);

--
-- Indices de la tabla `reg_sectores`
--
ALTER TABLE `reg_sectores`
  ADD PRIMARY KEY (`id_sector`);

--
-- Indices de la tabla `reg_solicitantes`
--
ALTER TABLE `reg_solicitantes`
  ADD PRIMARY KEY (`id_solicitante`),
  ADD UNIQUE KEY `IX_reg_solicitantes` (`id_tipo_solicitante`,`id_solicitante`);

--
-- Indices de la tabla `reg_tipos_documentos`
--
ALTER TABLE `reg_tipos_documentos`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indices de la tabla `reg_tipos_monedas`
--
ALTER TABLE `reg_tipos_monedas`
  ADD PRIMARY KEY (`id_tipo_moneda`);

--
-- Indices de la tabla `reg_tipos_partes`
--
ALTER TABLE `reg_tipos_partes`
  ADD PRIMARY KEY (`id_tipo_parte`);

--
-- Indices de la tabla `reg_tipos_propietarios`
--
ALTER TABLE `reg_tipos_propietarios`
  ADD PRIMARY KEY (`id_tipo_propietario`);

--
-- Indices de la tabla `reg_tipos_solicitantes`
--
ALTER TABLE `reg_tipos_solicitantes`
  ADD PRIMARY KEY (`id_tipo_solicitante`);

--
-- Indices de la tabla `reg_tmp_beneficiarios`
--
ALTER TABLE `reg_tmp_beneficiarios`
  ADD PRIMARY KEY (`id_beneficiario`);

--
-- Indices de la tabla `reg_tmp_bienes_familias_personas`
--
ALTER TABLE `reg_tmp_bienes_familias_personas`
  ADD PRIMARY KEY (`id_bien_familia_persona`);

--
-- Indices de la tabla `reg_tmp_dominios`
--
ALTER TABLE `reg_tmp_dominios`
  ADD PRIMARY KEY (`id_dominio`);

--
-- Indices de la tabla `reg_tmp_expedientes_parcelas`
--
ALTER TABLE `reg_tmp_expedientes_parcelas`
  ADD PRIMARY KEY (`id_expediente_dominios`);

--
-- Indices de la tabla `reg_tmp_expedientes_partes`
--
ALTER TABLE `reg_tmp_expedientes_partes`
  ADD PRIMARY KEY (`id_expediente_parte`);

--
-- Indices de la tabla `reg_usuarios_sectores`
--
ALTER TABLE `reg_usuarios_sectores`
  ADD PRIMARY KEY (`id_usuario_sector`),
  ADD UNIQUE KEY `IX_reg_usuarios_sectores` (`id_sector`,`id_usuario`);

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
-- Indices de la tabla `schema_version`
--
ALTER TABLE `schema_version`
  ADD PRIMARY KEY (`type`);

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
-- Indices de la tabla `sue_categorias`
--
ALTER TABLE `sue_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `sue_empleados`
--
ALTER TABLE `sue_empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `sue_tipos_documentos`
--
ALTER TABLE `sue_tipos_documentos`
  ADD PRIMARY KEY (`id_tipo_documento`);

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
-- Indices de la tabla `vta_provincias`
--
ALTER TABLE `vta_provincias`
  ADD PRIMARY KEY (`id_provincia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `alu_nacionalidad`
--
ALTER TABLE `alu_nacionalidad`
  MODIFY `id_nacionalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cfg_auditoria`
--
ALTER TABLE `cfg_auditoria`
  MODIFY `id_auditoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cfg_grupos`
--
ALTER TABLE `cfg_grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cfg_modulos`
--
ALTER TABLE `cfg_modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cfg_permisos`
--
ALTER TABLE `cfg_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `cfg_secciones`
--
ALTER TABLE `cfg_secciones`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cfg_usuarios`
--
ALTER TABLE `cfg_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `dir_destino`
--
ALTER TABLE `dir_destino`
  MODIFY `id_dir_destino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131070;

--
-- AUTO_INCREMENT de la tabla `dir_origen`
--
ALTER TABLE `dir_origen`
  MODIFY `id_dir_origen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65520;

--
-- AUTO_INCREMENT de la tabla `email_queue`
--
ALTER TABLE `email_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fich_anormalidades`
--
ALTER TABLE `fich_anormalidades`
  MODIFY `id_anormalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `fich_ausencias`
--
ALTER TABLE `fich_ausencias`
  MODIFY `id_ausencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `fich_carpeta`
--
ALTER TABLE `fich_carpeta`
  MODIFY `id_carpeta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `fich_dptos_usuarios`
--
ALTER TABLE `fich_dptos_usuarios`
  MODIFY `id_dpto_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `fich_feriados`
--
ALTER TABLE `fich_feriados`
  MODIFY `id_feriado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `fich_fichadas`
--
ALTER TABLE `fich_fichadas`
  MODIFY `id_fichada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `fich_registros_rotativos`
--
ALTER TABLE `fich_registros_rotativos`
  MODIFY `id_registro_rotativo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fich_revisiones_fichadas`
--
ALTER TABLE `fich_revisiones_fichadas`
  MODIFY `id_revision_fichada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;

--
-- AUTO_INCREMENT de la tabla `fol_macros`
--
ALTER TABLE `fol_macros`
  MODIFY `id_macro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `fol_matriculas`
--
ALTER TABLE `fol_matriculas`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71364;

--
-- AUTO_INCREMENT de la tabla `fol_matriculas_asientos`
--
ALTER TABLE `fol_matriculas_asientos`
  MODIFY `id_matricula_asiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fol_matriculas_asientos_porc`
--
ALTER TABLE `fol_matriculas_asientos_porc`
  MODIFY `id_tabla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `fol_matriculas_desbloqueadas`
--
ALTER TABLE `fol_matriculas_desbloqueadas`
  MODIFY `id_matricula_desbloqueada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `fol_tmp_matriculas_impresion`
--
ALTER TABLE `fol_tmp_matriculas_impresion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146240;

--
-- AUTO_INCREMENT de la tabla `fol_usuarios_tipos`
--
ALTER TABLE `fol_usuarios_tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `reg_actas_beneficiarios`
--
ALTER TABLE `reg_actas_beneficiarios`
  MODIFY `id_acta_beneficiario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reg_actas_bienes_familias`
--
ALTER TABLE `reg_actas_bienes_familias`
  MODIFY `id_acta_bien_familia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reg_beneficiarios`
--
ALTER TABLE `reg_beneficiarios`
  MODIFY `id_beneficiario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reg_bienes_familias`
--
ALTER TABLE `reg_bienes_familias`
  MODIFY `id_bien_familia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123546;

--
-- AUTO_INCREMENT de la tabla `reg_bienes_familias_personas`
--
ALTER TABLE `reg_bienes_familias_personas`
  MODIFY `id_bien_familia_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199189;

--
-- AUTO_INCREMENT de la tabla `reg_casos_estudios`
--
ALTER TABLE `reg_casos_estudios`
  MODIFY `id_caso_estudio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `reg_cesiones`
--
ALTER TABLE `reg_cesiones`
  MODIFY `id_cesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21585;

--
-- AUTO_INCREMENT de la tabla `reg_cesiones_parcelas`
--
ALTER TABLE `reg_cesiones_parcelas`
  MODIFY `id_cesion_parcela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25652;

--
-- AUTO_INCREMENT de la tabla `reg_cesiones_personas`
--
ALTER TABLE `reg_cesiones_personas`
  MODIFY `id_cesion_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159659;

--
-- AUTO_INCREMENT de la tabla `reg_cesiones_tipo_cesion`
--
ALTER TABLE `reg_cesiones_tipo_cesion`
  MODIFY `id_tipo_cesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reg_cesiones_tipo_inscripcion`
--
ALTER TABLE `reg_cesiones_tipo_inscripcion`
  MODIFY `id_tipo_inscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reg_dominios`
--
ALTER TABLE `reg_dominios`
  MODIFY `id_dominio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=916916;

--
-- AUTO_INCREMENT de la tabla `reg_expedientes`
--
ALTER TABLE `reg_expedientes`
  MODIFY `id_expediente` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309674;

--
-- AUTO_INCREMENT de la tabla `reg_expedientes_estados`
--
ALTER TABLE `reg_expedientes_estados`
  MODIFY `id_expediente_estado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reg_expedientes_parcelas`
--
ALTER TABLE `reg_expedientes_parcelas`
  MODIFY `id_expediente_parcela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `reg_hipotecas`
--
ALTER TABLE `reg_hipotecas`
  MODIFY `id_hipoteca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335531;

--
-- AUTO_INCREMENT de la tabla `reg_hipotecas_parcelas`
--
ALTER TABLE `reg_hipotecas_parcelas`
  MODIFY `id_hipoteca_parcela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234432;

--
-- AUTO_INCREMENT de la tabla `reg_hipotecas_tipos`
--
ALTER TABLE `reg_hipotecas_tipos`
  MODIFY `id_hipoteca_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reg_imagenes`
--
ALTER TABLE `reg_imagenes`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reg_imagenes_consultas`
--
ALTER TABLE `reg_imagenes_consultas`
  MODIFY `id_imagen_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reg_inhibiciones_naturalezas`
--
ALTER TABLE `reg_inhibiciones_naturalezas`
  MODIFY `id_naturaleza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reg_parcelas`
--
ALTER TABLE `reg_parcelas`
  MODIFY `id_parcela` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reg_parentezcos`
--
ALTER TABLE `reg_parentezcos`
  MODIFY `id_parentezco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reg_personas`
--
ALTER TABLE `reg_personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=653255;

--
-- AUTO_INCREMENT de la tabla `reg_personas_documentos`
--
ALTER TABLE `reg_personas_documentos`
  MODIFY `id_persona_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reg_solicitantes`
--
ALTER TABLE `reg_solicitantes`
  MODIFY `id_solicitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reg_tmp_beneficiarios`
--
ALTER TABLE `reg_tmp_beneficiarios`
  MODIFY `id_beneficiario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reg_tmp_bienes_familias_personas`
--
ALTER TABLE `reg_tmp_bienes_familias_personas`
  MODIFY `id_bien_familia_persona` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reg_tmp_dominios`
--
ALTER TABLE `reg_tmp_dominios`
  MODIFY `id_dominio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=628605;

--
-- AUTO_INCREMENT de la tabla `reg_tmp_expedientes_parcelas`
--
ALTER TABLE `reg_tmp_expedientes_parcelas`
  MODIFY `id_expediente_dominios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=939;

--
-- AUTO_INCREMENT de la tabla `reg_tmp_expedientes_partes`
--
ALTER TABLE `reg_tmp_expedientes_partes`
  MODIFY `id_expediente_parte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reg_usuarios_sectores`
--
ALTER TABLE `reg_usuarios_sectores`
  MODIFY `id_usuario_sector` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sue_categorias`
--
ALTER TABLE `sue_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sue_empleados`
--
ALTER TABLE `sue_empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `meta_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vta_provincias`
--
ALTER TABLE `vta_provincias`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
