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
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
$adr1 = isset($_POST['adr1']) ? $_POST['adr1'] : '';
$adr2 = isset($_POST['adr2']) ? $_POST['adr2'] : '';
$adr3 = isset($_POST['adr3']) ? $_POST['adr3'] : '';
$typeutil = isset($_POST['role']) ? $_POST['role'] : '';
$submit = isset($_POST['submit']);
//Si l'user a cliqué sur submit
if ($submit) {
    //Si pseudo sup à 8 carac.
    if (strlen($pseudo) >= 0) {
        //Si mdp sup à 8 carac.
        if (strlen($password) >= 0) {
            //Si 2 mdp identiques
            if ($password == $password2) {
                //Lecture du pseudo et du mail dans la BDD pour comparer si ceux-ci existent déjà ou non
                $sql = "SELECT pseudo, mail FROM utilisateur WHERE pseudo LIKE ':pseudo' OR mail lIKE ':mail'";
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
                   


            
                   
                    try {
                        $req = $dbh->prepare('INSERT INTO  adherent (adr1 ,adr2 ,adr3 )VALUES (:adr1 ,:adr2 ,:adr3) ');
                        $req->execute(array(
                            ':adr1' => $adr1,
                            ':adr2' => $adr2,
                            ':adr3' => $adr3
                            
                        ));

                     
                    } catch (PDOException $ex) { //gestion des erreurs
                        die("Erreur lors de la requête SQL : " . $ex->getMessage());
                    }
                    
                    $sql = "update adherent set id_utilisateur=':id_utilisateur' ";
                    try {
                        $sth = $dbh->prepare($sql);
                        $sth->execute(array(":id_utilisateur"=>$rows));
                        $nb = $sth->rowcount();
                    } catch (PDOException $e) {
                        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
                    }
                    try {
                        $sth = $dbh->prepare('SELECT * FROM `adherent` WHERE adr1 = ":adr1" and adr2 =":adr2" and adr3 =":adr3"');
                        $sth->execute(array(
                            ':adr1' => $adr1,
                            ':adr2' => $adr2,
                            ':adr3' => $adr3
                        ));
                        $rows = $sth->fetch(PDO::FETCH_ASSOC);
                    } catch (PDOException $ex) {
                        die("Erreur lors de la requête SQL : " . $ex->getMessage());
                    }
                    //affichage du tableau
                    
                   
                    try {        //insertion de l'utilsateur   
                        $req = $dbh->prepare('INSERT INTO utilisateur(pseudo, mdp, mail,nom,prenom ,id_utilisateur) VALUES(:pseudo ,:mdp ,:mail ,:nom,:prenom,:id_adherent)');
                        $req->execute(array(
                            ':nom' => $nom,
                            ':prenom' => $prenom,
                            ':mdp' => $password,
                            ':mail' =>   $mail,
                            ':pseudo' => $pseudo,
                            ':id_adherent' => $rows
                        ));
                      
                        //revois vers la liste des questions   
                        echo 'enregistrement effectué !';
                        header('Location:connexion.php');
                    } catch (PDOException $ex) {
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
            $_SESSION['messages'] = array("Password" => ["red", "Vous avez rentré un mot de passe trop court"]);
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
