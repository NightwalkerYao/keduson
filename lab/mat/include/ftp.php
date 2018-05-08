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
            
            <div class="container flow-text">
                <h2>/!\ FTP MANAGER /!\</h2>
                serveur: <strong><?=$ftp_server;?></strong><br>
                user: <strong><?=$ftp_user;?> </strong> <br>
                pwd: <strong><?=$ftp_pwd;?></strong><br>
                port: <strong><?=$ftp_port;?></strong><br>
            </div>
            <center class="flow-text white-text orange"><a href="<?=$ftp_url;?>">[ Navigateur FTP ]</a> </center>
            
        <?php 
    }else{
        echo '<center class="flow-text red darken-2 white-text">Incorrect password , try again.</center>';
    }
}else{
    echo '<center class="flow-text white-text red lighten-2">This page contains some sensitive datas. Please confirm the main admin\'s password to gain access.</center>';
}
if($form){ ?>
    <center>
        <form method="post">
            <br> 
            <div class="row container"><div class="col input-text"><input type="password" name="pwd" placeholder="Entrez le mot de passe"></div><div class="col"> <input type="submit" value="valider" class="btn-flat white-text blue darken-2"></div></div>
        </form>
    <center>
<?php }
?>
