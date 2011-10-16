<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Kohana_Text extension
 *
 */
class Text extends Kohana_Text {
	
	/**
	 * Generates a slug based on the given string
	 * When limit is given, it reduces the generated characters to
	 * that given limit
	 *
	 * @param  string	$str
	 * @param  int 		$limit
	 * @return string
	 */
	public static function generate_slug($str, $limit = NULL)
	{
		// Convert all to ascii first
		$slug = UTF8::transliterate_to_ascii($str);
		
		// Lower case and slug style
		$slug = strtolower($slug);
		
		$slug = str_replace(array(' ', '+'), array('-', 'plus'), $slug);
		$slug = preg_replace('/[^0-9a-zA-Z-_]/', '', $slug);
		
		return Text::limit_chars($slug, $limit, '');
	}
}