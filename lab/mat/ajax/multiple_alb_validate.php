<?php 
require_once '../config.php';
$out = array('end'=>'failed', 'message'=>'Could not process your request now');
$a = 0; $ids = array();
if(isset($_POST['disc'])){
    foreach($_POST['disc'] as $id){
        //get all titles in this disc
        $sel = $connect_bdd -> prepare('SELECT id_titres FROM albums WHERE id =? LIMIT 1');
        $sel -> execute(array(intval($id)));
        list($titres) = $sel -> fetch();
        $sel -> closeCursor();
        $titrez = explode(';', $titres);
        
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
            $ids[] = $id;
            $a++;
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
