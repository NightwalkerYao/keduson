<?php
$dir = $_REQUEST['base'];
$files = @scandir($dir);
if($files){
foreach ($files as $f) {
	if($f!='.' && $f!='..'){
		$nw = preg_replace('#[^a-z0-9_.-]#i', '_', $f);
		@rename($dir.'/'.$f, $dir.'/'.$nw);
	}
}
echo json_encode(array('success'=>true));
}else{
	echo json_encode(array('success'=>false));
}