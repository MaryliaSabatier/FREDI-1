

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

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE `club` (
  `id_club` int(11) NOT NULL,
  `lib_club` varchar(50) DEFAULT NULL,
  `adr1` varchar(50) DEFAULT NULL,
  `adr2` varchar(50) DEFAULT NULL,
  `adr3` varchar(50) DEFAULT NULL,
  `id_ligue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligne`
--

DROP TABLE IF EXISTS `ligne`;
CREATE TABLE `ligne` (
  `id_ligne` int(11) NOT NULL,
  `dat_ligne` date DEFAULT NULL,
  `lib_trajet` varchar(50) DEFAULT NULL,
  `nb_km` int(11) DEFAULT NULL,
  `mt_km` decimal(15,2) DEFAULT NULL,
  `mt_peage` decimal(15,2) DEFAULT NULL,
  `mt_repas` decimal(15,2) DEFAULT NULL,
  `mt_hebergement` decimal(15,2) DEFAULT NULL,
  `mt_total` decimal(15,2) DEFAULT NULL,
  `id_motif` int(11) NOT NULL,
  `id_note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

DROP TABLE IF EXISTS `ligue`;
CREATE TABLE `ligue` (
  `id_ligue` int(11) NOT NULL,
  `lib_ligue` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `motif`
--



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
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id_club`),
  ADD KEY `fk_id_ligue` (`id_ligue`);

--
-- Index pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD PRIMARY KEY (`id_ligne`),
  ADD KEY `fk_id_motif` (`id_motif`),
  ADD KEY `fk_id_note` (`id_note`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`id_ligue`);




--



--


--
--

--
-- AUTO_INCREMENT pour la table `adherent`
--
ALTER TABLE `adherent`
  MODIFY `id_adherent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligne`
--
ALTER TABLE `ligne`
  MODIFY `id_ligne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligue`
--
ALTER TABLE `ligue`
  MODIFY `id_ligue` int(11) NOT NULL AUTO_INCREMENT;



--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT;

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


INSERT INTO ligue (id_ligue, lib_ligue) VALUES ('1', 'Ligue de Judo Auvergne-Rhône-Alpes'), ('2', 'Ligue de footbal de Haute-Garonne'), ('3', 'Ligue de footbal Aquitaine'), ('4', 'Ligue de tennis de Corse du Sud'), ('5', 'Ligue équitation du Var'), ('6', 'Ligue de natation du Quercy');



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

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE `club` (
  `id_club` int(11) NOT NULL,
  `lib_club` varchar(50) DEFAULT NULL,
  `adr1` varchar(50) DEFAULT NULL,
  `adr2` varchar(50) DEFAULT NULL,
  `adr3` varchar(50) DEFAULT NULL,
  `id_ligue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligne`
--

DROP TABLE IF EXISTS `ligne`;
CREATE TABLE `ligne` (
  `id_ligne` int(11) NOT NULL,
  `dat_ligne` date DEFAULT NULL,
  `lib_trajet` varchar(50) DEFAULT NULL,
  `nb_km` int(11) DEFAULT NULL,
  `mt_km` decimal(15,2) DEFAULT NULL,
  `mt_peage` decimal(15,2) DEFAULT NULL,
  `mt_repas` decimal(15,2) DEFAULT NULL,
  `mt_hebergement` decimal(15,2) DEFAULT NULL,
  `mt_total` decimal(15,2) DEFAULT NULL,
  `id_motif` int(11) NOT NULL,
  `id_note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

DROP TABLE IF EXISTS `ligue`;
CREATE TABLE `ligue` (
  `id_ligue` int(11) NOT NULL,
  `lib_ligue` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `motif`
--



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
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id_club`),
  ADD KEY `fk_id_ligue` (`id_ligue`);

--
-- Index pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD PRIMARY KEY (`id_ligne`),
  ADD KEY `fk_id_motif` (`id_motif`),
  ADD KEY `fk_id_note` (`id_note`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`id_ligue`);




--



--


--
--

--
-- AUTO_INCREMENT pour la table `adherent`
--
ALTER TABLE `adherent`
  MODIFY `id_adherent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligne`
--
ALTER TABLE `ligne`
  MODIFY `id_ligne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligue`
--
ALTER TABLE `ligue`
  MODIFY `id_ligue` int(11) NOT NULL AUTO_INCREMENT;



--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT;

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


INSERT INTO ligue (id_ligue, lib_ligue) VALUES ('1', 'Ligue de Judo Auvergne-Rhône-Alpes'), ('2', 'Ligue de footbal de Haute-Garonne'), ('3', 'Ligue de footbal Aquitaine'), ('4', 'Ligue de tennis de Corse du Sud'), ('5', 'Ligue équitation du Var'), ('6', 'Ligue de natation du Quercy');

