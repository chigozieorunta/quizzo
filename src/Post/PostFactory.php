<?php
/**
 * Post factory.
 *
 * @package Quizzo
 */

namespace Quizzo\Post;

use RuntimeException;

/**
 * Post factory builds the Quizzo post type class instances.
 */
class PostFactory {
	/**
	 * Post types
	 *
	 * @var array
	 */
	private static array $post_types = [
		'Jesus' => 'Jesus',
		'Quiz'  => 'Quiz'
	];

	/**
	 * Set up the Quizzo post types
	 *
	 * @return void
	 */
	public static function init(): void {
		foreach( self::$post_types as $post_type ) {
			self::create( $post_type );
		}
	}

	/**
	 * Create post type
	 *
	 * @param string $post_type
	 * @return void
	 */
	public static function create(string $post_type): void {
		$class = __NAMESPACE__ . '\\' . $post_type;
		if ( class_exists( $class ) ) {
			new $class();
		} else {
			throw new RuntimeException( $class . ' does not exist.' );
		}
	}
}
