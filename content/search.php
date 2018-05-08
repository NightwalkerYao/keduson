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
      <div class="filmslaytc" align="center"> <!-- debut carousel -->
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
      </div> <!-- fin carousel -->
﻿      <meta name="referrer" content="no-referrer" />
      <div class="leftC">
        <div class="filmborder">
          <div class="filmcontent">
            <center>
              <!-- pub -->
            </center>
          </div>
        </div>
<?php
$stm = $connect_bdd->prepare("SELECT COUNT(*) AS nbr FROM musics WHERE MATCH (artiste, titre, album, genre, label) AGAINST (?) AND moderation=0");
$stm -> execute(array(het($_GET['q'])));
list($nbtitres) = $stm->fetch();
$stm->closeCursor();
//if($nbtitres){
  $ppge = 40;
  $pg = (isset($_GET['page']) ? intval($_GET['page']) : 1);
  $start = ($pg -1)*$ppge;
  $nbpge = ceil($nbtitres/$ppge);
  //get last $nb_elts added not under moderation
  $sql = "SELECT * FROM musics WHERE MATCH (artiste, titre, album, genre, label) AGAINST (?) AND moderation=0 ".(isset($_GET['o']) ? "ORDER BY id DESC " : false)."LIMIT $start, $ppge";
  //echo $sql;
  $deb = microtime();
  $stm = $connect_bdd -> prepare($sql);
  $stm -> execute(array(het($_GET['q'])));
  $fin = microtime();
?>
        <div class="filmborder">
          <div class="filmcontent" id="searchsingle">
            <div class="tam">
              <ul>
                <li class="current-menu-item"><a href="#searchsingle">Résultats de recherche :: <?=htmlspecialchars($_GET['q']);?> :: <?=$nbtitres;?> Morceau(x) :: <em style="text-transform: lowercase;">Recherche effectuée en <?=round($fin-$deb,7);?>s </em></a></li>
              </ul>
            </div>
<?php
if($nbtitres){
  //set in wordcloud
    $wc = $connect_bdd -> prepare("SELECT COUNT(*) AS itm FROM wordcloud WHERE mot=?");
    $wc -> execute(array(trim($_GET['q'])));
    list($wc_itm) = $wc -> fetch();
    $wc -> closeCursor();
    if($wc_itm){
      //count++
      $wc_pp = $connect_bdd -> prepare("UPDATE wordcloud SET vues=vues+1, trouve=1 WHERE mot=?");
      $wc_pp -> execute(array(trim($_GET['q'])));
      $wc_pp -> closeCursor();
    }else{
      $wc_ins = $connect_bdd -> prepare("INSERT INTO wordcloud(mot) VALUES(?)");
      $wc_ins -> execute(array(trim($_GET['q'])));
      $wc_ins -> closeCursor();
    }

  while ($res = $stm -> fetch()) {
    ?>
            <div class="moviefilm">
              <a href="<?=ABOUT_SONG.'/'.$res['code_name'];?>">
                <img src="<?=ROOT_SANS.'/covers/'.str_replace('500X500', '200X200', $res['pochette']);?>" alt="<?=$res['artiste'].' - '.$res['titre'];?>" height="125" width="119">
              </a>
              <div class="movief">
                <a href="<?=ABOUT_SONG.'/'.$res['code_name'];?>"><?=tronquer($res['artiste'].' - '.$res['titre'], 45);?></a>
              </div>
              <div class="movies"><?=$res['hits'];?> hits</div>
            </div>
  <?php }
 }
else{
  //nothing found
    //set in wordcloud
    $wc = $connect_bdd -> prepare("SELECT COUNT(*) AS itm FROM wordcloud WHERE mot=?");
    $wc -> execute(array(trim($_GET['q'])));
    list($wc_itm) = $wc -> fetch();
    $wc -> closeCursor();
    if($wc_itm){
      //count++
      $wc_pp = $connect_bdd -> prepare("UPDATE wordcloud SET vues=vues+1, trouve=0 WHERE mot=?");
      $wc_pp -> execute(array(trim($_GET['q'])));
      $wc_pp -> closeCursor();
    }else{
      $wc_ins = $connect_bdd -> prepare("INSERT INTO wordcloud(mot,trouve) VALUES(?,0)");
      $wc_ins -> execute(array(trim($_GET['q'])));
      $wc_ins -> closeCursor();
    }
  echo '<center><em> Aucun résultat. Vous ne trouvez pas un morceau? Vous pouvez faire une demande <a href="'.ROOT_SANS.'/club">au Club</a> </em></center>';
}
$stm -> closeCursor();
?>
              <div class='paginate'>
<?php
$previousy = ($pg == 1) ? '<span class="disabled">Précédent</span>' : '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page='.($pg-1).'">Précédent</a>';
echo $previousy;
if(($pg-6)>4){
  echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page=1">1</a>';
  echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page=2">2</a>';
  echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page=3">3</a>';
  echo '...';
}
for($i=$pg-6; $i<= $pg+6; $i++) {
  if($i==$pg)
    echo '<span class="current">'.$i.'</span>';
  elseif($i>0 && $i<=$nbpge)
    echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page='.$i.'">'.$i.'</a>';
}
if(($nbpge-3)>($pg+6)){
  echo '...';
  echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page='.($nbpge-2).'">'.($nbpge-2).'</a>';
  echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page='.($nbpge-1).'">'.($nbpge-1).'</a>';
  echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page='.($nbpge).'">'.($nbpge).'</a>';
}
$nexty = ($pg >= $nbpge) ? '<span class="disabled">Suivant</span>' : '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page='.($pg+1).'">Suivant</a>';
echo $nexty;
?>            </div>
            </div> <!-- end singles -->
          </div>
          <div class="filmborder">
            <div class="filmcontent">
              <center>
              <!-- pub -->
              </center>
            </div>
          </div>
            <!-- albums -->
<?php
$stm = $connect_bdd->prepare("SELECT COUNT(*) AS nbr FROM albums WHERE MATCH (artiste, nom, label, genre) AGAINST (?) AND moderation=0");
$stm -> execute(array(het($_GET['q'])));
list($nbtitres) = $stm->fetch();
$stm->closeCursor();
//if($nbtitres){
  $ppge = 20;
  $pg = (isset($_GET['page2']) ? intval($_GET['page2']) : 1);
  $start = ($pg -1)*$ppge;
  $nbpge = ceil($nbtitres/$ppge);
  //get last $nb_elts added not under moderation
  $sql = "SELECT * FROM albums WHERE MATCH (artiste, nom, label, genre) AGAINST (?) AND moderation=0 ".(isset($_GET['o']) ? "ORDER BY id DESC " : false)."LIMIT $start, $ppge";
  //echo $sql;
  $deb = microtime();
  $stm = $connect_bdd -> prepare($sql);
  $stm -> execute(array(het($_GET['q'])));
  $fin = microtime();
?>
          <div class="filmborder">
            <div class="filmcontent" id="searchalbums">
            <div class="tam">
              <ul>
                <li class="current-menu-item"><a href="#searchalbums">Résultats de recherche :: <?=htmlspecialchars($_GET['q']);?> :: <?=$nbtitres;?> Album(s) :: <em style="text-transform: lowercase;">Recherche effectuée en <?=round($fin-$deb,7);?>s </em></a></li>
              </ul>
            </div>
<?php
  while ($res = $stm -> fetch()) {
    ?>
            <div class="moviefilm">
              <a href="<?=ABOUT_ALBUM.'/'.$res['code_name'];?>">
                <img src="<?=ROOT_SANS.'/covers/'.str_replace('500X500', '200X200', $res['pochette']);?>" alt="<?=$res['artiste'].' - '.$res['nom'];?>" height="125" width="119">
              </a>
              <div class="movief">
                <a href="<?=ABOUT_ALBUM.'/'.$res['code_name'];?>"><?=tronquer($res['artiste'].' - '.$res['nom'], 45);?></a>
              </div>
              <div class="movies">vu <?=$res['hits'];?> fois</div>
            </div>
<?php }
$stm -> closeCursor();
if(!$nbtitres){
  echo '<center><em> Aucun résultat. Vous ne trouvez pas un album? Vous pouvez faire une demande <a href="'.ROOT_SANS.'/club">au Club</a> </em></center>';
}
?>
              <div class='paginate'>
<?php
$previousy = ($pg == 1) ? '<span class="disabled">Précédent</span>' : '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page2='.($pg-1).'#searchalbums">Précédent</a>';
echo $previousy;
if(($pg-6)>4){
  echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page2=1#searchalbums">1</a>';
  echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page2=2#searchalbums">2</a>';
  echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page2=3#searchalbums">3</a>';
  echo '...';
}
for($i=$pg-6; $i<= $pg+6; $i++) {
  if($i==$pg)
    echo '<span class="current">'.$i.'</span>';
  elseif($i>0 && $i<=$nbpge)
    echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page2='.$i.'#searchalbums">'.$i.'</a>';
}
if(($nbpge-3)>($pg+6)){
  echo '...';
  echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page2='.($nbpge-2).'#searchalbums">'.($nbpge-2).'</a>';
  echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page2='.($nbpge-1).'#searchalbums">'.($nbpge-1).'</a>';
  echo '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page2='.($nbpge).'#searchalbums">'.($nbpge).'</a>';
}
$nexty = ($pg >= $nbpge) ? '<span class="disabled">Suivant</span>' : '<a href="'.SEARCH_BASE.'?q='.urlencode($_GET['q']).'&amp;content=search&amp;page2='.($pg+1).'#searchalbums">Suivant</a>';
echo $nexty;
?>            </div>
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
            <h2>Top 25 morceaux</h2>
            <ul>
<?php
$pos = 0;
$_t50 = $connect_bdd->query("SELECT artiste,titre,code_name,hits FROM musics ORDER BY hits DESC LIMIT 25");
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
            <h2>Top 10 Albums</h2>
            <ul>
<?php
$_a20 = $connect_bdd->query("SELECT artiste,nom,code_name,hits,annee FROM albums ORDER BY hits DESC LIMIT 10");
while($a20 = $_a20 -> fetch()){
  echo '<li>';
  echo '<a href="'.ABOUT_ALBUM.'/'.$a20['code_name'].'" title="'.$a20['artiste'].' - '.$a20['nom'].' ('.$a20['annee'].')">'.tronquer($a20['artiste'].' - '.$a20['nom'], 30).' -'.$a20['annee'].' <small style="color:#ccc;">['.$a20['hits'].' vues]</small></a>';
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