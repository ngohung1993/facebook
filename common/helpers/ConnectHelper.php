<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/12/2018
 * Time: 1:36 AM
 */

namespace common\helpers;

use yii\httpclient\Client;

class ConnectHelper {

	/**
	 * @return string
	 */
	public static function generate_url_login() {

		$url_login = ClientHelper::$config['url_auth'];
		$url_login .= '?response_type=code' . '&scope=openid email profile' . '&client_id=' . ClientHelper::$config['client_id'] . '&redirect_uri=' . ClientHelper::$config['url_return'];

		return $url_login;
	}

	/**
	 * @param $quantity
	 *
	 * @return array
	 */
	public static function get_access_token( $quantity ) {
		$access_tokens = [];

		$client = new Client();

		$header = [
			'Content-Type' => 'application/x-www-form-urlencoded'
		];

		$post_data = array(
			'api_key' => ClientHelper::$config['client_id']
		);

		$body = http_build_query( [
			'client_id' => ClientHelper::$config['client_id'],
			'sig'       => ClientHelper::generate_sig( $post_data, ClientHelper::$config['client_secret'] ),
			'quantity'  => $quantity
		] );

		$response = $client->post( ClientHelper::$config['url_access_token_server'], $body, $header )->send();


		if ( $response->isOk ) {
			$access_tokens = $response->data;
		}

		return $access_tokens;
	}

	/**
	 * @param $username
	 *
	 * @return array
	 */
	public static function get_access_token_by_username( $username ) {
		$access_tokens = [];

		$client = new Client();

		$header = [
			'Content-Type' => 'application/x-www-form-urlencoded'
		];

		$post_data = array(
			'api_key'  => ClientHelper::$config['client_id'],
			'username' => $username
		);

		$body = http_build_query( [
			'client_id' => ClientHelper::$config['client_id'],
			'sig'       => ClientHelper::generate_sig( $post_data, ClientHelper::$config['client_secret'] ),
			'username'  => $username
		] );

		$response = $client->post( ClientHelper::$config['url_server'] . '/connect/access-token', $body, $header )->send();

		if ( $response->isOk ) {
			$access_tokens = $response->data;
		}

		return $access_tokens;
	}

}