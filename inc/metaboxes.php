<?php

namespace Quizzo;

/**
 * Register Meta boxes for Quizzo
 *
 * @return void
 */
function register_quizzo_meta_boxes() {
	add_meta_box(
		'quizzo_scores',
		__( 'User\'s Quiz Performance', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quizzo_metabox_scores_cb',
		'score'
	);
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
