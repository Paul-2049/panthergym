<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<div class="embed-global w-embed" sym="true">
	<style>
		<?php if(get_page_template_slug() !== 'page-templates/calendar.php') { ?>
		html {
			font-size: calc(100vw/1440);
		}
		<?php } ?>

		/* body settings */
		body {
			overflow-x:hidden;
			-webkit-font-smoothing: antialiased;
		}

		<?php if(get_page_template_slug() !== 'page-templates/calendar.php') { ?>
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
