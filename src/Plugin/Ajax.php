<?php
/**
 * @package Quizzo
 */

namespace Quizzo\Plugin;

/**
 * Ajax Class
 */
class Ajax {
	/**
	 * Ajax Instance.
	 *
	 * @var \Ajax
	 */
	private static $instance;

	/**
	 * Get instance of Class (Singleton).
	 *
	 * @return \Ajax
	 */
	public static function get_instance(): object {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Save User's Answer
	 *
	 * @return void
	 */
	public function init(): void {
		// Get IDs
		$answer_id   = $_POST['answer_id'];
		$question_id = $_POST['question_id'];

		// Let us see if the answer is correct.
		$answer  = get_post_meta( $question_id, 'quizzo_answer', true );
		$compare = $answer === $answer_id ? 1 : 0;

		// Get current user
		$current_user = wp_get_current_user();
		$user = $current_user->display_name ?: $current_user->user_login;

		// Check if a score ID has been created
		if ( ! $_SESSION['question_counter'] ) {
			// Save Score
			$score_id = wp_insert_post( array(
				'post_type'   => 'score',
				'post_status' => 'publish',
				'post_title'  =>  $user . ' - ' . get_the_title( $_SESSION['quiz_id'] )
			) );

			// Save important details for scores
			update_post_meta( $score_id, 'score_quiz_id', $_SESSION['quiz_id'] );
			update_post_meta( $score_id, 'score_user_id', $current_user->ID );
			update_post_meta( $score_id, 'score_user_name', $user );
			update_post_meta( $score_id, 'score_user_email', $current_user->user_email );
			update_post_meta( $score_id, 'score_total_questions', count( $_SESSION['questions_ids'] ) );

			// Save to score_id, if its the first time
			$_SESSION['score_id']   = $score_id;
		}

		// Save Question Status (Right or Wrong) depending on user answer
		update_post_meta( $_SESSION['score_id'], 'score_question_' . $question_id, $compare );

		// Save User's exact answer - A, B, C, D
		update_post_meta( $_SESSION['score_id'], 'score_answer_' . $question_id, $answer_id );

		// Update total score based on correct answers
		$total = get_post_meta( $_SESSION['score_id'], 'score_total', true ) ?: 0;
		if ( $compare ) {
			$total = $total + 1;
			update_post_meta( $_SESSION['score_id'], 'score_total', $total );
		}

		// Get next question
		if ( isset( $_SESSION['questions_ids'] ) ) {
			$index = array_search( $question_id, $_SESSION['questions_ids'] );

			//Check if its the last index, if not, update.
			if ( $index < count ( $_SESSION['questions_ids'] ) ) {
				$_SESSION['question_counter'] = $index + 1;
			}
		}

		// Get percentage score
		$total_questions        = get_post_meta( $_SESSION['score_id'], 'score_total_questions', true ) ?: 0;
		$correct_questions      = get_post_meta( $_SESSION['score_id'], 'score_total', true ) ?: 0;
		$_SESSION['percentage'] = number_format( ( $correct_questions / $total_questions ) * 100, 0);

		// Prepare result
		$result['status'] = $compare;
		$result['answer'] = $answer;

		// Encode and send
		$result = json_encode($result);
		echo $result;

		die();
	}
