<?php
/**
 * Post type abstraction
 *
 * @package Quizzo
 */

namespace Quizzo\Post;

use LogicException;

/**
 * Base Handler class for registering Post types
 *
 * @author Chigozie Orunta <chigozieorunta@yahoo.com>
 */
abstract class AbstractPost {

	/**
	 * Abstract Post Constructor.
	 *
	 * @return void
	 *
	 * @throws \LogicException If $name property is not statically defined within child classes.
	 */
	final public function __construct() {
		if ( ! isset( static::$name ) ) {
			throw new LogicException( __CLASS__ . ' must define static property name' );
		}
	}

	/**
	 * Get post type name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return static::$name;
	}

	/**
	 * Get singular label for post type.
	 *
	 * @return string
	 */
	abstract public function get_singular_label(): string;

	/**
	 * Get plural label for post type.
	 *
	 * @return string
	 */
	abstract public function get_plural_label(): string;

	/**
	 * Get labels for post type.
	 *
	 * @return array
	 */
	public function get_labels(): array {
		$singular_label = $this->get_singular_label();
		$plural_label   = $this->get_plural_label();

		$labels = [
			'name'          => $plural_label,
			'singular_name' => $singular_label,
			'all_items'     => sprintf(
				__( 'All %s', PLUGIN_DOMAIN ),
				$plural_label
			),
			'add_new'       => sprintf(
				__( 'Add New %s', PLUGIN_DOMAIN ),
				$singular_label
			),
			'add_new_item'  => sprintf(
				__( 'Add New %s', PLUGIN_DOMAIN ),
				$singular_label
			),
			'new_item'  => sprintf(
				__( 'New %s', PLUGIN_DOMAIN ),
				$singular_label
			),
			'edit_item'  => sprintf(
				__( 'Edit %s', PLUGIN_DOMAIN ),
				$singular_label
			),
			'view_item'  => sprintf(
				__( 'View %s', PLUGIN_DOMAIN ),
				$singular_label
			),
			'search_items'  => sprintf(
				__( 'Search %s', PLUGIN_DOMAIN ),
				$plural_label
			),
		];
	}

}
