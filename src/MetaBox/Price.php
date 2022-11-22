<?php

namespace Quizzo\MetaBox;

/**
 * Price class
 */
class Price extends AbstractMetaBox {
	/**
	 * Meta box name.
	 *
	 * @var string
	 */
	public static $name = 'price';

	/**
	 * Return meta box heading.
	 *
	 * @return string
	 */
	public function get_heading(): string {
		return 'Quiz Price';
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
		// Get Quiz price
		$quiz_price = get_post_meta( $post->ID, 'quizzo_price', true);

		echo sprintf(
			'<input type="text" class="widefat" name="quizzo_price" style="margin-top: 5px;" value="%1$s" />',
			esc_html( $quiz_price )
		);
	}

	/**
	 * Save Meta box.
	 *
	 * @param int $post_id
	 * @param \WP_Post $post
	 * @return void
	 */
	public function save_meta_box( $post_id, $post ): void {
		// Update Meta box
		update_post_meta( $post_id, 'quizzo_price', $_POST['quizzo_price'] );
	}
}
