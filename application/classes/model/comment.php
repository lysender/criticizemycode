<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Code comment model class
 *
 */
class Model_Comment extends ORM {
	
	/**
	 * @var array
	 */
	protected $_belongs_to = array(
		'code' => array(
			'model' => 'code',
			'foreign_key' => 'code_id'
		),
		'user' => array(
			'model' => 'user',
			'foreign_key' => 'user_id'
		)
	);
	
	protected $_table_columns = array(
		'id' => array(),
		'code_id' => array(),
		'user_id' => array(),
		'comment' => array(),
		'date_posted' => array(),
		'date_modified' => array(),
	);
	
	/**
	 * Code comment post rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			'comment' => array(
				array('not_empty'),
				array('min_length', array(':value', 10)),
				array('max_length', array(':value', 2000))
			)
		);
	}
	
	/**
	 * Filters field values before inserting/updating to database
	 *
	 * @return array
	 */
	public function filters()
	{
		return array(
			'comment' => array(
				array('trim')
			)
		);
	}
}
