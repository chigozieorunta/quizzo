<?php
/**
 * @package Quizzo
 */

namespace Quizzo;

/**
 * Quizzo Class
 */
class Quizzo {
	/**
	 * Instance object constructor
	 *
	 * @var Quizzo
	 */
	private static $instance;

	/**
	 * Plugin Instance
	 *
	 * @return void
	 */
	public static function init() {
		// Set, if not instantiated
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function activate() {
		return 'Nothing';
	}
}
