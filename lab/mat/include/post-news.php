<?php
if(isset($_POST['poster'])){
    extract($_POST);
    $ins = $connect_bdd -> prepare('INSERT INTO nouvelles(sujet, texte, auteur, date_post) VALUES(?, ?, ?, ?)');
    $ins -> execute(array($titre, $texte, $_SESSION['admin'], time()));
    $id = $connect_bdd -> lastInsertId();
    $ins -> closeCursor();
}

?>
<div class="row">
<h2>Poster une nouvelle</h2>
<form method="post" id="postnews" action="#postnews">
    <?=(isset($id) ? '<font color="lime">La nouvelle a bien ete postee !</font><br><br>' : false);?>
    <div class="col align-center">
        <i class="material-icons prefix">edit</i>
        <input type="text" name="titre" placeholder="Titre de la nouvelle" size="55" required>
    </div>
    <div class="col align-center">
        <i class="material-icons prefix">edit</i>
        <textarea name="texte" rows="8" cols="68" placeholder="texte de la nouvelle" required></textarea>
        
    </div>
    <div class="col align-center"><button class="btn-flat teal lighten-1 white-text" type="submit" name="poster" id="postitnews"><i class="material-icons right">send</i>
    </div>
</form>
</div>
<br>
<h2> Les nouvelles</h2>
<?php 
    $liste = $connect_bdd -> prepare('SELECT * FROM nouvelles ORDER BY id DESC');
    $liste -> execute();
    $lis = $liste -> fetchAll(PDO::FETCH_OBJ);
    $liste -> closeCursor();
    foreach($lis as $li){
    ?>
        <div class="divider"></div>
        <div class="container left-align">
        <h3><?=$li->id;?>. <span data-id="<?=$li->id;?>" data-colonne="sujet" class="reeditable"><?=$li->sujet;?></span></h3>
        <p data-id="<?=$li->id;?>" data-colonne="texte" class="reeditable"><?=$li->texte;?></p>
        par <?=$li->auteur;?> le <?=date('d/m/Y H:i', $li->date_post);?> [<a href="#" title="delete" data-id="<?=$li->id;?>">supprimer</a>]
        <br>
    </div>
    <?php
    }
?>
<script>
    $('a[title=delete]').each(function(){
        $(this).on('click', function(e){
            e.preventDefault();
            if(confirm('Confirmer la suppression de cette nouvelle ?')){
                //$('body').append('<div class="floating-info">Requete en cours...</div>');
                $.ajax({
                    url: 'ajax/delete-news.php',
                    type: 'get',
                    dataType: 'json',
                    data: {'id': $(this).attr('data-id')},
                    error: function(e){
                        // $('.floating-info').html('<font color="orange">Requete non soumise, 404</font>');
                        // $('.floating-info').fadeOut(10000);
                        M.toast({html: 'Erreur '+e.status+'<i class="material-icons left red">clear</i>'});
                    },
                    success: function(o){
                        if(o.success){
                            M.toast({html: 'Contenu efface avec succes!<i class="material-icons left green">done</i>'});
                            //$('.floating-info').fadeOut(10000);
                            window.location.reload(true);
                        }else{
                            M.toast({html: 'Erreur :: '+o.message+'<i class="material-icons left red">clear</i>'});
                            //$('.floating-info').fadeOut(10000);
                        }
                    }
                });
            }
        });
    });
    
    $('.reeditable').each(function(){
        $(this).attr('title', 'Cliquer pour editer');
        $(this).on('click', function(){
            $(this).attr('contenteditable', true);
        });
        $(this).on('blur', function(){
            //$('body').append('<div class="floating-info">Requete en cours...</div>');
            $(this).removeAttr('contenteditable');
            // alert($(this).html());
            // return false;
            $.ajax({
                url: 'ajax/edit-news.php',
                type: 'post',
                dataType: 'json',
                data: {'id': $(this).attr('data-id'), 'colonne': $(this).attr('data-colonne'), 'value': $(this).text()},
                error: function(){
                    // $('.floating-info').html('<font color="orange">Requete non soumise, 404</font>');
                    // $('.floating-info').fadeOut(10000);
                    M.toast({html: 'Erreur '+e.status+'<i class="material-icons left red">clear</i>'});
                },
                success: function(r){
                    if(r.success){
                        M.toast({html: 'Contenu edite avec succes!<i class="material-icons green left">done</i>'});
                        //$('.floating-info').fadeOut(10000);
                        //$('.floating-info').remove();
                    }else{
                         // $('.floating-info').fadeOut(10000);
                    M.toast({html: 'Erreur : '+r.message+'<i class="material-icons left red">clear</i>'});
                    }
                }
            });
        });
    });
</script>
