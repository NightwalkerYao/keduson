<?php require_once "../../php/config.php";
if(!isset($_SESSION['user'])){
	die('Must be logged first.');
}
if(isset($_GET['user'])){
	extract($_GET);
	$us = $connect_bdd -> prepare("SELECT * FROM membres WHERE pseudo=? LIMIT 1");
	$us -> execute(array(htmlentities($user, ENT_QUOTES)));
	$c = $us -> rowCount();
	$u = $us -> fetch(PDO::FETCH_OBJ);
	$us -> closeCursor();
	if($c>0){
		echo json_encode(['success'=> true, 'username'=>$u->pseudo, 'pic'=>$u->avatar, 'regdate'=>date('d/m/Y', $u->inscription), 'lastLog'=>date('d/m/Y H:i', $u->dernier_acces)]);
	}else{
		echo json_encode(['success'=>false, 'warning'=>'Utilisateur introuvable.']);
	}
}