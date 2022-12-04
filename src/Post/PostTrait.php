<?php
/**
 * PostTrait
 *
 * @package Quizzo
 */

namespace Quizzo\Post;

/**
 * PostTrait
 */
trait PostTrait {
	/**
	 * House Keeping for any Publish Hook
	 *
	 * @param int $post_id
	 * @return void
	 */
	public function publish_house_keeping( $post_id ) {
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
}
