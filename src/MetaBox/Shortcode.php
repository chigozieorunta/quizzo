<?php

namespace Quizzo\MetaBox;

/**
 * Shortcode class
 */
class Shortcode extends AbstractMetaBox {
	/**
	 * Meta box name.
	 *
	 * @var string
	 */
	public static $name = 'shortcode';

	/**
	 * Return meta box heading.
	 *
	 * @return string
	 */
	public function get_heading(): string {
		return 'Quiz Shortcode';
	}

	/**
	 * Return parent post type.
	 *
	 * @return string
	 */
	public function get_post_type(): string {
		return 'quiz';
	}

	/**
	 * Return meta box position.
	 *
	 * @return string
	 */
	public function get_position(): string {
		return 'side';
	}

	/**
	 * Return meta box priority.
	 *
	 * @return string
	 */
	public function get_priority(): string {
		return 'high';
	}

	/**
	 * Return callback.
	 *
	 * @param \WP_Post $post
	 * @return void
	 */
	public function get_metabox_callback( $post ): void {
		// Get Quiz shortcode
		echo '<h2 style="padding-left: 0; padding-bottom: 0;">[quizzo id=' . $post->ID. ']</h2>';
	}

	/**
	 * Save Meta box.
	 *
	 * @param int $post_id
	 * @param \WP_Post $post
	 * @return void
	 */
	public function save_meta_box( $post_id, $post ): void {
		// Update Meta box...
	}
}
