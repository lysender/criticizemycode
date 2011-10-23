<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * An extension to Kohana_Auth
 *
 */
abstract class Auth extends Kohana_Auth {
	
	/**
	 * @var Model_User
	 */
	protected $_user;
	
	/**
	 * Gets the currently logged in user from the session.
	 * Returns NULL if no user is currently logged in.
	 *
	 * @return mixed
	 * @uses   Model_User
	 */
	public function get_user($default = NULL)
	{
		if ($this->_user instanceof Model_User && $this->_user->loaded())
		{
			return $this->_user;
		}
		
		$id = $this->_session->get($this->_config['session_key'], $default);
		
		if ($id)
		{	
			$user = ORM::factory('user', (int) $id);
			
			if ($user->loaded())
			{
				$this->_user = $user;
				
				return $this->_user;
			}
		}
		
		return NULL;
	}
	
	/**
	 * Sets the user model
	 *
	 * @param  Model_User $user
	 * @return Auth
	 */
	public function set_user(Model_User $user)
	{
		$this->_user = $user;
		
		return $this;
	}
	
	/**
	 * Override default behavior so that only the use id is saved
	 * into the session
	 *
	 * @param Model_User $user
	 * @return boolean
	 */
	protected function complete_login($user)
	{
		// Regenerate session_id
		$this->_session->regenerate();

		// Store username in session
		$this->_session->set($this->_config['session_key'], $user->id);

		return TRUE;
	}
}