<?php require_once "../php/config.php";
if(!isset($_SESSION['user'])){
	die('Must be logged first.');
}

$id = (isset($_GET['id']) ? intval($_GET['id']) : 0);
$sql = $connect_bdd -> prepare("SELECT * FROM ask_demandes WHERE id=? LIMIT 1");
$sql -> execute(array($id)) or die('dead sql');
$a = $sql -> fetch(PDO::FETCH_OBJ);
//var_dump($a);
$sql -> closeCursor();
$markAsOK = (($a->par) == $_SESSION['user'] ? ' [<a href="#" id="markAsOK" data-id="'.$a->id.'">Marquer comme Comblée</a>]' : '');
?>
<h1>Détails de la demande d'upload</h1>
<div>
	<p style="text-align: left;">
		<ul style="list-style-type: square;">
			<li>Nom d'artiste: <strong><?=strip_tags($a->artiste);?></strong></li>
			<li>Titre: <strong><?=strip_tags($a->titre);?></strong></li>
			<li>Nom d'album: <strong><?=strip_tags($a->album);?></strong></li>
			<li>Statut: <?=(($a->OK) == 0 ? '<i style="color:orange;">en attente</i>'.$markAsOK : '<span style="color:lime;">Comblée!</span>');?></li>
		</ul>
		<em>Demande formulée par <strong><?=strip_tags($a->par);?></strong></em> le <?=date('d/m/Y H\hi', $a->date_post);?>
	</p>
	<h2>Réponses</h2>
	<p style="text-align: left;">
		<form id="respF" method="post">
			<textarea style="width: 300px;" placeholder="votre texte ici" name="texte" id="texte" required="required"></textarea><br>
			<input type="hidden" name="id" value="<?=$id;?>">
			<input type="submit" value="Soumettre">
		</form>
<?php
	$stm = $connect_bdd -> prepare("SELECT * FROM ask_reponses WHERE demande_id=?");
	$stm -> execute(array($id));
	$r = $stm -> fetchAll(PDO::FETCH_OBJ);
	$stm-> closeCursor();
	echo '<table style="width:100%;" id="t145">';
	$count = 1;
	foreach ($r as $resp) {
		echo '<tr class="ligne"><td style="font-size:bold;">'.$resp->auteur.'</td><td>'.strip_tags($resp->texte).'<br><em style="font-size:small;">#'.$count.' - '.date('d/m/Y H\hi', $resp->date_post).'</em></td></tr>';
		$count++;
	}
	if($count==1)
		echo '<em class="nocomt">Aucune reponse pour le moment.</em>';
	echo '</table>';
?>
	</p>
</div>
<script type="text/javascript">
	$('#respF').submit(function(e){
		e.preventDefault();
		var data = $("#respF").serialize();
		$.ajax({
			url: 'ajax/reply2ask.php',
			type: 'post',
			dataType: 'json',
			data: data,
			error: function(){
				alert("Erreur: Votre reponse n'a pas pu etre envoyee.");
			},
			success: function(res){
				$(".nocomt").remove();
				if(res.success){
					$('#t145').prepend('<tr class="ligne"><td style="font-size:bold;">Moi</td><td>'+$('#texte').val()+'<br><em style="font-size:small;">#N - Maintenant</em></td></tr>');
					$("#respF")[0].reset();
				}else{
					alert("Erreur: "+res.warning);
				}
			}
		});
	});

	$("#markAsOK").click(function(e){
		e.preventDefault();
		var Me = $(this);
		$.get('ajax/markAsOK.php',{'id': Me.attr('data-id')}, function(){Me.remove();});
	})
</script>
<style type="text/css">
	.ligne td{
		border-bottom:1px solid #1B72CA;
	}
</style>