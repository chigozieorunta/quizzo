<?php

namespace Quizzo\MetaBox;

/**
 * Answer class
 */
class Answer extends AbstractMetaBox {
	/**
	 * Meta box name.
	 *
	 * @var string
	 */
	public static $name = 'answer';

	/**
	 * Return meta box heading.
	 *
	 * @return string
	 */
	public function get_heading(): string {
		return 'Answer';
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
	 * Return meta box position.
	 *
	 * @return string
	 */
	public function get_position(): string {
		return '';
	}

	/**
	 * Return meta box priority.
	 *
	 * @return string
	 */
	public function get_priority(): string {
		return '';
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

		// HTML Options
		$options = '';

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
			'<select class="widefat" name="quizzo_answer" style="margin-top: 5px;">%1$s</select>',
			$options
		);
	}

	/**
	 * Save Meta box.
	 *
	 * @param int $post_id
	 * @return void
	 */
	public function save_meta_box( $post_id, $post ): void {
		// Update Meta box
		update_post_meta( $post_id, 'quizzo_answer', $_POST['quizzo_answer'] );
	}
}
