<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

$is_schedule = false;
if(is_page()) {
	global $post;
	if($post->post_name === 'schedule') $is_schedule = true;
}

?>

<div class="embed-global w-embed" sym="true">
	<style>
		<?php if(!$is_schedule) { ?>
		html {
			font-size: calc(100vw/1440);
		}
		<?php } ?>

		/* body settings */
		body {
			overflow-x:hidden;
			-webkit-font-smoothing: antialiased;
		}

		<?php if(!$is_schedule) { ?>
		@media only screen and (min-width: 1920px)  {
			html {font-size: calc(100vw/1920);}
		}
		@media only screen and (min-width: 1442px) and (max-width: 1919px)  {
			html {font-size: 0.059vw;}
		}
		@media screen and (min-width: 768px) and (max-width: 991px) {
			html {font-size: calc(100vw/768);}
		}
		@media screen and (min-width: 480px) and (max-width: 767px) {
			html {font-size: calc(100vw/480);}
		}
		@media screen and (max-width: 479px) {
			html {font-size: calc(100vw/375);}
		}
		<?php }?>
	</style>
</div>
