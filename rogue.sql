-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 09, 2021 at 08:52 AM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `rogue`
--

-- --------------------------------------------------------

--
-- Table structure for table `Entity`
--

CREATE TABLE `Entity` (
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
-- Dumping data for table `Entity`
--

INSERT INTO `Entity` (`_eID`, `eName`, `eBaseStr`, `eBaseDex`, `eBaseInt`, `eBaseDef`, `eBaseHP`, `eBaseMP`) VALUES
(1, 'Human', 6, 6, 6, 6, 20, 15),
(2, 'Elf', 6, 6, 8, 4, 15, 20),
(3, 'Dwarf', 6, 4, 6, 8, 25, 5),
(4, 'Dark-Elf', 8, 8, 4, 4, 10, 10),
(5, 'Orc', 8, 6, 2, 8, 30, 1),
(6, 'Dragoon', 9, 2, 4, 7, 25, 15),
(7, 'Griffin', 4, 4, 4, 4, 15, 6),
(8, 'Troll', 4, 4, 4, 4, 15, 6),
(9, 'Zombie', 4, 4, 4, 4, 10, 6),
(10, 'Chimera', 4, 4, 4, 4, 15, 6),
(11, 'Giant Weasel', 2, 50, 10, 4, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `Floors`
--

CREATE TABLE `Floors` (
  `_fID` int(11) NOT NULL,
  `flore` mediumtext NOT NULL,
  `fmonster1` int(11) DEFAULT NULL,
  `fmonster2` int(11) DEFAULT NULL,
  `fmonster3` int(11) DEFAULT NULL,
  `fmonster4` int(11) DEFAULT NULL,
  `fmonster5` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Floors`
--

INSERT INTO `Floors` (`_fID`, `flore`, `fmonster1`, `fmonster2`, `fmonster3`, `fmonster4`, `fmonster5`) VALUES
(1, 'Your adventure begins, the first floor is open to you, ignorant, full of bravery, you move forward without fear, while the darkness gradually begins to consume you.', 1, 6, 5, 4, 3),
(2, 'You are slowly suffering the effects of darkness, your eyesight is blurred, keeping your senses alert is becoming more and more difficult. But the monsters, roam, and will be merciless. ', 10, 7, 5, 9, 8),
(3, 'The putrid smell of the depths plunges your mind into unspeakable disarray. The end is near...', 9, 6, 10, 5, 3),
(4, 'You seem to see your congeners of yesteryear, of numbered damned souls lying in wait, former travellers of the abyss, like you. Will you join them?', 4, 1, 2, 5, 3),
(5, 'In the lair of the orcs, you meet only them. Their strength, and their skin as hard as steel will break your blades. ', 5, NULL, NULL, NULL, NULL),
(6, 'The Damnos sepulchre is located in the deepest part of the frozen earth... It is said that countless treasures of gold and ancient books are stored there.', 11, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Heros`
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
  `floor` int(11) NOT NULL DEFAULT '1',
  `weapon` int(11) NOT NULL DEFAULT '1',
  `armor` int(11) NOT NULL DEFAULT '4',
  `accessory` int(11) NOT NULL DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Heros`
--

INSERT INTO `Heros` (`_ID`, `_IDUser`, `name`, `gender`, `baseEntity`, `class`, `level`, `experience`, `skillsPoint`, `gold`, `potions`, `maxHP`, `HP`, `maxMP`, `MP`, `str_score`, `dex_score`, `int_score`, `def_score`, `floor`, `weapon`, `armor`, `accessory`) VALUES
(73, 2, 'SayerS', 'F', 2, 'Rogue', 1, 0, 0, 0, 0, 20, 20, 20, 20, 16, 15, 14, 10, 2, 0, 0, 0),
(74, 2, 'SreyaS', 'M', 5, 'Figther', 1, 0, 0, 0, 0, 20, 15, 20, 20, 13, 11, 8, 16, 2, 0, 0, 0),
(116, 9, 'Test', 'M', 3, 'Figther', 2, 51, 0, 60, 1, 21, 21, 21, 21, 117, 6, 6, 9, 1, 0, 0, 0),
(128, 1, 'de', 'M', 1, 'Figther', 1, 36, 0, 47, 1, 20, 14, 20, 17, 13, 11, 15, 12, 1, 1, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Inventory`
--

CREATE TABLE `Inventory` (
  `_iID` int(11) NOT NULL,
  `_iEID` int(11) NOT NULL,
  `_iSID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Inventory`
--

INSERT INTO `Inventory` (`_iID`, `_iEID`, `_iSID`) VALUES
(32, 128, 1),
(33, 128, 4),
(34, 128, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Stuffs`
--

CREATE TABLE `Stuffs` (
  `_sID` int(11) NOT NULL,
  `sName` varchar(30) NOT NULL,
  `sType` int(11) NOT NULL,
  `sDescription` varchar(500) NOT NULL,
  `sStrModifier` int(11) NOT NULL DEFAULT '0',
  `sDexModifier` int(11) NOT NULL DEFAULT '0',
  `sIntModifier` int(11) NOT NULL DEFAULT '0',
  `sDefModifier` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Stuffs`
--

INSERT INTO `Stuffs` (`_sID`, `sName`, `sType`, `sDescription`, `sStrModifier`, `sDexModifier`, `sIntModifier`, `sDefModifier`) VALUES
(1, 'Copper gladius', 0, 'The blade is poorly made, currently has a sharp edge, and has delicate patterns etched across it.\r\nIt has a decorative guard, a jewel-encrusted grip, and a pommel with a sigil set inside a disk.\r\nIt is heavy, is unbalanced and is to be used in the right hand.\r\nThe scabbard is made of wood with leather trimmings.', 3, 1, 0, 0),
(2, 'Copper scimitar', 0, 'The blade is broken, currently has a sharp edge, and has runes engraved on it.\r\nIt has a fancy guard, a solid gold grip, and a round pommel with a long slate tassel on the end.\r\nIt is neither too light nor too heavy, is unbalanced and is uncomfortable to hold.\r\nThe scabbard is made of orange leather with steel trimmings, and is covered by cyan rubber.', 2, 2, 0, -1),
(3, 'Ebony longsword', 0, 'The blade is falling apart, currently has a uneven edge, and has delicate patterns etched across it.\r\nIt has a guard shaped like a vine, a grip inlaid with precious stones, and a plain pommel.\r\nIt is light-weight, is unbalanced and can be used easily by anyone.\r\nThe scabbard is made of jet with bronze trimmings, and is covered by beige leather.', 3, 0, 0, 0),
(4, 'Leather armor', 1, 'Leather armor is made up of multiple overlapping pieces of leather, boiled to increase their natural toughness and then deliberately stitched together. Although not as sturdy as metal armor, the flexibility it allows wearers makes it among the most widely used types of armor.', 0, 1, 0, 1),
(5, 'Blood Crystal', 2, 'Mysterious radiation deep below the surface of the earth warps once-ordinary quartz into bloodcraving stone.', 5, 0, 0, -2),
(6, 'Cheatcode !', 0, '', 50, 50, 50, 50);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `_ID` int(11) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`_ID`, `Login`, `Password`) VALUES
(1, 'Asgarrrr', '$2y$10$/j.toeoNeq0iH8FJaBDhBuiTrC/LuE4s8GD2Z45K3/McVwd3DZ7BG'),
(2, 'Sayerz', '$2y$10$YtbQapthdVPMpj4rkS/TVuqGQa/3.KZnMwSLGOhEOtbXLlTXtz8fm'),
(3, 'SUCEUR2000', '$2y$10$U9flY71ELcm2c2MyYQL.8es5X69fZubynDhayfglVkMxmy.0M67UW'),
(4, 'Asgarrrr@mail.com', '$2y$10$1lyp/NqzFWLJyqRxZ5EDRucmNFRVyv6BdBzwKnwzfH6jUemZZ0dDy'),
(5, 'Julien', '$2y$10$D78A548FDyTz6AHCBs7v9.3tPnVq.cPmoMXfWXgyQlg3QiLbfgrnu'),
(6, 'Test', '$2y$10$xMwFgdv3XdeVGM4oUs1zP.ufqaPPXMWB4FthqkdvIrHHEinQ70BDW'),
(7, 'Testtest', '$2y$10$PtxUb7TRFt10Yuemet3uCuJ5WboMXsVvARyrJ3uG6ycupNtT0lEa2'),
(8, 'TesttestTesttest', '$2y$10$G0SrytXaSD1CYGUxViwS3eFsjE/VsjyucIbQ1aWpqVvSQUfyGotLe'),
(9, 'TESTTESTTEST', '$2y$10$Bz3FtAqKNLSqtkQ3IRFPLehEqfm8D/9KZMzTq2RpfFNAXx9TIZZF6'),
(10, 'Asgarrrr2', '$2y$10$lzAFe0PpFrj2pIw17v0MgOlL6ezgZe2ThlUF5sptd0shqQO8blDu6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Entity`
--
ALTER TABLE `Entity`
  ADD PRIMARY KEY (`_eID`);

--
-- Indexes for table `Floors`
--
ALTER TABLE `Floors`
  ADD PRIMARY KEY (`_fID`),
  ADD KEY `fmonster1` (`fmonster1`),
  ADD KEY `fmonster2` (`fmonster2`),
  ADD KEY `fmonster3` (`fmonster3`),
  ADD KEY `fmonster4` (`fmonster4`),
  ADD KEY `fmonster5` (`fmonster5`);

--
-- Indexes for table `Heros`
--
ALTER TABLE `Heros`
  ADD PRIMARY KEY (`_ID`),
  ADD KEY `_IDUser` (`_IDUser`),
  ADD KEY `baseEntity` (`baseEntity`);

--
-- Indexes for table `Inventory`
--
ALTER TABLE `Inventory`
  ADD PRIMARY KEY (`_iID`),
  ADD KEY `_iEID` (`_iEID`),
  ADD KEY `_iSID` (`_iSID`);

--
-- Indexes for table `Stuffs`
--
ALTER TABLE `Stuffs`
  ADD PRIMARY KEY (`_sID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Entity`
--
ALTER TABLE `Entity`
  MODIFY `_eID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Heros`
--
ALTER TABLE `Heros`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `Inventory`
--
ALTER TABLE `Inventory`
  MODIFY `_iID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `Stuffs`
--
ALTER TABLE `Stuffs`
  MODIFY `_sID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Floors`
--
ALTER TABLE `Floors`
  ADD CONSTRAINT `floors_ibfk_1` FOREIGN KEY (`fmonster1`) REFERENCES `entity` (`_eID`),
  ADD CONSTRAINT `floors_ibfk_2` FOREIGN KEY (`fmonster2`) REFERENCES `entity` (`_eID`),
  ADD CONSTRAINT `floors_ibfk_3` FOREIGN KEY (`fmonster3`) REFERENCES `entity` (`_eID`),
  ADD CONSTRAINT `floors_ibfk_4` FOREIGN KEY (`fmonster4`) REFERENCES `entity` (`_eID`),
  ADD CONSTRAINT `floors_ibfk_5` FOREIGN KEY (`fmonster5`) REFERENCES `entity` (`_eID`);

--
-- Constraints for table `Heros`
--
ALTER TABLE `Heros`
  ADD CONSTRAINT `heros_ibfk_1` FOREIGN KEY (`baseEntity`) REFERENCES `entity` (`_eID`),
  ADD CONSTRAINT `heros_ibfk_2` FOREIGN KEY (`_IDUser`) REFERENCES `users` (`_ID`);

--
-- Constraints for table `Inventory`
--
ALTER TABLE `Inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`_iEID`) REFERENCES `Heros` (`_ID`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`_iSID`) REFERENCES `Stuffs` (`_sID`);
