<?php $active=3; $title = "Inscription"; require('header.php'); ?>
    <div class="center">
        <h1>S'inscrire</h1>
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