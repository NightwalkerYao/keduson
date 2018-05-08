<h2>editer une entree : Album</h2>
<?php
$mid = (isset($_GET['id']) ? intval($_GET['id']) : 1);
$minfos = $connect_bdd -> prepare("SELECT * FROM albums WHERE id=? LIMIT 1");
$minfos -> execute(array($mid));
$e = $minfos -> fetch(PDO::FETCH_OBJ);
$minfos -> closeCursor();
?>
<form method="post" id="f125">
	<div align="left">
		<table>
		<tr><td>dans l'URL:</td><td> <input type="text" name="code_name" value="<?=$e->code_name;?>" size="55"></td></tr>
		
		<tr><td>nom de l'album: </td><td><input type="text" name="nom" value="<?=$e->nom;?>" size="55"></td></tr>
		<tr>
		<td>artiste: </td><td><input type="text" name="artiste" value="<?=$e->artiste;?>" size="55"></td></tr>
		<tr>
		<td>genre : </td><td><input type="text" name="genre" value="<?=$e->genre;?>" size="55"></td></tr>
		<tr>
		<td>annee:</td><td> <input type="text" name="annee" value="<?=$e->annee;?>" size="55"></td></tr>
		<tr>
		<td>IDs des titres:</td><td> <input type="text" name="titres" value="<?=$e->id_titres;?>" size="55"></td></tr>
		<tr>
		<td>label:</td><td> <input type="text" name="label" value="<?=$e->label;?>" size="55"></td></tr>
		<tr>
		<td>uploader: </td><td><input type="text" name="uploader" value="<?=$e->uploader;?>" size="55"></td></tr>
		<tr>
		<td>hits:</td><td> <input type="text" name="hits" value="<?=$e->hits;?>" size="55"></td></tr>
		<tr>
		<td>likes: </td><td><input type="text" name="likes" value="<?=$e->likes;?>" size="55"></td></tr>
		<tr>
		<td>dislikes: </td><td><input type="text" name="dislikes" value="<?=$e->dislikes;?>" size="55"></td></tr>
		<tr>
		<td>moderation: </td><td><select name="moderation" class="browser-default">
			<option value="1">en moderation</option>
			<option value="0" selected="selected">approuvé</option>
		</select></td></tr>
		<tr>
			<td colspan="2" style="text-align: left; padding-left: 10%;">
			
				<img id="coverimg" src="../../covers/<?=str_replace('500X500', '200X200', $e->pochette);?>" width="200" height="200">
			<br><br>
			Changer: <input type="file" name="coverfield" id="coverfield" accept="image/*">
			<input type="text" name="cover" id="cover" value="<?=$e->pochette;?>" readonly size="40">
		
	</td>
</tr>
	<tr> <td colspan="2">
		<br>
		<center>
		<input type="hidden" name="id" value="<?=$e->id;?>">
		<input type="submit" name="update" value="Mettre a jour" class="btn-flat green"></center></td></tr>
</table>
	</div>
</form>
<script type="text/javascript">
$("#f125").submit(function(){
	$("#coverfield").val(null);
	var data = $("#f125").serialize();
	$('body').append('<div class="floating-info">Envoi en cours...</div>');
	$.ajax({
		url: 'ajax/edit-disc.php',
		type: 'post',
		dataType: 'json',
		data: data,
		error: function(err){
			$('.floating-info').text('Erreur: '+err.status+' :: '+err.statusText);
				$('.floating-info').css('color', 'red');
				$('.floating-info').fadeOut(5000);
		},
		success: function(d){
			if(d.success){
				$('.floating-info').text('Mise a jour effectuee!');
				$('.floating-info').css('color', 'green');
			}else{
				$('.floating-info').text('Erreur: '+d.warning);
				$('.floating-info').css('color', 'red');
				$('.floating-info').fadeOut(5000);
			}
		}
	});
	return false;
});

$('#coverfield').on('change', function(){
	var lire = new FileReader();
    lire.onload = function(){
    	$('#coverimg').attr('src', lire.result);
    	$('#coverfield').before('<div id="cover-prog-frame" style="width:30%; height:7px; border: 0; background-color: navy;" align="left"><div id="cover-up-progress"></div></div> <br>');
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
</script>
<style>
	table td{
		border:none;
	}
	tr td:nth-child(1){
		text-align: right; padding-right: 1%;
	}
</style>