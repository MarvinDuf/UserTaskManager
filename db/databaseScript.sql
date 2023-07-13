-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 13 juil. 2023 à 15:05
-- Version du serveur : 8.0.33
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `user_task_manager`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `commentaryId` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `creationDate` date DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `taskId` int NOT NULL,
  `userId` int NOT NULL,
  PRIMARY KEY (`commentaryId`),
  KEY `taskId` (`taskId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `projectId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`projectId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `taskId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `creationDate` date DEFAULT NULL,
  `priority` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `complexity` varchar(50) DEFAULT NULL,
  `projectId` int NOT NULL,
  `userTaskCreatorId` int NOT NULL,
  `userInChargeId` int NOT NULL,
  PRIMARY KEY (`taskId`),
  KEY `projectId` (`projectId`),
  KEY `userTaskCreatorId` (`userTaskCreatorId`),
  KEY `userInChargeId` (`userInChargeId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `surname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `mail`, `role`, `name`, `surname`) VALUES
(1, 'admin', '$2y$10$tIsZPmtL2g3lz7NHEO5ImOX7rOifYyF7AaSMV12IZ64VWbh.e8t3e', 'titi.toto@mail.com', 'admin', 'toto', 'titi');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`taskId`) REFERENCES `tasks` (`taskId`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`projectId`) REFERENCES `projects` (`projectId`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`userTaskCreatorId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`userInChargeId`) REFERENCES `users` (`userId`);
COMMIT;


INSERT INTO `users` (`userId`, `username`, `password`, `mail`, `role`, `name`, `surname`) VALUES
(1, 'admin', '$2y$10$tIsZPmtL2g3lz7NHEO5ImOX7rOifYyF7AaSMV12IZ64VWbh.e8t3e', 'titi.toto@mail.com', 'admin', 'toto', 'titi');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;