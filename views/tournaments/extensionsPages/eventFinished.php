<div id="containerEventFinished">
    <?php if(count($tournamentsFinished) > 0) : ?>
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
                <?php for ($i=0; $i < count($tournamentsFinished); $i++) : ?>
                    <tr class="linktournamentCreated" id="tournament-<?= $tournamentsFinished[$i]->id ?>">
                        <td><?= $tournamentsFinished[$i]->name ?></td>
                        <td><?= $tournamentsFinished[$i]->format ?></td>
                        <td><?= $tournamentsFinished[$i]->cp ?>, <?= $tournamentsFinished[$i]->city ?></td>
                        <td><?= date('d-m-Y', strtotime($tournamentsFinished[$i]->date)) ?></td>
                        <td>0</td>
                    </tr>
                <?php endfor; ?> 
            </tbody>
        </table>    
    <?php else : ?>
        <h2>Vous n'avez actuellement aucun tournoi enregistré terminé</h2>
    <?php endif; ?>
</div>