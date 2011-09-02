<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * CMC user token
 *
 */
class Model_User_Token extends Model_Auth_User_Token {
	
	/**
	 * Manually defined columns
	 *
	 * @var array
	 */
	protected $_table_columns = array(
		'id' => array(),
		'user_id' => array(),
		'user_agent' => array(),
		'token' => array(),
		'type' => array(),
		'created' => array(),
		'expires' => array(),
	);
	
	/**
	 * Use custom token generator to improve performance
	 * Or better use UUID if available next time
	 *
	 * @return string
	 */
	protected function create_token()
	{
		return uniqid(mt_rand(), TRUE);
	}
}