<h2>Upload temporaires: non termin3s (par des utilisateurs)</h2>
<?php 
$tu = $connect_bdd -> prepare("SELECT * FROM temp_ups ORDER BY id DESC");
$tu -> execute();
$t = $tu -> fetchAll(PDO::FETCH_OBJ);
$tu->closeCursor();

echo '<table>';
echo '<tr><th>Actions</th><th>ID</th><th>File Name</th><th>Stored Name</th><th>Uploader</th><th>Date</th></tr>';
foreach ($t as $e) {
	echo '<tr id="'.$e->id.'" data-file="'.$e->store_name.'" data-uploader="'.$e->uploader.'">';
	echo '<td><a href="#" class="continuer">Continuer</a> || <a href="#" class="lire">Lire</a> || <a href="#" class="annuler">Annuler</a></td>';
	echo '<td>'.$e->id.'</td>';
	echo '<td>'.$e->file_name.'</td>';
	echo '<td>'.$e->store_name.'</td>';
	echo '<td>'.$e->uploader.'</td>';
	echo '<td>'.date('d/m/Y H:i', $e->date_upload).'</td>';
	echo '</tr>';
}
echo '</table>';
?>

<br>
<br>
<h3>Choisir "Continuer" sur une entree pour continuer</h3>
<form method="post" enctype="multipart/form-data" id="f245">
	<table id="t789">
		<tr>
			<td colspan="2" id="board"></td>
		</tr>
		<tr>
			<td colspan="2"><h4 id="fn"></h4></td>
		</tr>
		<tr>
			<td>Titre: </td>
			<td><input type="text" name="titre" id="titre" size="50"></td>
		</tr>
		<tr>
			<td>Artiste:</td>
			<td><input type="text" name="artiste" id="artiste" size="50"></td>
		</tr>
		<tr>
			<td>Album:</td>
			<td><input type="text" name="album" id="album" size="50"></td>
		</tr>
		<tr>
			<td>Annee:</td>
			<td><input type="text" name="annee" id="annee" size="50"></td>
		</tr>
		<tr>
			<td>Piste:</td>
			<td><input type="text" name="piste" id="piste" size="50"></td>
		</tr>
		<tr>
			<td>Duree: </td>
			<td><input type="text" name="duree" id="duree" size="50"></td>
		</tr>
		<tr>
			<td>Genre: </td>
			<td><input type="text" name="genre" id="genre" size="50"></td>
		</tr>
		<tr>
			<td>Label:</td>
			<td><input type="text" name="label" id="label" size="50"></td>
		</tr>
		<tr>
			<td>Uploader:</td>
			<td><input type="text" name="uploader" id="uploader" size="50"></td>
		</tr>
		<tr>
			<td>Ajouter une pochette: 
				<br>
				Ou <button type="button" class="btn-flat waves-effect waves-light amber lighten-1 white-text" id="defaultCv">Pochette par defaut</button></td>
			<td>
				<input type="file" name="coverfield" id="coverfield" accept="image/*">
				<br>
				<input type="text" name="cover" id="cover" size="45">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="hidden" name="file_name" id="file_name">
				<input type="hidden" name="id" id="id">
				<br>
				
				<center>
					<input type="submit" value="Soumettre" class="btn-flat waves-effect waves-light blue lighten-3">
				</center>
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		// upload a custom cover
		$('#coverfield').on('change', function(){
	var lire = new FileReader();
    lire.onload = function(){
    	$('#justLoaded').remove();
				$('#coverfield').after('<div id="justLoaded" class="container flow-text left"><br><img src="'+lire.result+'" style="width: 30%"><br><div id="cover-prog-frame" style="width: 30%; height: 7px; border: 0; background-color: blue;" align="center"><div id="cover-up-progress"></div></div>');
    	var up_photo = new FormData();
       	up_photo.append('cover', document.getElementById('coverfield').files[0]);

        $.ajax({
            url: '../../php/ajax/upload-cover.php',
            xhr: function(){
                var cxhr = new XMLHttpRequest();
                var csize = document.getElementById('coverfield').files[0].size;
                cxhr.upload.addEventListener('progress', function(c){
                        cloaded = Math.round((c.loaded/csize)*100);
                        $("#cover-up-progress").width(cloaded+'%');
                            });
                        return cxhr;
                },
            type: "POST",
            processData: false,
            contentType: false,
            data: up_photo,
            dataType: 'json',
            success: function(cu){
             	if(cu.end == 'success'){ // cover uploaded
                    $('#cover').val(cu.path);
                    $("#cover-prog-frame").remove();
                }else{
                    alert(cu.message);
                }
            }
        });
    };
    lire.readAsDataURL(document.getElementById('coverfield').files[0]);
});

		//submit the form
		$('#f245').submit(function(e){
			e.preventDefault();
			var fdatas = {
				'artist': $('#artiste').val(),
				'title': $('#titre').val(),
				'upload_id': $('#id').val(),
				'uploader': $('#uploader').val(),
				'album': $('#album').val(),
				'genre': $('#genre').val(),
				'track_no': $('#piste').val(),
				'year': $('#annee').val(),
				'duration': $('#duree').val(),
				'cover': $('#cover').val(),
				'label': $('#label').val()
			};
			$.ajax({
				url: 'ajax/subtemp.php',
				type: 'post',
				dataType: 'json',
				data: fdatas,
				error: function(er){
					M.toast({html:'<i class="material-icons left red-text">cancel</i> Erreur '+er.status});
				},
				success: function(dat){
					if(dat.end == 'success'){
						M.toast({html:'<i class="material-icons left green-text">done</i> Terminé, ajoute a la BDD!'});
						//write tags to the audio file
						var tagDatas = {
							'Filename' : dat.file_path,
							'WriteTags': 1,
							'TagFormatsToWrite': ['id3v2.3'],
							'remove_other_tags': true,
							'artiste': $('#artiste').val(),
							'titre': $('#titre').val(),
							'album': $('#album').val(),
							'Genre': $('#genre').val(),
							'piste': $('#piste').val(),
							'annee': $('#annee').val(),
							'cover': $('#cover').val(),
							'label': $('#label').val(),
							'Comment': 'Morceau téléchargé depuis www.KeDuSon.com',
							'TracksTotal': 1,
							'APICpictureType': 3
						};
						M.toast({html:'<i class="material-icons left">info</i> Ecriture des Tags ID3...'});
						$.ajax({
							url: '../../php/ajax/writeId3.php',
							dataType: 'json',
							type: 'post',
							data: tagDatas,
							error: function(er){
								M.toast({html:'<i class="material-icons left red-text">cancel</i> Error Writing tags: '+er.status});
							},
							success: function(dt){
								if(dt.success){
									M.toast({html:'<i class="material-icons left green-text">done</i> Terminé!'});
								}else{
									M.toast({html:'<i class="material-icons left white-text">info</i> Failed Writing Tags.'});
								}
								$('tr[id='+$('#id').val()+']').fadeOut('slow');
								$('#f245')[0].reset();
							}
						});

					}else{
						M.toast({html:'<i class="material-icons left red-text">cancel</i> Erreur '+dat.message});
					}
				}
			});
		});
		//get the default cover
		$('#defaultCv').click(function(){
			$.get('settings/default-cover.set', function(data){
				$('#cover').val(data);
			});
		});
		//submit to complet
		$('.continuer').each(function(){
			$(this).click(function(e){
				e.preventDefault();
				var ctr = $(this).closest('tr');
				$('#uploader').val(ctr.attr('data-uploader'));
				$('#file_name').val(ctr.attr('data-file'));
				$('#id').val(ctr.attr('id'));
				$('#titre').focus();
				M.toast({html:'<i class="material-icons left">info</i> Obtention des Tags ID3...'});
				$.ajax({
					url: '../../php/ajax/getid3tagz.php',
					type: 'post',
					dataType: 'json',
					data: {'targetfile' : ctr.attr('data-file'), 'file_type': 'temp'},
					error: function(er){
						M.toast({html:'<i class="material-icons left red-text">cancel</i> Erreur '+er.status});
					},
					success: function(dat){
						if(dat.end == 'success'){
							M.toast({html:'<i class="material-icons left green-text">done</i> Terminé, tags obtenus!'});
							var btr = parseInt(dat.bitrate.split('k')[0]);
							M.toast({html:'<i class="material-icons left white-text">info</i>Bitrate: '+btr+'kbps'});
							$('#artiste').val(dat.artist);
							$('#titre').val(dat.title);
							$('#album').val(dat.album);
							$('#annee').val(dat.year);
							$('#piste').val(dat.track);
							$('#genre').val(dat.genre);
							$('#label').val(dat.label);
							$('#duree').val(dat.duration);
						}else{
							M.toast({html:'<i class="material-icons left red-text">cancel</i> Erreur '+dat.message});
						}
					}
				});
			});
		});
		//lire
		$('.lire').each(function(){
			$(this).click(function(e){
				e.preventDefault();
				$('#lecteur').remove(); // <audio> container
				$(this).closest('table').before('<div id="lecteur" class="container blue lighten-2 white-text"></div>');
				$('#lecteur').append('<audio src="../../temp_upz/'+$(this).closest('tr').attr('data-file')+'" controls autoplay></audio>');
				$(document).scrollTop($('#lecteur').offset().top-100);
			});
		});
		//cancel
		$('.annuler').each(function(){
			$(this).click(function(e){
				e.preventDefault();
				var data = {'file': $(this).closest('tr').attr('data-file'), 'id': $(this).closest('tr').attr('id')};
				M.toast({html:'<i class="material-icons left">delete</i> Suppression en cours...'});
				$.ajax({
					url: 'ajax/cancel-temp.php', 
					data: data,
					dataType: 'json',
					type: 'post',
					error: function(er){
						M.toast({html:'<i class="material-icons left red-text">cancel</i> Erreur '+er.status});
					},
					success: function(dat){
						if(dat.success){
							M.toast({html:'<i class="material-icons left green-text">done</i> Annulé!'});
							$('tr[id='+dat.id+']').fadeOut('slow');
						}else{
							M.toast({html:'<i class="material-icons left red-text">cancel</i> Erreur: '+dat.message});
						}
					}
				});
			});
		});
	});
</script>


<style>
	table#t789 td{
		border:none;
		padding: 3px;
	}
	#t789 tr td:nth-child(1){
		text-align: right; padding-right: 1%;
		font-size: 11pt;
	}
</style>