<?php

namespace Quizzo\MetaBox;

/**
 * Price class
 */
class Questions extends AbstractMetaBox {
	/**
	 * Meta box name.
	 *
	 * @var string
	 */
	public static $name = 'question';

	/**
	 * Return meta box heading.
	 *
	 * @return string
	 */
	public function get_heading(): string {
		return 'Quiz Questions';
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
		// Get Quiz questions
		$quiz_questions = get_posts( array(
			'post_type'      => 'question',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'meta_key'       => 'quizzo_quiz_id',
			'meta_value'     => $post->ID,
			'order'          => 'ASC'
		) );

		// Get Add New Question Button
		$this->get_add_new_button( $post );

		// Show Questions
		echo sprintf( '<ul>%1$s</ul>', $this->get_quiz_questions( $quiz_questions ) );
	}

	/**
	 * Get Add New Question Button
	 *
	 * @param \WP_Post $post
	 * @return void
	 */
	private function get_add_new_button( $post ): void {
		// Get Quiz URL
		$quiz_url = sprintf(
			'%1$s/wp-admin/post-new.php?post_type=question&quiz_id=%2$s',
			home_url(),
			$post->ID
		);

		// Display Add New Question button
		echo sprintf(
			'<div>
				<a href="%1$s" class="button button-primary button-large" style="margin-top: 5px;">Add New Question</a>
			</div>',
			esc_url( $quiz_url )
		);
	}

	/**
	 * Get Quiz Questions
	 *
	 * @param array $quiz_questions
	 * @return string
	 */
	private function get_quiz_questions( $quiz_questions ): string {
		$questions = '';

		foreach ( $quiz_questions as $question ) {
			// Get Question URL
			$question_url = sprintf( '%1$s/wp-admin/post.php?post=%2$s&action=edit', home_url(), $question->ID );

			// Get Question & Options
			$questions .= sprintf(
				'<li class="quizzo_admin_question">
					<a href="%1$s">
						<h2>
							<strong>%2$s</strong>
							<span class="dashicons dashicons-edit" style="float: right;"></span>
						</h2>
						<ol>%3$s</ol>
					</a>
				</li>',
				esc_url( $question_url ),
				esc_html( $question->post_title ),
				$this->get_question_options( $question->ID )
			);
		}

		return $questions;
	}

	/**
	 * Get Question options
	 *
	 * @param int $question_id
	 * @return string
	 */
	private function get_question_options( $question_id ): string {
		$i = 1; $options = '';
		while ( $i < 5 ) {
			$options .= sprintf(
				'<li>%1$s</li>',
				esc_html( get_post_meta( $question_id, 'quizzo_option_' . $i, true ) )
			);
			$i++;
		}

		return $options;
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
		//...
	}
}
