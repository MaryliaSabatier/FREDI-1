-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 21 oct. 2021 à 13:46
-- Version du serveur :  10.4.16-MariaDB
-- Version de PHP : 7.4.12

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
CREATE DATABASE IF NOT EXISTS `fredi21` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fredi21`;

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE `adherent` (
  `id_adherent` int(11) NOT NULL,
  `nr_licence` varchar(50) DEFAULT NULL,
  `adr1` varchar(50) DEFAULT NULL,
  `adr2` varchar(50) DEFAULT NULL,
  `adr3` varchar(50) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_club` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id_adherent`, `nr_licence`, `adr1`, `adr2`, `adr3`, `id_utilisateur`, `id_club`) VALUES
(2, NULL, '44 rue emie zola', '11100', 'Narbonne', 2, 1),
(3, NULL, '81 rue des cyprès', '11000', 'Carcassonne', 3, 1),
(4, NULL, '44 rue emie zola', '11100', 'Narbonne', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `role` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `mdp`, `mail`, `nom`, `prenom`, `role`) VALUES
(2, 'fandefoot1', '$2y$10$wIFe13LxVglt9n6eMHEbS.L4SJCRvFSDpnGXAn6Hr86l/T8Ou0lhW', 'michel@gmail.com ', 'michel', 'durant', NULL),
(3, 'jeremvolley', '$2y$10$g6lu9S9z0q/zEeLyKKrhQeFbZKy.SkvSW/4uit8UqNsZ62JEbAQEC', 'jeremydurant@fredi.com', 'jeremy', 'dupont', 1),
(4, 'd.dutertre', '$2y$10$KBYotb6pbZVHo61QqdYrQez3CEtJmN2kESm6hcgmkdWmj40r59odK', 'damien.dutertre@fredi.com', 'Dutertre', 'dutertre', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`id_adherent`),
  ADD KEY `fk_id_utilisateur2` (`id_utilisateur`),
  ADD KEY `fk_id_club` (`id_club`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adherent`
--
ALTER TABLE `adherent`
  MODIFY `id_adherent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD CONSTRAINT `fk_id_club` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`),
  ADD CONSTRAINT `fk_id_utilisateur2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
