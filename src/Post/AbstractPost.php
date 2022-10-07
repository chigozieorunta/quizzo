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
	 * Get post type name
	 *
	 * @return string
	 */
	public function get_name() : string {
		return static::$name;
	}

}
