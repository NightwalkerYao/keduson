<div class="clear" style="margin: 1em auto; width: 100%; height: 2px; background-color: #2e2e2e;"></div>
<form method="post" id="connexionF">
	<div class="inform">
		<em style="color: pink;">Vous devez vous identifier pour publier du contenu ici.</em>
		<br>
		<?=isset($log_error) ? '<em style="color: red;">'.$log_error.'</em><br>' : false;?>
		<label for="username">Identifiant:</label> <input value="<?=isset($_POST['username']) ? htmlspecialchars($_POST['username']) : false;?>" required type="text" name="username" id="username">
		<br>
		<label for="password">Mot de passe:</label> <input type="password" name="password" id="password">
		<br>
		<input type="hidden" name="remenber" value="<?=md5('RtccvBgf');?>">
		<label> &nbsp;</label><input type="submit" value="Connexion"> | <a href="#inscriptionF">inscription</a>
	</div>
</form>
<div class="clear" style="margin: 1em auto; width: 100%; height: 2px; background-color: #2e2e2e;"></div>
<form method="post" id="inscriptionF" action="#inscriptionF">
	<div class="inform">
		<em style="color: pink;">Nouveau membre: inscription.</em>
		<br>
		<?=!empty($reg_error) ? '<em style="color: red;">'.implode('<br>', $reg_error).'</em><br>' : false;?>
		<label for="rusername">Identifiant:</label> <input value="<?=isset($_POST['rusername']) ? htmlspecialchars($_POST['rusername']) : false;?>" required type="text" name="rusername" id="rusername">
		<br>
		<label for="rmail">Adresse e-mail:</label> <input value="<?=isset($_POST['remail']) ? htmlspecialchars($_POST['remail']) : false;?>" required type="email" name="remail" id="rmail">
		<br>
		<label for="rpassword">Mot de passe:</label> <input required type="password" name="rpassword" id="rpassword">
		<br>
		<label for="rpassword2">Mot de passe encore:</label> <input type="password" name="rpassword2" id="rpassword2">
		<br>
		<label> &nbsp;</label><input type="submit" value="inscription"> | <a href="#connexionF">connexion</a>
	</div>
</form>