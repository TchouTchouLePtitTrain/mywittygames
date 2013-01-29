// JavaScript Document


/*

$(document).ready(function() {
			$('#onglets li').click(function(event) {
				
				var actuel = event.target;				

				
				//Apparition du contenu des onglets
				$(actuel).addClass('actif').siblings().removeClass('actif'); //Ajout de la classe "actif" au titre de l'onglet sélectionné. Suppression de cette classe "actif" pour les autres titres
				
				
				//Déplacement de la flèche
				$('.flecheMenu').css('margin-left', //Détermination de la valeur de margin à mettre pour la flèche
					($('ul#onglets li[class="actif"]').position().left //Base : Nombre de pixels depuis bord de l'écran jusqu'au coin supérieur gauche de l'élément cliqué
					- $('ul#onglets li').first().position().left //Soustraction de cette même valeur mais pour le premier titre (pour obtenir la différence en pixels entre le premier titre et le titre cliqué)
					+ Math.round($('ul#onglets li[class="actif"]').first().innerWidth() / 2) //Ajout de la moitié de la longueur du titre pour centrer la flèche sous le titre
					+ 1) 
					+ 'px'); 
								
				setDisplay();
			});
			function setDisplay() {
				var modeAffichage;
				$('#onglets li').each(function(rang) {
					modeAffichage = $(this).hasClass('actif') ? 'block' : 'none';
					$('.item').eq(rang).css('display', modeAffichage);
				});
			}
			setDisplay();
		
});


*/