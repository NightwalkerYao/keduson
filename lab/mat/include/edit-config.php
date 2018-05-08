<?php 
$form = true; //display the form
if(isset($_POST['pwd'])){
    extract($_POST);
    $file = 'huntr.pwd';
    $correct = file_get_contents($file);
    //$pwd = password_hash($pwd, PASSWORD_BCRYPT);
    if(password_verify($pwd, $correct)){
        //true content here.
        $form = false;
        ?>
            <h2> Editer le fichier de configuration principal</h2>
            <br>
            <form method="post" id="uphtaccess">
            <center>
                <?php $content = ''; $content .= file_get_contents('../php/config.php'); ?>
                <textarea name="content" rows="18" style="width: 92%;" speelcheck="false"><?=$content;?></textarea>
                <br>
                <br>
                <input type="submit" value="Editer" name="confirm" class="button-normal">
            </center>
            </form>
            <script>
                $(document).ready(function(){
                    $('#uphtaccess').on('submit', function(e){
                        e.preventDefault();
                        var data = $(this).serialize(), url= 'ajax/edit-cf.php';
                        $('body').append('<div class="floating-info">Requete en cours...</div>');
                        $.ajax({
                            url: url,
                            type: 'post',
                            dataType: 'json',
                            data: data,
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
                });
            </script>
        <?php 
    }else{
        echo '<center><font color="red">Incorrect password , try again.</font></center>';
    }
}else{
    echo '<center><font color="cyan">This page contains some sensitive datas. Please confirm the main admin\'s password to gain access.</font></center>';
}
if($form){ ?>
    <center>
        <form method="post">
            <br> <br>
            <input type="password" name="pwd"> <input type="submit" value="valider">
        </form>
    <center>
<?php }
?>
