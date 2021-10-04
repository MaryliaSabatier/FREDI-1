<?php
/**
 * Emule l'envoi d'un mail en créant un fichier dans le dossier courant
 *
 * @param string $to
 * @param string $subject
 * @param string $message
 * @return int le résultat de l'écriture du fichier (nb octets écrits ou FALSE)
 */
function MailToDisk($to,$subject,$message,$id){
    require('sql.php');
    $alph = 'abcdefghijklmnpqrstuvwxyz';
    $alph2= 'ABCDEFGHIJKLMNOPQRSTUVWXYE';
    $caract= '&@$!%#';
    $code='';
     for ($i=0;$i<4;$i++)
    {
      $code .= $alph[mt_rand(0,25)].$alph2[mt_rand(0,25)].$caract[mt_rand(0,5)].mt_rand(0,9);
    }
    $password1 = str_shuffle($code);
    $password = password_hash($password1, PASSWORD_BCRYPT);
    try {
        $req = $dbh->prepare('UPDATE  utilisateur SET mdp =:mdp  WHERE id_utilisateur=:id_utilisateur');
        $req->execute(array(
            'mdp' => $password,
            'id_utilisateur' => $id
        ));
        $_SESSION['messages'] = array("inscription" => ["green", "Mot de passe bien modifié !"]);
        header('Location:connexion.php');  //revois vers la liste des questions   
    } catch (PDOException $ex) { //gestion des erreurs
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    
 
 
 


    $laDate = date('Ymd-Hi-s');
  //$laDate = gmdate('Ymd-Hi-s');
  $root = dirname(__FILE__);
  $input = "date : ". $laDate.PHP_EOL;
  $input .= "to : ". $to.PHP_EOL;
  $input .= "subject : ".$subject.PHP_EOL;
  $input .= "message : ".$message.PHP_EOL;
  $input .= $password1;
  
  $filename = '.'.DIRECTORY_SEPARATOR.'mail'.DIRECTORY_SEPARATOR.'mail-' . $laDate . '.html';
  $ok=file_put_contents($filename, $input);
  $reponse = $ok===FALSE ? "KO" : "OK";
  echo "<p>Mail envoyé dans : ".$filename."</p>";
  echo "<p>MailToDisk() a répondu : ".$reponse."</p>";
  
  return $ok; 
}

function load_from_csv(string $filename, int $start = 1)
{
  // Ouverture du fichier
  $file_handler = fopen($filename, "r") or exit("<p>Impossible de lire le fichier $filename</p>");
  $nb = 1;
  $rows = array();
  // Boucle de lecture
  while (!feof($file_handler)) {
    $row = fgetcsv($file_handler, 0, ';');
    if ($nb >= $start) {
      $rows[] = $row;
    }
    $nb++;
  }
  // Fermeture du fichier
  fclose($file_handler);
  // Renvoie le tableau PHP
  return $rows;
}
?>

