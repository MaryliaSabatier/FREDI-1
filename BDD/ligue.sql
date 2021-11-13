USE `fredi21`; 
ALTER TABLE fredi21.club DROP FOREIGN KEY IF EXISTS fk_id_ligue ;




DROP TABLE if EXISTS ligue ;
CREATE TABLE `ligue` (
  `id_ligue` int(11) NOT NULL,
  `lib_ligue` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


  ALTER TABLE `ligue`
  ADD PRIMARY KEY (`id_ligue`);     
  
ALTER TABLE `ligue`
  MODIFY `id_ligue` int(11) NOT NULL AUTO_INCREMENT;



ALTER TABLE `ligue` ADD CONSTRAINT `fk_id_ligue` FOREIGN KEY (`id_ligue`) REFERENCES `club`(`id_ligue`) ;