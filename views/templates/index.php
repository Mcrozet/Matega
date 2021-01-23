<!DOCTYPE html>
<html lang="fr">
<head>
    <title>MATEGA</title>
    <link rel="icon" type="images/" href="public/images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rassemblement des tournois Magic The Gathering">  <!-- Description de la page  -->
    <meta name="title" content="MATEGA">  <!-- Titre de la page  -->
    <meta name="keywords" content="magic the gathering" /> <!-- Mots clefs -->

	<!-- OPEN GRAPH -->
    <!-- Les propriétés open graph apparaissent quand on transmet le lien sur Facebook, twitter, discord ... -->
    <!-- Une fenêtre apparait sous le lien avec les informations suivante -->
	<meta property="og:title" content="Matega" /> <!-- Le titre de la fenêtre -->
	<meta property="og:type" content="website" /> <!-- type, ici site web  -->
	<meta property="og:url" content="https://matega/home" /> <!-- L'url de l'accueil  -->
	<meta property="og:image" content="../images/blackLotus.jpg" /> <!-- Mettre une image qui apparaitra dans le lien -->
	<meta property="og:image:width" content="200" /> <!-- Taille image -->
	<meta property="og:description" content="Rassemblement des tournois Magic The Gathering" /> <!-- Description -->
    
	<link rel="stylesheet" type="text/css" href="public/css/index.css">
	<link rel="stylesheet" type="text/css" href="public/css/tournament.css">
    <link rel="stylesheet" type="text/css" href="public/css/mediaQueries.css">    
    <link rel="stylesheet" type="text/css" href="public/css/datePicker.css">    
    <link rel="stylesheet" type="text/css" href="public/css/user.css">    
    <link rel="stylesheet" type="text/css" href="public/css/myEvents.css">    
    <link rel="stylesheet" href="public/assets/font-awesome-4.7.0/css/font-awesome.min.css">
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
    <script src="https://cdn.tiny.cloud/1/0hkhpc4x9cs6zila14oyvwobq0nvvwt8jz83d0b6k58i1q6s/tinymce/5/tinymce.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <link rel="stylesheet" type="text/css" href="https://csshake.surge.sh/csshake.min.css">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

</head>
<body>
    <header>
		<div id="headerBar">	
            <img id="title" src="public/images/logo.png")>
            <div id="linkMenu">
                <a href="home" id="homeLink"> <i class="fa fa-home" aria-hidden="true"></i> Accueil</a>
                <?php if (isset($_SESSION['id'])) : ?>
                    <a href="userProfil" id="userProfilLink"> <i class="fa fa-user" aria-hidden="true"></i> <?= $_SESSION['name'] ?> </a>
                    <a href="userEvents" id="userEventsLink"> <i class="fa fa-trophy" aria-hidden="true"></i> Mes tournois</a>
                    <a href="signOut" id="decoLink"> <i class="fa fa-sign-in" aria-hidden="true"></i> Déconnexion</a>
                <?php else: ?>
                    <a href="signIn" id="connexionLink"> <i class="fa fa-sign-in" aria-hidden="true"></i> Connexion</a>
                <?php endif; ?>
            </div>
		</div>
    </header>

    <div id="pictureBackground"></div>

    <div>
        <?= $contentIndex ?>
    </div>
    
	<script src="public/js/index.js"></script>
	<script src="public/js/tournaments.js"></script>
	<script src="public/js/user.js"></script>
	<script src="public/js/myEvent.js"></script>
	<script src="public/js/datasBank.js"></script>
</body>
</html>