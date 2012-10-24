$(document).ready(function() {

			
			
			//Si l'utilisateur clique sur une question, elle s'ouvre
			 $('.faq_title_1').toggle(function faq_title_open(){
					var title = $(this);
					$(title).css('color','#4270BE');
					var title_paragraph = $(title).parent('.faq_p');
					var title_under_paragraph = $(title_paragraph).children('.faq_2');
					$(title_under_paragraph).slideDown('normal');
					return false;
				},
				function faq_title_close(){
					var title = $(this);
					$(title).css('color','#514846');
					var title_paragraph = $(title).parent('.faq_p');
					var title_under_paragraph = $(title_paragraph).children('.faq_2');
					$(title_under_paragraph).slideUp('normal');
					return false;
				}
			); 		
			
			 $('.faq_title_2').toggle(
				function faq_title_open(){
					var title = $(this);
					$(title).css('color','#4270BE');
					var title_paragraph = $(title).parent('.faq_2_p');
					var title_under_paragraph = $(title_paragraph).children('.faq_3');
					$(title_under_paragraph).slideDown('normal');
					return false;
				}, 
				function faq_title_close(){
					var title = $(this);
					$(title).css('color','#514846');
					var title_paragraph = $(title).parent('.faq_2_p');
					var title_under_paragraph = $(title_paragraph).children('.faq_3');
					$(title_under_paragraph).slideUp('normal');
					return false;
				}
			); 

						
			//Toutes les questions sont fermées par défaut
			$('.faq_3').slideUp('normal');
			$('.faq_2').slideUp('normal');
			$('.faq_title_1').css('color','#514846');
}); 