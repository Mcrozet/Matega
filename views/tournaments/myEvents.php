<?php ob_start(); ?>

    <div id="containerMyEvents">
        <h1>Mes tournois</h1>
        <div id="buttons">
            <button class="buttonEvents" id="newEvent">Nouvelle événement</button>
            <button class="buttonEvents" id="eventsCreated">Evénements en cours</button>
            <button class="buttonEvents" id="eventsFinished">Evénements terminés</button>
        </div>

    </div>
    <?php if(isset($get['error'])) :?>
        <div id="errorContentMyEvent">
            <?php if($get['error'] == 'Canceled') : ?>
                <p id="errorMyEventOk">Le tournoi sélectioné à bien été annulé</p>
            <?php else : ?>
                <p id="errorMyEvent">Une erreur c'est produite, veuillez réessayer</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="divEvents" id="divnewEvent">
        <?php include("extensionsPages/newEvent.php"); ?>
    </div>
    <div class="divEvents" id="diveventsCreated">
        <?php include("extensionsPages/eventCreated.php"); ?>
    </div>
    <div class="divEvents" id="diveventsFinished">
        <?php include("extensionsPages/eventFinished.php"); ?>
    </div>


<?php $contentIndex = ob_get_clean(); ?>

<?php require 'views/templates/index.php'; ?>