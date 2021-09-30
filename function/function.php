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


</body>
</html>