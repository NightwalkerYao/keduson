<div class="container"> <h2>Changer la pochette par defaut</h2>
<div class="divider"></div>
<div>
	<center>
		<figure>
			<img src="../../covers/<?=@file_get_contents('settings/default-cover.set'); ?>">
			<figcaption>Cover actuelle</figcaption>
		</figure>
		<div class="divider"></div>
		<h3>Upload une nouvelle cover</h3>
		<div id="op898">
			<input type="file" name="cov" id="cov" onchange="$(this).addCover(this);">
		</div>
        <br>
        <br>
        <br>
	</center>
</div>
</div>
<script type="text/javascript">
	$.fn.addCover = function(elt){
            var imgExts = ['jpg','jpeg','png','gif'], pochette = elt.files[0], photoExt = pochette.name.split('.')[pochette.name.split('.').length-1].toLowerCase();
                //console.log('tvc', tvc);
            //console.log('pochette', pochette);
            //console.log('id', '#'+elt.parentNode.parentNode.parentNode.parentNode.getAttribute('id'));
            var dv = $('#op898');
            var moi = $('#cov');
            //var covret = $('#'+elt.parentNode.parentNode.parentNode.parentNode.id+' input[name=cover]');
                //console.log('di', dv, 'moi', moi, 'covret', covret);
            if(imgExts.indexOf(photoExt) != -1){
                var lire = new FileReader();
                lire.onload = function(){
                    $('#zzimd').remove();
                    moi.before('<div id="zzimd" align="center"><br> <img id="zzim" width="40%" src="'+lire.result+'" /> <div id="cover-prog-frame" style="width:60%; height:7px; border: 0; background-color: navy;" align="left"><div id="cover-up-progress"></div></div> <br><br></div>');
                    var up_photo = new FormData();
                    up_photo.append('cover', pochette);

                    $.ajax({
                            url: '../../php/ajax/upload-cover.php',
                        xhr: function(){
                            var cxhr = new XMLHttpRequest();
                            var csize = pochette.size;
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
                            if(cu.end == 'success'){ 
                                M.toast({html: '<i class="material-icons left green">done</i>Upload Terminé!'});
                                $("#cover-prog-frame").remove();
                                dv.append('<br> picture uploaded.<br> Completing ops...');
                                $.get('ajax/chdefcover.php', {'name': cu.path}, function(d){
                                	if(d.success){
                                		dv.append('<br> all done!');
                                        M.toast({html: '<i class="material-icons left green">done</i> Terminé!'});
                                    }

                                	else
                                		M.toast({html: '<i class="material-icons left red">clear</i>Writing file name failed'});
                                }, 'json');
                            }else{
                                M.toast({html: '<i class="material-icons left red">clear</i>Erreur: '+cu.message});
                            }
                        }
                    });
                };
                lire.readAsDataURL(pochette);
            }else{
                M.toast({html: '<i class="material-icons left red">clear</i>'+pochette.name+' n\'est pas une image valide'});
           }  
       }

</script>