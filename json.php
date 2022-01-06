<?php
$page="notes_frais.php";
include 'init.php';
include 'sql.php';
include 'header.php';


$id=$_SESSION['user']['id_utilisateur'];
echo '<br>';
echo '<br>';
echo '<br>';

// Récupère la liste des lignes

$sql = "SELECT ligue.lib_ligue AS NomLigue, club.lib_club AS NomClub, motif.lib_motif AS NomMotif, periode.lib_periode AS Periode, SUM(ligne.mt_total) AS MtPeriode
FROM note,periode,club,adherent,motif,ligue,ligne
WHERE periode.est_active=1
AND ligne.id_note=note.id_note
AND ligne.id_motif=motif.id_motif
AND periode.id_periode=note.id_periode
AND note.id_utilisateur=adherent.id_utilisateur
AND adherent.id_club=club.id_club
AND club.id_ligue=ligue.id_ligue
GROUP BY NomLigue,NomClub,NomMotif";
try {
  $sth = $dbh->prepare($sql);
  $sth->execute();
  $tableau = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}

 
        
      
   echo  "  <pre> ".json_encode($tableau) ."</pre>";
        
        ?>
      </table>

   





<?php
require('footer.php');
?>