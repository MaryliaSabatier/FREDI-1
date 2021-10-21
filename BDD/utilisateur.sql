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
