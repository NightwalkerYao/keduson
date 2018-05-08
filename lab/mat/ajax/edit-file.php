<?php 
if(isset($_POST['content'], $_POST['file'])){
    extract($_POST);
    if(file_put_contents('../'.$file, $content))
        $res = ['end'=>'done', 'success'=>true];
    else
        $res = ['end'=>'fail', 'success'=>false, 'message'=>'Can not write into this file at this time.'];
}else
    $res = ['end'=>'fail', 'message'=>'Missing post datas in the request headers'];
    
echo json_encode($res);
