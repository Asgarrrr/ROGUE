-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 02 mars 2021 à 16:39
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données : `rogue`
--

-- --------------------------------------------------------

--
-- Structure de la table `entity`
--

CREATE TABLE `entity` (
  `_eID` int(11) NOT NULL,
  `eName` varchar(50) NOT NULL,
  `eBaseStr` int(11) NOT NULL DEFAULT '6',
  `eBaseDex` int(11) NOT NULL DEFAULT '6',
  `eBaseInt` int(11) NOT NULL DEFAULT '6',
  `eBaseDef` int(11) NOT NULL DEFAULT '6',
  `eBaseHP` int(11) NOT NULL DEFAULT '6',
  `eBaseMP` int(11) NOT NULL DEFAULT '6'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entity`
--

INSERT INTO `entity` (`_eID`, `eName`, `eBaseStr`, `eBaseDex`, `eBaseInt`, `eBaseDef`, `eBaseHP`, `eBaseMP`) VALUES
(1, 'Human', 6, 6, 6, 6, 20, 15),
(2, 'Elf', 6, 6, 8, 4, 15, 20),
(3, 'Dwarf', 6, 4, 6, 8, 25, 5),
(4, 'Dark-Elf', 8, 8, 4, 4, 10, 10),
(5, 'Orc', 8, 6, 2, 8, 30, 1),
(6, 'Dragoon', 50, 2, 1, 10, 100, 15);

-- --------------------------------------------------------

--
-- Structure de la table `floors`
--

CREATE TABLE `floors` (
  `_fID` int(11) NOT NULL,
  `flore` mediumtext NOT NULL
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

CREATE TABLE `heros` (
  `_ID` int(11) NOT NULL,
  `_IDUser` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `baseEntity` int(11) NOT NULL,
  `class` varchar(10) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `experience` int(11) NOT NULL DEFAULT '0',
  `maxHP` int(11) NOT NULL DEFAULT '20',
  `HP` int(11) NOT NULL DEFAULT '20',
  `str_score` int(11) NOT NULL,
  `dex_score` int(11) NOT NULL,
  `int_score` int(11) NOT NULL,
  `def_score` int(11) NOT NULL,
  `floor` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `heros`
--

INSERT INTO `heros` (`_ID`, `_IDUser`, `name`, `gender`, `baseEntity`, `class`, `level`, `experience`, `maxHP`, `HP`, `str_score`, `dex_score`, `int_score`, `def_score`, `floor`) VALUES
(72, 1, 'Test', 'M', 2, 'Rogue', 1, 0, 0, 0, 9, 10, 12, 10, 1),
(73, 2, 'SayerS', 'F', 2, 'Rogue', 1, 0, 0, 0, 16, 15, 14, 10, 1),
(74, 2, 'SreyaS', 'M', 5, 'Figther', 1, 0, 0, 0, 13, 11, 8, 16, 1),
(76, 1, 'GrosTankSaMere', 'F', 3, 'Mage', 1, 0, 20, 20, 14, 11, 7, 17, 1),
(77, 1, 'OCTOPUTE', 'F', 4, 'Rogue', 1, 0, 20, 20, 15, 18, 13, 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `monsters`
--

CREATE TABLE `monsters` (
  `_ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `_ID` int(11) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`_ID`, `Login`, `Password`) VALUES
(1, 'Asgarrrr', '$2y$10$/j.toeoNeq0iH8FJaBDhBuiTrC/LuE4s8GD2Z45K3/McVwd3DZ7BG'),
(2, 'Sayerz', '$2y$10$YtbQapthdVPMpj4rkS/TVuqGQa/3.KZnMwSLGOhEOtbXLlTXtz8fm');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `entity`
--
ALTER TABLE `entity`
  ADD PRIMARY KEY (`_eID`);

--
-- Index pour la table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`_fID`);

--
-- Index pour la table `heros`
--
ALTER TABLE `heros`
  ADD PRIMARY KEY (`_ID`),
  ADD KEY `_IDUser` (`_IDUser`),
  ADD KEY `baseEntity` (`baseEntity`);

--
-- Index pour la table `monsters`
--
ALTER TABLE `monsters`
  ADD PRIMARY KEY (`_ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `entity`
--
ALTER TABLE `entity`
  MODIFY `_eID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `heros`
--
ALTER TABLE `heros`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `heros`
--
ALTER TABLE `heros`
  ADD CONSTRAINT `heros_ibfk_1` FOREIGN KEY (`baseEntity`) REFERENCES `entity` (`_eID`),
  ADD CONSTRAINT `heros_ibfk_2` FOREIGN KEY (`_IDUser`) REFERENCES `users` (`_ID`);
