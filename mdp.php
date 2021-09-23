<?php
include "inclusion.php";
$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

?>

    
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mot de passe</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<! -- haut de page  -->
    <ul>
            <li><a href="Liste.php">FAQ</a></li>
            <li class="right" ><a href="logout.php">Se deconnecter</a></li>
        
    </ul>
  
<! -- corps de la page  -->
<div class="marg">
<p><h2>Votre nouveau mot de passe est M2L</h2></p>
<br><br>

<?php


echo $id_user;
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 
  
   
    <input type="submit" name="submit" value="Valider">
    <input type="text" name="id" hidden value="<?= $id_user ?>"><! -- renvois de l'id "caché"  -->
</form>


<br>
</div>
</body>
<! -- Pied de page  -->
    <p class="pied">SIO 2020/2021 Marques, Dutertre, Carles</p>
</html>