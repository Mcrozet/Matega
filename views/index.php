<?php ob_start(); ?>
    <div id="container">
        <div id="search">
            <div id="buttons">
                <button class="buttonSearch" id="City">Ville</button>
                <button class="buttonSearch" id="Format">Format</button>
                <button class="buttonSearch" id="Date">Date</button>
                <button class="buttonSearch" id="Name">Nom</button>
                <button class="buttonSearch" id="Organizer">Organisateur</button>
            </div>

            <div id="results">
                <div class="searchResults" id="searchCity">
                    <input type="text" placeholder="Veuillez sélectionner une ville" value="<?= $city ?>" name="city" id="inputCity">
                    <div id="rangeOut"></div>
                    <input id="inputRange" type="range" name="range" min="10" max="300" step="10" value ="30" disabled>
                    <input type="submit" id="buttonSearchCity" value="Rechercher" disabled>
                </div>
                <div id="CitiesList"></div>

                <div class="searchResults" id="searchFormat">
                    <button class="buttonFormat" id="buttonVintage">VINTAGE</button>
                    <button class="buttonFormat" id="buttonLegacy">LEGACY</button>
                    <button class="buttonFormat" id="buttonModern">MODERN</button>
                    <button class="buttonFormat" id="buttonStandard">STANDARD</button>
                    <button class="buttonFormat" id="buttonCommander">COMMANDER</button>
                    <button class="buttonFormat" id="buttonOther">OTHER</button>
                </div>

                <div class="searchResults" id="searchDate">
                    <div id="divStartingDate"><span id="spanDateForm">DE : </span><input type="date" name="startingDate" class="buttonDate" id="inputStartingDate"></div>
                    <div id="divEndDate"><span id="spanDateTo">A : </span><input type="date" name="endDate" class="buttonDate" id="inputEndDate"></div>
                    <input type="submit" value="Rechercher" id="buttonSearchDate">
                </div>

                <div class="searchResults" id="searchName">
                    <input type="text" placeholder="Renseignez un nom de tournoi" name="tournamentName" id="inputName">
                    <input type="submit" value="Rechercher" id="buttonSearchName">
                </div>

                <div class="searchResults" id="searchOrganizer">
                    <span id="spanOrganizer">ARRIVE BIENTOT</span>
                </div>
            </div>
        </div>

        <div id="tournamentList">
            <?php for ($i=0; $i < count($tournaments); $i++) : ?>
                <div class="divTournament <?= $tournaments[$i]->format ?>" id="tournament<?= $tournaments[$i]->id ?>">
                    <div class="formatTournamentList">
                        <?= ucfirst(strtolower($tournaments[$i]->format)) ?>
                    </div>
                    <div class="titleTournamentList">
                        <a href="tournament-<?= $tournaments[$i]->id ?>"><?= $tournaments[$i]->name ?></a>    
                        <div class="separatorTournament"></div>                    
                    </div>
                    <div class="addressTournamentList">
                        <i class="fa fa-map-marker" aria-hidden="true"></i> <?= $tournaments[$i]->address ?>, <?= $tournaments[$i]->city ?>
                    </div>
                    <div class="dateTournamentList">                        
                        <span><i class="fa fa-calendar" aria-hidden="true"></i> <?= date('d-m-Y', strtotime($tournaments[$i]->date)) ?></span>  
                    </div>                
                    <div class="seeMore">
                        <a href="tournament-<?= $tournaments[$i]->id ?>">Consulter</a>
                    </div> 
                    <div class="priceTournamentList">
                        <p class="priceTournament"><?= $tournaments[$i]->preregistration ?>€</p>
                    </div>
                </div>
            <?php endfor; ?>
        </div> 
        <div id="pages">
            <?php for ($x=1; $x <= $nmbrPage; $x++) : ?>
                <a href="home-p<?= $x ?>" id="link<?= $x ?>"><?= $x ?></a>
            <?php endfor; ?>
        </div>
        <?php for ($a=0; $a < count($formats); $a++) : ?> 
            <div class="formatsList" id="formats<?= $formats[$a] ?>">
                <?php if(count($format[$a]) == 0) : ?>
                    <div id="noResultSearchFormat">Désolé, aucun tournoi disponible :(</div>
                <?php else: ?>
                    <?php for ($b=0; $b < count($format[$a]); $b++) : ?>                    
                        <div class="divTournament <?= $format[$a][$b]->format ?>" id="tournamentFormat<?= $format[$a][$b]->id ?>">
                            <div class="formatTournamentList">
                                <?= ucfirst(strtolower($format[$a][$b]->format)) ?>
                            </div>
                            <div class="titleTournamentList">
                                <a href="tournament-<?= $format[$a][$b]->id ?>"><?= $format[$a][$b]->name ?></a>    
                                <div class="separatorTournament"></div>                    
                            </div>
                            <div class="addressTournamentList">
                                <i class="fa fa-map-marker" aria-hidden="true"></i> <?= $format[$a][$b]->address ?>, <?= $format[$a][$b]->city ?>
                            </div>
                            <div class="dateTournamentList">                        
                                <span><i class="fa fa-calendar" aria-hidden="true"></i> <?= date('d-m-Y', strtotime($format[$a][$b]->date)) ?></span>  
                            </div>             
                            <div class="seeMore">
                                <a href="tournament-<?= $format[$a][$b]->id ?>">Consulter</a>
                            </div>       
                            <div class="priceTournamentList">
                                <p class="priceTournament"><?= $format[$a][$b]->preregistration ?>€</p>
                            </div>
                        </div>                 
                    <?php endfor; ?>
                <?php endif; ?>                
            </div> 
        <?php endfor; ?>
        <div id="noResultSearch">Désolé, aucun tournoi trouvé dans cette zone</div>
        <div id="noResultSearchDate">Désolé, aucun tournoi trouvé compris entre ces dates</div>
        <div id="noResultSearchName">Désolé, aucun tournoi trouvé comprenant ce nom</div>
    </div>
<?php $contentIndex = ob_get_clean(); ?>

<?php require 'views/templates/index.php'; ?>