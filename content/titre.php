<div class="clear"></div> 
<div id="content">
	<div class="leftC">
		<!-- <div class="filmborder">
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
		</div> -->
		<div class="filmborder">
			<div class="filmcontent"></div>
		</div>
		<div class="filmborder">
			<div class="filmcontent">
				<div>
					<h1>
						<a href="<?=ABOUT_ARTIST.'/'.urlencode(html_entity_decode($T['artiste']));?>">
							<img src="<?=ROOT_SANS;?>/css/images/google.png"> Télécharger <?=$T['artiste'].' - '.$T['titre'];?>
						</a>
					</h1>
				</div>
				<div class="clear"></div>
				<div class="filmicerik">
					<div align="center">
						<iframe src="<?=ROOT_SANS.'/play/single/'.$T['code_name'];?>" style="border-width:0px;" frameborder="0" scrolling="no" height="200" width="100%"></iframe>
					</div>
				</div>
				<div id="alt">
					<div class="facebok" style="width: 460px;">
						<a href="<?=DL_LINK.'/'.$T['code_name'];?>" style="position: relative;top: -10px; font-size: 11pt; cursor: pointer; font-weight: bold;"><img style="position: relative; top: 8px;" width="30" height="30" src="<?=ROOT_SANS;?>/css/images/icons8-Downloads.png" alt="Telecharger"> Télécharger</a>
						<a href="#" data-title="<?=$T['code_name'];?>" data-like="1" style="position: relative;top: -10px; font-size: 11pt; cursor: pointer; font-weight: normal;" id="ttleaddlike"><img style="position: relative; top: 8px;" width="30" height="30" src="<?=ROOT_SANS;?>/css/images/icons8-Facebook Like.png" alt="Top"> Top(<span id="nbtlikes"><?=$T['likes'];?></span>)</a>
						<a id="ttleadddislike" href="#" data-title="<?=$T['code_name'];?>" data-like="0" style="position: relative;top: -10px; font-size: 11pt; cursor: pointer; font-weight: normal;"><img style="position: relative; top: 8px;" width="30" height="30" src="<?=ROOT_SANS;?>/css/images/icons8-Thumbs Down.png" alt="Flop"> Flop(<span id="nbtdislikes"><?=$T['dislikes'];?></span>)</a>
						<a href="#comments" style="position: relative;top: -10px; font-size: 11pt; cursor: pointer; font-weight: normal;"><img style="position: relative; top: 8px;" width="30" height="30" src="<?=ROOT_SANS;?>/css/images/icons8-Comments.png" alt="Commenter"> Commenter(<?=$T['commentaires'];?>)</a>
						<a href="//twitter.com/intent/tweet?text=<?=urlencode("Télécharger et écouter ".html_entity_decode($T['artiste'].' - '.$T['titre']));?>&amp;url=<?=urlencode(ROOT_SANS.$_SERVER['REQUEST_URI']); ?>" target="_blank" style="position: relative;top: -10px; font-size: 11pt; cursor: pointer; font-weight: normal;" title="Tweeter ceci"><img style="position: relative; top: 8px;" width="33" height="33" src="<?=ROOT_SANS;?>/css/images/icons8-Twitter.png" alt="Tweeter"></a>
					</div>
					<div class="facepaylas">
						<script type="text/javascript">
						function fbs_click(){u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
						</script>
						<a rel="nofollow" class="sh-face" href="http://www.facebook.com/sharer.php?u=<?=urlencode(ROOT_SANS.$_SERVER['REQUEST_URI']);?>" onclick="return fbs_click()" target="_blank">
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
				<div class="yazitip"> <?=$T['artiste'].' - '.$T['titre'];?> </div>
				<div class="filmalti">
					<div class="filmaltiimg">
						<a href="<?=ABOUT_SONG.'/'.$T['code_name'];?>">
							<img style="padding: 0 0px 0 0; width: 390px; height: 400px;" src="<?=ROOT_SANS.'/covers/'.$T['pochette'];?>" alt="<?=$T['artiste'].' - '.$T['titre'];?>" />
						</a>
					</div>
					<div class="filmaltiaciklama" style="margin-left: 24em; width: 300px;">
						<div class="konuozet">
							<p> </p>
						</div>
						<div class="clear"></div>
						<p>
							<span>Artiste</span>: 
							<a href="<?=ABOUT_ARTIST.'/'.urlencode(html_entity_decode($T['artiste']));?>"> <?=$T['artiste'];?> </a>
						</p>
						<p>
							<span>Titre</span>: 
							<a href="<?=ABOUT_SONG.'/'.$T['code_name'];?>"> <?=$T['titre'];?> </a>
						</p>
						<p>
							<span>Album</span>: 
<?php //get the true name of the album
$true_alb_name = '';
$album_name = $connect_bdd -> prepare('SELECT nom FROM albums WHERE code_name=? AND moderation=0 LIMIT 1');
$album_name -> execute(array(het($T['album'])));
list($result) = $album_name -> fetch();
$album_name -> closeCursor();
$true_alb_name .= $result;
if(trim($true_alb_name) != '') {
    ?>
                    <a href="<?=ABOUT_ALBUM;?>/<?=$T['album'];?>"><?=$true_alb_name;?></a>
    <?php }
    else{
                    echo $T['album'];
    }
?>
						</p>
						<p>
							<span>Genre</span>: 
							<a href="<?=SEARCH_BASE.'?q='.urlencode($T['genre']);?>&amp;content=search&amp;o=date#searchsingle" rel="category tag"><?=$T['genre'];?></a>
						</p>
						<p>
							<span>Année</span>: 
							<?=$T['annee'];?>
						</p>
						<p>
							<span>Durée</span>: 
							<?=$T['duree'];?>
						</p>
						<p>
							<span style="width: auto;">Taille du fichier</span>: 
							<?=round($T['taille']/pow(2,20),2);?>Mo
						</p>
						<p>
							<span style="width: auto;">Téléchargé</span>: 
							<?=$T['hits'];?> fois
						</p>
						<p>
							<span style="width: auto;">Commentaires</span>: 
							<a href="#comments"><?=$T['commentaires'];?></a>
						</p>
						<p>
							<span>Uploader</span>: 
							<?=$T['uploader'];?> (<?=date('d.m.Y H:i',$T['date_upload']);?>)
						</p>
						<p>
							<span> </span>
							<?=$T['label'];?>
						</p>
						<p>
							<span>Tags</span>: 
					<?php
	                    echo "Ecouter $T[artiste] $T[titre] , $T[genre], Telecharger $T[artiste] $T[titre] mp3 gratuit, Download $T[artiste] $T[titre] free, $T[artiste] $T[album] album complet, $T[annee], Nouveautés ".date('Y')." de $T[artiste], mp3 gratuit, aac, m4a, flac, zip, torrent , KeDuSon.com , music, streaming $T[artiste], les sons de $T[label], upload par $T[uploader], direct downolad music, Musicbox.cf Team $T[artiste] $T[titre].mp3 , Index of $T[artiste] mp3 Tous les telechargements de musique sur keduson.com #$T[id]";
	                ?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="filmborder">
			<div class="filmcontent">
<?php
$same_artist = $connect_bdd->prepare("SELECT * FROM musics WHERE artiste=? AND moderation=0");
$same_artist -> execute(array($T['artiste']));
$a = 0;
$cnt1 = $same_artist -> rowCount();
?>
				<div class="yazitip">Morceaux de <?=$T['artiste'];?> :: <?=$cnt1;?>
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
while($sa = $same_artist->fetch()){
	$playTime = explode(':', $sa['duree']);
	$a++;
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
$same_artist->closeCursor();
?>
					</table>
				</div>
			</div>
		</div>
		<div class="filmborder">
			<div class="filmcontent">
				<div class="yazitip">Commentaires</div>
				<!-- <br> -->
				<form method="post" id="comments" style="padding: 0 0 0 1em;" data-group="music" data-row="<?=$T['code_name'];?>">
				<textarea placeholder="Votre commentaire" style="width: 400px; border-radius: 4px; border: none; padding: 5px;" rows="3" name="texte" id="cmtexte"></textarea>
				<br>
				<button type="submit" style="background: url(<?=ROOT_SANS;?>/css/images/navbar.png) center top repeat; border: 1px solid grey; width: auto; height: 26px; cursor: pointer; color: #CCC;">Commenter</button> &nbsp; <small><em>vous êtes connecté en tant que <strong><?=htmlspecialchars($_SESSION['uname']);?></strong> [<a href="/ajouter">changer</a>]</em></small>
				</form>
				<br>
				<!-- <br> -->
				<?php
                    $comms = $connect_bdd -> prepare('SELECT * FROM music_comments WHERE titre_cn=?');
                    $comms -> execute(array(het($T['code_name'])));
                    $nb_coms = $comms -> rowCount();
                    $pp=1;
                    while($cm = $comms -> fetch()){
                        ?>
                        <div id="alt" style="padding: 2px 5px; height: auto; background: #2e2e2e; box-sizing: border-box; color: #b9babb;">
                        <a href="#"><?=$cm['auteur'];?></a> 
                         <?=nl2br(htmlspecialchars($cm['texte']));?>
                        <br>
                        <small><i>#<?=$pp;?> - <?=date('d/m/Y \à H:i', $cm['date_post']);?> </i></small>
                       </div>
                       <div style="height: 3px; width: 100%;"></div>
                    <?php
                        $pp++;
                    }
                    $comms -> closeCursor();
                ?>
			</div>
			<br>
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
					<h2>Albums Par <?=$T['artiste'];?></h2>
					<div class="featlist">
						<p></p>
<?php
$the_same_albums = $connect_bdd -> prepare("SELECT * FROM albums WHERE artiste=? AND moderation=0");
$the_same_albums -> execute(array($T['artiste']));
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
	echo "<em>Aucun album</em>";
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