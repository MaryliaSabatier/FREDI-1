

--
CREATE DATABASE IF NOT EXISTS `fredi21` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fredi21`;



INSERT INTO `adherent` (`id_adherent`, `nr_licence`, `adr1`, `adr2`, `adr3`, `id_utilisateur`, `id_club`) VALUES
(2, NULL, '44 rue emie zola', '11100', 'Narbonne', 2, 1),
(3, NULL, '81 rue des cyprès', '11000', 'Carcassonne', 3, 1),
(4, NULL, '44 rue emie zola', '11100', 'Narbonne', 4, 1);



INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `mdp`, `mail`, `nom`, `prenom`, `role`) VALUES
(2, 'fandefoot1', '$2y$10$wIFe13LxVglt9n6eMHEbS.L4SJCRvFSDpnGXAn6Hr86l/T8Ou0lhW', 'michel@gmail.com ', 'michel', 'durant', NULL),
(3, 'jeremvolley', '$2y$10$g6lu9S9z0q/zEeLyKKrhQeFbZKy.SkvSW/4uit8UqNsZ62JEbAQEC', 'jeremydurant@fredi.com', 'jeremy', 'dupont', 1),
(4, 'd.dutertre', '$2y$10$KBYotb6pbZVHo61QqdYrQez3CEtJmN2kESm6hcgmkdWmj40r59odK', 'damien.dutertre@fredi.com', 'Dutertre', 'dutertre', 2);
