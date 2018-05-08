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
            
            <br>
            <div class="container center">
                <h2>/!\ DATABASE MANAGER /!\</h2>
                host: <strong><?=$adminer_host;?></strong><br>
                user: <strong><?=$adminer_name;?> </strong> <br>
                pwd: <strong><?=$adminer_pwd;?></strong><br>
                <div class="orange flow-text"><a href="adminer">[ENTRER]</a> </div>
                <div class="flow-text red lighten-2 white-text">
                A la fin de votre session, n'oubliez pas de cliquer sur le bouton "Deconnexion" avant de fermer votre navigateur.<br>
                Merci de veillez a la securite du site.
            </div>
            </div>
        <?php 
    }else{
        echo '<div class="flow-text red white-text darken-2">Incorrect password , try again.</div>';
    }
}else{
    echo '<center class="flow-text red white-text lighten-2">This page contains some sensitive datas. Please confirm the main admin\'s password to gain access.</center>';
}
if($form){ ?>
    <div class="container row">
        <br>
        <br>
        <form method="post">
            <div class="input-field col">
            <input type="password" name="pwd" placeholder="Entrez le mot de passe svp"></div><div class="col"> <input type="submit" value="valider" class="btn-flat blue darken-2 white-text"></div>
        </form>
    <div>
<?php }
?>
