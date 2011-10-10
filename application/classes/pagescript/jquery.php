<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Javascript helper class jQuery - for page scripts
 *
 */
class Pagescript_Jquery extends Pagescript_Js {
	
	/**
	 * Returns a js script for focusing on a certain form element
	 *
	 * @param string $field
	 * @return string
	 */
	public function focus($field)
	{
		$s = '$("#'.$field.'").focus();'."\n";
		return $s;
	}
	
	/**
	 * Returns the ready script with contents
	 *
	 * @param string $contents
	 * @return string
	 */
	public function ready_script($contents)
	{
		$s = '';
		
		if ($contents)
		{
			$s = '$(function(){'
				."\n".$contents."\n"
				.'});';
		}
		
		return $contents;
	}
	
	/**
	 * Returns the deferred script with contents
	 *
	 * @param string $contents
	 * @return string
	 */
	public function deferred_script($contents)
	{
		$s = '';
		
		if ($contents)
		{
			$s = '$(window).load(function(){'
				."\n".$contents."\n"
				.'});';
		}
		
		return $s;
	}
}