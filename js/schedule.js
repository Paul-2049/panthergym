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
});
