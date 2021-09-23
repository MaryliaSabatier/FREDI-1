-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 30 mars 2021 à 14:43
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `m2l`
--
CREATE DATABASE IF NOT EXISTS `m2l` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `m2l`;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE `faq` (
  `id_faq` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `reponse` varchar(100) DEFAULT NULL,
  `dat_question` datetime DEFAULT NULL,
  `dat_reponse` datetime DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`id_faq`, `question`, `reponse`, `dat_question`, `dat_reponse`, `id_user`) VALUES
(16, 'Quelle est la taille de la cage de foot ?', NULL, '2021-03-30 14:10:39', NULL, 23),
(17, 'Quelle est la durée d\'un match de handball ?', 'Deux mi-temps de 30 minutes', '2021-03-30 14:11:55', '2021-03-30 14:13:39', 27),
(18, 'Quelle est la taille des paniers de basket ?', NULL, '2021-03-30 14:15:57', NULL, 33),
(19, 'Quelle est le poids d\'un ballon de volley ?', NULL, '2021-03-30 14:17:27', NULL, 30),
(20, 'Combien de fois l’Équipe de France est-elle arrivée en finale de la Coupe du monde ?\r\n', '3 fois', '2021-03-30 14:25:19', '2021-03-30 14:25:55', 29),
(21, 'Combien de joueurs y a-t-il sur le terrain par équipe ?', NULL, '2021-03-30 14:28:15', NULL, 28),
(22, 'Dans quel pays le Volley-Ball a-t-il été inventé ?', 'Les Etats-Unis', '2021-03-30 14:31:16', '2021-03-30 14:42:37', 31),
(23, 'Qui a été élu MVP de la finale des Playoffs ? (2006-2007)', 'Tony Parker', '2021-03-30 14:34:05', '2021-03-30 14:42:34', 32);

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

DROP TABLE IF EXISTS `ligue`;
CREATE TABLE `ligue` (
  `id_ligue` int(11) NOT NULL,
  `lib_ligue` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ligue`
--

INSERT INTO `ligue` (`id_ligue`, `lib_ligue`) VALUES
(1, 'Toutes les ligues'),
(2, 'Ligue de basket'),
(3, 'Ligue de volley'),
(4, 'Ligue de handball'),
(5, 'Ligue de football');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `id_usertype` int(11) NOT NULL,
  `id_ligue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `mdp`, `mail`, `id_usertype`, `id_ligue`) VALUES
(1, 'superadmin', '$2y$10$rhZGD98tA/7Xqm0rmwVgMeQBbrsKh3pBnHTXvq98G50I8D0jhwE2C', 'superadmin@m2l.fr', 3, 1),
(2, 'adminfoot', '$2y$10$QG3z7jSHBnLlx18dBUGYUOfS5mvO6tM.P1DaDVB7rbaFIavvDoDo.', 'adminfoot@m2l.fr', 2, 5),
(5, 'adminhand', '$2y$10$nO/9EmwifUU6x400ggfT2efYbEkZIVdkK2zlZnFkWClcNgeC4rrgm', 'adminhand@m2l.fr', 2, 4),
(8, 'adminvolley', '$2y$10$tWzA1XxREBn6nBXfN2CFmeftfDm72cI6.WxrMFCj6Wwa//XM5VVB6', 'adminvolley@m2l.fr', 2, 3),
(20, 'adminbasket', '$2y$10$n/b8sKPZLP4ij.Uyo8S.fO7JneZxIlztdkDLpLnE2FvKwnxy3I2oG', 'adminbasket@m2l.fr', 2, 2),
(23, 'userfoot1', '$2y$10$W0/EKMkefiU1O8RBgvPbW.5Zn22P5Q3VrK4DpNROughkInSUPMgOW', 'userfoot1@m2l.fr', 1, 5),
(27, 'userhand1', '$2y$10$6alLdqKrdkL7XvzNKR4uh.KObw1JNLY5a8pc0DVDawy.kZng6UroG', 'userhand1@m2l.fr', 1, 4),
(28, 'userhand2', '$2y$10$cWIfr0gyk9BM6DtEWTGNB.TBuyMtNmrmGvv7nKGoMi8AtLwEhzrAC', 'userhand2@m2l.fr', 1, 4),
(29, 'userfoot2', '$2y$10$8iOcffzym7YoipQVV6Ewbe1tS3dGIYrRSzSeibhxR0GTrFbJtzz.q', 'userfoot2@m2l.fr', 1, 5),
(30, 'uservolley1', '$2y$10$WeF2I8ZBiHVMZGGr39pLCO6BSWadL6lzK52/laxvXGXnWXn2yT0O2', 'uservolley1@m2l.fr', 1, 3),
(31, 'uservolley2', '$2y$10$vq5OtVW.QhdQoxzqYVR0ce1vq1tT7jkfEXjCI3OkL/q6cak8c3RfK', 'uservolley2@m2l.fr', 1, 3),
(32, 'userbasket1', '$2y$10$6dOxYHoCbVf3a0DtQZ01J.QevJHmp/kBpOuZ6dkdlQs6757ODjZNG', 'userbasket1@m2l.fr', 1, 2),
(33, 'userbasket2', '$2y$10$NfdJWO0XU73O7adIFw8OsuFfMzWFfiMfsorQte0SK20rZOBjUXbi6', 'userbasket2@m2l.fr', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `usertype`
--

DROP TABLE IF EXISTS `usertype`;
CREATE TABLE `usertype` (
  `id_usertype` int(11) NOT NULL,
  `lib_usertype` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `usertype`
--

INSERT INTO `usertype` (`id_usertype`, `lib_usertype`, `description`) VALUES
(1, 'utilisateur', 'Utilisateur de base'),
(2, 'admin', 'Administrateur de ligue'),
(3, 'superadmin', 'Administrateur de toutes les ligues');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`),
  ADD KEY `faq_user_FK` (`id_user`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`id_ligue`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `user_usertype_FK` (`id_usertype`),
  ADD KEY `user_ligue0_FK` (`id_ligue`);

--
-- Index pour la table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id_usertype`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `ligue`
--
ALTER TABLE `ligue`
  MODIFY `id_ligue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id_usertype` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ligue0_FK` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`),
  ADD CONSTRAINT `user_usertype_FK` FOREIGN KEY (`id_usertype`) REFERENCES `usertype` (`id_usertype`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
