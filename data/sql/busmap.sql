-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2012 at 02:09 AM
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
(15, 'IFTO/HGP', 1),
(18, 'NS 04/JK', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

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
(22, 65, 15),
(28, 3, 18),
(29, 33, 18),
(30, 18, 18),
(31, 19, 18),
(32, 20, 18),
(36, 72, 18),
(37, 73, 18),
(38, 74, 18),
(39, 75, 18),
(40, 76, 18),
(41, 77, 18),
(42, 65, 18),
(43, 1, 18),
(44, 37, 18),
(45, 38, 18),
(46, 39, 18),
(50, 43, 18),
(51, 44, 18),
(53, 49, 18),
(54, 47, 18),
(56, 50, 18),
(57, 51, 18),
(58, 52, 18),
(59, 53, 18),
(60, 54, 18),
(61, 55, 18),
(62, 58, 18),
(63, 56, 18),
(64, 57, 18),
(65, 90, 18),
(66, 88, 18),
(67, 87, 18),
(68, 85, 18),
(69, 86, 18),
(71, 48, 18),
(75, 83, 1),
(76, 82, 1),
(77, 81, 1),
(78, 80, 1),
(80, 93, 18),
(81, 94, 18),
(82, 82, 18),
(83, 81, 18),
(84, 80, 18),
(85, 79, 18),
(86, 35, 18),
(87, 36, 18),
(88, 32, 18),
(89, 9, 18),
(90, 10, 18),
(91, 11, 18),
(95, 97, 18);

-- --------------------------------------------------------

--
-- Table structure for table `connection`
--

CREATE TABLE IF NOT EXISTS `connection` (
  `idconnection` int(11) NOT NULL AUTO_INCREMENT,
  `distance` decimal(10,4) NOT NULL,
  `point1` int(11) NOT NULL,
  `point2` int(11) NOT NULL,
  PRIMARY KEY (`idconnection`),
  KEY `fk_connection_point1_idx` (`point1`),
  KEY `fk_connection_point2_idx` (`point2`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `connection`
--

INSERT INTO `connection` (`idconnection`, `distance`, `point1`, `point2`) VALUES
(1, '1.0000', 33, 18),
(2, '0.5000', 72, 73),
(3, '0.6000', 3, 33),
(4, '0.6000', 18, 19),
(5, '0.7000', 20, 72),
(6, '0.6000', 19, 20),
(7, '0.6000', 73, 74),
(8, '0.5000', 76, 77),
(9, '0.5000', 74, 75),
(10, '0.4000', 75, 76),
(11, '0.2000', 77, 65),
(12, '1.0000', 65, 1),
(13, '0.5000', 1, 37),
(14, '0.9000', 44, 49),
(15, '0.8000', 43, 44),
(16, '0.5000', 37, 38),
(17, '0.3000', 38, 39),
(18, '0.8000', 49, 47),
(19, '2.6000', 39, 43),
(20, '0.6000', 50, 51),
(21, '0.5000', 47, 50),
(22, '0.7000', 51, 52),
(23, '0.8000', 52, 53),
(24, '0.7000', 54, 55),
(25, '0.7000', 55, 58),
(26, '0.8000', 58, 56),
(27, '0.5000', 53, 54),
(28, '1.1000', 56, 57),
(29, '0.8000', 57, 90),
(30, '0.6000', 87, 85),
(31, '1.0000', 88, 87),
(32, '1.3000', 90, 88),
(33, '0.8000', 85, 86),
(34, '1.2000', 86, 48),
(35, '0.5000', 48, 93),
(36, '0.4000', 93, 94),
(37, '0.8000', 82, 81),
(38, '0.8000', 94, 82),
(39, '0.8000', 81, 80),
(40, '1.1000', 79, 35),
(41, '0.5000', 80, 79),
(42, '0.4000', 36, 32),
(43, '0.4000', 35, 36),
(44, '0.4000', 9, 10),
(45, '0.4000', 10, 11),
(46, '0.2000', 11, 97),
(47, '0.4000', 32, 9),
(48, '0.6000', 3, 33),
(49, '0.7000', 17, 18),
(50, '0.3000', 33, 17),
(51, '0.6000', 18, 19),
(52, '0.6000', 20, 21),
(53, '0.6000', 19, 20),
(54, '0.8000', 22, 23),
(55, '0.8000', 21, 22),
(56, '0.7000', 23, 24),
(57, '0.6000', 25, 61),
(58, '0.7000', 61, 27),
(59, '0.5000', 24, 25),
(60, '0.4000', 27, 28),
(61, '0.4000', 28, 29),
(62, '0.7000', 30, 31),
(63, '0.4000', 31, 32),
(64, '0.4000', 29, 30),
(65, '0.4000', 9, 10),
(66, '0.4000', 10, 11),
(67, '0.1000', 11, 65),
(68, '0.4000', 32, 9);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `point`
--

INSERT INTO `point` (`idpoint`, `label`, `latitude`, `longitude`, `qnt_bus`, `obs`) VALUES
(1, 'P103N-2', -10.182980175870595, -48.337221852396624, 1, 'Galeria Bela Palma'),
(2, 'P103N-3', -10.1844691094456, -48.33934616193642, 1, 'Pizzaria Dom VergÃƒÂ­lio'),
(3, 'APINAJE', -10.177531488383163, -48.33401799201965, 1, 'EstaÃƒÂ§ÃƒÂ£o ApinajÃƒÂ©'),
(4, 'P105N-3', -10.184426870291054, -48.34522556409706, 1, 'Antes do Capim Dourado (saÃƒÂ­da pra ParaÃƒÂ­so)'),
(5, 'P107N-3', -10.184648625790084, -48.348862638211585, 1, 'Capim Dourado (saÃƒÂ­da pra ParaÃƒÂ­so)'),
(6, 'P105S-1', -10.184669745353375, -48.34804724798073, 2, 'Capim Dourado (sentido JK)'),
(7, 'P105S-1', -10.18481758225728, -48.34464620694985, 2, ''),
(8, 'P103N-1', -10.184722544255497, -48.3389170078392, 2, 'PaÃƒÂ§o do PÃƒÂ£o'),
(9, 'PGIR-7', -10.182452183571849, -48.336932173823016, 2, 'PraÃƒÂ§a dos GirassÃƒÂ³is 7'),
(10, 'P101N-4', -10.178967412484358, -48.33699654683937, 1, 'DetrÃƒÂ¡s da estaÃƒÂ§ÃƒÂ£o'),
(11, 'P101N-1', -10.177330612928705, -48.3352930867386, 1, ''),
(12, 'UFT-1', -10.184345031913159, -48.3595029620285, 1, 'Entrada da UFT'),
(13, 'UFT-2', -10.178468453509314, -48.36246948552639, 1, 'Parada principal'),
(14, 'UFT-3', -10.176013247189491, -48.36142878810119, 1, ''),
(15, 'UFT-4', -10.177275172796767, -48.36070459199459, 1, ''),
(16, 'UFT-5', -10.179793729071054, -48.35970681024105, 1, ''),
(17, 'PGIR-2', -10.182959056195426, -48.3304090414988, 1, 'PraÃƒÂ§a dos GirassÃƒÂ³is - 2'),
(18, 'P104S-1', -10.184606386659292, -48.326702228640215, 1, 'JK, Caixa EconÃƒÂ´mica'),
(19, 'P106S-1', -10.184532468166958, -48.32132708144695, 1, ''),
(20, 'P108S-1', -10.184516628487792, -48.31568371367962, 1, 'Ulbrinha'),
(21, 'P110S-1', -10.184474389339531, -48.31048559260876, 1, 'Max PÃƒÂ£o'),
(22, 'P110S-2', -10.189009785932049, -48.30743323874981, 1, ''),
(23, 'P210S-2', -10.19582067938821, -48.308806529765434, 1, ''),
(24, 'P210S-3', -10.197446824668, -48.31264208865673, 1, ''),
(25, 'P208S-3', -10.197478502740372, -48.31715356421978, 1, 'Escolinha do Fluminense'),
(27, 'P204S-3', -10.197531299520643, -48.32792531529617, 1, ''),
(28, 'P202S-3', -10.19763689305494, -48.331444374178545, 1, 'Disbrava Hyundai, SsangYong, Ford'),
(29, 'P201S-3', -10.197589375968837, -48.334684482668536, 1, 'HGP'),
(30, 'P201S-4', -10.195815399682221, -48.33684097871651, 1, ''),
(31, 'P101S-4', -10.189833436598192, -48.3368758474337, 1, 'TapajÃƒÂ³s Wolksvagem'),
(32, 'PGIR-6', -10.186074193173457, -48.33694022045006, 1, 'PraÃƒÂ§a dos GirassÃƒÂ³is - 6'),
(33, 'PGIR-1', -10.180804841983127, -48.33154629812111, 1, 'PraÃƒÂ§a dos GirassÃƒÂ³is - 1'),
(34, 'PGIR-3', -10.186422664231214, -48.33040260314942, 1, ''),
(35, 'PGIR-4', -10.188265330614358, -48.331703474521646, 1, ''),
(36, 'PGIR-5', -10.188304929345241, -48.33579652547837, 1, ''),
(37, 'P103N-2', -10.18686089244506, -48.33717518091203, 1, ''),
(38, 'P101S-1', -10.188605879539251, -48.335243990421304, 1, 'Palmas Shopping'),
(39, 'P102S-1', -10.188600599713725, -48.33284073114396, 1, 'Espeto PÃƒÂ´r do Sol'),
(40, 'P102S-2', -10.190002625366244, -48.33032906077278, 1, ''),
(41, 'P202S-2', -10.194178921653815, -48.330248594502336, 1, ''),
(42, 'P302S-2', -10.198788095350185, -48.33015203514151, 1, ''),
(43, 'P402S-2', -10.208328057134676, -48.330139746665964, 1, 'Extra'),
(44, 'P502S-2', -10.214821774045415, -48.330139746665964, 1, 'Prefeitura'),
(45, 'P602S-2', -10.221653232264723, -48.33007000923158, 1, 'IOP'),
(46, 'P702S-2', -10.226124748652756, -48.33000027179719, 1, ''),
(47, 'P702S-1', -10.223981385015028, -48.33100341796876, 1, ''),
(48, 'P602S-3', -10.223717422975685, -48.33226942062379, 1, ''),
(49, 'XAMBIOA', -10.219889948761173, -48.33364271163941, 1, 'EstaÃƒÂ§ÃƒÂ£o XambioÃƒÂ¡'),
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
(65, 'DL-APINAJE', -10.17737308808037, -48.334007263183594, 1, ''),
(72, 'P108N-4', -10.184210629588684, -48.316980600357056, 1, ''),
(73, 'P106N-4', -10.18431622753619, -48.32165837287903, 1, ''),
(74, 'P104N-4', -10.18436374660117, -48.32718372344971, 1, ''),
(75, 'P104N-5', -10.182420739060012, -48.33013951778412, 1, ''),
(76, 'P104N-6', -10.178788127999534, -48.330209255218506, 1, ''),
(77, 'P202N-3', -10.176950686888546, -48.33234429359436, 1, ''),
(79, 'P204S-4', -10.195525250762428, -48.329973220825195, 1, ''),
(80, 'P304S-4', -10.199601161452742, -48.33013415336609, 1, ''),
(81, 'P404S-4', -10.206538537135485, -48.329951763153076, 1, ''),
(82, 'P504S-4', -10.212958378682824, -48.329962491989136, 1, ''),
(83, 'P604S-4', -10.219568145923501, -48.32988739013672, 1, ''),
(84, 'P704S-4', -10.227560923635073, -48.329715728759766, 1, ''),
(85, 'P806S-4', -10.232481080431395, -48.324254751205444, 1, ''),
(86, 'P706S-4', -10.225913815485516, -48.3243191242218, 1, ''),
(87, 'P906S-4', -10.237992410137894, -48.324222564697266, 1, ''),
(88, 'P1006S-4', -10.24645982207333, -48.32407236099243, 1, ''),
(89, 'P1106S-4', -10.253068891671512, -48.32407236099243, 1, ''),
(90, 'P1204S-1', -10.255307075681696, -48.32661509513855, 1, ''),
(91, 'P502S-3', -10.217422100961146, -48.33217174033052, 1, ''),
(92, 'P604S-3', -10.223781008264037, -48.32719803031068, 1, ''),
(93, 'XAMBIO-N', -10.220243896486263, -48.33307743247133, 1, ''),
(94, 'P602S-1', -10.217804850770738, -48.33198308988358, 1, ''),
(97, 'DL2-APINAJE', -10.177618608516202, -48.33401620398945, 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
