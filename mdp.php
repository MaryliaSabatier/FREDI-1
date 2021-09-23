<?php
$active = 1;
$title = "Accueil";
require('header.php');
require('sql.php');
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

    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>



            <tr>
                <td><label for="password">Mot de passe* : </label></td>
                <td><input type="password" id="password" name="password"></td>
                <input type="text" name="id" hidden value="<?= $id_utilisateur ?>">
            </tr>
            <tr>
                <td><label for="password2">Confirmer le mot de passe* : </label></td>
                <td><input type="password" id="password2" name="password2"></td>
                <input type="submit" name="submit" value="Valider">
            </tr>
</table>
</form>
           
              
                <?php
                $password = isset($_POST['password']) ? $_POST['password'] :  "";
                $password2 = isset($_POST['password2']) ? $_POST['password2'] :  "";
                $id_utilisateur = isset($_POST['id_utilisateur']) ? $_POST['id_utilisateur'] :  "";
                $submit = isset($_POST['submit']);
           
                if ($submit) {


                    //Si 2 mdp identiques
                    if ($password == $password2) {



                        //On crypte le mdp
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        //On insère les champs saisis dans la BDD avec la requête SQL
                        $sql = "Update utilisateur set mdp=':mdp' where id_utilisateur=:id_utilisateur ";
                        //Insertion des infos de l'user dans la BDD
                        try {
                            $sth = $dbh->prepare($sql);
                            $sth->execute(array(

                                ':mdp' => $password,
                                ':id_utilisateur' => $id_utilisateur
                            ));
                        } //Gestion es erreurs
                        catch (PDOException $ex) {
                            die("Erreur lors de la requête SQL : " . $ex->getMessage());
                        }

                        $_SESSION['messages'] = array(
                            "inscription" => ["green", "Mot de passe bien modifié !"]
                        );
                        header("Location: connexion.php");
                        //Conditions où la connexion échoue


                    } else {
                        $_SESSION['messages'] = array("Password" => ["red", "Les mots de passe ne sont pas identiques"]);
                        header("Location: motpasseoublie.php");
                    }
                }


                ?>






















                <br>
            </div>
            <?php $active = 1;
            $title = "mot de passe oublié";
            require('footer.php'); ?>
</body>

</html>