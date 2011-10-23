<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Javascript helper class for page scripts
 *
 * @package Pagescript
 * @author lysender
 */
class Pagescript_Js {
	
	/**
	 * Returns a js script for focusing on a certain form element
	 *
	 * @param string $field
	 * @return string or NULL
	 */
	public function focus($field)
	{
		return NULL;
	}
	
	/**
	 * Returns the ready script with contents
	 *
	 * @param string $contents
	 * @return string or NULL
	 */
	public function ready($contents)
	{
		return NULL;
	}
	
	/**
	 * Returns the deferred script with contents
	 *
	 * @param string $contents
	 * @return string or NULL
	 */
	public function deferred($contents)
	{
		return NULL;
	}
	
	/**
	 * Returns the script tag with contents
	 *
	 * @param string $contents
	 * @return string
	 */
	public function generate_tag($contents)
	{
		$s = '';
		
		if ($contents)
		{
			$s = '<script type="text/javascript">'
				."\n".$contents."\n"
				.'</script>'."\n";
		}
		
		return $s;
	}
	
	/**
	 * Generates a javascript variable script
	 *
	 * @param string $variable
	 * @param mixed $value
	 * @return string
	 */
	public function js_var($variable, $value)
	{
		$v = 'var '.$variable.' = ';
		
		if (is_int($value) || is_float($value) || is_double($value) || is_bool($value))
		{
			$v .= $value.";\n";
		}
		else if (is_array($value) || is_object($value))
		{
			$v .= json_encode($value).";\n";
		}
		else
		{
			$v .= '"'.$value.'";'."\n";
		}
		
		return $v;
	}
	
	/**
	 * Highlights the form field for errors
	 *
	 * @param string $field
	 * @return string or NULL
	 */
	public function highlight_error($field)
	{
		return NULL;
	}
}