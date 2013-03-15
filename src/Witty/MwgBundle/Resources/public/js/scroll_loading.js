/***********
*
* N�cessite la librairie spin.js //fgnass.github.com/spin.js#v1.2.5
* Charge les �l�mentes sp�cifi�s au scroll down
* Les �l�ments doivent poss�der la classe "scroll_element"
*
************/

var ajax_url = 'blog/post/scroll_loading'; //URL � appeler pour r�cup�rer les nouvelles entr�es HTML � afficher

$(document).ready(function() {

		var load = false; // aucun chargement de news n'est en cours
		var load_number = 2;
	
		$(window).scroll(function(){ // On surveille l'�v�nement scroll
	 
			/* Si l'�l�ment offset est en bas de scroll, si aucun chargement 
			n'est en cours, si le nombre de commentaire affich� est sup�rieur 
			� 5, alors on lance la fonction. */
			if((($('.scroll_element:last').offset().top + $('.scroll_element:last').height())-$(window).height() <= $(window).scrollTop()) 
			&& load==false /* && ($('.scroll_element').size()>=5) */)
			{
				// la valeur passe � vrai, on va charger
				load = true;

				//On affiche un loader
				var opts = {
					  lines: 11, // The number of lines to draw
					  length: 13, // The length of each line
					  width: 10, // The line thickness
					  radius: 20, // The radius of the inner circle
					  rotate: 0, // The rotation offset
					  color: '#000', // #rgb or #rrggbb
					  speed: 1.7, // Rounds per second
					  trail: 72, // Afterglow percentage
					  shadow: false, // Whether to render a shadow
					  hwaccel: false, // Whether to use hardware acceleration
					  className: 'spinning_wheel', // The CSS class to assign to the spinner
					  zIndex: 2e9, // The z-index (defaults to 2000000000)
					  top: 'auto', // Top position relative to parent in px
					  left: 'auto' // Left position relative to parent in px
					};

				$('.scroll_element:last').parent().append('<div id="spinning_wheel" style="height:'+$('.scroll_element:last').width()/2+'px"></div>');
				var target = document.getElementById('spinning_wheel');
				var spinning_wheel = new Spinner(opts).spin(target);

				//On lance la fonction ajax
				$.post(ajax_url, {'load_number':load_number}, function(data)
				{
					$('#spinning_wheel').remove(); //On enl�ve la spinning wheel
					if (data != 'end') //Si tous les �l�ments ont �t� charg�s
					{
						$('.scroll_element:last').parent().append(data); //Ajout des articles r�cup�r�s
						offset = $('.scroll_element:last').offset(); //On actualise la valeur offset du dernier commentaire
						load = false; //On remet la valeur � faux pour autoriser les prochains chargements
						load_number = load_number + 1; //Incr�mentation du nombre de fois o� l'on a charg� des �l�ments
					}
				});
			}
		});
}); 