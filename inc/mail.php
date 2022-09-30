<?php

namespace Quizzo;

/**
 * Attachment email
 *
 * @param object $order
 * @param bool $sent_to_admin
 * @param string $plain_text
 * @param string $email
 * @return void
 */
function attach_quizzo_link_to_wc_email( $order, $sent_to_admin, $plain_text, $email ) {
	foreach ( $order->get_items() as $item ) {
		// Get product details
		$product    = $item->get_product();
		$product_id = $item->get_product_id();

		// Get quiz id and shortcode
		$quiz_id        = get_post_meta( $product_id, 'quizzo_id', true );
		$quiz_shortcode = '[quizzo id=' . $quiz_id . ']';

		// Get Quiz page ID, Quiz link
		global $wp, $wpdb;
		$sql = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_status="publish" AND post_content LIKE "%' . $quiz_shortcode . '%"';
		$page_id    = $wpdb->get_var( $sql );
		$quiz_link  = get_permalink( $page_id );
		$quiz_title = esc_html( get_the_title( $quiz_id ) );

		// Attach if it is a Quizzo product
		if ( $product->is_type('quizzo') ) {
			$quiz_message = sprintf(
				'<p><strong>You can take your test quiz here: <a href="%1$s">%2$s</a>.</strong></p>',
				$quiz_link,
				$quiz_title
			);
			$plain_text .= $quiz_message;
        }
	}
	echo $plain_text;
}
