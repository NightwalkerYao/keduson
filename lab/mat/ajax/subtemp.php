<?php
$out = array("end"=>"fail", "message"=>'');
$uploader = "888"; //to be adapted

if(isset($_POST['artist'], $_POST['title']/*, $_POST['album'], $_POST['genre'], $_POST['year'], $_POST['track_no'], $_POST['duration'], $_POST['label']*/, $_POST['upload_id']/*, $_POST['cover']*/, $uploader)){
    require_once('../config.php');
    $uploader = $_POST['uploader'];
    $up_existe = $connect_bdd -> prepare("SELECT * FROM temp_ups WHERE id=:id LIMIT 1");
    $up_existe -> execute(array('id'=>intval($_POST['upload_id'])));
    $re = $up_existe->fetch();
    $cnt = $up_existe->rowCount();
    $up_existe -> closeCursor();
    
    if($cnt){ // existe!
        $fname = $re['store_name'];
        if(file_exists('../../../temp_upz/'.$fname)){ // another OK
            if(strlen(strip_tags(trim($_POST['artist'])))>=2 && strlen(strip_tags(trim($_POST['title'])))>=1){ //don't like empty things!
                $fsize = filesize('../../../temp_upz/'.$fname);

                //moving audio file from temp dir
                if(!is_dir('../../../files/'.date('Y').'/'.date('m').'/users_uploads'))
                    mkdir('../../../files/'.date('Y').'/'.date('m').'/users_uploads', 0777, true);
                rename('../../../temp_upz/'.$fname, '../../../files/'.date('Y').'/'.date('m').'/users_uploads/'.$fname);
                $new_path = date('Y').'/'.date('m').'/users_uploads/'.$fname;
                //adding
                $add = $connect_bdd -> prepare('INSERT INTO musics(nom_fichier,code_name,artiste,titre,album,genre,piste,annee,duree,pochette,label,taille,uploader,date_upload) VALUES(:nom_fichier, :code_name, :artiste, :titre, :album, :genre, :piste, :annee, :duree, :pochette, :label, :taille, :uploader, :date_upload)');
                $add -> execute(array('nom_fichier'=>$new_path, 'code_name'=>strtolower(urlencode_2($_POST['artist'].'-'.$_POST['title'])), 'artiste'=>htmlentities($_POST['artist'], ENT_QUOTES), 'titre'=>htmlentities($_POST['title'], ENT_QUOTES), 'album'=>htmlentities(@$_POST['album'], ENT_QUOTES), 'genre'=>htmlentities(@$_POST['genre'], ENT_QUOTES),
                'piste'=>intval(@$_POST['track_no']), 'annee'=>intval(@$_POST['year']), 'duree'=>htmlentities(@$_POST['duration'], ENT_QUOTES), 'pochette'=>htmlentities(@$_POST['cover'], ENT_QUOTES), 'label'=>htmlentities(@$_POST['label'], ENT_QUOTES), 'taille'=>$fsize, 'uploader'=>$uploader, 'date_upload'=>$re['date_upload']));
                $insKey = $connect_bdd->lastInsertId();
                $add -> closeCursor();
                
                //deleting the temps
                $del = $connect_bdd->prepare('DELETE FROM temp_ups WHERE id=? LIMIT 1');
                $del -> execute(array(intval($_POST['upload_id'])));
                $del -> closeCursor();
                
                //setting outputz
                $out['end'] = 'success';
                $out['id'] = $insKey;
                $out['file_path'] = date('Y').'/'.date('m').'/users_uploads/'.$fname;
            }else{ //artist or album empty or too short
                $out['end'] = 'fail';
                $out['message'] = "Le nom de l'artiste ou le titre est trop court";
            }
        }else{ //file does not exist
            $out['end'] = 'fail';
            $out['message'] = "Le fichier concerné n'existe pas. Il a peut être été effacé";
        }
    }else{ //temp_ups does not exist
        $out['end'] = 'fail';
        $out['message'] = "Cet upload n'est pas disponible dans les enregistrement.";
    }
}else{ //no post data received
    $out['end'] = 'fail';
    $out['message'] = "Vous n'avez pas soumis toutes les donnees requises.";
}

//outputting the result
echo json_encode($out);
