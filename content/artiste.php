<?php
$artisty = $connect_bdd -> prepare("SELECT * FROM musics WHERE artiste=? AND moderation=0 ORDER BY titre ASC");
$artisty -> execute(array(het($_GET['id'])));
$nbTitres = $artisty -> rowCount();
?>
<div class="clear"></div> 
<div id="content">
	<div class="leftC">
		<div class="filmborder">
			<div class="filmcontent">
				<div class="tam">
					<ul>
						<meta name="referrer" content="no-referrer" />
						<li class="current-menu-item">
							<a href="<?=ROOT_SANS;?>">Morceaux en vedette</a>
						</li>
					</ul>
				</div>
				<div class="moviefilm">
					<a href="michel-sardou-mp3.html">
						<img src="./imgs/michel-sardou.jpg" alt="michel-sardou" height="125" width="119">
					</a>
					<div class="movief">
						<a href="michel-sardou-mp3.html">michel-sardou</a>
					</div>
					<div class="movies">
					</div>
				</div>
			</div>
		</div>
		<div class="filmborder">
			<div class="filmcontent"></div>
		</div>
		<div class="filmborder">
			<div class="filmcontent">
				<div>
					<h1>
						<a href="<?=ABOUT_ARTIST.'/'.urlencode(htmlspecialchars($_GET['id']));?>">
							<img src="<?=ROOT_SANS;?>/css/images/google.png"> Artiste :: <?=htmlspecialchars($_GET['id']).' :: '.$nbTitres;?> titre(s)
						</a>
					</h1>
				</div>
				<div class="clear"></div>
				<div class="filmicerik">
					<div align="center">
						<iframe src="<?=ROOT_SANS.'/play/artiste/'.urlencode(htmlspecialchars($_GET['id']));?>" style="border-width:0px;" frameborder="0" scrolling="no" height="366" width="100%"></iframe>
					</div>
				</div>
				<div id="alt">
					<div class="facebok">
						<!-- tweet this -->
					</div>
					<div class="facepaylas">
						<script type="text/javascript">
						function fbs_click(){u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
						</script>
						<a rel="nofollow" class="sh-face" href="http://www.facebook.com/sharer.php?u=<?=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);?>" onclick="return fbs_click()" target="_blank">
							<img src="<?=ROOT_SANS;?>/css/images/facebook_paylas.png" alt="Partager sur Facebook">
						</a>
					</div>
					<div class="izlenme"></div>
				</div>
			</div>
		</div>
		<div class="filmborder">
			<div class="filmcontent"></div>
		</div>
		<div class="filmborder">
			<div class="filmcontent">
				<div class="yazitip"> <?=htmlspecialchars($_GET['id']);?> :: Albums </div>
<?php
$albumy = $connect_bdd -> prepare("SELECT * FROM albums WHERE moderation=0 AND artiste=? ORDER BY annee DESC");
$albumy -> execute(array(het($_GET['id'])));
$nbAlbums = $albumy->rowCount();
if(!$nbAlbums)
	echo '<center><em>Aucun album disponible.</em></center>';
while($res = $albumy->fetch()){
	$lastGenre = $res['genre'];
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
    <?php
}
$albumy->closeCursor();
?>
			</div>
		</div>
		<div class="filmborder">
			<div class="filmcontent">
				<div class="yazitip">Morceaux de <?=$_GET['id'];?> :: <?=$nbTitres;?>
					<div class="play_all"></div>
				</div>
				<div id="tableMp3">
					<table width="100%" border="0" align="left" cellpadding="2" class="table1">
						<tr>
							<td width="61%"><h2>Titre</h2></td>
							<td width="8%"><h2>Durée</h2></td>
							<td width="10%" align="center"><h2>Ecouter</h2></td>
							<td width="11%" align="center"><h2>Télécharger</h2></td>
						</tr>
<?php 
	$a = 0;
while($sa = $artisty->fetch()){
	$playTime = explode(':', $sa['duree']);
	$a++;
	$lastGenre = isset($lastGenre) ? $lastGenre : $sa['genre'];
	?>
						<tr>
							<td bgcolor="#232323" style="padding-left: 20px;"> <a href="<?=ABOUT_SONG.'/'.$sa['code_name'];?>"><?=$a.'. '.$sa['artiste'].' - '.$sa['titre'];?></a> </td>
							<td bgcolor="#232323" style="color: grey;" align="center"><?=$sa['duree'];?></td>
							<td align="center" bgcolor="#232323">
								<a href="<?=ABOUT_SONG.'/'.$sa['code_name'];?>">
									<img src="<?=ROOT_SANS;?>/css/images/play.png" width="20" height="20" border="0" />
								</a>
							</td>
							<td align="center" bgcolor="#232323">
								<a href="<?=DL_LINK.'/'.$sa['code_name'];?>">
									<img src="<?=ROOT_SANS;?>/css/images/down12.png" width="20" height="20" border="0" />
								</a>
							</td>
						</tr>
<?php }
$artisty->closeCursor();
?>
					</table>
				</div>
			</div>
		</div>
		<div class="servicecontainer"></div>
	</div>
	<div id="sidebar">
		<div class="sidebarborder">
			<div class="sidebar-right">
				<div class="featlist">
					<h2>Suggestions</h2>
					<ul>
<?php
$sugs = $connect_bdd->query("SELECT * FROM musics WHERE moderation=0 AND id >= RAND()*( SELECT MAX(id) FROM musics ) ORDER BY id LIMIT 20");
while($sug = $sugs -> fetch()){
	echo '<li>';
	echo '<a href="'.ABOUT_SONG.'/'.$sug['code_name'].'">'.$sug['artiste'].' - '. $sug['titre'].'</a>';
	echo '</li>';
}
$sugs->closeCursor();
?>
					</ul>
				</div>
				<div class="sidebarborder">
				<div class="sidebar-right">
					<h2>D'autres Albums</h2>
					<div class="featlist">
						<p></p>
<?php
$the_same_albums = $connect_bdd -> prepare("SELECT * FROM albums WHERE moderation=0 AND MATCH (artiste, nom, label, genre) AGAINST (?) ORDER BY id DESC LIMIT 6");
$the_same_albums -> execute(array($lastGenre));
$cnt2 = $the_same_albums -> rowCount();
if($cnt2){
	while ($tsa = $the_same_albums -> fetch()) {
		?><div class="fimanaortala">
				<div class="filmana">
					<div class="filmsol">
						<a title="<?=$tsa['artiste'].' - '.$tsa['nom'].' ('.$tsa['annee'].')';?>" href="<?=ABOUT_ALBUM.'/'.$tsa['code_name'];?>">
							<img src="<?=ROOT_SANS.'/covers/'.str_replace('500X500', '100X100', $tsa['pochette']);?>" alt="<?=$tsa['nom'];?>" height="70" width="70">
						</a>
					</div>
					<div class="filmsag">
						<div class="filmsagbaslik">
							<a href="<?=ABOUT_ALBUM.'/'.$tsa['code_name'];?>"><?=$tsa['artiste'].' - '.$tsa['nom'].' ('.$tsa['annee'].')';?></a>
						</div>
						<div class="filmsagicerik">
							<p></p>
						</div>
						<div class="filmizleme">
							<a href="<?=ABOUT_ALBUM.'/'.$tsa['code_name'];?>">
								<img width="61" height="21" alt="Ecouter" src="<?=ROOT_SANS;?>/css/images/filmizle.png">
							</a>
						</div>
					</div>
				</div>
			</div>
	<?php }
}else{
	echo "<em>Aucune Suggestion</em>";
}
$the_same_albums -> closeCursor();
?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>﻿
<div style="clear:both;"></div>
<div class="footborder"></div>