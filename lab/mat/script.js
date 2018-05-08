$(document).ready(function(){
    //CHAPTER 1 -- WAITTING AUD LIST 
    // =============================================
    var trmp3 = document.querySelectorAll('#actives_mp3s tr, #available_mp3s tr'), i;
    for(i=1; i<trmp3.length; i++){
        if(i%2 == 0)
            trmp3[i].className += "sombre";
        else
            trmp3[i].className += "clair";
    }

    //direct edit details on moderating audio files
    $('#actives_mp3s tr td.editable, #available_mp3s tr td.editable').each(function(){
        $(this).attr('title', 'Cliquer pour editer');
        $(this).on('click', function(){
            $(this).attr('contenteditable', true);
        });
        $(this).on('blur', function(){
            $(this).removeAttr('contenteditable');
            var data = {'id': $(this).closest('tr').attr('data-id'), 'colonne': $(this).attr('data-colonne'), 'value': $(this).text()}, td = $(this);
            $(this).css('border', '2px dashed steelblue');
            $.ajax({
                url: 'ajax/mp3-update.php',
                dataType: 'json',
                data: data,
                type: 'post',
                error: function(){
                    //alert('Update failed: '+data.colonne+' > '+data.value);
                    td.css('border', '2px dashed red');
                },
                success: function(r){
                    if(r.success){
                        td.css('border', '2px dashed lime');
                    }else{
                        td.css('border', '2px dashed red');
                    }
                }
            });
        });
    });
    
    //play the audio file direct
    $('.directPlay').each(function(){
        $(this).attr('title', $(this).attr('data-file'));
        $(this).click(function(){
            var prevDiv = $(this).closest('div'), fn = $(this).attr('data-file'), dir=$(this).attr('data-dir');
            $('#directPlayer').remove();
            prevDiv.prepend('<audio id="directPlayer" src="../'+dir+'/'+fn+'" controls preload="all" autoplay>Could not play this file</audio>');
            $(document).scrollTop($('#directPlayer').offset().top);
        });
    });
    
    //delete the mp3
    $('#actives_mp3s tr td a[title=effacer], #available_mp3s tr td a[title=effacer]').each(function(){
        $(this).on('click', function(e){
            e.preventDefault();
            if(confirm('Confirmer la suppression?')){
                var data = {'id': $(this).closest('tr').attr('data-id'), 'action': 'delete', 'file': $(this).attr('data-file'), 'cn': $(this).attr('data-cn')}, tr = $(this).closest('tr');
                $.ajax({
                    url: 'ajax/manage-mp3.php',
                    data: data,
                    dataType: 'json',
                    type: 'post',
                    error: function(){
                        alert('Erreur: effacer > audio numero '+data.id);
                    },
                    success: function(r){
                        if(r.success){
                            $('#actives_mp3s tr[data-id='+r.id+']').fadeOut(1000);
                            $('#available_mp3s tr[data-id='+r.id+']').fadeOut(1000);
                        }else{
                            alert('Erreur: effacer > audio numero '+data.id+' > '+r.message);
                        }
                    }
                });
            }
        });
    });
    
    //validate the mp3 
    $('#actives_mp3s tr td a[title=valider]').each(function(){
        $(this).on('click', function(e){
            e.preventDefault();
            var data = {'id': $(this).closest('tr').attr('data-id'), 'action': 'validate', 'file': $(this).attr('data-file')}; //tr = $(this).closest('tr');
            $.ajax({
                url: 'ajax/manage-mp3.php',
                data: data,
                dataType: 'json',
                type: 'post',
                error: function(){
                    alert('Erreur: valider > audio numero '+data.id);
                },
                success: function(r){
                    if(r.success){
                        $('#actives_mp3s tr[data-id='+r.id+']').fadeOut(1000);
                    }else{
                        alert('Erreur: valider > audio numero '+data.id+' > '+r.message);
                    }
                }
            });
        });
    });
    
    //chbox checkall watting_list
    $('#active_checkAll, #available_checkAll').each(function(){
        $(this).on('click', function(){
            var tableid = $(this).closest('table').attr('id');
            if($(this).is(':checked')){
                $('#'+tableid+' tbody input[type=checkbox]').each(function(){
                    $(this).attr('checked', true);
                });
            }else{
                $('#'+tableid+' tbody input[type=checkbox]').each(function(){
                    $(this).attr('checked', false);
                });
            }
        });
    });
    
    //btn validate all
    $('#validate_all_mp3s').click(function(){
        var form = $('#watting_list'), data = form.serialize();
        //console.log(data);
        $.ajax({
            url: 'ajax/multiple_validate.php',
            type: 'post',
            data: data,
            dataType: 'json',
            error: function(){
                alert('Erreur: validation multiple');
            },
            success: function(r){
                if(r.success){
                    for(var i=0; i<r.ids.length; i++){
                        $('#actives_mp3s tr[data-id='+r.ids[i]+']').fadeOut('slow');
                    }
                }else{
                    alert('Erreur: '+r.message);
                }
            }
        });
    });
    
    //btn delete all watting_list
    $('#delete_all_mp3s, #delete_all_available').each(function(){
        $(this).click(function(){
            var form = $(this).closest('form'), data = $(form).serialize(), tid = $(this).attr('data-table');
            //console.log(data);
            $.ajax({
                url: 'ajax/multiple_delete.php',
                type: 'post',
                data: data,
                dataType: 'json',
                error: function(){
                    alert('Erreur: suppression multiple');
                },
                success: function(r){
                    if(r.success){
                        for(var i=0; i<r.ids.length; i++){
                            $('#'+tid+' tr[data-id='+r.ids[i]+']').fadeOut('slow');
                        }
                    }else{
                        alert('Erreur: '+r.message);
                    }
                }
            });
        });
    });
    
    //CHAPTER 2 -- WAITTING ALB LIST
    //=====================================
    var trmp32 = document.querySelectorAll('#actives_discs tr'), J;
    for(J=1; J<trmp32.length; J++){
        if(J%2 == 0)
            trmp32[J].className += "sombre";
        else
            trmp32[J].className += "clair";
    }
    
    //direct edit details on moderating audio files
    $('#actives_discs tr td.editable').each(function(){
        $(this).attr('title', 'Cliquer pour editer');
        $(this).on('click', function(){
            $(this).attr('contenteditable', true);
        });
        $(this).on('blur', function(){
            $(this).removeAttr('contenteditable');
            var data = {'id': $(this).closest('tr').attr('data-id'), 'colonne': $(this).attr('data-colonne'), 'value': $(this).text()}, td = $(this);
            $(this).css('border', '2px dashed steelblue');
            $.ajax({
                url: 'ajax/album-update.php',
                dataType: 'json',
                data: data,
                type: 'post',
                error: function(){
                    //alert('Update failed: '+data.colonne+' > '+data.value);
                    td.css('border', '2px dashed red');
                },
                success: function(r){
                    if(r.success){
                        td.css('border', '2px dashed lime');
                    }else{
                        td.css('border', '2px dashed red');
                    }
                }
            });
        });
    });
    
    //delete the disc
    $('#actives_discs tr td a[title=effacer]').each(function(){
        $(this).on('click', function(e){
            e.preventDefault();
            if(confirm('Confirmer la suppression?')){
                var data = {'id': $(this).closest('tr').attr('data-id'), 'action': 'delete', 'cn': $(this).attr('data-cn')}, tr = $(this).closest('tr');
                $.ajax({
                    url: 'ajax/manage-album.php',
                    data: data,
                    dataType: 'json',
                    type: 'post',
                    error: function(){
                        alert('Erreur: effacer > album numero '+data.id);
                    },
                    success: function(r){
                        if(r.success){
                            $('#actives_discs tr[data-id='+r.id+']').fadeOut(1000);
                        }else{
                            alert('Erreur: effacer > album numero '+data.id+' > '+r.message);
                        }
                    }
                });
            }
        });
    });
    
    //validate the disc
    $('#actives_discs tr td a[title=valider]').each(function(){
        $(this).on('click', function(e){
            e.preventDefault();
            var data = {'id': $(this).closest('tr').attr('data-id'), 'action': 'validate'}; //tr = $(this).closest('tr');
            $.ajax({
                url: 'ajax/manage-album.php',
                data: data,
                dataType: 'json',
                type: 'post',
                error: function(){
                    alert('Erreur: valider > album numero '+data.id);
                },
                success: function(r){
                    if(r.success){
                        $('#actives_discs tr[data-id='+r.id+']').fadeOut(1000);
                    }else{
                        alert('Erreur: valider > album numero '+data.id+' > '+r.message);
                    }
                }
            });
        });
    });
    
    //chbox checkall watting_alb_list
    $('#disc_checkAll').on('click', function(){
        if($(this).is(':checked')){
            $('#actives_discs tbody input[type=checkbox]').each(function(){
                $(this).attr('checked', true);
            });
        }else{
            $('#actives_discs tbody input[type=checkbox]').each(function(){
                $(this).attr('checked', false);
            });
        }
    });
    
    //btn validate all discs 
    $('#validate_all_discs').click(function(){
        var form = $('#watting_albums'), data = form.serialize();
        //console.log(data);
        $.ajax({
            url: 'ajax/multiple_alb_validate.php',
            type: 'post',
            data: data,
            dataType: 'json',
            error: function(){
                alert('Erreur: validation multiple album');
            },
            success: function(r){
                if(r.success){
                    for(var i=0; i<r.ids.length; i++){
                        $('#actives_discs tr[data-id='+r.ids[i]+']').fadeOut('slow');
                    }
                }else{
                    alert('Erreur: validation multiple albums > '+r.message);
                }
            }
        });
    });
    
    //btn delete all watting_alb_list
    $('#delete_all_discs').click(function(){
        var form = $('#watting_albums'), data = form.serialize();
        //console.log(data);
        $.ajax({
            url: 'ajax/multiple_alb_delete.php',
            type: 'post',
            data: data,
            dataType: 'json',
            error: function(){
                alert('Erreur: suppression multiple album');
            },
            success: function(r){
                if(r.success){
                    for(var i=0; i<r.ids.length; i++){
                        $('#actives_discs tr[data-id='+r.ids[i]+']').fadeOut('slow');
                    }
                }else{
                    alert('Erreur: suppression multiple album > '+r.message);
                }
            }
        });
    });
    
    //CHAPTER 3 -- DIRECT FROM THE NAV BAR
    //=====================================
    
    //confirm before reset counter
    $('#counter_reseter').click(
        function(e){
            e.preventDefault();
            if(confirm('Confirmer la reinitialisation du compteur de visites ?')){
                window.location = $(this).attr('href');
            }else
                return false;
        }
    );
});
