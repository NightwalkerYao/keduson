<?php
  require_once("php/config.php");
  require_once("detectmobilebrowser.php");
  counter_me(true);

?>
<!DOCTYPE html>
<html lang="fr-CI">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1" >
<meta name="author" content="Club KDS" >
<title><?=$_TITRE;?></title>
<meta name="description" content="<?=$_META_DESCRIPTION;?>" />
<meta name="keywords" content="<?=$_META_KEYWORDS;?>" />
<!-- ogs -->
<meta property="og:url" content="<?=$_OG_URL;?>" />
<meta property="og:title" content="<?=$_OG_TITLE;?>" />
<meta property="og:description" content="<?=$_OG_DESCRIPTION;?>" />
<meta property="og:type" content="<?=$_OG_TYPE;?>" />
<meta property="og:image" content="<?=$_OG_IMAGE;?>" />
<meta property="og:site_name" content="<?=$_OG_SITE_NAME;?>" />
<link rel="alternate" type="application/rss+xml" title="Flux RSS" href="<?=ROOT_SANS;?>/rss.xml" />
<style type="text/css" media="screen">@import url(<?=ROOT_SANS;?>/css/style.css);</style>
<!--[if IE ]>
  <link href='http://fonts.googleapis.com/css?family=Oswald&v1' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?=ROOT_SANS;?>/css/style-ie.css" type="text/css" media="screen" />
<![endif]-->
<!-- <style type="text/css">@media screen and (-webkit-min-device-pixel-ratio:0) {#searchbox{float:left;margin-top:10px;padding:1px 0px 3px 5px;}#searchbutton{margin:4px 0px 0px 8px;}#subbox{float:left;margin:8px 0px 0px 15px;}#subbutton{margin:5px 0px 0px 15px;}}}</style>
 -->
 <script type="text/javascript" src="<?=ROOT_SANS;?>/js/jquery.js?ver=1.10.2"></script> <!--  -3.3.1.min -->
 <!-- <script type="text/javascript" src="<?=ROOT_SANS;?>/js/scroll.js"></script> -->
 <script type="text/javascript"><?=file_get_contents('js/scroll.js');?></script>
<link rel='stylesheet' href='<?=ROOT_SANS;?>/css/pagination.css' type='text/css' media='all' />
<link rel='stylesheet' id='contact-form-7-css' href='<?=ROOT_SANS;?>/css/styles.css?ver=3.6' type='text/css' media='all' />
<link rel='stylesheet' id='wp-pagenavi-css' href='<?=ROOT_SANS;?>/css/pagenavi-css.css?ver=2.70' type='text/css' media='all' />
<script type="text/javascript" src="<?=ROOT_SANS;?>/js/jquery-migrate.min.js?ver=1.2.1"></script>
<link rel="icon" href="<?=ROOT_SANS;?>/s.png" type="image/x-icon">
</head>

<body>
  <header>
    <div id="wrap">
      <div id="header">
        <!-- <script type="text/javascript" src="<?=ROOT_SANS;?>/js/jqueryZik.js"></script> -->
        <div class="headerleft">
        </div>
        <div class="arama">
          <form id="searchform" method="get" action="<?=SEARCH_BASE;?>">
            <!-- search_result -->
            <input style="position: relative;top: 2px;" type="search" value="<?=isset($_GET['q']) ? htmlspecialchars($_GET['q']) : false;?>" name="q" id="searchbox" size="20" placeholder="Artiste,Titre, Album..." required onkeydown="document.getElementById('searchResult').style.display='block';" onkeyup="loadXMLDoc('<?=SEARCH_BASE;?>?q='+encodeURIComponent(this.value)+'&amp;content=search&amp;addTo=ac'); if(this.value == '') document.getElementById('searchResult').style.display='none';">
            <input type="hidden" name="content" value="search">
            <input type="submit" id="searchbutton" value="Recherche" style="background: url(<?=ROOT_SANS;?>/css/images/navbar.png); color: #ccc; width: 80px; position: relative; top: 2px; font-weight: normal;" />
            <div align="left" id="searchResult" name="searchResult" style="background-color: #FFFFFF;
              border: 0 solid #000000;
              font-family: sans-serif;
              font-size: 15px;
              margin-left: 0px;
              padding: 0;
              width: 304px;
              position: absolute;
              z-index: 99;
              margin-left: 6px;
              border-radius: 0px 0px 5px 5px;
              margin-top: -2px;">
            </div>
          </form>
          <script language="JavaScript" type="text/javascript">
            var ROOT_SANS = "<?=ROOT_SANS;?>";
            $(document).click(function() {
              $("#searchResult").html("");
            });

            var req = null;

            function loadXMLDoc(url) {
               // Internet Explorer
               try { req = new ActiveXObject("Msxml2.XMLHTTP"); }
               catch(e) {
                  try { req = new ActiveXObject("Microsoft.XMLHTTP"); }
                  catch(oc) { req = null; }
               }

               // Mozailla/Safari
               if (req == null && typeof XMLHttpRequest != "undefined") {
                  req = new XMLHttpRequest();
               }
               // Call the processChange() function when the page has loaded
               if (req != null) {
                  req.onreadystatechange = processChange;
                  req.open("GET", url, true);
                  req.send(null);
               }
            }

            function processChange(evt) {
               // The page has loaded and the HTTP status code is 200 OK
               if (req.readyState == 4) {
                  if (req.status == 200) {
                  // Write the contents of this URL to the searchResult layer
                    getObject("searchResult").innerHTML = req.responseText;
                  }
               }
            }

            function getObject(name) {
               var ns4 = (document.layers) ? true : false;
               var w3c = (document.getElementById) ? true : false;
               var ie4 = (document.all) ? true : false;

               if (ns4) return eval('document.' + name);
               if (w3c) return document.getElementById(name);
               if (ie4) return eval('document.all.' + name);
               return false;
            }

            // window.onload = function() {
            //    getObject("searchbox").focus();
            // }
            jQuery(document).ready(function(){var offset=220;var duration=1000;jQuery(window).scroll(function(){if(jQuery(this).scrollTop()>offset){jQuery('#toTop').fadeIn(duration);}else{jQuery('#toTop').fadeOut(duration);}});jQuery('#toTop').click(function(event){event.preventDefault();jQuery('html, body').animate({scrollTop:0},duration);return false;})});
            </script>
        </div>
        <div id="toTop">Go to Top</div>
        <div class="headerright">
          <a href="<?=ROOT_SANS;?>">
            <img src="<?=ROOT_SANS;?>/logo-kds.png" alt="KeDuSon.com" />
            <!-- <span style="font-size: 30pt; font-weight: bold;">KeDuSon.com</span> -->
          </a>
        </div>
      </div>
      <script type="text/javascript" src="<?=ROOT_SANS;?>/js/jquery.sticky.js"></script>
      <script type="text/javascript">
        $(window).load(function(){
          $("#navbar-second").sticky({ 
              topSpacing: 18});
        });
      </script>
      <style type="text/css">
          .is-sticky{
              opacity: 0.9;
              z-index: 9999;
              position: absolute;
          }
          .is-sticky:hover{
              opacity: 1;
          }
          </style>
      <div id="navbar-second">
        <div id="navbarborder">
          <div id="navbar">
            <div id="navbarleft">
              <ul id="nav">
                <li><a href="<?=ROOT_SANS;?>/" style="padding-left: 8px; padding-right: 9px;"><img style="position: relative; top: 3px;" src="<?=ROOT_SANS;?>/css/images/hm_1.png"></a></li>
                <li><a href="<?=ROOT_SANS;?>/club/">Le Club</a></li>
                <li><a href="<?=ROOT_SANS;?>/ajouter">ajouter</a></li>
                <li><a href="<?=ROOT_SANS;?>/genre/hip-hop/">Hip-Hop / Rap</a></li>
                <li><a href="<?=ROOT_SANS;?>/genre/couper-decaler/">Couper-Decaler</a></li>
                <li><a href="<?=ROOT_SANS;?>/genre/zouglou/">Zouglou</a></li>
                <li><a href="<?=ROOT_SANS;?>/genre/afrobeat/">AfroBeat</a></li>
                <li><a href="<?=ROOT_SANS;?>/genre/reggae/">Reggae</a></li>
                <li><a href="<?=ROOT_SANS;?>/genre/gospel/">Gospel</a></li>
                <li><a href="<?=ROOT_SANS;?>/genre/afropop/">Afropop</a></li>
                <li><a href="<?=ROOT_SANS;?>/genre/rnb/">R&amp;b / soul</a></li>
                <li><a href="<?=ROOT_SANS;?>/genre/folk/">Variétés</a></li>
                <!-- <li><a href="<?=ROOT_SANS;?>/genre/pop/">Pop</a></li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="flasInfo filmcontent tam" style="display: block; width: 99.999%; margin:0 auto; color: #CCC;">
<?php
$lastNews = $connect_bdd -> query("SELECT * FROM nouvelles ORDER BY id DESC LIMIT 1") or die(print_r($connect_bdd->errorInfo()));
$lnws = $lastNews->fetch();
$lastNews-> closeCursor();
echo '<mark style="display:inline-block; background-color: cyan;">'.date("d/m/Y", $lnws['date_post']).'</mark><marquee direction="left" scrollamount="3" scrolldelay="5" style="border:0; margin:0; text-align:center; display:inline-block; width: 92.5%; float: right;" >'.$lnws['texte'].'</marquee>';
?>
        </div>
    </div>
  </header>
  <main>
    <?php
      if(isset($_GET['content'])){
        $content = $_GET['content'];
        $allowed_contents = scandir('./content');
        if($content != '.' && $content != '..' && in_array($content.'.php', $allowed_contents)){
          include_once('./content/'.$content.'.php');
        }else{
            include_once('./content/error.php');
        }
      }else{
        include_once('./content/default.php');
      }
    ?>
  </main>
  <script type="text/javascript">
    function alertdmca(){
      alert("Le contenu de ce site est géré par ses Utilisateurs. Si vous pensez que quelque chose a été publiée ici en violation de vos droits, veillez nous le signaler et nous nous chargerons de retirer le plus vite possible.");
      return false;
    }
  </script>
  <footer>
    ﻿<div id="footer" style="background: url(<?=ROOT_SANS;?>/css/images/body-bg.png) repeat;">
      <div class="footer clearfix">
        <!-- //// -->
        <div class="footerleft">
          Copyright &copy; <?=date('Y')?> <a href="http://inspirates.io.ci" target="_blank">Inspirates</a>
          <br />
          <br />
          <a href="#" onclick="return alertdmca();">l&eacute;gales - droits d'auteur</a>
          <a href="https://twitter.com/keduson_KDS" rel="publisher">Twitter</a>
          <div class="g-plusone" data-size="tall" data-annotation="inline" data-width="230"></div>
          <small style="font-style: oblique;"><?=counter_me(false);?> hits | Page générée en <?=round(load_timer()-$startTime,6)?>s</small>
        </div>
        <div class="footercenter">
          <p align="center">Mots clés populaires<br>
<?php 
    $wclouds = $connect_bdd -> prepare("SELECT DISTINCT(mot),vues FROM wordcloud WHERE trouve=1 ORDER BY vues DESC LIMIT 50");
    $wclouds -> execute();// or die(print_r($wclouds->errorInfo()));
    $getwc = $wclouds -> fetchAll(PDO::FETCH_OBJ);
    $wclouds -> closeCursor();
    foreach ($getwc as $w) {
        echo '<a class="wordcloud" href="'.SEARCH_BASE.'?q='.urlencode(htmlspecialchars($w -> mot)).'&amp;content=search">'.htmlspecialchars($w -> mot).'</a>  | ';
    }
    echo 'keduson.com';//'<a href="'.ROOT_SANS.'/p/top-100"> voir plus</a>';
?>
          </p>
        </div>
      </div>
    </div>
  </footer>
  <script type="text/javascript" src="<?=ROOT_SANS;?>/js/boutons.js"></script>
  <script type="text/javascript" src="<?=ROOT_SANS;?>/detectmobilebrowser.js"></script>
  </body>
</html>