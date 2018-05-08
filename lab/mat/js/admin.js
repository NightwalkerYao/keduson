$(document).ready(function(){
	//dropdowns
	$(".dropdown-trigger").dropdown({ hover: false });
	//collapsibles
    //$('.collapsible').collapsible();
    var collapsibleElt = document.querySelector('.collapsible.expandable');
	var CEinstance = M.Collapsible.init(collapsibleElt, {
  		accordion: false
	});
	//tooltips
	$('.editable').tooltip({html: "<i class='material-icons right'>edit</i>Cliquez pour editer ce contenu", position: "top", margin: 1});
});