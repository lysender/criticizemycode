<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Unit tests for Kollection_Message helper class
 *
 */
class Unit_Message_Error_SignupTest extends Kohana_Unittest_TestCase {

	public function test_error()
	{
		$v = View::factory('kollection/message/list');

		$messages = array(
			'username' => 'Username not entered',
			'email' => 'Email not entered',
			'password' => 'Password not entered'
		);

		$v->set('type', Kollection_Message::TYPE_ERROR)
			->set('title', '<strong>ERROR!</strong> Signup failed due to the following errors. Please check and try again.')
			->set('messages', $messages);

		$m = new Message_Error_Signup(array(
			'messages' => $messages
		));

		$this->assertEquals($v->render(), $m->render());
	}
}
