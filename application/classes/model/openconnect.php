<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Open connect model class
 *
 * @package Model_Openconnect
 * @author Lysender <leonel@lysender.com>
 */
class Model_Openconnect extends ORM {

	protected $_table_name = 'openconnect';

	/**
	 * @var array
	 */
	protected $_belongs_to = array(
		'user' => array(
			'model' => 'user',
			'foreign_key' => 'user_id'
		)
	);
	
	/**
	 * Pre-defined table columns
	 *
	 * @var array
	 */
	protected $_table_columns = array(
		'id' => array(),
		'user_id' => array(),
		'third_party_name' => array(),
		'third_party_identifier' => array(),
	);
}