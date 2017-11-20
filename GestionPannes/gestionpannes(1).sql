-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2016 at 05:30 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gestionpannes`
--

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

CREATE TABLE IF NOT EXISTS `demande` (
  `ID_DEMANDE` int(11) NOT NULL AUTO_INCREMENT,
  `MATRICULE_UTILIS` char(30) NOT NULL,
  `ID_MATER` int(11) NOT NULL,
  `DATE_DEMANDE` date DEFAULT NULL,
  `ETAT_DEMANDE` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID_DEMANDE`),
  UNIQUE KEY `DEMANDE_PK` (`ID_DEMANDE`),
  KEY `EFFECTUE_FK` (`MATRICULE_UTILIS`),
  KEY `CONCERNE_FK` (`ID_MATER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `demande`
--

INSERT INTO `demande` (`ID_DEMANDE`, `MATRICULE_UTILIS`, `ID_MATER`, `DATE_DEMANDE`, `ETAT_DEMANDE`) VALUES
(1, 'M001', 8, '2016-07-13', 0),
(2, 'M002', 7, '2016-07-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `destinee`
--

CREATE TABLE IF NOT EXISTS `destinee` (
  `ID_FOURNIS` int(11) NOT NULL,
  `ID_DEMANDE` int(11) NOT NULL,
  `MATRICULE_UTILIS` char(30) NOT NULL,
  PRIMARY KEY (`ID_FOURNIS`,`ID_DEMANDE`,`MATRICULE_UTILIS`),
  KEY `DESTINEE_PK` (`ID_FOURNIS`,`ID_DEMANDE`,`MATRICULE_UTILIS`),
  KEY `DESTINEE_FK` (`ID_FOURNIS`),
  KEY `DESTINEE2_FK` (`ID_DEMANDE`),
  KEY `DESTINEE3_FK` (`MATRICULE_UTILIS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destinee`
--

INSERT INTO `destinee` (`ID_FOURNIS`, `ID_DEMANDE`, `MATRICULE_UTILIS`) VALUES
(2, 1, 'M002');

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

CREATE TABLE IF NOT EXISTS `fournisseur` (
  `ID_FOURNIS` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_FOURNIS` char(50) DEFAULT NULL,
  `ADRESSE_FOURNIS` char(255) DEFAULT NULL,
  `EMAIL_FOURNIS` char(255) DEFAULT NULL,
  `TELE_FOURNIS` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_FOURNIS`),
  UNIQUE KEY `FOURNISSEUR_PK` (`ID_FOURNIS`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fournisseur`
--

INSERT INTO `fournisseur` (`ID_FOURNIS`, `NOM_FOURNIS`, `ADRESSE_FOURNIS`, `EMAIL_FOURNIS`, `TELE_FOURNIS`) VALUES
(1, 'Microsoft', 'Microsoft Inc. Casablanca', 'microsoft.inc@microsoft.com', '00922154014'),
(2, 'Appel', 'U.S.A. Appel inc.', 'Appel.Steve@appel.com', '+00542154782');

-- --------------------------------------------------------

--
-- Table structure for table `marque`
--

CREATE TABLE IF NOT EXISTS `marque` (
  `ID_MARQUE` int(11) NOT NULL AUTO_INCREMENT,
  `LABELLE_MARQUE` char(50) DEFAULT NULL,
  PRIMARY KEY (`ID_MARQUE`),
  UNIQUE KEY `MARQUE_PK` (`ID_MARQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `marque`
--

INSERT INTO `marque` (`ID_MARQUE`, `LABELLE_MARQUE`) VALUES
(1, 'Dell'),
(2, 'HP'),
(3, 'Toshiba'),
(4, 'Sony Vaio'),
(5, 'CISCO');

-- --------------------------------------------------------

--
-- Table structure for table `materielle`
--

CREATE TABLE IF NOT EXISTS `materielle` (
  `ID_MATER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_MARQUE` int(11) NOT NULL,
  `ID_SERVICE` int(11) NOT NULL,
  `ID_TYPE` int(11) NOT NULL,
  `ID_FOURNIS` int(11) NOT NULL,
  `NUM_SERIE_MATER` char(30) DEFAULT NULL,
  `DESIGNATION_MATER` mediumtext,
  `DATE_ACHAT_MATER` date DEFAULT NULL,
  `FIN_GARANTIE_MATER` date DEFAULT NULL,
  `LOCATION` int(1) DEFAULT NULL,
  `DATE_MISE_EN_SERVICE` date DEFAULT NULL,
  PRIMARY KEY (`ID_MATER`),
  UNIQUE KEY `MATERIELLE_PK` (`ID_MATER`),
  KEY `FOURNIS_FK` (`ID_FOURNIS`),
  KEY `TYPE_FK` (`ID_TYPE`),
  KEY `DEMARQUE_FK` (`ID_MARQUE`),
  KEY `AFFECTER_FK` (`ID_SERVICE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `materielle`
--

INSERT INTO `materielle` (`ID_MATER`, `ID_MARQUE`, `ID_SERVICE`, `ID_TYPE`, `ID_FOURNIS`, `NUM_SERIE_MATER`, `DESIGNATION_MATER`, `DATE_ACHAT_MATER`, `FIN_GARANTIE_MATER`, `LOCATION`, `DATE_MISE_EN_SERVICE`) VALUES
(6, 2, 2, 1, 1, 'S041FG5', 'HP i3 500Gb HDD, 4GB RAM', '2010-02-01', '2019-12-31', 1, '2010-02-08'),
(7, 4, 1, 2, 1, 'SVF14G56', 'Sony Vaio core i7, 1Tb HDD 8Gb RAM', '2015-02-18', '2019-12-31', 0, '2015-08-24'),
(8, 3, 4, 5, 2, 'SVF45K1', 'IPhone 6S', '2014-06-03', '2020-12-25', 1, '2014-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `ID_MSG` int(11) NOT NULL AUTO_INCREMENT,
  `CONTENUE_MSG` mediumtext,
  `OBJET_MSG` varchar(150) NOT NULL,
  `DATE_MSG` datetime DEFAULT NULL,
  `VU_MSG` smallint(6) NOT NULL,
  PRIMARY KEY (`ID_MSG`),
  UNIQUE KEY `MESSAGE_PK` (`ID_MSG`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`ID_MSG`, `CONTENUE_MSG`, `OBJET_MSG`, `DATE_MSG`, `VU_MSG`) VALUES
(1, 'Bonjour, suite a votre demande N 12 je vous informe que le matérielle HP a été bien réparer.', 'Réparation matérielle', '2016-07-12 00:00:00', 0),
(2, 'Votre demanade est en attente', 'demande en attente', '2016-07-22 00:00:00', 0),
(3, 'Bonjour;\r\nLe matérielle HP cire i3 SG154FG55 fournis par votre entreprise et qui''a une garantie jusqu''a le 31-12-2019 est en panne', 'Demande réparation', '2016-07-03 00:00:00', 1),
(6, 'kokokokoko', 'Votre demande de panne', '2016-07-22 09:35:02', 0),
(7, 'kokokokoko', 'Votre demande de panne N15 Votre demande de panne N15 Votre demande de panne N15 Votre demande de panne N15 ', '2016-07-22 09:36:48', 0),
(8, 'klklklklklk', 'Votre demande de panne', '2016-07-22 09:37:48', 1),
(9, 'jijijijijijiji', 'Demande de reparation', '2016-07-22 09:40:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messagerie`
--

CREATE TABLE IF NOT EXISTS `messagerie` (
  `ID_FOURNIS` int(11) NOT NULL,
  `ID_MSG` int(11) NOT NULL,
  `MATRICULE_UTILIS` char(30) NOT NULL,
  PRIMARY KEY (`ID_FOURNIS`,`ID_MSG`,`MATRICULE_UTILIS`),
  KEY `MESSAGERIE_PK` (`ID_FOURNIS`,`ID_MSG`,`MATRICULE_UTILIS`),
  KEY `MESSAGERIE_FK` (`ID_FOURNIS`),
  KEY `MESSAGERIE2_FK` (`ID_MSG`),
  KEY `MESSAGERIE3_FK` (`MATRICULE_UTILIS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messagerie`
--

INSERT INTO `messagerie` (`ID_FOURNIS`, `ID_MSG`, `MATRICULE_UTILIS`) VALUES
(1, 3, 'M001'),
(2, 2, 'M002'),
(2, 9, 'M001');

-- --------------------------------------------------------

--
-- Table structure for table `messagerieinterne`
--

CREATE TABLE IF NOT EXISTS `messagerieinterne` (
  `EMMETEUR` varchar(30) NOT NULL,
  `RECEPTEUR` varchar(30) NOT NULL,
  `ID_MSG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messagerieinterne`
--

INSERT INTO `messagerieinterne` (`EMMETEUR`, `RECEPTEUR`, `ID_MSG`) VALUES
('M001', 'M002', 8),
('M002', 'M001', 8),
('M002', 'M001', 7);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `ID_SERVICE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_SERVICE` char(255) DEFAULT NULL,
  `CODE_SERVICE` char(30) DEFAULT NULL,
  PRIMARY KEY (`ID_SERVICE`),
  UNIQUE KEY `SERVICE_PK` (`ID_SERVICE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`ID_SERVICE`, `NOM_SERVICE`, `CODE_SERVICE`) VALUES
(1, 'Informatique', 'I/C/Y/G'),
(2, 'Achat', 'A/C/D/Y'),
(3, 'DESK', 'D/E/Y/G'),
(4, 'SÃ©curitÃ©', 'SE/D/I/Y'),
(5, 'Maintenance', 'M/A/D/Y');

-- --------------------------------------------------------

--
-- Table structure for table `typemateriel`
--

CREATE TABLE IF NOT EXISTS `typemateriel` (
  `ID_TYPE` int(11) NOT NULL AUTO_INCREMENT,
  `LABELLE_TYPE` char(50) DEFAULT NULL,
  PRIMARY KEY (`ID_TYPE`),
  UNIQUE KEY `TYPEMATERIEL_PK` (`ID_TYPE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `typemateriel`
--

INSERT INTO `typemateriel` (`ID_TYPE`, `LABELLE_TYPE`) VALUES
(1, 'Ordinateur Bureau'),
(2, 'Ordinateur Portable'),
(3, 'Routeur'),
(4, 'Imprimante'),
(5, 'Telephone IP');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `MATRICULE_UTILIS` char(30) NOT NULL,
  `ID_SERVICE` int(11) NOT NULL,
  `NOM_UTILIS` char(50) DEFAULT NULL,
  `PRENOM_UTILIS` char(50) DEFAULT NULL,
  `DATENAISSANCE_UTILIS` date DEFAULT NULL,
  `ADRESSE_UTILIS` char(255) DEFAULT NULL,
  `TELE_UTILIS` char(13) DEFAULT NULL,
  `EMAIL_UTILIS` char(255) DEFAULT NULL,
  `TYPE_UTILIS` char(30) DEFAULT NULL,
  `MDPS_UTILIS` char(255) DEFAULT NULL,
  PRIMARY KEY (`MATRICULE_UTILIS`),
  UNIQUE KEY `UTILISATEUR_PK` (`MATRICULE_UTILIS`),
  KEY `APPARTIENT_FK` (`ID_SERVICE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`MATRICULE_UTILIS`, `ID_SERVICE`, `NOM_UTILIS`, `PRENOM_UTILIS`, `DATENAISSANCE_UTILIS`, `ADRESSE_UTILIS`, `TELE_UTILIS`, `EMAIL_UTILIS`, `TYPE_UTILIS`, `MDPS_UTILIS`) VALUES
('M001', 1, 'BENSTITOU', 'Anas', '1995-08-18', 'N11 Rue rachidia, CHEMAIA', '0629830743', 'anasben2013@gmail.com', 'IT', '$2y$10$THTCgChOEfwhIvaxgETiGOemTf7ycI2oM.p.pmDH81UEoxkYNtQ9a'),
('M002', 1, 'JABLI', 'Zakaria', '1990-08-18', 'Ocp 8220 YOUSSOUFIA', '0645781523', 'jabli.zakaria@gmail.com', '1', '$2y$10$NUvzXl7uUoKfh..J1twPy.AMeEQczb0G9CZ4v.f.ooYnNgj86pnXS');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
