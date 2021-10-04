<?php $active = 3;
$title = "Inscription";
require('header.php');
require('sql.php');
//Chaque champ saisi par l'user va dans une variable à son nom
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] :  '';
$mail = isset($_POST['mail']) ? $_POST['mail'] :  '';
$password = isset($_POST['password']) ? $_POST['password'] :  '';
$password2 = isset($_POST['password2']) ? $_POST['password2'] :  '';
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$ligue = isset($_POST['ligue']) ? $_POST['ligue'] : '';
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
$adr1 = isset($_POST['adr1']) ? $_POST['adr1'] : '';
$adr2 = isset($_POST['adr2']) ? $_POST['adr2'] : '';
$adr3 = isset($_POST['adr3']) ? $_POST['adr3'] : '';
$typeutil = isset($_POST['role']) ? $_POST['role'] : '';
$submit = isset($_POST['submit']);

$containsLetter  = preg_match('/[a-zA-Z]/',    $password);
$containsDigit   = preg_match('/\d/',          $password);
$containsSpecial = preg_match('/[^a-zA-Z\d]/', $password);

$containsAll = $containsLetter && $containsDigit && $containsSpecial;
//Si l'user a cliqué sur submit
if ($submit) {
    //Si pseudo sup à 8 carac.
    if (strlen($pseudo) >= 0) {
        //Si mdp sup à 8 carac.
      
        if (strlen($password) >= 8 && $containsAll ==true) {



            //Si 2 mdp identiques
            if ($password == $password2) {
                //Lecture du pseudo et du mail dans la BDD pour comparer si ceux-ci existent déjà ou non
                $sql = "SELECT * FROM utilisateur WHERE pseudo = ':pseudo' OR mail = ':mail'";
                try {
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array(
                        ":pseudo" => $pseudo,
                        ":mail" => $mail
                    ));
                    $user = $sth->fetch(PDO::FETCH_ASSOC);
                    //Gestion des erreurs
                } catch (PDOException $ex) {
                    die("Erreur lors de la requête SQL : " . $ex->getMessage());
                }
                //Si le mail ou le pseudo n'existe pas déjà alors on peut s'inscrire
                if (!($user['mail'] == $mail || $user['pseudo'] == $pseudo)) {
                    //On crypte le mdp
                    $password = password_hash($password, PASSWORD_BCRYPT);
                    //On insère les champs saisis dans la BDD avec la requête SQL


                    try {        //insertion de l'utilsateur   
                        $req = $dbh->prepare('INSERT INTO utilisateur(pseudo, mdp, mail,nom,prenom ) VALUES(:pseudo ,:mdp ,:mail ,:nom,:prenom)');
                        $req->execute(array(
                            ':nom' => $nom,
                            ':prenom' => $prenom,
                            ':mdp' => $password,
                            ':mail' =>   $mail,
                            ':pseudo' => $pseudo

                        ));

                        //revois vers la liste des questions   

                    } catch (PDOException $ex) {
                        die("Erreur lors de la requête SQL : " . $ex->getMessage());
                    }


                    //affichage du tableau
                    try {
                        $requser = $dbh->prepare("SELECT * FROM utilisateur WHERE mail = :mail");
                        $requser->execute(array(":mail" => $mail));
                        $userinfo = $requser->fetch();
                    } catch (PDOException $e) {
                        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
                    }
                    try {
                        $req = $dbh->prepare('INSERT INTO  adherent (adr1 ,adr2 ,adr3 ,id_utilisateur,id_club)VALUES (:adr1 ,:adr2 ,:adr3,:id_utilisateur,:id_club) ');
                        $req->execute(array(
                            ':adr1' => $adr1,
                            ':adr2' => $adr2,
                            ':adr3' => $adr3,
                            ':id_utilisateur' => $userinfo['id_utilisateur'],
                            ':id_club' => '5'
                        ));
                        //  echo 'enregistrement effectué !';
                        // header('Location:connexion.php');
                    } catch (PDOException $ex) { //gestion des erreurs
                        die("Erreur lors de la requête SQL : " . $ex->getMessage());
                    }

                    $_SESSION['messages'] = array(
                        "inscription" => ["green", "Vous vous êtes bien inscrit !"]
                    );
                    header("Location: connexion.php");
                } //Conditions où la connexion échoue
                else {
                    $_SESSION['messages'] = array("Password" => ["red", "Cet utilisateur ou mail existe déjà."]);
                    header("Location: inscription.php");
                }
            } else {
                $_SESSION['messages'] = array("Password" => ["red", "Les mots de passe ne sont pas identiques"]);
                header("Location: inscription.php");
            }
        } else {
            $_SESSION['messages'] = array("Password" => ["red", "Vous avez rentré un mot de passe trop court ou qui ne contient pas de chiffre ou de lettre ou qui ne contient pas de majuscule"]);
            header("Location: inscription.php");
        }
    } else {
        $_SESSION['messages'] = array("Pseudo" => ["red", "Vous avez rentré un pseudo trop court"]);
        header("Location: inscription.php");
    }
} else {
    $_SESSION['messages'] = array("submit" => ["red", "non soumis"]);
    header("Location: inscription.php");
}

