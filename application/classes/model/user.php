<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends CMC_Auth_User {
	
	protected $_table_name = 'cmc_user';
	
	protected $_primary_key = 'id';
	
	public function rules()
	{
		return array(
			'email' => array(
				array('not_empty'),
				array('email'),
				array(array($this, 'unique'), array(':field', ':value'))
			),
			'password' => array(
				array('not_empty')
			),
			'nickname' => array(
				array('not_empty')
			),
			'date_registered' => array(
				array('not_empty')
			)
		);
	}
}
