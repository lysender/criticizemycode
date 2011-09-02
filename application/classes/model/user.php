<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * CMC User model
 *
 */
class Model_User extends Model_Auth_User {
	
	/**
	 * Manually defined table columns
	 *
	 * @var array
	 */
	protected $_table_columns = array(
		'id' => array(),
		'email' => array(),
		'username' => array(),
		'password' => array(),
		'logins' => array(),
		'last_logins' => array(),
	);
}