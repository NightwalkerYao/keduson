<?php 
require_once '../config.php';
$out = array('end'=>'failed', 'message'=>'Could not process your request now');
$a = 0; $ids = array();
if(isset($_POST['disc'])){
    foreach($_POST['disc'] as $id){
        //get all titles in this disc
        $sel = $connect_bdd -> prepare('SELECT id_titres,code_name FROM albums WHERE id =? LIMIT 1');
        $sel -> execute(array(intval($id)));
        list($titres, $cn) = $sel -> fetch();
        $sel -> closeCursor();
        $titrez = explode(';', $titres);
        
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
        //$cc = $delc -> rowCount();
        $delc -> closeCursor();
        
        $del = $connect_bdd -> prepare('DELETE FROM albums WHERE id=?');
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
        
