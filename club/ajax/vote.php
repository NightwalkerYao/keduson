<?php require_once "../../php/config.php";
if(!isset($_SESSION['user'])){
	header("Location: login.php");
	exit;
}
if(isset($_GET['id'], $_GET['choix'])){
	extract($_GET);
	$choix = intval($choix);
	$id = intval($id);
	if($choix<1 OR $choix>3){
		die(json_encode(['success'=>false]));
	}

	$gvl = $connect_bdd -> prepare("SELECT voteurs FROM votes WHERE id=? LIMIT 1");
	$gvl -> execute(array($id));
	list($vtrs) = $gvl -> fetch();
	$gvl -> closeCursor();

	$xp = explode(';', $vtrs);
	if(!in_array($_SESSION['user'], $xp)){
		$sql = "UPDATE votes SET choix$choix=choix$choix+1, voteurs=? WHERE id=$id";
		$vt = $connect_bdd -> prepare($sql);
		$vt -> execute(array($vtrs.$_SESSION['user'].';'));
		$vt -> closeCursor();
		
		$gv = $connect_bdd->prepare("SELECT * FROM votes WHERE id=? LIMIT 1");
		$gv->execute(array($id));
		$v = $gv -> fetch(PDO::FETCH_OBJ);
		$gv -> closeCursor();

		$av = $v->choix1 + $v->choix2 + $v->choix3;
		$c1p = round((($v->choix1 * 100) / $av), 2);
		$c2p = round((($v->choix2 * 100) / $av), 2);
		$c3p = round((($v->choix3 * 100) / $av), 2);

		$res = [];
		$progress = [$c1p, $c2p, $c3p];
		$width = [$c1p, $c2p, $c3p];
		$res['success'] = true;
		$res['progress'] = $progress;
		$res['width'] = $width;
		die(json_encode($res));
	}
}