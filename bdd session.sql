-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci*/ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;

-- Listage de la structure de table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table forum.category : ~3 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'sciences'),
	(2, 'arts'),
	(3, 'politics');

-- Listage de la structure de table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `FK_post_user` (`user_id`),
  KEY `FK_post_topic` (`topic_id`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table forum.post : ~2 rows (environ)
INSERT INTO `post` (`id_post`, `content`, `creationdate`, `user_id`, `topic_id`) VALUES
	(1, 'yes', '2023-07-18 11:35:38', 1, 2),
	(2, 'no', '2023-07-18 11:35:48', 1, 2);

-- Listage de la structure de table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `locked` binary(50) NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `FK_topic_category` (`category_id`),
  KEY `FK_topic_user` (`user_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table forum.topic : ~2 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `locked`, `creationdate`, `category_id`, `user_id`) VALUES
	(1, 'is the earth flat?', _binary 0x3000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2023-07-18 10:51:14', 1, 1),
	(2, 'are elephants afraid of mice?', _binary 0x3000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2023-07-18 11:08:47', 1, 1);

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table forum.user : ~1 rows (environ)
INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `email`, `creationdate`) VALUES
	(1, 'erzr', 'aaaa', 'admin', 'erzr@gmail.com', '2023-07-18 10:50:38');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
