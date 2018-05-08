<div style="background-color:#191919;">
  <!-- publicites -->
  </div>
  <div class="clear"></div>
    <div id="content">
      <script type="text/javascript">
    //JQuery(document).ready(function(){
      stepcarousel.setup({
      	galleryid: 'mygallery',
      	beltclass: 'belt',
      	panelclass: 'panel',
      	autostep: {enable:false, moveby:3, pause:8000},
      	panelbehavior: {speed:500, wraparound:true, persist:true},
      	defaultbuttons: {enable: true, moveby: 2, leftnav: ['<?=ROOT_SANS;?>/css/images/scar1.png', -12, 4], rightnav: ['<?=ROOT_SANS;?>/css/images/scar2.png', -9, 4]},
      	statusvars: ['statusA', 'statusB', 'statusC'],
      	contenttype: ['external']
      })
    //});
      </script>
      <div class="tam">
        <ul>
          <li class="current-menu-item"><a href="<?=ROOT_SANS;?>">Derniers Albums Ajoutés</a></li>
        </ul>
      </div>
      <div class="filmslaytc" align="center">
        <div id="myslides">
          <div id="mygallery" class="stepcarousel">
            <div class="belt">
              <?php 
                $lalb = $connect_bdd -> prepare('SELECT artiste, nom,code_name,annee,pochette FROM albums WHERE moderation=0 ORDER BY id DESC LIMIT 15');
                $lalb -> execute();
                while($lG = $lalb->fetch()){ ?>
              <meta name="referrer" content="no-referrer" />
              <div class="panel">
                <a href="<?=ABOUT_ALBUM.'/'.$lG['code_name'];?>/" title="<?=$lG['artiste'].' - '.$lG['nom'].' ('.$lG['annee'].')';?>">
                  <img src="<?=ROOT_SANS.'/covers/'.str_replace('500X500', '200X200', $lG['pochette']);?>" alt="<?=$lG['artiste'].' - '.$lG['nom'];?>" height="138" width="110">
                  <br>
                  <span><?=$lG['artiste'].' - '.$lG['nom'].'('.$lG['annee'].')';?></span>
                </a>
                <div class="ozet"></div>
              </div>
                <?php }
                $lalb->closeCursor();
              ?>
            </div>
          </div>
        </div>
      </div>
﻿      <meta name="referrer" content="no-referrer" />
      <div class="leftC">
        <div class="filmborder">
          <div class="filmcontent">
            <center>
              <!-- pub -->
            </center>
          </div>
        </div>
        <div class="filmborder">
          <div class="filmcontent">
            <div class="tam">
              <ul>
                <li class="current-menu-item"><a href="<?=ROOT_SANS;?>">Nouveautés KeDuSon</a></li>
              </ul>
            </div>
<?php
$stm = $connect_bdd->query("SELECT COUNT(*) AS nb FROM musics WHERE moderation=0");
list($nbtitres) = $stm->fetch();
$stm->closeCursor();
$ppge = 100;
$pg = (isset($_GET['page']) ? intval($_GET['page']) : 1);
$start = ($pg -1)*$ppge;
$nbpge = ceil($nbtitres/$ppge);
//get last $nb_elts added not under moderation
$sql = "SELECT * FROM musics WHERE moderation=0 ORDER BY id DESC LIMIT $start, $ppge";
//echo $sql;
$stm = $connect_bdd -> prepare($sql);
$stm -> execute();
while ($res = $stm -> fetch()) {
  ?>
            <div class="moviefilm">
              <a href="<?=ABOUT_SONG.'/'.$res['code_name'];?>">
                <img src="<?=ROOT_SANS.'/covers/'.str_replace('500X500', '200X200', $res['pochette']);?>" alt="<?=$res['artiste'].' - '.$res['titre'];?>" height="125" width="119">
              </a>
              <div class="movief">
                <a href="<?=ABOUT_SONG.'/'.$res['code_name'];?>"><?=tronquer(html_entity_decode($res['artiste'].' - '.$res['titre']), 45);?></a>
              </div>
              <div class="movies"><?=$res['hits'];?> hits</div>
            </div>
<?php }
$stm -> closeCursor();
?>
              <div class='paginate'>
<?php
$previousy = ($pg == 1) ? '<span class="disabled">Précédent</span>' : '<a href="'.ROOT_SANS.'/telechargements/page-'.($pg-1).'">Précédent</a>';
echo $previousy;
if(($pg-6)>4){
  echo '<a href="'.ROOT_SANS.'/telechargements/page-1">1</a>';
  echo '<a href="'.ROOT_SANS.'/telechargements/page-2">2</a>';
  echo '<a href="'.ROOT_SANS.'/telechargements/page-3">3</a>';
  echo '...';
}
for($i=$pg-6; $i<= $pg+6; $i++) {
  if($i==$pg)
    echo '<span class="current">'.$i.'</span>';
  elseif($i>0 && $i<=$nbpge)
    echo '<a href="'.ROOT_SANS.'/telechargements/page-'.$i.'">'.$i.'</a>';
}
if(($nbpge-3)>($pg+6)){
  echo '...';
  echo '<a href="'.ROOT_SANS.'/telechargements/page-'.($nbpge-2).'">'.($nbpge-2).'</a>';
  echo '<a href="'.ROOT_SANS.'/telechargements/page-'.($nbpge-1).'">'.($nbpge-1).'</a>';
  echo '<a href="'.ROOT_SANS.'/telechargements/page-'.($nbpge).'">'.($nbpge).'</a>';
}
$nexty = ($pg == $nbpge) ? '<span class="disabled">Suivant</span>' : '<a href="'.ROOT_SANS.'/telechargements/page-'.($pg+1).'">Suivant</a>';
echo $nexty;
?>            </div>
              <div class="filmcontent">
                <center>
                <!-- pub -->
                </center>
              </div>
            </div>
          </div>
      </div>
      <div id="sidebar">
        <div class="sidebarborder">
          <div class="sidebar-right">
            <!-- <ul> -->
            <div class="featlist">
                <!-- pub -->
            <!-- </ul> -->
            </div>
          </div>
        </div>
        <!-- <div class="sidebarborder">
          <div class="sidebar-right">
            <h2>Ajouter un morceau</h2>
            <div align="center">
              <form method="post" enctype="multipart/form-data" id="uploadSingle">
                <label for="upSingle">Choisir un fichier</label>
                <input type="file" name="single" id="upSingle" style="width: 0; height: 0; visibility: hidden;">
                <button type="submit">Upload</button>
              </form>
            </div>
          </div>
        </div> -->
        <div class="sidebarborder"> 
          <div class="sidebar-right">
          <div class="featlist">
            <h2>Top 100 morceaux</h2>
            <ul>
<?php
$pos = 0;
$_t50 = $connect_bdd->query("SELECT artiste,titre,code_name,hits FROM musics WHERE moderation=0 ORDER BY hits DESC LIMIT 100");
while($t50 = $_t50 -> fetch()){
  $pos ++;
  echo '<li style="word-wrap: break-word;">';
  echo '<a href="'.ABOUT_SONG.'/'.$t50['code_name'].'" title="'.$t50['artiste'].' - '.$t50['titre'].'">'.$pos.'. '.$t50['artiste'].' - '.$t50['titre'].' <small style="color:#ccc;">['.$t50['hits'].' hits]</small></a> ';
  echo '</li>';
}
$_t50 -> closeCursor();
?>
            </ul>
          </div>
          </div>
        </div>
        <div class="sidebarborder"> 
          <div class="sidebar-right">
          <div class="featlist">
            <h2>Top 20 Albums</h2>
            <ul>
<?php
$_a20 = $connect_bdd->query("SELECT artiste,nom,code_name,hits,annee FROM albums WHERE moderation=0 ORDER BY hits DESC LIMIT 20");
while($a20 = $_a20 -> fetch()){
  echo '<li>';
  echo '<a href="'.ABOUT_ALBUM.'/'.$a20['code_name'].'" title="'.$a20['artiste'].' - '.$a20['nom'].' ('.$a20['annee'].')">'.tronquer(html_entity_decode($a20['artiste'].' - '.$a20['nom']), 36).' -'.$a20['annee'].' <small style="color:#ccc;">['.$a20['hits'].' vues]</small></a>';
  echo '</li>';
}
$_a20 -> closeCursor();
?>
            </ul>
          </div>
          </div>
        </div>
      </div> 
    </div>
﻿    <div style="clear:both;"></div>
    <div class="footborder"></div>