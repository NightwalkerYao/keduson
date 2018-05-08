$(document).ready(function(){
	//btn like
    $('#ttleaddlike').on('click', function(){
        var elt = $('#ttleaddlike').attr('data-title');
        $.ajax({
            url: ROOT_SANS+'/ajax/like-title',
            type: 'POST',
            data: {'elt': elt, 'action': 'like'},
            dataType: 'json',
            error: function(){
                alert("Une erreur inattendue s'est produite. Merci de réessayer.");
            },
            success: function(r){
                if(r.end == 'succes'){
                    $('#nbtlikes').text(r.likes);
                }else
                    alert(r.message);
            }
        });
        return false;
    });
    
    //btn dislike
    $('#ttleadddislike').on('click', function(){
        var elt = $('#ttleadddislike').attr('data-title');
        $.ajax({
            url: ROOT_SANS+'/ajax/like-title',
            type: 'POST',
            data: {'elt': elt, 'action': 'dislike'},
            dataType: 'json',
            error: function(){
                alert("Une erreur inattendue s'est produite. Merci de réessayer.");
            },
            success: function(r){
                if(r.end == 'succes'){
                    $('#nbtdislikes').text(r.likes);
                }else
                    console.log(r.message);
            }
        });
        return false;
    });
	//like.this
    $('#albumaddlike').on('click', function(){
        var elt = $('#albumaddlike').attr('data-albumCN');
        $.ajax({
            url: ROOT_SANS+'/ajax/like-title',
            type: 'POST',
            data: {'album': elt, 'do': 'like'},
            dataType: 'json',
            error: function(){
                alert("Une erreur inattendue s'est produite. Merci de réessayer.");
            },
            success: function(r){
                if(r.end == 'succes'){
                    $('#nbtlikes').text(r.likes);
                }else
                    alert(r.message);
            }
        });
        return false;
    });
    
    //btn dislike
    $('#albumadddislike').on('click', function(){
        var elt = $('#albumadddislike').attr('data-albumCN');
        $.ajax({
            url: ROOT_SANS+'/ajax/like-title',
            type: 'POST',
            data: {'album': elt, 'do': 'dislike'},
            dataType: 'json',
            error: function(){
                alert("Une erreur inattendue s'est produite. Merci de réessayer.");
            },
            success: function(r){
                if(r.end == 'succes'){
                    $('#nbtulikes').text(r.likes);
                }else
                    alert(r.message);
            }
        });
        return false;
    });

    //album.comment form
    $('#comments').on('submit', function(e){
        e.preventDefault();        
        var dats = {'group': $(this).attr('data-group'), 'row': $(this).attr('data-row'), 'texte': $('#cmtexte').val()}
        $.ajax({
            url: ROOT_SANS+'/ajax/commenter',
            data: dats,
            dataType: 'json',
            type: 'post',
            error: function(er){
                alert('Erreur '+er.status+': '+er.statusText);
            },
            success: function(r){
                if(r.end == 'succes'){
                    $("#comments").parent().append(['<div id="alt" style="padding: 2px 5px; height: auto; background: #2e2e2e; box-sizing: border-box;">',
                        '<a href="#">'+r.uname+'</a>',
                        r.texte,
                        '<br>',
                        '<small><i>#N - '+r.date_post+' </i></small>',
                       	'</div>',
                       	'<div style="height: 3px; width: 100%;"></div>'].join(' '));
                    $('#comments')[0].reset();
                }else{
                    alert(r.message);
                }
            }
        });
    });
})