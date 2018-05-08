<?php 
session_start();

if(isset($_POST['username'], $_POST['password'])){
    extract($_POST);
//     require_once 'config.php';
     $sortie = array();
//     $sortie['in_username'] = $username;
//     $sortie['in_password'] = $password;
    
    $password = hash('sha256', $password);
    $list1 = file_get_contents('team1.lst');
    $list2 = file_get_contents('team2.lst');
    
    $usernames = explode(';', $list1);
    $passwords = explode(';', $list2);
    
    $matched = 0;
    
    for($i = 1; $i<count($usernames); $i++){
        if($usernames[$i] == $username && $passwords[$i] == $password)
            $matched++;
    }
    
    if($matched > 0){
        $sortie['matched'] = true;
        $_SESSION['admin'] = $username;
    }else{
        $sortie['matched'] = false;
    }
    
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        echo json_encode($sortie);
        exit;
    }
    if(isset($_SESSION['admin']))
        header('Location:index.php');
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../../css/theme.css">
        <script type="text/javascript" src="../../js/jquery-3.2.1.js"></script>
    </head>
    <body>
        <div align="center">
            <br>
            <br>
            <h1> Connexion / Login </h1>
            <form method="post" action="#">
                <div>
                    <br>
                    <img src="../../img/icones/icons8-technical support.png">
                    <br>
                    <input id="username" class="rightFastInput" style="width:17em;" type="text" name="username" placeholder="Identifiant">
                    <br>
                    <br>
                    <input id="password" class="rightFastInput" style="width:17em;" type="password" name="password" placeholder="Mot de passe">
                    <br>
                    <br>
                    <input id="login" type="submit" value="Connexion" class="button-normal">
                    <br>
                    <br>
                    <a href="recover-mdp.php">Mot de passe oublie</a> | <a href="register.php">Inscription</a>
                </div>
            </form>
           <script type="text/javascript">
                $('#login').on('click', function(e){
                    e.preventDefault();
                    var form = $(this).closest('form'), data = $(form).serialize();
                    $.ajax({
                        url: $(form).attr('action'),
                        data: data,
                        dataType: 'json',
                        type: 'post',
                        error: function(){
                            alert('ERREUR');
                        },
                        success: function(rep){
                            if(rep.matched){
                                window.location = './index.php';
                            }else{
                                $('#errlog').remove();
                                $('#login').after('<div id="errlog"><br><font color="orange">Identifiant / Mot de passe invalide.</font></div>');
                            }
                        }
                    });
                });
           </script>
        </div>
        <br>
        <br>
    </body>
</html>
