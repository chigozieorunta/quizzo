<?php

namespace Quizzo\Post;

/**
 * Quiz class
 */
class Quiz extends AbstractPost {
	/**
	 * Post type.
	 *
	 * @var string
	 */
	public static $name = 'quiz';

	/**
	 * Return singular label.
	 *
	 * @return string
	 */
	public function get_singular_label(): string {
		return 'Quiz';
	}

	/**
	 * Return plural label.
	 *
	 * @return string
	 */
	public function get_plural_label(): string {
		return 'Quizzes';
	}

	/**
	 * Save Post Type.
	 *
	 * @return void
	 */
	public function save_post_type(): void {
	}
}
