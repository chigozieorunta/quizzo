<?php
/**
 * Meta box abstraction
 *
 * @package Quizzo
 */

namespace Quizzo\MetaBox;

use LogicException;

/**
 * Base Handler class for registering Meta boxes
 *
 */
abstract class AbstractMetaBox {

	/**
	 * Abstract Meta box.
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
	 * Get Meta box name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return static::$name;
	}

	/**
	 * Get Meta box heading.
	 *
	 * @return string
	 */
	abstract public function get_heading(): string;

	/**
	 * Get Meta box parent post type.
	 *
	 * @return string
	 */
	abstract public function get_post_type(): string;

	/**
	 * Get Meta box callback.
	 *
	 * @param \WP_Post $post
	 * @return void
	 */
	abstract public function get_metabox_callback( $post ): void;

	/**
	 * Get Meta box position.
	 *
	 * @return string
	 */
	abstract public function get_position(): string;

	/**
	 * Get Meta box priority.
	 *
	 * @return string
	 */
	abstract public function get_priority(): string;

	/**
	 * Save Meta box.
	 *
	 * @param int $post_id
	 * @return void
	 */
	abstract public function save_meta_box( $post_id, $post ): void;

	/**
	 * Register meta box.
	 *
	 * @return void
	 */
	public function register_meta_box(): void {
		add_meta_box(
			PLUGIN_SLUG . '_' . $this->get_name(),
			__( $this->get_heading(), PLUGIN_DOMAIN ),
			[ $this, 'get_metabox_callback' ],
			$this->get_post_type(),
			$this->get_position() ?: 'advanced',
			$this->get_priority() ?: 'default'
		);
	}
}
