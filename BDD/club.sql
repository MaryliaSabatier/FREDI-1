USE `fredi21`;

ALTER TABLE fredi21.club DROP FOREIGN KEY IF EXISTS fk_id_ligue;
ALTER TABLE fredi21.adherent DROP FOREIGN KEY IF EXISTS fk_id_club;

DROP TABLE IF EXISTS `club`;

DROP TABLE IF EXISTS `club`;
CREATE TABLE `club` (
  `id_club` int(11) NOT NULL PRIMARY KEY,
  `lib_club` varchar(50) DEFAULT NULL,
  `adr1` varchar(50) DEFAULT NULL,
  `adr2` varchar(50) DEFAULT NULL,
  `adr3` varchar(50) DEFAULT NULL,
  `id_ligue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



ALTER TABLE `club` MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT;



ALTER TABLE`club` ADD CONSTRAINT `fk_id_ligue` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`); 
ALTER TABLE`adherent` ADD CONSTRAINT `fk_id_club` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`);