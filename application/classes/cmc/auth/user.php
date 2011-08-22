<?php defined('SYSPATH') or die('No direct script access.');

class CMC_Auth_User extends ORM {
	
	/** 
	 * Salt for hashing
	 * 
	 * @var string
	 */
	protected $_secret_key = 'gAcCNWHM4ysWyhYTHF8kygWfoTu2bq9L';
	
	/** 
	 * Identity field used by auth object
	 * 
	 * @var string
	 */
	protected $_identity_field = 'email';
	
	/**
	 * Hashes the string
	 * 
	 * @param string $str
	 * @return string
	 */
	public function hash($str)
	{
		return hash_hmac('sha256', $str, $this->_secret_key);
	}
	
	/**
	 * Returns the user's identity
	 * 
	 * @return mixed
	 */
	public function identity()
	{
		if ($this->loaded())
		{
			$field = $this->_identity_field;
		
			return $this->$field;
		}
		
		return NULL;
	}
	
	/** 
	 * Logins in the user based on the given credentials
	 * Also loads the user to the current user object
	 * 
	 * @param array $credentials
	 * 
	 * @return boolean
	 */
	public function login(array $credentials)
	{
		$required = array('email', 'password');
		
		foreach ($required as $field)
		{
			if ( ! isset($credentials))
			{
				throw new CMC_Auth_Exception('Required field '.$field.' is not specified');
			}
		}
		
		$this->load_user($credentials['email']);
		
		if ($this->loaded())
		{
			if ($this->password === $this->hash($credentials['password']))
			{
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	/**
	 * Action after a succesful login
	 * 
	 * @return $this
	 */
	public function after_login()
	{
		// Update the number of logins
		$this->logins = $this->logins + 1;

		// Set the last login date
		$this->last_login = time();

		// Save the user data
		$this->update();
		
		return $this;
	}
	
	/**
	 * Loads the user based on the specified identity
	 * User must be active
	 * 
	 * @param string $identity
	 * @return $this
	 */
	public function load_user($identity)
	{
		return $this->_load_user('email', $identity);
	}
	
	/** 
	 * Loads the user by id
	 * 
	 * @param int $user_id
	 */
	public function load_by_id($user_id)
	{
		return $this->_load_user('id', (int) $user_id);
	}
	
	/** 
	 * Loads the user using the specified key
	 * 
	 * @param string $field
	 * @param mixed $value
	 * @throws CMC_Auth_Exception
	 */
	public function _load_user($field, $value)
	{
		// User must not be loaded
		if ($this->loaded())
		{
			throw new Dc_Auth_Exception('No user must be loaded before loading user');
		}
		
		$this->where($field, '=', $value)->find();
		
		return $this;
	}
}