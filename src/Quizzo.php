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
		add_action( 'admin_menu', [ $this, 'register_menu' ], 9 );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'register_admin_assets' ] );
		$this->save_post_types();
		$this->save_meta_boxes();
	}

	/**
	 * Save Post Types
	 *
	 * @return void
	 */
	public function save_post_types(): void {
		foreach( Post\PostFactory::$post_types as $post_type ) {
			$class = __NAMESPACE__ . '\\Post\\' . $post_type;
			$object = new $class;
			add_action( 'publish_' . $object::$name, [ $object, 'save_post_type' ], 10, 2 );
		}
	}

	/**
	 * Save Meta Boxes
	 *
	 * @return void
	 */
	public function save_meta_boxes(): void {
		foreach( MetaBox\MetaBoxFactory::$meta_boxes as $meta_box ) {
			$class = __NAMESPACE__ . '\\MetaBox\\' . $meta_box;
			$object = new $class;
			add_action( 'publish_' . $object->get_post_type(), [ $object, 'save_meta_box' ], 10, 2 );
		}
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

	/**
	 * Register Menu.
	 *
	 * @return void
	 */
	public function register_menu(): void {
		try {
			$menu = Plugin\Menu::get_instance();
			$menu->init();
		} catch ( Exception $e ) {
			wp_die( 'Error: Registering Menu - ' . $e->getMessage() );
		}
	}

	/**
	 * Register Assets.
	 *
	 * @return void
	 */
	public function register_assets(): void {
		try {
			$assets = Plugin\Assets::get_instance();
			$assets->init();
		} catch ( Exception $e ) {
			wp_die( 'Error: Registering Assets - ' . $e->getMessage() );
		}
	}

	/**
	 * Register Admin Assets.
	 *
	 * @return void
	 */
	public function register_admin_assets(): void {
		try {
			$assets = Plugin\Assets::get_instance();
			$assets->admin_init();
		} catch ( Exception $e ) {
			wp_die( 'Error: Registering Admin Assets - ' . $e->getMessage() );
		}
	}
}
