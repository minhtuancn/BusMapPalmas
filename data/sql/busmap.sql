-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 21, 2012 at 02:49 AM
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
  PRIMARY KEY (`idbus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`idbus`, `description`, `qnt_points`) VALUES
(1, 'Eix&atilde;o', 25),
(2, 'TO-050', 20),
(3, 'DETRAN/Praia ARNOS', 14),
(4, 'ARNOS 31/32/33', 14),
(9, 'UFT', 1),
(15, 'IFTO/HGP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `buspoint`
--

CREATE TABLE IF NOT EXISTS `buspoint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `point` int(11) NOT NULL,
  `bus` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_buspoint_point_idx` (`point`),
  KEY `fk_buspoint_bus1_idx` (`bus`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `buspoint`
--

INSERT INTO `buspoint` (`id`, `point`, `bus`) VALUES
(1, 3, 15),
(2, 33, 15),
(3, 17, 15),
(4, 18, 15),
(5, 19, 15),
(6, 20, 15),
(7, 21, 15),
(8, 22, 15),
(9, 23, 15),
(10, 24, 15),
(11, 25, 15),
(12, 61, 15),
(13, 27, 15),
(14, 28, 15),
(15, 29, 15),
(16, 30, 15),
(17, 31, 15),
(18, 32, 15),
(19, 9, 15),
(20, 10, 15),
(21, 11, 15),
(22, 65, 15);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `point`
--

INSERT INTO `point` (`idpoint`, `label`, `latitude`, `longitude`, `qnt_bus`, `obs`) VALUES
(1, 'P103N-2', -10.182980175870595, -48.337221852396624, 1, 'Galeria Bela Palma'),
(2, 'P103N-3', -10.1844691094456, -48.33934616193642, 1, 'Pizzaria Dom Vergílio'),
(3, 'APINAJE', -10.177531488383163, -48.33401799201965, 1, 'Estação Apinajé'),
(4, 'P105N-3', -10.184426870291054, -48.34522556409706, 1, 'Antes do Capim Dourado (saída pra Paraíso)'),
(5, 'P107N-3', -10.184648625790084, -48.348862638211585, 1, 'Capim Dourado (saída pra Paraíso)'),
(6, 'P105S-1', -10.184669745353375, -48.34804724798073, 2, 'Capim Dourado (sentido JK)'),
(7, 'P105S-1', -10.18481758225728, -48.34464620694985, 2, ''),
(8, 'P103N-1', -10.184722544255497, -48.3389170078392, 2, 'Paço do Pão'),
(9, 'PGIR-7', -10.182452183571849, -48.336932173823016, 2, 'Praça dos Girassóis 7'),
(10, 'P101N-4', -10.178967412484358, -48.33699654683937, 1, 'Detrás da estação'),
(11, 'P101N-1', -10.177330612928705, -48.3352930867386, 1, ''),
(12, 'UFT-1', -10.184345031913159, -48.3595029620285, 1, 'Entrada da UFT'),
(13, 'UFT-2', -10.178468453509314, -48.36246948552639, 1, 'Parada principal'),
(14, 'UFT-3', -10.176013247189491, -48.36142878810119, 1, ''),
(15, 'UFT-4', -10.177275172796767, -48.36070459199459, 1, ''),
(16, 'UFT-5', -10.179793729071054, -48.35970681024105, 1, ''),
(17, 'PGIR-2', -10.182959056195426, -48.3304090414988, 1, 'Praça dos Girassóis - 2'),
(18, 'P104S-1', -10.184606386659292, -48.326702228640215, 1, 'JK, Caixa Econômica'),
(19, 'P106S-1', -10.184532468166958, -48.32132708144695, 1, ''),
(20, 'P108S-1', -10.184516628487792, -48.31568371367962, 1, 'Ulbrinha'),
(21, 'P110S-1', -10.184474389339531, -48.31048559260876, 1, 'Max Pão'),
(22, 'P110S-2', -10.189009785932049, -48.30743323874981, 1, ''),
(23, 'P210S-2', -10.19582067938821, -48.308806529765434, 1, ''),
(24, 'P210S-3', -10.197446824668, -48.31264208865673, 1, ''),
(25, 'P208S-3', -10.197478502740372, -48.31715356421978, 1, 'Escolinha do Fluminense'),
(27, 'P204S-3', -10.197531299520643, -48.32792531529617, 1, ''),
(28, 'P202S-3', -10.19763689305494, -48.331444374178545, 1, 'Disbrava Hyundai, SsangYong, Ford'),
(29, 'P201S-3', -10.197589375968837, -48.334684482668536, 1, 'HGP'),
(30, 'P201S-4', -10.195815399682221, -48.33684097871651, 1, ''),
(31, 'P101S-4', -10.189833436598192, -48.3368758474337, 1, 'Tapajós Wolksvagem'),
(32, 'PGIR-6', -10.186074193173457, -48.33694022045006, 1, 'Praça dos Girassóis - 6'),
(33, 'PGIR-1', -10.180804841983127, -48.33154629812111, 1, 'Praça dos Girassóis - 1'),
(34, 'PGIR-3', -10.186422664231214, -48.33040260314942, 1, ''),
(35, 'PGIR-4', -10.188265330614358, -48.331703474521646, 1, ''),
(36, 'PGIR-5', -10.188304929345241, -48.33579652547837, 1, ''),
(37, 'P103N-2', -10.18686089244506, -48.33717518091203, 1, ''),
(38, 'P101S-1', -10.188605879539251, -48.335243990421304, 1, 'Palmas Shopping'),
(39, 'P102S-1', -10.188600599713725, -48.33284073114396, 1, 'Espeto Pôr do Sol'),
(40, 'P202S-2', -10.193592635689608, -48.330260446071634, 1, 'Espeto Pôr do Sol'),
(41, 'P202S-2', -10.190081587343254, -48.330332865715036, 1, ''),
(42, 'P302S-2', -10.198909292390708, -48.330139746665964, 1, ''),
(43, 'P402S-2', -10.208328057134676, -48.330139746665964, 1, 'Extra'),
(44, 'P502S-2', -10.214821774045415, -48.330139746665964, 1, 'Prefeitura'),
(45, 'P602S-2', -10.221653232264723, -48.33007000923158, 1, 'IOP'),
(46, 'P702S-2', -10.226124748652756, -48.33000027179719, 1, ''),
(47, 'P702S-1', -10.223981385015028, -48.33100341796876, 1, ''),
(48, 'P602S-3', -10.223717422975685, -48.33226942062379, 1, ''),
(49, 'XAMBIOA', -10.219889948761173, -48.33364271163941, 1, 'Estação Xambioá'),
(50, 'P704S-1', -10.223941790723105, -48.32652412891389, 1, 'Palmas Brasil'),
(51, 'P704S-2', -10.227674190944906, -48.324587574005136, 1, ''),
(52, 'P804S-2', -10.233956349676664, -48.32456611633302, 1, ''),
(53, 'P904S-2', -10.240497053391188, -48.32443200588227, 1, ''),
(54, 'P1004S-2', -10.245100276508747, -48.32444273471833, 1, ''),
(55, 'P1104S-2', -10.251471829400293, -48.32442127704621, 1, ''),
(56, 'KRAHO-S', -10.256322992117072, -48.333133091926584, 1, ''),
(57, 'KRAHO-N', -10.256655550060435, -48.33295070171357, 1, ''),
(58, 'P1204S-3', -10.255193348241054, -48.327135672569284, 1, ''),
(61, 'P206S-3', -10.197495409604155, -48.32210734722139, 1, ''),
(64, 'P203S-3', -10.197489297139896, -48.322023153305054, 1, ''),
(65, 'DL-APINAJE', -10.17737308808037, -48.334007263183594, 1, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buspoint`
--
ALTER TABLE `buspoint`
  ADD CONSTRAINT `fk_buspoint_point` FOREIGN KEY (`point`) REFERENCES `point` (`idpoint`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_buspoint_bus1` FOREIGN KEY (`bus`) REFERENCES `bus` (`idbus`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
