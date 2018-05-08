<?php 
$out = array('end'=>'fail', 'message'=>'Could not process your request at this time. Please try again later');
require_once '../config.php';

if(isset($_POST['album'], $_POST['annee'], $_POST['artist'], $_POST['cover'], $_POST['duree'], $_POST['fichier'], $_POST['genre'], $_POST['label'], $_POST['titre'], $_POST['piste'])){

    $artist = htmlentities($_POST['artist'], ENT_QUOTES);
    $album = htmlentities($_POST['album'], ENT_QUOTES);
    $annee = intval($_POST['annee']);
    $genre = htmlentities($_POST['genre'], ENT_QUOTES);
    $label = htmlentities($_POST['label'], ENT_QUOTES);
    $cover = htmlentities($_POST['cover'], ENT_QUOTES);
    $albumcn = urlencode_2($artist.'-'.$album.'-'.$annee);
    
    $fichiers = $_POST['fichier'];
    $titres = $_POST['titre'];
    $durees = $_POST['duree'];
    $pistes = $_POST['piste'];

    $nbfiles = count($fichiers);
    $id_titres = array();
    $uploader = $_SESSION['admin'];
    
    for($i=0; $i<$nbfiles; $i++){
    
        $F = '../../../files/'.$fichiers[$i];
        if(file_exists($F)){
            $fsize = filesize($F);
            $add = $connect_bdd -> prepare('INSERT INTO musics(nom_fichier,code_name,artiste,titre,album,genre,piste,annee,duree,pochette,label,taille,uploader,date_upload) VALUES(:nom_fichier, :code_name, :artiste, :titre, :album, :genre, :piste, :annee, :duree, :pochette, :label, :taille, :uploader, :date_upload)');
            $add -> execute(array('nom_fichier'=>$fichiers[$i], 'code_name'=>urlencode_2($_POST['artist'].'-'.$titres[$i]), 'artiste'=>$artist, 'titre'=>htmlentities($titres[$i], ENT_QUOTES), 'album'=>$albumcn, 'genre'=>$genre, 'piste'=>intval($pistes[$i]), 'annee'=>$annee, 'duree'=>htmlentities($durees[$i], ENT_QUOTES), 'pochette'=>$cover, 'label'=>$label, 'taille'=>$fsize, 'uploader'=>$uploader, 'date_upload'=>time()));
            $insKey = $connect_bdd->lastInsertId();
            $add -> closeCursor();
            $id_titres[] = $insKey;
        }
    }
    
    $ains = $connect_bdd->prepare('INSERT INTO albums(code_name, nom, artiste, id_titres, genre, annee, label, pochette, uploader) VALUES(:code_name, :nom, :artiste, :id_titres, :genre, :annee, :label, :pochette, :uploader)');
    $ains -> execute(array('code_name'=> $albumcn, 'nom'=> $album, 'artiste'=> $artist, 'id_titres'=> implode(';',$id_titres), 'genre'=> $genre, 'annee'=> $annee, 'label'=> $label, 'pochette'=> $cover, 'uploader'=> $uploader));
    $albid = $connect_bdd -> lastInsertId();
    $ains -> closeCursor();
    
    if(count($id_titres)){
        $out['end'] = 'succes';
        $out['message'] = '';
        $out['ids'] = implode(';', $id_titres);
        $out['album'] = $albid;
    }
}

echo json_encode($out);
