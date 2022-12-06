<?php

namespace Quizzo\MetaBox;

/**
 * Options class
 */
class Options extends AbstractMetaBox {
	/**
	 * Meta box name.
	 *
	 * @var string
	 */
	public static $name = 'option';

	/**
	 * Return meta box heading.
	 *
	 * @return string
	 */
	public function get_heading(): string {
		return 'Quiz Options';
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
		return 'high';
	}

	/**
	 * Return callback.
	 *
	 * @param \WP_Post $post
	 * @return void
	 */
	public function get_metabox_callback( $post ): void {
		// Get Add New Question Button
		$this->get_back_to_quiz_btn( $post );

		// Get Question Options
		$question_options[1] = get_post_meta( $post->ID, 'quizzo_option_1', true );
		$question_options[2] = get_post_meta( $post->ID, 'quizzo_option_2', true );
		$question_options[3] = get_post_meta( $post->ID, 'quizzo_option_3', true );
		$question_options[4] = get_post_meta( $post->ID, 'quizzo_option_4', true );

		// All Question Options
		$options = '';

		foreach( $question_options as $key => $value ) {
			$options .= sprintf(
				'<p>
					<label for="option%1$s">Option %1$s</label><br/>
					<input type="text" class="widefat" name="quizzo_option_%1$s" value="%2$s"/>
				</p>',
				esc_attr( $key ),
				esc_html( $value )
			);
		}

		$options .= sprintf(
			'<input type="hidden" name="quizzo_quiz_id" value="%1$s"/>',
			isset( $_GET['quiz_id'] ) ?: get_post_meta( $post->ID, 'quizzo_quiz_id', true )
		);

		// Show Options
		echo $options;
	}

	/**
	 * Get Back to Quiz Button
	 *
	 * @param \WP_Post $post
	 * @return void
	 */
	private function get_back_to_quiz_btn( $post ): void {
		// Get Quiz URL
		$quiz_url = sprintf(
			'%1$s/wp-admin/post.php?post=%2$s&action=edit',
			home_url(),
			esc_html( get_post_meta( $post->ID, 'quizzo_quiz_id', true ) )
		);

		// Display Add New Question button
		echo sprintf(
			'<div>
				<a href="%1$s" class="button button-primary button-large" style="margin-top: 5px;">Go Back To Quiz</a>
			</div>',
			esc_url( $quiz_url )
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
		// Update Options
		update_post_meta( $post_id, 'quizzo_option_1', $_POST['quizzo_option_1'] );
		update_post_meta( $post_id, 'quizzo_option_2', $_POST['quizzo_option_2'] );
		update_post_meta( $post_id, 'quizzo_option_3', $_POST['quizzo_option_3'] );
		update_post_meta( $post_id, 'quizzo_option_4', $_POST['quizzo_option_4'] );

		// Update Hidden Quiz Field
		update_post_meta( $post_id, 'quizzo_quiz_id', $_POST['quizzo_quiz_id'] );
	}
}
