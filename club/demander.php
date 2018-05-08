<h1>Soumettre une Demande d'Upload</h1>
<div style="text-align: left; padding-left: 2em; box-sizing: border-box;">
	<p style="text-align: left; width: 78%; font-size: small;">
		Si vous ne trouvez pas un morceau ou un album dans nos listes, vous pouvez formuler une demande ici et la communauté se chargera de combler votre demande (si elle compréhensible, bien sûr!).<br>
		Avant de faire votre demande: <br>
		- assurez-vous que le fichier n'existe pas déjà<br>
		- utilisez <a href="../p/downloads">la recherche</a> de façon intélligente pour être sûr que nous n'avons pas déjà ce que vous voulez dans nos listes <br>
		- disposez du nom précis de l'artiste, du titre de la chanson ou du nom de l'album sinon, utilisez Questions/Réponses ou la discussion instantanée pour demandez des renseignements. <br>
	</p>
	<p style="font-style: italic; text-align: left;">
		Si vous avez compris ce qui précède, vous pouvez continuer
	</p>
	<div>
<script type="text/javascript">
	$('#form789').submit(function(){
		var err = 0;
		$('#form789 input[type=text]').each(function(){
			$(this).css('border', '1px solid #18385B');
			if($(this).val() != '' && $(this).val() != ' '){
				var toNex = true;
			}else{
				$(this).css('border', '1px solid #F6CE18');
				err++;
			}
		});
		if(err>0)
			return false;
		data = $('#form789').serialize();
		$('#form789 input[type=submit]').attr('active', false);
		$.ajax({
			url: 'ajax/demander.php',
			type: 'post',
			dataType: 'json',
			data: data,
			error: function(err){
				alert("Erreur "+err.status+" : "+err.statusText);
			},
			success: function(resp){
				if(resp.success){
					$('#form789')[0].reset();
					$('#form789').before('<mark> Votre demande a ete soumise avec succes. </mark><br>')
				}
			}
		});
		return false;
	});
</script>
		<form method="post" id="form789">
			<div>
				<table>
				<tr> <td><label for="artiste">Nom de l'Artiste:</label></td>
				<td><input type="text" name="artiste" id="artiste"></td>
				</tr><tr>
				<td><label for="titre">Titre de la chanson:</label></td>
				<td><input type="text" name="titre" id="titre"></td>
				</tr><tr>
				<td><label for="album">Nom de l'album:</label></td>
				<td><input type="text" name="album" id="album"></td>
				</tr><tr>
				<td colspan="2" align="center"> <input type="submit" value="Demander!"></td>
				</tr>
				</table>
			</div>
		</form>
	</div>
</div>
<style type="text/css">
	#form789 input[type=text]{
		/*width: 25%;*/
		min-width: 230px;
		border: 1px solid #18385B;
		height: 1.6em;
		font-size: 10pt;
	}
</style>