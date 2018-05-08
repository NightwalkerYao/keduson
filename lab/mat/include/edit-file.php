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
           
		<div style="padding: 1em">
		<h2>Editer un fichier</h2>
		<?php 
		$afs = ['index.php'=>'../../index.php', 'config.php'=> '../../php/config.php', 'preprocessor.php'=>'../../php/preprocessor.php','htaccess'=> '../../.htaccess', 'user.ini'=> '../../.user.ini'];
		$file = (isset($_GET['file']) ? $_GET['file'] : ' ');
		if(!isset($afs[$file]))
			echo '<div class="flow-text red white-text darken-2 center">Fichier Incorrect ou non editable.</div>';
		else{
			$fc = @file_get_contents($afs[$file]);
			?>
			<div class="flow-text green white-text darken-2"><?=$afs[$file];?></div>
			<div class="container">
				<form method="post" id="uphtaccess">
					<div>
						<br>
						<br>
						<textarea rows="13" spellcheck="false" id="txtar12"><?=$fc;?></textarea>
					</div>
					<div><button class="blue darken-2 btn-flat white-text"><i class="material-icons left white-text">edit</i> Editer</button></div>
				</form>
				<script>
                $(document).ready(function(){
                    $('#uphtaccess').on('submit', function(e){
                        e.preventDefault();
                        var data = {'file':'<?=$afs[$file];?>', 'content': $('#txtar12').val()}, url= 'ajax/edit-file.php';
                        M.toast({html:'<i class="material-icons left">edit</i> Editing file...'});
                        $.ajax({
                            url: url,
                            type: 'post',
                            dataType: 'json',
                            data: data,
                            error: function(er){
                                M.toast({html:'<i class="material-icons red-text left">clear</i> Error '+er.status});
                            },
                            success: function(r){
                                if(r.success){
                                    M.toast({html:'<i class="material-icons green-text left">done</i> File edited successfully!'});
                                }else{
                                    M.toast({html:'<i class="material-icons red-text left">clear</i> Edition failed: '+r.message});
                                }
                            }
                        });
                    });
                });
            </script>
			</div>
			<?php
		}
		?>
		</div>
		<?php 
    }else{
        echo '<div class="flow-text red white-text darken-2 center">Incorrect password , try again.</div>';
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