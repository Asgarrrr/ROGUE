-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 04 mars 2021 à 16:50
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entity`
--

INSERT INTO `entity` (`_eID`, `eName`, `eBaseStr`, `eBaseDex`, `eBaseInt`, `eBaseDef`, `eBaseHP`, `eBaseMP`) VALUES
(1, 'Human', 6, 6, 6, 6, 20, 15),
(2, 'Elf', 6, 6, 8, 4, 15, 20),
(3, 'Dwarf', 6, 4, 6, 8, 25, 5),
(4, 'Dark-Elf', 8, 8, 4, 4, 10, 10),
(5, 'Orc', 8, 6, 2, 8, 30, 1),
(6, 'Dragoon', 9, 2, 1, 10, 100, 15),
(7, 'Griffin', 6, 6, 6, 6, 6, 6),
(8, 'Troll', 6, 6, 6, 6, 6, 6),
(9, 'Zombie', 6, 6, 6, 6, 6, 6),
(10, 'Chimera', 6, 6, 6, 6, 6, 6);

-- --------------------------------------------------------

--
-- Structure de la table `floors`
--

DROP TABLE IF EXISTS `floors`;
CREATE TABLE IF NOT EXISTS `floors` (
  `_fID` int(11) NOT NULL,
  `flore` mediumtext NOT NULL,
  `fmonster1` int(11) NOT NULL,
  `fmonster2` int(11) NOT NULL,
  `fmonster3` int(11) NOT NULL,
  `fmonster4` int(11) NOT NULL,
  `fmonster5` int(11) NOT NULL,
  PRIMARY KEY (`_fID`),
  KEY `fmonster1` (`fmonster1`),
  KEY `fmonster2` (`fmonster2`),
  KEY `fmonster3` (`fmonster3`),
  KEY `fmonster4` (`fmonster4`),
  KEY `fmonster5` (`fmonster5`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `floors`
--

INSERT INTO `floors` (`_fID`, `flore`, `fmonster1`, `fmonster2`, `fmonster3`, `fmonster4`, `fmonster5`) VALUES
(1, 'Your adventure begins, the first floor is open to you, ignorant, full of bravery, you move forward without fear, while the darkness gradually begins to consume you.', 1, 6, 5, 4, 3);

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
  `skillsPoint` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `potions` int(11) NOT NULL,
  `maxHP` int(11) NOT NULL DEFAULT '20',
  `HP` int(11) NOT NULL DEFAULT '20',
  `maxMP` int(11) NOT NULL DEFAULT '20',
  `MP` int(11) NOT NULL DEFAULT '20',
  `str_score` int(11) NOT NULL,
  `dex_score` int(11) NOT NULL,
  `int_score` int(11) NOT NULL,
  `def_score` int(11) NOT NULL,
  `floor` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`_ID`),
  KEY `_IDUser` (`_IDUser`),
  KEY `baseEntity` (`baseEntity`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `heros`
--

INSERT INTO `heros` (`_ID`, `_IDUser`, `name`, `gender`, `baseEntity`, `class`, `level`, `experience`, `skillsPoint`, `gold`, `potions`, `maxHP`, `HP`, `maxMP`, `MP`, `str_score`, `dex_score`, `int_score`, `def_score`, `floor`) VALUES
(72, 1, 'Test', 'M', 2, 'Rogue', 1, 0, 0, 0, 0, 20, 20, 20, 20, 9, 10, 12, 10, 1),
(73, 2, 'SayerS', 'F', 2, 'Rogue', 1, 0, 0, 0, 0, 20, 20, 20, 20, 16, 15, 14, 10, 1),
(74, 2, 'SreyaS', 'M', 5, 'Figther', 1, 0, 0, 0, 0, 20, 15, 20, 20, 13, 11, 8, 16, 1),
(76, 1, 'GrosTankSaMere', 'F', 3, 'Mage', 1, 0, 0, 0, 0, 20, 20, 20, 20, 14, 11, 7, 17, 1),
(77, 1, 'OCTOPUTE', 'F', 4, 'Rogue', 1, 0, 0, 0, 0, 20, 20, 20, 20, 15, 18, 13, 9, 1);

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
-- Contraintes pour la table `floors`
--
ALTER TABLE `floors`
  ADD CONSTRAINT `floors_ibfk_1` FOREIGN KEY (`fmonster1`) REFERENCES `entity` (`_eID`),
  ADD CONSTRAINT `floors_ibfk_2` FOREIGN KEY (`fmonster2`) REFERENCES `entity` (`_eID`),
  ADD CONSTRAINT `floors_ibfk_3` FOREIGN KEY (`fmonster3`) REFERENCES `entity` (`_eID`),
  ADD CONSTRAINT `floors_ibfk_4` FOREIGN KEY (`fmonster4`) REFERENCES `entity` (`_eID`),
  ADD CONSTRAINT `floors_ibfk_5` FOREIGN KEY (`fmonster5`) REFERENCES `entity` (`_eID`);

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
