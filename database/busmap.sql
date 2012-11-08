-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 29, 2012 at 04:11 PM
-- Server version: 5.5.27
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `busmap`
--
CREATE DATABASE `busmap` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `busmap`;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `idbus` int(11) NOT NULL,
  `description` varchar(75) NOT NULL,
  `qnt_points` int(11) NOT NULL,
  PRIMARY KEY (`idbus`),
  UNIQUE KEY `idroute_UNIQUE` (`idbus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`idbus`, `description`, `qnt_points`) VALUES
(1, 'Eix&atilde;o', 25),
(2, 'TO-050', 20),
(3, 'DETRAN/Praia ARNOS', 14),
(4, 'ARNOS 31/32/33', 14);

-- --------------------------------------------------------

--
-- Table structure for table `buspoint`
--

CREATE TABLE IF NOT EXISTS `buspoint` (
  `point` int(11) NOT NULL,
  `bus` int(11) NOT NULL,
  PRIMARY KEY (`point`,`bus`),
  KEY `fk_BusPoint_Point_idx` (`point`),
  KEY `fk_BusPoint_Bus1_idx` (`bus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `point`
--

CREATE TABLE IF NOT EXISTS `point` (
  `idpoint` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `qnt_bus` int(11) DEFAULT NULL,
  `obs` varchar(255) NOT NULL,
  PRIMARY KEY (`idpoint`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buspoint`
--
ALTER TABLE `buspoint`
  ADD CONSTRAINT `fk_BusPoint_Bus1` FOREIGN KEY (`bus`) REFERENCES `bus` (`idbus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_BusPoint_Point` FOREIGN KEY (`point`) REFERENCES `point` (`idpoint`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
