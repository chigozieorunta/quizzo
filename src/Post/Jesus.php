<?php

namespace Quizzo\Post;

class Jesus extends AbstractPost {
	/**
	 * Post type
	 *
	 * @var string
	 */
	public static $name = 'jesus';

	/**
	 * Return singular label
	 *
	 * @return string
	 */
	public function get_singular_label(): string {
		return 'Jesus';
	}

	/**
	 * Return plural label
	 *
	 * @return string
	 */
	public function get_plural_label(): string {
		return 'Jesuses';
	}
}
