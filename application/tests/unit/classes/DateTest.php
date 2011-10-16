<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Unit tests for Date extension
 *
 */
class Unit_DateTest extends Kohana_Unittest_TestCase {
	
	/**
	 * Returns the list of input data for extra_fuzzy_span tests
	 *
	 * @return array
	 */
	public function extra_fuzzy_span_provider()
	{
		$relative_time = time();
		// This is recorded in 2011-10-16 21:58:00 MNL
		$relative_day = '1318773439';
		
		return array(
			// Just now
			array($relative_time, $relative_time + 1, 'just now'),
			array($relative_time, $relative_time + 7, 'just now'),
			// Just now without relative time
			array($relative_time, NULL, 'just now'),
			// Showing seconds
			array($relative_time, $relative_time + 45, '45 seconds ago'),
			// A minute ago
			array($relative_time, $relative_time + 75, 'a minute ago'),
			array($relative_time, $relative_time + 115, 'a minute ago'),
			// Showing minutes
			array($relative_time, $relative_time + Date::MINUTE * 5, '5 minutes ago'),
			array($relative_time, $relative_time + Date::MINUTE * 1, 'a minute ago'),
			array($relative_time, $relative_time + Date::MINUTE * 59, '59 minutes ago'),
			array($relative_time, $relative_time + (Date::MINUTE * 5) + 40, '5 minutes ago'),
			// An hour
			array($relative_time, $relative_time + Date::HOUR, 'an hour ago'),
			array($relative_time, $relative_time + Date::HOUR + Date::MINUTE, 'an hour ago'),
			array($relative_time, $relative_time + Date::HOUR + (Date::HOUR - 1), 'an hour ago'),
			// Hours
			array($relative_time, $relative_time + Date::HOUR * 2, '2 hours ago'),
			array($relative_time, $relative_time + Date::HOUR * 23, '23 hours ago'),
			array($relative_time, $relative_time + (Date::HOUR * 24) - 1, '23 hours ago'),
			// Yesterday
			array($relative_time, $relative_time + Date::DAY + 1, 'Yesterday'),
			array($relative_time, $relative_time + Date::DAY + Date::MINUTE, 'Yesterday'),
			array($relative_time, $relative_time + Date::DAY + Date::HOUR, 'Yesterday'),
			array($relative_time, $relative_time + Date::DAY + Date::HOUR * 10, 'Yesterday'),
			array($relative_time, $relative_time + (Date::DAY * 2) - 1, 'Yesterday'),
			// Testing against 2011-10-16 MNL - Manila time GMT +8, which is Sunday
			array($relative_day, $relative_day + Date::DAY * 2, 'last Sunday'),
			array($relative_day, $relative_day + Date::DAY * 5, 'last Sunday'),
			array($relative_day, $relative_day + Date::WEEK - (Date::HOUR * 5), 'last Sunday'),
			// Testing dates when less than 3 months against 2011-10-16 MNL GMT +8
			array($relative_day, $relative_day + Date::WEEK + (Date::DAY * 2), 'Oct 16'),
			array($relative_day, $relative_day + Date::MONTH, 'Oct 16'),
			array($relative_day, $relative_day + Date::MONTH * 2, 'Oct 16'),
			array($relative_day, $relative_day + Date::MONTH * 3 - 1, 'Oct 16'),
			// Displaying full date
			array($relative_day, $relative_day + Date::MONTH * 3 + Date::DAY * 4, 'Oct 16, 2011'),
			array($relative_day, $relative_day + Date::YEAR * 3 + Date::DAY * 4, 'Oct 16, 2011'),
		);
	}
	
	/**
	 * @test
	 * @dataProvider extra_fuzzy_span_provider
	 *
	 * @param  int		$timestamp
	 * @param  int		$relative_time
	 * @param  string	$expected
	 */
	public function test_extra_fuzzy_span($timestamp, $relative_time, $expected)
	{
		$span = NULL;
		
		if ($relative_time === NULL)
		{
			$span = Date::extra_fuzzy_span($timestamp);
		}
		else
		{
			$span = Date::extra_fuzzy_span($timestamp, $relative_time);
		}
		
		$this->assertEquals($expected, $span);
	}
}