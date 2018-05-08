<?php 
require_once "../../php/config.php";
if(isset($_POST['login'], $_POST['password'])){
	extract($_POST);
	$login = htmlentities($login, ENT_QUOTES);
	$sql = $connect_bdd -> prepare("SELECT pseudo,pass,token,ban FROM membres WHERE pseudo=? OR email=? LIMIT 1");
	$sql -> execute(array($login, $login));
	list($pseudo, $pass, $token, $ban) = $sql -> fetch();
	$sql -> closeCursor();
	if(password_verify($password, $pass)){
		//matched!
		if($ban == 0){
			//not banned yet
			if(isset($remenber)){
				$expiration = time()+60*60*24*30*3; //3mois
				setcookie('membre',$pseudo,$expiration,'/');
				setcookie('token',hash('md5',$token),$expiration,'/');
			}else{
				$expiration = time()-5; //expired
				setcookie('membre',$pseudo,$expiration,'/');
				setcookie('token',hash('md5',$token),$expiration,'/');
			}
			$_SESSION['user'] = $pseudo;
			$update = $connect_bdd -> prepare("UPDATE membres SET ip=?, dernier_acces=? WHERE pseudo=? LIMIT 1");
			$update -> execute(array($_SERVER['REMOTE_ADDR'], time(), $pseudo));
			$update -> closeCursor();

			$res = ['connected' => true];
		}else{
			//banned
			$res = ['connected' => false, 'warning' => 'Ce compte est banni actuellement. Revenez plus tard.'];
		}
	}else{
		$res = ['connected' => false, 'warning' => "Identifiant ou mot de passe incorrect."];
	}
}else{
	$res = ['connected' => false, 'warning' => "Des données manquent au formulaire transmis"];
}

echo json_encode($res);