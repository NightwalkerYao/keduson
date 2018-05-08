<?php 
require_once '../config.php';
$out = array('end'=>'failed', 'message'=>'Could not process your request now');
$a = 0; $ids = array();
if(isset($_POST['mp3'])){
    foreach($_POST['mp3'] as $id){
        $val = $connect_bdd -> prepare('UPDATE musics SET moderation=0 WHERE id=?');
        $val -> execute(array(intval($id)));
        $cc = $val -> rowCount();
        $val -> closeCursor();
        if(intval($cc)){
            $ids[] = $id;
            $a++;
            @rename('../../../temp_upz/'.$file, '../../../files/'.$file);
        }
    }
    if($a){
        $out['end'] = 'complete';
        $out['success'] = true;
        $out['ids'] = $ids;
    }else{
        $out['message'] = 'done but Nothing touched';
    }
}else{
    $out['message'] = 'Missing post datas';
}

echo json_encode($out);
