<?php 
require_once '../config.php';
$out = array('end'=>'failed', 'message'=>'Could not process your request now');
$a = 0; $ids = array();
if(isset($_POST['mp3'])){
    foreach($_POST['mp3'] as $id){
        $del = $connect_bdd -> prepare('DELETE FROM musics WHERE id=?');
        $del -> execute(array(intval($id)));
        $cc = $del -> rowCount();
        $del -> closeCursor();
        if(intval($cc)){
            $ids[] = $id;
            $a++;
            @unlink('../../../temp_upz/'.$file);
            @unlink('../../../files/'.$file);
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
