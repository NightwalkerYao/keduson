<?php require_once('config.php'); ?>
<!DOCTYPE html>
  <html>
    <head>
      <link href="fonts/font.css" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="css/admin.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Keduson.com - SU</title>
      <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </head>
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

  $all_active_mp3 = $connect_bdd->prepare("SELECT COUNT(*) AS aam FROM musics WHERE moderation=0");
  $all_active_mp3->execute();
  list($aam)=$all_active_mp3->fetch();
  $all_active_mp3->closeCursor();

  $all_active_albums = $connect_bdd->prepare("SELECT COUNT(*) AS aaalb FROM albums WHERE moderation=0");
  $all_active_albums -> execute();
  list($aaalb)=$all_active_albums->fetch();
  $all_active_albums->closeCursor();

  $all_inactive_mp3 = $connect_bdd->prepare("SELECT COUNT(*) AS aiam FROM musics WHERE moderation=1");
  $all_inactive_mp3->execute();
  list($aiam)=$all_inactive_mp3->fetch();
  $all_inactive_mp3->closeCursor();

  $all_inactive_albums = $connect_bdd->prepare("SELECT COUNT(*) AS aiaalb FROM albums WHERE moderation=1");
  $all_inactive_albums -> execute();
  list($aiaalb)=$all_inactive_albums->fetch();
  $all_inactive_albums->closeCursor();
?>
    <body>
      <header>
        <ul id="dropdown0" class="dropdown-content hauteur-fixe-40">
          <li>&nbsp;Vue d'ensemble</li>
          <li><span>Utilisateurs en ligne: <?=$nb_online;?></span></li>
          <li class="divider"></li>
          <li><span>Morceaux actifs: <?=$aam;?></span></li>
          <li><span>Albums actifs: <?=$aaalb;?></span></li>
          <li class="divider"></li>
          <li><span>Morceaux A moderer: <?=$aiam;?></span></li>
          <li><span>Albums A moderer: <?=$aiaalb;?></span></li>
          <li class="divider"></li>
          <li><span><a href="?go=temp-upz.php">Temp. audios: <?=$tmp3s;?></a></span></li>
          <li><span>Temp. albums: <?=$tarchs;?></span></li>
        </ul>
        <ul id="dropdown1" class="dropdown-content hauteur-fixe-liens hauteur-fixe-40">
          <li>&nbsp;Liens &amp; Utilitaires</li>
          <li><a href="./"><!-- <i class="material-icons">home</i>  -->Accueil</a></li>
          <li><a href="?go=add-mp3.php"><!-- <i class="material-icons">add</i>  -->Ajouter des musiques</a></li>
          <li><a href="?go=def-cover.php"><!-- <i class="material-icons">image</i> --> Pochette par defaut</a></li>
          <li><a href="?go=xplorer.php"><!-- <i class="material-icons">folder</i> --> Gestionnaire de fichiers</a></li>
          <li><a href="?go=post-news.php"><!-- <i class="material-icons">new_releases</i> --> Poster une nouvelle</a></li>
          <li><a href="?go=update-disclaimer.php"><!-- <i class="material-icons">note</i> --> Mettre a jour la Disclaimer</a></li>
          <li class="divider"></li>
          <li><a id="counter_reseter" href="?go=reset-counter.php">Reset counter <span class="grey badge darken-2 white-text"><?=file_get_contents('../../Huntr.counter');?></span></a></li>
        </ul>
        <ul id="dropdown2" class="dropdown-content hauteur-fixe-40">
          <li>&nbsp;Administration</li>
          <li><a href="?go=publicite.php">Publicites</a></li>
          <li><a href="?go=switch-reg.php&from=<?=file_get_contents('settings/registration.set');?>">Switch Inscriptions <span class="blue right lighten-2 white-text"><?=file_get_contents('settings/registration.set');?></span></a></li>
          <li><a href="?go=ftp.php">Access FTP</a></li>
          <li><a href="?go=db.php">Access Database</a></li>
          <li class="divider"></li>
          <li><a href="?go=edit-file.php&file=index.php">Editer index.php</a></li>
          <li><a href="?go=edit-file.php&file=htaccess">Editer le .htaccess</a></li>
          <li><a href="?go=edit-file.php&file=user.ini">Editer .user.ini</a></li>
          <li><a href="?go=edit-file.php&file=preprocessor.php">Editer preprocessor.php</a></li>
          <li><a href="?go=edit-file.php&file=config.php">Editer config.php</a></li>
          <li class="divider"></li>
          <li><a href="?go=phpinfo.php">PHPinfo</a></li>
        </ul>
<?php
  $dtotal = round(disk_total_space($_SERVER['DOCUMENT_ROOT'])/ bcpow(2,30), 2);
  $dfree = round(disk_free_space($_SERVER['DOCUMENT_ROOT'])/bcpow(2,30), 2);
    $dpercent = round((disk_free_space($_SERVER['DOCUMENT_ROOT'])*100)/disk_total_space($_SERVER['DOCUMENT_ROOT']), 2);
?>
        <ul id="dropdown3" class="dropdown-content">
          <li>&nbsp;Serveur</li>
          <li><span>Disc total: <?=$dtotal;?> Go</span></li>
          <li><span>Disc libre: <?=$dfree;?> Go</span></li>
          <li><p>Soit <?=$dpercent;?> % libre<br>
              <div class="progress">
                <div class="determinate" style="width: <?=100-$dpercent;?>%"></div>
              </div>
          </p></li>
        </ul>

        <nav>
          <div class="nav-wrapper grey darken-2 barre-2-navigation">
            <a href="./" class="brand-logo left hide-on-med-and-down">Keduson.com Admin</a>
            <ul class="right">
              <li><a class="dropdown-trigger" data-target="dropdown0"><i class="material-icons left">dvr</i>Vue d'ensemble</a></li>
              <li><a class="dropdown-trigger" data-target="dropdown1"><i class="material-icons left">apps</i>Liens &amp; Utilitaires</a></li>
              <li><a class="dropdown-trigger" data-target="dropdown2"><i class="material-icons left">build</i>Administration</a></li>
              <li><a class="dropdown-trigger" data-target="dropdown3"><i class="material-icons left">storage</i>Serveur</a></li>
              <li><a title="Deconnexion" class="red lighten-1" href="?logout=1"><i class="material-icons left">power_settings_new</i><?=$_SESSION['admin'];?></a></li>
            </ul>
          </div>
        </nav>
      </header>
      <main>
        <div class="container">
          <h1 class="grey-text lighten-2"><i class="material-icons left medium">settings</i>Console d'Administration</h1>
        </div>
        <div class="divider"></div>
<!-- cut here for page content -->
<?php 
if(isset($_GET['go'])){
    include('include/'.str_replace('../', '', $_GET['go']));
}else{ ?>
        <div class="row">
          <div class="col l7 s6 m5">
            <h3 class="white-text grey darken-2 enLibelle"><i class="material-icons left medium">apps</i>Outils en developpement</h3>
            <div class="left reculaer">
              <p><a href="?go=crawler.php"><i class="material-icons left">web</i>Site Crawler<span class="badge new right amber"></span></a></p>
              <p><a href="?go=url-dl.php"><i class="material-icons left">archive</i>Download From URL</a></p>
            </div>
          </div>
          <div class="col l3 s6 m4 left">
            <h3 class="white-text grey darken-2 enLibelle"><i class="material-icons left medium">vpn_lock</i>L'equipe</h3>
            <div class="left reculaer">
              <span><?=substr(str_replace(';', ' </span><br><span>', file_get_contents('team1.lst')), 1) ;?>

              </span>
            </div>
          </div>
          <div class="col l2 s12 m3">
            <p class="center">
              <a href="javascript:document.location.reload(true)" title="Rafraichir"><i class="material-icons large">refresh</i></a>
              <br>
              Actualiser
            </p>
          </div>
        </div>
        <section>
          <ul class="collapsible expandable">
            <li>
              <div class="collapsible-header"><i class="material-icons">schedule</i>Morceaux en attente de moderation
                <?php
                if($aiam>0)
                  echo '<span class="badge red white-text right" data-badge-caption="Nouveaux">'.$aiam.'</span>';
                ?>
                </div>
              <div class="collapsible-body">
                <form method="post" id="watting_list">
                <table class="responsive-table highlight petit-caracteres" id="actives_mp3s">
                <thead>
                <tr><th> <label for="active_checkAll"><input type="checkbox" name="chkall" id="active_checkAll" class="filled-in"><span></span> ID</label></th><th>Cover</th><th>Fichier</th><th>In URL</th><th>Artiste</th><th>Titre</th><th>Album</th><th>Genre</th><th>Piste</th><th>Annee</th><th>Duree</th><th>Label</th><th>Taille</th><th>Auteur</th><th>Date Upload</th></tr>
                </thead>
                <tbody>
                <?php 
                $actives_mp3 = $connect_bdd -> prepare('SELECT * FROM musics WHERE moderation=1 ORDER BY id DESC');
                $actives_mp3 -> execute();
                //$to_script['audios_en_attente'] = $actives_mp3 -> rowCount();
                while($act = $actives_mp3 -> fetch()){ ?>
                    <tr data-id="<?=$act['id'];?>">
                        <td> <label for="inchkbx<?=$act['id'];?>"><input id="inchkbx<?=$act['id'];?>" type="checkbox" value="<?=$act['id'];?>" name="mp3[]" class="filled-ino"><span></span></label> <a href="?go=edit-mp3.php&id=<?=$act['id'];?>" title="editer">E</a> <a href="#" title="valider" data-file="<?=$act['nom_fichier'];?>">V</a> <a href="#" title="effacer" data-file="<?=$act['nom_fichier'];?>" data-cn="<?=$act['code_name'];?>">X</a> <?=$act['id'];?> </td>
                        <td> <img src="../../covers/<?=str_replace('500X500', '65X65', $act['pochette']);?>" width="55"></td>
                        <td> <a class="directPlay" href="#!" data-file="<?=$act['nom_fichier'];?>" data-dir="temp_upz"> Lire</a> </td>
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
                        <td><?=date('d.m.y H:i', $act['date_upload']);?></td>
                    </tr>
                <?php } $actives_mp3-> closeCursor(); ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="15">
                      Selection: <button type="button" class="waves-effect waves-light btn-flat blue lighten-1 white-text" id="validate_all_mp3s"> <i class="left material-icons">playlist_add_check</i> Valider</button>
                      <button id="delete_all_mp3s" type="button" class="waves-effect waves-light btn-flat red lighten-1 white-text"><i class="left material-icons" data-table="actives_mp3s">clear</i> Effacer</button>
                    </td>
                  </tr>
                </tfoot>
              </table>
              </form>
              </div>
            </li>

            <li>
              <div class="collapsible-header"><i class="material-icons">disc_full</i>Albums en attente de moderation 
              <?php 
              if($aiaalb>0)
                echo '<span class="badge red white-text right" data-badge-caption="Nouveaux">'.$aiaalb.'</span>';
              ?>
              </div>
              <div class="collapsible-body">
                <form method="post" id="watting_albums">
                  <table id="actives_discs"  class="responsive-table highlight petit-caracteres">
                <thead>
                <tr><th><label for="disc_checkAll"><input type="checkbox" name="chkall" id="disc_checkAll" class="filled-in"><span></span> ID</label></th><th>Cover</th><th>In URL</th><th>Artiste</th><th>Nom</th><th>Genre</th><th>Pistes</th><th>Annee</th><th>Label</th><th>Auteur</th></tr>
                </thead>
                <tbody>
                <?php 
                $actives_discs = $connect_bdd -> prepare('SELECT * FROM albums WHERE moderation=1 ORDER BY id DESC');
                $actives_discs -> execute();
                //$to_script['albums_en_attente'] = $actives_discs -> rowCount();
                while($actd = $actives_discs -> fetch()){ ?>
                    <tr data-id="<?=$actd['id'];?>">
                        <td><label for="aea<?=$actd['id'];?>"><input id="aea<?=$actd['id'];?>" type="checkbox" value="<?=$actd['id'];?>" name="disc[]"><span></span></label><a href="?go=edit-disc.php&id=<?=$actd['id'];?>" title="editer">E</a> <a href="#" title="valider" >V</a> <a href="#" title="effacer"  data-cn="<?=$actd['code_name'];?>">X</a> <?=$actd['id'];?> </td>
                        <td> <img src="../../covers/<?=str_replace('500X500', '65X65', $actd['pochette']);?>" width="55"></td>
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
                <tfoot>
                  <tr>
                    <td colspan="10">
                      Selection: <button type="button" id="validate_all_discs" class="waves-light waves-effect blue lighten-1 btn-flat"><i class="left material-icons">playlist_add_check</i> valider</button> <button type="button" id="delete_all_discs" class="waves-light waves-effect red lighten-1 btn-flat"><i class="material-icons left">clear</i> effacer</button> 
                    </td>
                  </tr>
                </tfoot>
            </table>
                </form>
              </div>
            </li>

            <li>
              <div class="collapsible-header"><i class="material-icons">audiotrack</i>Morceaux disponibles <span class="badge cyan white-text right" data-badge-caption="Disponibles"><?=$aam;?></span> </div>
              <div class="collapsible-body">
                <form method="post" id="available_list">
            <table id="available_mp3s" class="highlight responsive-table petit-caracteres">
                <thead>
                <tr><th><label for="available_checkAll"><input type="checkbox" name="chkall" id="available_checkAll" class="filled-in"><span></span> ID</label></th><th>Cover</th><th>Fichier</th><th>In URL</th><th>Artiste</th><th>Titre</th><th>Album</th><th>Genre</th><th>Piste</th><th>Annee</th><th>Duree</th><th>Label</th><th>Hits</th><th>Auteur</th><th>Date Upload</th><th>Likes</th><th>Dislikes</th><th>Comm</th></tr>
                </thead>
                <tbody>
                <?php 
                $pg = (isset($_GET['avzikpage']) ? intval($_GET['avzikpage']) : 1);
                $ppge = (isset($_GET['avzikppge']) ? intval($_GET['avzikppge']) : 20 );
                $start = ($pg-1)*$ppge;
                $sql = 'SELECT * FROM musics WHERE moderation=0 ORDER BY id DESC LIMIT '.$start.','.$ppge;
                $available_mp3 = $connect_bdd -> prepare($sql);
                $available_mp3 -> execute();
                
                while($act = $available_mp3 -> fetch()){ ?>
                    <tr data-id="<?=$act['id'];?>">
                        <td><label for="mp3d<?=$act['id'];?>"><input type="checkbox" value="<?=$act['id'];?>" name="mp3[]" id="mp3d<?=$act['id'];?>"><span></span></label> <a href="?go=edit-mp3.php&id=<?=$act['id'];?>" title="editer">E</a><!-- <a href="#" title="valider" data-file="<?=$act['nom_fichier'];?>">[V]</a>--> <a href="#" title="effacer" data-file="<?=$act['nom_fichier'];?>" data-cn="<?=$act['code_name'];?>">X</a> <?=$act['id'];?> </td>
                        <td> <img src="../../covers/<?=str_replace('500X500', '65X65', $act['pochette']);?>" width="55"></td>
                        <td> <a href="#!" class="directPlay" data-file="<?=$act['nom_fichier'];?>" data-dir="files"> Lire </a> </td>
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
                <tfoot>
                  <tr>
                    <td colspan="18">
                      Selection: <button type="button" id="delete_all_available" data-table="available_mp3s" class="waves-effect waves-light red lighten-1 white-text btn-flat"><i class="material-icons left">clear</i> effacer</button>
                    </td>
                  </tr>
                </tfoot>
            </table>
            </form>
            <br>
            <!-- <div class="divider"></div> -->
            <br>
            <div class="row container">
              <form method="get" action="#available_mp3s"> 
                   <div class="input-field col">
                    <input type="number" name="avzikpage" value="<?=$pg;?>" class="validate" id="saisiePageinamp3" placeholder="Saisir un nombre">
                    <label for="saisiePageinamp3">Page sur Total = <?=ceil($aam/$ppge);?></label>
                  </div>
                  <div class="col input-field">
                    <input type="text" name="avzikppge" value="<?=$ppge;?>" class="validate" id="saisieppPageinamp3" placeholder="Saisir un nombre">
                    <label for="saisieppPageinamp3">Entrees par page (20 par defaut)</label>
                  </div>
                  <div class="col">
                    Ou aller a la <a href="?avzikpage=<?=($pg+1);?>&avzikppge=<?=$ppge;?>#available_mp3s"> Page suivante</a>
                  </div>
                  <div class="col">
                    <input type="submit" value="Aller" name="jump" class="btn-flat waves-effect waves-light green lighten-1 white-text" > 
                  </div>
              </form>
            </div>
              </div>
            </li>

            <li>
              <div class="collapsible-header"><i class="material-icons">folder_special</i>Albums disponibles <span class="badge green white-text" data-badge-caption="Disponibles"><?=$aaalb;?></span></div>
              <div class="collapsible-body">
                <form method="post" id="on_discs">
            <table id="on_dscs">
                <thead>
                <tr><th><label for="available_checkAll1"><input type="checkbox" name="chkall" id="available_checkAll1" class="filled-in"><span></span> ID</label></th><th>Cover</th><th>In URL</th><th>Artiste</th><th>Nom</th><th>Genre</th><th>Pistes</th><th>Annee</th><th>Label</th><th>Hits</th><th>Auteur</th><th>Likes</th><th>Dislikes</th><th>Comm</th></tr>
                </thead>
                <tbody>
                <?php 
                $pg1 = (isset($_GET['avzikpage1']) ? intval($_GET['avzikpage1']) : 1);
                $ppge1 = (isset($_GET['avzikppge1']) ? intval($_GET['avzikppge1']) : 20 );
                $start1 = ($pg1-1)*$ppge1;
                $sql1 = 'SELECT * FROM albums WHERE moderation=0 ORDER BY id DESC LIMIT '.$start1.','.$ppge1;
                $o_d = $connect_bdd -> prepare($sql1);
                $o_d -> execute();
                
                while($od = $o_d -> fetch()){ ?>
                    <tr data-id="<?=$od['id'];?>">
                        <td><label for="albumdispo<?=$od['id'];?>"><input id="albumdispo<?=$od['id'];?>" type="checkbox" value="<?=$od['id'];?>" name="cd[]"><span></span></label> <a href="?go=edit-cd.php&id=<?=$od['id'];?>" title="editer">E</a> <a href="#" title="effacer" data-id="<?=$od['id'];?>" data-cn="<?=$od['code_name'];?>">X</a> <?=$od['id'];?> </td>
                        <td> <img src="../../covers/<?=str_replace('500X500', '65X65', $od['pochette']);?>" width="55"></td>
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
                <tfoot>
                  <tr>
                    <td colspan="14">
                      Selection: <button type="button" id="delete_all_cd" data-table="on_dscs" class="btn-flat waves-effect waves-light red lighten-1"><i class="material-icons">clear</i>effacer</button>
                    </td>
                  </tr>
                </tfoot>
            </table>
            </form>
            <br>
            <br>
            <div class="container row">
            <form method="get" action="#on_dscs"> 
                <div class="col input-field"> 
                  <i class="material-icons prefix">insert_drive_file</i>
                  <input type="number" class="validate" name="avzikpage1" value="<?=$pg1;?>" id="champ751">
                  <label for="champ751">Page sur Total =<?=ceil($aaalb/$ppge1);?></label>
                </div>
                <div class="col input-field">
                  <i class="material-icons prefix">grid_on</i>
                  <input type="number" class="validate" name="avzikppge1" value="<?=$ppge1;?>" id="champ846">
                  <label for="champ846">Entrees/page (20 par defaut)</label>
                </div>
                <div class="col">
                   Ou aller a la <a href="?avzikpage1=<?=($pg1+1);?>&avzikppge1=<?=$ppge1;?>#on_dscs"> Page Suivante </a>
                </div>
                <div class="col">
                <button type="submit" name="jump" class="btn-flat waves-light waves-effect blue lighten-1"> Aller <i class="material-icons right">chevron_right</i></button>
            </form>
          </div>
              </div>
            </li>
          </ul>
        </section>
<?php }
?>
      </main>
      <footer>
            <div class="row teal darken-3" style="padding: 0 1em; margin-bottom: 0;">
              <div class="col l6 s6 m6">
                <h5 class="white-text">Keduson.com</h5>
                <p class="grey-text text-lighten-4">Secure administration panel by NightWalker Yao.</p>
              </div>
              <div class="col l6 s6 m6">
                <br>
                <br>
                <a href="?logout=1">Quitter</a> | <a href="?go=editer-su-pwd.php">Mettre a jour le Fichier de Mot de passe</a>
                <div>
                © 2018 Copyright keduson.com
                </div>
              </div>
            </div>
      </footer>
      <script type="text/javascript" src="js/admin.js"></script>
      <script type="text/javascript" src="js/script.js"></script>
    </body>
  </html>