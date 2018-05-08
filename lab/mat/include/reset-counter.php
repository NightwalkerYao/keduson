<?php 
$counter = '../../Huntr.counter';
$bkdir = 'backups';
if(!is_dir($bkdir)){
    mkdir($bkdir, 0777);
}
$dt = file_get_contents($counter);
$op = fopen($bkdir.'/Huntr.counter.txt', 'a+');
fwrite($op, '\r\n'.$dt.' '.date('d-m-Y,H:i:s'));
fclose($op);

$op2 = fopen($counter, 'w+');
fwrite($op2, 0);
fclose($op2);
?>
<br>
<center class="green darken-2 white-text container"> <font>Counter reset successfully !</font> </center> 
<br>
<br>
<br>
<br>