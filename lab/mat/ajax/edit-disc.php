<?php 
function heq($text){
	return htmlentities($text, ENT_QUOTES);
}

require('../config.php');
if(isset($_POST['id'])){
	extract($_POST);

	$sql = $connect_bdd -> prepare("UPDATE albums SET code_name=?, nom=?, artiste=?, genre=?, annee=?, id_titres=?, label=?, uploader=?, hits=?, likes=?, dislikes=?, pochette=?, moderation=? WHERE id=?");
	$sql -> execute(array(heq($code_name),
		heq($nom),
		heq($artiste),
		heq($genre),
		heq($annee),
		heq($titres),
		heq($label),
		heq($uploader),
		intval($hits),
		intval($likes),
		intval($dislikes),
		heq($cover),
		intval($moderation),
		intval($id)
		));
	if($sql->rowCount() == 1){
		$xt = explode(';',$titres);
		foreach ($xt as $t) {
			$ut = $connect_bdd -> prepare("UPDATE musics SET album=?, moderation=?, pochette=?, artiste=?, annee=?, genre=?, label=?, uploader=? WHERE id=? LIMIT 1");
			$ut -> execute(array(
				heq($code_name),
				intval($moderation),
				heq($cover),
				heq($artiste),
				heq($annee),
				heq($genre),
				heq($label),
				heq($uploader),
				intval($t)
			));
			$ut-> closeCursor();
		}
		$res = ['success' => true, 'touched'=>1];
	}
	else
		$res = ['success' => true, 'touched'=>0];
	$sql -> closeCursor();
}else{
	$res = ['success' => false, 'warning'=> 'Misssing post data'];
}
echo json_encode($res);
