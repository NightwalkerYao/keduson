<?php require_once "../php/config.php";
if(!isset($_SESSION['user'])){
	header("Location: login.php");
	exit;
}

function temps_passe($debut,$fin) {
	if ($debut==0) {
		return 'en attente';
	}
	if ($debut!=0 ) {
		$fin=time();
		$diff=$fin-$debut;
		if ($diff<0 ) {return 'programmé pour plus tard';
		}
		elseif ($diff<=5) { return 'à l\'instant'; 
		}
		else {
			if ($diff>5 && $diff<=59 ) { return 'il y a '.$diff.' secondes';
			}
			elseif ($diff>59 && $diff<=90 ) { return 'il y a une minute'; 
			}
			elseif ($diff>90 && $diff <=3569 ) { $mins=round($diff/60); return 'il y a '.$mins.' minutes';
			}
			elseif ($diff > 3569 && $diff<=3660 ) { return 'il y a une heure';
			}
			elseif ($diff >3660 && $diff<7140) { $hrs=1; $mins=round(($diff-3600)/60)+1; return 'il y a '.$hrs.' heure '.$mins.' minutes';
			}
			elseif ($diff>=7141 && $diff<=86340) { $hrs=round($diff/3600); return 'il y a '.$hrs.' heures';
			}
			elseif ($diff>86340 && $diff<=169200) { return 'il y a un jour'; 
			}
			elseif ($diff > 169200 && $diff<561600) { $jrs=round($diff/86400); return 'il y a '.$jrs.' jours'; 
			}
			elseif ($diff>=561600 && $diff <=691200) { return 'il y a une semaine '; 
			}
			elseif ($diff>691200 && $diff<=2419200) { $sem=ceil(($diff/86400)/7); return 'il y a '.$sem.' semaines'; 
			}
			elseif ($diff>2419200 && $diff<5184000) {return 'il y a un mois'; 
			}
			elseif ($diff>=5184000 && $diff < 31104000) { $mois=intval($diff/2592000); return 'il y a '.$mois.' mois'; 
			}
			elseif ($diff>=31104000 && $diff <63072000) { return 'il y a un an'; 
			}
			elseif ($diff>=63072000) { $ans=intval($diff/31536000); return 'il y a '.$ans.' ans';
			}
		}
	}
}
 ?>
<!-- <h1 style="text-align: center; font-size: 28pt;">Vue d'ensemble du Club</h1> -->
<div class="vote-box">
	<h2>Donnez votre avis sur ce sujet</h2>
<?php 
	$gv = $connect_bdd->prepare("SELECT * FROM votes ORDER BY id DESC LIMIT 1");
	$gv->execute();
	$v = $gv -> fetch(PDO::FETCH_OBJ);
	$gv -> closeCursor();

	$av = $v->choix1 + $v->choix2 + $v->choix3;
if($av>0){
	$c1p = round((($v->choix1 * 100) / $av), 2);
	$c2p = round((($v->choix2 * 100) / $av), 2);
	$c3p = round((($v->choix3 * 100) / $av), 2);
}else{
	$c1p = 0;
	$c2p = 0;
	$c3p = 0;
}
?>
	<div>
		<?=$v->description;?>
		<div>
			<strong style="text-decoration: underline;">SUJET:</strong>
			<p>
			<?=$v->sujet;?>
			<br>
			<br>
			 <span class="res-coc"><span class="rc1" id="vprogress1" style="width: <?=$c1p;?>%;"><?=$c1p;?>%</span></span> [<a class="upvote" data-choix="1" data-id="<?=$v->id;?>" href="#"><?=$v->choix1_text;?></a>]
			<br>
			<span class="res-coc"><span class="rc2" id="vprogress2" style="width: <?=$c2p;?>%;"><?=$c2p;?>%</span></span> [<a class="upvote" data-choix="2" data-id="<?=$v->id;?>" href="#"><?=$v->choix2_text;?></a>] 
			<br>
			<span class="res-coc"><span class="rc3" id="vprogress3" style="width: <?=$c3p;?>%;"><?=$c3p;?>%</span></span> [<a class="upvote" data-choix="3" data-id="<?=$v->id;?>" href="#"><?=$v->choix3_text;?></a>]
			</p>
		</div>
	</div>
</div>
<style type="text/css">
	.rc1,.rc2,.rc3{
		overflow: hidden;
		height: 100%;
		transition: 2s all .1s;
	}
</style>
<script type="text/javascript">
	$(".upvote").each(function(){
		$(this).click(function(){
			var me = $(this);
			$.ajax({
				url: 'ajax/vote.php',
				type: 'get',
				dataType: 'json',
				data: {'id': me.attr('data-id'), 'choix': me.attr('data-choix')},
				success: function(d){
					if(d.success){
						$('#vprogress1').text(d.progress[0]+'%');
						$('#vprogress2').text(d.progress[1]+'%');
						$('#vprogress3').text(d.progress[2]+'%');

						$('#vprogress1').css('width',d.width[0]+'%');
						$('#vprogress2').css('width',d.width[1]+'%');
						$('#vprogress3').css('width',d.width[2]+'%');
					}
				},
				error: function(){
					//alert('vote failed');
				}
			});
			return false;
		})
	});
</script>
<br>
<hr style="height:0; width:75%; border-top: 0.4px solid #1B72CA;">

<section class="carton">
	<div class="in-carton">
		<h3>Shoutbox</h3>
		<span class="rodig"></span>
<?php 
$shoutUsers = $connect_bdd -> prepare("SELECT COUNT(DISTINCT(auteur)) AS sut FROM shoutbox");
$shoutUsers -> execute();
list($sut) = $shoutUsers -> fetch();
$shoutUsers -> closeCursor();

$tshouts = $connect_bdd -> prepare("SELECT COUNT(msg) AS tsh FROM shoutbox");
$tshouts -> execute();
list($tsh) = $tshouts -> fetch();
$tshouts -> closeCursor();

$lstmsg = $connect_bdd -> prepare("SELECT date_envoi FROM shoutbox ORDER BY id DESC LIMIT 1");
$lstmsg -> execute();
list($lst) = $lstmsg -> fetch();
$lstmsg -> closeCursor();
?>
		<div>
			<ul>
				<li><?=$sut; ?> Utilisateurs</li>
				<li><?=$tsh;?> Messages</li>
				<li>Dernier Message: <?=temps_passe(intval($lst), time()); ?></li>
				<li>Etat: actif</li>
				<li>[]<a data-tik="Shoutbox" data-content="shoutbox" class="chargeablei" href="#">ENTRER</a></li>
			</ul>
		</div>
	</div>
	<!-- <div class="in-carton">
		<h3>Questions / Réponses</h3>
<?php 
// $toqaq = $connect_bdd -> prepare("SELECT COUNT(*) AS toq FROM qa_questions");
// $toqaq -> execute();
// list($toq) = $toqaq -> fetch();
// $toqaq -> closeCursor();

// $toqar = $connect_bdd -> prepare("SELECT COUNT(*) AS tor FROM qa_reponses");
// $toqar -> execute();
// list($tor) = $toqar -> fetch();
// $toqar -> closeCursor();

// $toqaOK = $connect_bdd -> prepare("SELECT COUNT(*) AS toqOK FROM qa_questions WHERE reponses>0");
// $toqaOK -> execute();
// list($toqOK) = $toqaOK -> fetch();
// $toqaOK -> closeCursor();

// $ratio_r = ($toq > 0 ? round($toqOK/$toq, 2) : 'N/A');
// $ration_prct = ($ratio_r != 'N/A' ? 100*$ratio_r : 'N/A');
?>
		<div>
			<ul>
				<li><?=$toq;?> Questions</li>
				<li><?=$tor;?> Reponses</li>
				<li>Questions répondues: <?=$toqOK;?></li>
				<li>Ratio réponse: <?=$ratio_r;?> (<?=$ration_prct;?>%)</li>
				<li>[]<a data-tik="Questions" data-content="ask-question" class="chargeablei" href="#">Poser une Questions</a> []<a data-tik="Questions" data-content="view-questions" class="chargeablei" href="#">Voir les Questions</a></li>
			</ul>
		</div>
	</div> -->
	<div class="in-carton">
<?php 
$taskM = $connect_bdd -> prepare("SELECT COUNT(*) AS taM FROM ask_demandes WHERE titre != 0");
$taskM -> execute();
list($taM) = $taskM -> fetch();
$taskM -> closeCursor();

$taskA = $connect_bdd -> prepare("SELECT COUNT(*) AS taA FROM ask_demandes WHERE album != 0");
$taskA -> execute();
list($taA) = $taskA -> fetch();
$taskA -> closeCursor();

$taskE = $connect_bdd -> prepare("SELECT COUNT(*) AS taE FROM ask_demandes WHERE OK=0");
$taskE -> execute();
list($taE) = $taskE -> fetch();
$taskE -> closeCursor();

$taskC = $connect_bdd -> prepare("SELECT COUNT(*) AS taC FROM ask_demandes WHERE OK!=0");
$taskC -> execute();
list($taC) = $taskC -> fetch();
$taskC -> closeCursor();
?>
		<h3>Demandes d'upload</h3>
		<ul>
			<li>Morceaux: <?=$taM;?></li>
			<li>Albums: <?=$taA;?></li>
			<li>En attentes: <?=$taE;?></li>
			<li>Comblées: <?=$taC;?></li>
			<li>[]<a data-tik="Demande" data-content="demander" class="chargeablei" href="#">ENTRER</a></li>
		</ul>
	</div>
	<div class="in-carton">
		<h3>Listes de Lecture</h3>
<?php 
$tpls = $connect_bdd -> prepare("SELECT COUNT(*) AS tpl FROM playlists");
$tpls -> execute();
list($tpl) = $tpls-> fetch();
$tpls -> closeCursor();

$last_added_pl = $connect_bdd -> prepare("SELECT * FROM playlists ORDER BY id DESC LIMIT 1");
$last_added_pl -> execute();
$lap = $last_added_pl -> fetch(PDO::FETCH_OBJ);
$last_added_pl -> closeCursor();
?>
		<ul>
			<li><a data-tik="Playlists" data-content="playlist" class="chargeablei" href="#"><?=$tpl;?></a> Listes actives</li>
			<li>Dernière liste: <a data-tik="Playlists" data-content="playlist" class="chargeablei" href="#"><?=$lap->nom;?></a></li>
			<li>par: <a class="view-user" data-user="<?=$lap->auteur;?>" href="#"><?=$lap->auteur;?></a></li>
			<li><?=count(explode(',', $lap->titres_ids));?> morceaux</li>
			<li>Played <?=$lap->played;?> times</li>
		</ul>
	</div>
</section>
<script type="text/javascript">
	$('.chargeablei').each(function(){
		$(this).click(function(){
			var tik = $(this).attr("data-tik"),
			cntnt = $(this).attr("data-content");
			$("#await").remove();
			$("#section1 main").append("<center id=\"await\"></center>");
			$("#await").loadingTriangles(tik);
			setTimeout(function(){
				$("#section1 main").loadContent(cntnt+'.php');
			}, 1000);
			return false;
		});
	});

	$('.view-user').each(function(){
		$(this).click(function(){
			showProfile($(this).attr('data-user'));
			return false;
		});
	});

	function showProfile(user){
		$("#profilBox").remove();
		$.ajax({
			url: 'ajax/profil.php',
			type: 'get',
			dataType: 'json',
			data: {'user': user},
			error: function(err){
				$('body').append(
				['<center><aside id="profilBox" class="avgrund-popup">',
				'<h2>Erreur '+err.status+'</h2>',
				'<p> <em>'+err.statusText+' </em><br>',
				'La page n\'a pas pu être chargée.</p>',
				'<button onclick="javascript:fermerDialog();">Fermer</button>',
				'</aside>',
				'<article class="avgrund-contents">',
				'</article>',
				'<div class="avgrund-cover"></div></center>'
				].join('')
				);
				boite2Dialog("#profilBox");
				},
			success: function(d){
			if(d.success){
				$('body').append(
				['<center><aside id="profilBox" class="avgrund-popup">',
				'<img src="pics/'+d.pic+'" style="width:68px; height:68px; border-radius: 34px;"> <br>',
				'<span style="font-size:16pt; font-weight: bold;">'+d.username+'</span>',
				'<br><small>Membre depuis:</small> '+d.regdate,
				'<br><small>Dernier acces:</small> ' +d.lastLog,
				'<br><button onclick="javascript:fermerDialog();">Fermer</button>',
				'</aside>',
				'<article class="avgrund-contents">',
				'</article>',
				'<div class="avgrund-cover"></div></center>'
				].join('')
				);
				boite2Dialog("#profilBox");
			}else{
				$('body').append(
				['<center><aside id="profilBox" class="avgrund-popup">',
				'<h2>Erreur </h2>',
				'<p> <em>'+d.warning+' </em><br>',
				'La page n\'a pas pu être chargée.</p>',
				'<button onclick="javascript:fermerDialog();">Fermer</button>',
				'</aside>',
				'<article class="avgrund-contents">',
				'</article>',
				'<div class="avgrund-cover"></div></center>'
				].join('')
				);
				boite2Dialog("#profilBox");
			}
			}

		});
	}
</script>