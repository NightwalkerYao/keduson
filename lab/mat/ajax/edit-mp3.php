<?php 
function heq($text){
	return htmlentities($text, ENT_QUOTES);
}

require('../config.php');
if(isset($_POST['id'])){
	extract($_POST);

	$sql = $connect_bdd -> prepare("UPDATE musics SET code_name=?, titre=?, artiste=? , album=?, piste=?, genre=?, annee=?, duree=?, label=?, uploader=?, hits=?, likes=?, dislikes=?, taille=?, pochette=?, moderation=? WHERE id=?");
	$sql -> execute(array(heq($code_name),
		heq($titre),
		heq($artiste),
		heq($album),
		heq($piste),
		heq($genre),
		heq($annee),
		heq($duree),
		heq($label),
		heq($uploader),
		intval($hits),
		intval($likes),
		intval($dislikes),
		intval($taille),
		heq($cover),
		intval($moderation),
		intval($id)
		));
	if($sql->rowCount() == 1)
		$res = ['success' => true, 'touched'=>1];
	else
		$res = ['success' => true, 'touched'=>0];
	$sql -> closeCursor();
}else{
	$res = ['success' => false, 'warning'=> 'Misssing post data'];
}
echo json_encode($res);
