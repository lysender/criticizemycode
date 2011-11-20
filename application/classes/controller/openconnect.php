<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Openconnect extends Controller_Site {
	
	protected $_facebook;

	public function action_index()
	{
		
	}

	public function action_facebook()
	{
		// Configure Facebook library
		if ( ! class_exists('Facebook'))
		{
			include Kohana::find_file('vendor', 'facebook/src/facebook');
		}

		$config = Kohana::$config->load('facebook');

		$this->_facebook = new Facebook(array(
			'appId' => $config['app_id'],
			'secret' => $config['secret'],
			'cookie' => $config['cookie']
		));

		$this->view = View::factory('openconnect/facebook');

		// Test open connect
		var_dump($_GET);
		$user = $this->_facebook->getUser();

		if ( ! $user)
		{
			$this->request->redirect($this->_facebook->getLoginUrl(array('scope' => 'email')));
		}
		else
		{
			var_dump($user);

			$profile = $this->_facebook->api('/me');
			var_dump($profile);
		}
		var_dump($_COOKIE, $_SESSION);
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