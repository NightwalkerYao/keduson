<?php 
/*     if(!file_exists('huntr.pwd')){
//         ?>
//         <form method="post">
//             <input type="text" name="hut"> <input type="submit" value="OK">
//         </form>
//     <?php }
//     if(isset($_POST['hut'])){
//         $op = fopen('huntr.pwd', 'a+');
//         $dd = password_hash($_POST['hut'], PASSWORD_BCRYPT);
//         fwrite($op, $dd);
//         fclose($op);
//         echo 'done! ::: '.$dd;
//     } */

$form = true; //display the form
if(isset($_POST['pwd'])){
    extract($_POST);
    $file = 'huntr.pwd';
    $correct = file_get_contents($file);
    //$pwd = password_hash($pwd, PASSWORD_BCRYPT);
    if(password_verify($pwd, $correct)){
        //true content here.
        $form = false;
        phpinfo();
        
    }else{
        echo '<center class="flow-text red center white-text">Incorrect password , try again.</center>';
    }
}else{
    echo '<center class="flow-text cyan white-text center">This page contains some sensitive datas. Please confirm the main admin\'s password to gain access.</center>';
}
if($form){ ?>
    <center class="row container">
        <form method="post">
            <br> <br>
            <div class="col input-text">
            <input type="password" name="pwd" placeholder="Entrer le mdp">
            </div>
            <div class="col"> <input type="submit" value="valider" class="btn-flat blue white-text waves-effect waves-red"></div>
        </form>
    <center>
<?php }
?>
