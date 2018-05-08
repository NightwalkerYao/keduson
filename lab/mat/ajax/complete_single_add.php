<?php
$out = array("end"=>"fail", "message"=>'');
$uploader = "ooo"; //to be adapted

if(isset($_POST['artist'], $_POST['title']/*, $_POST['album'], $_POST['genre'], $_POST['year'], $_POST['track_no'], $_POST['duration'], $_POST['label']*/, $_POST['file']/*, $_POST['cover']*/, $uploader)){
    require_once('../config.php');
    $uploader = $_SESSION['admin'];
    $fname = $_POST['file'];
    if(strlen(strip_tags(trim($_POST['artist'])))>=2 && strlen(strip_tags(trim($_POST['title'])))>=1){ //don't like empty things!
        $fsize = filesize('../../../files/'.$fname);
        //adding
        $add = $connect_bdd -> prepare('INSERT INTO musics(nom_fichier,code_name,artiste,titre,album,genre,piste,annee,duree,pochette,label,taille,uploader,date_upload) VALUES(:nom_fichier, :code_name, :artiste, :titre, :album, :genre, :piste, :annee, :duree, :pochette, :label, :taille, :uploader, :date_upload)');
        $add -> execute(array('nom_fichier'=>$fname, 'code_name'=>strtolower(urlencode_2($_POST['artist'].'-'.$_POST['title'])), 'artiste'=>htmlentities($_POST['artist'], ENT_QUOTES), 'titre'=>htmlentities($_POST['title'], ENT_QUOTES), 'album'=>htmlentities(@$_POST['album'], ENT_QUOTES), 'genre'=>htmlentities(@$_POST['genre'], ENT_QUOTES),
        'piste'=>intval(@$_POST['track_no']), 'annee'=>intval(@$_POST['year']), 'duree'=>htmlentities(@$_POST['duration'], ENT_QUOTES), 'pochette'=>htmlentities(@$_POST['cover'], ENT_QUOTES), 'label'=>htmlentities(@$_POST['label'], ENT_QUOTES), 'taille'=>$fsize, 'uploader'=>$uploader, 'date_upload'=>time()));
        $insKey = $connect_bdd->lastInsertId();
        $add -> closeCursor();
                
        //setting outputz
        $out['end'] = 'success';
        $out['id'] = $insKey;
    }else{ //artist or album empty or too short
        $out['end'] = 'fail';
        $out['message'] = "Le nom de l'artiste ou le titre est trop court";
    }
}else{ //no post data received
    $out['end'] = 'fail';
    $out['message'] = "Vous n'avez pas soumis toutes les donnees requises.";
}

//outputting the result
echo json_encode($out);
