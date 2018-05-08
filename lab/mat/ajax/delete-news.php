<?php
require_once '../config.php';
if(isset($_GET['id'])){
    extract($_GET);
    $do = $connect_bdd -> prepare('DELETE FROM nouvelles WHERE id=?');
    $do -> execute(array(intval($id)));
    $tchd = $do -> rowCount();
    $do -> closeCursor();
    if(intval($tchd)){
        $out = ['end' => 'done', 'success'=> true];
    }else
        $out = ['end'=>'done', 'success'=>false, 'message'=>'Done but nothing touched'];
}else
    $out = ['end'=>'fail', 'message'=>'Could not process your request at this time.'];

echo json_encode($out);
