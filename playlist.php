<!DOCTYPE html>
<html lang="fr-FR">
<head>
<meta charset="UTF-8" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<script type="text/javascript">
//<![CDATA[
window.__cfRocketOptions = {byc:0,p:0,petok:"1d65f9509a3f8b81c1bf1e786c30874a051ca439-1522835642-1800"};
//]]>
</script>
<script type="text/javascript" src="https://ajax.cloudflare.com/cdn-cgi/scripts/935cb224/cloudflare-static/rocket.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="/player/jquery.mCustomScrollbar.css" media="all" />
<link rel="stylesheet" type="text/css" href="/player/dark.css" />
<script type="text/rocketscript" data-rocketsrc="/player/jquery-1.12.0.min.js"></script>
<script type="text/rocketscript" data-rocketsrc="/player/jquery-ui.min.js"></script>
<script type="text/rocketscript" data-rocketsrc="/player/jquery.ui.touch-punch.min.js"></script>
<script type="text/rocketscript" data-rocketsrc="/player/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/rocketscript" data-rocketsrc="/player/jsmediatags.min.js"></script>
<script type="text/rocketscript" data-rocketsrc="/player/new.js"></script>
<script type="text/rocketscript">

            var player;  
            jQuery(document).ready(function($){
                
                var settings = {
                    instanceName:"player1",
                    sourcePath:"",
                    playlistList:"#playlist-list",
                    activePlaylist:"playlist-audio2",
                    activeItem:0,
                    volume:0.5,
                    autoPlay:true,
                    preload:"auto",
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
                    useNumbersInPlaylist: false,
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
<div class="random-toggle" data-tooltip="Shuffle"><i class="fa fa-random icon icon-color"></i></div>
<div class="loop-toggle" data-tooltip="Loop"><i class="fa fa-refresh icon icon-color"></i></div>
</div>
<div class="seekbar">
<div class="progress-bg"></div>
<div class="load-level"></div>
<div class="progress-level"></div>
</div>
</div>
</div>
<div class="playlist-holder">
<div class="playlist-filter-msg"><p>NOTHING FOUND!</p></div>
<div class="playlist-inner">
<div class="playlist-content"></div>
</div>
<div class="preloader"></div>
<div class="bottom-bar">
<img src="/player/images/logo.png" img style="position:relative;width: 80px;height: 20px;float:right;margin-right: 10px;"></div>
</div>
<div class="tooltip"><p></p></div>
</div>
<div id="playlist-list">
<ul id="playlist-audio2">

<playlist version="1" xmlns="http://xspf.org/ns/0/">
<title></title>
<info></info>
<trackList>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (10).mp3" data-download="/down.php?s_id=9371?view=telecharger" data-title="track (10)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (100).mp3" data-download="/down.php?s_id=9372?view=telecharger" data-title="track (100)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (101).mp3" data-download="/down.php?s_id=9373?view=telecharger" data-title="track (101)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (102).mp3" data-download="/down.php?s_id=9374?view=telecharger" data-title="track (102)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (103).mp3" data-download="/down.php?s_id=9375?view=telecharger" data-title="track (103)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (104).mp3" data-download="/down.php?s_id=9376?view=telecharger" data-title="track (104)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (105).mp3" data-download="/down.php?s_id=9377?view=telecharger" data-title="track (105)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (106).mp3" data-download="/down.php?s_id=9378?view=telecharger" data-title="track (106)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (107).mp3" data-download="/down.php?s_id=9379?view=telecharger" data-title="track (107)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (108).mp3" data-download="/down.php?s_id=9380?view=telecharger" data-title="track (108)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (109).mp3" data-download="/down.php?s_id=9381?view=telecharger" data-title="track (109)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (11).mp3" data-download="/down.php?s_id=9382?view=telecharger" data-title="track (11)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (110).mp3" data-download="/down.php?s_id=9383?view=telecharger" data-title="track (110)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (111).mp3" data-download="/down.php?s_id=9384?view=telecharger" data-title="track (111)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (112).mp3" data-download="/down.php?s_id=9385?view=telecharger" data-title="track (112)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (113).mp3" data-download="/down.php?s_id=9386?view=telecharger" data-title="track (113)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (114).mp3" data-download="/down.php?s_id=9387?view=telecharger" data-title="track (114)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (115).mp3" data-download="/down.php?s_id=9388?view=telecharger" data-title="track (115)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (116).mp3" data-download="/down.php?s_id=9389?view=telecharger" data-title="track (116)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (117).mp3" data-download="/down.php?s_id=9390?view=telecharger" data-title="track (117)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (118).mp3" data-download="/down.php?s_id=9391?view=telecharger" data-title="track (118)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (119).mp3" data-download="/down.php?s_id=9392?view=telecharger" data-title="track (119)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (12).mp3" data-download="/down.php?s_id=9393?view=telecharger" data-title="track (12)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (120).mp3" data-download="/down.php?s_id=9394?view=telecharger" data-title="track (120)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (121).mp3" data-download="/down.php?s_id=9395?view=telecharger" data-title="track (121)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (122).mp3" data-download="/down.php?s_id=9396?view=telecharger" data-title="track (122)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (123).mp3" data-download="/down.php?s_id=9397?view=telecharger" data-title="track (123)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (124).mp3" data-download="/down.php?s_id=9398?view=telecharger" data-title="track (124)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (125).mp3" data-download="/down.php?s_id=9399?view=telecharger" data-title="track (125)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (126).mp3" data-download="/down.php?s_id=9400?view=telecharger" data-title="track (126)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (127).mp3" data-download="/down.php?s_id=9401?view=telecharger" data-title="track (127)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (128).mp3" data-download="/down.php?s_id=9402?view=telecharger" data-title="track (128)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (129).mp3" data-download="/down.php?s_id=9403?view=telecharger" data-title="track (129)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (13).mp3" data-download="/down.php?s_id=9404?view=telecharger" data-title="track (13)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (130).mp3" data-download="/down.php?s_id=9405?view=telecharger" data-title="track (130)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (131).mp3" data-download="/down.php?s_id=9406?view=telecharger" data-title="track (131)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (132).mp3" data-download="/down.php?s_id=9407?view=telecharger" data-title="track (132)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (133).mp3" data-download="/down.php?s_id=9408?view=telecharger" data-title="track (133)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (134).mp3" data-download="/down.php?s_id=9409?view=telecharger" data-title="track (134)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (135).mp3" data-download="/down.php?s_id=9410?view=telecharger" data-title="track (135)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (136).mp3" data-download="/down.php?s_id=9411?view=telecharger" data-title="track (136)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (137).mp3" data-download="/down.php?s_id=9412?view=telecharger" data-title="track (137)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (138).mp3" data-download="/down.php?s_id=9413?view=telecharger" data-title="track (138)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (139).mp3" data-download="/down.php?s_id=9414?view=telecharger" data-title="track (139)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (14).mp3" data-download="/down.php?s_id=9415?view=telecharger" data-title="track (14)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (140).mp3" data-download="/down.php?s_id=9416?view=telecharger" data-title="track (140)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (141).mp3" data-download="/down.php?s_id=9417?view=telecharger" data-title="track (141)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (142).mp3" data-download="/down.php?s_id=9418?view=telecharger" data-title="track (142)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (143).mp3" data-download="/down.php?s_id=9419?view=telecharger" data-title="track (143)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (144).mp3" data-download="/down.php?s_id=9420?view=telecharger" data-title="track (144)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (145).mp3" data-download="/down.php?s_id=9421?view=telecharger" data-title="track (145)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (146).mp3" data-download="/down.php?s_id=9422?view=telecharger" data-title="track (146)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (147).mp3" data-download="/down.php?s_id=9423?view=telecharger" data-title="track (147)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (148).mp3" data-download="/down.php?s_id=9424?view=telecharger" data-title="track (148)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (149).mp3" data-download="/down.php?s_id=9425?view=telecharger" data-title="track (149)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (15).mp3" data-download="/down.php?s_id=9426?view=telecharger" data-title="track (15)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (150).mp3" data-download="/down.php?s_id=9427?view=telecharger" data-title="track (150)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (151).mp3" data-download="/down.php?s_id=9428?view=telecharger" data-title="track (151)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (152).mp3" data-download="/down.php?s_id=9429?view=telecharger" data-title="track (152)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (153).mp3" data-download="/down.php?s_id=9430?view=telecharger" data-title="track (153)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (154).mp3" data-download="/down.php?s_id=9431?view=telecharger" data-title="track (154)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (155).mp3" data-download="/down.php?s_id=9432?view=telecharger" data-title="track (155)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (156).mp3" data-download="/down.php?s_id=9433?view=telecharger" data-title="track (156)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (157).mp3" data-download="/down.php?s_id=9434?view=telecharger" data-title="track (157)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (158).mp3" data-download="/down.php?s_id=9435?view=telecharger" data-title="track (158)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (159).mp3" data-download="/down.php?s_id=9436?view=telecharger" data-title="track (159)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (16).mp3" data-download="/down.php?s_id=9437?view=telecharger" data-title="track (16)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (160).mp3" data-download="/down.php?s_id=9438?view=telecharger" data-title="track (160)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (161).mp3" data-download="/down.php?s_id=9439?view=telecharger" data-title="track (161)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (162).mp3" data-download="/down.php?s_id=9440?view=telecharger" data-title="track (162)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (163).mp3" data-download="/down.php?s_id=9441?view=telecharger" data-title="track (163)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (164).mp3" data-download="/down.php?s_id=9442?view=telecharger" data-title="track (164)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (165).mp3" data-download="/down.php?s_id=9443?view=telecharger" data-title="track (165)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (166).mp3" data-download="/down.php?s_id=9444?view=telecharger" data-title="track (166)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (167).mp3" data-download="/down.php?s_id=9445?view=telecharger" data-title="track (167)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (168).mp3" data-download="/down.php?s_id=9446?view=telecharger" data-title="track (168)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (169).mp3" data-download="/down.php?s_id=9447?view=telecharger" data-title="track (169)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (17).mp3" data-download="/down.php?s_id=9448?view=telecharger" data-title="track (17)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (170).mp3" data-download="/down.php?s_id=9449?view=telecharger" data-title="track (170)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (171).mp3" data-download="/down.php?s_id=9450?view=telecharger" data-title="track (171)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (172).mp3" data-download="/down.php?s_id=9451?view=telecharger" data-title="track (172)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (173).mp3" data-download="/down.php?s_id=9452?view=telecharger" data-title="track (173)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (174).mp3" data-download="/down.php?s_id=9453?view=telecharger" data-title="track (174)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (175).mp3" data-download="/down.php?s_id=9454?view=telecharger" data-title="track (175)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (176).mp3" data-download="/down.php?s_id=9455?view=telecharger" data-title="track (176)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (177).mp3" data-download="/down.php?s_id=9456?view=telecharger" data-title="track (177)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (178).mp3" data-download="/down.php?s_id=9457?view=telecharger" data-title="track (178)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (179).mp3" data-download="/down.php?s_id=9458?view=telecharger" data-title="track (179)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (18).mp3" data-download="/down.php?s_id=9459?view=telecharger" data-title="track (18)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (180).mp3" data-download="/down.php?s_id=9460?view=telecharger" data-title="track (180)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (181).mp3" data-download="/down.php?s_id=9461?view=telecharger" data-title="track (181)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (182).mp3" data-download="/down.php?s_id=9462?view=telecharger" data-title="track (182)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (183).mp3" data-download="/down.php?s_id=9463?view=telecharger" data-title="track (183)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (184).mp3" data-download="/down.php?s_id=9464?view=telecharger" data-title="track (184)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (185).mp3" data-download="/down.php?s_id=9465?view=telecharger" data-title="track (185)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (186).mp3" data-download="/down.php?s_id=9466?view=telecharger" data-title="track (186)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (187).mp3" data-download="/down.php?s_id=9467?view=telecharger" data-title="track (187)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (188).mp3" data-download="/down.php?s_id=9468?view=telecharger" data-title="track (188)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (189).mp3" data-download="/down.php?s_id=9469?view=telecharger" data-title="track (189)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (19).mp3" data-download="/down.php?s_id=9470?view=telecharger" data-title="track (19)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (190).mp3" data-download="/down.php?s_id=9471?view=telecharger" data-title="track (190)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (191).mp3" data-download="/down.php?s_id=9472?view=telecharger" data-title="track (191)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (192).mp3" data-download="/down.php?s_id=9473?view=telecharger" data-title="track (192)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (193).mp3" data-download="/down.php?s_id=9474?view=telecharger" data-title="track (193)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (194).mp3" data-download="/down.php?s_id=9475?view=telecharger" data-title="track (194)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (195).mp3" data-download="/down.php?s_id=9476?view=telecharger" data-title="track (195)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (196).mp3" data-download="/down.php?s_id=9477?view=telecharger" data-title="track (196)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (197).mp3" data-download="/down.php?s_id=9478?view=telecharger" data-title="track (197)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (198).mp3" data-download="/down.php?s_id=9479?view=telecharger" data-title="track (198)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (199).mp3" data-download="/down.php?s_id=9480?view=telecharger" data-title="track (199)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (2).mp3" data-download="/down.php?s_id=9481?view=telecharger" data-title="track (2)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (20).mp3" data-download="/down.php?s_id=9482?view=telecharger" data-title="track (20)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (200).mp3" data-download="/down.php?s_id=9483?view=telecharger" data-title="track (200)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (201).mp3" data-download="/down.php?s_id=9484?view=telecharger" data-title="track (201)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (202).mp3" data-download="/down.php?s_id=9485?view=telecharger" data-title="track (202)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (203).mp3" data-download="/down.php?s_id=9486?view=telecharger" data-title="track (203)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (204).mp3" data-download="/down.php?s_id=9487?view=telecharger" data-title="track (204)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (205).mp3" data-download="/down.php?s_id=9488?view=telecharger" data-title="track (205)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (206).mp3" data-download="/down.php?s_id=9489?view=telecharger" data-title="track (206)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (207).mp3" data-download="/down.php?s_id=9490?view=telecharger" data-title="track (207)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (208).mp3" data-download="/down.php?s_id=9491?view=telecharger" data-title="track (208)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (209).mp3" data-download="/down.php?s_id=9492?view=telecharger" data-title="track (209)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (21).mp3" data-download="/down.php?s_id=9493?view=telecharger" data-title="track (21)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (210).mp3" data-download="/down.php?s_id=9494?view=telecharger" data-title="track (210)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (211).mp3" data-download="/down.php?s_id=9495?view=telecharger" data-title="track (211)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (212).mp3" data-download="/down.php?s_id=9496?view=telecharger" data-title="track (212)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (213).mp3" data-download="/down.php?s_id=9497?view=telecharger" data-title="track (213)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (214).mp3" data-download="/down.php?s_id=9498?view=telecharger" data-title="track (214)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (215).mp3" data-download="/down.php?s_id=9499?view=telecharger" data-title="track (215)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (216).mp3" data-download="/down.php?s_id=9500?view=telecharger" data-title="track (216)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (217).mp3" data-download="/down.php?s_id=9501?view=telecharger" data-title="track (217)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (218).mp3" data-download="/down.php?s_id=9502?view=telecharger" data-title="track (218)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (219).mp3" data-download="/down.php?s_id=9503?view=telecharger" data-title="track (219)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (22).mp3" data-download="/down.php?s_id=9504?view=telecharger" data-title="track (22)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (220).mp3" data-download="/down.php?s_id=9505?view=telecharger" data-title="track (220)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (221).mp3" data-download="/down.php?s_id=9506?view=telecharger" data-title="track (221)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (222).mp3" data-download="/down.php?s_id=9507?view=telecharger" data-title="track (222)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (223).mp3" data-download="/down.php?s_id=9508?view=telecharger" data-title="track (223)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (224).mp3" data-download="/down.php?s_id=9509?view=telecharger" data-title="track (224)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (225).mp3" data-download="/down.php?s_id=9510?view=telecharger" data-title="track (225)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (226).mp3" data-download="/down.php?s_id=9511?view=telecharger" data-title="track (226)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (227).mp3" data-download="/down.php?s_id=9512?view=telecharger" data-title="track (227)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (228).mp3" data-download="/down.php?s_id=9513?view=telecharger" data-title="track (228)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (229).mp3" data-download="/down.php?s_id=9514?view=telecharger" data-title="track (229)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (23).mp3" data-download="/down.php?s_id=9515?view=telecharger" data-title="track (23)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (230).mp3" data-download="/down.php?s_id=9516?view=telecharger" data-title="track (230)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (231).mp3" data-download="/down.php?s_id=9517?view=telecharger" data-title="track (231)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (232).mp3" data-download="/down.php?s_id=9518?view=telecharger" data-title="track (232)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (233).mp3" data-download="/down.php?s_id=9519?view=telecharger" data-title="track (233)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (234).mp3" data-download="/down.php?s_id=9520?view=telecharger" data-title="track (234)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (235).mp3" data-download="/down.php?s_id=9521?view=telecharger" data-title="track (235)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (236).mp3" data-download="/down.php?s_id=9522?view=telecharger" data-title="track (236)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (237).mp3" data-download="/down.php?s_id=9523?view=telecharger" data-title="track (237)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (238).mp3" data-download="/down.php?s_id=9524?view=telecharger" data-title="track (238)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (239).mp3" data-download="/down.php?s_id=9525?view=telecharger" data-title="track (239)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (24).mp3" data-download="/down.php?s_id=9526?view=telecharger" data-title="track (24)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (240).mp3" data-download="/down.php?s_id=9527?view=telecharger" data-title="track (240)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (241).mp3" data-download="/down.php?s_id=9528?view=telecharger" data-title="track (241)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (242).mp3" data-download="/down.php?s_id=9529?view=telecharger" data-title="track (242)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (243).mp3" data-download="/down.php?s_id=9530?view=telecharger" data-title="track (243)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (244).mp3" data-download="/down.php?s_id=9531?view=telecharger" data-title="track (244)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (245).mp3" data-download="/down.php?s_id=9532?view=telecharger" data-title="track (245)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (246).mp3" data-download="/down.php?s_id=9533?view=telecharger" data-title="track (246)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (247).mp3" data-download="/down.php?s_id=9534?view=telecharger" data-title="track (247)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (248).mp3" data-download="/down.php?s_id=9535?view=telecharger" data-title="track (248)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (249).mp3" data-download="/down.php?s_id=9536?view=telecharger" data-title="track (249)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (25).mp3" data-download="/down.php?s_id=9537?view=telecharger" data-title="track (25)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (250).mp3" data-download="/down.php?s_id=9538?view=telecharger" data-title="track (250)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (251).mp3" data-download="/down.php?s_id=9539?view=telecharger" data-title="track (251)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (252).mp3" data-download="/down.php?s_id=9540?view=telecharger" data-title="track (252)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (253).mp3" data-download="/down.php?s_id=9541?view=telecharger" data-title="track (253)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (254).mp3" data-download="/down.php?s_id=9542?view=telecharger" data-title="track (254)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (255).mp3" data-download="/down.php?s_id=9543?view=telecharger" data-title="track (255)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (256).mp3" data-download="/down.php?s_id=9544?view=telecharger" data-title="track (256)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (257).mp3" data-download="/down.php?s_id=9545?view=telecharger" data-title="track (257)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (258).mp3" data-download="/down.php?s_id=9546?view=telecharger" data-title="track (258)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (259).mp3" data-download="/down.php?s_id=9547?view=telecharger" data-title="track (259)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (26).mp3" data-download="/down.php?s_id=9548?view=telecharger" data-title="track (26)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (260).mp3" data-download="/down.php?s_id=9549?view=telecharger" data-title="track (260)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (261).mp3" data-download="/down.php?s_id=9550?view=telecharger" data-title="track (261)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (262).mp3" data-download="/down.php?s_id=9551?view=telecharger" data-title="track (262)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (263).mp3" data-download="/down.php?s_id=9552?view=telecharger" data-title="track (263)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (264).mp3" data-download="/down.php?s_id=9553?view=telecharger" data-title="track (264)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (265).mp3" data-download="/down.php?s_id=9554?view=telecharger" data-title="track (265)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (266).mp3" data-download="/down.php?s_id=9555?view=telecharger" data-title="track (266)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (267).mp3" data-download="/down.php?s_id=9556?view=telecharger" data-title="track (267)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (268).mp3" data-download="/down.php?s_id=9557?view=telecharger" data-title="track (268)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (269).mp3" data-download="/down.php?s_id=9558?view=telecharger" data-title="track (269)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (27).mp3" data-download="/down.php?s_id=9559?view=telecharger" data-title="track (27)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (270).mp3" data-download="/down.php?s_id=9560?view=telecharger" data-title="track (270)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (271).mp3" data-download="/down.php?s_id=9561?view=telecharger" data-title="track (271)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (272).mp3" data-download="/down.php?s_id=9562?view=telecharger" data-title="track (272)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (273).mp3" data-download="/down.php?s_id=9563?view=telecharger" data-title="track (273)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (274).mp3" data-download="/down.php?s_id=9564?view=telecharger" data-title="track (274)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (275).mp3" data-download="/down.php?s_id=9565?view=telecharger" data-title="track (275)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (276).mp3" data-download="/down.php?s_id=9566?view=telecharger" data-title="track (276)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (277).mp3" data-download="/down.php?s_id=9567?view=telecharger" data-title="track (277)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (278).mp3" data-download="/down.php?s_id=9568?view=telecharger" data-title="track (278)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (279).mp3" data-download="/down.php?s_id=9569?view=telecharger" data-title="track (279)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (28).mp3" data-download="/down.php?s_id=9570?view=telecharger" data-title="track (28)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (280).mp3" data-download="/down.php?s_id=9571?view=telecharger" data-title="track (280)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (281).mp3" data-download="/down.php?s_id=9572?view=telecharger" data-title="track (281)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (282).mp3" data-download="/down.php?s_id=9573?view=telecharger" data-title="track (282)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (283).mp3" data-download="/down.php?s_id=9574?view=telecharger" data-title="track (283)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (284).mp3" data-download="/down.php?s_id=9575?view=telecharger" data-title="track (284)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (285).mp3" data-download="/down.php?s_id=9576?view=telecharger" data-title="track (285)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (286).mp3" data-download="/down.php?s_id=9577?view=telecharger" data-title="track (286)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (287).mp3" data-download="/down.php?s_id=9578?view=telecharger" data-title="track (287)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (288).mp3" data-download="/down.php?s_id=9579?view=telecharger" data-title="track (288)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (289).mp3" data-download="/down.php?s_id=9580?view=telecharger" data-title="track (289)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (29).mp3" data-download="/down.php?s_id=9581?view=telecharger" data-title="track (29)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (290).mp3" data-download="/down.php?s_id=9582?view=telecharger" data-title="track (290)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (291).mp3" data-download="/down.php?s_id=9583?view=telecharger" data-title="track (291)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (292).mp3" data-download="/down.php?s_id=9584?view=telecharger" data-title="track (292)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (293).mp3" data-download="/down.php?s_id=9585?view=telecharger" data-title="track (293)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (294).mp3" data-download="/down.php?s_id=9586?view=telecharger" data-title="track (294)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (295).mp3" data-download="/down.php?s_id=9587?view=telecharger" data-title="track (295)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (3).mp3" data-download="/down.php?s_id=9588?view=telecharger" data-title="track (3)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (30).mp3" data-download="/down.php?s_id=9589?view=telecharger" data-title="track (30)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (31).mp3" data-download="/down.php?s_id=9590?view=telecharger" data-title="track (31)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (32).mp3" data-download="/down.php?s_id=9591?view=telecharger" data-title="track (32)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (33).mp3" data-download="/down.php?s_id=9592?view=telecharger" data-title="track (33)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (34).mp3" data-download="/down.php?s_id=9593?view=telecharger" data-title="track (34)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (35).mp3" data-download="/down.php?s_id=9594?view=telecharger" data-title="track (35)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (36).mp3" data-download="/down.php?s_id=9595?view=telecharger" data-title="track (36)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (37).mp3" data-download="/down.php?s_id=9596?view=telecharger" data-title="track (37)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (38).mp3" data-download="/down.php?s_id=9597?view=telecharger" data-title="track (38)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (53).mp3" data-download="/down.php?s_id=9598?view=telecharger" data-title="track (53)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (54).mp3" data-download="/down.php?s_id=9599?view=telecharger" data-title="track (54)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (55).mp3" data-download="/down.php?s_id=9600?view=telecharger" data-title="track (55)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (56).mp3" data-download="/down.php?s_id=9601?view=telecharger" data-title="track (56)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (57).mp3" data-download="/down.php?s_id=9602?view=telecharger" data-title="track (57)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (58).mp3" data-download="/down.php?s_id=9603?view=telecharger" data-title="track (58)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (59).mp3" data-download="/down.php?s_id=9604?view=telecharger" data-title="track (59)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (6).mp3" data-download="/down.php?s_id=9605?view=telecharger" data-title="track (6)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (60).mp3" data-download="/down.php?s_id=9606?view=telecharger" data-title="track (60)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (61).mp3" data-download="/down.php?s_id=9607?view=telecharger" data-title="track (61)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (62).mp3" data-download="/down.php?s_id=9608?view=telecharger" data-title="track (62)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (63).mp3" data-download="/down.php?s_id=9609?view=telecharger" data-title="track (63)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (64).mp3" data-download="/down.php?s_id=9610?view=telecharger" data-title="track (64)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (65).mp3" data-download="/down.php?s_id=9611?view=telecharger" data-title="track (65)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (66).mp3" data-download="/down.php?s_id=9612?view=telecharger" data-title="track (66)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (67).mp3" data-download="/down.php?s_id=9613?view=telecharger" data-title="track (67)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (68).mp3" data-download="/down.php?s_id=9614?view=telecharger" data-title="track (68)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (69).mp3" data-download="/down.php?s_id=9615?view=telecharger" data-title="track (69)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (7).mp3" data-download="/down.php?s_id=9616?view=telecharger" data-title="track (7)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (70).mp3" data-download="/down.php?s_id=9617?view=telecharger" data-title="track (70)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (71).mp3" data-download="/down.php?s_id=9618?view=telecharger" data-title="track (71)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (72).mp3" data-download="/down.php?s_id=9619?view=telecharger" data-title="track (72)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (73).mp3" data-download="/down.php?s_id=9620?view=telecharger" data-title="track (73)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (74).mp3" data-download="/down.php?s_id=9621?view=telecharger" data-title="track (74)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (75).mp3" data-download="/down.php?s_id=9622?view=telecharger" data-title="track (75)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (76).mp3" data-download="/down.php?s_id=9623?view=telecharger" data-title="track (76)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (77).mp3" data-download="/down.php?s_id=9624?view=telecharger" data-title="track (77)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (78).mp3" data-download="/down.php?s_id=9625?view=telecharger" data-title="track (78)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (79).mp3" data-download="/down.php?s_id=9626?view=telecharger" data-title="track (79)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (8).mp3" data-download="/down.php?s_id=9627?view=telecharger" data-title="track (8)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (80).mp3" data-download="/down.php?s_id=9628?view=telecharger" data-title="track (80)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (81).mp3" data-download="/down.php?s_id=9629?view=telecharger" data-title="track (81)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (82).mp3" data-download="/down.php?s_id=9630?view=telecharger" data-title="track (82)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (83).mp3" data-download="/down.php?s_id=9631?view=telecharger" data-title="track (83)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (84).mp3" data-download="/down.php?s_id=9632?view=telecharger" data-title="track (84)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (85).mp3" data-download="/down.php?s_id=9633?view=telecharger" data-title="track (85)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (86).mp3" data-download="/down.php?s_id=9634?view=telecharger" data-title="track (86)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (87).mp3" data-download="/down.php?s_id=9635?view=telecharger" data-title="track (87)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (88).mp3" data-download="/down.php?s_id=9636?view=telecharger" data-title="track (88)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (89).mp3" data-download="/down.php?s_id=9637?view=telecharger" data-title="track (89)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (9).mp3" data-download="/down.php?s_id=9638?view=telecharger" data-title="track (9)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (90).mp3" data-download="/down.php?s_id=9639?view=telecharger" data-title="track (90)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (91).mp3" data-download="/down.php?s_id=9640?view=telecharger" data-title="track (91)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (92).mp3" data-download="/down.php?s_id=9641?view=telecharger" data-title="track (92)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (93).mp3" data-download="/down.php?s_id=9642?view=telecharger" data-title="track (93)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (94).mp3" data-download="/down.php?s_id=9643?view=telecharger" data-title="track (94)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (95).mp3" data-download="/down.php?s_id=9644?view=telecharger" data-title="track (95)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (96).mp3" data-download="/down.php?s_id=9645?view=telecharger" data-title="track (96)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (97).mp3" data-download="/down.php?s_id=9646?view=telecharger" data-title="track (97)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (98).mp3" data-download="/down.php?s_id=9647?view=telecharger" data-title="track (98)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track (99).mp3" data-download="/down.php?s_id=9648?view=telecharger" data-title="track (99)" data- artist="Soundroll" < a>
</li>
<li class="playlist-item" data-type="audio" data-mp3="music/Classique/michel-sardou/track.mp3" data-download="/down.php?s_id=9649?view=telecharger" data-title="track" data- artist="Soundroll" < a>
</li>
</li>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
