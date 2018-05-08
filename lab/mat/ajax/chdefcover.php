<?php 
$n = (isset($_REQUEST['name']) ? $_REQUEST['name'] : '');
if(file_put_contents('../settings/default-cover.set', $n))
	$o = ['success' => true];
else
	$o = ['success' => false];
echo json_encode($o);