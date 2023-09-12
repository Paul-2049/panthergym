<?php 
/*
    Template Name: Cart
    Template Post Type: page
*/
?>
<?php

get_header();

udesly_get_content_template( 'template-cart' );

if (function_exists('udesly_output_frontend_editor_data')) {
     udesly_output_frontend_editor_data('template-cart');
}

get_footer();
