<?php ob_start(); ?>
    <div id="tournamentDiv">
        <h1><?= $tournament->name ?></h1>      
        <div id="contentTournamentDiv">
            <div id="firstBlockTournament">
                <fieldset>
                    <legend>Informations</legend>
                    <strong>Type</strong> : <?= $tournament->format ?><br />
                    <strong>Date :</strong> <?= date('d-m-Y', strtotime($tournament->date)) ?><br />
                    <strong>Lieu :</strong> <?= $tournament->address ?> <br />
                    <?= $tournament->cp ?>, <?= $tournament->city ?><br />
                    <strong>Prix :</strong> <?= $tournament->preregistration ?>€<br />
                    <strong>Début inscriptions :</strong> <?= date('h:i', strtotime($tournamentDetail->tournament_insc)) ?><br />
                    <strong>Début tournoi :</strong> <?= date('h:i', strtotime($tournamentDetail->tournament_start)) ?><br />
                </fieldset>
                <fieldset id="extrasBlock">
                    <legend>Extras</legend>
                    <?php for ($i=0; $i < count($extras); $i++) : ?>
                        <?php $propri = $extras[$i]; ?>
                        <?php if($tournamentDetail->$propri == true) : ?>
                            <?= $propri ?><img src="public/images/true.png" alt="Validé"><br />
                        <?php endif; ?>
                    <?php endfor; ?>
                </fieldset>
            </div>
            <div id="secondBlockTournament">
                <div>
                    <?= html_entity_decode($tournamentDetail->content) ?>
                </div>
                <div id="rewardsBlock">
                    <div>
                        <legend>Récompenses <span class="littleText"><?= $registration ?> joueurs</span></legend> 
                        <?php for($i=0; $i < 6; $i++) : ?>      
                            <?php $prize = $top.$rewardsName[$i]; ?>
                            <?php if(isset($rewards->$prize)) : ?>   
                                <?php if($rewards->$prize != null) : ?>               
                                    <strong><?= $topName[$i] ?> : </strong><?= $rewards->$prize ?><br />
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <?php if(isset($next)) : ?>
                        <div>
                            <legend>Prochaines Récompenses <span class="littleText">(<?= $registration ?>/<?= $nextNumbersPlayers ?>)</span></legend>                        
                            <?php for($i=0; $i < 6; $i++) : ?>      
                                <?php $prize = $next.$rewardsName[$i]; ?>
                                <?php if(isset($rewards->$prize)) : ?>   
                                    <?php if($rewards->$prize != null) : ?>               
                                        <strong><?= $topName[$i] ?> : </strong> <?= $rewards->$prize ?><br />
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    <?php endif;?>
                </div>
                <a href="registration-<?= $tournament->format ?>-tournament-<?= $tournament->id ?>" id="inputSendFormRegister">M'enregistrer</a>
            </div>
        </div>
    </div>

<?php $contentIndex = ob_get_clean(); ?>

<?php require 'views/templates/index.php'; ?>