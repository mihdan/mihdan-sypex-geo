<?php
/**
 * Plugin Name: Mihdan: Sypex Geo
 * Description: Интеграция Sypex Geo в WordPress.
 */
namespace Mihdan\SypexGeo;

class Main {
	public function __construct() {
		$this->init_hooks();
	}

	public function init_hooks() {}

	/**
	 * Получить данные из массива SERVER
	 * @param null $key
	 * @param null $default
	 * @return null
	 */
	function get_server( $key = null, $default = null ) {
		if ( null === $key ) {
			return $_SERVER;
		}
		return ( isset( $_SERVER[ $key ] ) ) ? $_SERVER[ $key ] : $default;
	}

	/**
	 * Получить IP адрес клиента
	 * @param boolean $proxy
	 * @return string
	 */
	function get_client_ip( $proxy = true ) {
		// Cloudflare.
		if ( $proxy && $this->get_server( 'HTTP_CF_CONNECTING_IP' ) != null ) {
			$ip = $this->get_server( 'HTTP_CF_CONNECTING_IP' );
		} elseif ( $proxy && $this->get_server( 'HTTP_CLIENT_IP' ) != null ) {
			$ip = $this->get_server( 'HTTP_CLIENT_IP' );
		} elseif ( $proxy && $this->get_server( 'HTTP_X_FORWARDED_FOR' ) != null ) {
			$ip = $this->get_server( 'HTTP_X_FORWARDED_FOR' );
		} else {
			$ip = $this->get_server( 'REMOTE_ADDR' );
		}
		return $ip;
	}
}

static $plugin;

if ( ! isset( $plugin ) ) {
	$plugin = new Main();
}

// eol.
