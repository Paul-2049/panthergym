<?php
class GYM_HEADER {

	/**
	 * Узнаем, есть ли background в шапке
	 * @return bool
	 */
	public static function hasBgImage():bool {
		if(is_page()) {
			if( !empty( get_field('main')['bg_image'] ) )
				return true;
		}

		return false;
	}
}
