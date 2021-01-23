<?php ob_start(); ?>

    <div id="containerProfil">
        <h6>Aucune des informations ne sera visible sur le site par les autres utilisateurs</h6>

        <form action="updateProfil" method="post">
            <input type="hidden" name="created" value="<?= $created ?>">
            <fieldset id=fieldInfos>
                <legend>Mes infos perso.</legend>
                <div>
                    <label for="mail">mail</label><input type="email" name="mail" id="mailFormProfil" placeholder="Email" value="<?= $user->mail ?>">
                </div>
                <div>
                    <label for="dci">DCI</label> <input type="text" name="dci" id="dciFormProfil" placeholder="DCI" value="<?= $user->dci ?>">
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Veuillez sélectionner vos formats favoris :</legend>
                <div>
                    <div>
                        <input type="checkbox" id="commander" name="favoritesTournament[]" value="commander" <?php if($user->commander == true){echo "checked='checked'";} ?>>
                        <label for="commander">Commander</label>
                    </div>
                    <div>
                        <input type="checkbox" id="legacy" name="favoritesTournament[]" value="legacy" <?php if($user->legacy == true){echo "checked='checked'";} ?>>
                        <label for="legacy">Legacy</label>
                    </div>
                    <div>
                        <input type="checkbox" id="standard" name="favoritesTournament[]" value="standard" <?php if($user->standard == true){echo "checked='checked'";} ?>>
                        <label for="standard">Standard</label>
                    </div>
                </div>
                <div>
                    <div>
                        <input type="checkbox" id="modern" name="favoritesTournament[]" value="modern" <?php if($user->modern == true){echo "checked='checked'";} ?>>
                        <label for="modern">Modern</label>
                    </div>
                    <div>
                        <input type="checkbox" id="vintage" name="favoritesTournament[]" value="vintage" <?php if($user->vintage == true){echo "checked='checked'";} ?>>
                        <label for="vintage">Vintage</label>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Abonnement :</legend>
                <div>
                    <input type="checkbox" id="newTournament" name="newTournament" value="1" <?php if($user->newTournament == true){echo "checked='checked'";} ?>>
                    <label for="newTournament">M'avertir par mail de la création d'un nouveau tournois favoris</label>
                </div>
            </fieldset>
            <input type="submit" value="Envoyer" id="submitFormProfil">
        </form>
    </div>


<?php $contentIndex = ob_get_clean(); ?>

<?php require 'views/templates/index.php'; ?>