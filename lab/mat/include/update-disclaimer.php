<div class="container">
    <h2>Mettre a jour la disclaimer</h2>
<i>Cliquer sur le texte pour l'editer. A la fin de l'edition.</i>
<br> <br> <br>
<?php 
$do = $connect_bdd -> prepare('SELECT * FROM disclaimer LIMIT 1');
$do -> execute();
$tx = $do -> fetch();
$do -> closeCursor();
?>
<section data-id="<?=$tx['id'];?>" class="editclaimer grey lighten-1 white-text flow-text" style="border:1px dashed green; padding: 1em;"><?=$tx['texte'];?></section> <button class="btn-flat blue white-text" type="button">Editer</button>
<br>
cree par <?=$tx['auteur'];?> le <?=date('d.m.Y, H:i', $tx['date_creation']);?> // derniere edition: <?=date('d.m.Y, H:i', $tx['date_maj']);?>
<br>
</div>
<script>
    $('.editclaimer').on('click', function(){
        $(this).attr('contenteditable', true);
    });
    $('.editclaimer').on('blur', function(){
        $('body').append('<div class="floating-info">Requete en cours...</div>');
        $(this).removeAttr('contenteditable');
            $.ajax({
                url: 'ajax/edit-disclaimer.php',
                type: 'post',
                dataType: 'json',
                data: {'id': $(this).attr('data-id'), 'value': $(this).text()},
                error: function(){
                    $('.floating-info').html('<font color="orange">Requete non soumise, 404</font>');
                    $('.floating-info').fadeOut(10000);
                },
                success: function(r){
                    if(r.success){
                        $('.floating-info').html('<font color="green">Contenu edite avec succes!</font>');
                        $('.floating-info').fadeOut(10000);
                        //$('.floating-info').remove();
                    }else{
                        $('.floating-info').html('<font color="red">'+r.message+'</font>');
                        $('.floating-info').fadeOut(10000);
                        //$('.floating-info').remove();
                    }
                }
            });
    });
</script>
