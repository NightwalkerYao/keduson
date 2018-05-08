<?php 
require '../config.php';
if(isset($_REQUEST['fname'], $_REQUEST['req'])){
	extract($_REQUEST);
	$c = $connect_bdd -> prepare('SELECT * FROM musics WHERE nom_fichier=?');
	$c -> execute(array($fname)) or die('erreur');
	$res = intval($c -> rowCount());
	$c -> closeCursor();
	if($res>0){
		$o = ['success' => true, 'k' => $req];
	}else{
		$o = ['success' => false, 'k'=>$req];
	}
	$o['res'] = $res;
}else
	$o = ['success' => false, 'message' => 'request failed'];

echo json_encode($o);