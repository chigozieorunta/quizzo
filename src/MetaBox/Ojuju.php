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
	 * @param \WP_Post $post
	 * @return void
	 */
	public function get_metabox_callback( $post ): void {
		// Get Quiz answer
		$quiz_answer  = get_post_meta( $post->ID, 'quizzo_answer', true );

		// Get Options
		foreach ( PLUGIN_OPTIONS as $key => $value ) {
			$options .= sprintf(
				'<option value="%1$s" %3$s>
					%2$s
				</option>',
				esc_attr( $key ),
				esc_html( $value ),
				selected( $quiz_answer, esc_attr( $key ), false )
			);
		}

		echo sprintf(
			'<select class="widefat" name="quizzo_answer">%1$s</select>',
			$options
		);
	}
}
