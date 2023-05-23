    	{% block javascript %}
    	<script>
    	//j'attends que le script soit entierement load
    	document.addEventListener('DOMContentLoaded', function() {

    		//selection de l'element HTML qui contient la quantité de product dans le cart
    		const number = document.querySelector('.number-cart');
    		//Selection du btn add-cart pour ajouter produit
    		const button = document.querySelector('.add-cart')

    		//ajout de l evenement click sur btn
    		button.addEventListener('click', function(){
    		//recuperation de l id du boutton
    		const productId = button.dataset.productId;
    		//requete http avec id dans le corp de la requete
    		fetch('/cart/add', {
    			method : 'POST',
    			headers : {
    				'content-Type' : 'application/json'
    			},
    			body: JSON.stringify({
    				productId, productId
    			})
    		})
    		//convertion de l objet recu en JSON
    		then(response => response.json())
    			//on met a jour l'affichage du nombre de produits dans le panier
    		.then(data => {
    				number.innerHTML = data;
    			});
    		});
    	});
    	</script>
    	{% endblock  %}


    	-------------------------------------------------------------------TEST---------------------------------------------------------------------------

		security:
  # https://symfony.com/doc/current/security.html#registering-the-user-hashing-passwords
  password_hashers:
    Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface: "auto"
  # https://symfony.com/doc/current/security.html#loading-the-user-the-user-provider
  providers:
    # used to reload user from session & other features (e.g. switch_user)
    app_user_provider:
      entity:
        class: App\Entity\User
        property: email
  firewalls:
    dev:
      pattern: ^/(_(profiler|wdt)|css|images|js)/
      security: false
    main:
      lazy: true
      provider: app_user_provider
      custom_authenticator: App\Security\LoginFormAuthenticator
            # by default, the feature allows 5 login attempts per minute
      login_throttling: null

      logout:
        path: app_logout
        # where to redirect after logout
        # target: app_any_route

        # activate different ways to authenticate
        # https://symfony.com/doc/current/security.html#the-firewall

        # https://symfony.com/doc/current/security/impersonating_user.html
        # switch_user: true


  # Easy way to control access for large sections of your site
  # Note: Only the *first* access control that matches will be used
  access_control:
    - { path: ^/admin, roles: ROLE_ADMIN }
    - { path: ^/compte, roles: ROLE_USER }
    - { path: ^/commande, roles: ROLE_USER }

when@test:
  security:
    password_hashers:
      # By default, password hashers are resource intensive and take time. This is
      # important to generate secure password hashes. In tests however, secure hashes
      # are not important, waste resources and increase test times. The following
      # reduces the work factor to the lowest possible values.
      Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface:
        algorithm: auto
        cost: 4 # Lowest possible value for bcrypt
        time_cost: 3 # Lowest possible value for argon
        memory_cost: 10 # Lowest possible value for argon