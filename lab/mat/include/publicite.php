<div style="padding: 1em;"><h2>Gestion des publicites</h2>
<br>
<center><a href="#ajouter">Ajouter</a> || <a href="#liste">Liste</a></center>
<br>
<br>
<?php 
    $qr = $connect_bdd -> prepare('SELECT * FROM publicites ORDER BY id DESC');
    $qr -> execute();
    $pub = $qr -> fetchAll(PDO::FETCH_OBJ);
    $qr -> closeCursor();
?>
<table id="liste" class="highlight">
    <thead>
        <tr><th>ID</th> <th>Regie</th> <th>Type</th> <th>Support</th> <th>Dimensions</th> <th>Code</th> <th> Emplacement</th> <th>Affichable</th> </tr>
    </thead>
    <tbody>
<?php 
 foreach($pub as $p){
    ?>
    <tr data-id="<?=$p->id;?>">
        <td><?=$p -> id;?></td>
        <td data-colone="regie" class="editd"><?=$p->regie;?></td>
        <td data-colone="_type" class="editd"><?=$p->_type;?></td>
        <td data-colone="support" class="editd"><?=$p->support;?></td>
        <td data-colone="dimensions" class="editd"><?=$p->dimensions;?></td>
        <td data-colone="code" class="editd"><?=nl2br(htmlspecialchars($p->code));?></td>
        <td data-colone="emplacement" class="editd"><?=$p->emplacement;?></td>
        <td data-colone="affichable" class="editd"><?=$p->affichable;?></td>
    </tr>
<?php 
 }
 ?>
    </tbody>
</table>
<br>
<br>
<div class="container"><h2>Ajouter</h2>
<div>
    <form id="ajouter">
        <div class="input-field">
        <label for="Regie"> Regie : </label><input type="text" name="regie" required id="Regie" >
        </div>
        <div class="input-field1">
        <label for="Type">Type : </label><select name="_type" class="browser-default" id="Type"> <option value="banner">Banniere</option><option value="im">Instant Message</option> <option value="popunder">Pop Under</option> <option value="recommendation_widget">Recommendation Widget</option> <option value="link">Liens inText</option> </select>
        </div>
        <div class="input-field1">
        <label for="Support">Support: </label><select id="Support" class="browser-default" name="support"><option value="desktop">Desktop, PC et Tablette</option><option value="mobile">Mobile</option> <option value="all">Tout Support</option></select>
        </div>
        <div class="input-field">
        <label for="Dimensions">Dimensions: </label><input type="text" name="dimensions" required>
        </div>
        <div class="input-field">
        <label for="Code">Code: </label><textarea id="Code" class="validate" name="code" rows="6" cols="50" required></textarea>
        </div>
        <div class="input-field">
        <label for="Emplacement">Emplacement: </label><input id="Emplacement" class="inline" type="text" name="emplacement" required>
        </div>
        <div class="input-field1">
        <label for="Affichable">Affichable: </label> <select id="Affichable1" class="inline browser-default" name="affichable"><option value="oui">Oui</option><option value="non">Non</option></select>
        </div>
        <div class="center-align">
        <input type="submit" name="add" value="Ajouter" class="btn-flat waves-effect waves-light blue lighten-1 white-text">
        </div>
    </form>
</div>
</div>
</div>
<script>
$(document).ready(function(){

    $('.editd').each(function(){
        $(this).attr('title', 'Cliquer pour editer');
        $(this).on('click', function(){
            $(this).attr('contenteditable', true);
        });
        $(this).on('blur', function(){
            $(this).removeAttr('contenteditable');
            $('body').append('<div class="floating-info">Requete en cours...</div>');
            $.ajax({
                url: 'ajax/edit-ad.php',
                data: {'colonne': $(this).attr('data-colone'), 'id': $(this).closest('tr').attr('data-id'), 'value': $(this).text()},
                dataType: 'json',
                type: 'post',
                error: function(){
                    $('.floating-info').html('<font color="orange">Requete non soumise, 404</font>');
                    $('.floating-info').fadeOut(10000);
                },
                success: function(r){
                    if(r.success){
                        $('.floating-info').html('<font color="green">Contenu edite avec succes!</font>');
                        $('.floating-info').fadeOut(10000);
                    }else{
                        $('.floating-info').html('<font color="red">'+r.message+'</font>');
                        $('.floating-info').fadeOut(10000);
                    }
                }
            });
        });
    });
    
    $('#ajouter').on('submit', function(e){
        e.preventDefault();
        $('body').append('<div class="floating-info">Requete en cours...</div>');
            $.ajax({
                url: 'ajax/add-ad.php',
                data: $(this).serialize(),
                dataType: 'json',
                type: 'post',
                error: function(){
                    $('.floating-info').html('<font color="orange">Requete non soumise, 404</font>');
                    $('.floating-info').fadeOut(10000);
                },
                success: function(r){
                    if(r.success){
                        //console.log(r);
                        $('#ajouter')[0].reset();
                        $('.floating-info').html('<font color="green">Publicite ajoutee avec succes!</font>');
                        $('.floating-info').fadeOut(10000);
                        $('#liste tbody').prepend('<tr data-id="'+r.id+'"><td>'+r.id+'</td><td data-colone="regie" class="editd">'+r.content.regie+'</td><td data-colone="_type" class="editd">'+r.content._type+'</td><td data-colone="support" class="editd">'+r.content.support+'</td> <td data-colone="dimensions" class="editd">'+r.content.dimensions+'</td> <td data-colone="code" class="editd"> ##Code## actualiser pour afficher ce code</td> <td data-colone="emplacement" class="editd">'+r.content.emplacement+'</td><td data-colone="affichable" class="editd">'+r.content.affichable+'</td></tr>');
                    }else{
                        $('.floating-info').html('<font color="red">'+r.message+'</font>');
                        $('.floating-info').fadeOut(10000);
                    }
                }
            });
    });
    
});
</script>
