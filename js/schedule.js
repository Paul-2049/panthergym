jQuery(document).ready(function($){
	$(document).on('click', '.schedule_days .item', function(){
		if(!$(this).hasClass('active')) {
			let id = $(this).attr('data-id');
			$('.schedule_days .item').removeClass('active');
			$(this).addClass('active');
			$('.schedule_list .item_list.active').removeClass('active');
			$('.schedule_list .item_list[data-id="'+ id +'"]').addClass('active');
		}
	});

	if($('.schedule_days').length) {
		$('.schedule_days').slick({
			arrows: false,
			infinite: false,
			slidesToShow: 7,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						arrows: true,
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}, {
					breakpoint: 9999,
					settings: "unslick"
				}
			]
		}).on("beforeChange", function (event, slick, currentSlide, nextSlide){
			$('.schedule_days .item:eq('+nextSlide+')').click();
		});
	}

	$(document).on('click', '.schedule_calendar .schedule_list .item', function(){
		let $button = $(this).find('button.booking_shedule');
		$('.gym_shedule_popup [data-step="event_details"] button.next').attr( 'data-id', $button.attr('data-id') );
		$('.gym_shedule_popup [data-step="event_details"] button.next').attr( 'data-date', $button.attr('data-date') );
		$('.gym_shedule_popup [data-step="event_details"] .time').text( $button.attr('data-time') );
		$('.gym_shedule_popup [data-step="event_details"] .duration span').text( $button.attr('data-duration') );
		$('.gym_shedule_popup [data-step="event_details"] .title').text( $button.attr('data-title') );
		$('.gym_shedule_popup [data-step="event_details"] .description').html( $button.attr('data-description') );
		$('.gym_shedule_popup [data-step="event_details"] .location').text( $button.attr('data-location') );
		$('.gym_shedule_popup [data-step="event_details"] .intensity').text( $button.attr('data-intensity') );
		$('.gym_shedule_popup [data-step="event_details"] .instructors').text( $button.attr('data-instructors') );
		$('.gym_shedule_popup [data-step="event_details"] .categories').text( $button.attr('data-categories') );

		$('body').addClass('shedule_popup');
	}).on('click', '.gym_shedule_popup .close', function(){
		$('body').removeClass('shedule_popup');
		if($('.gym_shedule_popup').hasClass('auth')) {
			$('.gym_shedule_popup').removeClass('auth');
		}

		if($('.gym_shedule_popup').hasClass('done')) {
			$('.gym_shedule_popup').removeClass('done');
		}
	}).on('click', '.gym_shedule_popup .next', function(){
		var $buttom = $(this);
		$buttom.attr('disabled', 'disabled');

		let data = {
			'action': 'gym-schedule-booking',
			'event_id': $buttom.attr('data-id'),
			'event_date': $buttom.attr('data-date')
		};

		jQuery.post(ajaxurl, data, function (response) {
			let scroll_to_top = true;
			$buttom.removeAttr('disabled');

			if($('.gym_shedule_popup').hasClass('auth')) {
				$('.gym_shedule_popup').removeClass('auth');
			}

			if($('.gym_shedule_popup').hasClass('done')) {
				$('.gym_shedule_popup').removeClass('done');
			}

			$('.gym_shedule_popup').addClass( response.status );

			if(response.status == 'success') {
				if(!$('.gym_shedule_popup').hasClass('done')) {
					$('.gym_shedule_popup').addClass('done');
				}
			} else if(response.status == 'auth') {
				if(!$('.gym_shedule_popup').hasClass('auth')) {
					$('.gym_shedule_popup').addClass('auth');
				}

				if($('.gym_shedule_popup').hasClass('done')) {
					$('.gym_shedule_popup').removeClass('done');
				}
			} else if(response.status == 'error') {
				$buttom.after('<div class="error">'+ response.message +'</div>')
				$buttom.remove();
				scroll_to_top = false;
			}

			if(scroll_to_top) {
				$('.gym_shedule_popup').animate({
					scrollTop: 0
				}, 300);
			}

		}, 'json');
	}).on('submit', 'form#schedule-login', function(e){
		e.preventDefault();
		let b = true;

		if($('#schedule-login .error').length) $('#schedule-login .error').each(function(){
			$(this).remove();
		});

		if( $('#schedule-login [name="login"]').val() == '' ) {
			$('#schedule-login [name="login"]').closest('label').append('<div class="error">This field is required!</div>')
			b = false;
		}

		if( $('#schedule-login [name="password"]').val() == '' ) {
			$('#schedule-login [name="password"]').closest('label').append('<div class="error">This field is required!</div>')
			b = false;
		}

		if(b == true) {
			var $buttom = $(this).find('button[type="submit"]');
			$buttom.attr('disabled', 'disabled');

			let data = {
				'action': $(this).attr('action'),
				'login': $(this).find('[name="login"]').val(),
				'password': $(this).find('[name="password"]').val(),
				'event_id': $('.gym_shedule_popup [data-step="event_details"] button.next').attr('data-id'),
				'event_date': $('.gym_shedule_popup [data-step="event_details"] button.next').attr('data-date')
			};

			jQuery.post(ajaxurl, data, function (response) {
				$buttom.removeAttr('disabled');

				if(response.hasOwnProperty('errors')) {
					if( response.errors.hasOwnProperty('invalid_username') ) {
						$('#schedule-login [name="login"]').closest('label').append('<div class="error">'+ response.errors.invalid_username[0] +'</div>')
					}

					if( response.errors.hasOwnProperty('incorrect_password') ) {
						$('#schedule-login [name="password"]').closest('label').append('<div class="error">'+ response.errors.incorrect_password[0] +'</div>')
					}
				} else if( response.hasOwnProperty('ID') || response.hasOwnProperty('status') && response.status == 'success' ) {
					if($('.gym_shedule_popup').hasClass('auth')) {
						$('.gym_shedule_popup').removeClass('auth');
					}

					if(!$('.gym_shedule_popup').hasClass('done')) {
						$('.gym_shedule_popup').addClass('done');
					}
				}

				$('.gym_shedule_popup').animate({
					scrollTop: 0
				}, 300);
			}, 'json');
		}
	});
});
