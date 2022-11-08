<?php

namespace Quizzo\Post;

class Question extends AbstractPost {
	/**
	 * Post type
	 *
	 * @var string
	 */
	public static $name = 'question';

	/**
	 * Return singular label
	 *
	 * @return string
	 */
	public function get_singular_label(): string {
		return 'Question';
	}

	/**
	 * Return plural label
	 *
	 * @return string
	 */
	public function get_plural_label(): string {
		return 'Questions';
	}
}
