-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 29, 2020 at 10:50 AM
-- Server version: 10.3.25-MariaDB-0+deb10u1
-- PHP Version: 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dolibarr`
--

-- --------------------------------------------------------

--
-- Table structure for table `llx_societe_rib`
--

CREATE TABLE `societe_rib` (
  `id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL DEFAULT 'ban',
  `label` varchar(200) DEFAULT NULL,
  `fk_soc` int(10) NOT NULL,
  `datec` datetime DEFAULT NULL,
  `tms` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bank` varchar(255) DEFAULT NULL,
  `code_banque` varchar(128) DEFAULT NULL,
  `code_guichet` varchar(6) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `cle_rib` varchar(5) DEFAULT NULL,
  `bic` varchar(20) DEFAULT NULL,
  `iban_prefix` varchar(34) DEFAULT NULL,
  `domiciliation` varchar(255) DEFAULT NULL,
  `proprio` varchar(60) DEFAULT NULL,
  `owner_address` varchar(255) DEFAULT NULL,
  `default_rib` smallint(6) NOT NULL DEFAULT 0,
  `rum` varchar(32) DEFAULT NULL,
  `date_rum` date DEFAULT NULL,
  `frstrecur` varchar(16) DEFAULT 'FRST',
  `last_four` varchar(4) DEFAULT NULL,
  `card_type` varchar(255) DEFAULT NULL,
  `cvn` varchar(255) DEFAULT NULL,
  `exp_date_month` int(11) DEFAULT NULL,
  `exp_date_year` int(11) DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `approved` int(11) DEFAULT 0,
  `email` varchar(255) DEFAULT NULL,
  `ending_date` date DEFAULT NULL,
  `max_total_amount_of_all_payments` double(24,8) DEFAULT NULL,
  `preapproval_key` varchar(255) DEFAULT NULL,
  `starting_date` date DEFAULT NULL,
  `total_amount_of_all_payments` double(24,8) DEFAULT NULL,
  `stripe_card_ref` varchar(128) DEFAULT NULL,
  `stripe_account` varchar(128) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `ipaddress` varchar(68) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `import_key` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `llx_societe_rib`
--

INSERT INTO `societe_rib` (`id`, `type`, `label`, `fk_soc`, `datec`, `tms`, `bank`, `code_banque`, `code_guichet`, `number`, `cle_rib`, `bic`, `iban_prefix`, `domiciliation`, `proprio`, `owner_address`, `default_rib`, `rum`, `date_rum`, `frstrecur`, `last_four`, `card_type`, `cvn`, `exp_date_month`, `exp_date_year`, `country_code`, `approved`, `email`, `ending_date`, `max_total_amount_of_all_payments`, `preapproval_key`, `starting_date`, `total_amount_of_all_payments`, `stripe_card_ref`, `stripe_account`, `comment`, `ipaddress`, `status`, `import_key`) VALUES
(1, 'ban', 'Nacion', 2, '2020-08-03 04:11:42', '2020-08-03 07:11:42', 'Credicopp', '', '', '23423524234', '', '', '5', 't', '', '', 1, NULL, NULL, 'FRST', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(2, 'ban', 'BANC1', 4, '2020-10-29 10:44:35', '2020-10-29 13:44:35', 'Banco Nacion', '', '', '45234523455', '', '', '', 'Alvear', '', '', 1, NULL, NULL, 'FRST', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `llx_societe_rib`
--
ALTER TABLE `societe_rib`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_societe_rib` (`label`,`fk_soc`),
  ADD KEY `societe_rib_fk_societe` (`fk_soc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `llx_societe_rib`
--
ALTER TABLE `societe_rib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `llx_societe_rib`
--
ALTER TABLE `societe_rib`
  ADD CONSTRAINT `societe_rib_fk_societe` FOREIGN KEY (`fk_soc`) REFERENCES `societe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
