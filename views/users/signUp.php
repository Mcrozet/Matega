<?php ob_start(); ?>

    <div id="containerSignUp">
        <h1>Inscription</h1>
        <form action="newUser" method="post">
            <input type="text" name="username" id="signUpUsername" placeholder="Nom d'utilisateur" maxlength="30" required>
            <input type="password" name="password" id="signUpPassword" placeholder="Mot de passe" required>
            <input type="submit" value="M'enregistrer !" id="signUpSubmit" disabled>
        </form>

        <p>Déjà un compte ?</p>
        <a href="signIn">Se connecter</a>
    </div>


<?php $contentIndex = ob_get_clean(); ?>

<?php require 'views/templates/index.php'; ?>