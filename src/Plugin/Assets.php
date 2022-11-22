<?php

namespace Quizzo\Plugin;

/**
 * Assets Class
 */
class Assets {
	/**
	 * Assets Instance.
	 *
	 * @var \Assets
	 */
	private static $instance;

	/**
	 * Get instance of Class (Singleton).
	 *
	 * @return \Assets
	 */
	public static function get_instance(): object {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function init() {
		$this->register_styles();
		$this->register_scripts();
	}

	public function admin_init() {
		$this->admin_styles();
		$this->admin_scripts();
	}

	public function register_styles() {
		// Shortcode styling
		wp_enqueue_style(
			PLUGIN_SLUG,
			plugin_dir_url( __DIR__ ) . '../assets/css/dist/quizzo-shortcode.css'
		);
	}

	public function register_scripts() {
		// Shortcode script
		wp_enqueue_script(
			PLUGIN_SLUG,
			plugin_dir_url( __DIR__ ) . '../assets/js/dist/quizzo-shortcode.js',
			array('jquery')
		);
	}

	public function admin_styles() {
		// Admin styling
		wp_enqueue_style(
			PLUGIN_SLUG,
			plugin_dir_url( __DIR__ ) . '../assets/css/dist/quizzo-admin.css'
		);
	}

	public function admin_scripts() {
		// Admin script
		//...
	}
}
