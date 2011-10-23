<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Language model class
 *
 */
class Model_Language extends ORM {
	
	/**
	 * Pre-defined table columns
	 * 
	 * @var array
	 */
	protected $_table_columns = array(
		'id' => array(),
		'name' => array(),
		'label' => array(),
	);
	
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
	
	/**
	 * Returns true if the langauge id exists on the database
	 *
	 * @param  int		$language_id
	 * @return boolean
	 */
	public function valid_language($language_id)
	{
		$language_id = (int) $language_id;
		
		if ( ! $language_id)
		{
			return FALSE;
		}
		
		$model = new self;
		$model->where('id', '=', $language_id)->find();
		
		return $model->loaded();
	}
}

