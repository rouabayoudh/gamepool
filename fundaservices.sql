-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 10 avr. 2024 à 16:03
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fundaservices`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `email`, `name`, `password`) VALUES
(1, 'bsamar206@gmail.com', 'samar', '$2y$10$jLOTvhBTgESQDG4BCpX4B.bv5pjIFVru.uESoz/wvcSaMbgfoP1jq'),
(2, 'roua.bayoudh@insat.ucar.tn', 'roua', '$2y$10$wC9XfrPpps6GGiSIyjZP.ekD0kpjAC6SwRpdUwITLQqbOhygHMYtq'),
(3, 'firaskasraoui@gmail.com', 'firas', '$2y$10$wC9XfrPpps6GGiSIyjZP.ekD0kpjAC6SwRpdUwITLQqbOhygHMYtq');

-- --------------------------------------------------------

--
-- Structure de la table `mybag`
--

CREATE TABLE `mybag` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mybag`
--

INSERT INTO `mybag` (`id`, `user_id`, `product_name`, `quantity`) VALUES
(1, 15, 'Evidence', 1),
(2, 15, 'GPS', 2),
(3, 15, 'Magnifier', 2),
(4, 15, 'Notebook', 1),
(5, 15, 'Sunglasses', 1),
(13, 16, 'Magnifier', 2),
(14, 16, 'GPS', 2),
(15, 16, 'Food', 2),
(16, 16, 'Evidence', 1),
(17, 16, 'Camera', 1),
(19, 17, 'Magnifier', 1),
(20, 17, 'Binoculars', 1),
(21, 17, 'Camera', 1),
(22, 17, 'Evidence', 1),
(23, 17, 'GPS', 1),
(24, 17, 'Food', 1),
(25, 17, 'Notebook', 1),
(26, 17, 'Phone', 1),
(27, 17, 'Hat', 1);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `pname`, `image`, `price`) VALUES
(1, 'Binoculars', 'binoculars.jpg', 0),
(2, 'Camera', 'camera.jpg', 0),
(3, 'Evidence', 'evidence.jpg', 0),
(4, 'Food', 'food.jpg', 15),
(5, 'GPS', 'gps.jpg', 30),
(6, 'Magnifier', 'magnifying.jpg', 55),
(7, 'Notebook', 'notebook.jpg', 25),
(8, 'Phone', 'phone.jpg', 75),
(9, 'Walkie-talkie', 'walkie.jpg', 35),
(10, 'Laptop', 'computer.jpg', 65),
(11, 'Hat', 'chapeau.jpg', 25),
(12, 'Sunglasses', 'lunettes.jpg', 75),
(13, 'Pipe', 'pipe.jpg', 100),
(14, 'Flashlight', 'torche.jpg', 50),
(15, 'Keys', 'cles.jpg', 50);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_ban` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=unban,1=ban',
  `role` varchar(255) NOT NULL COMMENT 'admin,user',
  `Score` int(11) NOT NULL DEFAULT 0,
  `message` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `is_ban`, `role`, `Score`, `message`, `type`, `created_at`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'sameh', '', '', 'sam', 0, '', 600, '', 2, '2024-04-03', NULL, NULL),
(15, 'tato', '90909090', 'tato@gmail.com', 'Tatto1', 0, '', 240, '', 1, '2024-04-09', NULL, NULL),
(16, 'feten', '90909090', 'feten@gmail.com', 'Feten1', 0, '', 0, '', 1, '2024-04-09', NULL, NULL),
(17, 'roua bayoudh', '+21628355169', 'rouabayoudh8@gmail.com', '12345Roua', 1, 'admin', 175, 'mmmmmmmm', 1, '2024-04-10', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `mybag`
--
ALTER TABLE `mybag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `mybag`
--
ALTER TABLE `mybag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `mybag`
--
ALTER TABLE `mybag`
  ADD CONSTRAINT `mybag_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
