-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 16 sep. 2021 à 16:27
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fredii`
--
CREATE DATABASE IF NOT EXISTS `fredii` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fredii`;

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE `adherent` (
  `ID_personne` int(11) NOT NULL,
  `CLUB` varchar(50) NOT NULL,
  `numero_licence` int(11) NOT NULL,
  `adresse1` varchar(50) NOT NULL,
  `adresse2` varchar(50) NOT NULL,
  `adresse3` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `adresse_mail` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `typePerso` int(11) NOT NULL,
  `ID_clubs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `ID_personne` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `adresse_mail` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `typePerso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

DROP TABLE IF EXISTS `clubs`;
CREATE TABLE `clubs` (
  `ID_clubs` int(11) NOT NULL,
  `nom_clubs` varchar(50) NOT NULL,
  `adressPostclubs` varchar(50) NOT NULL,
  `ID_ligue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `controleur`
--

DROP TABLE IF EXISTS `controleur`;
CREATE TABLE `controleur` (
  `ID_personne` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `adresse_mail` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `typePerso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_de_frais`
--

DROP TABLE IF EXISTS `ligne_de_frais`;
CREATE TABLE `ligne_de_frais` (
  `id_ligue_de_frais` int(11) NOT NULL,
  `lib_ligue_de_frais` varchar(50) NOT NULL,
  `date_deplacement_ligueFrais` date NOT NULL,
  `nombre_km` float NOT NULL,
  `montant_frais_peage` float NOT NULL,
  `montant_repas` float NOT NULL,
  `montant_herbergement` float NOT NULL,
  `Id_note_de_frais` int(11) NOT NULL,
  `id_deplacement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

DROP TABLE IF EXISTS `ligue`;
CREATE TABLE `ligue` (
  `ID_ligue` int(11) NOT NULL,
  `Lib_ligue` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `motif_deplacement`
--

DROP TABLE IF EXISTS `motif_deplacement`;
CREATE TABLE `motif_deplacement` (
  `id_deplacement` int(11) NOT NULL,
  `lib_motif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `notes_de_frais`
--

DROP TABLE IF EXISTS `notes_de_frais`;
CREATE TABLE `notes_de_frais` (
  `Id_note_de_frais` int(11) NOT NULL,
  `valide` varchar(50) NOT NULL,
  `montant_tt` int(11) NOT NULL,
  `date_remise` date NOT NULL,
  `Num_Ordre` int(11) NOT NULL,
  `ID_personne` int(11) NOT NULL,
  `id_periodeFisc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `periode_fiscale`
--

DROP TABLE IF EXISTS `periode_fiscale`;
CREATE TABLE `periode_fiscale` (
  `id_periodeFisc` int(11) NOT NULL,
  `libPeriodeFisc` varchar(50) NOT NULL,
  `periode` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE `personne` (
  `ID_personne` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `adresse_mail` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `typePerso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`ID_personne`),
  ADD KEY `ADHERENT_CLUBS0_FK` (`ID_clubs`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_personne`);

--
-- Index pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`ID_clubs`),
  ADD KEY `CLUBS_LIGUE_FK` (`ID_ligue`);

--
-- Index pour la table `controleur`
--
ALTER TABLE `controleur`
  ADD PRIMARY KEY (`ID_personne`);

--
-- Index pour la table `ligne_de_frais`
--
ALTER TABLE `ligne_de_frais`
  ADD PRIMARY KEY (`id_ligue_de_frais`),
  ADD KEY `LiGNE_DE_FRAIS_Notes_de_frais_FK` (`Id_note_de_frais`),
  ADD KEY `LiGNE_DE_FRAIS_motif_deplacement0_FK` (`id_deplacement`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`ID_ligue`);

--
-- Index pour la table `motif_deplacement`
--
ALTER TABLE `motif_deplacement`
  ADD PRIMARY KEY (`id_deplacement`);

--
-- Index pour la table `notes_de_frais`
--
ALTER TABLE `notes_de_frais`
  ADD PRIMARY KEY (`Id_note_de_frais`),
  ADD KEY `Notes_de_frais_ADHERENT_FK` (`ID_personne`),
  ADD KEY `Notes_de_frais_PERIODE_FISCALE0_FK` (`id_periodeFisc`);

--
-- Index pour la table `periode_fiscale`
--
ALTER TABLE `periode_fiscale`
  ADD PRIMARY KEY (`id_periodeFisc`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`ID_personne`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `ID_clubs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligne_de_frais`
--
ALTER TABLE `ligne_de_frais`
  MODIFY `id_ligue_de_frais` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligue`
--
ALTER TABLE `ligue`
  MODIFY `ID_ligue` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `motif_deplacement`
--
ALTER TABLE `motif_deplacement`
  MODIFY `id_deplacement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notes_de_frais`
--
ALTER TABLE `notes_de_frais`
  MODIFY `Id_note_de_frais` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `periode_fiscale`
--
ALTER TABLE `periode_fiscale`
  MODIFY `id_periodeFisc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `ID_personne` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD CONSTRAINT `ADHERENT_CLUBS0_FK` FOREIGN KEY (`ID_clubs`) REFERENCES `clubs` (`ID_clubs`),
  ADD CONSTRAINT `ADHERENT_personne_FK` FOREIGN KEY (`ID_personne`) REFERENCES `personne` (`ID_personne`);

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `ADMIN_personne_FK` FOREIGN KEY (`ID_personne`) REFERENCES `personne` (`ID_personne`);

--
-- Contraintes pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `CLUBS_LIGUE_FK` FOREIGN KEY (`ID_ligue`) REFERENCES `ligue` (`ID_ligue`);

--
-- Contraintes pour la table `controleur`
--
ALTER TABLE `controleur`
  ADD CONSTRAINT `CONTROLEUR_personne_FK` FOREIGN KEY (`ID_personne`) REFERENCES `personne` (`ID_personne`);

--
-- Contraintes pour la table `ligne_de_frais`
--
ALTER TABLE `ligne_de_frais`
  ADD CONSTRAINT `LiGNE_DE_FRAIS_Notes_de_frais_FK` FOREIGN KEY (`Id_note_de_frais`) REFERENCES `notes_de_frais` (`Id_note_de_frais`),
  ADD CONSTRAINT `LiGNE_DE_FRAIS_motif_deplacement0_FK` FOREIGN KEY (`id_deplacement`) REFERENCES `motif_deplacement` (`id_deplacement`);

--
-- Contraintes pour la table `notes_de_frais`
--
ALTER TABLE `notes_de_frais`
  ADD CONSTRAINT `Notes_de_frais_ADHERENT_FK` FOREIGN KEY (`ID_personne`) REFERENCES `adherent` (`ID_personne`),
  ADD CONSTRAINT `Notes_de_frais_PERIODE_FISCALE0_FK` FOREIGN KEY (`id_periodeFisc`) REFERENCES `periode_fiscale` (`id_periodeFisc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
