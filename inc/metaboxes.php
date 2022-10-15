<?php

namespace Quizzo;

/**
 * Register Meta boxes for Quizzo
 *
 * @return void
 */
function register_quizzo_meta_boxes() {
	add_meta_box(
		'quizzo_options',
		__( 'Options', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quizzo_metabox_options_cb',
		'question'
	);

	/*add_meta_box(
		'quizzo_answer',
		__( 'Answer', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quizzo_metabox_answer_cb',
		'question'
	);*/

	add_meta_box(
		'quizzo_questions',
		__( 'Quiz Questions', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quizzo_metabox_questions_cb',
		'quiz'
	);

	add_meta_box(
		'quizzo_shortcode',
		__( 'Quiz Shortcode', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quizzo_metabox_shortcode_cb',
		'quiz',
		'side',
		'high'
	);

	add_meta_box(
		'quizzo_wc',
		__( 'Quiz WooCommerce Paywall', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quizzo_metabox_wc_cb',
		'quiz',
		'side',
		'high'
	);

	add_meta_box(
		'quizzo_price',
		__( 'Quiz Price', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quizzo_metabox_price_cb',
		'quiz',
		'side',
		'high'
	);

	add_meta_box(
		'quizzo_scores',
		__( 'User\'s Quiz Performance', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quizzo_metabox_scores_cb',
		'score'
	);
}

/**
 * WooCommerce Callback Method
 *
 * @param object $post
 * @return void
 */
function quizzo_metabox_wc_cb( $post ) {
	// Global options
	global $quiz_wc_options, $quiz_wc;

	// Get Answer
	$quiz_wc         = get_post_meta( $post->ID, 'quizzo_wc', true );
	$quiz_wc_options = array('No', 'Yes');

	// Get Template part
	load_template( dirname( __DIR__ ) . '/partials/cb-wc.php' );
}

/**
 * Price Callback Method
 *
 * @param object $post
 * @return void
 */
function quizzo_metabox_price_cb( $post ) {
	// Global variable
	global $price;

	// Get Price
	$price = get_post_meta( $post->ID, 'quizzo_price', true);

	// Get Template part
	load_template( dirname( __DIR__ ) . '/partials/cb-price.php' );
}

/**
 * Shortcode Callback Method
 *
 * @param object $post
 * @return void
 */
function quizzo_metabox_shortcode_cb( $post ) {
	echo '<h2 style="padding-left: 0; padding-bottom: 0;">[quizzo id=' . $post->ID. ']</h2>';
}

/**
 * Answer Callback Method
 *
 * @param object $post
 * @return void
 */
/*function quizzo_metabox_answer_cb( $post ) {
	// Global options
	global $quiz_options, $quiz_answer;

	// Get Answer
	$quiz_options = array( 1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D' );
	$quiz_answer  = get_post_meta( $post->ID, 'quizzo_answer', true );

	// Get Template part
	load_template( dirname( __DIR__ ) . '/partials/cb-answer.php' );
}*/

/**
 * Options Callback Method
 *
 * @param object $post
 * @return void
 */
function quizzo_metabox_options_cb( $post ) {
	// CB global options
	global $quiz_options, $quiz_id;

	// Get Options for answers
	$quiz_options[1] = get_post_meta( $post->ID, 'quizzo_option_1', true );
	$quiz_options[2] = get_post_meta( $post->ID, 'quizzo_option_2', true );
	$quiz_options[3] = get_post_meta( $post->ID, 'quizzo_option_3', true );
	$quiz_options[4] = get_post_meta( $post->ID, 'quizzo_option_4', true );

	// Get Quiz ID
	$quiz_id = $_GET['quiz_id'] ?: get_post_meta( $post->ID, 'quizzo_quiz_id', true );

	// Get Template part
	load_template( dirname( __DIR__ ) . '/partials/cb-options.php' );
}

/**
 * Questions Callback Method
 *
 * @param object $post
 * @return void
 */
function quizzo_metabox_questions_cb( $post ) {
	// Get All Questions
	global $questions;

	$questions = get_posts( array(
		'post_type'      => 'question',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'meta_key'       => 'quizzo_quiz_id',
		'meta_value'     => $post->ID,
		'order'          => 'ASC'
	) );

	// Get Template part
	load_template( dirname( __DIR__ ) . '/partials/cb-questions.php' );
}

/**
 * Scores Callback Method
 *
 * @param object $post.
 * @return void
 */
function quizzo_metabox_scores_cb( $post ) {
	// Get all scores
	global $scores_metadata;
	$scores_metadata = get_post_meta( $post->ID );

	// Get Template part
	load_template( dirname( __DIR__ ) . '/partials/cb-scores.php' );
}
