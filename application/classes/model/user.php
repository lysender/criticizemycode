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
	
	public function rules()
	{
		return array(
			'username' => array(
				array('not_empty'),
				array('max_length', array(':value', 32)),
				array('regex', array(':value', '/^[a-zA-Z0-9_]++$/')),
				array(array($this, 'unique'), array('username', ':value')),
			),
			'password' => array(
				array('not_empty'),
			),
			'email' => array(
				array('not_empty'),
				array('email'),
				array(array($this, 'unique'), array('email', ':value')),
			),
		);
	}	
	
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
	
	/**
	 * Returns user's profile url
	 *
	 * @return string
	 */
	public function get_profile_url()
	{
		return '/profile/'.$this->username;
	}
}