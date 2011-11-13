<?php defined('SYSPATH') or die('No direct access allowed.');

class Date extends Kohana_Date {
	
	/**
	 * Returns a user friendly time/date span for a given
	 * date and a given relative time
	 *
	 * When relative time is not given, the current time is used
	 *
	 * @param  int		$timestamp
	 * @param  int		$relative_time
	 * @return string
	 */
	public static function extra_fuzzy_span($timestamp, $relative_time = NULL)
	{
		// Determine the difference in seconds
		if ($relative_time === NULL)
		{
			$relative_time = time();
		}
		
		$offset = abs($relative_time - $timestamp);
		$span = '';
		
		if ($offset < Date::MINUTE)
		{
			if ($offset > 10)
			{
				$span = $offset.' seconds ago';
			}
			else
			{
				$span = 'just now';
			}
		}
		elseif ($offset <= (Date::MINUTE + 59))
		{
			$span = 'a minute ago';
		}
		elseif ($offset < Date::HOUR)
		{
			$span = floor($offset / Date::MINUTE).' minutes ago';
		}
		elseif ($offset <= (Date::HOUR * 2) - 1)
		{
			$span = 'an hour ago';
		}
		elseif ($offset < Date::DAY)
		{
			$span = floor($offset / Date::HOUR).' hours ago';
		}
		elseif ($offset <= (Date::DAY * 2) - 1)
		{
			$span = 'Yesterday';
		}
		elseif ($offset < Date::WEEK)
		{
			$span = 'last '.date('l', $timestamp);
		}
		elseif ($offset <= (Date::WEEK + (Date::HOUR * 5)))
		{
			$span = 'a week ago';
		}
		elseif ($offset < (Date::MONTH * 3))
		{
			$span = date('M j', $timestamp);
		}
		else
		{
			$span = date('M j, Y', $timestamp);
		}
		
		return $span;
	}

	/** 
	 * Checks if the date provided is valid for a given format
	 *
	 * @param   string	$date
	 * @param   string	$format
	 * @return  boolean
	 */
	public static function is_valid_format($date, $format)
	{
		if (date($format, strtotime($date) === $date))
		{
			return TRUE;
		}

		return false;
	}

	/** 
	 * Returns the start and end range for a given date
	 * in unix timestamp format
	 *
	 * Note: Unit is in seconds
	 *
	 * @param   string	$date
	 * @return  array
	 */
	public static function get_day_range($date)
	{
		if (self::is_valid_format($date, 'Y-m-d'))
		{
			$start = strtotime($date.' 00:00:00');
			// Add 1 day and deduct 1 second
			$end = $start + (3600 * 24) - 1;

			return array($start, $end);
		}

		return FALSE;
	}
}