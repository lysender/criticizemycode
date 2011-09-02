<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * CMC User model
 *
 */
abstract class Auth extends Kohana_Auth {
	
	/**
	 * Gets the currently logged in user from the session.
	 * Returns NULL if no user is currently logged in.
	 *
	 * @return  mixed
	 */
	public function get_user($default = NULL)
	{
		$id = $this->_session->get($this->_config['session_key'], $default);
		
		if ($id)
		{
			$id = (int) $id;
			
			$user = ORM::factory('user', $id);
			
			if ($user->loaded())
			{
				return $user;
			}
		}
		
		return NULL;
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