<?php $active=3; $title = "Inscription"; require('header.php'); ?>
    <div class="center">
        <h1>Inscription</h1>
            <form class="form" action="inscription_validation.php" method="post">
            <table>
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
                            <option value="1">Ligue de Judo Auvergne-Rhône-Alpes</option>
                            <option value="2">Ligue de football de Haute-Garonne</option>
                            <option value="3">Ligue de footbal d'Aquitaine</option>
                            <option value="4">Ligue de tennis de Corse du Sud</option>
                            <option value="5">Ligue d'équitation du Var</option>
                            <option value="6">Ligue de natation du Quercy</option>
                        </select>
                    </td>
                </tr>
                    <td><p><a href="connexion.php">Déjà inscrit ?</a></p></body></td>
                    <td><input class="button green full" name="submit" type="submit" value="S'inscrire"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p>* : Champs obligatoires</p></td>
                </tr>
            </table>                
            </form>
    </div>
<?php require('footer.php'); ?>