<?php 
require_once '../config.php';
if(isset($_POST['colonne'], $_POST['id'], $_POST['value'])){
    extract($_POST);
    $sql = 'UPDATE publicites SET '.$colonne.'=? WHERE id=?';
    $rr = $connect_bdd -> prepare($sql);
    $rr -> execute(array($value, intval($id)));
    $tchd = $rr-> rowCount();
    $rr -> closeCursor();
    if(intval($tchd)){
        $out = ['end' => 'done', 'success'=> true];
    }else
        $out = ['end'=>'done', 'success'=>false, 'message'=>'Done but nothing touched'];
}else
    $out = ['end'=>'fail', 'message'=>'Could not process your request at this time.'];

echo json_encode($out);
