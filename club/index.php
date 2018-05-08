<?php require_once "../php/config.php";
if(!isset($_SESSION['user'])){
	header("Location: login.php");
	exit;
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Le Club</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1" >
    <link rel="stylesheet" type="text/css" href="style/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="style/avgrund.css">
    <!-- <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Hind" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet"> -->
</head>
<body>
	<header style="display: none;">
		<nav>
			<div class="logo"><span>Le <span class="begining-c">C</span>lub!</span></div>
			
			<li><a href="../" title="Quitter le club et retourner aux téléchargements">&#8689; Retour sur KDS</a></li>
			<li><a data-tik="Shoutbox" data-content="shoutbox" class="chargeable" href="#" title="La Shoutbox est ouverte">&#9749; Shoutbox</a></li>
			<li><a data-tik="Demande" data-content="demander" class="chargeable" href="#" title="Demander un morceau/album">&#9843; Faire une demande</a></li>
			<li><a data-tik="Patientez" data-content="combler" class="chargeable" href="#">&#9745; Combler une demande</a></li>
			<li><a data-tik="PlayList" data-content="playlist" class="chargeable" href="#" title="Sélection spéciale par le Club">&#9782; La PlayList</a></li>
			<li><a data-tik="Deconnexion" data-content="exit" class="chargeable" href="#" title="Se déconnecter du Club">&#9899; Quitter</a></li>
		</nav>
	</header>
	<div id="needJS" style="color: white; background-color: #142B4D; font-family: sans-serif; padding: 1em; margin: 0;" align="center">
		<h1>Impossible de charger le contenu de la page.</h1>
		<p>Bonjour, il semble que JavaScript n'est pas actif dans votre Navigateur Web. Il n'est donc pas possible de charger le contenu de cette page.
			<br>
		Veillez activer JavaScript et recharger la page.</p>
	</div>
	<section id="section1" style="display: none;" >
		<div class="on-the-club" align="center" id="activeNow">Actifs: 0</div>
		<main>

		</main>

	</section>
	<footer>
		
	</footer>
	<script type="text/javascript" src="scripts/jquery-3.3.1.min.js"></script>
	<!-- <script type="text/javascript" src="scripts/jquery-ui.min.js"></script> -->
	<script type="text/javascript" src="scripts/club.js"></script>
</body>
</html>