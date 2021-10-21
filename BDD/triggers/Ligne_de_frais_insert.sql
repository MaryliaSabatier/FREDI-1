DELIMITER |
CREATE OR REPLACE TRIGGER Ligne_de_frais_insert BEFORE INSERT
ON ligne FOR EACH ROW
BEGIN
/* date dans l’année de la période */
DECLARE annee;
declare annee2;
/* on selectionne l'année de la periode en cours et la date que l'utilisateur essaye de entrer  */
SELECT YEAR(new.date_ligne) into annee from ligne where id_ligne = new.id_ligne;
SELECT YEAR(lib_periode) into annee2 FROM periode WHERE est_active = "oui" ;
if (annee <> annee2) /* Si l'année de la periode en cours est différente de l'année entrer par l'utilisateur  */
then 
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'la date de la ligne de frais doit être la meme que la periode en cours '; /* message d'erreur */
END if;


END |
