<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Unit tests for Kollection_Message helper class
 *
 */
class Unit_Message_Error_PostTest extends Kohana_Unittest_TestCase {

	public function test_error()
	{
		$v = View::factory('kollection/message/list');

		$messages = array(
			'title' => 'Title not entered',
			'content' => 'Content not entered',
		);

		$v->set('type', Kollection_Message::TYPE_ERROR)
			->set('title', '<strong>ERROR!</strong> Your code was not submitted due to the following errors. Please check and try again:')
			->set('messages', $messages);

		$m = new Message_Error_Post(array(
			'messages' => $messages
		));

		$this->assertEquals($v->render(), $m->render());
	}
}
