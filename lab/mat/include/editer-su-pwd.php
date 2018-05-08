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
        if(isset($_POST['pwd1']) && trim($_POST['pwd1']) != ''){
            $op = fopen('huntr.pwd', 'w+');
            $dd = password_hash($_POST['pwd1'], PASSWORD_BCRYPT);
            fwrite($op, $dd);
            fclose($op);
            echo '<center class="center flow-text green white-text">Termine! le nouveau mdp est '. $_POST['pwd1']. ' ::: '.$dd.'</center>';
        }
        ?>
        <center class="row">
        <form method="post">
            <br> <br>
            <div class="col">
            <input type="password" name="pwd" placeholder="Ancien mdp"> 
        </div>
        <div class="col">
            <input type="password" name="pwd1" placeholder="Nouveau mdp"> 
        </div>
        <div class="col">
            <input type="submit" value="valider" class="btn-flat blue">
        </div>
        </form>
        <center>
        <?php
        
    }else{
        echo '<center class="flow-text red white-text">Incorrect password , try again.</center>';
    }
}else{
    echo '<center class="flow-text cyan white-text" >This page contains some sensitive datas. Please confirm the main admin\'s password to gain access.</center>';
}
if($form){ ?>
    <center class="row container">
        <form method="post">
            <br> <br>
            <div class="col">
            <input type="password" name="pwd" placeholder="Entrer un mdp"> 
        </div>
        <div class="col"><input type="submit" value="valider" class="btn-flat blue">
        </div>
        </form>
    <center>
<?php }
?>
