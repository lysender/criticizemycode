<?php defined('SYSPATH') or die('No direct access allowed.');

class Unit_TextTest extends Kohana_UnitTest_TestCase
{
	/**
	 * Returns the data for testing
	 *
	 * @return array
	 */
	public function generate_slug_provider()
	{
		return array(
			// Empty string
			array('', 100, ''),
			// Simple title
			array('A really good title', 100, 'a-really-good-title'),
			// Simple title with space around
			array(' A really good title ', 100, 'a-really-good-title'),
			// Maxed out limit
			array('a a a a', 7, 'a-a-a-a'),
			// Exceeds limit
			array('a a a a', 6, 'a-a-a-'),
			// Maxed out limit with space around
			array('a a a ', 5, 'a-a-a'),
			// No limit
			array('This is a good title', NULL, 'this-is-a-good-title'),
			// With plus symbol
			array('Google+ is great', 100, 'google-plus-is-great'),
			// With weird characters
			array('Get $100.00 for good', 100, 'get-100-00-for-good')
		);
	}
	
	/**
	 * @test
	 * @dataProvider generate_slug_provider
	 *
	 * @param  string	$str
	 * @param  int		$limit
	 * @param  string	$slug
	 */
	public function test_generate_slug($str, $limit, $slug)
	{
		$result = Text::generate_slug($str, $limit);
		
		if ($limit)
		{
			// Be sure that it doesn't exceed the limit
			$this->assertTrue(strlen($result) <= $limit);
		}
		
		$this->assertEquals($slug, $result);
	}
}