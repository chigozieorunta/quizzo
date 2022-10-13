<?php

namespace Quizzo\MetaBox;

/**
 * Answer class
 */
class Ojuju extends AbstractMetaBox {
	/**
	 * Meta box name.
	 *
	 * @var string
	 */
	public static $name = 'ojuju';

	/**
	 * Return meta box heading.
	 *
	 * @return string
	 */
	public function get_heading(): string {
		return 'Ojuju Headline';
	}

	/**
	 * Return parent post type.
	 *
	 * @return string
	 */
	public function get_post_type(): string {
		return 'question';
	}

	/**
	 * Return callback.
	 *
	 * @return string
	 */
	public function get_metabox_callback(): string {
		return '';
	}
}
