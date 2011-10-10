<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Form error for signup form
 *
 */
class Form_Error_Signup extends Form_Error {
	
	protected $_arrangement = array(
		'username',
		'email',
		'password',
		'password_confirm'
	);
}