<!-- <script src="vex/dist/js/vex.combined.min.js"></script>
-->
<script src="../../js/jquery-ui.js"></script>

<script>
    $('head').append('<link rel="stylesheet" type="text/css" href="../../css/jquery-ui.min.css">');
</script>
<!--     (function(){
        vex.defaultOptions.className = 'vex-theme-os';
    })();
</script> -->

<?php 
include_once('include/icons.php');

function human_filesize($file, $float = 2){
    $s = filesize($file);
    $s1 = $s/bcpow(2,10);
    if($s1<1)
        return $s .'o';
    if($s1<1000)
        return round($s1, $float) .'Ko';
    $s2 = $s/bcpow(2,20);
    if($s2<1)
        return $s .'Ko';
    if($s2<1000)
        return round($s2, $float) .'Mo';
    $s3 = $s/bcpow(2, 30);
    if($s3<1)
        return $s .'Mo';
    else
        return round($s3, $float) .'Go';
}

function permissions($path){
    $perms = fileperms($path);
    switch ($perms & 0xF000) {
        case 0xC000: // socket
            $info = 's';
            break;
        case 0xA000: // symbolic link
            $info = 'l';
            break;
        case 0x8000: // regular
            $info = 'r';
            break;
        case 0x6000: // block special
            $info = 'b';
            break;
        case 0x4000: // directory
            $info = 'd';
            break;
        case 0x2000: // character special
            $info = 'c';
            break;
        case 0x1000: // FIFO pipe
            $info = 'p';
            break;
        default: // unknown
            $info = 'u';
    }
    // Owner
    $info .= (($perms & 0x0100) ? 'r' : '-');
    $info .= (($perms & 0x0080) ? 'w' : '-');
    $info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-'));

    // Group
    $info .= (($perms & 0x0020) ? 'r' : '-');
    $info .= (($perms & 0x0010) ? 'w' : '-');
    $info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-'));

    // World
    $info .= (($perms & 0x0004) ? 'r' : '-');
    $info .= (($perms & 0x0002) ? 'w' : '-');
    $info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-'));

    return $info;
}

function proprietaire($path){
    return posix_getpwuid(fileowner($path));
}

function dates_fichier($path){
    return $res = [date("d F Y H:i", filectime($path)), date("d F Y H:i", filemtime($path))];
}


$dir = isset($_GET['dir']) ? $_GET['dir'] : $_SERVER['DOCUMENT_ROOT'];
$dir = str_replace('//', '/', $dir);
?>

<h4>Location: <?=$dir;?></h4>
    <h5>
    <?php $decan = array();  $canonic = explode('/', $dir);
    for($i=0; $i<count($canonic); $i++){
        $df = count($canonic)-1-$i;
        $cc = '';
        for($k=0; $k<=$df; $k++)
            $cc .= $canonic[$k].'/';
        $decan[] = substr($cc, 0, -1);
    }
    for($j=count($decan)-1; $j>=0; $j--){
        if($decan[$j] == '')
            echo '<a href="?go=xplorer.php&dir=/">/</a> > ';
        else
            echo '<a href="?go=xplorer.php&dir='.$decan[$j].'">'.$canonic[count($canonic)-1-$j].'</a> > ';
    }
    //print_r($decan);
    ?>
        <span id="filecount"></span>
    </h5>
Remarque: <font color="yellow">JAUNE</font> --> Existe deja en BDD / <font color="steelblue">BLEUE</font> --> N'existe pas en BDD <br> <br>
<div class="row grey-text l12 m12 s12">
    <div id="files_lst" class="col l9 s12 m12">
<?php 
$files = array(); $links = array(); $dirs = array();

if(is_dir($dir)){    
    $all = scandir($dir);
    sort($all, SORT_NATURAL | SORT_FLAG_CASE);
    foreach($all as $x){
        if(is_dir($dir.'/'.$x))
            if($x == '.' || $x == '..')
                $links[] = $x;
            else
                $dirs[] = $x;
        else 
            $files[] = $x;
    }
    //get file names from the DB
    $gfns = $connect_bdd -> prepare('SELECT nom_fichier AS nf FROM musics');
    $gfns -> execute();
    $nm = array();
    while($lok = $gfns -> fetch())
        $nm[] = explode('/', $lok['nf'])[count(explode('/', $lok['nf']))-1];
    $gfns -> closeCursor();
    ?>
            <?php
                foreach($links as $l)
                    if($l == '..')
                        echo '<div class="xelement col"><a href="?go=xplorer.php&dir='.dirname($dir).'"><img width="70" src="'.$icons['top_folder'].'"></a></div>';
                    else
                        continue;
                foreach($dirs as $d){
                    echo '<div class="xelement link col hoverable"><a href="?go=xplorer.php&dir='.$dir.'/'.$d.'" data-name="'.$d.'" data-path="'.$dir.'/'.$d.'" data-perms="'.permissions($dir.'/'.$d).'"><img src="'.$icons['folder'].'" width="70"><br>'.$d.'</a></div>';
                }
                foreach($files as $f){
                    $className = 'inexiste';
                    //check for the class name (html)
                    if(in_array($f, $nm))
                        $className = 'existe';
                    $ext = strtolower(pathinfo($dir.'/'.$f, PATHINFO_EXTENSION));
                    if(in_array($ext, array('mp3','aac','m4a','ogg','flac','mid','wav')))
                        $icon = $icons['audio'];
                    elseif(in_array($ext, array('html', 'htm', 'xhtml','shtml','xml')))
                        $icon = $icons['html'];
                    elseif(in_array($ext, array('js','json','jsonp')))
                        $icon = $icons['js'];
                    elseif(in_array($ext, array('zip', 'rar', '7z', 'gz')))
                        $icon = $icons['zip'];
                    elseif(in_array($ext, array('php', 'php5')))
                        $icon = $icons['php'];
                    elseif(in_array($ext, array('mp4', 'avi', '3gp', 'mkv', 'mov', 'webm')))
                        $icon = $icons['video'];
                    elseif(in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'tif','ico')))
                        $icon = str_replace($_SERVER['DOCUMENT_ROOT'], 'http://'.$_SERVER['HTTP_HOST'], $dir.'/'.$f);
                    elseif(in_array($ext, array('jad', 'jar')))
                        $icon = $icons['java'];
                    elseif(in_array($ext, array('apk')))
                        $icon = $icons['android'];
                    elseif(in_array($ext, array('css', 'log', 'conf', 'pwd', 'lst','htaccess', 'htpasswd')))
                        $icon = $icons['config'];
                    else
                        $icon = $icons['txt'];
                    echo '<div class="xelement link truncate hoverable file col petit-caracteres center" style="max-width: 150px;"><a href="?go=xplorer.php&dir='.$dir.'/'.$f.'" class="'.$className.'" data-name="'.$f.'" data-path="'.$dir.'/'.$f.'" data-size="'.human_filesize($dir.'/'.$f).'" data-perms="'.permissions($dir.'/'.$f).'" data-owner="'.proprietaire($dir.'/'.$f)['name'].' ('.proprietaire($dir.'/'.$f)['gecos'].')" data-dcrea="'.dates_fichier($dir.'/'.$f)[0].'" data-dmodif="'.dates_fichier($dir.'/'.$f)[1].'"><img width="70" src="'.$icon.'" ><br>'.$f.'</a></div>';
                    
                }
    ?>
    <script>
        $(document).ready(function(){
            $('#xplorer_edit, #xplorer_copy, #xplorer_cut, #xplorer_delete').css('opacity', '0.5').css('cursor', 'not-allowed').each(function(){
                $(this).click(function(){
                    vex.dialog.alert('Cette action n\'est pas disponible pour le moment.');
                });
            });
            
            $('#filecount').text(' ::: <?=count($all)-2;?> elements');
        });
    </script>
    <?php 
}else{
    $url = str_replace($_SERVER['DOCUMENT_ROOT'], 'http://'.$_SERVER['HTTP_HOST'], $dir);
    $mime = mime_content_type($dir);
    $type = explode('/', $mime)[0];
    switch($type){
        case 'text':
            //$content = file_get_contents($dir);
            echo '<h4>Contenu de '.explode('/', $dir)[count(explode('/', $dir))-1].': </h4>';
            //echo '<div class="content container text">'.nl2br(htmlspecialchars($content)).'</div>';
            echo '<div class="flow-text white-text red center">Vous ne pouvez pas afficher ce contenu</div>';
        break;
        case 'image':
            echo '<h4>Apercu de l\'image '.explode('/', $dir)[count(explode('/', $dir))-1].'</h4>';
            echo '<div class="content image container"><img src="'.$url.'" ></div>';
        break;
        case 'audio':
            echo '<h4>Fichier audio '.explode('/', $dir)[count(explode('/', $dir))-1].'</h4>';
            echo '<div class="content audio container"><audio src="'.$url.'" controls preload="none">Your Browser does not support HTML5 audio</audio></div>';
        break;
        case 'video':
            echo '<h4>Fichier video '.explode('/', $dir)[count(explode('/', $dir))-1].'</h4>';
            echo '<div class="content audio container"><video src="'.$url.'" controls preload="none" width="800" height="500">Your Browser does not support HTML5 video</video></div>';
        break;
        default:
            echo '<h4>Fichier: '.explode('/', $dir)[count(explode('/', $dir))-1].'</h4>';
            echo '<center class="container"><a href="'.$url.'">[[[ Telecharger - '.human_filesize($dir).' ]]]</a></center>';
    }
}
?>
</div>
<div class="col l3 m12 s12 petit-caracteres grey darken-3" id="prevr8" style="word-wrap: break-word; overflow: auto; padding-left: 8px;">
        <h5>Actions </h5>
        <div id="about_file"><i class="material-icons">info</i><i> Choisissez un fichier pour en voir les details</i></div>
        <div>
            <button class="btn-flat waves-effect waves-light blue lighten-2" type="button" title="Lien direct" id="xplorer_directlink" data-path="<?=str_replace('///', '//', str_replace($_SERVER['DOCUMENT_ROOT'], 'http://'.$_SERVER['HTTP_HOST'], $dir));?>"><i class="material-icons">link</i></button>
            <button class="btn-flat waves-light waves-effect blue lighten-2" id="xplorer_rename" data-src="<?=$dir;?>" type="button" title="Renommer"><i class="material-icons">mode_edit</i></button>
            <button class="btn-flat waves-light waves-effect blue lighten-2" title="Nouveau dossier" type="button" id="xplorer_newdir" data-root="<?=$dir;?>"><i class="material-icons">create_new_folder</i></button>
            <button class="btn-flat waves-light waves-effect red lighten-2" type="button" id="add_group_album" title="Ajouter ce dossier comme album" data-dir="<?=$dir;?>" data-filelist='{"files": <?=@json_encode($files);?>, "nbfiles": <?=@count($files);?>, "dir": "<?=str_replace('///', '//', str_replace($_SERVER['DOCUMENT_ROOT'], 'http://'.$_SERVER['HTTP_HOST'], $dir));?>"}'><i class="material-icons large">library_music</i></button>
            <button type="button" id="tridge_ren" class="btn-flat waves-light waves-effect blue lighten-2" title="Renommer correctement tout" data-dir="<?=$dir;?>"><i class="material-icons">line_weight</i></button>
            <button class="btn-flat waves-light waves-effect green darken-2" type="button" id="max_single_add" title="Ajouter multiples singles" data-dir="<?=$dir;?>" data-filelist='{"files": <?=@json_encode($files);?>, "nbfiles": <?=@count($files);?>, "dir": "<?=str_replace('///', '//', str_replace($_SERVER['DOCUMENT_ROOT'], 'http://'.$_SERVER['HTTP_HOST'], $dir));?>"}'><i class="material-icons">queue_music</i></button>
        </div>
    </div>
</div>
<script src="xplorer.js"></script>
