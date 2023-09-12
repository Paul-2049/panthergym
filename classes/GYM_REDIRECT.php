<?php
class GYM_REDIRECT {
	public function __construct() {
		add_action('wp', [ $this, 'rules' ]);
	}

	public function rules(){
		if( is_account_page() && !is_user_logged_in() )
			wp_redirect( wp_login_url() );
	}
}

new GYM_REDIRECT();
