-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 05 mars 2021 à 14:58
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
(6, 'Dragoon', 9, 2, 1, 10, 100, 15),
(7, 'Griffin', 6, 6, 6, 6, 6, 6),
(8, 'Troll', 6, 6, 6, 6, 6, 6),
(9, 'Zombie', 6, 6, 6, 6, 6, 6),
(10, 'Chimera', 6, 6, 6, 6, 6, 6);

-- --------------------------------------------------------

--
-- Structure de la table `floors`
--

CREATE TABLE `floors` (
  `_fID` int(11) NOT NULL,
  `flore` mediumtext NOT NULL,
  `fmonster1` int(11) NOT NULL,
  `fmonster2` int(11) NOT NULL,
  `fmonster3` int(11) NOT NULL,
  `fmonster4` int(11) NOT NULL,
  `fmonster5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `floors`
--

INSERT INTO `floors` (`_fID`, `flore`, `fmonster1`, `fmonster2`, `fmonster3`, `fmonster4`, `fmonster5`) VALUES
(1, 'Your adventure begins, the first floor is open to you, ignorant, full of bravery, you move forward without fear, while the darkness gradually begins to consume you.', 1, 6, 5, 4, 3),
(2, 'Small pussy player', 10, 7, 5, 9, 8);

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
  `skillsPoint` int(11) DEFAULT '0',
  `gold` int(11) NOT NULL DEFAULT '20',
  `potions` int(11) NOT NULL DEFAULT '1',
  `maxHP` int(11) NOT NULL DEFAULT '20',
  `HP` int(11) NOT NULL DEFAULT '20',
  `maxMP` int(11) NOT NULL DEFAULT '20',
  `MP` int(11) NOT NULL DEFAULT '20',
  `str_score` int(11) NOT NULL DEFAULT '6',
  `dex_score` int(11) NOT NULL DEFAULT '6',
  `int_score` int(11) NOT NULL DEFAULT '6',
  `def_score` int(11) NOT NULL DEFAULT '6',
  `floor` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `heros`
--

INSERT INTO `heros` (`_ID`, `_IDUser`, `name`, `gender`, `baseEntity`, `class`, `level`, `experience`, `skillsPoint`, `gold`, `potions`, `maxHP`, `HP`, `maxMP`, `MP`, `str_score`, `dex_score`, `int_score`, `def_score`, `floor`) VALUES
(73, 2, 'SayerS', 'F', 2, 'Rogue', 1, 0, 0, 0, 0, 20, 20, 20, 20, 16, 15, 14, 10, 2),
(74, 2, 'SreyaS', 'M', 5, 'Figther', 1, 0, 0, 0, 0, 20, 15, 20, 20, 13, 11, 8, 16, 2),
(80, 1, 'GrosTankSaMere', 'M', 5, 'Rogue', 5, 356, 0, 149, 72, 24, 24, 24, 24, 1100000, 17, 14, 180000000, 2),
(84, 3, 'Suceur2000', 'M', 4, 'Rogue', 1, 69, 0, 20, 0, 20, 6, 20, 14, 17, 15, 13, 14, 1);

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
(2, 'Sayerz', '$2y$10$YtbQapthdVPMpj4rkS/TVuqGQa/3.KZnMwSLGOhEOtbXLlTXtz8fm'),
(3, 'SUCEUR2000', '$2y$10$U9flY71ELcm2c2MyYQL.8es5X69fZubynDhayfglVkMxmy.0M67UW');

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
  ADD PRIMARY KEY (`_fID`),
  ADD KEY `fmonster1` (`fmonster1`),
  ADD KEY `fmonster2` (`fmonster2`),
  ADD KEY `fmonster3` (`fmonster3`),
  ADD KEY `fmonster4` (`fmonster4`),
  ADD KEY `fmonster5` (`fmonster5`);

--
-- Index pour la table `heros`
--
ALTER TABLE `heros`
  ADD PRIMARY KEY (`_ID`),
  ADD KEY `_IDUser` (`_IDUser`),
  ADD KEY `baseEntity` (`baseEntity`);

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
  MODIFY `_eID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `heros`
--
ALTER TABLE `heros`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
