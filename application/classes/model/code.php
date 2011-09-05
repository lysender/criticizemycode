<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Code model class
 *
 */
class Model_Code extends ORM {
	
	protected $_table_name = 'cmc_code';
	
	/**
	 * Code post belons to user
	 *
	 * @var array
	 */
	protected $_belongs_to = array(
		'user' => array(
			'model' => 'user',
			'foreign_key' => 'user_id'
		)
	);
	
	protected $_table_columns = array(
		'id' => array(),
		'user_id' => array(),
		'title' => array(),
		'slug_title' => array(),
		'post_content' => array(),
		'date_posted' => array(),
		'date_modified' => array(),
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
			'title' => array(
				array('not_empty'),
				array('min_length', array(':value', 5)),
				array('max_length', array(':value', 100))
			),
			'post_content' => array(
				array('not_empty'),
				array('min_length', array(':value', 50)),
				array('max_length', array(':value', 3000))
			)
		);
	}
	
	/**
	 * Creates a code post
	 *
	 * @param array $values
	 * @return boolean
	 * @throws ORM_Validation_Exception
	 */
	public function create_post(array $values)
	{
		// Generate slug if present
		if ( ! empty($values['title']))
		{
			$this->slug_title = self::generate_slug($values['title']);
		}
		
		$this->values($values, array('title', 'post_content'));
		
		$this->user = Auth::instance()->get_user();
		
		if (empty($this->user) || ! $this->user->loaded())
		{
			throw new Exception('User is not properly set for creating code post');
		}
		
		$this->date_posted = time();
		
		return $this->create();
	}
}