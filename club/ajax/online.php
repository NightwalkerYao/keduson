<?php require_once "../../php/config.php";
if(!isset($_SESSION['user'])){
	header("Location: login.php");
	exit;
}
$ons = $connect_bdd -> prepare('SELECT COUNT(*) AS onl FROM live_stats');
$ons -> execute();
list($onl) = $ons -> fetch();
echo json_encode(['on'=>$onl]);