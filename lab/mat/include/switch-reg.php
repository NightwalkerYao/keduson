<?php 
if(isset($_GET['from'])){
    extract($_GET);
    switch($from){
    case 'ON':
        file_put_contents('settings/registration.set', 'OFF');
        echo '<center><font color="orange">Inscriptions desactivees</font></center>';
    break;
    case 'OFF':
        file_put_contents('settings/registration.set', 'ON');
        echo '<center><font color="lime">Inscriptions activees</font></center>';
    break;
    }
}
