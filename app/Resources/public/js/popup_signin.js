// JavaScript Document

$(document).ready(function() {
	
	//Lorsque vous cliquez sur un lien de la classe poplight et que le href commence par #
//$('a.poplight[href^=#]').
$('.popupsignin').click(function() {
	
	var popWidth = 410; //La première valeur du lien

	//Faire apparaitre la pop-up et ajouter le bouton de fermeture
		
	$('#popup2').css({
		'width': popWidth
	});
	$('#popup2').fadeIn();

	//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
	var popMargTop = ($('#popup2').height() + 80) / 2;
	var popMargLeft = ($('#popup2').width() + 80) / 2;

	//On affecte le margin
	$('#popup2').css({
		'margin-top' : -popMargTop,
		'margin-left' : -popMargLeft
	});

	//Effet fade-in du fond opaque
	$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
	//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues de IE
	$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

	return false;
});

//Fermeture de la pop-up et du fond
$('a.close, #fade').live('click', function() { //Au clic sur le bouton ou sur le calque...
	$('#fade , .popup_block2').fadeOut(function() {
		$('#fade').remove();  //...ils disparaissent ensemble
	});
	return false;
});
	
});