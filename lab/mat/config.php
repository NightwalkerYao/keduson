<?php 
$adminer_name = 'root'; $adminer_db = 'musicboxDB'; $adminer_host = 'localhost'; $adminer_pwd = '';
$ftp_user = ''; $ftp_server = ''; $ftp_pwd = ''; $ftp_port = 21; $ftp_url = 'ftp://ftp.localhost:21';

try { $connect_bdd = new PDO("mysql:host=$adminer_host;dbname=$adminer_db",$adminer_name,$adminer_pwd); }
	catch (Exception $e)
	{die ('db is dead'); }
    $connect_bdd -> exec("SET NAMES utf8");
    
    session_start();
    if(isset($_GET['logout']))
        $_SESSION['admin'] = null;
        
    if(!isset($_SESSION['admin'])){
        header('Location:login.php');
        exit;
    }
    
function urlencode_2($texte, $ci=true, $decode=true){
    if($decode)
        $texte = html_entity_decode($texte);
    if($ci)
        $texte = strtolower($texte);
    $texte = str_replace(array('à', 'ä', 'æ', 'â', 'ǎ') , 'a', $texte);
    $texte = str_replace(array('é', 'è','ë', 'ê', 'ě'), 'e',  $texte);
    $texte = str_replace(array('ï', 'î'), 'i', $texte);
    $texte = str_replace(array('ô', 'ö', 'Ø'), 'o', $texte);
    $texte = str_replace(array('ù', 'û', 'ü'), 'u', $texte);
    $texte = str_replace(array('ç', 'ĉ'), 'c', $texte);
    
	$texte = preg_replace("#[^a-z0-9-]#i", '-', $texte);
	while(strpos($texte, '--') !== false)
		$texte = str_replace('--', '-', $texte);
	return $texte;
}

?>
