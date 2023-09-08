<?php

if ( !defined('THEME_DIR')) define('THEME_DIR', __DIR__);
if ( !defined('THEME_URL')) define('THEME_URL', get_stylesheet_directory_uri());

// ACF
include_once THEME_DIR . '/acf/schedule-event.php';

// Подключаем классы
require_once( __DIR__ . '/classes/GYM_ACCOUNT.php');
require_once( __DIR__ . '/classes/GYM_REDIRECT.php');
require_once( __DIR__ . '/classes/GYM_SCHEDULE.php');
require_once( __DIR__ . '/classes/GYM_HEADER.php');

add_action('wp_enqueue_scripts', 'panther_child_css', 1001);
function panther_child_css()
{
	wp_deregister_style('style');
	wp_enqueue_style('styles', get_stylesheet_directory_uri() . '/css/style.min.css');
	wp_enqueue_script('app-js', get_stylesheet_directory_uri() . '/js/app.min.js', array('jquery'), null, true);

	if(is_checkout()) {
		wp_enqueue_style('gym-checkout', THEME_URL . '/css/checkout.css');
		wp_enqueue_script('gym-checkout', THEME_URL . '/js/checkout.js', ['jquery-core'], null, true);
	}
}

register_nav_menus(
	array(
		'soc-menu' => esc_html__('Soc menu'),
	)
);

function veriken_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Footer contact', 'panther-gym'),
			'id'            => 'footer-contact',
			'description'   => esc_html__('Add widgets here.', 'veriken'),
			'before_widget' => false,
			'after_widget'  => false,
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Footer work time', 'panther-gym'),
			'id'            => 'work-time',
			'description'   => esc_html__('Add widgets here.', 'veriken'),
			'before_widget' => false,
			'after_widget'  => false,
		)
	);
}
add_action('widgets_init', 'veriken_widgets_init');

function create_posttype()
{
	register_post_type(
		'trainers',
		array(
			'labels' => array(
				'name' => __('Trainers'),
				'singular_name' => __('trainers')
			),
			'menu_icon'           => 'dashicons-groups',
			'capability_type'     => 'post',
			'public'              => true,
			'hierarchical'        => true,
			'has_archive'         => true,
			'show ui'             => true,
			'query_var'           => true,
			'rewrite'             => true,
			'show_in_rest'        => false,
			'menu_position'       => 3,
			'supports'            => array('thumbnail', 'title'),

		)
	);
}
add_action('init', 'create_posttype');

function my_theme_customizer_setting($wp_customize)
{
	// 
	$wp_customize->add_setting('footer_logo');
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
		'label' => 'Upload Footer Logo',
		'section' => 'title_tagline',
		'settings' => 'footer_logo',
		'priority' => 8
	)));
	// 
	$wp_customize->add_setting('copyright', array(
		'default'        => '© Panther Gym 2023 – All rights reserved',
	));
	$wp_customize->add_control('copyright', array(
		'label'   => 'Copyright text',
		'section' => 'title_tagline',
		'settings' => 'copyright',
		'type'    => 'text',
	));
	// 
	$wp_customize->add_setting('slogan', array(
		'default'        => 'Panther Gym is an Edmonton based Boxing Gym & Training Center. Ready to get in shape and become disciplined? Reach out today or come to one of our walk-in classes.',
	));
	$wp_customize->add_control('slogan', array(
		'label'   => 'Slogan text',
		'section' => 'title_tagline',
		'settings' => 'slogan',
		'type'    => 'text',
	));
}

add_action('customize_register', 'my_theme_customizer_setting');


function add_custom_scripts()
{
	wp_enqueue_script('filter-products', get_stylesheet_directory_uri() . '/js/filter-products.js', array('jquery'), null, true);
	wp_localize_script('filter-products', 'filter_params', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('filter_nonce')
	));
}
add_action('wp_enqueue_scripts', 'add_custom_scripts');

function filter_products()
{
	check_ajax_referer('filter_nonce', 'nonce');

	$category = sanitize_text_field($_POST['category']);
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => -1,
		'product_cat' => $category,
	);

	$query = new WP_Query($args);

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$product = wc_get_product($query->post->ID);
			$regular_price = $product->price;
			$sale_price = $product->sale_price; ?>
			<a href="<?php the_permalink(); ?>" class="product-cart py-[15px] px-[10px] rounded-[6px] hover:shadow-card-shadow transition-all duration-[0.3s] ease-in border-b-[8px] hover:border-panther-red-100 border-transparent">
				<div class="thumbail mb-[16px]">
					<img src="<?php the_post_thumbnail_url(); ?>" alt="">
				</div>
				<div class="category mb-[10px] text-panther-red-100 text-[15px] font-privacy font-bold leading-[1.1]">
					<?php $terms = get_the_terms($post->ID, 'product_cat');
					foreach ($terms as $term) {
						echo  $product_cat = $term->name;
						break;
					} ?>
				</div>
				<div class="title mb-[18px] font-base text-black text-[24px] !font-bold leading-[1.1]">
					<?php the_title(); ?>
				</div>
				<div class="price  text-panther-red-100 text-[15px] font-privacy font-bold leading-[1.1]">
					<?php echo ($sale_price ? '$ ' . $sale_price : '$ ' . $regular_price); ?>
				</div>
			</a>
<?php }
		wp_reset_postdata();
	} else {
		echo 'Not found';
	}
	wp_die();
}
add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');




// add_filter('template_include', 'echo_cur_tplfile', 99);
// function echo_cur_tplfile($template)
// {
//     echo '<span style="color:red">' . wp_basename($template) . '</span>';
//     return $template;
// }


/**
 * Перемещаем форму логина на странице чекаута перед блоком Billing details
 *
 * @snippet       Move Login @ WooCommerce Checkout
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WC 3.5.4
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
add_action( 'woocommerce_checkout_before_customer_details', 'woocommerce_checkout_login_form' );


// Добавляем placeholder для всех полей на странице Checkout
add_filter( 'woocommerce_checkout_fields', function( $fields ) {
	if( !empty($fields) ) foreach ( $fields as $type => $val ) {
		if ( !empty($val) ) foreach ( $val as $key => $attr ) {
			if ( !empty($attr) && ( !array_key_exists('placeholder', $attr ) || empty( $attr['placeholder'] ) ) ) {
				$fields[$type][$key]['placeholder'] = $attr['label'];

				if($type == 'billing' && $key == 'billing_postcode') {
					$fields[$type][$key]['class'][] = 'form-row-first';

					if( ($key_id = array_search('form-row-wide', $fields[$type][$key]['class'])) !== false ) {
						unset( $fields[$type][$key]['class'][$key_id] );
					}
				}

				if($type == 'billing' && $key == 'billing_phone') {
					$fields[$type][$key]['class'][] = 'form-row-last';

					if( ($key_id = array_search('form-row-wide', $fields[$type][$key]['class'])) !== false ) {
						unset( $fields[$type][$key]['class'][$key_id] );
					}
				}
			}
		}
	}

	return $fields;
}, 10, 1 );

/**
 * Update the checkout create an account text
 */
add_filter( 'gettext', function ( $translated_text, $text, $domain ) {

	// if not woocommerce then return
	if ( 'woocommerce' !== $domain ) {
		return $translated_text;
	}

	// check translated text and update
	switch ( $translated_text ) {
		case 'Create an account?' :
			$translated_text = __( 'Checking out as Guest. Crating account?', 'woocommerce' );
			break;
	}
	return $translated_text;

}, 10, 3 );
