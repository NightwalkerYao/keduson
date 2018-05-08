<?php 
if(isset($_POST['content'])){
    extract($_POST);
    if(file_put_contents('../../php/config.php', $content))
        $res = ['end'=>'done', 'success'=>true];
    else
        $res = ['end'=>'fail', 'success'=>false, 'message'=>'Can not write into the config file at this time.'];
}else
    $res = ['end'=>'fail', 'message'=>'Missing post datas in the request headers'];
    
echo json_encode($res);
