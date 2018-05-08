<?php include('./php/config.php'); ?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
<meta charset="UTF-8" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<!-- <script type="text/javascript">
//<![CDATA[
window.__cfRocketOptions = {byc:0,p:0,petok:"1d65f9509a3f8b81c1bf1e786c30874a051ca439-1522835642-1800"};
//]]>
</script> -->
<!-- <script type="text/javascript" src="https://ajax.cloudflare.com/cdn-cgi/scripts/935cb224/cloudflare-static/rocket.min.js"></script> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?=ROOT_SANS;?>/player/jquery.mCustomScrollbar.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?=ROOT_SANS;?>/player/dark.css" />
<script type="text/javascript" src="<?=ROOT_SANS;?>/player/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="<?=ROOT_SANS;?>/player/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=ROOT_SANS;?>/player/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?=ROOT_SANS;?>/player/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?=ROOT_SANS;?>/player/jsmediatags.min.js"></script>
<script type="text/javascript" src="<?=ROOT_SANS;?>/player/new.js"></script>
<script type="text/javascript">

            var player;  
            jQuery(document).ready(function($){
                
                var settings = {
                    instanceName:"player1",
                    sourcePath:"",
                    playlistList:"#playlist-list",
                    activePlaylist:"playlist-audio2",
                    activeItem:0,
                    volume:0.7,
                    autoPlay:false,
                    preload:"none",
                    randomPlay:false,
                    loopingOn:true,
                    mediaEndAction:"next",
                    usePlaylistScroll:true,
                    playlistScrollOrientation:"vertical",
                    playlistScrollTheme:"light-thin",
                    useKeyboardNavigationForPlayback:true,
                    createDownloadIconsInPlaylist:true,
                    createLinkIconsInPlaylist:true,
                    facebookAppId:"",
                    useNumbersInPlaylist: true,
                    numberTitleSeparator: ".  ",
                    artistTitleSeparator: " - ",
                    sortableTracks: false,
                    playlistItemContent:"title",
                    useMediaSession:true,
                    useStatistics:false,
                    autoOpenPopup:false
                };

                player = $("#wrapper").on('playlistItemDisabled',function(e, data){
                    data.item.addClass('active');
                }).on('playlistItemEnabled',function(e, data){
                    data.item.removeClass('active');
                }).hap(settings);

                //toggle mute
                $('.volume-toggle').on('click', function(){
                    player.toggleMute();
                });

            });

        </script>
</head>
<body>
    <div id="wrapper">
        <div class="player-holder">
            <div class="right-cont">
                <div class="player-controls">
                    <div class="prev-toggle"><i class="fa fa-step-backward icon icon-color"></i></div>
                    <div class="playback-toggle"><i class="fa fa-play icon icon-color"></i></div>
                    <div class="next-toggle"><i class="fa fa-step-forward icon icon-color"></i></div>
                    <div class="volume-wrapper">
                        <div class="volume-toggle"><i class="fa fa-volume-up icon icon-color"></i></div>
                        <div class="volume-seekbar">
                            <div class="volume-bg"></div>
                            <div class="volume-level"></div>
                        </div>
                    </div>
                    <div class="random-toggle" data-tooltip="Aléatoire"><i class="fa fa-random icon icon-color"></i></div>
                    <div class="loop-toggle" data-tooltip="Boucle"><i class="fa fa-refresh icon icon-color"></i></div>
                </div>
                <div class="seekbar">
                    <div class="progress-bg"></div>
                    <div class="load-level"></div>
                    <div class="progress-level"></div>
                </div>
            </div>
        </div>
        <div class="playlist-holder">
            <div class="playlist-filter-msg"><p>Liste vide!</p></div>
            <div class="playlist-inner">
                <div class="playlist-content"></div>
            </div>
            <div class="preloader"></div>
            <div class="bottom-bar">
                <img src="<?=ROOT_SANS;?>/logo-kds.png" img style="position:relative;width: 80px;height: 20px;float:right;margin-right: 10px;">
            </div>
        </div>
        <div class="tooltip"><p></p></div>
    </div>

    <div id="playlist-list">
        <ul id="playlist-audio2">

            <playlist version="1" xmlns="http://xspf.org/ns/0/">
                <title></title>
                <info></info>
                <trackList>
<?php
$piste = $connect_bdd -> prepare("SELECT * FROM musics WHERE artiste=? AND moderation=0 ORDER BY titre ASC");
$piste->execute(array(het($_GET['id'])));
$c = $piste->rowCount();
if($c){
    while($sa = $piste->fetch()) {
        echo '<li class="playlist-item" data-type="audio" data-mp3="http://localhost/musicbox/audio/embeded/'.$sa['nom_fichier'].'" data-download="'.ROOT_SANS.'/tl/'.$sa['code_name'].'" data-title="'.$sa['titre'].' ('.$sa['duree'].')" data-artist="'.$sa['artiste'].'"></li>';
    }
}else{
    echo '<li>Rien à Jouer</li>';
}
$piste->closeCursor();
?>
                </trackList>
            </playlist>
        </ul>
    </div>
</body>
</html>
