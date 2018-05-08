<?php require('../config.php');
if(isset($_POST['id'], $_POST['action'])){
    extract($_POST);
    
    //get all titles in this disc
    $sel = $connect_bdd -> prepare('SELECT id_titres FROM albums WHERE id =? LIMIT 1');
    $sel -> execute(array(intval($id)));
    list($titres) = $sel -> fetch();
    $sel -> closeCursor();
    $titrez = explode(';', $titres);
        
    if($action == 'delete'){
        foreach($titrez as $titre){
            //get audio file to unlink
            $selt = $connect_bdd -> prepare('SELECT nom_fichier,code_name FROM musics WHERE id =? LIMIT 1');
            $selt -> execute(array(intval($titre)));
            list($file, $code_name) = $selt -> fetch();
            $selt -> closeCursor();
        
            $delt = $connect_bdd -> prepare('DELETE FROM musics WHERE id=?');
            $delt -> execute(array(intval($titre)));
            $cct = $delt -> rowCount();
            $delt -> closeCursor();
            if(intval($cct)){
                @unlink('../../../files/'.$file);
                $del2 = $connect_bdd -> prepare('DELETE FROM music_comments WHERE titre_cn=?');
                $del2 -> execute(array($code_name));
                $del2 -> closeCursor();
            }
        }
        //delete its comments 
        $delc = $connect_bdd -> prepare('DELETE FROM album_comments WHERE album_cn=?');
        $delc -> execute(array($cn));
        $cc = $delc -> rowCount();
        $delc -> closeCursor();
        
        $del = $connect_bdd -> prepare('DELETE FROM albums WHERE id=?');
        $del -> execute(array(intval($id)));
        $cc = $del -> rowCount();
        $del -> closeCursor();
        if(intval($cc)){
            $res = array('end'=>'done', 'success'=>true, 'id'=>$id);
        }else{
            $res = array('end'=>'done', 'message'=>'done but Nothing touched', 'id'=>$id);
        }
    }elseif($action == 'validate'){
    
        foreach($titrez as $titre){
            //get audio file to move
            $selt = $connect_bdd -> prepare('SELECT nom_fichier FROM musics WHERE id =? LIMIT 1');
            $selt -> execute(array(intval($titre)));
            list($file) = $selt -> fetch();
            $selt -> closeCursor();
        
            $delt = $connect_bdd -> prepare('UPDATE musics SET moderation=0 WHERE id=?');
            $delt -> execute(array(intval($titre)));
            $cct = $delt -> rowCount();
            $delt -> closeCursor();
            if(intval($cct)){
                @rename('../../../temp_upz/'.$file, '../../../files/'.$file);
            }
        }
        $del = $connect_bdd -> prepare('UPDATE albums SET moderation=0 WHERE id=?');
        $del -> execute(array(intval($id)));
        $cc = $del -> rowCount();
        $del -> closeCursor();
        if(intval($cc)){
            $res = array('end'=>'done', 'success'=>true, 'id'=>$id);
        }else{
            $res = array('end'=>'done', 'message'=>'done but Nothing touched', 'id'=>$id);
        }
    }
}else{
    $res = array('end'=>'undone', 'message'=>'Missing params', 'id'=>0);
}

echo json_encode($res);
