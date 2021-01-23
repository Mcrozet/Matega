<?php ob_start(); ?>

    <div id="containerMyEvents">
        <h1>Mes tournois</h1>
        <div id="buttons">
            <button class="buttonEvents" id="newEvent">Nouvelle événement</button>
            <button class="buttonEvents" id="eventsCreated">Evénements en cours</button>
            <button class="buttonEvents" id="eventsFinished">Evénements terminés</button>
        </div>
    </div>
    <div id="containerBankDatas">
        <h1>Compte Bancaire</h1>

        <h2>Modifier données bancaires</h2>

        <form action="updateBankDatas" method="POST">
            <input type="hidden" name="idContest" value="<?= $get['id'] ?>">

            <label for="nameBank">Titulaire du compte</label>
            <input type="text" id="nameBankInput" name="nameBank" <?php if(isset($datasBank->name)){echo "value='$datasBank->name'";} ?>>

            <label for="iban">IBAN</label>
            <input type="text" id="ibanInput" name="iban" <?php if(isset($datasBank->iban)){echo "value='$datasBank->iban'";} ?>>

            <label for="bic">BIC/SWIFT</label>
            <input type="text" id="bicInput" name="bic" <?php if(isset($datasBank->bic)){echo "value='$datasBank->bic'";} ?>>

            <label for="bank">Banque</label>
            <input type="text" name="bank" <?php if(isset($datasBank->bankName)){echo "value='$datasBank->bankName'";} ?>>

            <input type="submit" value="Modifier mes données bancaires">
        </form>

        <h1>Adresse Paypal</h1>
        <form action="paypalAdress">
            <label for="paypalAdress">Adresse mail</label>
            <input type="text" name="paypalAdress" <?php if(isset($datasBank->paypalAdress)){echo "value='$datasBank->paypalAdress'";} ?>>
            <input type="submit" value="Confirmer">
        </form>
    </div>


<?php $contentIndex = ob_get_clean(); ?>

<?php require 'views/templates/index.php'; ?>