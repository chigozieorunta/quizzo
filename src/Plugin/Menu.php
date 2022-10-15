<?php
/**
 * @package Quizzo
 */

namespace Quizzo\Plugin;

/**
 * Menu Class
 */
class Menu {
	/**
	 * Menu Instance.
	 *
	 * @var \Menu
	 */
	private static $instance;

	/**
	 * Get instance of Class (Singleton).
	 *
	 * @return \Menu
	 */
	public static function get_instance(): object {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Set up Menu.
	 *
	 * @return void
	 */
	public function init(): void {
		// Parent Menu
		add_menu_page(
			__( PLUGIN_NAME, PLUGIN_DOMAIN ),
			__( PLUGIN_NAME, PLUGIN_DOMAIN ),
			PLUGIN_ROLE,
			PLUGIN_SLUG,
			false,
			'dashicons-edit-page',
			99
		);

		// Dashboard Sub Menu
		add_submenu_page(
			PLUGIN_SLUG,
			__( PLUGIN_NAME, PLUGIN_DOMAIN ),
			__( 'Dashboard', PLUGIN_DOMAIN ),
			PLUGIN_ROLE,
			PLUGIN_SLUG,
			[ $this, 'register_menu_page' ]
		);
	}

	/**
	 * Register Menu page.
	 *
	 * @return void
	 */
	public function register_menu_page(): void {
		echo 'Quizzo';
	}
}
