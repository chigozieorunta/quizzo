<?php

namespace Quizzo\Post;

class Score extends AbstractPost {
	/**
	 * Post type.
	 *
	 * @var string
	 */
	public static $name = 'score';

	/**
	 * Return singular label.
	 *
	 * @return string
	 */
	public function get_singular_label(): string {
		return 'Score';
	}

	/**
	 * Return plural label.
	 *
	 * @return string
	 */
	public function get_plural_label(): string {
		return 'Scores';
	}

	/**
	 * Save Post Type.
	 *
	 * @return void
	 */
	public function save_post_type(): void {
	}
}
