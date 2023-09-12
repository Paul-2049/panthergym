jQuery(document).ready(function($){
	$(document).on('click', '.woocommerce-form-login-toggle', function(){
		$('.woocommerce-form-login').slideToggle('slow');
	}).on('click', '.woocommerce-form-login .woocommerce-form-login__submit', function(e){
		e.preventDefault();
		let $buttom = $(this);
		let $login = $buttom.closest('.woocommerce-form-login').find('[name="username"]');
		let $passwd = $buttom.closest('.woocommerce-form-login').find('[name="password"]');
		let $remember = $buttom.closest('.woocommerce-form-login').find('[name="rememberme"]');
		let b = true;

		if($buttom.closest('.woocommerce-form-login').find('.error').length) $buttom.closest('.woocommerce-form-login').find('.error').each(function(){
			$(this).remove();
		});

		if( $login.val() == '' ) {
			$login.after('<div class="error">This field is required!</div>')
			b = false;
		}

		if( $passwd.val() == '' ) {
			$passwd.after('<div class="error">This field is required!</div>')
			b = false;
		}

		if(b == true) {
			$buttom.attr('disabled', 'disabled');

			let data = {
				'action': 'gym-login',
				'login': $login.val(),
				'password': $passwd.val(),
				'remember': $remember.is(':checked') ? true : false,
			};

			jQuery.post(ajaxurl, data, function (response) {
				if(response.hasOwnProperty('errors')) {
					if( response.errors.hasOwnProperty('invalid_username') ) {
						$login.after('<div class="error">'+ response.errors.invalid_username[0] +'</div>');
					}

					if( response.errors.hasOwnProperty('incorrect_password') ) {
						$passwd.after('<div class="error">'+ response.errors.incorrect_password[0] +'</div>');
					}

					$buttom.removeAttr('disabled');
				} else if( response.hasOwnProperty('ID') ) {
					location.reload();
				} else {
					$buttom.removeAttr('disabled');
				}
			}, 'json');
		}
	});

	if($('#billing_postcode').length) {
		$('#billing_postcode, #billing_phone').bind( 'keyup blur', function(){
			var node = $(this);
			node.val(node.val().replace(/[^0-9]/g,'') );
		});
	}
	if($('#shipping_postcode').length) {
		$('#shipping_postcode').bind( 'keyup blur', function(){
			var node = $(this);
			node.val(node.val().replace(/[^0-9]/g,'') );
		});
	}

	$('form.checkout').on('submit', function(e) {
        var valid = true;
        $('.woocommerce-checkout .validate-required input, .woocommerce-checkout .validate-required select, .woocommerce-checkout .validate-required textarea').each(function() {
            var $this = $(this);
            if ($this.val() === '') {
                valid = false;
                $this.addClass('input-error');
                $this.after('<div class="error text-panther-red-100">This field is required!</div>');
            } else {
                $this.removeClass('input-error');
                $this.next('.error.text-panther-red-100').remove();
            }
        });
        if (!valid) {
            e.preventDefault();
        }
    });
});
