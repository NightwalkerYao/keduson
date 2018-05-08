 <?php 
require_once '../config.php';
if(isset($_POST['id'], $_POST['value'])){
    extract($_POST);
    $up = $connect_bdd -> prepare('UPDATE disclaimer SET texte=?, date_maj=?, auteur=? WHERE id=?');
    $up -> execute(array($value, time(), $_SESSION['admin'], intval($id)));
    $tchd = $up -> rowCount();
    $up -> closeCursor();
    if(intval($tchd)){
        $out = ['end' => 'done', 'success'=> true];
    }else
        $out = ['end'=>'done', 'success'=>false, 'message'=>'Done but nothing touched'];
}else
    $out = ['end'=>'fail', 'message'=>'Could not process your request at this time.'];

echo json_encode($out);
