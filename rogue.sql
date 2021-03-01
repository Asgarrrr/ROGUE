-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 01 mars 2021 à 15:36
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rogue`
--

-- --------------------------------------------------------

--
-- Structure de la table `entity`
--

DROP TABLE IF EXISTS `entity`;
CREATE TABLE IF NOT EXISTS `entity` (
  `_eID` int(11) NOT NULL AUTO_INCREMENT,
  `eName` varchar(50) NOT NULL,
  `eBaseStr` int(11) NOT NULL DEFAULT '6',
  `eBaseDex` int(11) NOT NULL DEFAULT '6',
  `eBaseInt` int(11) NOT NULL DEFAULT '6',
  `eBaseDef` int(11) NOT NULL DEFAULT '6',
  `eBaseHP` int(11) NOT NULL DEFAULT '6',
  `eBaseMP` int(11) NOT NULL DEFAULT '6',
  PRIMARY KEY (`_eID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entity`
--

INSERT INTO `entity` (`_eID`, `eName`, `eBaseStr`, `eBaseDex`, `eBaseInt`, `eBaseDef`, `eBaseHP`, `eBaseMP`) VALUES
(1, 'Human', 6, 6, 6, 6, 6, 6),
(2, 'Elf', 6, 6, 8, 8, 6, 6),
(3, 'Dwarf', 6, 4, 6, 8, 6, 6),
(4, 'Halfling', 4, 8, 6, 6, 6, 6),
(5, 'Orc', 8, 6, 4, 6, 6, 6),
(6, 'Dragoon', 50, 2, 1, 10, 100, 15);

-- --------------------------------------------------------

--
-- Structure de la table `floors`
--

DROP TABLE IF EXISTS `floors`;
CREATE TABLE IF NOT EXISTS `floors` (
  `_fID` int(11) NOT NULL,
  `flore` mediumtext NOT NULL,
  PRIMARY KEY (`_fID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `floors`
--

INSERT INTO `floors` (`_fID`, `flore`) VALUES
(1, 'Your adventure begins, the first floor is open to you, ignorant, full of bravery, you move forward without fear, while the darkness gradually begins to consume you.');

-- --------------------------------------------------------

--
-- Structure de la table `heros`
--

DROP TABLE IF EXISTS `heros`;
CREATE TABLE IF NOT EXISTS `heros` (
  `_ID` int(11) NOT NULL AUTO_INCREMENT,
  `_IDUser` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `baseEntity` int(11) NOT NULL,
  `class` varchar(10) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `experience` int(11) NOT NULL DEFAULT '0',
  `HP` int(11) NOT NULL,
  `str_score` int(11) NOT NULL,
  `dex_score` int(11) NOT NULL,
  `int_score` int(11) NOT NULL,
  `def_score` int(11) NOT NULL,
  `floor` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`_ID`),
  KEY `_IDUser` (`_IDUser`),
  KEY `baseEntity` (`baseEntity`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `heros`
--

INSERT INTO `heros` (`_ID`, `_IDUser`, `name`, `gender`, `baseEntity`, `class`, `level`, `experience`, `HP`, `str_score`, `dex_score`, `int_score`, `def_score`, `floor`) VALUES
(72, 1, 'Test', 'M', 2, 'Rogue', 1, 0, 0, 9, 10, 12, 10, 1),
(73, 2, 'SayerS', 'F', 2, 'Rogue', 1, 0, 0, 16, 15, 14, 10, 1),
(74, 2, 'SreyaS', 'M', 5, 'Figther', 1, 0, 0, 13, 11, 8, 16, 1);

-- --------------------------------------------------------

--
-- Structure de la table `monsters`
--

DROP TABLE IF EXISTS `monsters`;
CREATE TABLE IF NOT EXISTS `monsters` (
  `_ID` int(11) NOT NULL,
  PRIMARY KEY (`_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`_ID`, `Login`, `Password`) VALUES
(1, 'Asgarrrr', '$2y$10$/j.toeoNeq0iH8FJaBDhBuiTrC/LuE4s8GD2Z45K3/McVwd3DZ7BG'),
(2, 'Sayerz', '$2y$10$YtbQapthdVPMpj4rkS/TVuqGQa/3.KZnMwSLGOhEOtbXLlTXtz8fm');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `heros`
--
ALTER TABLE `heros`
  ADD CONSTRAINT `heros_ibfk_1` FOREIGN KEY (`baseEntity`) REFERENCES `entity` (`_eID`),
  ADD CONSTRAINT `heros_ibfk_2` FOREIGN KEY (`_IDUser`) REFERENCES `users` (`_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
