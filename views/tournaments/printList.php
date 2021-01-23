<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="public/css/print.css">
</head>
<body onload="window.print()">

    <h1>Tournoi : <?= $detail->name ?></h1>

    <br /> 
    <br />

    <table>
        <thead>
            <tr>
                <th></th>
                <th id="lastName">NOM</th>
                <th id="firstName">PRENOM</th>
                <th id="dci">DCI</th>
                <th>COMMENTAIRE</th>
                <th>DeckList</th>
                <th>PAYE</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i=0; $i < count($registered); $i++) : ?>
                <tr>
                    <td>#<?= $i ?></td>
                    <td><?= $registered[$i]->lastName ?></td>
                    <td><?= $registered[$i]->firstName ?></td>
                    <td><?= $registered[$i]->dci ?></td>
                    <td><?= $registered[$i]->comment ?></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    

    <section id='printSection'>
        
    </section>
</body>
</html>
