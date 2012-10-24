{# Authentification Facebook #}

// $(document).ready(function() {
    // Core.facebookInitialize();
// }); 

// var Core = { 
    // /**
     // * Initialize facebook related things. This function will subscribe to the auth.login
     // * facebook event. When the event is raised, the function will redirect the user to
     // * the login check path.
     // */
    // facebookInitialize = function() {
        // FB.Event.subscribe('auth.login', function(response) {
            // Core.performLoginCheck();
        // });
    // };

    // /**
     // * Redirect user to the login check path.
     // */
    // performLoginCheck = function() {
        // window.location = "http://localhost/app_dev.php/login_check";
    // }
// }



{# Clic sur élément de type facebook_button #}
window.fbAsyncInit = function() {
    FB.init({
        appId   : '212621892102168',
        oauth   : true,
        status  : true, // check login status
        cookie  : true, // enable cookies to allow the server to access the session
        xfbml   : true // parse XFBML
    });

  };

function fb_login(){
    FB.login(function(response) {

        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID

            FB.api('/me', function(response) {
                user_email = response.email; //get user email
				
				//Authentification de l'user sur le site
				
          // you can store this data into your database             
            });

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'publish_stream,email'
    });
}
(function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
}());



			
{# Script pour gérer la réponse de facebook à l authentification #}
function goLogIn(){
  window.location = "{{ path('_security_check') }}";
}

function onFbInit() {
  if (typeof(FB) != 'undefined' && FB != null ) {
	  FB.Event.subscribe('auth.statusChange', function(response) {
		  setTimeout(goLogIn, 500);
	  });
  }
}