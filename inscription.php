<?php
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

?>


<?php $active=3; $title = "Inscription"; require('header.php'); $page=$_SERVER['PHP_SELF'];logToDisk($page,'','');?>
    <div class="center">
        <h1>S'inscrire</h1>
            <form class="form" action="inscription_validation.php" method="post">
            <table>
            <tr>
                    <td><label for="nom">Nom* : </label></td>
                    <td><input type="text" id="nom" name="nom" value="<?php $nom = isset($_POST['nom']) ? $_POST['nom'] :  '';?>"></td>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom* : </label></td>
                    <td><input type="text" id="prenom" name="prenom" value="<?php $prenom = isset($_POST['prenom']) ? $_POST['prenom'] :  '';?>"></td>
                </tr>
                <tr>
                    <td><label for="pseudo">Pseudo* : </label></td>
                    <td><input type="text" id="pseudo" name="pseudo" value="<?php $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] :  '';?>"></td>
                </tr>
                <tr>
                    <td><label for="email">Email* : </label></td>
                    <td><input type="text" id="mail" name="mail" value="<?php $mail = isset($_POST['mail']) ? $_POST['mail'] :  '';?>"></td>
                </tr>
                <tr>
                    <td><label for="password">Mot de passe* : </label></td>
                    <td><input type="password" id="password" name="password" value="<?php $password = isset($_POST['password']) ? $_POST['password'] :  '';?>"></td>
                </tr>
                <tr>
                    <td><label for="password2">Confirmer le mot de passe* : </label></td>
                    <td><input type="password" id="password2" name="password2" value="<?php $password2 = isset($_POST['password2']) ? $_POST['password2'] :  '';?>"></td>
                </tr>
                    <td><label for="ligue">Ligue* : </label></td>
                    <td>
                        <select name="ligue" id="ligue">
                            <option value="1" selected="selected">Ligue de basket</option>
                            <option value="2">Ligue de volley</option>
                            <option value="3">Ligue de handball</option>
                            <option value="4">Ligue de football</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="adr1">Adresse* : </label></td>
                    <td><input type="text" id="adr1" name="adr1" value="<?php $adr1 = isset($_POST['adr1']) ? $_POST['adr1'] :  '';?>"></td>
                </tr>
                <tr>
                    <td><label for="adr2">Code Postal* : </label></td>
                    <td><input type="text" id="adr2" name="adr2" value="<?php $adr2 = isset($_POST['adr2']) ? $_POST['adr2'] :  '';?>"></td>
                </tr>
                <tr>
                    <td><label for="adr3">Ville* : </label></td>
                    <td><input type="text" id="adr3" name="adr3" value="<?php $adr3 = isset($_POST['adr3']) ? $_POST['adr3'] :  '';?>"></td>
                </tr>
                    <td><p><a href="connexion.php">Déjà inscrit ?</a></p></body></td>
                <td><input class="button green full" name="submit" type="submit" value="S'inscrire"></td>
                </tr>
                <tr>
                    <td colspan=2><p>* : Champs obligatoires</p></td>
                </tr>
            </table>                
            </form>
    </div>
<?php require('footer.php'); ?>
