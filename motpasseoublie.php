<?php
include "inclusion.php";

//recupération des données
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$submit = isset($_POST['submit']);
$id_utilisateur = isset($_POST['id_utilisateur']) ? $_POST['id_utilisateur'] : '';
$message = " ";


if ($submit) {

    $sql = "select * from user where pseudo=:pseudo and mail=:mail";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
            'pseudo' => $pseudo,
            'mail' => $email
        ));
        $user = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) { //erreur SQL
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    if ($pseudo == $user["pseudo"] && ($user["mail"])) { //condition et verification de l'adresse mail et speudo
        $id_utilisateur = $user["id_utilisateur"];
    }

    $mdp = 'M2L';



    $mdph = password_hash($mdp, PASSWORD_BCRYPT); //hachage du mot de passe


    try {
        $req = $dbh->prepare('UPDATE user SET mdp =:mdp  where id_utilisateur=:id_utilisateur');
        $req->execute(array(
            'mdp' => $mdph,
            'id_utilisateur' => $id_utilisateur,

        ));
    } catch (PDOException $ex) { //gestion des erreurs
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }




    header("Location: mdp.php?id_utilisateur=" . $id_utilisateur); //renvois a la ligue 

}
$message = "Pseudo ou email invalide";


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mot_de_passe_oublié</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <! -- haut de page -->
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li class="right"><a href="register.php">S'inscrire</a></li>
            <li class="right"><a class="active" href="login.php">Se connecter</a></li>

        </ul>
        <! -- corps de la page -->
            <div class="marg">
                <h1>M2L</h1>

                <h3>Mot de passe oublié</h3>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="pseudo">Pseudo</label><br>
                    <input type="text" name="pseudo" />
                    <br><br>
                    <label for="mdp">adresse mail</label><br>
                    <input type="text" name="email" />
                    <br><br>
                    <input type="submit" name="submit" value="valider"> &nbsp;&nbsp;
                    <input type="hidden" name="id" hidden value="<?= $id_utilisateur ?>">
                </form>
                <br>

                <?php
                echo "$message"; //message d'erreur SQL
                ?>
            </div>
            <! -- haut de page -->
                <p class="pied">SIO 2020/2021 Marques, Dutertre, Carles</p>
</body>

</html>