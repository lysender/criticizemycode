<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Form error helper class
 * Allows highlighting form fields, and focusing on error fields
 * using jQuery
 *
 */
class Form_Error {
	
	/**
	 * Error messages
	 *
	 * @var array
	 */
	protected $_errors = array();
	
	/**
	 * Title for the error message
	 *
	 * @var string
	 */
	protected $_title = 'Form was not submitted due to the following error(s):';
	
	/**
	 * When present, re-arranges the error messages in the order
	 * specified in this array
	 *
	 * @var array
	 */
	protected $_arrangement = array();
	
	/**
	 * Adds a form field error
	 *
	 * @param string $field
	 * @param string $message
	 * @return Form_Error
	 */
	public function add_error($field, $message)
	{
		$this->_errors[$field] = $message;
		
		return $this;
	}
	
	/**
	 * Adds errors as an array, key is form field, value is message
	 * 
	 * Also supports ORM external error messages and merges them
	 * into the main array of errors
	 *
	 * @param array $errors
	 * @return Form_Error
	 */
	public function add_errors(array $errors)
	{
		// Merge external errors from orm validation
		// to the main error array
		if ( ! empty($errors['_external']))
		{
			$ext = $errors['_external'];
			unset($errors['_external']);
			
			foreach ($ext as $key => $value)
			{
				$errors[$key] = $value;
			}
		}
		
		foreach ($errors as $field => $message)
		{
			$this->_errors[$field] = $message;
		}
		
		return $this;
	}
	
	/**
	 * Sets the title for the form error messages
	 *
	 * @param string $title
	 * @return Form_Error
	 */
	public function set_title($title)
	{
		$this->_title = $title;
	}
	
	/**
	 * Returns true when form has errors
	 *
	 * @return boolean
	 */
	public function has_errors()
	{
		return ! empty($this->_errors);
	}
	
	/**
	 * Re-arrange the error messages as specified in the arrangement array
	 *
	 * @return array
	 */
	protected function _sort()
	{
		$errors = $this->_errors;
		
		if ( ! empty($this->_arrangement))
		{
			$tmp = array();
			
			foreach ($this->_arrangement as $key)
			{
				if (isset($errors[$key]))
				{
					$tmp[$key] = $errors[$key];
				}
			}
			
			$errors = $tmp;
		}
		
		return $errors;
	}
	
	/**
	 * Returns the errors in array format
	 *
	 * @return array
	 */
	public function get_errors()
	{
		return $this->_sort();
	}
	
	/**
	 * Returns the error title
	 *
	 * @return string
	 */
	public function get_title()
	{
		return $this->_title;
	}
	
	/**
	 * Returns the focus script to focus on the first error field
	 *
	 * @return string
	 */
	public function get_focus_script()
	{
		$fields = array_keys($this->_errors);
		$script = '';
		
		if ( ! empty($fields))
		{
			$key = array_shift($fields);
			
			$script = sprintf('$("#%s").focus();', $key)."\n";
		}
		
		return $script;
	}
	
	/**
	 * Returns the script used to highlight the error fields
	 *
	 * @return string
	 */
	public function get_highlight_script()
	{
		$script = '';
		
		if ($this->has_errors())
		{
			$fields = array_keys($this->_errors);
			$s = array();
			
			// Using the bootstrap css convention, the parent of every form
			// element ins wrapped in a div with clearfix class
			foreach ($fields as $field)
			{
				$s[] = sprintf('$("#%s").parents("div.clearfix").addClass("error");', $field);
			}
			
			$script = implode("\n", $s);
		}
		
		return $script;
	}
}