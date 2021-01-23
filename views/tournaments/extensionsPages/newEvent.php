<div id="containerCreateEvent">
    <form action="createTournament" method="post" id="formCreateTournament">
        <div>
            <div class="divCreate" id="firstColonFormEvent">            
                <fieldset>
                    <legend>Informations Générales</legend>
                    <div>
                        <label for="title" id="labelTitle">Titre</label><input type="text" name="title" id="tournamentTitle" maxlength="50" placeholder="caractères max : 50" required>
                    </div>
                    <div>
                        <label for="datePicker">Date(s)</label><input type="text" name="datePicker" id="datePicker" class="form-control date" placeholder="Sélectionnez les dates" required>
                        <label for="optionFormat" id="labelFormat">Format</label>                    
                        <select id="optionFormat" name="optionFormat" requried>
                            <option value="">Sélectionnez format</option>
                            <option value="commander">Commander</option>
                            <option value="legacy">Legacy</option>
                            <option value="modern">Modern</option>
                            <option value="vintage">Vintage</option>
                            <option value="standard">Standard</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="maxRegis" id="labelMax">Max d'inscriptions</label><input type="number" name="maxRegis" id="inputMaxRegis" placeholder="150" required>
                        <label for="email" id="labelEmail">Votre email</label><input type="texte" name="email" id="inputEmail" placeholder="xxxxx@xxxxx.xxx" <?php if(isset($user->mail)){echo "value='$user->mail'";} ?> required>
                    </div>
                    <div>
                        <label for="tournamentInsc" id="labelRegis">Début inscriptions</label><input type="time" name="tournamentInsc" id="tournamentInsc" required> 
                        <label for="tournamentStart" id="labelStart">Début tournoi</label><input type="time" name="tournamentStart" id="tournamentStart" required>
                    </div>                
                </fieldset>
                <fieldset id="priceActivity">
                    <legend>Prix / Activités</legend>
                    <div>
                        <label for="priceBefore" id="labelPriceBefore">Pre-inscriptions</label><input type="number" name="priceBefore" id="priceBefore" placeholder="20 €"/> 
                        <label for="priceIn" id="labelPriceIn">Sur place</label><input type="number" name="priceIn" id="priceIn" placeholder="25 €"/> 
                    </div>
                    <div>     
                        <label for="refreshment" id="labelRefresh">Buvette</label><input type="checkbox" name="buvette" id="refreshment"/> 
                        <label for="beer" id="labelBeer">Bière</label><input type="checkbox" name="biere" id="beer"/> 
                        <label for="seller" id="labelSeller">Vendeur</label><input type="checkbox" name="vendeur" id="seller"/> 
                        <label for="designer" id="labelAlte">Altérateur/trice</label><input type="checkbox" name="alterateur" id="designer" /> 
                        <label for="tombola" id="labelTombola">Tombola</label><input type="checkbox" name="tombola" id="tombola"/> 
                    </div>
                </fieldset>
            </div>
        </div>
        <div>
            <div class="divCreate">
                <fieldset>
                    <legend>Adresse</legend>
                    <div id="optionAdress">
                        <div>Ajouter une adresse <img src="public/images/add.png" alt="ajout" id="addPng"></div>
                        <div id="selectAdresse">
                            <?php if(count($adresses) != 0) :?>
                                Mes adresses
                                <select name="adressList" id="adressList">
                                    <?php for ($i=0; $i < count($adresses); $i++) : ?>
                                        <option onclick=test() value="Adresse<?= $adresses[$i]->id ?>"><?= $adresses[$i]->name ?></option>
                                    <?php endfor; ?>
                                </select>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="addAdresseDiv">
                        <input type="text" name="nameAddAdress" id="nameAddAdress" placeholder="Nom adresse">
                        <input type="text" name="locationAddAdress" id="locationAddAdress" placeholder="Adresse">
                        <input type="text" name="cpAddAdress" id="cpAddAdress" placeholder="CP">
                        <input type="text" name="cityAddAdress" id="cityAddAdress" placeholder="Ville">
                        <img src="public/images/confirmer.png" id="imgAddAdress" onclick="addNewAdress()">
                    </div>
                    <p id="errorAddAdress"></p>
                    <p id="addedAddAdress"></p>
                    <label for="address" id="labelAddress">Adresse</label><input type="text" name="address" id="inputAddress" placeholder="Allée Adrienne-Lecouvreur" required <?php if(isset($adresses[0]->name)){echo 'value="'.$adresses[0]->location.'"';} ?>>
                    <label for="cp" id="labelCp">CP</label><input type="text" name="cp" id="inputCp" placeholder="75000" required <?php if(isset($adresses[0]->name)){echo 'value="'.$adresses[0]->cp.'"';} ?>>
                    <label for="city" id="labelCity">Ville</label><input type="text" name="city" id="inputCityForm" placeholder="Paris" required <?php if(isset($adresses[0]->name)){echo 'value="'.$adresses[0]->city.'"';} ?>>
                </fieldset>
                <fieldset id="descMyEvent">
                    <legend>Description</legend>
                    <textarea id="inputContent" name="inputContent"></textarea>                
                </fieldset>
                <fieldset id="rewardsLeg">
                    <legend>Récompenses</legend>
                    <table>
                        <thead>
                            <tr>
                                <th>Prix</th>
                                <th>1er</th>
                                <th>2nd</th>
                                <th>top 4</th>
                                <th>top 8</th>
                                <th>top 16</th>
                                <th>top 32</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="titleTd">10 - 20 joueurs</td>
                                <td><input type="text" name="twentyFirst" id="twentyFirst"></td>
                                <td><input type="text" name="twentySecond" id="twentySecond"></td>
                                <td><input type="text" name="twentyTopFour" id="twentyTopFour"></td>
                                <td><input type="text" name="twentyTopHeight" id="twentyTopHeight"></td>
                                <td style="background-color:#fde19a"></td>
                                <td style="background-color:#fde19a"></td>
                            </tr>
                            <tr>
                                <td class="titleTd">20 - 30 joueurs</td>
                                <td><input type="text" name="thirtyFirst" id="thirtyFirst"></td>
                                <td><input type="text" name="thirtySecond" id="thirtySecond"></td>
                                <td><input type="text" name="thirtyTopFour" id="thirtyTopFour"></td>
                                <td><input type="text" name="thirtyTopHeight" id="thirtyTopHeight"></td>
                                <td><input type="text" name="thirtyTopSixteen" id="thirtyTopSixteen"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="titleTd">30 - 50 joueurs</td>
                                <td><input type="text" name="fiftyFirst" id="fiftyFirst"></td>
                                <td><input type="text" name="fiftySecond" id="fiftySecond"></td>
                                <td><input type="text" name="fiftyTopFour" id="fiftyTopFour"></td>
                                <td><input type="text" name="fiftyTopHeight" id="fiftyTopHeight"></td>
                                <td><input type="text" name="fiftyTopSixteen" id="fiftyTopSixteen"></td>
                                <td><input type="text" name="fiftyTopThirty" id="fiftyTopThirty"></td>
                            </tr>
                            <tr>
                                <td class="titleTd">50 + joueurs</td>
                                <td><input type="text" name="fiftyMoreFirst" id="fiftyMoreFirst"></td>
                                <td><input type="text" name="fiftyMoreSecond" id="fiftyMoreSecond"></td>
                                <td><input type="text" name="fiftyMoreTopFour" id="fiftyMoreTopFour"></td>
                                <td><input type="text" name="fiftyMoreTopHeight" id="fiftyMoreTopHeight"></td>
                                <td><input type="text" name="fiftyMoreTopSixteen" id="fiftyMoreTopSixteen"></td>
                                <td><input type="text" name="fiftyMoreTopThirty" id="fiftyMoreTopThirty"></td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
            </div>

            <div class="divCreate">
                <input type="submit" value="Envoyer" id="inputSendForm">
            </div>
        </div>
    </form>
</div>