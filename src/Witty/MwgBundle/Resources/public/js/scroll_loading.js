/***********
*
* Nécessite la librairie spin.js //fgnass.github.com/spin.js#v1.2.5
* Charge les élémentes spécifiés au scroll down
* Les éléments doivent posséder la classe "scroll_element"
*
************/

var ajax_url = 'blog/post/scroll_loading'; //URL à appeler pour récupérer les nouvelles entrées HTML à afficher

$(document).ready(function() {

		var load = false; // aucun chargement de news n'est en cours
		var load_number = 2;
	
		$(window).scroll(function(){ // On surveille l'évènement scroll
	 
			/* Si l'élément offset est en bas de scroll, si aucun chargement 
			n'est en cours, si le nombre de commentaire affiché est supérieur 
			à 5, alors on lance la fonction. */
			if((($('.scroll_element:last').offset().top + $('.scroll_element:last').height())-$(window).height() <= $(window).scrollTop()) 
			&& load==false /* && ($('.scroll_element').size()>=5) */)
			{
				// la valeur passe à vrai, on va charger
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
					$('#spinning_wheel').remove(); //On enlève la spinning wheel
					if (data != 'end') //Si tous les éléments ont été chargés
					{
						$('.scroll_element:last').parent().append(data); //Ajout des articles récupérés
						offset = $('.scroll_element:last').offset(); //On actualise la valeur offset du dernier commentaire
						load = false; //On remet la valeur à faux pour autoriser les prochains chargements
						load_number = load_number + 1; //Incrémentation du nombre de fois où l'on a chargé des éléments
					}
				});
			}
		});
}); 