<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Language model class
 *
 */
class Model_Language extends ORM {
	
	protected $_table_columns = array(
		'id' => array(),
		'name' => array(),
		'label' => array(),
	);
	
	/**
	 * Generates a slug based on the title of the code post
	 *
	 * @param string $title
	 * @return string
	 */
	public static function generate_slug($title)
	{
		// Convert all to ascii first
		$slug = UTF8::transliterate_to_ascii($title);
		
		// Lower case and slug style
		$slug = strtolower($slug);
		
		$slug = str_replace(array(' ', '+'), array('-', 'plus'), $slug);
		$slug = preg_replace('/[^0-9a-zA-Z-_]/', '', $slug);
		
		return Text::limit_chars($slug, 100, '');
	}
	
	/**
	 * Code post rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
				array('min_length', array(':value', 2)),
				array('max_length', array(':value', 12)),
				array('regex', array(':value', '[0-9a-zA-Z]')),
				array(array($this, 'unique'), array('name', ':value'))
			),
			'label' => array(
				array('not_empty'),
				array('min_length', array(':value', 2)),
				array('max_length', array(':value', 12)),
				array('regex', array(':value', '/^[-0-9a-zA-Z #+_]++$/')),
				array(array($this, 'unique'), array('label', ':value'))
			)
		);
	}
	
	/**
	 * Returns the set of id=>label pairs for all languages
	 * This is going to be used by form select elements
	 *
	 * @return array
	 */
	public function get_select_options()
	{
		$data = $this->find_all();
		$options = array();
		
		foreach ($data as $lang)
		{
			$options[$lang->id] = $lang->label;
		}
		
		return $options;
	}
}

