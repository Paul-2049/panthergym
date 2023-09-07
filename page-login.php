<?php
/**
 * Template Name: Login
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
	udesly_get_content_template( 'page' );
endwhile;
// End of the loop.

get_footer();

