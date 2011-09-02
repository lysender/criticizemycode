<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * CMC User model
 *
 */
class Model_Role extends Model_Auth_Role {
	
	/**
	 * Manually defined table columns
	 *
	 * @var array
	 */
	protected $_table_columns = array(
		'id' => array(),
		'name' => array(),
		'description' => array(),
	);
}