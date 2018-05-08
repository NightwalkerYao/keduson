$(document).ready(function(){
    
    //upload a cover
        $.fn.addCover = function(elt){
            var imgExts = ['jpg','jpeg','png','gif'], pochette = elt.files[0], photoExt = pochette.name.split('.')[pochette.name.split('.').length-1].toLowerCase();
                //console.log('tvc', tvc);
            //console.log('pochette', pochette);
            //console.log('id', '#'+elt.parentNode.parentNode.parentNode.parentNode.getAttribute('id'));
            var dv = $('#'+elt.parentNode.parentNode.parentNode.parentNode.id+' #zzimd');
            var moi = $('#'+elt.parentNode.parentNode.parentNode.parentNode.id+' input[type=file]');
            var covret = $('#'+elt.parentNode.parentNode.parentNode.parentNode.id+' input[name=cover]');
                //console.log('di', dv, 'moi', moi, 'covret', covret);
            if(imgExts.indexOf(photoExt) != -1){
                var lire = new FileReader();
                lire.onload = function(){
                    dv.remove();
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
                            if(cu.end == 'success'){ // cover uploaded
                                covret.val(cu.path);
                                //$("#oldpoch").parent().remove();
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
       }

    $.fn.retirerForm = function(){
        $(this).closest('form').remove();
    }

    $.fn.addDefCover = function(ide){
        $.get('settings/default-cover.set', function(d){
            $(ide).val(d);
        }, 'text');
    }

    //add multiple singles
    $('#max_single_add').click(function(){
        var rep = document.getElementById('max_single_add').getAttribute('data-dir'),
            fliste = document.getElementById('max_single_add').getAttribute('data-filelist'),
            fichiers = JSON.parse(fliste),
            pochette = '',
            pochNom = '',
            true_dir = '';
            
            true_dir = rep.split('/files/')[rep.split('/files/').length-1];
            //console.log('true dir', true_dir);
            //try to find the cover
        for(var i=0; i<fichiers.nbfiles; i++){
            var itm = fichiers.files[i], ext = '', img_type = ['jpg', 'jpeg', 'png', 'gif'];
            ext = itm.split('.')[itm.split('.').length-1].toLowerCase();
            if(img_type.indexOf(ext) != -1){
                pochNom = itm;
                pochette = '<center> <img src="'+fichiers.dir+'/'+itm+'" style="width: 35%;" id="oldpoch"></center>';
            }
        }

        $(this).parent().append('<div id="multiadd"></div>');
        var mdiv = $('#multiadd');
        mdiv.dialog({
            autoOpen: true, 
            modal: true,
            hide: { effect: "puff", duration: 500 },
            show: { effect: "puff", duration: 600 },
            title: "Ajout multiple comme album",
            width: '95%',
            close: function(){
                mdiv.remove();
            }
        });

        mdiv.append('<h2>Ajouter plusieurs singles</h2>');
        mdiv.append('<div id="shadowdv"></div>');

        var kk = 0, audio_type = ['mp3', 'ogg', 'flac', 'mid', 'aac', 'm4a', 'wav'];
        //looping through file list
        for(var k=0; k<fichiers.nbfiles; k++){
            var extk = fichiers.files[k].split('.')[fichiers.files[k].split('.').length-1].toLowerCase();
            
            if(audio_type.indexOf(extk) != -1){
                kk = k+1;
                $.get('ajax/isInDB.php', {'fname': true_dir+'/'+fichiers.files[k], 'req': k}, function(res){
                    if(res.success){
                        $('#in_album_title'+res.k+' span#exInDB').append('[<span style="color: orange;">EXISTE DEJA</span>]');
                    }else{
                        //to be completed
                    }
                }, 'json');

                $("#shadowdv").append(['<form class="msingleform browser-default" action="#" method="post" enctype="multipart/form-data">',
                    '<table border="3" cellspacing="0" cellpadding="4" id="in_album_title'+k+'" data-file="'+true_dir+'/'+fichiers.files[k]+'" class="browser-default">',
                    '<tr>',
                    '<th align="right">'+kk+'. '+fichiers.files[k]+'</th>',
                    '<td>',
                    '<input type="text" name="Filename" size="40" value="'+true_dir+'/'+fichiers.files[k]+'">',
                    '</td>',
                    '</tr>',
                    '<tr>',
                    '<td align="right"><b>Artiste</b></td>',
                    '<td><input type="text" size="40" name="artiste" value=""></td>',
                    '</tr>',
                    '<tr>',
                    '<td align="right">',
                    '<b>Titre</b>',
                    '</td> ',
                    '<td>',
                    '<input type="text" size="40" name="titre"  value=""></td>',
                    '</tr>',
                    '<tr>',
                    '<td align="right"><b>Album</b></td>', 
                    '<td>',
                    '<input type="text" size="40" name="album"  value="Single">',
                    '</td>',
                    '</tr>',
                    '<tr>',
                    '<td align="right"><b>Annee</b></td>',
                    '<td>',
                    '<input type="text" size="4"  name="annee"   value="">',
                    '</td>',
                    '</tr>',
                    '<tr>',
                    '<td align="right">',
                    '<b>Label</b>',
                    '</td> ',
                    '<td>',
                    '<input type="text" size="40" name="label"  value=""></td>',
                    '</tr>',
                    '<tr>',
                    '<td align="right">',
                    '<b>Durée</b>',
                    '</td> ',
                    '<td>',
                    '<input type="text" size="40" name="duree"  value=""></td>',
                    '</tr>',
                    '<tr>',
                    '<td align="right"><b>Piste</b></td>',
                    '<td>',
                    '<input type="text" size="2" name="piste" value="1">',
                    'sur', 
                    '<input type="text" size="2" name="TracksTotal" value="1">',
                    '</td>',
                    '</tr>',
                    '<tr>',
                    '<th align="right">Genre</th>',
                    '<td>',
                    '<select name="Genre" class="browser-default">',
                        '<option value="">- Unknown -</option><option value="Cover">-Cover-</option><option value="Remix">-Remix-</option><option value="A Cappella">A Cappella</option><option value="Acid">Acid</option><option value="Acid Jazz">Acid Jazz</option><option value="Acid Punk">Acid Punk</option><option value="Acoustic">Acoustic</option><option value="Alt. Rock">Alt. Rock</option><option value="Alternative">Alternative</option><option value="Ambient">Ambient</option><option value="Anime">Anime</option><option value="Avantgarde">Avantgarde</option><option value="Ballad">Ballad</option><option value="Bass">Bass</option><option value="Beat">Beat</option><option value="Bebob">Bebob</option><option value="Big Band">Big Band</option><option value="Black Metal">Black Metal</option><option value="Bluegrass">Bluegrass</option><option value="Blues">Blues</option><option value="Booty Bass">Booty Bass</option><option value="BritPop">BritPop</option><option value="Cabaret">Cabaret</option><option value="Celtic">Celtic</option><option value="Chamber Music">Chamber Music</option><option value="Chanson">Chanson</option><option value="Chorus">Chorus</option><option value="Christian Gangsta Rap">Christian Gangsta Rap</option><option value="Christian Rap">Christian Rap</option><option value="Christian Rock">Christian Rock</option><option value="Classic Rock">Classic Rock</option><option value="Classical">Classical</option><option value="Club">Club</option><option value="Club-House">Club-House</option><option value="Comedy">Comedy</option><option value="Contemporary Christian">Contemporary Christian</option><option value="Country">Country</option><option value="Crossover">Crossover</option><option value="Cult">Cult</option><option value="Dance">Dance</option><option value="Dance Hall">Dance Hall</option><option value="Darkwave">Darkwave</option><option value="Death Metal">Death Metal</option><option value="Disco">Disco</option><option value="Dream">Dream</option><option value="Drum &amp; Bass">Drum &amp; Bass</option><option value="Drum Solo">Drum Solo</option><option value="Duet">Duet</option><option value="Easy Listening">Easy Listening</option><option value="Electronic">Electronic</option><option value="Ethnic">Ethnic</option><option value="Euro-House">Euro-House</option><option value="Euro-Techno">Euro-Techno</option><option value="Eurodance">Eurodance</option><option value="Fast-Fusion">Fast-Fusion</option><option value="Folk">Folk</option><option value="Folk/Rock">Folk/Rock</option><option value="Folklore">Folklore</option><option value="Freestyle">Freestyle</option><option value="Funk">Funk</option><option value="Fusion">Fusion</option><option value="Game">Game</option><option value="Gangsta Rap">Gangsta Rap</option><option value="Goa">Goa</option><option value="Gospel">Gospel</option><option value="Gothic">Gothic</option><option value="Gothic Rock">Gothic Rock</option><option value="Grunge">Grunge</option><option value="Hard Rock">Hard Rock</option><option value="Hardcore">Hardcore</option><option value="Heavy Metal">Heavy Metal</option><option value="Hip-Hop">Hip-Hop</option><option value="House">House</option><option value="Humour">Humour</option><option value="Indie">Indie</option><option value="Industrial">Industrial</option><option value="Instrumental">Instrumental</option><option value="Instrumental Pop">Instrumental Pop</option><option value="Instrumental Rock">Instrumental Rock</option><option value="JPop">JPop</option><option value="Jazz">Jazz</option><option value="Jazz+Funk">Jazz+Funk</option><option value="Jungle">Jungle</option><option value="Latin">Latin</option><option value="Lo-Fi">Lo-Fi</option><option value="Meditative">Meditative</option><option value="Merengue">Merengue</option><option value="Metal">Metal</option><option value="Musical">Musical</option><option value="National Folk">National Folk</option><option value="Native American">Native American</option><option value="Negerpunk">Negerpunk</option><option value="New Age">New Age</option><option value="New Wave">New Wave</option><option value="Noise">Noise</option><option value="Oldies">Oldies</option><option value="Opera">Opera</option><option value="Other">Other</option><option value="Polka">Polka</option><option value="Polsk Punk">Polsk Punk</option><option value="Pop">Pop</option><option value="Pop-Folk">Pop-Folk</option><option value="Pop/Funk">Pop/Funk</option><option value="Porn Groove">Porn Groove</option><option value="Power Ballad">Power Ballad</option><option value="Pranks">Pranks</option><option value="Primus">Primus</option><option value="Progressive Rock">Progressive Rock</option><option value="Psychedelic">Psychedelic</option><option value="Psychedelic Rock">Psychedelic Rock</option><option value="Punk">Punk</option><option value="Punk Rock">Punk Rock</option><option value="R&amp;B">R&amp;B</option><option value="Rap">Rap</option><option value="Rave">Rave</option><option value="Reggae">Reggae</option><option value="Retro">Retro</option><option value="Revival">Revival</option><option value="Rhythmic Soul">Rhythmic Soul</option><option value="Rock" selected="selected">Rock</option><option value="Rock &amp; Roll">Rock &amp; Roll</option><option value="Salsa">Salsa</option><option value="Samba">Samba</option><option value="Satire">Satire</option><option value="Showtunes">Showtunes</option><option value="Ska">Ska</option><option value="Slow Jam">Slow Jam</option><option value="Slow Rock">Slow Rock</option><option value="Sonata">Sonata</option><option value="Soul">Soul</option><option value="Sound Clip">Sound Clip</option><option value="Soundtrack">Soundtrack</option><option value="Southern Rock">Southern Rock</option><option value="Space">Space</option><option value="Speech">Speech</option><option value="Swing">Swing</option><option value="Symphonic Rock">Symphonic Rock</option><option value="Symphony">Symphony</option><option value="Synthpop">Synthpop</option><option value="Tango">Tango</option><option value="Techno">Techno</option><option value="Techno-Industrial">Techno-Industrial</option><option value="Terror">Terror</option><option value="Thrash Metal">Thrash Metal</option><option value="Top 40">Top 40</option><option value="Trailer">Trailer</option><option value="Trance">Trance</option><option value="Tribal">Tribal</option><option value="Trip-Hop">Trip-Hop</option><option value="Vocal">Vocal</option>',
                    '</select>',
                    '<input type="text" name="genre" size="30" value="" placeholder="Ou saisir le genre ici">',
                    '</td>',
                    '</tr>',
                    '<tr>',
                    '<td align="right">',
                    '<b>Ecrire les Tags</b>',
                    '</td>',
                    '<td>',
                    '<label for="chbx0'+k+'"><input id="chbx0'+k+'" type="checkbox" name="TagFormatsToWrite[]" value="id3v1" ><span></span>id3v1</lable><br>',
                    '<label for="chbx1'+k+'"><input id="chbx1'+k+'" type="checkbox" name="TagFormatsToWrite[]" value="id3v2.3" checked="checked"><span></span>id3v2.3</label>',
                    '<br>',
                    '<label for="chbx2'+k+'"><input id="chbx2'+k+'" type="checkbox" name="TagFormatsToWrite[]" value="ape"><span></span>ape</label>',
                    '<br>',
                    '<hr>',
                    '<label for="chbx3'+k+'"><input id="chbx3'+k+'" type="checkbox" checked name="remove_other_tags" value="1"><span></span>',
                    'Retirer les formats non-selectionn3s pendant l\'ecriture</label><br>',
                    '</td>',
                    '</tr>',
                    '<tr>',
                    '<td align="right"><b>Commentaire</b>',
                    '</td>',
                    '<td>',
                    '<textarea cols="30" rows="3" name="Comment" wrap="virtual">Morceau téléchargé sur www.KeDuSon.com / Downloaded from www.KeDuSon.com / Thank U !</textarea>',
                    '</td>',
                    '</tr>',
                    '<tr>',
                    '<td align="right">',
                    '<b>Pochette</b><br>(ID3v2 uniquement)',
                    '<br><button type="button" onclick="$(this).addDefCover(\'#cov'+k+'\');" class="waves-effect waves-light btn-flat teal lighten-1">Use default Cover</button> ',
                    '</td>',
                    '<td>',
                    '<input class="tvCover" type="file" name="userfile" accept="image/jpeg, image/gif, image/png" onchange="$(this).addCover(this);">',
                    '&nbsp; <input type="text" name="cover" size="30" id="cov'+k+'" placeholder="nom de la pochette">',
                    '<br>',
                    'Type: <select name="APICpictureType" class="browser-default">',
                        '<option value="0">Other</option><option value="1">32x32 pixels \'file icon\' (PNG only)</option><option value="2">Other file icon</option><option value="3" selected>Cover (front)</option><option value="4">Cover (back)</option><option value="5">Leaflet page</option><option value="6">Media (e.g. label side of CD)</option><option value="7">Lead artist/lead performer/soloist</option><option value="8">Artist/performer</option><option value="9">Conductor</option><option value="10">Band/Orchestra</option><option value="11">Composer</option><option value="12">Lyricist/text writer</option><option value="13">Recording Location</option><option value="14">During recording</option><option value="15">During performance</option><option value="16">Movie/video screen capture</option><option value="17">A bright coloured fish</option><option value="18">Illustration</option><option value="19">Band/artist logotype</option><option value="20">Publisher/Studio logotype</option>',
                    '</select>',
                    '</td>',
                    '</tr>',
                    '<tr>',
                    '<td align="center" colspan="2">',
                    '<div class="center-align">',
                    '<input type="hidden" name="WriteTags" value="1">',
                    '<button class="btn-flat blue lighten-1 white-text btnWrite" type="button">Ecrire les tags</button>',
                    '<input type="submit" value="Enregistrer en BDD" class="white-text btn-flat green lighten-1">',
                    '<input type="button" value="Retirer Form" class="white-text btnRmForm btn-flat red lighten-1" onclick="$(this).retirerForm();">',
                    '<button type="button" class="btn-flat white-text orange darken-2">Supprimer le fichier</button>',
                    '</div>',
                    '</td>',
                    '</tr>',
                    '</table>',
                '<center> </center> <br> <br> </form>'].join(''));
                //get id3 tags
                $.ajax({
                    url: '../../php/ajax/getid3tagz.php',
                    type: 'post',
                    dataType: 'json',
                    data: {'targetfile': true_dir+'/'+fichiers.files[k], 'file_type': 'file','div': 'in_album_title'+k},
                    success: function(id3){
                        if(id3.end == 'success'){
                            $('#'+id3.div+' input[name=artiste]').val(id3.artist);
                            $('#'+id3.div+' input[name=titre]').val(id3.title);
                            $('#'+id3.div+' input[name=album]').val(id3.album);
                            $('#'+id3.div+' input[name=genre]').val(id3.genre);
                            $('#'+id3.div+' input[name=annee]').val(id3.year);
                            $('#'+id3.div+' input[name=label]').val(id3.label);
                            $('#'+id3.div+' input[name=duree]').val(id3.duration);
                            $('#'+id3.div+' input[name=piste]').val(id3.track);
                        }
                    }
                });
            }
        }

        //submit tags...
        $('button.btnWrite').each(function(){
            $(this).click(function(){
                //e.preventDefault();
                $(this).closest('form').find('input[type=file]')[0].remove();
                var datas = $(this).closest('form').serialize();
                //write tags to audio file
                //console.log(datas);
                Konsole = $(this).closest('form').find('center')[0];
                Konsole.innerHTML =  'Writing Tags to audio file...';
                fi = $(this).closest('table').attr('data-file');
                retDparent = $(this).closest('table').attr('id');
                $.ajax({
                    url: '../../php/ajax/writeId3.php',
                    type: 'post',
                    dataType: 'json',
                    data: datas,
                    error: function(){
                        alert('Request failed:: write iD3 Tags');
                    },
                    success: function(resp){
                        if(resp.success){
                            Konsole.innerHTML=Konsole.innerHTML+'<br> Well done!';
                             //recomplete the duration input
                             $.ajax({
                                url: '../../php/ajax/getid3tagz.php',
                                type: 'post',
                                dataType: 'json',
                                data: {'targetfile': fi, 'file_type': 'file','div': retDparent},
                                success: function(id3){
                                    if(id3.end == 'success'){
                                        $('#'+id3.div+' input[name=duree]').val(id3.duration);
                                    }
                                }
                            });
                        }else{
                            for(i=0; i<resp.message.length; i++)
                                Konsole.innerHTML = Konsole.innerHTML+'<br>'+resp.message[i]+'<br>';
                        }
                    }
                });
            });
        });

        //submit form...
        $('.msingleform').each(function(){
            //f = $(this);
            $(this).submit(function(e){
                e.preventDefault();
                f= $(this).children()[0];
                //f = f.children()[0]; 
                //console.log(f);
                //f = $('#'+f.id);
                console.log(f.id);
                //return false;
                var datas = {'file': $('#'+f.id+' input[name=Filename]').val(), 'artist': $('#'+f.id+' input[name=artiste]').val(), 'title' : $('#'+f.id+' input[name=titre]').val(), 'album': $('#'+f.id+' input[name=album]').val(), 'genre': $('#'+f.id+' input[name=genre]').val(), 'track_no': $('#'+f.id+' input[name=piste]').val(), 'year': $('#'+f.id+' input[name=annee]').val(), 'duration': $('#'+f.id+' input[name=duree]').val(), 'cover': $('#'+f.id+' input[name=cover]').val(), 'label': $('#'+f.id+' input[name=label]').val() },
                Konsole = $(this).find('center')[0];
                //console.log('datas', datas);
                Konsole.innerHTML=Konsole.innerHTML+'<br> Enregistrement en BDD...';
                $.ajax({
                    url: 'ajax/complete_single_add.php',
                    type: 'post',
                    dataType: 'json',
                    data: datas,
                    error: function(){
                        alert('Saving in DB failed');
                    },
                    success: function(resp){
                        if(resp.end = 'success'){
                            Konsole.innerHTML=Konsole.innerHTML+'<br> Well done!';
                        }else{
                            Konsole.innerHTML = Konsole.innerHTML+'<br>'+resp.message+'<br>';
                        }
                    }
                });
            });
        });        

    });

    //renommer correctement
    $('#tridge_ren').click(function(){
        var data = $(this).attr('data-dir');
        $.ajax({
            url: 'ajax/mass-ren.php',
            type: 'post',
            dataType: 'json',
            data: {"base": data},
            error: function(){
                alert("Error renaming files");
            },
            success: function(d){
                if(d.success){
                    window.location.reload(true);
                }else{
                    alert("Error renaming: server side code");
                }
            }
        });
    });

    //add group of files as album
    $('#add_group_album').click(function(){
        var dirpath = document.getElementById('add_group_album').getAttribute('data-dir'),
            flist =  document.getElementById('add_group_album').getAttribute('data-filelist'),
            liste = JSON.parse(flist),
            pochette = '',
            pochNom = '',
            true_dir = '';
            
            true_dir = dirpath.split('/files/')[dirpath.split('/files/').length-1];
            //try to find the cover
        for(var i=0; i<liste.nbfiles; i++){
            var itm = liste.files[i], ext = '', img_type = ['jpg', 'jpeg', 'png', 'gif'];
            ext = itm.split('.')[itm.split('.').length-1].toLowerCase();
            if(img_type.indexOf(ext) != -1){
                pochNom = itm;
                pochette = '<center> <img src="'+liste.dir+'/'+itm+'" style="width: 60%;" id="oldpoch"></center>';
            }
        }
        $(this).parent().append('<div id="multiadd"></div>');
        var mdiv = $('#multiadd');
        mdiv.dialog({
            autoOpen: true, 
            modal: true,
            hide: { effect: "puff", duration: 500 },
            show: { effect: "puff", duration: 600 },
            title: "Ajout multiple comme album",
            width: '85%',
            close: function(){
                mdiv.remove();
            }
        });
        mdiv.append([
            '<h2>Ajouter plusieurs fichier en un album</h2>',
            'chemin: '+dirpath+'<br><br>',
            '<form id="faddplus" enctype="multipart/form-data">',
            '<div>',
            '<br> <div class="fastAddForm">',
            '<h3>Sur l\'album</h3>',
            pochette +' <br>',
            '<br> Upload une nvle cover: <input type="file" id="upcove" name="upcove" accept="image/*"> <br>',
            '<br> Cover actuelle: <input class="rightFastInput" type="text" readonly name="cover" id="cover" value="'+true_dir+'/'+pochNom+'"> <br> <br>',
            '<span class="libelef"> &nbsp;&nbsp; Artiste:</span> <br>',
            '<input class="rightFastInput" type="text" name="artist" placeholder="Artiste" id="artist"> <br>',
            '<span class="libelef"> &nbsp;&nbsp; Album:</span> <br>',
            '<input class="rightFastInput" type="text" name="album" placeholder="Album" id="album"> <br>',
            '<span class="libelef"> &nbsp;&nbsp; Année:</span> <br> ',
            '<input class="rightFastInput" type="text" name="annee" placeholder="Année" id="annee"> <br>',
            '<span class="libelef"> &nbsp;&nbsp; Genre:</span> <br> ',
            '<input class="rightFastInput" type="text" name="genre" placeholder="Genre" id="genre"> <br>',
            '<span class="libelef"> &nbsp;&nbsp; Label:</span> <br> ',
            '<input class="rightFastInput" type="text" name="label" placeholder="Label" id="label"> <br> <br>',
            '<hr> ',
            '<h3> Les titres</h3> ',
            '<div id="shadowdv"> </div>',
            '</div>',
            '</div>',
            '</form>'
        ].join(''));
        
        //redim the cover
        if(pochNom != ''){
            var pochPath = true_dir+'/'+pochNom;
            $.ajax({
                url: '../../php/ajax/upload-cover.php',
                data: {'pochPath': pochPath, 'base': '1'},
                dataType: 'json',
                type: 'post',
                error: function(){
                    alert('Redimension de la cover echouee. 404?');
                },
                success: function(r){
                    if(r.end == 'success'){
                        $('#cover').val(r.path);
                    }else{
                        alert(r.message);
                    }
                }
            });
        }
        
        //upload a custom cover
        $("#upcove").ready(function(){
        document.querySelector("#upcove").addEventListener('change', function(){
            var imgExts = ['jpg','jpeg','png','gif'], pochette = document.getElementById('upcove').files[0], photoExt = pochette.name.split('.')[pochette.name.split('.').length-1].toLowerCase();
            if(imgExts.indexOf(photoExt) != -1){
                var lire = new FileReader();
                lire.onload = function(){
                    $('#zzimd').remove();
                    $('#upcove').after('<div id="zzimd" align="center"> <br> <br> <img id="zzim" width="60%" src="'+lire.result+'" /> <div id="cover-prog-frame" style="width:60%; height:7px; border: 0; background-color: navy;" align="left"><div id="cover-up-progress"></div></div></div>');
                                    
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
                            if(cu.end == 'success'){ // cover uploaded
                                $("#cover").val(cu.path);
                                $("#oldpoch").parent().remove();
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
        
        var kk = 0, audio_type = ['mp3', 'ogg', 'flac', 'mid', 'aac', 'm4a', 'wav'];
        
        //looping through file list
        for(var k=0; k<liste.nbfiles; k++){
            var extk = liste.files[k].split('.')[liste.files[k].split('.').length-1].toLowerCase();
            
            if(audio_type.indexOf(extk) != -1){
                kk = k+1;
                $("#shadowdv").append(['<div id="in_album_title'+k+'">',
                '<h3> '+kk+'. '+liste.files[k]+' </h3>',
                '<span class="libelef"> &nbsp;&nbsp; Titre:</span> <br>',
                '<input class="rightFastInput" type="text" name="titre[]" placeholder="Titre" id="titre_'+k+'"> <br>',
                '<span class="libelef"> &nbsp;&nbsp; Durée:</span> <br>',
                '<input class="rightFastInput" type="text" name="duree[]" placeholder="Durée" id="duree_'+k+'"> <br>',
                '<span class="libelef"> &nbsp;&nbsp; N° de piste:</span> <br> ',
                '<input class="rightFastInput" type="text" name="piste[]" placeholder="Piste" id="piste_'+k+'">',
                '<input class="rightFastInput" type="hidden" name="fichier[]" id="fichier_'+k+'" value="'+true_dir+'/'+liste.files[k]+'"> <br>',
                '</div>'].join(''));
                //get id3 tags
                $.ajax({
                    url: '../../php/ajax/getid3tagz.php',
                    type: 'post',
                    dataType: 'json',
                    data: {'targetfile': true_dir+'/'+liste.files[k], 'file_type': 'file','div': 'in_album_title'+k},
                    success: function(id3){
                        if(id3.end == 'success'){
                            $('#'+id3.div+' input[placeholder=Titre]').val(id3.title);
                            $('#'+id3.div+' input[placeholder=Durée]').val(id3.duration);
                            $('#'+id3.div+' input[placeholder=Piste]').val(id3.track);
                            $('#artist').val(id3.artist);
                            $('#album').val(id3.album);
                            $('#annee').val(id3.year);
                            $('#genre').val(id3.genre);
                            $('#label').val(id3.label);
                        }
                    }
                });
            }
        }
        
        //add submit btn
        $("#faddplus").append('<br> <hr> <br> <center> <input type="submit" value="Soumettre" id="submit" class="button-normal"> </center>');
        
        //submit this form and Go!!
        $("#faddplus").on('submit', function(e){
            e.preventDefault();
            var f = $("#faddplus");
            var errs = 0;
            $(".indicativR8").remove();
            $('#faddplus input[type=text]').each(function(){
                $(this).css('border', '1px solid black');
                if($(this).val() == ''){ //artist or title empty
                    errs++; 
                    $(this).css('border', '1px solid red');
                    $(this).before("<span style='color:orange;' class='indicativR8'>Veillez remplir ce champ svp.</span><br>");
                    $(document).scrollTop($(this).offset().top-40);
                }
                $(this).on("keyup", function(){
                    if($(this).val()==''){
                        $(this).css('border', '1px solid red');
                    }else{
                        $(this).css('border', '1px solid black');
                    }
                });
            });
            //no major error
            if(errs == 0){
                //console.log('data', data);
                $('#faddplus input[type=submit]').after("<br> <b> Chargement en cours. Veillez patienter <span id='loaddots'></span> </b>");
                var dotload = setInterval(function(){
                    $('#loaddots').text($('#loaddots').text()+'.');
                    if($('#loaddots').text() == '....')
                        $('#loaddots').text('');
                }, 850);
                $('#upcove').remove(); //do no upload again
                $.ajax({
                    url: 'ajax/submit-album.php',
                    data: $("#faddplus").serialize(),
                    dataType: 'json',
                    type: 'post',
                    success: function(ret){
                        clearInterval(dotload);
                        //console.log(ret);
                        if(ret.ids){ //well done
                            $('#faddplus').html('<font color="green"> Album enregistre avec succes. N\'oubliez pas de le valider dans la liste de moderation de la page d\'accueil de la console</font>');
                        }else{
                            alert(ret.message);
                        }
                    },
                    error: function(){
                        clearInterval(dotload);
                        alert("Une erreur inattendue s'est produite. Merci de re-essayer.");
                    }
                });
            }
        });
        
    });
    
    
     $('#xplorer_newdir').click(function(){
        $('body').append('<div id="ddialog"></div>');
        $('#ddialog').dialog({
            autoOpen: true, 
            modal: true,
            hide: { effect: "puff", duration: 500 },
            show: { effect: "puff", duration: 600 },
            title: "Creer un Nouveau repertoire",
            width: '60%',
            close: function(){
                $('#ddialog').remove();
            }
        });
    
        $('#ddialog').append(['<form method="post" action="ajax/mkdir.php" id="rename_form">',
            '<div>',
            '<input type="hidden" value="'+$(this).attr('data-root')+'"name="path" > ',
            '<br>',
            '<br>',
            'Nouveau repertoire: ',
            '<input type="text" name="dirname" size="37"> <br> <br>',
            '<input type="submit" value="Creer"> <br> <br></form>'].join('')
        );
        
        $('#rename_form').submit(function(e){
            e.preventDefault();
            $('#rlog').remove();
            $('#rename_form').append('<font id="rlog" color="blue">Requete en cours...</font>');
            var data = $(this).serialize(), url = $(this).attr('action');
            $.ajax({
                url: url,
                data: data,
                type: 'post',
                dataType: 'json',
                error: function(){
                    $('#rlog').html('<font color="red">Error: Could not submit this request.</font>');
                },
                success: function(rep){
                    if(rep.success){
                        $('#rlog').html('<font color="green">Termine! repertoire cree avec succes.</font>');
                    }else{
                        $('#rlog').html('<font color="red">Error: '+rep.message+'</font>');
                    }
                }
            });
        });
    });
     
     
    $('#xplorer_rename').click(function(){
        $('body').append('<div id="ddialog"></div>');
        $('#ddialog').dialog({
            autoOpen: true, 
            modal: true,
            hide: { effect: "puff", duration: 500 },
            show: { effect: "puff", duration: 600 },
            title: "Renommer un fichier",
            width: '60%',
            close: function(){
                $('#ddialog').remove();
            }
        });
    
        $('#ddialog').append(['<form method="post" action="ajax/rename-file.php" id="rename_form">',
            '<div>',
            'Ancien: <input type="text" readonly value="'+$(this).attr('data-src')+'"name="old" size="37"> ',
            '<br>',
            '<br>',
            'Nouveau: ',
            '<input type="text" name="new" size="37"> <br> <br>',
            '<input type="submit" value="Renommer"> <br> <br></form>'].join('')
        );
        
        $('#rename_form').submit(function(e){
            e.preventDefault();
            $('#rlog').remove();
            $('#rename_form').append('<font id="rlog" color="blue">Requete en cours...</font>');
            var data = $(this).serialize(), url = $(this).attr('action');
            $.ajax({
                url: url,
                data: data,
                type: 'post',
                dataType: 'json',
                error: function(){
                    $('#rlog').html('<font color="red">Error: Could not submit this request.</font>');
                },
                success: function(rep){
                    if(rep.success){
                        $('#rlog').html('<font color="green">Termine! renomme avec succes.</font>');
                    }else{
                        $('#rlog').html('<font color="red">Error: '+rep.message+'</font>');
                    }
                }
            });
        });
    });
    
    $('#xplorer_directlink').click(function(){
        var intx = ['<div id="modal1" class="modal modal-fixed-footer">',
                '<div class="modal-content">',
                '<h4>Le lien direct vers ce fichier est</h4>',
                '<p green-text>Lien: '+$('#xplorer_directlink').attr('data-path')+'</p>',
                '</div>',
                '<div class="modal-footer">',
                '<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Fermer</a>',
                ' </div>',
                '</div>'
            ].join(' ');
        $('footer').append(intx);
        var toModalite=$('#modal1');
        toModalite.modal({
            onCloseEnd: function(){
                $(toModalite).remove();
            }
        });
        var minstance0 = M.Modal.getInstance(toModalite);
        minstance0.open();
            //'Lien: '+$('#xplorer_directlink').attr('data-path'));
    });
    
    $('div.file a').on('click', function(e){
        e.preventDefault();
        var elt = $(this);
        $('#about_file').html('<br> &nbsp; &nbsp; <img src="'+elt.children()[0].src+'"> <br> <b>Nom</b>: '+elt.attr('data-name')+' <br> <b>Taille</b>: '+elt.attr('data-size')+' <br> <b>Chemin</b>: '+elt.attr('data-path')+' <br> <b> Permissions</b>: '+elt.attr('data-perms')+'<br> <b>Proprietaire</b>: '+elt.attr('data-owner')+'<br> <b>Date creation</b>: '+elt.attr('data-dcrea')+'<br> <b>Derniere modification</b>: '+elt.attr('data-dmodif')+' <center> <button type="button" title="Ajouter comme single" id="xplorer_addsingle" data-file="'+elt.attr('data-path')+'"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAARXSURBVHhe7ZprTxRJFIb5tP/Cbyb7X/wnCuslrgn7wUs2xgs7LMpFYB16hDGKg4zxLhgMa2IUJXhh14Vx0U1g1BiUYbyvicc+zXmbnqam7SoGMz32mzwfurrOOfWe7ip6EupixYoVK4x27878kKi3mpobUnkbihj55nprP3sQO/riBIrE0cL2IHb0ZT/9p5wkPzVD9L4QKfL/zKAJebGjL3RRVSAKYP1iR19I8PndK2WBaobXXLEGfCrORaoJvNZPi7OVa8D/C48jSdyAuAERbcDbF4/oyd0Junl2lLLt56iz8TidODionBtEZBowP/M3TY7epKvpIUrvG6CWzcfcxXtRxQaBOLGjL9PCQaieLuqAlp9S1Lenh4Y6k3Qv+4c7rsoXBOLEjr5MC3sJ83SP7EjRYCJJN9JH6d/hblq820nvJpfBPFX+IBAndvRlWhhkfj/jLgL4n+7zG10lZlUgVlUjCMSJHX2ZFgaID3q6YTBdB+LEjr5MCwPEq0zpYLoOxIkdfZkWBohXmQqiaL8lr+8vX5uuA3FiR1+mhQHiveZU8DnA5wGfC3w+8Dlh7exx75uuA3FiR1+mhQHivWb5DOCzgM8EPhv4LwDm+am5BlxoSzpPF+OAvwX4m4C/DR5PTLjjNdcAXPP3AH8X8PcBfyeEjfPP+xqIEzv6Mi0MEK9rxDTOD+LEjr5MCwPExw2IGxBsZGF2iq5nRujYrxk6vK0vdNzXQJzY0ZdpYYD4ICPTY+PU/nPavQdSu6zab8DThw/o0JalX4eZgz2Uu9JNC3e6nC/BN7X4JejPN9h2zrm+3JF056jwx4UFcWJHX7qFdfcyXv2Xt4N/EvvjwoI4saMvncIme3m5AStNg/mxLmcOz/XWCwPqiR19IYEquRfTvYwtcIm3wINS4w722IXWpDMn23G+pGYYUE/s6AsJVMm9mO7lksYdWG4cM3252xnje4e29tKzqcmSmmFAPbGjLyRQJfeymr2cs7dOx46VWwfwvdzt8ZKYsCCH2NEXEqiSe1ntXsbh2bt36fBstendO0DXB0aoYN/zzw8L1i929IUEquRe1novm4L1ix19IYEquZe13sumYP1iR19IoEruZy33simoLXb0hQSq5CrWai+b8s0bUG3EDYgbEDegsg3gf1I40VT6jwrVPFbxBvivq30M12JHX0jw8eUjKv53y024MHXNpRrHik/G6MP8tHstdvSFBIXcn06B4/tOOniLVutYITdauQZ4i0SJuAFhG9C8ydqQaLDmEBA1Ohv76K+hi6toQH1q1pswinT9kl5FA2SiP0FUKLd+jIvN8iqXICqUWz/GxWZ5JRpSr3ni3PjwiiRRoH17r2PUu/65O8POWKLeWhSb5WUfgFme3P9bvxPoTR4FsodPOWaxfuZUU/9SAxqs02KzvFq2JH9s2bz0FtQStqdi86aj68VmsBIbrXV2UIZfGX+iCFLgJx/afKxYsb4j1dV9AY4ecfSUB3o2AAAAAElFTkSuQmCC"></button> <br> <a href="?go=xplorer.php&dir='+elt.attr('data-path')+'">Aller au fichier</a> </center><br>');
        $(document).scrollTop($('#about_file').parent().offset().top);
        $('#xplorer_addsingle').attr('data-file', elt.attr('data-path'));
        
        //try to add it in the db
        $('#xplorer_addsingle').on('click', function(){
        var Fp = document.getElementById('xplorer_addsingle').getAttribute('data-file'), Fn;
        Fn = Fp.split('/files/')[(Fp.split('/files/').length)-1];
        $(this).parent().append('<div id="addsing"></div>');
        var dDiv = $('#addsing');
        dDiv.dialog({
            autoOpen: true, 
            modal: true,
            hide: { effect: "puff", duration: 500 },
            show: { effect: "puff", duration: 600 },
            title: "Ajouter un single a la liste",
            width: '70%',
            close: function(){
                dDiv.remove();
            }
        });
        
        dDiv.append(['<h1>Ajouter un single</h1>',
            '<br> <span id="id3text"> Lecture des tags ID3 ...</span>',
            '<br>'
            ].join('')
        );
        
        dDiv.append([
            '<form method="post" action="" id="addForm" enctype="multipart/form-data">',
            '<div>',
            '<span class=\'libelef\'> Artiste:</span> <br>',
            '<input class=\'rightFastInput\' type=\'text\' name=\'artist\' id=\'artist\' placeholder=\'Artiste\'> <br>',
            '<span class=\'libelef\'> Titre:</span> <br>',
            '<input class=\'rightFastInput\' type=\'text\' name=\'title\' id=\'title\' placeholder=\'Titre\'> <br> ',
            '<span class=\'libelef\'> Album:</span> <br>',
            '<input class=\'rightFastInput\' type=\'text\' name=\'album\' id=\'album\' placeholder=\'Album\'> <br> ',
            '<span class=\'libelef\'> Genre:</span> <br> ',
            '<input class=\'rightFastInput\' type=\'text\' name=\'genre\' id=\'genre\' placeholder=\'Genre\'> <br> ',
            '<span class=\'libelef\'> Annee: </span> <br>',
            '<input class=\'rightFastInput\' type=\'text\' name=\'year\' id=\'year\' placeholder=\'Annee\'> <br> ',
            '<span class=\'libelef\'>N° de piste: </span> <br>',
            '<input class=\'rightFastInput\' type=\'text\' name=\'track_no\' id=\'track_no\' placeholder=\'Numero piste\'> <br>',
            '<span class=\'libelef\'>Duree: </span> <br>',
            '<input class=\'rightFastInput\' type=\'text\' name=\'duration\' id=\'duration\' placeholder=\'Duree\'> <br>',
            '<span class=\'libelef\'>Label: </span> <br>',
            '<input class=\'rightFastInput\' type=\'text\' name=\'label\' id=\'label\' placeholder=\'Label\'> <br>',
            'Suggestions de pochette: <br> ',
            '<div id=\'defcovers\'><br></div> Ou <br> <br> ',
            'upload une cover : <input type=\'file\' class=\'nophantom\' id=\'upcoverfield\' name=\'upcoverfield\' accept=\'image/*\'> <br>  <br>',
            'nom de cover actuelle: <input readonly type=\'text\' mame=\'cover\' id=\'cover\' value=\'\'> <br> <br> <br>',
            '<input type=\'submit\' class=\'button-normal\' id=\'OKfinish\' value=\'Soumettre\'>',
            '</div>',
            '</form>'
        ].join(''));
        $.ajax({
            url: '../../php/ajax/getid3tagz.php',
            type: 'post',
            dataType: 'json',
            data: {'targetfile': Fn, 'file_type': 'file'},
            error: function(){
                $('#id3text').html('<font color="red">Erreur: aucun tag id3 obtenu. 404</font>');
            },
            success: function(o){
                if(o.end = 'success'){
                   //complete the form here! 
                    $("#id3text").text("Lecture des tags terminée. Completion...");
                    $("#artist").val(o.artist);
                    $("#title").val(o.title);
                    $("#album").val(o.album);
                    $("#year").val(o.year);
                    $("#track_no").val(o.track);
                    $("#duration").val(o.duration);
                    $("#label").val(o.label);
                    $("#genre").val(o.genre);
                    
                    //fetch recommanded cover pics
                    $.ajax({ 
                    url: '../../php/ajax/recommanded-artwork.php',
                    type: 'post',
                    data: {"artist": o.artist, "album": o.album},
                    dataType: 'json',
                    success: function(art){
                        if(art.pochette1) //at least one cover
                            $("#defcovers").append('<img src="../../covers/'+art.pochette1+'" class="sugg-pochette" data-art="'+art.pochette1+'" title="Cliquez pour choisir" id="dpochet1" onclick="choose_pochet(this,\'.sugg-pochette\',\'cover\');" >');
                        else //no cover
                            $("#defcovers").append('<span class="message echec">Aucune suggestion disponible</span>');
                        if(art.pochette2)
                            $("#defcovers").append('<img src="../../overs/'+art.pochette2+'" class="sugg-pochette" data-art="'+art.pochette2+'" title="Cliquez pour choisir" id="dpochet2" onclick="choose_pochet(this,\'.sugg-pochette\',\'cover\');">');
                        if(art.pochette3)
                            $("#defcovers").append('<img src="../../covers/'+art.pochette3+'" class="sugg-pochette" data-art="'+art.pochette3+'" title="Cliquez pour choisir" id="dpochet3" onclick="choose_pochet(this,\'.sugg-pochette\',\'cover\');">');
                        if(art.pochette4)
                            $("#defcovers").append('<img src="../covers/../'+art.pochette4+'" class="sugg-pochette" alt="'+art.pochette4+'" title="Cliquez pour choisir" id="dpochet4" onclick="choose_pochet(this,\'.sugg-pochette\',\'cover\');">');

                    },
                    error: function(){
                        $("#defcovers").append('<span class="message echec">Aucune suggestion disponible</span>');
                    }
                    });
                }else{
                    $('#id3text').html('<font color="red">Erreur: Le fichier ne contient pas de tag id3.</font>');
                }
            }
        });
        
        //upload a custom cover
        $("#upcoverfield").ready(function(){
        document.querySelector("#upcoverfield").addEventListener('change', function(){
            var imgExts = ['jpg','jpeg','png','gif'], pochette = document.getElementById('upcoverfield').files[0], photoExt = pochette.name.split('.')[pochette.name.split('.').length-1].toLowerCase();
            if(imgExts.indexOf(photoExt) != -1){
                var lire = new FileReader();
                lire.onload = function(){
                    $('#zzimd').remove();
                    $('#upcoverfield').after('<div id="zzimd" align="center"> <br> <br> <img id="zzim" width="50%" src="'+lire.result+'" /> <div id="cover-prog-frame" style="width:50%; height:7px; border: 0; background-color: navy;" align="left"><div id="cover-up-progress"></div></div></div>');
                                    
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
        
        //submit the form! 
        $("#addForm").ready(function(){
            $('#addForm').submit(function(b){
                b.preventDefault();
                var eer = 0;
                $(".indicativR8").remove();
                $("#title,#artist").each(function(){
                    $(this).css('border', '0');
                    if($(this).val() == ''){ //artist or title empty
                        eer++; 
                        $(this).css('border', '1px solid red');
                        $(this).before("<span style='color:red;' class='indicativR8'>Veillez remplir ce champ svp.</span>");
                        $(document).scrollTop($(this).offset().top-140);
                    }
                    $(this).on("keyup", function(){
                        if($(this).val()==''){
                            $(this).css('border', '1px solid red');
                        }else{
                            $(this).css('border', '0');
                        }
                    });
                });
                if($('#cover').val() == ''){ //no cover value
                    if(confirm("Vous n'avez pas indiqué de pochette.\n En continuant, une pochette par défaut sera ajoutée automatiquement.")){
                        $("#cover").val("default.jpg");
                    }else{
                        eer++;
                    }
                }
                                
                if(eer == 0){ //no major error
                    $("#OKfinish").after("<br> <b> Chargement en cours...</b>");
                    //console.log(ddt);
                    $.ajax({
                        url: 'ajax/complete_single_add.php',
                        type: 'POST',
                        data: {
                            "artist": $("#artist").val(),
                            "title": $("#title").val(),
                            "album": $("#album").val(),
                            "genre": $("#genre").val(),
                            "year": $("year").val(),
                            "track_no": $("#track_no").val(),
                            "duration": $("#duration").val(),
                            "label": $("#label").val(),
                            "file": Fn,
                            "cover": $("#cover").val()
                        },
                        dataType: 'json',
                        success: function(ret){
                            if(ret.id){ //well done
                                $("#addForm").fadeOut(2000);
                                dDiv.append("<div class='message succes' id='tg548' style='color:green;'>Informations soumises avec succès. Vous devez maintenant valider cet morceau dans la liste de moderation de la page d'accueil de la console.</div>");
                                $(document).scrollTop($("#tg548").offset().top-80);
                                $("#tg548").fadeIn('slow');
                            }else{
                                alert(ret.message);
                            }
                        },
                        error: function(){
                            alert('Erreur, Veillez essayer a Nouveau. 404?');
                        }
                    });
                }
            });
        });
        
        
    });
    //end add single!
        
    });
    
    $('#xplorer_upload').click(function(){
//     defaultOptions: {
//     content: '',
//     unsafeContent: '',
//     showCloseButton: true,
//     escapeButtonCloses: true,
//     overlayClosesOnClick: true,
//     appendLocation: 'body',
//     className: '',
//     overlayClassName: '',
//     contentClassName: '',
//     closeClassName: '',
//     closeAllOnPopState: true
//     }
        vex.defaultOptions.showCloseButton = true;
        vex.dialog.buttons.YES.text = 'Fermer';
        vex.dialog.buttons.NO.text = 'Annuler';
        vex.dialog.alert({
            message: 'Merci d\'utiliser le FTP pour envoyer des fichiers.'
//             input: ['<center>',
//                 '<form id="addtrackform">',
//                 '<input type="file" id="upfield" style="width:0;height:0;visibility:hidden;">',
//                 '<button id="simulupload" type="button">Choisir un fichier</button>', 
//                 '<br> <div id="filecharger"> </div>',
//                 '</form>',
//                 '</center>'
//             ].join('')
//             callback: function(data){
//                 e.preventDefault();
//                 if (!data) {
//                     return console.log('Cancelled')
//                 }
// //                 console.log('Date', data.date, 'Color', data.color)
//                 $('.demo-result-custom-vex-dialog').show().html([
//                     '<h4>Result</h4>',
//                     '<p>',
//                         
//                     '</p>'
//                 ].join(''))
//             }
        });
    });
    
});

function choose_pochet(eee,ccc,log){ //make a chosen effect on e.click
    var c=document.querySelectorAll(ccc);
    for(var g=0; g<c.length; g++)
        c[g].style.border = '1px solid gray';
    eee.style.border = '2px solid lime';
    var r = eee.getAttribute('data-art');
    r=r.replace('65X65','500X500');
    //console.log(r);
    document.getElementById(log).value = r;
}
