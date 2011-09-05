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
		'last_login' => array(),
	);
	
	/**
	 * Create login role for the current user
	 *
	 * @return boolean
	 */
	public function create_login_role()
	{
		$role = ORM::factory('role', array('name' => 'login'));
		
		if ($role->loaded() && $this->loaded())
		{
			$role->add('users', $this);
			
			return TRUE;
		}
		
		return FALSE;
	}
}