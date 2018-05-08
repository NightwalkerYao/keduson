<?php require_once('config.php'); $to_script = array(); ?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Console de moderation</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    </head>
    <body>
        <header>
            [Dashbord]&gt; <br>
            <?php
            $onlines = $connect_bdd -> prepare('SELECT COUNT(*) AS nb FROM live_stats');
            $onlines -> execute();
            list($nb_online) = $onlines -> fetch();
            $onlines -> closeCursor();
            
            $temp_audios = $connect_bdd -> prepare('SELECT COUNT(*) AS nt FROM temp_ups WHERE store_name NOT LIKE ?');
            $temp_audios -> execute(array('%.zip'));
            list($tmp3s) = $temp_audios -> fetch();
            $temp_audios -> closeCursor();
            
            $temp_archs = $connect_bdd -> prepare('SELECT COUNT(*) AS nt FROM temp_ups WHERE store_name LIKE ?');
            $temp_archs -> execute(array('%.zip'));
            list($tarchs) = $temp_archs -> fetch();
            $temp_archs -> closeCursor();
            ?>
            <ul> <li> Online: <?=$nb_online;?> </li><li> audios actifs: <span id="audios_dispos"> </span></li><li>album actifs: <span id="on_cds">...</span></li><li> audios en attente: <span id="audios_en_attente"></span> </li><li> albums en attente: <span id="albums_en_attente"></span></li><li> audios temporaires: <a href="?go=temp-upz.php"><?=$tmp3s;?></a></li><li> albums temporaires: <?=$tarchs;?></li></ul>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="?go=add-mp3.php">Ajouter des musiques</a></li>
                <li><a href="?go=def-cover.php">Change default cover</a></li>
                <li><a href="?go=xplorer.php">Gestionnaire de fichiers</a></li>
                <li><a href="?go=post-news.php">Poster une nouvelle</a></li>
                <li><a href="?go=update-disclaimer.php">Mettre a jour la disclaimer</a></li>
                <li><a id="counter_reseter" href="?go=reset-counter.php">Reset hits counter</a> [<?=file_get_contents('../Huntr.counter');?>]</li>
                <!--<li><a href="?go=clean-up-sessions.php">Balayer les sessions</a></li>-->
            </ul>
            <ul>
                Administration<br>
                <li><a href="?go=publicite.php">Publicites</a></li>
                <li>Inscriptions : <?=file_get_contents('settings/registration.set');?> [<a href="?go=switch-reg.php&from=<?=file_get_contents('settings/registration.set');?>">switch</a>]</li>
                <li><a href="?go=ftp.php">Access FTP</a></li>
                <li><a href="?go=db.php">Access Database</a></li>
                <li><a href="?go=edit-htaccess.php">Edit .htaccess</a></li>
                <li><a href="?go=phpinfo.php">phpinfo</a> / <a href="?go=edit-config.php">config.php</a></li>
            </ul>
            <ul>
                Serveur<br>
                <?php
                $dtotal = round(disk_total_space($_SERVER['DOCUMENT_ROOT'])/ bcpow(2,30), 2);
                $dfree = round(disk_free_space($_SERVER['DOCUMENT_ROOT'])/bcpow(2,30), 2);
                $dpercent = round((disk_free_space($_SERVER['DOCUMENT_ROOT'])*100)/disk_total_space($_SERVER['DOCUMENT_ROOT']), 2);
                ?>
                <li> Disc total: <?=$dtotal;?> Go</li>
                <li>  Disc libre: <?=$dfree;?> Go</li>
                <li> Soit <?=$dpercent;?> % libre</li>
                <meter style="width:100%" min="0" value="<?=$dtotal-$dfree;?>" max="<?=$dtotal;?>">Could not display progress bar</meter>
            </ul>
            <br>
            Bienvenue <strong><?=$_SESSION['admin'];?></strong> [<a href="?logout=1">Quitter</a>][<a href="javascript:document.location.reload(true)">Refresh</a>]
            [[ <u>TEAM</u> ::: <?=substr(str_replace(';', ', ', file_get_contents('team1.lst')), 1) ;?> ]]  /// APPS[beta]:: <a href="?go=crawler.php">site crawler</a> | <a href="?go=url-dl.php">url2ddl</a>
        </header>
        <section>
            <center><h1 style="font-size:45px;">Welcome in admin mode</h1></center>
            <hr>
<?php 
if(isset($_GET['go'])){
    include('include/'.str_replace('../', '', $_GET['go']));
}else{ ?>
            <h2> Morceaux en attente de moderation</h2>
            <div>
            <form method="post" id="watting_list">
            <table id="actives_mp3s">
                <thead>
                <tr><th><input type="checkbox" name="chkall" id="active_checkAll"> ID</th><th>Cover</th><th>Fichier</th><th>In URL</th><th>Artiste</th><th>Titre</th><th>Album</th><th>Genre</th><th>Piste</th><th>Annee</th><th>Duree</th><th>Label</th><th>Taille</th><th>Auteur</th><th>Date Upload</th></tr>
                </thead>
                <tbody>
                <?php 
                $actives_mp3 = $connect_bdd -> prepare('SELECT * FROM musics WHERE moderation=1 ORDER BY id DESC');
                $actives_mp3 -> execute();
                $to_script['audios_en_attente'] = $actives_mp3 -> rowCount();
                while($act = $actives_mp3 -> fetch()){ ?>
                    <tr data-id="<?=$act['id'];?>">
                        <td><input type="checkbox" value="<?=$act['id'];?>" name="mp3[]"> <a href="?go=edit-mp3.php&id=<?=$act['id'];?>" title="editer">[E]</a> <a href="#" title="valider" data-file="<?=$act['nom_fichier'];?>">[V]</a> <a href="#" title="effacer" data-file="<?=$act['nom_fichier'];?>" data-cn="<?=$act['code_name'];?>">[X]</a><?=$act['id'];?> </td>
                        <td> <img src="../covers/<?=str_replace('500X500', '65X65', $act['pochette']);?>" width="55"></td>
                        <td> <button class="directPlay" data-file="<?=$act['nom_fichier'];?>" data-dir="temp_upz" type="button"> Lire[&gt; </button> </td>
                        <td class="editable" data-colonne="code_name"><?=$act['code_name'];?></td>
                        <td class="editable" data-colonne="artiste"><?=$act['artiste'];?></td>
                        <td class="editable" data-colonne="titre"><?=$act['titre'];?></td>
                        <td class="editable" data-colonne="album"><?=$act['album'];?></td>
                        <td class="editable" data-colonne="genre"><?=$act['genre'];?></td>
                        <td class="editable" data-colonne="piste"><?=$act['piste'];?></td>
                        <td class="editable" data-colonne="annee"><?=$act['annee'];?></td>
                        <td class="editable" data-colonne="duree"><?=$act['duree'];?></td>
                        <td class="editable" data-colonne="label"><?=$act['label'];?></td>
                        <td> <?=round($act['taille']/bcpow(2, 20),2);?>m</td>
                        <td class="editable" data-colonne="uploader"><?=$act['uploader'];?></td>
                        <td><?=date('d.m.Y H:i', $act['date_upload']);?></td>
                    </tr>
                <?php } $actives_mp3-> closeCursor(); ?>
                </tbody>
            </table>
            <br>
            <span> Selection: <button type="button" id="validate_all_mp3s">valider</button> <button type="button" id="delete_all_mp3s" data-table="actives_mp3s">effacer</button> </span>
            </form>
            </div>
            
            <hr>
            <h2> Albums en attente de moderation</h2>
            <div>
            <form method="post" id="watting_albums">
            <table id="actives_discs">
                <thead>
                <tr><th><input type="checkbox" name="chkall" id="disc_checkAll"> ID</th><th>Cover</th><th>In URL</th><th>Artiste</th><th>Nom</th><th>Genre</th><th>Pistes</th><th>Annee</th><th>Label</th><th>Auteur</th></tr>
                </thead>
                <tbody>
                <?php 
                $actives_discs = $connect_bdd -> prepare('SELECT * FROM albums WHERE moderation=1 ORDER BY id DESC');
                $actives_discs -> execute();
                $to_script['albums_en_attente'] = $actives_discs -> rowCount();
                while($actd = $actives_discs -> fetch()){ ?>
                    <tr data-id="<?=$actd['id'];?>">
                        <td><input type="checkbox" value="<?=$actd['id'];?>" name="disc[]"> <a href="?go=edit-disc.php&id=<?=$actd['id'];?>" title="editer">[E]</a> <a href="#" title="valider" >[V]</a> <a href="#" title="effacer"  data-cn="<?=$actd['code_name'];?>">[X]</a><?=$actd['id'];?> </td>
                        <td> <img src="../covers/<?=str_replace('500X500', '65X65', $actd['pochette']);?>" width="55"></td>
                        <td class="editable" data-colonne="code_name"><?=$actd['code_name'];?></td>
                        <td class="editable" data-colonne="artiste"><?=$actd['artiste'];?></td>
                        <td class="editable" data-colonne="nom"><?=$actd['nom'];?></td>
                        <td class="editable" data-colonne="genre"><?=$actd['genre'];?></td>
                        <td class="editable" data-colonne="id_titres"><?=$actd['id_titres'];?></td>
                        <td class="editable" data-colonne="annee"><?=$actd['annee'];?></td>
                        <td class="editable" data-colonne="label"><?=$actd['label'];?></td>
                        <td class="editable" data-colonne="uploader"><?=$actd['uploader'];?></td>
                    </tr>
                <?php } $actives_discs-> closeCursor(); ?>
                </tbody>
            </table>
            <br>
            <span> Selection: <button type="button" id="validate_all_discs">valider</button> <button type="button" id="delete_all_discs" >effacer</button> </span>
            </form>
            </div>
            
            <hr>
            <h2> Morceaux Disponibles</h2>
            <div>
            <form method="post" id="available_list">
            <table id="available_mp3s">
                <thead>
                <tr><th><input type="checkbox" name="chkall" id="available_checkAll"> ID</th><th>Cover</th><th>Fichier</th><th>In URL</th><th>Artiste</th><th>Titre</th><th>Album</th><th>Genre</th><th>Piste</th><th>Annee</th><th>Duree</th><th>Label</th><th>Hits</th><th>Auteur</th><th>Date Upload</th><th>Likes</th><th>Dislikes</th><th>Comm</th></tr>
                </thead>
                <tbody>
                <?php 
                $count_dispos = $connect_bdd -> prepare('SELECT COUNT(*) AS ty FROM musics WHERE moderation=0');
                $count_dispos -> execute();
                list($to_script['audios_dispos']) = $count_dispos -> fetch();
                $count_dispos -> closeCursor();
                
                $pg = (isset($_GET['avzikpage']) ? intval($_GET['avzikpage']) : 1);
                $ppge = (isset($_GET['avzikppge']) ? intval($_GET['avzikppge']) : 20 );
                $start = ($pg-1)*$ppge;
                $sql = 'SELECT * FROM musics WHERE moderation=0 ORDER BY id DESC LIMIT '.$start.','.$ppge;
                $available_mp3 = $connect_bdd -> prepare($sql);
                $available_mp3 -> execute();
                
                while($act = $available_mp3 -> fetch()){ ?>
                    <tr data-id="<?=$act['id'];?>">
                        <td><input type="checkbox" value="<?=$act['id'];?>" name="mp3[]"> <a href="?go=edit-mp3.php&id=<?=$act['id'];?>" title="editer">[E]</a><!-- <a href="#" title="valider" data-file="<?=$act['nom_fichier'];?>">[V]</a>--> <a href="#" title="effacer" data-file="<?=$act['nom_fichier'];?>" data-cn="<?=$act['code_name'];?>">[X]</a> <?=$act['id'];?> </td>
                        <td> <img src="../covers/<?=str_replace('500X500', '65X65', $act['pochette']);?>" width="55"></td>
                        <td> <button class="directPlay" data-file="<?=$act['nom_fichier'];?>" data-dir="files" type="button"> Lire[&gt; </button> </td>
                        <td class="editable" data-colonne="code_name"><?=$act['code_name'];?></td>
                        <td class="editable" data-colonne="artiste"><?=$act['artiste'];?></td>
                        <td class="editable" data-colonne="titre"><?=$act['titre'];?></td>
                        <td class="editable" data-colonne="album"><?=$act['album'];?></td>
                        <td class="editable" data-colonne="genre"><?=$act['genre'];?></td>
                        <td class="editable" data-colonne="piste"><?=$act['piste'];?></td>
                        <td class="editable" data-colonne="annee"><?=$act['annee'];?></td>
                        <td class="editable" data-colonne="duree"><?=$act['duree'];?></td>
                        <td class="editable" data-colonne="label"><?=$act['label'];?></td>
                        <td class="editable" data-colonne="hits"><?=$act['hits'];?></td>
                        <td class="editable" data-colonne="uploader"><?=$act['uploader'];?></td>
                        <td> <?=date('d.m.Y H:i', $act['date_upload']);?></td>
                        <td class="editable" data-colonne="likes"><?=$act['likes'];?></td>
                        <td class="editable" data-colonne="dislikes"><?=$act['dislikes'];?></td>
                        <td class="editable" data-colonne="commentaires"><?=$act['commentaires'];?></td>
                    </tr>
                <?php } $actives_mp3-> closeCursor(); ?>
                </tbody>
            </table>
            <br>
            <span> Selection: <button type="button" id="delete_all_available" data-table="available_mp3s">effacer</button> </span>
            </form>
            <form method="get" action="#available_mp3s"> 
                // page:::<input type="text" name="avzikpage" value="<?=$pg;?>"> / <?=ceil($to_script['audios_dispos']/$ppge);?>, <a href="?avzikpage=<?=($pg+1);?>&avzikppge=<?=$ppge;?>#available_mp3s"> suivant &gt;</a>, par page: <input type="text" name="avzikppge" value="<?=$ppge;?>"> <input type="submit" value="GO !" name="jump"> 
            </form>
            </div>

<!--La derniere section-->
        <hr>
            <h2> Albums Disponibles</h2>
            <div>
            <form method="post" id="on_discs">
            <table id="on_dscs">
                <thead>
                <tr><th><input type="checkbox" name="chkall" id="available_checkAll"> ID</th><th>Cover</th><th>In URL</th><th>Artiste</th><th>Nom</th><th>Genre</th><th>Pistes</th><th>Annee</th><th>Label</th><th>Hits</th><th>Auteur</th><th>Likes</th><th>Dislikes</th><th>Comm</th></tr>
                </thead>
                <tbody>
                <?php 
                $on_disc_CNT = $connect_bdd -> prepare('SELECT COUNT(*) AS ty FROM albums WHERE moderation=0');
                $on_disc_CNT -> execute();
                list($to_script['discs_dispos']) = $on_disc_CNT -> fetch();
                $on_disc_CNT -> closeCursor();
                
                $pg1 = (isset($_GET['avzikpage1']) ? intval($_GET['avzikpage1']) : 1);
                $ppge1 = (isset($_GET['avzikppge1']) ? intval($_GET['avzikppge1']) : 20 );
                $start1 = ($pg1-1)*$ppge1;
                $sql1 = 'SELECT * FROM albums WHERE moderation=0 ORDER BY id DESC LIMIT '.$start1.','.$ppge1;
                $o_d = $connect_bdd -> prepare($sql1);
                $o_d -> execute();
                
                while($od = $o_d -> fetch()){ ?>
                    <tr data-id="<?=$od['id'];?>">
                        <td><input type="checkbox" value="<?=$od['id'];?>" name="cd[]"> <a href="?go=edit-cd.php&id=<?=$od['id'];?>" title="editer">[E]</a> <a href="#" title="effacer" data-id="<?=$od['id'];?>" data-cn="<?=$od['code_name'];?>">[X]</a> <?=$od['id'];?> </td>
                        <td> <img src="../covers/<?=str_replace('500X500', '65X65', $od['pochette']);?>" width="55"></td>
                        <td class="editable" data-colonne="code_name"><?=$od['code_name'];?></td>
                        <td class="editable" data-colonne="artiste"><?=$od['artiste'];?></td>
                        <td class="editable" data-colonne="non"><?=$od['nom'];?></td>
                        <td class="editable" data-colonne="genre"><?=$od['genre'];?></td>
                        <td class="editable" data-colonne="id_titres"><?=$od['id_titres'];?></td>
                        <td class="editable" data-colonne="annee"><?=$od['annee'];?></td>
                        <td class="editable" data-colonne="label"><?=$od['label'];?></td>
                        <td class="editable" data-colonne="hits"><?=$od['hits'];?></td>
                        <td class="editable" data-colonne="uploader"><?=$od['uploader'];?></td>
                        <td class="editable" data-colonne="likes"><?=$od['likes'];?></td>
                        <td class="editable" data-colonne="dislikes"><?=$od['dislikes'];?></td>
                        <td class="editable" data-colonne="commentaires"><?=$od['commentaires'];?></td>
                    </tr>
                <?php } $o_d-> closeCursor(); ?>
                </tbody>
            </table>
            <br>
            <span> Selection: <button type="button" id="delete_all_cd" data-table="on_dscs">effacer</button> </span>
            </form>
            <form method="get" action="#on_dscs"> 
                // page:::<input type="text" name="avzikpage1" value="<?=$pg1;?>"> / <?=ceil($to_script['discs_dispos']/$ppge1);?>, <a href="?avzikpage1=<?=($pg1+1);?>&avzikppge1=<?=$ppge1;?>#on_dscs"> suivant &gt;</a>, par page: <input type="text" name="avzikppge1" value="<?=$ppge1;?>"> <input type="submit" value="GO !" name="jump"> 
            </form>
            </div>
<?php }
?>

        </section>
        <footer> <center> <br> <br> <small>&copy; The NightWalker Y - Janvier 2018 // <a href="?go=editer-su-pwd.php">maj su pwd</a> </small> </center> </footer>
        <script type="text/javascript">
            var t_s = <?=@json_encode($to_script);?>;
            document.getElementById('audios_en_attente').innerHTML = (t_s.audios_en_attente > 0 ? '<font color="red">'+t_s.audios_en_attente+'</font>' : t_s.audios_en_attente);
            
            document.getElementById('albums_en_attente').innerHTML = (t_s.albums_en_attente > 0 ? '<font color="red">'+t_s.albums_en_attente+'</font>' : t_s.albums_en_attente);
            
            document.getElementById('audios_dispos').innerHTML = t_s.audios_dispos;
            document.getElementById('on_cds').innerHTML = t_s.discs_dispos;
        </script>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>
