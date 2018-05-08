<?php 
require_once '../config.php';
if(!empty($_POST)){
    extract($_POST);
    $ins = $connect_bdd -> prepare('INSERT INTO publicites(regie,_type,support,dimensions,code,emplacement,affichable) VALUES(:regie,:_type,:support,:dimensions,:code,:emplacement,:affichable)');
    $ins -> execute(array('regie'=>$regie, '_type'=>$_type, 'support'=>$support, 'dimensions'=>$dimensions, 'code'=>$code, 'emplacement'=>$emplacement, 'affichable'=>$affichable));
    $id = $connect_bdd -> lastInsertId();
    $ins -> closeCursor();
    $out = ['end'=>'done', 'success'=>true, 'content'=>$_POST, 'id'=>$id];
}else
    $out = ['end'=>'done', 'success'=>false, 'message'=>'Missing data in the request'];
    
echo json_encode($out);
