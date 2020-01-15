<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/14/2018
 * Time: 6:05 PM
 */

namespace common\helpers;

class ClientHelper {
	public static $config = array(
		'client_id'               => 'yh5md7vehg2la',
		'client_secret'           => 'BfeuOmRO6h8xwoUmBZvSW0HhKr3UeID1fbOmvAoyTc8',
		'url_server'              => 'http://id.tigerweb.vn',
		'url_auth'                => 'http://id.tigerweb.vn/site/auth-login',
		'url_return'              => 'http://inbox-auto.tigerweb.vn/site/login',
		'url_user_info'           => 'http://127.0.0.1:8080/c2id/userinfo',
		'url_token'               => 'http://127.0.0.1:8080/c2id/token',
		'url_user_info_server'    => 'http://id.tigerweb.vn/connect/user-info',
		'url_access_token_server' => 'http://id.tigerweb.vn/connect/access-token-buff'
	);

	/**
	 * @param $post_data
	 * @param $secret_key
	 *
	 * @return string
	 */
	public static function generate_sig( $post_data, $secret_key ) {
		$text_sig = '';
		foreach ( $post_data as $key => $value ) {
			$text_sig .= '$key=$value';
		}

		$text_sig .= $secret_key;
		$text_sig = md5( $text_sig );

		return $text_sig;
	}
}