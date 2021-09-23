<?php $active=3; $title = "Inscription"; require('header.php'); ?>
    <div class="center">
        <h1>S'inscrire</h1>
            <form class="form" action="inscription_validation.php" method="post">
            <table>
            <tr>
                    <td><label for="nom">Nom* : </label></td>
                    <td><input type="text" id="nom" name="nom"></td>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom* : </label></td>
                    <td><input type="text" id="prenom" name="prenom"></td>
                </tr>
                <tr>
                    <td><label for="pseudo">Pseudo* : </label></td>
                    <td><input type="text" id="pseudo" name="pseudo"></td>
                </tr>
                <tr>
                    <td><label for="email">Email* : </label></td>
                    <td><input type="text" id="email" name="email"></td>
                </tr>
                <tr>
                    <td><label for="password">Mot de passe* : </label></td>
                    <td><input type="password" id="password" name="password"></td>
                </tr>
                <tr>
                    <td><label for="password2">Confirmer le mot de passe* : </label></td>
                    <td><input type="password" id="password2" name="password2"></td>
                </tr>
                <td><label for="club">Club* : </label></td>
                    <td>
                        <select name="club" id="club">
                            <option value="1">Club de Judo Auvergne-Rhône-Alpes</option>
                            <option value="2">Club de football de Haute-Garonne</option>
                            <option value="3">Club de footbal d'Aquitaine</option>
                            <option value="4">Club de tennis de Corse du Sud</option>
                            <option value="5">Club d'équitation du Var</option>
                            <option value="6">Club de natation du Quercy</option>
                    <td><label for="ligue">Ligue* : </label></td>
                    <td>
                        <select name="ligue" id="ligue">
                            <option value="2" selected="selected">Ligue de basket</option>
                            <option value="3">Ligue de volley</option>
                            <option value="4">Ligue de handball</option>
                            <option value="5">Ligue de football</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="adresse">Adresse* : </label></td>
                    <td><input type="text" id="adr1" name="adresse"></td>
                </tr>
                <tr>
                    <td><label for="cp">Code Postal* : </label></td>
                    <td><input type="text" id="adr2" name="cp"></td>
                </tr>
                <tr>
                    <td><label for="ville">Ville* : </label></td>
                    <td><input type="text" id="adr3" name="ville"></td>
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