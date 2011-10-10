<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Javascript helper class for page scripts
 *
 */
abstract class Pagescript_Js {
	
	/**
	 * Returns a js script for focusing on a certain form element
	 *
	 * @param string $field
	 * @return string
	 */
	abstract public function focus($field);
	
	/**
	 * Returns the ready script with contents
	 *
	 * @param string $contents
	 * @return string
	 */
	abstract public function ready_script($contents);
	
	/**
	 * Returns the deferred script with contents
	 *
	 * @param string $contents
	 * @return string
	 */
	abstract public function deferred_script($contents);
	
	/**
	 * Returns the script tag with contents
	 *
	 * @param string $contents
	 * @return string
	 */
	public function script_tag($contents)
	{
		$s = '';
		
		if ($contents)
		{
			$s = '<script type="text/javascript">'
				."\n".$contents."\n"
				.'</script>';
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
	 * @return string
	 */
	abstract public function highlight_error($field);
}