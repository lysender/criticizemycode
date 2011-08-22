<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Token extends CMC_Auth_Token {
	
	protected $_table_name = 'cmc_token';
	
	protected $_primary_key = 'id';
	
	public function rules()
	{
		return array(
			'user_id' => array(
				array('not_empty')
			),
			'user_agent' => array(
				array('not_empty')
			),
			'token' => array(
				array(array($this, 'unique'), array(':field', ':value'))
			),
			'created' => array(
				array('not_empty')
			),
			'expires' => array(
				array('not_empty')
			)
		);
	}
}
