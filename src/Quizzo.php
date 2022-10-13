<?php
/**
 * @package Quizzo
 */

namespace Quizzo;

use Exception;

/**
 * Quizzo Class
 */
class Quizzo {
	/**
	 * Instance object constructor.
	 *
	 * @var \Quizzo
	 */
	private static $instance;

	/**
	 * Plugin Instance.
	 *
	 * @return \Quizzo
	 */
	public static function init(): object {
		// Set, if not instantiated
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Activate Plugin.
	 *
	 * @return void
	 */
	public function activate(): void {
		add_action( 'init', [ $this, 'register_post_types' ] );
		add_action( 'add_meta_boxes', [ $this, 'register_meta_boxes' ] );
	}

	/**
	 * Register Post types.
	 *
	 * @return void
	 */
	public function register_post_types(): void {
		try {
			Post\PostFactory::init();
		} catch ( Exception $e ) {
			wp_die( 'Error: Running Post Factory - ' . $e->getMessage() );
		}
	}

	/**
	 * Register Meta boxes.
	 *
	 * @return void
	 */
	public function register_meta_boxes(): void {
		try {
			MetaBox\MetaBoxFactory::init();
		} catch ( Exception $e ) {
			wp_die( 'Error: Running Meta Box Factory - ' . $e->getMessage() );
		}
	}
}
