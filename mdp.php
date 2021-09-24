<?php
$active = 1;
$title = "Accueil";
require('header.php');
require('sql.php');
$id_utilisateur = isset($_GET['id_utilisateur']) ? $_GET['id_utilisateur'] : null;

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
    <br>
    <br>
    <form class="form" action="mdp.php" method="post">
        <table>
            <tr>
                <td><label for="password">Mot de passe* : </label></td>
                <td><input type="password" id="password" name="password"></td>
                <input type="text" id="id_utilisateu" name="id_utilisateur" hidden value="<?= $_GET['id_utilisateur']; ?>">
            </tr>
            <tr>
                <td><label for="password2">Confirmer le mot de passe* : </label></td>
                <td><input type="password" id="password2" name="password2"></td>
                <td><input class="button green full" name="submit" type="submit" value="mdp_oublié"></td>
            </tr>
        </table>
    </form>
    <?php
    $password = isset($_POST['password']) ? $_POST['password'] :  "";
    $password2 = isset($_POST['password2']) ? $_POST['password2'] :  "";
    echo    $id_utilisateur = isset($_POST['id_utilisateur']) ? $_POST['id_utilisateur'] : null;
    $submit = isset($_POST['submit']);

    if ($submit) {

        echo "<p>entrez votre question</p>";
        //Si 2 mdp identiques
        if ($password == $password2) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            try {
                $req = $dbh->prepare('UPDATE  utilisateur SET mdp =:mdp  WHERE id_utilisateur=:id_utilisateur');
                $req->execute(array(
                    'mdp' => $password,
                    'id_utilisateur' => $id_utilisateur
                ));
                $_SESSION['messages'] = array("inscription" => ["green", "Mot de passe bien modifié !"]);
                header('Location:connexion.php');  //revois vers la liste des questions   
            } catch (PDOException $ex) { //gestion des erreurs
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }
        } else {
            $_SESSION['messages'] = array("Password" => ["red", "Les mots de passe ne sont pas identiques"]);
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