<?php 
if(isset($_POST['username'], $_POST['password'], $_POST['password2'])){
    $re = file_get_contents('settings/registration.set');
    $re = trim($re);
    if(strtolower($re) != 'on'){
        die('Les inscriptions sont fermees pour le moment.');
    }
    
    extract($_POST);
    if(strlen(trim($username))>=4 && strlen($password)>=8){
        if($password == $password2){
            file_put_contents('team1.lst', ';'.$username, FILE_APPEND);
            file_put_contents('team2.lst', ';'.hash('sha256', $password), FILE_APPEND);
            header('Location:login.php');
        }else{
            $erreur = 'Mdps differents';
        }
    }else{
        $erreur = 'Identifiant ou mdp trop court.<br> regles:: ID: min 4 caracteres; mdp: min 8 caracteres';
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inscription</title>
        <link rel="stylesheet" type="text/css" href="../css/theme.css">
        <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    </head>
    <body>
        <div align="center">
            <br>
            <br>
            <h1> Inscription / Registration </h1>
            <form method="post" action="#">
                <div>
                    <br>
                    <img src="../img/icones/icons8-technical support.png">
                    <br>
                    <input id="username" class="rightFastInput" style="width:17em;" type="text" name="username" placeholder="Identifiant">
                    <br>
                    <br>
                    <input id="password" class="rightFastInput" style="width:17em;" type="password" name="password" placeholder="Mot de passe">
                    <br>
                    <br>
                    <input id="password2" class="rightFastInput" style="width:17em;" type="password" name="password2" placeholder="Mot de passe encore">
                    <br>
                    <br>
                    <input id="login" type="submit" value="Inscription" class="button-normal">
<?=(isset($erreur) ? '<div id="errlog"><font color="orange">'.$erreur.'</font></div>' : false);?>
                    <br>
                    <br>
                    <a href="recover-mdp.php">Mot de passe oublie</a> | <a href="login.php">Connexion</a>
                </div>
            </form>
        </div>
        <br>
        <br>
    </body>
</html>
