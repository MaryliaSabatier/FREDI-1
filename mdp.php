<?php
 $active=1; $title = "Accueil"; require('header.php'); require('sql.php');
 $id_utilisateur = isset($_GET['id_utilisateurr']) ? $_GET['id_utilisateur'] : null;

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

<form class="form" action="inscription_validation.php" method="post">
            <table>
            
                  
               
                <tr>
                    <td><label for="password">Mot de passe* : </label></td>
                    <td><input type="password" id="password" name="password"></td>
                </tr>
                <tr>
                    <td><label for="password2">Confirmer le mot de passe* : </label></td>
                    <td><input type="password" id="password2" name="password2"></td>
                </tr>
  

<div class="marg">

<br><br>

<?php


echo $id_utilisateur;
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 
  
   
    <input type="submit" name="submit" value="Valider">
    <input type="text" name="id" hidden value="<?= $id_utilisateur ?>"><! -- renvois de l'id "caché"  -->
</form>


<br>
</div>
<?php  $active=1; $title = "mot de passe oublié"; require('footer.php'); ?>
</body>
 
</html>