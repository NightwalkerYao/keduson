<?php
require_once('../config.php');
if(isset($_POST['id'], $_POST['file'])){
	extract($_POST);
	$del = $connect_bdd -> prepare("DELETE FROM temp_ups WHERE id=?");
	$del -> execute(array(intval($id)));
	$c = $del -> rowCount();
	$del -> closeCursor();
	if($c>0){
		@unlink('../../../temp_upz/'.$file);
		$res = ['success'=>true, 'id'=>$id];
	}else{
		$res = ['success'=>false, 'message'=>'Entree introuvable'];
	}
}else{
	$res = ['success'=>false, 'message'=>'Missing post datas'];
}
echo json_encode($res);