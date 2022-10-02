<?php

namespace Tests\Unit;

use Quizzo\Quizzo;
use PHPUnit\Framework\TestCase;

class QuizzoTest extends TestCase {
	public function test_activate_returns_string() {
		// Given object
		$quizzo = new Quizzo();

		// When you activate the plugin
		$quizzo->activate();

		$expected = 'Hello World';

		// Then we assert that it returns the following string
		$this->assertEquals( $expected, 'Hello World' );
	}
}
