<?php require_once "../../php/config.php";
if(!isset($_SESSION['user'])){
	die('Must be logged first.');
}
if(isset($_POST['id'], $_POST['texte'])){
	extract($_POST);
	if(trim($texte)){
		$inser = $connect_bdd -> prepare("INSERT INTO ask_reponses(demande_id,auteur,texte,date_post) VALUES(?,?,?,?)");
		$inser-> execute(array(intval($id), $_SESSION['user'], htmlentities($texte, ENT_QUOTES), time()));
		$inser->closeCursor();
		echo json_encode(['success'=>true]);
	}else{
		echo json_encode(['success'=>false, 'warning'=>'Le texte est trop court.']);
	}
}