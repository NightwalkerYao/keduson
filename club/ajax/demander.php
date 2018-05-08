<?php require_once "../../php/config.php";
if(!isset($_SESSION['user'])){
	die(json_encode(['success' => false, 'warning' => 'Unknown username']));
}
if(isset($_POST['titre'], $_POST['artiste'], $_POST['album'])){
	extract($_POST);
	if(trim($artiste) && (trim($titre) || trim($album))){
		$add = $connect_bdd -> prepare("INSERT INTO ask_demandes(par,artiste,titre,album,date_post) VALUES(?,?,?,?,?)");
		$add -> execute(array($_SESSION['user'], htmlentities($artiste, ENT_QUOTES), htmlentities($titre, ENT_QUOTES), htmlentities($album, ENT_QUOTES), time()));
		$add -> closeCursor();
		die(json_encode(['success' => true]));
	}else{
		die(json_encode(['success' => false, 'warning' => 'Champ requis manquant']));
	}
}