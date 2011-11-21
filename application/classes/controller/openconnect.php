<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Openconnect extends Controller_Site {
	
	protected $_facebook;

	public function action_index()
	{
		
	}

	public function action_facebook()
	{
		$this->view = View::factory('openconnect/facebook');

		// Start authenticating facebook
		$facebook = new Model_Openconnect_Facebook;
		$status = $facebook->process_auth_response($this->request);
		$signup = array(
			'email' => NULL,
			'username' => NULL
		);

		if ($status === Model_Openconnect_Facebook::STATUS_USER_NOT_REGISTERED)
		{
			$signup['email'] = $facebook->get_email();
			$signup['username'] = $facebook->get_suggested_username();
		}

		if ($username = $this->request->post('username'))
		{
			$signup['username'] = $username;
		}

		switch ($status)
		{
			case Model_Openconnect_Facebook::STATUS_NO_AUTH:
				$facebook->start_auth($this->request, URL::site('/openconnect/facebook', TRUE));
				break;
			case Model_Openconnect_Facebook::STATUS_USER_DECLINED:
				$this->view = View::factory('openconnect/facebook/declined');
				break;
			case Model_Openconnect_Facebook::STATUS_USER_NOT_REGISTERED;
				$this->view = View::factory('openconnect/signup');
				$this->view->signup = $signup;

				break;
			case Model_Openconnect_Facebook::STATUS_USER_REGISTERED:
				// User is already registered, force login him and go back to home page
				$this->auth->force_login($facebook->get_user());
				$this->request->redirect('/');
				break;
			case Model_Openconnect_Facebook::STATUS_ERROR:
				$this->view = View::factory('openconnect/facebook/error');
				break;
		}
	}

	public function action_twitter()
	{
		$this->view = View::factory('openconnect/twitter');
	}

	public function action_google()
	{
		$this->view = View::factory('openconnect/yahoo');
	}

	public function action_yahoo()
	{
		$this->view = View::factory('openconnect/google');
	}

	public function action_signup()
	{
		$this->view = View::factory('openconnect/signup');
		$post = Arr::extract(
			$this->request->post(),
			array('username')
		);

		$post['email'] = 'johndoe@email.com';
		$post['username'] = 'johndoe';
		$this->view->signup = $post;

		if ($this->request->method() === Request::POST)
		{
			
		}
		else
		{
			// Detect if the suggested username already exists
			// $this->message = new Kollection_Message_Success(array(
			// 	'messages' => 'Username johndoe is available'
			// ));

			$this->message = new Kollection_Message_Error(array(
				'messages' => 'Username johndoe already exists, choose a different username'
			));
		}

		// Focus on controller
		$this->script->set_focus_script('username');
	}
}