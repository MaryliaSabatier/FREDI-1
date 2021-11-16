DELIMITER |
CREATE OR REPLACE TRIGGER Ligne_de_frais_insert BEFORE INSERT
ON ligne FOR EACH ROW
BEGIN

/* date dans l’année de la période */
DECLARE v_annee int;
DECLARE v_annee2 int;
DECLARE v_longeurLibTrajet int;
declare v_nb_km int;
declare v_mt_km int;
declare v_mt_total int;


/* on selectionne l'année de la periode en cours et l'annee que l'utilisateur essaye de entrer  */
SELECT YEAR(new.date_ligne) into v_annee from ligne where id_ligne = new.id_ligne;
SELECT YEAR(lib_periode) into v_annee2 FROM periode WHERE est_active = "oui" ;

if (v_annee <> v_annee2) /* Si l'année de la periode en cours est différente de l'année entrer par l'utilisateur  */
then 
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'la date de la ligne de frais doit être la meme que la periode en cours'; /* message d'erreur */
END if;

/* vérifie la longueur du lib_trajet */


SELECT CHAR_LENGTH(new.lib_trajet) into v_longeurLibTrajet from ligne where id_ligne = new.id_ligne;

if(v_longeurLibTrajet <= 5)
then
    SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'le libelle du trajet doit faire plus de 5 caracteres';
END if;

IF (new.nb_km<=0) 
THEN 
    SIGNAL SQLSTATE '45002' SET MESSAGE_TEXT = 'le nombre de kilometre doit être superieur à 0' ;  
END IF ;  

IF (new.mt_peage<=0) 
THEN 
SIGNAL SQLSTATE '45003' SET MESSAGE_TEXT = 'le montant du péage doit être superieur à 0' ;  
END IF ; 

IF (new.mt_hebergement<=0) 
THEN 
SIGNAL SQLSTATE '45004' SET MESSAGE_TEXT = "le montant de l'herbergement doit être superieur à 0" ;  
END IF ;

IF (new.mt_repas<=0) 
THEN 
SIGNAL SQLSTATE '45005' SET MESSAGE_TEXT = "le montant des repas doit être superieur à 0" ;  
END IF ;


SELECT new.nb_km into v_nb_km FROM ligne WHERE id_ligne = new.id_ligne;
SELECT mt_km into v_mt_km from periode where est_active = "oui";

SET new.mt_km = v_nb_km * v_nb_km; 

SELECT mt_km, mt_peage, mt_repas, mt_hebergement from ligne where id_ligne = new.id_ligne ;

SET new.mt_total = mt_km + mt_peage + mt_repas + mt_hebergement;

END 