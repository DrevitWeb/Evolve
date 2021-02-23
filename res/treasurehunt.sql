-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 fév. 2021 à 19:30
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
-- Base de données : `treasurehunt`
--

-- --------------------------------------------------------

--
-- Structure de la table `achievements`
--

DROP TABLE IF EXISTS `achievements`;
CREATE TABLE IF NOT EXISTS `achievements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `objective` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `identifier` text COLLATE utf32_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Achievement_player` (`player`),
  KEY `Achievement_objective` (`objective`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

DROP TABLE IF EXISTS `actions`;
CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf32_unicode_ci NOT NULL,
  `image` text COLLATE utf32_unicode_ci,
  `objective` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `next` varchar(30) COLLATE utf32_unicode_ci DEFAULT NULL,
  `token` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `Action_objective` (`objective`),
  KEY `Action_action` (`next`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `interacted`
--

DROP TABLE IF EXISTS `interacted`;
CREATE TABLE IF NOT EXISTS `interacted` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `interaction` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Interacted_interaction` (`interaction`),
  KEY `Interacted_player` (`player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `interactions`
--

DROP TABLE IF EXISTS `interactions`;
CREATE TABLE IF NOT EXISTS `interactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NPC` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `action` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `needs` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `token` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `Interaction_action` (`action`),
  KEY `Interaction_objective` (`needs`),
  KEY `Interaction_NPC` (`NPC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
CREATE TABLE IF NOT EXISTS `inventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `item` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Inventory_player` (`player`),
  KEY `Inventory_item` (`item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf32_unicode_ci NOT NULL,
  `description` text COLLATE utf32_unicode_ci NOT NULL,
  `image` text COLLATE utf32_unicode_ci NOT NULL,
  `token` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf32_unicode_ci NOT NULL,
  `description` text COLLATE utf32_unicode_ci NOT NULL,
  `link` text COLLATE utf32_unicode_ci NOT NULL,
  `type` text COLLATE utf32_unicode_ci NOT NULL,
  `token` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `market`
--

DROP TABLE IF EXISTS `market`;
CREATE TABLE IF NOT EXISTS `market` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `seller` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `token` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Market_item` (`item`),
  KEY `Market_seller` (`seller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `npcs`
--

DROP TABLE IF EXISTS `npcs`;
CREATE TABLE IF NOT EXISTS `npcs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf32_unicode_ci NOT NULL,
  `description` text COLLATE utf32_unicode_ci NOT NULL,
  `image` text COLLATE utf32_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `location` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `token` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `NPC_location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `objectives`
--

DROP TABLE IF EXISTS `objectives`;
CREATE TABLE IF NOT EXISTS `objectives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf32_unicode_ci NOT NULL,
  `description` text COLLATE utf32_unicode_ci NOT NULL,
  `location` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `reward` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `needs` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `token` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `Objective_location` (`location`),
  KEY `Objective_reward` (`reward`),
  KEY `Objective_item` (`needs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf32_unicode_ci NOT NULL,
  `surname` text COLLATE utf32_unicode_ci NOT NULL,
  `location` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `money` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `trapped` int(11) NOT NULL,
  `defended` int(11) NOT NULL,
  `user` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `token` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `last_play` timestamp NOT NULL,
  `origin` text COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `Player_location` (`location`),
  KEY `Player_user` (`user`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ranking`
--

DROP TABLE IF EXISTS `ranking`;
CREATE TABLE IF NOT EXISTS `ranking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text COLLATE utf32_unicode_ci NOT NULL,
  `rank` int(11) NOT NULL,
  `player` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Ranking_player` (`player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rewards`
--

DROP TABLE IF EXISTS `rewards`;
CREATE TABLE IF NOT EXISTS `rewards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reward_type` int(11) NOT NULL,
  `money` int(11) DEFAULT NULL,
  `item` varchar(30) COLLATE utf32_unicode_ci DEFAULT NULL,
  `token` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `Reward_item` (`item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf32_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf32_unicode_ci NOT NULL,
  `avatar` varchar(10) COLLATE utf32_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf32_unicode_ci NOT NULL,
  `birth_date` int(11) NOT NULL,
  `sign_date` int(11) NOT NULL,
  `last_seen` int(11) DEFAULT NULL,
  `token` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `grade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achievements`
--
ALTER TABLE `achievements`
  ADD CONSTRAINT `Achievement_objective` FOREIGN KEY (`objective`) REFERENCES `objectives` (`token`),
  ADD CONSTRAINT `Achievement_player` FOREIGN KEY (`player`) REFERENCES `players` (`token`);

--
-- Contraintes pour la table `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `Action_action` FOREIGN KEY (`next`) REFERENCES `actions` (`token`),
  ADD CONSTRAINT `Action_objective` FOREIGN KEY (`objective`) REFERENCES `objectives` (`token`);

--
-- Contraintes pour la table `interacted`
--
ALTER TABLE `interacted`
  ADD CONSTRAINT `Interacted_interaction` FOREIGN KEY (`interaction`) REFERENCES `interactions` (`token`),
  ADD CONSTRAINT `Interacted_player` FOREIGN KEY (`player`) REFERENCES `players` (`token`);

--
-- Contraintes pour la table `interactions`
--
ALTER TABLE `interactions`
  ADD CONSTRAINT `Interaction_NPC` FOREIGN KEY (`NPC`) REFERENCES `npcs` (`token`),
  ADD CONSTRAINT `Interaction_action` FOREIGN KEY (`action`) REFERENCES `actions` (`token`),
  ADD CONSTRAINT `Interaction_objective` FOREIGN KEY (`needs`) REFERENCES `objectives` (`token`);

--
-- Contraintes pour la table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `Inventory_item` FOREIGN KEY (`item`) REFERENCES `items` (`token`),
  ADD CONSTRAINT `Inventory_player` FOREIGN KEY (`player`) REFERENCES `players` (`token`);

--
-- Contraintes pour la table `market`
--
ALTER TABLE `market`
  ADD CONSTRAINT `Market_item` FOREIGN KEY (`item`) REFERENCES `items` (`token`),
  ADD CONSTRAINT `Market_seller` FOREIGN KEY (`seller`) REFERENCES `players` (`token`);

--
-- Contraintes pour la table `npcs`
--
ALTER TABLE `npcs`
  ADD CONSTRAINT `NPC_location` FOREIGN KEY (`location`) REFERENCES `locations` (`token`);

--
-- Contraintes pour la table `objectives`
--
ALTER TABLE `objectives`
  ADD CONSTRAINT `Objective_item` FOREIGN KEY (`needs`) REFERENCES `items` (`token`),
  ADD CONSTRAINT `Objective_location` FOREIGN KEY (`location`) REFERENCES `locations` (`token`),
  ADD CONSTRAINT `Objective_reward` FOREIGN KEY (`reward`) REFERENCES `rewards` (`token`);

--
-- Contraintes pour la table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `Player_location` FOREIGN KEY (`location`) REFERENCES `locations` (`token`),
  ADD CONSTRAINT `Plyer_user` FOREIGN KEY (`user`) REFERENCES `users` (`token`);

--
-- Contraintes pour la table `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `Ranking_player` FOREIGN KEY (`player`) REFERENCES `players` (`token`);

--
-- Contraintes pour la table `rewards`
--
ALTER TABLE `rewards`
  ADD CONSTRAINT `Reward_item` FOREIGN KEY (`item`) REFERENCES `items` (`token`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
