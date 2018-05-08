<?php 
require_once "../../php/config.php";
//{"login": Login, "pass": Pass1, "mail": Mail, "avatar": Avatar};
if(isset($_POST['login'], $_POST['pass'], $_POST['mail'])){
	extract($_POST);
	if(!preg_match("#^[a-zA-Z0-9\._\-]{3,25}$#", $login))
		die(json_encode(array('success' => false, 'warning' => 'Le pseudo n\'est pas valide.')));
	if(strlen($pass)<6)
		die(json_encode(array('success' => false, 'warning' => 'Le mot de passe est trop court.')));
	if(!preg_match('#^[a-z0-9.+_-]+@[a-z0-9._-]+\.[a-z0-9]{2,12}$#is', $mail))
		die(json_encode(array('success' => false, 'warning' => 'L\'adresse mail est invalide.')));

	$check_ex = $connect_bdd -> prepare("SELECT COUNT(*) AS nt FROM membres WHERE pseudo=? OR email=? LIMIT 1");
	$check_ex -> execute(array($login, $mail));
	list($nt) = $check_ex -> fetch();
	$check_ex -> closeCursor();
	if($nt>0)
		die(json_encode(array('success' => false, 'warning' => 'Identifiants déjà en utilisation.')));

	$tok = md5(uniqid());
	$reg = $connect_bdd -> prepare("INSERT INTO membres(pseudo, pass, email, avatar, token, ip, inscription) VALUES(?,?,?,?,?,?,?)");
	$reg -> execute(array($login,password_hash($pass, PASSWORD_BCRYPT), $mail, $avatar, $tok, $_SERVER['REMOTE_ADDR'], time()));
	$reg -> closeCursor();
	die(json_encode(array('success' => true)));
}else{
	die(json_encode(array('success' => false, 'warning' => 'WTF?')));
}
