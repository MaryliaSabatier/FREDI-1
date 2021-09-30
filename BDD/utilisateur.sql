-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 30 sep. 2021 à 16:35
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fredi21`
--
CREATE DATABASE IF NOT EXISTS `fredi21` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fredi21`;

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE IF NOT EXISTS `adherent` (
  `id_adherent` int(11) NOT NULL AUTO_INCREMENT,
  `nr_licence` varchar(50) DEFAULT NULL,
  `adr1` varchar(50) DEFAULT NULL,
  `adr2` varchar(50) DEFAULT NULL,
  `adr3` varchar(50) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_club` int(11) NOT NULL,
  PRIMARY KEY (`id_adherent`),
  KEY `fk_id_utilisateur2` (`id_utilisateur`),
  KEY `fk_id_club` (`id_club`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id_adherent`, `nr_licence`, `adr1`, `adr2`, `adr3`, `id_utilisateur`, `id_club`) VALUES
(5, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 5, 5),
(6, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 5, 5),
(7, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 5, 5),
(8, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 5, 5),
(9, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 5, 5),
(10, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 5, 5),
(11, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 5, 5),
(12, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 42, 5),
(13, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 43, 5),
(14, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 44, 5),
(15, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 45, 5),
(16, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 46, 5),
(17, NULL, '25 avenue Emile Dewoitine', '31200', 'Toulouse', 47, 5);

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE IF NOT EXISTS `club` (
  `id_club` int(11) NOT NULL AUTO_INCREMENT,
  `lib_club` varchar(50) DEFAULT NULL,
  `adr1` varchar(50) DEFAULT NULL,
  `adr2` varchar(50) DEFAULT NULL,
  `adr3` varchar(50) DEFAULT NULL,
  `id_ligue` int(11) NOT NULL,
  PRIMARY KEY (`id_club`),
  KEY `fk_id_ligue` (`id_ligue`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `club`
--

INSERT INTO `club` (`id_club`, `lib_club`, `adr1`, `adr2`, `adr3`, `id_ligue`) VALUES
(5, 'oui', NULL, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Structure de la table `ligne`
--

DROP TABLE IF EXISTS `ligne`;
CREATE TABLE IF NOT EXISTS `ligne` (
  `id_ligne` int(11) NOT NULL AUTO_INCREMENT,
  `dat_ligne` date DEFAULT NULL,
  `lib_trajet` varchar(50) DEFAULT NULL,
  `nb_km` int(11) DEFAULT NULL,
  `mt_km` decimal(15,2) DEFAULT NULL,
  `mt_peage` decimal(15,2) DEFAULT NULL,
  `mt_repas` decimal(15,2) DEFAULT NULL,
  `mt_hebergement` decimal(15,2) DEFAULT NULL,
  `mt_total` decimal(15,2) DEFAULT NULL,
  `id_motif` int(11) NOT NULL,
  `id_note` int(11) NOT NULL,
  PRIMARY KEY (`id_ligne`),
  KEY `fk_id_motif` (`id_motif`),
  KEY `fk_id_note` (`id_note`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

DROP TABLE IF EXISTS `ligue`;
CREATE TABLE IF NOT EXISTS `ligue` (
  `id_ligue` int(11) NOT NULL AUTO_INCREMENT,
  `lib_ligue` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_ligue`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligue`
--

INSERT INTO `ligue` (`id_ligue`, `lib_ligue`) VALUES
(1, 'basket'),
(2, 'volley'),
(3, 'handball'),
(4, 'football');

-- --------------------------------------------------------

--
-- Structure de la table `motif`
--

DROP TABLE IF EXISTS `motif`;
CREATE TABLE IF NOT EXISTS `motif` (
  `id_motif` int(11) NOT NULL AUTO_INCREMENT,
  `lib_motif` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_motif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id_note` int(11) NOT NULL AUTO_INCREMENT,
  `est_valide` tinyint(1) DEFAULT NULL,
  `mt_total` decimal(15,2) DEFAULT NULL,
  `dat_remise` date DEFAULT NULL,
  `nr_ordre` int(11) DEFAULT NULL,
  `id_periode` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_note`),
  KEY `fk_id_periode` (`id_periode`),
  KEY `fk_id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

DROP TABLE IF EXISTS `periode`;
CREATE TABLE IF NOT EXISTS `periode` (
  `id_periode` int(11) NOT NULL AUTO_INCREMENT,
  `lib_periode` varchar(50) DEFAULT NULL,
  `est_active` tinyint(1) NOT NULL DEFAULT 0,
  `mt_km` decimal(8,3) DEFAULT NULL,
  PRIMARY KEY (`id_periode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `role` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `mdp`, `mail`, `nom`, `prenom`, `role`) VALUES
(2, 'az', '@F@q!&u5J63MaNd9', 'az', 'dadad', 'non', NULL),
(3, 'az', '$2y$10$8KPH/.yMyu4voGZ1WHW0jeWYPwL/Z9Y4jQLUlXHV0LtzleUu.Gg7S', 'LNR', 'dadad', 'non', NULL),
(4, 'az', '$2y$10$m5Iv4sv1ndrzbtje78G2/ehKge3Ji9rg9ieqAsX0N/xr8be4Dho5y', 'LNR', 'dadad', 'non', NULL),
(5, 'az', '$2y$10$iwjY9PzR95L3Gj692sz5KeFTUE4opv7EAgCz/9kb0YS1j7FU9OlBa', 'LNR', 'dadad', 'non', NULL),
(6, 'az', '$2y$10$XQUIsKsvjVgpoF45mO8RRO3Z/2wE9n/DHmli7ffYouaYzosNuferS', 'LNR', 'dadad', 'non', NULL),
(7, 'az', '$2y$10$cBh/liVQUvSrnoX4f.rpgu8uPgBTwOy4ZdNurhEI4ll9QqyBLfiOO', 'LNReeee', 'dadad', 'non', NULL),
(8, 'az', '$2y$10$FGfFUveotjatJGrkSu.1D.uDFbF.N3qpze5VC8B4eDN1XlzEqnz1W', 'LNReeee', 'dadad', 'non', NULL),
(9, 'az', '$2y$10$WhnSfKkt62XfA6fmC7xZeOaSlV3CuqMyPWVbAt.r2Tg09Yp3EbeHa', 'LNReeee', 'dadad', 'non', NULL),
(10, 'az', '$2y$10$p9LjbzvScuug5T6pP8rneezX9TYG7iLtQ9IFqWOofU9V5Azfh14sy', 'LNReeee', 'dadad', 'non', NULL),
(11, 'az', '$2y$10$AnAVuLyM8.i.xib6BahRv.7qHYdGDrNp1ERLw0jtAq/KV5CIW2lvG', 'LNReeee', 'dadad', 'non', NULL),
(12, 'az', '$2y$10$vprEt.ks9OtbIODsOZrqieLELzOLK0ByDCI6NQ3KhDvbuUv5mc.F.', 'LNReeee', 'dadad', 'non', NULL),
(13, 'az', '$2y$10$smWOvrYdnQ4LIP/cZ3/8iuNoZ/aRkIawGdWZZJ/ca1hUC.9N/FyqK', 'LNReeee', 'dadad', 'non', NULL),
(14, 'az', '$2y$10$n8WlJ97oHj9GKZnOB3ZOg.WCS2XO6J./4r5u/queGXyiQMJ0Z6Ep6', 'LNReeee', 'dadad', 'non', NULL),
(15, 'az', '$2y$10$PugxyZ3yoMKuYchntxNh8e4yxU6r4n45gVkUvQJ.de/PGkUnH.Wgy', 'LNR', 'dadad', 'non', NULL),
(16, 'az', '$2y$10$rT5oDkt/ES1LM8ylOgb6N.0O0incUuCeJt1fo7jUf7IAamApygXoS', 'LNR', 'dadad', 'non', NULL),
(17, 'az', '$2y$10$7.RJgUbUAppWdJ41ilZ63O85NnaN8gB2eas5wAlOn01uJYwdsHocu', 'LNR', 'dadad', 'non', NULL),
(18, 'az', '$2y$10$nPNsYckCm8yGFoKRMUqdZuUAnkzbfJkezpDHUu4xLWwc36XUZkDTG', 'LNR', 'dadad', 'non', NULL),
(19, 'az', '$2y$10$oudqDPF1XurHqx9N6SV0eehX0OE2g2dfvuNVWqIzKCF1kVHdo12..', 'LNR', 'dadad', 'non', NULL),
(20, 'az', '$2y$10$9bTS5XkxhuYqW4NHPiZE0.j9NdXUOgaohWa/xTExDJ7Uevw//fo.6', 'LNR', 'dadad', 'non', NULL),
(21, 'az', '$2y$10$00cNgzqieDcuK6Ut0emKdeH5vrdmDUUbLYZe7qSq5QntT9iFE7R6u', 'LNR', 'dadad', 'non', NULL),
(22, 'az', '$2y$10$cC6XW6pchyfGUzwvJIIKlO2CdSfHkcTnHgA3o33UbV5xOsJNxiSl6', 'LNR', 'dadad', 'non', NULL),
(23, 'adminfoot', '$2y$10$9ZF2amX/fjIRvwc5Q09lEO1wwh/3Yxm0sG3ObEIPy4vLEJkbuKEce', 'azzzzz', 'oui', 'adadada', NULL),
(24, 'adminfoot', '$2y$10$lbIgcaxsblo6Iiyt2GtgR.owpgwU3vVDj2El1LWTlIVbsvgTvkIdK', 'azzzzz', 'oui', 'adadada', NULL),
(25, 'adminfoot', '$2y$10$Um1fNHbGc5uGYQoGsWJILOjGMdE5mMLYH4EZZFeMCQG4xmT2LpYhm', 'azzzzz', 'oui', 'adadada', NULL),
(26, 'adminfoot', '$2y$10$ld0GryHfRkeUBKFzgy.OAuCBA3227tzpdOg6TaJZMyN3SHu9uYzD2', 'azzzzz', 'oui', 'adadada', NULL),
(27, 'adminfoot', '$2y$10$qtwukpVSxZtcYYwDtsjrG.RErV4VWqRP9QX4vThKSWo7QfSx/mrYi', 'azzzzz', 'oui', 'adadada', NULL),
(28, 'superadmin', '$2y$10$8b9BIzjysVelvrULkX0TEuDYU6W8qjhCMwe8WGFOJgxuGMQBzJXWy', 'azezezeeee', 'dadad', 'non', NULL),
(29, 'az', '$2y$10$j7KNebKpwOY7R9zkKlrT/OFIKTOBUXPKsDTyUVSF.QIy6e99vKryu', 'LNR', 'dadad', 'non', NULL),
(30, 'az', '$2y$10$L.sBp2zt32bAhmEz./eI/.lhjn/xBVqHORirdK1.6lZXWQn/9QlGW', 'LNR', 'dadad', 'non', NULL),
(31, 'az', '$2y$10$vdObsRXMQRBzZPOacgZiVum.LYJGnqBSC87bfs8l.38iA8lE0AnYu', 'LNR', 'dadad', 'non', NULL),
(32, 'az', '$2y$10$UZqRVoLRkTvZEzplzeHeruQUEu5jcsaaiOXdYqaOmczEojLHzRv3O', 'LNR', 'dadad', 'non', NULL),
(33, 'az', '$2y$10$b/w4fa8EB5/qBOxQvk7Wl.QyFSHvxkm85Omx/vvuopCCm/PmYkP2e', 'LNR', 'dadad', 'non', NULL),
(34, 'az', '$2y$10$mNfGXOcsxO4PfG5OXUNK8u6yn42.s7rldNrJ1Jzl2rH6niW9itQpy', 'LNR', 'dadad', 'non', NULL),
(35, 'az', '$2y$10$my1.vZgdEkxDi6IJrm7rked8FSmb1eNaRv5HPVfujStx70ggxvq7i', 'LNRzz', 'dadad', 'non', NULL),
(36, 'az', '$2y$10$dr0TkVtDUoyEi5OCarVKyOELGmcJgWkk5cB5kcd5.uJNRzh91G0xa', 'LNRzz', 'dadad', 'non', NULL),
(37, 'az', '$2y$10$/eYu1HdhUX4C3Ia78jjDXuZK/QxBrsSQBnW0wqBiSwJmIw8o2hAJW', 'LNRzz', 'dadad', 'non', NULL),
(38, 'az', '$2y$10$DvaoSY84v7LweQ1UpIPTBOHBb0jFPll6Gk6PFCdWKGrnU6ynRuEyu', 'LNRzz', 'dadad', 'non', NULL),
(39, 'az', '$2y$10$m1qs6l6e.Sa4goRgIXhJAOtE9gi0rWgLiVXyCPQoYtqOZRuduyVWa', 'LNRzz', 'dadad', 'non', NULL),
(40, 'az', '$2y$10$pRTycO0xdCI4E0I/wHklsOcTkv7k66Oz0n.JIo/yDkcw/Ow4TytLa', 'LNRzz', 'dadad', 'non', NULL),
(41, 'az', '$2y$10$dGmFjlWITDWqHD7kwwqArO/2pVB8EJf.6/amU2PVnAQIcwKQkr3DW', 'LNRzz', 'dadad', 'non', NULL),
(42, 'azzezeze', '$2y$10$c90.cqIgi0kaWabdNutDUOexrC4bh0aWBXXjJCtnh5FoywYkZHqS2', 'LNRzeezezeze', 'dadad', 'non', NULL),
(43, 'azezaezaeaezae', '$2y$10$gEdFMHTTg/BafwEXKdqcMudB90UtAtq59qMRRWbqAP2IxeqdYHCzC', 'azezeaaz@ezz', 'ezaeazezaezae', 'zeazeazeaze', NULL),
(44, 'aaaaaaaaaaaaaaaaaaaaaaaaaa', '$2y$10$uVjhMP8e10lxDgSA99oN1u2FcvyzifrbzqsplXqONDD8NFXlS1GJu', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'ezaeazezaezaeaaaaaa', 'zeazeazeazeaaaaaa', NULL),
(45, 'damienzzzzzzezezez', '$2y$10$omYe98VMBP8eBbr7eykCk./uqOnYrsVnnto06f6jTw09SyWW9uRJK', 'uhzdahbdzhjzabdbzadzadbazbdaujzbdzabdh', 'ezaeazezaezaezdzdzddzdddddddddmmopoiiiivbvvvvvv', 'zeazeazeazevvvvgfggg', NULL),
(46, 'zkroz1entt', '$2y$10$aHTL0ExIp8VcYnn4jgzpAujnu.VkB1Sfj78K0KakhzwgRjxAPVVni', 'damiendutertre31@gmail.com', 'damien', 'dutertre', NULL),
(47, 'zkroz1ent', '$2y$10$67tYsjveic1Wh16IlDGyROsLKwTwjqeEzq/sdTI09U7aohSsh5J7.', 'damien1234', 'azertyuiop', 'azertyuiop', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD CONSTRAINT `fk_id_club` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`),
  ADD CONSTRAINT `fk_id_utilisateur2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `fk_id_ligue` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`);

--
-- Contraintes pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD CONSTRAINT `fk_id_motif` FOREIGN KEY (`id_motif`) REFERENCES `motif` (`id_motif`),
  ADD CONSTRAINT `fk_id_note` FOREIGN KEY (`id_note`) REFERENCES `note` (`id_note`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk_id_periode` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`),
  ADD CONSTRAINT `fk_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
