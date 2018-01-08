<div class="logoConnect">
    <img src="img/logos/logoJT_Admin.png">
    <p>Belvédère de Choriol - admin</p>
</div>
<form id='fConnect' action='index.php' method='post'>
    <fieldset>
        <legend>Formulaire de connexion</legend>
        <div>
            <label for="login">login</label>
            <input type="text" name="login" id="login">
        </div>
        <div>
            <label for="mdp">mot de passe</label>
            <input type="password" name="mdp" id="mdp" required>
        </div>
    </fieldset>
    <input type="hidden" name="action" value="connected">
    <input class="boutonSG" type="submit" name="envoyer" value="connexion" />
</form>