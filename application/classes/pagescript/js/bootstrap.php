<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Bootstrap css framework specific js script helper
 * and extension to Pagescript
 *
 * @package Pagescript
 * @author lysender
 */
class Pagescript_Js_Bootstrap extends Pagescript_Js_Jquery {
	
	/**
	 * Highlights the form element that has error
	 * This element should conform to the bootstrap form convention
	 *
	 * @param string $field
	 * @return string
	 */
	public function highlight_error($field)
	{
		// In bootstrap framework, each form element is wrapped in a div
		// with class "clearfix" which represents the whole block for that
		// form element
		$s = '$("#'.$field.'").addClass("error").parents("div.clearfix").addClass("error");';
		
		return $s;
	}
}