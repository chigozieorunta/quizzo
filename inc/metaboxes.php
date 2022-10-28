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

	add_meta_box(
		'quizzo_scores',
		__( 'User\'s Quiz Performance', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quizzo_metabox_scores_cb',
		'score'
	);
}

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
