<?php $active=2; $title = "Liste"; require('../header.php'); require('../sql.php');
//Récupère toutes les lignes de la table FAQ ainsi que le pseudo associé à chaque question
    $sql="SELECT id_faq, pseudo, question, dat_question, reponse, dat_reponse FROM faq, user WHERE faq.id_user = user.id_user";
    try {
        $sth = $dbh->query($sql);
        $faq = $sth->fetchAll(PDO::FETCH_ASSOC);
    //Gestion des erreurs
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
?>
    <h1>Liste des questions</h1>
    <table class="faq">
        <tr>
            <th>Nr</th>
            <th>Auteur</th>
            <th>Question</th>
            <th>Date Question</th>
            <th>Réponse</th>
            <th>Date Réponse</th>
            <?php
                //Si user connecté, plusieurs actions possibles sur la FAQ
                if($_SESSION['user']['id_usertype']>1){
                    echo "<th>Actions</th>";
                    echo "<th>&nbsp;</th>";
                }
            ?>
            
        </tr>
        <?php
            foreach($faq as $question){
                //Récupère les questions par ligue
                $sql="SELECT id_ligue FROM user, faq WHERE user.id_user = faq.id_user AND faq.id_faq=:id_faq";
                try {
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array(
                        ":id_faq" => $question['id_faq']
                    ));
                    $id_lig = $sth->fetch(PDO::FETCH_ASSOC);
                //Gestion des erreurs
                } catch (PDOException $ex) {
                    die("Erreur lors de la requête SQL : " . $ex->getMessage());
                }
                //Chaque user peut voir les questions de sa ligue et le superadmin peut tout voir
                if($_SESSION['user']['id_ligue']==$id_lig['id_ligue'] || $_SESSION['user']['id_usertype'] == 3){
                    echo "<tr>";
                    echo "<td>".$question["id_faq"]."</td>";
                    echo "<td>".$question["pseudo"]."</td>";
                    echo "<td>".$question["question"]."</td>";
                    echo "<td>".$question["dat_question"]."</td>";
                    echo "<td>".$question["reponse"]."</td>";
                    echo "<td>".$question["dat_reponse"]."</td>";
                    //Si rang du user sup à 1 alors il a le droit d'éditer et supprimer
                    if($_SESSION['user']['id_usertype']>1){
                        echo "<td><a href='editer.php?id=".$question["id_faq"]."'><input class=\"button blue full\" type=\"submit\" value=\"Répondre\"></a></td>";
                        echo "<td><a href='supprimer.php?id=".$question["id_faq"]."'><input class=\"button red full\" type=\"submit\" value=\"Supprimer\"></a></td>";
                    }
                    echo "</tr>";
                }
            }
        ?>
    </table>
    <p><a href="ajouter.php"><input class="button green" type="submit" value="Ajouter une question"></a></p>

<?php require('../footer.php'); ?>