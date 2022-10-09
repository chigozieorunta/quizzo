<?php

namespace Quizzo\Post;

class Diagram extends AbstractPost {
	/**
	 * Post type
	 *
	 * @var string
	 */
	public static $name = 'diagram';

	/**
	 * Return singular label
	 *
	 * @return string
	 */
	public function get_singular_label(): string {
		return 'Diagram';
	}

	/**
	 * Return plural label
	 *
	 * @return string
	 */
	public function get_plural_label(): string {
		return 'Diagrams';
	}
}
