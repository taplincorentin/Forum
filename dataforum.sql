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
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;

-- Listage de la structure de table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.category : ~4 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'Sciences'),
	(2, 'Art'),
	(3, 'Politics'),
	(4, 'News');

-- Listage de la structure de table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `topic_id` int NOT NULL,
  `op` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_post`),
  KEY `FK__topic` (`topic_id`),
  KEY `FK__user` (`user_id`),
  CONSTRAINT `FK__topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `FK__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.post : ~9 rows (environ)
INSERT INTO `post` (`id_post`, `content`, `creationdate`, `user_id`, `topic_id`, `op`) VALUES
	(6, 'gghgze', '2023-07-25 10:11:37', 2, 5, 1),
	(8, 'serreereg', '2023-07-25 10:12:22', 2, 5, 0),
	(12, '-ry\'(y(er', '2023-07-25 14:20:28', 3, 8, 1),
	(13, '\'(-(y(', '2023-07-25 14:20:46', 5, 7, 1),
	(14, 'gfhfg', '2023-07-25 14:22:28', 3, 8, 1),
	(15, 'qz\'tz', '2023-07-25 14:49:31', 2, 9, 1),
	(16, 'okokokokokok', '2023-07-25 16:20:33', 5, 7, 0),
	(17, 'ddddddddd', '2023-07-25 16:25:01', 5, 10, 1),
	(18, 'eeeeeee', '2023-07-25 16:27:18', 5, 11, 1);

-- Listage de la structure de table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locked` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `FK_topic_category` (`category_id`),
  KEY `FK_topic_user` (`user_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE,
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.topic : ~6 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationdate`, `locked`, `category_id`, `user_id`) VALUES
	(5, 'louvre', '2023-07-25 10:11:37', 1, 2, 2),
	(7, 'yhtr', '2023-07-25 14:19:38', 0, 3, 3),
	(8, '-èi-(-ryt', '2023-07-25 14:19:56', 0, 1, 5),
	(9, 'srhdgd', '2023-07-25 14:22:10', 0, 4, 2),
	(10, 'gggggg', '2023-07-25 16:25:01', 0, 3, 5),
	(11, 'rtrtrtrrr', '2023-07-25 16:27:18', 0, 2, 5);

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'member',
  `email` varchar(50) NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.user : ~3 rows (environ)
INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `email`, `creationdate`) VALUES
	(2, 'coco', '$2y$10$B8PNKZ4WcsaOcBrlTa73AujqzTQyPMoC5RdO3WDs7zYhhaZcVQyt.', 'member', 'coco@gmail.com', '2023-07-24 11:08:11'),
	(3, 'greg', '$2y$10$Q.rxOvPJS24dmgyIU1hEC.5c6N8r0TWjf2ByjYrVSbdP6x4QYzq..', 'member', 'greg@gmail.com', '2023-07-24 11:10:25'),
	(5, 'cocoA', '$2y$10$F3C8kcG3Zl/j8S3NOhXRJuVDxRVdnXY0DU0NKyJGINIXUrNfJfGuO', 'admin', 'cocoA@gmail.com', '2023-07-25 14:09:05');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
