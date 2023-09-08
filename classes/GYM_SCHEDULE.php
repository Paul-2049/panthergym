<?php
class GYM_SCHEDULE {
	const SHORTCODE = 'gym_schedule';

	public function __construct() {
		// Подключаем стили и скрипты
		add_action('wp_enqueue_scripts', [ $this, 'enqueue_scripts' ]);

		// Создание шорткода в верху страницы
		add_shortcode(self::SHORTCODE, [ $this, 'shortcode' ]);

		// Добавляем попап
		add_action('wp_head', [ $this, 'head_scripts' ]);
		add_action('wp_footer', [ $this, 'popup' ]);

		// Ajax - Бронирование
		add_action( 'wp_ajax_gym-schedule-booking', [ $this, 'booking' ] );
		add_action( 'wp_ajax_nopriv_gym-schedule-booking', [ $this, 'booking' ] );

		// Ajax - Аутентификация
		add_action( 'wp_ajax_gym-schedule-login', [ $this, 'login' ] );
		add_action( 'wp_ajax_nopriv_gym-schedule-login', [ $this, 'login' ] );
	}

	public function enqueue_scripts(){
		wp_enqueue_style( 'gym-schedule', THEME_URL . '/css/schedule.css' );
		wp_enqueue_script( 'gym-schedule', THEME_URL . '/js/schedule.js', ['jquery-core'], false, true );
	}

	public function shortcode( $atts, $shortcode_content = null ) {
		if ( empty($atts) ) return;
		if ( empty($atts['id']) ) return;

		if( !empty( $atts["hide"] ) ) {
			if( $atts["hide"] == 'auth' && is_user_logged_in() ) return;
		}

		if( !file_exists( THEME_DIR . '/shortcodes/schedule-' . $atts["id"] . '.php' ) ) return;

		ob_start();
		include_once( THEME_DIR . '/shortcodes/schedule-' . $atts["id"] . '.php' );
		$output = ob_get_contents();
		ob_get_clean();

		return $output;
	}

	public static function getEventsForDay( $date ){
		if( empty($date) ) $date = date('Y-m-d');

		$events = tribe_get_events([
			'start_date' => $date,
			'end_date' => $date . ' 23:59'
		]);

		return $events;
	}

	public function head_scripts(){
		?>
		<script type="text/javascript">
		    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		</script>
		<?php
	}

	public function popup(){
		include_once( THEME_DIR . '/template-parts/schedule-popup.php' );
	}

	public function booking(){
		if ( !is_user_logged_in() ) {
			wp_die( json_encode([
				'status' => 'auth'
			]) );
		}

		if(empty( $_POST['event_id'] )) return;

		// Make booking
		$event_id = $_POST['event_id'];
		$tickets = Tribe__Tickets__Tickets::get_all_event_tickets( $event_id );
		$user = wp_get_current_user();
		$booking = false;
		if( !empty( $tickets ) ) foreach( $tickets as $ticket ) {
			if($ticket->stock() > 0 || $ticket->stock() == -1) {
				$provider = tribe_tickets_get_ticket_provider( $ticket->ID );

				$attendee_data = [
					'title'     => date('Y-m-d H:i'),
					'full_name' => $user->display_name,
					'email'     => $user->user_email,
				];
				$provider->create_attendee( $ticket->ID, $attendee_data );

				$booking = true;
			}
		}

		if( !$booking ) {
			wp_die( json_encode([
				'status' => 'error',
				'message' => 'No free places. Please select a schedule for another time'
			]) );
		}

		wp_die( json_encode([
			'status' => 'success'
		]) );
	}

	public function login() {
		if(empty( $_POST['login'] )) wp_die( json_encode([
			'errors' => [
				'invalid_username' => [ 'This field is required!' ]
			]
		]) );

		if(empty( $_POST['password'] )) wp_die( json_encode([
			'errors' => [
				'incorrect_password' => [ 'This field is required!' ]
			]
		]) );

		if(empty( $_POST['event_id'] ) || empty( $_POST['event_date'] )) wp_die( json_encode([
			'errors' => [
				'invalid_username' => [ 'Error! Please reload page and try again!' ]
			]
		]) );

		$user = wp_authenticate( $_POST['login'], $_POST['password'] );

		if(!is_wp_error($user)) {
			wp_set_auth_cookie($user->ID, true);
			wp_set_current_user( $user->ID );
			$this->booking();
		}

		wp_die( json_encode( $user ) );
	}
}

new GYM_SCHEDULE();
