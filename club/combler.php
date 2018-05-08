<?php require_once "../php/config.php";
if(!isset($_SESSION['user'])){
	die('Must be logged first.');
}
?>
<h1>Combler une Demande d'Upload</h1>
<div>
	<p style="text-align: left;">
		Pour combler une demande, suivez ces étapes:
	</p>
	<ol style="font-size: small;">
		<li>
			Choisissez une demande dans la liste d'attente
		</li>
		<li>
			Servez-vous de la page d'upload <a href="../p/add">ici</a> pour envoyer votre fichier
		</li>
		<li>Complétez les informations</li>
		<li>Validez votre upload et attendez l'approbation des modérateurs</li>
		<li>Copiez le lien vers le/les fichiers depuis les listes de téléchargements</li>
		<li>Commenter la demande d'upload ave le/les liens que vous venez de copier</li>
		<li>et c'est terminé!</li>
	</ol>
	<p style="text-align: left;">
		Si vous avez fait une demande, n'oubliez pas de marquer [OK] quand elle a été comblée.
		<br>
		Dites merci à l'uploader au passage.
	</p>
</div>
<h2>Liste d'attente</h2>
<div class="pending-reqs">
<?php
	$getList = $connect_bdd -> prepare("SELECT * FROM ask_demandes WHERE OK=0 ORDER BY id ASC LIMIT 50");
	$getList -> execute();
	$gl = $getList -> fetchAll(PDO::FETCH_OBJ);
	$getList -> closeCursor();
	echo '<table style="width: 100%; border: none; box-sizing: border-box;">';
	foreach ($gl as $g) {
		echo '<tr data-id="'.$g->id.'" class="trendessous"><td >'.$g->artiste.' - '.$g->titre. ' - '.$g->album.'</td><td> <small>posté par</small><a href="#" class="view-user" data-user="'.$g->par.'"> '.$g->par.'</a> </td><td> <a href="#" class="linkCombler">Combler</a></td></tr>';
	}
	echo '</table>';
?>
</div>
<h2>Demande résolues</h2>
<div class="filled-reqs">
<?php
	$getList = $connect_bdd -> prepare("SELECT * FROM ask_demandes WHERE OK!=0 ORDER BY id DESC LIMIT 50");
	$getList -> execute();
	$gl = $getList -> fetchAll(PDO::FETCH_OBJ);
	$getList -> closeCursor();
	echo '<table style="width: 100%; box-sizing: border-box;">';
	foreach ($gl as $g) {
		echo '<tr data-id="'.$g->id.'" class="trendessous"><td>'.$g->artiste.' - '.$g->titre. ' - '.$g->album.'</td><td> <small>posté par</small> <a href="#" class="view-user" data-user="'.$g->par.'">'.$g->par.'</a> </td><td> OK - <a href="#" class="linkCombler">voir</a></td></tr>';
	}
	echo '</table>';
?>
</div>
<style type="text/css">
	.trendessous td{
		border-bottom:1px solid #1B72CA;
	}
</style>
<script type="text/javascript">
	$('.linkCombler').each(function(){
		$(this).click(function(e){
			e.preventDefault();
			var me = $(this);
			me.closest('div').append('<div id="trigles"></div>');
			$('#trigles').loadingTriangles('Chargement');
			setTimeout(function(){
				$("#section1 main").loadContent('ask.php?id='+me.closest('tr').attr('data-id'));
			}, 1000);
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