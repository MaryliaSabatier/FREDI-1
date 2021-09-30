-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 sep. 2021 à 21:07
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

USE `fredi21`.'club';

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

--
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id_club`),
  ADD KEY `fk_id_ligue` (`id_ligue`);

--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour la table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `fk_id_ligue` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`);
