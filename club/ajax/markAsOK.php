<?php require_once "../../php/config.php";
if(!isset($_SESSION['user'])){
	die('Must be logged first.');
}
if(isset($_GET['id'])){
	$s = $connect_bdd-> prepare("UPDATE ask_demandes SET OK=1 WHERE id=? AND par=?");
	$s -> execute(array(intval($_GET['id']), $_SESSION['user']));
	$s->closeCursor();
}