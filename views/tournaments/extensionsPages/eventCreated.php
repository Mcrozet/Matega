<div id="containerEventCreated">
    <?php if(count($tournamentsCreated) > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Lieu</th>
                    <th>date</th>
                    <th>inscrits</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i=0; $i < count($tournamentsCreated); $i++) : ?>
                    <tr class="linktournamentCreated" id="tournament-<?= $tournamentsCreated[$i]->id ?>">
                        <td><?= $tournamentsCreated[$i]->name ?></td>
                        <td><?= $tournamentsCreated[$i]->format ?></td>
                        <td><?= $tournamentsCreated[$i]->cp ?>, <?= $tournamentsCreated[$i]->city ?></td>
                        <td><?= date('d-m-Y', strtotime($tournamentsCreated[$i]->date)) ?></td>
                        <td>0</td>
                        <td><a href="cancelTournament-<?= $tournamentsCreated[$i]->id ?>">Annuler</a></td>
                    </tr>
                <?php endfor; ?> 
            </tbody>
        </table>    
    <?php else : ?>
        <h2>Vous n'avez actuellement aucun tournoi enregistré terminé</h2>
    <?php endif; ?>
</div>