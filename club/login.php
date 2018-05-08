<!DOCTYPE html>
<html>
<head>
	<title>Le Club - Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <link rel="stylesheet" type="text/css" href="style/login-style.css">
</head>
<body>
	<header style="z-index: 1000;">
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
	<section style="margin-top: 10em;">
		<form class="formulaire connexion" action="log.php" method="post">
			<p class="clearfix">
				<label for="login">Utilisateur</label>
				<input type="text" name="login" id="login" placeholder="Pseudo ou E-mail" >
			</p>
			<p class="clearfix">
				<label for="password">Mot de passe</label>
				<input type="password" name="password" id="password" placeholder="Mot de passe" > 
			</p>
			<p class="clearfix">
				<input type="checkbox" name="remember" id="remember" value="oui" checked="checked">
				<label for="remember"> se souvenir de moi</label>
			</p>
			<!-- <br> -->
			<center class="clearfix">
				<input type="submit" name="connexion" value="CONNEXION">
			</center>
			<p class="clearfix">
				<a class="tomdpoublie" href="#">Mot de passe perdu</a>
			</p> 
			<p class="clearfix">
				Nouveau? <a class="toregister" href="#">Inscription</a>
			</p>     
		</form>

		<form class="formulaire mdpoublie" action="login.php" method="post">
			<p class="clearfix">
				<label for="mmail">E-mail</label>
				<input type="email" name="email" id="mmail" placeholder="Adresse e-mail"> 
			</p>
			<center class="clearfix">
				<input type="submit" name="resetmdp" value="Envoyer">
			</center>
			<p class="clearfix">
				Nouveau? <a class="toregister" href="#">Inscription</a>
			</p>     
		</form>

		<form class="formulaire inscription" action="signup.php" method="post">
			<p class="clearfix">
				<label for="slogin">Utilisateur</label>
				<input type="text" name="login" id="slogin" placeholder="Nom d'utilisateur">
			</p>
			<p class="clearfix">
				<label for="spassword1">Mot de passe</label>
				<input type="password" name="password" id="spassword1" placeholder="Mot de passe"> 
			</p>
			<!-- <br> -->
			<p class="clearfix">
				<label for="spassword2">Confirmer</label>
				<input type="password" name="password" id="spassword2" placeholder="Mot de passe"> 
			</p>
			<!-- <br> -->
			<p class="clearfix">
				<label for="smail">E-mail</label>
				<input type="email" name="email" id="smail" placeholder="Adresse e-mail"> 
			</p>
			<!-- <br> -->
			<center class="clearfix">
				<label for="pic" title="Choisir un fichier" style="background-color: #18385B; padding: 4px 6px; width: 70%; cursor: pointer; float: none;">Ajouter avatar</label>
				<input type="file" style="display: none; width: 0; height: 0;" name="pic" id="pic" accept="image/*"> 
				<input type="hidden" name="avatar" id="avatar" value="default.png">
				<br>
				<br>
			</center>
		<!-- 	<br> -->
			<center class="clearfix">
				<input type="submit" name="register" value="INSCRIPTION">
			</center>
			<p class="clearfix">
				Déjà membre? <a class="toconnect" href="#">Connexion</a>
			</p>      
		</form>
	</section>
	<div id="avg"></div>
	<script type="text/javascript" src="scripts/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="scripts/login.js"></script>
</body>
</html>