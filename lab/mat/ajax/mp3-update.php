<?php 
require('../config.php');
if(isset($_POST['id'], $_POST['colonne'], $_POST['value'])){
    extract($_POST);
    $stm = 'UPDATE musics SET '.$colonne.'=? WHERE id=?';
    $upd = $connect_bdd-> prepare($stm);
    $upd -> execute(array($value, intval($id)));
    $done = $upd -> rowCount();
    if($done){
        $rep = array('end'=>'done', 'success'=> true);
    }else{
        $rep = array('end'=>'done', 'message'=>'Nothing touched');
    }
}else{
    $rep = array('end'=>'not processed');
}
echo json_encode($rep);
