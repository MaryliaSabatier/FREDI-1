<?php
/**
 * Emule l'envoi d'un mail en créant un fichier dans le dossier courant
 *
 * @param string $to
 * @param string $subject
 * @param string $message
 * @return int le résultat de l'écriture du fichier (nb octets écrits ou FALSE)
 */
function MailToDisk($to,$subject,$message){
  $laDate = date('Ymd-Hi-s');
  //$laDate = gmdate('Ymd-Hi-s');
  $root = dirname(__FILE__);
  $input = "date : ". $laDate.PHP_EOL;
  $input .= "to : ". $to.PHP_EOL;
  $input .= "subject : ".$subject.PHP_EOL;
  $input .= "message : ".$message.PHP_EOL;
  $filename = $root.DIRECTORY_SEPARATOR.'mail-' . $laDate . '.txt';
  $ok=file_put_contents($filename, $input);
  $reponse = $ok===FALSE ? "KO" : "OK";
  echo "<p>Mail envoyé dans : ".$filename."</p>";
  echo "<p>MailToDisk() a répondu : ".$reponse."</p>";
  return $ok; 
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mailer</title>
</head>
<body>
<h1>Test d'un fakemailer</h1>

</body>
</html>