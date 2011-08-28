<?php defined('SYSPATH') or die('No direct script access.');

class CMC_Auth_Token extends ORM {
	
	/** 
	 * Loads the token record to this token object
	 * Should not load expired tokens
	 * 
	 * @param string $token
	 */
	public function load_token($token)
	{
		$this->where('token', '=', $token)->find();
		
		return $this;
	}
	
	/**
	 * Returns true if the token is valid
	 * Token must not be expired
	 * Token must match the current user agent
	 * 
	 * @return boolean
	 */
	public function valid_token()
	{
		if ($this->loaded() && $this->expires >= time())
		{
			if ($this->user_agent === sha1(Request::$user_agent))
			{
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	/**
	 * Generates a new token for the specified user
	 * 
	 * @param int $user_id
	 * @param int $expires
	 * @return $this
	 */
	public function generate($user_id, $expires)
	{
		$this->user_id = $user_id;
		$this->expires = $expires;
		
		$this->_before_save();
		
		return $this->create();
	}
	
	/** 
	 * Regenerate from a loaded token to create a new unique token
	 * 
	 * @param int $expires
	 * @return $this
	 */
	public function regenerate($expires)
	{
		$this->expires = $expires;
		
		$this->_before_save();
		
		return $this->update();
	}
	
	/** 
	 * Fills user data before the record is created or updated
	 * 
	 * @return void
	 */
	protected function _before_save()
	{
		$this->user_agent = sha1(Request::$user_agent);
		$this->token = uniqid(microtime(), TRUE);
		$this->created = time();
	}
	
	/**
	 * Deletes all tokens for a certain user
	 * 
	 * @param string $user_id
	 * @return $this
	 */
	public function delete_by_user($user_id)
	{
		DB::delete($this->_table_name)
			->where('user_id', '=', $user_id)
			->execute($this->_db);
		
		return $this;
	}
	
	/**
	 * Deletes all expired tokens.
	 * Performed via cron
	 *
	 * @return Sprig
	 */
	public function delete_expired()
	{
		// Delete all expired tokens
		// Delete tokens only for autologin
		DB::delete($this->_table_name)
			->where('expires', '<', time())
			->execute($this->_db);

		return $this;
	}
}