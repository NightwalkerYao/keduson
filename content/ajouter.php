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
                <a href="<?=ROOT_SANS.'/album/'.$lG['code_name'];?>/" title="<?=$lG['artiste'].' - '.$lG['nom'].' ('.$lG['annee'].')';?>">
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
                <li class="current-menu-item"><a href="<?=ROOT_SANS;?>/ajouter/">Ajouter des morceaux / albums</a></li>
              </ul>
            </div>
              <div>
                <p class="readme">
  Avant de publier des morceaux ici, prenez le temps de vérifier qu'ils ne sont pas déjà présents dans les listes. Utilisez la recherche pour vous en assurer. Aucun doublon détecté ne sera validé. Si vous publiez des morceaux et que quelqu'un d'autre les signale comme abus, nous ne vous avertirons pas avant de les retirer.
  <br>
  <br>
  <span style="font-style: italic; color: red;">L'ajout d'album complet via archive zip n'est pas disponible pour le moment. Ajoutez les morceaux en singles.</span>
</p>
                <?php
                if(!isset($_SESSION['user'])){
                  include('content/log.php');
                }else{
                  include('content/form.php');
                }
                ?>
                <style type="text/css">
.readme{
  font-size: 13px;
  color: #b9babb;
  font-family: Helvetica,arial,serif;
  padding: 1em;
}
  .inform{
    padding: 7px 1em;
    line-height: 18px;
  }
  .inform label{
    float: left;
    width: 150px;
  }
  .inform label, .inform input{
    display: inline-block;
  }
  .inform input[type=text], .inform input[type=email],.inform input[type=password]{
    border: none;
    padding: 0 3px;
    font-size: 10pt;
    line-height: 18px;
    margin: 2px 0;
    box-sizing: border-box;
    /*background-color: #b9babb;*/
    width: 200px;
  }
  .inform input[type=submit]{
    border: none;
    background: pink;
    cursor: pointer;
    /*color: cyan;*/
  }
  .divider1{
    margin: 1em auto; width: 100%; height: 2px; background-color: #2e2e2e; display: block; clear: both;
  }
</style>
              </div>
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
        <div class="sidebarborder"> 
          <div class="sidebar-right">
          <div class="featlist">
            <h2>Top 20 morceaux</h2>
            <ul>
<?php
$pos = 0;
$_t50 = $connect_bdd->query("SELECT artiste,titre,code_name,hits FROM musics WHERE moderation=0 ORDER BY hits DESC LIMIT 20");
while($t50 = $_t50 -> fetch()){
  $pos ++;
  echo '<li style="word-wrap: break-word;">';
  echo '<a href="'.ROOT_SANS.'/telecharger/'.$t50['code_name'].'" title="'.$t50['artiste'].' - '.$t50['titre'].'">'.$pos.'. '.$t50['artiste'].' - '.$t50['titre'].' <small style="color:#ccc;">['.$t50['hits'].' hits]</small></a> ';
  echo '</li>';
}
$_t50 -> closeCursor();
?>
            </ul>
          </div>
          </div>
        </div>
      </div> 
    </div>
﻿    <div style="clear:both;"></div>
    <div class="footborder"></div>