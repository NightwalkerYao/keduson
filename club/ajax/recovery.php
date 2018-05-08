<?php 
require_once "../../php/config.php";
if(isset($_POST['email'])){
	$mail = $_POST['email'];
	if(preg_match('#^[a-z0-9.+_-]+@[a-z0-9._-]+\.[a-z0-9]{2,12}$#is', $mail)){
		$tok = $connect_bdd -> prepare("SELECT id,pseudo,token FROM membres WHERE email=? LIMIT 1");
		$tok -> execute(array($mail));
		list($id, $pseudo, $token) = $tok -> fetch();
		$tok -> closeCursor();

		if(intval($id)){
			//found
			$encoded = base64_encode($id.':'.$token);
			$reg = $connect_bdd -> prepare("INSERT INTO pass_reset(pseudo, user_id, token, stamp) VALUES(?,?,?,?)");
			$reg -> execute(array($pseudo, $id, $encoded , time()));
			$reg -> closeCursor();

			$url = ROOT_SANS.'/club/mdp/'.$encoded;
			//email script here
			$res = ['success' => true, 'url' => $url];
		}else{
			$res = ['success' => false, 'warning' => 'Aucun compte trouvé pour votre e-mail'];
		}
	}else{
		$res = ['success' => false, 'warning' => 'E-mail invalide'];
	}
}else{
	$res = ['success' => false, 'warning' => 'Missing form datas..'];
}

echo json_encode($res);
