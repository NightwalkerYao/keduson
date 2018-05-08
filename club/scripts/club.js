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
	//active now
	setInterval(function(){
		$.get('ajax/online.php', function(d){
			$('#activeNow').text('Actifs: '+d.on);
			//alert('got');
		}, 'json');
	},7000);

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
	$.fn.loadContent = function(page){
		var elt = $(this), current_pg = window.location.toString();
		$.get(page).done(function(data){
			elt.html(data);
			window.history.pushState({"html":data,"pageTitle":"Le Club > "+page.replace(".php", "")},"", current_pg.split("#")[0]+"#"+page.replace(".php", ""));
		}).fail(function(err){
			elt.html(
				['<center><aside id="dialogBox" class="avgrund-popup">',
				'<h2>Erreur '+err.status+'</h2>',
				'<p> <em>'+err.statusText+' </em><br>',
				'La page n\'a pas pu être chargée.</p>',
				'<button onclick="javascript:fermerDialog();">Fermer</button>',
				'</aside>',
				'<article class="avgrund-contents">',
				'</article>',
				'<div class="avgrund-cover"></div></center>'
				].join('')
			);
			boite2Dialog("#dialogBox");
		});
	};
	$("#needJS").remove();
	$("header").fadeIn('slow');
	$("#section1").fadeIn('slow');
	$("head").append("<link rel=\"stylesheet\" type=\"text/css\" href=\"style/club.css\">");
	//$("#section1 main").append("<center id=\"await\"></center>"); 
	//$("#await").loadingTriangles("Shoutbox");
	triload();
	var conteneur = $("#section1 main");
	setTimeout(function(){
		conteneur.loadContent('overview.php');
	}, 1000);
	//$(".logo").css("cursor: pointer");
	$(".logo").click(function(){
		triload();
		$("#section1 main").loadContent('overview.php');
	});
	//click to load
	$('.chargeable').each(function(){
		$(this).click(function(){
			var tik = $(this).attr("data-tik"),
			cntnt = $(this).attr("data-content");
			$("#await").remove();
			$("#section1 main").append("<center id=\"await\"></center>");
			$("#await").loadingTriangles(tik);
			setTimeout(function(){
				$("#section1 main").loadContent(cntnt+'.php');
			}, 1000);
			return false;
		});
	});


	
});
