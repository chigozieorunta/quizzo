<?php

namespace Quizzo\MetaBox;

/**
 * Paywall class
 */
class Paywall extends AbstractMetaBox {
	/**
	 * Meta box name.
	 *
	 * @var string
	 */
	public static $name = 'paywall';

	/**
	 * Return meta box heading.
	 *
	 * @return string
	 */
	public function get_heading(): string {
		return 'Quiz WooCommerce Paywall';
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
		// Get Quiz paywall
		$quiz_paywall  = get_post_meta( $post->ID, 'quizzo_paywall', true );

		// Comparison Array
		define( 'PLUGIN_BOOL', [ 'No', 'Yes' ] );

		// HTML Options
		$options = '';

		// Get Options
		foreach ( PLUGIN_BOOL as $key => $value ) {
			$options .= sprintf(
				'<option value="%1$s" %3$s>
					%2$s
				</option>',
				esc_attr( $key ),
				esc_html( $value ),
				selected( $quiz_paywall, esc_attr( $key ), false )
			);
		}

		echo sprintf(
			'<select class="widefat" name="quizzo_paywall" style="margin-top: 5px;">%1$s</select>',
			$options
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
		update_post_meta( $post_id, 'quizzo_paywall', $_POST['quizzo_paywall'] );
	}
}
