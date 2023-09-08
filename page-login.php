<?php
/**
 * Template Name: Login
 */

get_header();

echo do_shortcode(
	'[gym_schedule id="head_bar" hide="auth"]Join now for $0 enrolment on the Ultimate and Performance Memberships! Ends August 31![/gym_schedule]'
);
?>

<section class="account-section">
	<div class="container w-full mx-auto max-w-[1470px] px-[30px] text-center">
		<div class="account-head">
			<?php if(is_user_logged_in()) { ?>
				<div class="qr-code">
					<?php echo do_shortcode('[mepr-show if="loggedin"][kaya_qrcode_dynamic title_align="aligncenter" ecclevel="L" align="aligncenter" css_shadow="1"]https://panthergym.com/staging/member-details/?id=[mepr-account-info field="ID"][/kaya_qrcode_dynamic][/mepr-show]'); ?>
				</div>
			<?php } ?>
			<div class="account-wrap">
				<div class="account-name">
					<?php echo do_shortcode('[mepr-account-info field="first_name"]'); ?>
				</div>
				<p class="welcome-text text-center">
					<?= get_the_title(); ?>
				</p>
			</div>
		</div>
		<div class="account-content">
			<?php the_content(); ?>
		</div>
		<div class="account-block">
			<?php echo do_shortcode('[mepr-login-form]'); ?>
		</div>
	</div>

</section>

<?php
/* Start the Loop */
//while ( have_posts() ) :
//	the_post();
//	udesly_get_content_template( 'page' );
//endwhile;
// End of the loop.

get_footer();

