<?php ob_start(); ?>

    <div id="containerSignIn">
        <h1>Connexion</h1>
        <?php if(isset($get['error']) && $get['error'] == "connexionError") : ?>
            <?php if($time > 0) : ?>
                <p id="connexionError">Bloqué <span class="gras"><?= $time ?></span> minutes</p>
            <?php endif; ?>
        <?php elseif(isset($get['error']) && $get['error'] == "errorLogin") : ?>
            <p id="connexionError">Mail et/ou mot de passe invalide</p>
        <?php endif; ?>
        <form action="tryConnect" method="post">
            <input type="text" name="username" id="signInUsername" placeholder="Nom d'utilisateur" maxlength="30" required>
            <input type="password" name="password" id="signInPassword" placeholder="Mot de passe" required>
            <input type="submit" value="GO !">
        </form>

        <p>pas encore inscrit ? Qu'est-ce que t'attends, fonce !</p>
        <a href="signUp">M'enregistrer</a>
    </div>


<?php $contentIndex = ob_get_clean(); ?>

<?php require 'views/templates/index.php'; ?>