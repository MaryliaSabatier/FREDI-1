<?php $active=3; $title = "Inscription"; require('header.php'); require('sql.php');
    //Chaque champ saisi par l'user va dans une variable à son nom
    $pseudo=isset($_POST['pseudo']) ? $_POST['pseudo'] :  "";
    $email=isset($_POST['email']) ? $_POST['email'] :  "";
    $password=isset($_POST['password']) ? $_POST['password'] :  "";
    $password2=isset($_POST['password2']) ? $_POST['password2'] :  "";
    $nom=isset($_POST['nom']) ? $_POST['nom'] : "";
    $prenom=isset($_POST['premon']) ? $_POST['prenom'] : "";
    $typeutil=isset($_POST['role']) ? $_POST['role'] : ""; 
    $submit=isset($_POST['submit']);
    //Si l'user a cliqué sur submit
    if ($submit) {
        //Si pseudo sup à 8 carac.
        if(strlen($pseudo)>=8){
            //Si mdp sup à 8 carac.
            if(strlen($password)>=8){
                //Si 2 mdp identiques
                if($password==$password2) {
                    //Lecture du pseudo et du mail dans la BDD pour comparer si ceux-ci existent déjà ou non
                    $sql="SELECT pseudo, mail FROM utilisateur WHERE pseudo LIKE :pseudo OR mail lIKE :email";
                    try {
                        $sth = $dbh->prepare($sql);
                        $sth->execute(array(
                            ":pseudo" => $pseudo,
                            ":email" => $email
                        ));
                        $user = $sth->fetch(PDO::FETCH_ASSOC);
                    //Gestion des erreurs
                    } catch (PDOException $ex) {
                        die("Erreur lors de la requête SQL : " . $ex->getMessage());
                    }
                    //Si le mail ou le pseudo n'existe pas déjà alors on peut s'inscrire
                    if(!($user['mail'] == $email || $user['pseudo']==$pseudo)){
                        //On crypte le mdp
                        $password=password_hash($password, PASSWORD_BCRYPT);
                        //On insère les champs saisis dans la BDD avec la requête SQL
                        $sql = "INSERT INTO utilisateur (pseudo, mdp, mail, nom, prenom, role)VALUES (:pseudo, :password, :mail, :nom, :prenom, :role)";
                        //Insertion des infos de l'user dans la BDD
                        try {
                            $sth = $dbh->prepare($sql);
                            $sth->execute(array(
                                ':pseudo' => $pseudo,
                                ':mdp' => $password,
                                ':mail' => $email,
                                ':nom' => $nom,
                                ':prenom' => $prenom,
                                ':role' => 1,
                            ));
                        } //Gestion es erreurs
                        catch (PDOException $ex) {
                            die("Erreur lors de la requête SQL : " . $ex->getMessage());
                        }

                        $_SESSION['messages']=array(
                            "inscription" => ["green", "Vous vous êtes bien inscrit !"]
                        );
                        header("Location: connexion.php");
                    } //Conditions où la connexion échoue
                    else{
                        $_SESSION['messages']=array("Password" => ["red", "Cet utilisateur ou email existe déjà."]);
                        header("Location: inscription.php");
                    }
                }else{
                    $_SESSION['messages']=array("Password" => ["red", "Les mots de passe ne sont pas identiques"]);
                    header("Location: inscription.php");
                }
            }else{
            $_SESSION['messages']=array("Password" => ["red", "Vous avez rentré un mot de passe trop court"]);
            header("Location: inscription.php");
            }
        }else{
            $_SESSION['messages']=array("Pseudo" => ["red", "Vous avez rentré un pseudo trop court"]);
            header("Location: inscription.php");
        }
    }else{
        $_SESSION['messages']=array("submit" => ["red", "non soumis"]);
        header("Location: inscription.php");
    }
?>