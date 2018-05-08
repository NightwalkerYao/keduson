<?php
if(isset($_POST['path'], $_POST['dirname'])){
    extract($_POST);
    $d = @mkdir($path.'/'.$dirname, 0777);
    if($d)
        $res = ['success'=>true];
    else
        $res = ['success' => false, 'message'=>'Failed creating directory.'];
}else
    $res = ['success'=>false, 'message'=>'Missing post datas'];

echo json_encode($res);
