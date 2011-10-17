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
	 * @var Auth
	 */
	protected $_auth;
	
	/**
	 * Returns auth instance
	 *
	 * @return Auth
	 */
	public function get_auth()
	{
		if ($this->_auth === NULL)
		{
			$this->_auth = Auth::instance();
		}
		
		return $this->_auth;
	}
	
	/**
	 * Sets the auth instance
	 *
	 * @param  Auth		$auth
	 * @return Model_User
	 */
	public function set_auth(Auth $auth)
	{
		$this->_auth = $auth;
		
		return $this;
	}
	
	/**
	 * Rules for user model
	 *
	 * @return array
	 */
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
	 * Filters field values before inserting/updating to database
	 *
	 * @return array
	 */
	public function filters()
	{
		$auth = $this->get_auth();
		
		return array(
			'username' => array(
				array('trim')
			),
			'password' => array(
				array(array($auth, 'hash'))
			)
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