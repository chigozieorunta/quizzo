<?php
/**
 * Meta box factory.
 *
 * @package Quizzo
 */

namespace Quizzo\MetaBox;

use RuntimeException;

/**
 * Meta box factory builds the Quizzo meta box class instances.
 */
class MetaBoxFactory {
	/**
	 * Meta boxes
	 *
	 * @var array
	 */
	public static array $meta_boxes = [
		'Answer'    => 'Answer',
		'Paywall'   => 'Paywall',
		'Price'     => 'Price',
		'Shortcode' => 'Shortcode',
		'Questions' => 'Questions',
		'Options'   => 'Options',
	];

	/**
	 * Set up the Quizzo meta boxes.
	 *
	 * @return void
	 */
	public static function init(): void {
		foreach( self::$meta_boxes as $meta_box ) {
			self::create( $meta_box );
		}
	}

	/**
	 * Create meta box.
	 *
	 * @param string $meta_box
	 * @return void
	 */
	public static function create(string $meta_box): void {
		$class = __NAMESPACE__ . '\\' . $meta_box;
		if ( class_exists( $class ) ) {
			$object = new $class;
			$object->register_meta_box();
		} else {
			throw new RuntimeException( $class . ' does not exist.' );
		}
	}
}
