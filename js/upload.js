$(document).ready(function(){
	var btn1 = $('#sendSingles');
	$('#upfield').on('change', function(){
		var champ = document.getElementById('upfield'), F = champ.files[0], extension = F.name.split('.')[F.name.split('.').length-1], taille = Math.round(F.size/Math.pow(2,10));

		if((['mp3','aac','m4a','ogg','flac','wav','mid','zip','jpg'].indexOf(extension.toLowerCase())) != -1){
			$('#Flogger').html('<p class="file-details">'+F.name+' ('+taille+'Ko)</p>')
			btn1.attr('disabled', false)
		}else{
			$('#Flogger').html('<p class="file-details" style="color:red;">'+F.name+' ('+taille+'Ko)</p>')
			btn1.attr('disabled', 'disabled')
		}
	})
	$('#F1p').submit(function(){
		$('#Flogger').append(['<div class="progress-container" style="width: 85%;">',
			'<progress id="progress-dsp" max="'+document.getElementById('upfield').files[0].size+'" value="0" style="width: 70%;">Envoi en cours...</progress>',
			'<p id="progress-pct">Envoi: 0%</p>',
			'</div>'].join(' '));

		var fd = new FormData(this);
        $.ajax({
            url: '/ajax/upload', //$(this).attr('action'),
            xhr: function(){
                var xhr = new XMLHttpRequest();
                var total = document.getElementById('upfield').files[0].size;
                xhr.upload.addEventListener('progress', function(a){
                    var loaded1 = Math.round((a.loaded*100)/total);
                    $("#progress-dsp").attr('value',a.loaded);
                    $("#progress-pct").text('Envoi: '+loaded1+'%');
                });
                return xhr;
            },
            type: 'POST',
            processData: false,
            contentType: false,
            data: fd,
            dataType: 'json',
            error: function(er){
            	alert('Erreur '+er.status+': '+er.statusText);
            },
            success: function(res){
            	if(res.end == 'success' && res.extension != 'zip'){ // uploaded successful
                    $('#workin').html([
                        '<form class="formulaireSingle" enctype="multipart/form-data" id="Fsingle">',
                        '<div class="divider1"></div>',
                        '<h2>Finaliser l\'ajout</h2>',
                        '<span id="id3tagstatus" style="color: lime;">Lecture des tags ID3 ...</span>',
                        '<br> ',
                        '<div class="fastAddForm inform">',
                        '<label for="artist" class="libelef">Artiste:</label>',
                        '<input class="rightFastInput" type="text" name="artist" id="artist" placeholder="Artiste"> ',
                        '<br> ',
                        '<label for="title" class="libelef">Titre:</label> ',
                        '<input class="rightFastInput" type="text" name="title" id="title" placeholder="Titre"> ',
                        '<br> ',
                        '<label for="album" class="libelef">Album:</label> ',
                        '<input class="rightFastInput" type="text" name="album" id="album" placeholder="Album"> ',
                        '<br> ',
                        '<label for="genre" class="libelef">Genre:</label> ',
                        '<input class="rightFastInput" type="text" name="genre" id="genre" placeholder="Genre"> ',
                        '<br> ',
                        '<label for="year" class="libelef">Annee: </label> ',
                        '<input class="rightFastInput" type="text" name="year" id="year" placeholder="Annee"> ',
                        '<br> ',
                        '<label for="track_no" class="libelef">N° de piste: </label> ',
                        '<input class="rightFastInput" type="text" name="track_no" id="track_no" placeholder="Numero piste"> ',
                        '<br> ',
                        '<label for="duration" class="libelef">Duree: </label> ',
                        '<input class="rightFastInput" type="text" name="duration" id="duration" placeholder="Duree"> ',
                        '<br>',
                        '<label for="label" class="libelef">Label: </label> ',
                        '<input class="rightFastInput" type="text" name="label" id="label" placeholder="Label"> ',
                        '<br>',
                        '<div class="divider1"></div> ',
                        'Suggestions de pochette: ',
                        '<br> ',
                        '<div id="defcovers">',
            
                        '</div> ',
                        ' Ou <br> ',
                        '<label for="upcoverfield" class="label-upload">Ajouter pochette</label>',
                        '<div class="divider1"></div> ',
                        '<input type="file" class="phantom" style="width:0.1px; height:0.1px;" id="upcoverfield" name="upcoverfield" accept="image/*"> ',
                        //'<button id="upcover" type="button" class="button-neutre">Ajouter pochette</button> ',
                        //'<br> ',
                        '<input type="hidden" mame="cover" id="cover" value=""> ',
                        '<input type="hidden" name="upload_id" id="upload_id" value="'+res.id+'">' ,
                        '<div class="divider1"></div> ',
                        '<input type="submit" class="button-normal" id="OKfinish" value="Soumettre">',
                        '</div>',
                        '</form>'
                    ].join(' '));

                    //fetch id3 tags on the audio file
                    $("#id3tagstatus").ready(function(){
                        var id3file = res.outname;
                        $.ajax({
                            url : '/ajax/getid3tagz',
                            type : 'POST',
                            data: {"targetfile":id3file, "file_type":"temp"},
                            dataType : 'json',
                            success : function(o){
                                if(o.end == 'success'){ //id3 got !
                                    $("#id3tagstatus").text("Lecture des tags terminée. Completion... OK");
                                    $("#artist").val(o.artist);
                                    $("#title").val(o.title);
                                    $("#album").val(o.album);
                                    $("#year").val(o.year);
                                    $("#track_no").val(o.track);
                                    $("#duration").val(o.duration);
                                    $("#label").val(o.label);
                                    $("#genre").val(o.genre);
                                    //$("#id3tagstatus").remove();
                                    //fetch recommanded cover pics
                                    $.ajax({ 
                                        url: '/ajax/recommanded-artwork',
                                        type: 'post',
                                        data: {"artist": o.artist+'do not add', "album": o.album+'do not add'}, //corriger pour refaire le script.
                                        dataType: 'json',
                                        success: function(art){
                                            if(art.pochette1) //at least one cover
                                                $("#defcovers").append('<img src="'+ROOT_SANS+'/covers/'+art.pochette1+'" class="sugg-pochette" data-art="'+art.pochette1+'" title="Cliquez pour choisir" id="dpochet1" onclick="choose_pochet(this,\'.sugg-pochette\',\'cover\');" >');
                                            else //no cover
                                                $("#defcovers").append('<span class="message echec"><i>Aucune suggestion disponible</i></span>');
                                            if(art.pochette2)
                                                $("#defcovers").append('<img src="'+ROOT_SANS+'/covers/'+art.pochette2+'" class="sugg-pochette" data-art="'+art.pochette2+'" title="Cliquez pour choisir" id="dpochet2" onclick="choose_pochet(this,\'.sugg-pochette\',\'cover\');">');
                                            if(art.pochette3)
                                                $("#defcovers").append('<img src="'+ROOT_SANS+'/covers/'+art.pochette3+'" class="sugg-pochette" data-art="'+art.pochette3+'" title="Cliquez pour choisir" id="dpochet3" onclick="choose_pochet(this,\'.sugg-pochette\',\'cover\');">');
                                            if(art.pochette4)
                                                $("#defcovers").append('<img src="'+ROOT_SANS+'/covers/'+art.pochette4+'" class="sugg-pochette" alt="'+art.pochette4+'" title="Cliquez pour choisir" id="dpochet4" onclick="choose_pochet(this,\'.sugg-pochette\',\'cover\');">');
     
                                        }
                                    });
                                                
                                }else{ // no id3 tags got
                                    $("#id3tagstatus").css('color', 'red');
                                    $("#id3tagstatus").text(o.message);
                                    var delafter = setTimeout(function(){
                                        $("#id3tagstatus").remove();
                                    }, 10000);
                                    $("#defcovers").append('<span class="message echec"><i>Aucune suggestion disponible</i></span>');
                                }
                            }
                        });
                    });

                    //upload a custom cover
                    $("#upcoverfield").ready(function(){
                        document.querySelector("#upcoverfield").addEventListener('change', function(){
                            var imgExts = ['jpg','jpeg','png','gif'], pochette = document.getElementById('upcoverfield').files[0], photoExt = pochette.name.split('.')[pochette.name.split('.').length-1].toLowerCase();
                            if(imgExts.indexOf(photoExt) != -1){
                                var lire = new FileReader();
                                lire.onload = function(){
                                    $('#zzimd').remove();
                                    $('#upcoverfield').after('<div id="zzimd"><img id="zzim" width="128" height="160" src="'+lire.result+'" /> <div id="cover-prog-frame" style="width:127px; height:4px; border: 0; background-color: steelblue;"><div id="cover-up-progress"></div></div></div>');
                                    
                                    var up_photo = new FormData();
                                    up_photo.append('cover', pochette);
                                    
                                    $.ajax({
                                        url: '/ajax/upload-cover',
                                        xhr: function(){
                                            var cxhr = new XMLHttpRequest();
                                            var csize = pochette.size;
                                            cxhr.upload.addEventListener('progress', function(c){
                                                cloaded = Math.round((c.loaded/csize)*127);
                                                $("#cover-up-progress").width(cloaded+'px');
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
                                                $("#cover").val(cu.path);
                                                $("#cover-prog-frame").remove();
                                            }else{
                                                alert(cu.message);
                                            }
                                        }
                                    });
                                    
                                };
                                lire.readAsDataURL(pochette);
                            }else{
                                alert(pochette.name+' n\'est pas une image valide');
                            }
                            
                        }, false);
                    });

                    //submit the single's form
                    $('#Fsingle').ready(function(){
                    $('#Fsingle').submit(function(){
                        //b.preventDefault();
                        var eer = 0;
                        $(".indicativR8").remove();
                        $("#title,#artist").each(function(){
                            $(this).css('border', '0');
                            if($(this).val().trim() == ''){ //artist or title empty
                                eer++; 
                                $(this).css('border', '1px solid red');
                                $(this).before("<span style='color:red;' class='indicativR8'>Veillez remplir ce champ.</span>");
                                $(document).scrollTop($(this).offset().top-40);
                            }
                            $(this).on("keyup", function(){
                                if($(this).val().trim()==''){
                                    $(this).css('border', '1px solid red');
                                }else{
                                    $(this).css('border', '0');
                                }
                            });
                        });
                        if($('#cover').val().trim() == ''){ //no cover value
                            if(confirm("Vous n'avez pas indiqué de pochette.\n En continuant, une pochette par défaut sera ajoutée automatiquement.")){
                                $("#cover").val("default.jpg");
                            }else{
                                eer++;
                            }
                        }        
                        if(eer == 0){ //no major error
                            var datas = {
                                            "artist": $("#artist").val(),
                                            "title": $("#title").val(),
                                            "album": $("#album").val(),
                                            "genre": $("#genre").val(),
                                            "year": $("#year").val(),
                                            "track_no": $("#track_no").val(),
                                            "duration": $("#duration").val(),
                                            "label": $("#label").val(),
                                            "upload_id": $("#upload_id").val(),
                                           "cover": $("#cover").val()
                                        };
                            $("#OKfinish").after("<p> <b> Chargement en cours...</b></p>");
                            //console.log(datas);
                            //return false;
                            $.ajax({
                                url: "/ajax/complete_single_upload",
                                type: 'POST',
                                data: datas,
                                dataType: 'json',
                                error: function(er){
                                    alert('Erreur '+er.status+' :'+er.statusText);
                                },
                                success: function(ret){
                                    if(ret.id){ //well done
                                        $("#workin").html("<div class='message succes' id='tg548'><p style='color:green;'><i>Informations soumises avec succès. Votre upload est actuellement en modération et sera disponible une fois approuvé.</i></p></div>");
                                        $(document).scrollTop($("#tg548").offset().top-40);
                                        $("#tg548").fadeIn('slow');
                                        $('#Flogger').html(' ');
                                    }else{
                                        alert(ret.message);
                                    }
                                }
                            });
                        }
                        return false;
                    });
                    });
                }
            }
        })
		return false;
	})
})
