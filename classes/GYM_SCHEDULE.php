<?php
class GYM_SCHEDULE {
	const SHORTCODE = 'gym_schedule';

	public function __construct() {
		// Подключаем стили и скрипты
		add_action('wp_enqueue_scripts', [ $this, 'enqueue_scripts' ]);

		// Создание шорткода в верху страницы
		add_shortcode(self::SHORTCODE, [ $this, 'shortcode' ]);
	}

	public function enqueue_scripts(){
		wp_enqueue_style( 'gym-schedule', THEME_URL . '/css/schedule.css' );
		wp_enqueue_script( 'gym-schedule', THEME_URL . '/js/schedule.js', ['jquery-core'], false, true );
	}

	public function shortcode( $atts, $shortcode_content = null ) {
		if ( empty($atts) ) return;
		if ( empty($atts['id']) ) return;
		if( !file_exists( THEME_DIR . '/shortcodes/schedule-' . $atts["id"] . '.php' ) ) return;

		ob_start();
		include_once( THEME_DIR . '/shortcodes/schedule-' . $atts["id"] . '.php' );
		$output = ob_get_contents();
		ob_get_clean();

		return $output;
	}

	public static function getEventsForDay( $date ){
		if( empty($date) ) $date = date('Y-m-d');

		global $wpdb;
		$start_from = $date == date('Y-m-d') ? date('Y-m-d H:i') : $date . ' 00:01';
		$events = $wpdb->get_results("
			SELECT 
			    {$wpdb->posts}.*,
			    event_from.meta_value AS 'event_from',
			    event_to.meta_value AS 'event_to'
			FROM {$wpdb->posts}
			LEFT JOIN {$wpdb->postmeta} event_from ON {$wpdb->posts}.ID = event_from.post_id
			LEFT JOIN {$wpdb->postmeta} event_to ON {$wpdb->posts}.ID = event_to.post_id
			WHERE {$wpdb->posts}.post_type = 'tribe_events'
			AND {$wpdb->posts}.post_status = 'publish'
			AND event_from.meta_key = '_EventStartDate'
			AND event_from.meta_value <= '{$start_from}'
		    AND event_to.meta_key = '_EventEndDate'
			AND event_to.meta_value >= '{$date}  23:59'
		");

		return $events;
	}
}

new GYM_SCHEDULE();
