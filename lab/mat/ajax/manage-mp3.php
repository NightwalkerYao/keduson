<?php require('../config.php');
if(isset($_POST['id'], $_POST['action'])){
    extract($_POST);
    if($action == 'delete'){
        $del = $connect_bdd -> prepare('DELETE FROM musics WHERE id=?');
        $del -> execute(array(intval($id)));
        $cc = $del -> rowCount();
        $del -> closeCursor();
        if(intval($cc)){
            @unlink('../../../temp_upz/'.$file);
            @unlink('../../../files/'.$file);
            $del2 = $connect_bdd -> prepare('DELETE FROM music_comments WHERE titre_cn=?');
            $del2 -> execute(array($cn));
            $del2 -> closeCursor();
            
            $res = array('end'=>'done', 'success'=>true, 'id'=>$id);
        }else{
            $res = array('end'=>'done', 'message'=>'Nothing touched', 'id'=>$id);
        }
    }elseif($action == 'validate'){
        $val = $connect_bdd -> prepare('UPDATE musics SET moderation=0 WHERE id=?');
        $val -> execute(array(intval($id)));
        $cc = $val -> rowCount();
        $val -> closeCursor();
        if(intval($cc)){
            $res = array('end'=>'done', 'success'=>true, 'id'=>$id);
            @rename('../../../temp_upz/'.$file, '../../../files/'.$file);
        }else{
            $res = array('end'=>'done', 'message'=>'Nothing touched', 'id'=>$id);
        }
    }
}else{
    $res = array('end'=>'undone', 'message'=>'Missing params', 'id'=>0);
}

echo json_encode($res);
