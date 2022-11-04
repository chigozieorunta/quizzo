<?php

namespace Quizzo;

/**
 * Dashboard Callback Method
 *
 * @return void
 */
function quizzo_dashboard_cb() {
	// Get Template part
	load_template( dirname( __DIR__ ) . '/partials/cb-dashboard.php' );
}

/**
 * Flush Rewrite Cache
 *
 * @return void
 */
function quizzo_rewrite_flush() {
	// Register CPTs
	register_quizzo_cpts();

	// Flush Rewrite Cache
	flush_rewrite_rules();
}

/**
 * Housekeeping for Publish hooks
 *
 * @param int $post_id
 * @return void
 */
function house_keeping( $post_id ) {
	// Check if user has permissions to save data.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Check if not an autosave.
	if ( wp_is_post_autosave( $post_id ) ) {
		return;
	}

	// Check if not a revision.
	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}
}

/**
 * Publish Quiz Callback Method
 *
 * @param int $post_id
 * @return void
 */
function register_quizzo_quiz_save_meta_box( $post_id ) {
	// Housekeeping
	house_keeping( $post_id );

	// Update Quiz
	//update_post_meta( $post_id, 'quizzo_price', $_POST['quizzo_price'] );
	//update_post_meta( $post_id, 'quizzo_wc', $_POST['quizzo_wc'] );

	// Get WC Product ID
	$product_id = get_post_meta( $post_id, 'quizzo_wc_product', true );

	// Check if product has ever existed before
	if ( ! $product_id ) {

		// Only perform this if WC is active
		if ( class_exists( 'WooCommerce' ) ) {
			// Insert new WC product
			$product_id = wp_insert_post( array(
				'post_title'  => esc_html( get_the_title( $post->ID ) ),
				'post_type'   => 'product',
				'post_status' => 'publish'
			) );

			$product = wc_get_product( $product_id );
			$product->set_price( $_POST['quizzo_price'] );
			$product->set_regular_price( $_POST['quizzo_price'] );
			$product->save();

			//Specify product type as Quizzo
			wp_remove_object_terms( $product_id, 'simple', 'product_type' );
			wp_set_object_terms( $product_id, 'quizzo', 'product_type' );

			//Finally save WC product ID
			update_post_meta( $post_id, 'quizzo_wc_product', $product_id );

			// Save Quiz ID to product
			update_post_meta( $product_id, 'quizzo_id', $post_id );
		}
	} else {
		// Only perform this if WC is active
		if ( class_exists( 'WooCommerce' ) ) {
			$product = wc_get_product( $product_id );
			$product->set_price( $_POST['quizzo_price'] );
			$product->set_regular_price( $_POST['quizzo_price'] );
			$product->set_name( esc_html( get_the_title( $post_id ) ) );
			$product->save();
		}

		// Save Quiz ID to product
		update_post_meta( $product_id, 'quizzo_id', $post_id );
	}
}

/**
 * Publish Question Callback Method
 *
 * @param int $post_id
 * @return void
 */
function register_quizzo_question_save_meta_box( $post_id ) {
	// Housekeeping
	house_keeping( $post_id );

	// Update Question
	update_post_meta( $post_id, 'quizzo_quiz_id', $_POST['quizzo_quiz_id'] );
	//update_post_meta( $post_id, 'quizzo_answer', $_POST['quizzo_answer'] );

	// Update Options
	update_post_meta( $post_id, 'quizzo_option_1', $_POST['quizzo_option_1'] );
	update_post_meta( $post_id, 'quizzo_option_2', $_POST['quizzo_option_2'] );
	update_post_meta( $post_id, 'quizzo_option_3', $_POST['quizzo_option_3'] );
	update_post_meta( $post_id, 'quizzo_option_4', $_POST['quizzo_option_4'] );
}

/**
 * Register user's session
 *
 * @return void
 */
function register_user_session() {
  if ( ! session_id() ) session_start();
}
