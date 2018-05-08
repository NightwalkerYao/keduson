<?php require_once "../php/config.php";
if(!isset($_SESSION['user'])){
	die('Must be logged first.');
}

function temps_passe($debut,$fin) {
	if ($debut==0) {
		return 'en attente';
	}
	if ($debut!=0 ) {
		$fin=time();
		$diff=$fin-$debut;
		if ($diff<0 ) {return 'programmé pour plus tard';
		}
		elseif ($diff<=5) { return 'à l\'instant'; 
		}
		else {
			if ($diff>5 && $diff<=59 ) { return 'il y a '.$diff.' secondes';
			}
			elseif ($diff>59 && $diff<=90 ) { return 'il y a une minute'; 
			}
			elseif ($diff>90 && $diff <=3569 ) { $mins=round($diff/60); return 'il y a '.$mins.' minutes';
			}
			elseif ($diff > 3569 && $diff<=3660 ) { return 'il y a une heure';
			}
			elseif ($diff >3660 && $diff<7140) { $hrs=1; $mins=round(($diff-3600)/60)+1; return 'il y a '.$hrs.' heure '.$mins.' minutes';
			}
			elseif ($diff>=7141 && $diff<=86340) { $hrs=round($diff/3600); return 'il y a '.$hrs.' heures';
			}
			elseif ($diff>86340 && $diff<=169200) { return 'il y a un jour'; 
			}
			elseif ($diff > 169200 && $diff<561600) { $jrs=round($diff/86400); return 'il y a '.$jrs.' jours'; 
			}
			elseif ($diff>=561600 && $diff <=691200) { return 'il y a une semaine '; 
			}
			elseif ($diff>691200 && $diff<=2419200) { $sem=ceil(($diff/86400)/7); return 'il y a '.$sem.' semaines'; 
			}
			elseif ($diff>2419200 && $diff<5184000) {return 'il y a un mois'; 
			}
			elseif ($diff>=5184000 && $diff < 31104000) { $mois=intval($diff/2592000); return 'il y a '.$mois.' mois'; 
			}
			elseif ($diff>=31104000 && $diff <63072000) { return 'il y a un an'; 
			}
			elseif ($diff>=63072000) { $ans=intval($diff/31536000); return 'il y a '.$ans.' ans';
			}
		}
	}
}
 ?>
 <!-- <h1>Shoutbox</h1> -->
<div class="shout-body">
	<form method="post" enctype="multipart/form-data" id="shoutboxform" action="#shoutbox">
		<div>
			<h3>Ici, vous pouvez participer a la discussion</h3>
			<label for="text">Ecrire un message:</label>
			<input type="text" tabindex="1" name="text" id="text" placeholder="Votre message" style="height: 1.99em; border: 2px solid #002D40; font-family: Helvetica,sans-serif; width: 40%; box-sizing: border-box;">
			<!-- <label for="attach" title="Ajouter un fichier" style="background-color: #191815; border-radius: 30%; padding: 1px 6px; cursor: pointer;">&#43;</label>
			<input type="file" name="attach" id="attach" style="display: none; width: 0; height: 0; border: none;"> -->
			<input type="hidden" name="pseudo" value="<?=$_SESSION['user'];?>" id="pseudo">
			<input type="submit" value="Shouter!"><!--  <button onclick="shout('#shoutboxform');" type="button">Do</button> -->
		</div>
	</form>
<script type="text/javascript">
 	//shoutbox
	$("#shoutboxform").submit(function(){
		if($("#text").val() == '' || $("#text").val() == ' ')
			return false;
		var data = $("#shoutboxform").serialize(), formulaire = $("#shoutboxform");
		$("#c1478").remove();
		$.ajax({
			url: 'ajax/shout.php',
			type: 'post',
			dataType: 'json',
			data: data,
			error: function(err){
				alert("Erreur "+err.status+" : "+err.statusText);
			},
			success: function(res){
				if(res.success){
					var auj = new Date(), ii,ss;
				    ii = auj.getMinutes();
				    ii = (ii<10 ? '0'+ii : ii);
				    hh = auj.getHours();
				    hh = (hh<10 ? '0'+hh : hh);
					$("#t2358").prepend('<tr><td style="width: 20%; border-right: none;"><small>'+hh+':'+ii+'</small> - <strong><a href="#">'+$("#pseudo").val()+'</a></strong> : </td> <td style="border-left: none;"> <span style="font-family: Helvetica; font-size: 11pt; font-style: italic; ">'+$("#text").val()+'</span></td></tr>');
					$("#text").val('');
				}else{
					alert("Erreur: "+res.warning);
				}
			}
		});
		return false;
	});

	//autorefresh
	setInterval(function(){
		$.get('ajax/shout.php',{'refresh':1,'get':'all'}, function(res){
			$('#t2358').html(res.res);
		}, 'json');
	}, 3000);
 </script>
	<div class="carton diven">
		<div id="msg_list" align="left;">
<?php
$getMSG = $connect_bdd -> prepare("SELECT * FROM shoutbox ORDER BY id DESC LIMIT 500");
$getMSG -> execute();
$m = $getMSG -> fetchAll(PDO::FETCH_OBJ);
$getMSG -> closeCursor();
echo "<table id=\"t2358\">";
foreach ($m as $s) {
	echo '<tr><td style="width: 20%; border-right: none;"><small>'.date('H:i', $s->date_envoi).'</small> - <strong><a href="#">'.htmlspecialchars($s->auteur).'</a></strong> : </td> <td style="border-left: none;"> <span style="font-family: Helvetica; font-size: 11pt; font-style: italic; ">'.htmlspecialchars($s->msg).'</span></td></tr>';
}
echo "</table>";
?>

		</div>
		<!-- <div style="position: relative; clear: both;">
			<aside style="position: absolute; top: 0;">
			<h3>Utilisateur actifs</h3>
			5545454<br>
			hjgewrb<br>
			hfvh77
			</aside>
		</div> -->
	</div>
</div>