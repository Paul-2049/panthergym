<?php
class GYM_ACCOUNT {
	public function __construct() {
		// Ajax - Аутентификация
		add_action( 'wp_ajax_gym-login', [ $this, 'login' ] );
		add_action( 'wp_ajax_nopriv_gym-login', [ $this, 'login' ] );
	}

	public function login(){
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

		$user = wp_authenticate( $_POST['login'], $_POST['password'] );

		if(!is_wp_error($user)) {
			wp_set_auth_cookie($user->ID, $_POST['remember'] ?? false);
			wp_set_current_user( $user->ID );
		}

		wp_die( json_encode( $user ) );
	}
}

new GYM_ACCOUNT();
