var Avgrund = (function(){

	var container = document.documentElement,
		popup = document.querySelector( '.avgrund-popup-animate' ),
		cover = document.querySelector( '.avgrund-cover' ),
		currentState = null;

	container.className = container.className.replace( /\s+$/gi, '' ) + ' avgrund-ready';

	// Deactivate on ESC
	function onDocumentKeyUp( event ) {
		if( event.keyCode === 27 ) {
			deactivate();
		}
	}

	// Deactivate on click outside
	function onDocumentClick( event ) {
		if( event.target === cover ) {
			deactivate();
		}
	}

	function activate( state ) {
		document.addEventListener( 'keyup', onDocumentKeyUp, false );
		document.addEventListener( 'click', onDocumentClick, false );
		document.addEventListener( 'touchstart', onDocumentClick, false );

		removeClass( popup, currentState );
		addClass( popup, 'no-transition' );
		addClass( popup, state );

		setTimeout( function() {
			removeClass( popup, 'no-transition' );
			addClass( container, 'avgrund-active' );
		}, 0 );

		currentState = state;
	}

	function deactivate() {
		document.removeEventListener( 'keyup', onDocumentKeyUp, false );
		document.removeEventListener( 'click', onDocumentClick, false );
		document.removeEventListener( 'touchstart', onDocumentClick, false );

		removeClass( container, 'avgrund-active' );
		removeClass( popup, 'avgrund-popup-animate')
	}

	function disableBlur() {
		addClass( document.documentElement, 'no-blur' );
	}

	function addClass( element, name ) {
		element.className = element.className.replace( /\s+$/gi, '' ) + ' ' + name;
	}

	function removeClass( element, name ) {
		element.className = element.className.replace( name, '' );
	}

	function show(selector){
		popup = document.querySelector( selector );
		addClass(popup, 'avgrund-popup-animate');
		activate();
		return this;
	}
	function hide() {
		deactivate();
	}

	return {
		activate: activate,
		deactivate: deactivate,
		disableBlur: disableBlur,
		show: show,
		hide: hide
	}

})();

function boite2Dialog(elt){Avgrund.show(elt);}
function fermerDialog(){Avgrund.hide();}
function triload(){
	$("#section1 main").append("<center id=\"await\"></center>"); 
	$("#await").loadingTriangles("Shoutbox");
}

$(document).ready(function(){
	var delai = 2300;
	$.fn.loadingTriangles = function(text){
		this.html(
		['<div id="triloadContainer"><div id="b" class="cssload-triangles">',
		'<div class="cssload-tri cssload-invert"></div>',
		'<div class="cssload-tri cssload-invert"></div>',
		'<div class="cssload-tri"></div>',
		'<div class="cssload-tri cssload-invert"></div>',
		'<div class="cssload-tri cssload-invert"></div>',
		'<div class="cssload-tri"></div>',
		'<div class="cssload-tri cssload-invert"></div>',
		'<div class="cssload-tri"></div>',
		'<div class="cssload-tri cssload-invert"></div>',
		'<br />',
		'<br />',
		'<br />',
		'<br />',
		'<p id="load">'+text+'</p>',
		'</div></div>'].join('')
		);
	};

	$("head").append("<link rel=\"stylesheet\" type=\"text/css\" href=\"style/club.css\">");
	$("head").append('<link rel="stylesheet" type="text/css" href="style/avgrund.css">');
	$(".inscription").hide();
	$(".mdpoublie").hide();
	$(".toregister").click(function(){
		$(".connexion").hide();
		$(".mdpoublie").hide();
		$(".inscription").fadeIn(2000);
		return false;
	});
	$(".toconnect").click(function(){
		$(".inscription").hide();
		$(".mdpoublie").hide();
		$(".connexion").fadeIn(2000);
		return false;
	});
	$(".tomdpoublie").click(function(){
		$(".connexion").hide();
		$(".inscription").hide();
		$(".mdpoublie").fadeIn(2000);
	});

	$(".connexion").submit(function(e){
		e.preventDefault();
		$("#conerror").remove();
		$(".connexion").before("<center id=\"conerror\"></center>");
		var errs = 0, login = $("#login"), password = $("#password"), data = $(this).serialize();
		if((login.val() == "") || (login.val() == " ") || (login.val().length < 4)){
			errs++;
			$("#conerror").append("<li>Votre Login est invalide.</li>");
		}

		if(password.val().length < 6){
			errs++;
			$("#conerror").append("<li>Votre mdp est trop court.</li>");
		}

		if(errs == 0){
			$("#avg").loadingTriangles('Connexion');
			setTimeout(function(){
			$.ajax({
				url: "ajax/login.php",
				data: data,
				type: 'post',
				dataType: 'json',
				success: function(res){
					//console.log(res);
					if(res.connected){
						$("#avg").html(
							['<center><aside id="dialogBox" class="avgrund-popup">',
							'<h2>Parfait !</h2>',
							'<p> <em>Vous êtes bien connecté. </em><br>',
							'Redirection en cours...</p>',
							'<button onclick="javascript:fermerDialog();">Fermer</button>',
							'</aside>',
							'<article class="avgrund-contents">',
							'</article>',
							'<div class="avgrund-cover"></div></center>'
							].join('')
						);
						boite2Dialog("#dialogBox");
						setTimeout(function(){
							window.location = "./";
						}, delai);
					}else{
						$("#avg").html(
							['<center><aside id="dialogBox" class="avgrund-popup">',
							'<h2>Erreur</h2>',
							'<p> <em>La connexion a échoué</em><br>',
							' '+res.warning+'</p>',
							'<button onclick="javascript:fermerDialog();">Fermer</button>',
							'</aside>',
							'<article class="avgrund-contents">',
							'</article>',
							'<div class="avgrund-cover"></div></center>'
							].join('')
						);
						boite2Dialog("#dialogBox");
					}
				},
				error: function(err){
					$("#avg").html(
						['<center><aside id="dialogBox" class="avgrund-popup">',
						'<h2>Erreur '+err.status+'</h2>',
						'<p> <em>'+err.statusText+' </em><br>',
						'Tentative de connexion erronée.</p>',
						'<button onclick="javascript:fermerDialog();">Fermer</button>',
						'</aside>',
						'<article class="avgrund-contents">',
						'</article>',
						'<div class="avgrund-cover"></div></center>'
						].join('')
					);
					boite2Dialog("#dialogBox");
				}
			});
		}, delai); //end of time out
		}else{
			$(document).scrollTop($("#conerror").offset().top-20);
		}
	});

	//on pwd reset
	$(".mdpoublie").submit(function(e){
		e.preventDefault();
		$("#conerror").remove();
		$(".mdpoublie").before("<center id=\"conerror\"></center>");
		var errs = 0, mail = $("#mmail").val(), data = $(this).serialize(), 
		mfornat = /^[a-zA-Z0-9\.\+\-]+@[a-zA-Z0-9\.\-]{2,}\.[a-zA-Z0-9]{2,15}$/;
		if(mfornat.test(mail)){
			$("#avg").loadingTriangles('Chargement');
			setTimeout(function(){
				$.ajax({
					url:'ajax/recovery.php',
					dataType: 'json',
					data: data,
					type: 'post',
					success: function(res){
						if(res.success){
							$("#avg").html(
							['<center><aside id="dialogBox" class="avgrund-popup">',
							'<h2>Parfait !</h2>',
							'<p> <em>Un lien vous a été envoyé. </em><br>',
							'Utilisez-le pour changer de mdp</p>',
							'<button onclick="javascript:fermerDialog();">Fermer</button>',
							'</aside>',
							'<article class="avgrund-contents">',
							'</article>',
							'<div class="avgrund-cover"></div></center>'
							].join('')
							);
							boite2Dialog("#dialogBox");
						}else{
							$("#avg").html(
							['<center><aside id="dialogBox" class="avgrund-popup">',
							'<h2>Erreur</h2>',
							'<p> <em>une erreur s\'est produite.</em><br>',
							' '+res.warning+'</p>',
							'<button onclick="javascript:fermerDialog();">Fermer</button>',
							'</aside>',
							'<article class="avgrund-contents">',
							'</article>',
							'<div class="avgrund-cover"></div></center>'
							].join('')
							);
							boite2Dialog("#dialogBox");
						}
					},
					error: function(err){
						$("#avg").html(
						['<center><aside id="dialogBox" class="avgrund-popup">',
						'<h2>Erreur '+err.status+'</h2>',
						'<p> <em>'+err.statusText+' </em><br>',
						'Tentative de connexion erronée.</p>',
						'<button onclick="javascript:fermerDialog();">Fermer</button>',
						'</aside>',
						'<article class="avgrund-contents">',
						'</article>',
						'<div class="avgrund-cover"></div></center>'
						].join('')
						);
						boite2Dialog("#dialogBox");
					}
				});
			}, delai);
		}else{
			$("#avg").html(
				['<center><aside id="dialogBox" class="avgrund-popup">',
				'<h2>Erreur</h2>',
				'<p> <em>La saisie contient des erreurs </em><br>',
				'L\'adresse e-mail est invalide.</p>',
				'<button onclick="javascript:fermerDialog();">Fermer</button>',
				'</aside>',
				'<article class="avgrund-contents">',
				'</article>',
				'<div class="avgrund-cover"></div></center>'
				].join('')
			);
			boite2Dialog("#dialogBox");
		}
			
	});

	//upload a pic
	var PicField = document.getElementById('pic'),
		PicLab = $("label[for=pic]");
	PicField.addEventListener('change', function(){
		var imgExts = ['jpg','jpeg','png','gif'], 
		pochette = PicField.files[0],
		photoExt = pochette.name.split('.')[pochette.name.split('.').length-1].toLowerCase();
        if(imgExts.indexOf(photoExt) != -1){
            var lire = new FileReader();
            lire.onload = function(){
             	$('#zzimd').remove();
                PicLab.after('<div id="zzimd"> <br> <img id="zzim" width="50%" src="'+lire.result+'" /> <div id="cover-prog-frame" style="width:50%; height:7px; border: 0; background-color: #1B72CA;"><div id="cover-up-progress"></div></div></div>');
                                    
                var up_photo = new FormData();
                up_photo.append('av', pochette);
                                    
                $.ajax({
                    url: './ajax/upload.php',
                    xhr: function(){
                    	var cxhr = new XMLHttpRequest();
                    	var csize = pochette.size;
                        cxhr.upload.addEventListener('progress', function(c){
                            cloaded = Math.round((c.loaded/csize)*100);
                            $("#cover-up-progress").width(cloaded+'%');
                        });
                        return cxhr;
                    },
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data: up_photo,
                    dataType: 'json',
                    success: function(cu){
                    	if(cu.end == 'success'){ // cover uploaded
                            $("#avatar").val(cu.path);
                            $("#cover-prog-frame").remove();
                        }else{
	                        $("#avg").html(
								['<center><aside id="dialogBox" class="avgrund-popup">',
								'<h2>Erreur</h2>',
								'<p> <em>L\'image n\'a pas été soumise </em><br>',
								' '+cu.message+'</p>',
								'<button onclick="javascript:fermerDialog();">Fermer</button>',
								'</aside>',
								'<article class="avgrund-contents">',
								'</article>',
								'<div class="avgrund-cover"></div></center>'
								].join('')
							);
							boite2Dialog("#dialogBox");
                        }
                    },
                    error: function(err){
                    	$("#avg").html(
								['<center><aside id="dialogBox" class="avgrund-popup">',
								'<h2>Erreur '+err.status+'</h2>',
								'<p> <em>'+err.statusText+'</em><br>',
								' L\'image n\'a pas été soumise.</p>',
								'<button onclick="javascript:fermerDialog();">Fermer</button>',
								'</aside>',
								'<article class="avgrund-contents">',
								'</article>',
								'<div class="avgrund-cover"></div></center>'
								].join('')
							);
							boite2Dialog("#dialogBox");
                    }
                });
            };
            lire.readAsDataURL(pochette);
        }else{
            $("#avg").html(
				['<center><aside id="dialogBox" class="avgrund-popup">',
				'<h2>Erreur</h2>',
				'<p> <em>La saisie contient des erreurs </em><br>',
				'Le fichier sélectionné n\'est pas une image valide.</p>',
				'<button onclick="javascript:fermerDialog();">Fermer</button>',
				'</aside>',
				'<article class="avgrund-contents">',
				'</article>',
				'<div class="avgrund-cover"></div></center>'
				].join('')
			);
			boite2Dialog("#dialogBox");
        }
    }, false);
	

	//on inscription
	$(".inscription").submit(function(e){
		e.preventDefault();
		$("#conerror").remove();
		$(".mdpoublie").before("<center id=\"conerror\"></center>");
		var errs = 0,
		erLog = $('#conerror');
		Login = $('#slogin').val(),
		Pass1 = $("#spassword1").val(),
		Pass2 = $("#spassword2").val(),
		Mail = $("#smail").val(),
		Avatar = $("#avatar").val(),
		mailfornat = /^[a-zA-Z0-9\.\+\-]+@[a-zA-Z0-9\.\-]{2,}\.[a-zA-Z0-9]{2,12}$/,
		pseudoFormat = /^[a-zA-Z0-9\._\-]{3,}$/;
		if(Login.length<3){
			erLog.append('<li>Le pseudo est trop court</li>');
			errs++;
		}
		if(!pseudoFormat.test(Login)){
			erLog.append('<li> Le pseudo est invalide.</li>');
			errs++;
		}
		if(Pass1.length < 6){
			erLog.append('<li>Le mot de passe est trop court; min. 6 caracteres.</li>');
			errs++;
		}
		if(Pass1 != Pass2){
			erLog.append('<li>Le mot de passe et sa confirmation ne correspondent pas.</li>');
			errs++;
		}
		if(!mailfornat.test(Mail)){
			erLog.append('<li>L\'adresse mail n\'est pas valide.</li>');
			errs++;
		}

		if(errs == 0){
			//no major error
			var data = {"login": Login, "pass": Pass1, "mail": Mail, "avatar": Avatar};
			$("#avg").loadingTriangles('Inscription');
			setTimeout(function(){
			$.ajax({
				url: 'ajax/register.php',
				type: 'post',
				dataType: 'json',
				data: data,
				success: function(res){
					if(res.success){
						$("#avg").loadingTriangles('Connexion');
						setTimeout(function(){
							var creds = {"login": Login, "password": Pass1};
							$.ajax({
								url: "ajax/login.php",
								data: creds,
								type: 'post',
								dataType: 'json',
								success: function(res){
									//console.log(res);
									if(res.connected){
										$("#avg").html(
											['<center><aside id="dialogBox" class="avgrund-popup">',
											'<h2>Parfait !</h2>',
											'<p> <em>Vous êtes bien connecté. </em><br>',
											'Redirection en cours...</p>',
											'<button onclick="javascript:fermerDialog();">Fermer</button>',
											'</aside>',
											'<article class="avgrund-contents">',
											'</article>',
											'<div class="avgrund-cover"></div></center>'
											].join('')
										);
										boite2Dialog("#dialogBox");
										setTimeout(function(){
											window.location = "./";
										}, delai);
									}else{
										$("#avg").html(
											['<center><aside id="dialogBox" class="avgrund-popup">',
											'<h2>Erreur</h2>',
											'<p> <em>La connexion a échoué</em><br>',
											' '+res.warning+'</p>',
											'<button onclick="javascript:fermerDialog();">Fermer</button>',
											'</aside>',
											'<article class="avgrund-contents">',
											'</article>',
											'<div class="avgrund-cover"></div></center>'
											].join('')
										);
										boite2Dialog("#dialogBox");
									}
								},
								error: function(err){
									$("#avg").html(
										['<center><aside id="dialogBox" class="avgrund-popup">',
										'<h2>Erreur '+err.status+'</h2>',
										'<p> <em>'+err.statusText+' </em><br>',
										'Tentative de connexion erronée.</p>',
										'<button onclick="javascript:fermerDialog();">Fermer</button>',
										'</aside>',
										'<article class="avgrund-contents">',
										'</article>',
										'<div class="avgrund-cover"></div></center>'
										].join('')
									);
									boite2Dialog("#dialogBox");
								}
							});
						},delai);
					}else{
						$("#avg").html(
						['<center><aside id="dialogBox" class="avgrund-popup">',
						'<h2>Erreur</h2>',
						'<p> <em>Une erreur s\'est produite</em><br>',
						' '+res.warning+'</p>',
						'<button onclick="javascript:fermerDialog();">Fermer</button>',
						'</aside>',
						'<article class="avgrund-contents">',
						'</article>',
						'<div class="avgrund-cover"></div></center>'
						].join('')
					);
					boite2Dialog("#dialogBox");
					}
				},
				error: function(err){
					$("#avg").html(
						['<center><aside id="dialogBox" class="avgrund-popup">',
						'<h2>Erreur '+err.status+'</h2>',
						'<p> <em>'+err.statusText+'</em><br>',
						'Une erreur s\'est produite. Veillez reessayer.</p>',
						'<button onclick="javascript:fermerDialog();">Fermer</button>',
						'</aside>',
						'<article class="avgrund-contents">',
						'</article>',
						'<div class="avgrund-cover"></div></center>'
						].join('')
					);
					boite2Dialog("#dialogBox");
				}
			});
		}, delai);
		}else{
			$(document).scrollTop(erLog.offset().top - 60);
		}
	});
});