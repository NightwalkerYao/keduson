<?php 
function cURLdownload($url, $file){
  $ch = curl_init();
  $fp = fopen($file, "w");
  curl_setopt($ch, CURLOPT_USERAGENT, '"Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.11) Gecko/20071204 Ubuntu/7.10 (gutsy) Firefox/2.0.0.11');
  //curl_setopt($ch, CURLOPT_REFERER, 'http://domain.com/');
  curl_setopt($ch, CURLOPT_HEADER, true);
  //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $redirects > 0);
  curl_setopt($ch, CURLOPT_FILE, $fp);
  //curl_setopt($ch, CURLOPT_MAXREDIRS, $redirects);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FORBID_REUSE, false);
  curl_exec($ch);
  curl_close($ch);
  fclose($fp);
  return "SUCCESS: $file [$url]";
}

// function downloadUrlToFile($url, $outFileName)
// {   
//     if(is_file($url)) {
//         copy($url, $outFileName); 
//     } else {
//         $options = array(
//           CURLOPT_FILE    => fopen($outFileName, 'w'),
//           CURLOPT_TIMEOUT =>  28800, // set this to 8 hours so we dont timeout on big files
//           CURLOPT_URL     => $url
//         );

//         $ch = curl_init();
//         curl_setopt_array($ch, $options);
//         curl_exec($ch);
//         curl_close($ch);
//     }
// }

//using
if(!is_dir('../../files/'.date('Y').'/'.date('m').'/Downloads'))
  mkdir('../../files/'.date('Y').'/'.date('m').'/Downloads', 0777, true);

if(isset($_REQUEST['url'], $_REQUEST['file'])){
  extract($_REQUEST);
  set_time_limit(0); }
// $f = file_get_contents($url);
// file_put_contents('downloads/'.$file, $f);

  //echo '<h2>  '.cURLdownload($url, $file).'</h2>';
?>
<div class="container">
<form method="post">
  <div class="input-field">
    <label>URL vers le fichier</label>
<input type="text" name="url1" id="url1" size="50" value="<?=isset($url)? $url : false;?>" />
</div>
<div class="input-field">
  <label>Nom du fichier</label>
<input type="text" name="nom" value="<?=isset($file)? $file : false;?>" >
</div>
<br>
<div>
<button name="submit" type="submit" class="btn-flat green lighten-2 white-text"><i class="material-icons left">archive</i>Telecharger</button>
</div>
</form>
</div>
<?php
    // maximum execution time in seconds
    set_time_limit (24 * 60 * 60);

    if (!isset($_POST['submit'])) die();

    // folder to save downloaded files to. must end with slash
    $destination_folder = '../../files/'.date('Y').'/'.date('m').'/Downloads/';

    $url = $_POST['url1'];
    $newfname = $destination_folder . $_POST['nom'];//str_replace(array('?', '=', '!', '&'), '', basename($url));

    $file = fopen ($url, "rb");
    if ($file) {
      $newf = fopen ($newfname, "wb");

      if ($newf)
      while(!feof($file)) {
        fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
      }
      echo '<center class="center flow-text cyan white-text"><i class="material-icons">done</i> Termine! '.$destination_folder . $_POST['nom'].' a ete telecharge.</center>';
    }

    if ($file) {
      fclose($file);
    }

    if ($newf) {
      fclose($newf);
    }
?>

