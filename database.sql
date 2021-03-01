-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 01 mars 2021 à 12:59
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données : `FullStack`
--

-- --------------------------------------------------------

--
-- Structure de la table `Entity`
--

CREATE TABLE `Entity` (
  `_eID` int(11) NOT NULL,
  `eName` varchar(50) NOT NULL,
  `eBaseStr` int(11) NOT NULL DEFAULT '6',
  `eBaseDex` int(11) NOT NULL DEFAULT '6',
  `eBaseInt` int(11) NOT NULL DEFAULT '6',
  `eBaseCon` int(11) NOT NULL DEFAULT '6',
  `eBaseHP` int(11) NOT NULL DEFAULT '6',
  `eBaseMP` int(11) NOT NULL DEFAULT '6'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Entity`
--

INSERT INTO `Entity` (`_eID`, `eName`, `eBaseStr`, `eBaseDex`, `eBaseInt`, `eBaseCon`, `eBaseHP`, `eBaseMP`) VALUES
(1, 'Human', 6, 6, 6, 6, 6, 6),
(2, 'Elf', 6, 6, 8, 8, 6, 6),
(3, 'Dwarf', 6, 4, 6, 8, 6, 6),
(4, 'Halfling', 4, 8, 6, 6, 6, 6),
(5, 'Orc', 8, 6, 4, 6, 6, 6);

-- --------------------------------------------------------

--
-- Structure de la table `Floors`
--

CREATE TABLE `Floors` (
  `_fID` int(11) NOT NULL,
  `flore` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Floors`
--

INSERT INTO `Floors` (`_fID`, `flore`) VALUES
(1, 'Your adventure begins, the first floor is open to you, ignorant, full of bravery, you move forward without fear, while the darkness gradually begins to consume you.');

-- --------------------------------------------------------

--
-- Structure de la table `Heros`
--

CREATE TABLE `Heros` (
  `_ID` int(11) NOT NULL,
  `_IDUser` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `baseEntity` int(11) NOT NULL,
  `class` varchar(10) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `experience` int(11) NOT NULL DEFAULT '0',
  `str_score` int(11) NOT NULL,
  `dex_score` int(11) NOT NULL,
  `int_score` int(11) NOT NULL,
  `con_score` int(11) NOT NULL,
  `floor` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Heros`
--

INSERT INTO `Heros` (`_ID`, `_IDUser`, `name`, `gender`, `baseEntity`, `class`, `level`, `experience`, `str_score`, `dex_score`, `int_score`, `con_score`, `floor`) VALUES
(72, 1, 'Test', 'M', 2, 'Rogue', 1, 0, 9, 10, 12, 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `_ID` int(11) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`_ID`, `Login`, `Password`) VALUES
(1, 'Asgarrrr', '$2y$10$/j.toeoNeq0iH8FJaBDhBuiTrC/LuE4s8GD2Z45K3/McVwd3DZ7BG');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Entity`
--
ALTER TABLE `Entity`
  ADD PRIMARY KEY (`_eID`);

--
-- Index pour la table `Floors`
--
ALTER TABLE `Floors`
  ADD PRIMARY KEY (`_fID`);

--
-- Index pour la table `Heros`
--
ALTER TABLE `Heros`
  ADD PRIMARY KEY (`_ID`),
  ADD KEY `_IDUser` (`_IDUser`),
  ADD KEY `baseEntity` (`baseEntity`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Entity`
--
ALTER TABLE `Entity`
  MODIFY `_eID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Heros`
--
ALTER TABLE `Heros`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Heros`
--
ALTER TABLE `Heros`
  ADD CONSTRAINT `heros_ibfk_1` FOREIGN KEY (`baseEntity`) REFERENCES `Entity` (`_eID`),
  ADD CONSTRAINT `heros_ibfk_2` FOREIGN KEY (`_IDUser`) REFERENCES `Users` (`_ID`);
