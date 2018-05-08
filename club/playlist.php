<?php require_once "../php/config.php";
if(!isset($_SESSION['user'])){
	die('Must be logged first.');
}
// $adminsfile = file_get_contents('../lab/team1.lst');
// $admins = explode(';', $adminsfile);
// $modo = false;
// if(in_array($_SESSION['user'], $admins))
// 	$modo = true;
?>
<h1>PlayLists</h1>
<?php 
// if($modo){
// 	echo '<a href="#" id="addPL">Ajouter une PL</a>';
// }
?>
<br>
<?php 
$pl = $connect_bdd -> prepare("SELECT * FROM playlists ORDER BY id DESC LIMIT 15");
$pl -> execute();
$play = $pl -> fetchAll(PDO::FETCH_OBJ);
$pl -> closeCursor();
echo '<table style="width:100%; position: relative; clear: both;">';
echo '<tr> <th>Nom</th> <th> auteur</th> <th> Longueur</th> <th> </th></tr>';
$count = 1;
foreach ($play as $p) {
	echo '<tr class="pligne" data-id="'.$p->id.'"> <td>'.$count.'. '.$p->nom.' </td> <td> <a class="view-user" data-user="'.$p->auteur.'" href="#">'.$p->auteur.'</a> </td><td>'.count(explode(',', $p->titres_ids)).' morceaux </td> <td> joué <strong> '.$p->played.'</strong> fois</td> <td><button class="b1254" title="Options">&#9776;</button> <div class="PLoptions opti'.$p->id.'"> <a href="#"> '.$p->likes.' likes</a> <a href="#">'.$p->dislikes.' dislikes </a> <a href="#">Telecharger</a> <a href="#" id="click2play">Jouer</a></div></td> </tr>';
	$count++;
}
echo '</table>';
?>
<style type="text/css">
	th{
		text-align: left;
	}
	.pligne td{
		border-bottom:1px solid #1B72CA;
		vertical-align: top;
		height: 10px;
		overflow: hidden;
	}
	div.PLoptions{
		height: 0;
		width: 0;
		display: none;
		background-color: rgba(0, 45, 64, 0.95);
		position: absolute;
		left: 0;
		/*border: 1px solid #ccc;*/
		transition: 2s all .1s;
		clear: both;
		/*border-radius: 5px 0 5px 5px;*/
		font-size: 10pt;
		box-sizing: border-box;
		padding-top: 8px;
	}
	div.PLoptions span, div.PLoptions a{
		display: block;
		padding: 3px 1em;
	}
	div.PLoptions a:hover{
		background-color: rgba(27, 114, 202, 0.28);
	}
	.b1254{
		background: transparent;
		border:none;
		padding: 5px;
		font-size: 12pt;
		color: #fff;
		cursor: pointer;
	}
</style>
<script type="text/javascript">
var menuisopen = false;

$('.b1254').each(function(){
	$(this).click(function(){
		var localID = $(this).closest('tr').attr('data-id');
		var menui = $('.opti'+localID);
		$('.PLoptions').hide();
		menui.css('width','110px').css('height','110px').css('display', 'block').css('top',$(this).offset().bottom+'px').css('left', $(this).offset().left-130+'px');
		menuisopen = true;
	});
	$(this).on('blur', function(){
		if(menuisopen)
			$('.PLoptions').hide();
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
