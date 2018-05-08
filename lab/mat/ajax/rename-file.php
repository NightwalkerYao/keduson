<?php 

if(isset($_POST['old'], $_POST['new'])){
    extract($_POST);
    $ren = @rename($old, $new);
    if($ren){
        //update the db in case the file is from musics list.
        include '../config.php';
        $old1 = str_replace($_SERVER['DOCUMENT_ROOT'].'/files/', '', $old);
        $new1 = str_replace($_SERVER['DOCUMENT_ROOT'].'/files/', '', $new);
        $updt = $connect_bdd -> prepare('UPDATE musics SET nom_fichier=? WHERE nom_fichier=?');
        $updt -> execute(array($new1, $old1));
        $updt -> closeCursor();
        
        $res=['success'=>true];
    }else
        $res = ['success'=>false, 'message'=>'Could not rename this file, failed'];
}else{
    $res = ['success'=>false, 'message'=>'Missing post data.'];
}
echo json_encode($res);
