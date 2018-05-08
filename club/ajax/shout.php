<?php require_once "../../php/config.php";
if(!isset($_SESSION['user'])){
	die(json_encode(['success' => false, 'warning' => 'Unknown username']));
}
if(isset($_POST['text'], $_POST['pseudo'])){
	extract($_POST);
	if($pseudo != $_SESSION['user'])
		die(json_encode(['success' => false, 'warning' => 'You can not be two at the same time. Go sleep...']));
	if(trim($text)){
		$send = $connect_bdd -> prepare("INSERT INTO shoutbox(auteur, msg, date_envoi) VALUES(?,?,?)");
		$send -> execute(array($pseudo, $text, time()));
		$send -> closeCursor();
		die(json_encode(['success' => true]));
	}else{
		die(json_encode(['success' => false, 'warning' => 'Le message est vide']));
	}
}elseif(isset($_GET['refresh'])){
	$res = "";
	$getMSG = $connect_bdd -> prepare("SELECT * FROM shoutbox ORDER BY id DESC LIMIT 500");
	$getMSG -> execute();
	$m = $getMSG -> fetchAll(PDO::FETCH_OBJ);
	$getMSG -> closeCursor();
	foreach ($m as $s) {
		$res .= '<tr><td style="width: 20%; border-right: none;"><small>'.date('H:i', $s->date_envoi).'</small> - <strong><a class="view-user" href="#" data-user="'.htmlspecialchars($s->auteur).'">'.htmlspecialchars($s->auteur).'</a></strong> : </td> <td style="border-left: none;"> <span style="font-family: Helvetica; font-size: 11pt; font-style: italic; ">'.htmlspecialchars($s->msg).'</span></td></tr>';
	}

	$profilJs = '<script type="text/javascript">
	$(\'.view-user\').each(function(){
		$(this).click(function(){
			showProfile($(this).attr(\'data-user\'));
			return false;
		});
	});

	function showProfile(user){
		$("#profilBox").remove();
		$.ajax({
			url: \'ajax/profil.php\',
			type: \'get\',
			dataType: \'json\',
			data: {\'user\': user},
			error: function(err){
				$(\'body\').append(
				[\'<center><aside id="profilBox" class="avgrund-popup">\',
				\'<h2>Erreur \'+err.status+\'</h2>\',
				\'<p> <em>\'+err.statusText+\' </em><br>\',
				\'La page n\\\'a pas pu être chargée.</p>\',
				\'<button onclick="javascript:fermerDialog();">Fermer</button>\',
				\'</aside>\',
				\'<article class="avgrund-contents">\',
				\'</article>\',
				\'<div class="avgrund-cover"></div></center>\'
				].join(\'\')
				);
				boite2Dialog("#profilBox");
				},
			success: function(d){
			if(d.success){
				$(\'body\').append(
				[\'<center><aside id="profilBox" class="avgrund-popup">\',
				\'<img src="pics/\'+d.pic+\'" style="width:68px; height:68px; border-radius: 34px;"> <br>\',
				\'<span style="font-size:16pt; font-weight: bold;">\'+d.username+\'</span>\',
				\'<br><small>Membre depuis:</small> \'+d.regdate,
				\'<br><small>Dernier acces:</small> \' +d.lastLog,
				\'<br><button onclick="javascript:fermerDialog();">Fermer</button>\',
				\'</aside>\',
				\'<article class="avgrund-contents">\',
				\'</article>\',
				\'<div class="avgrund-cover"></div></center>\'
				].join(\'\')
				);
				boite2Dialog("#profilBox");
			}else{
				$(\'body\').append(
				[\'<center><aside id="profilBox" class="avgrund-popup">\',
				\'<h2>Erreur </h2>\',
				\'<p> <em>\'+d.warning+\' </em><br>\',
				\'La page n\\\'a pas pu être chargée.</p>\',
				\'<button onclick="javascript:fermerDialog();">Fermer</button>\',
				\'</aside>\',
				\'<article class="avgrund-contents">\',
				\'</article>\',
				\'<div class="avgrund-cover"></div></center>\'
				].join(\'\')
				);
				boite2Dialog("#profilBox");
			}
			}

		});
	}
</script>';
	die(json_encode(['success' => false, 'res' => $res.$profilJs]));
}