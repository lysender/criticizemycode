<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Openconnect_Twitter extends Controller_Site {

	public function action_index()
	{
		$this->view = View::factory('openconnect/twitter/index');
		$twitter = new Model_Openconnect_Twitter($this->request, $this->session);
		$twitter->start_auth();
	}

	public function action_callback()
	{
		$this->view = View::factory('openconnect/twitter/callback');

		$twitter = new Model_Openconnect_Twitter($this->request, $this->session);
		$twitter->process_callback();

		switch ($twitter->get_status())
		{
			case Model_Openconnect_Twitter::STATUS_NO_AUTH:
				$this->request->redirect('/login');
				break;
			case Model_Openconnect_Twitter::STATUS_USER_DECLINED:
				$this->request->redirect('/openconnect/twitter/declined');
				break;
			case Model_Openconnect_Twitter::STATUS_USER_REGISTERED:
				// User is already registered, force login and go back to home page
				$this->auth->force_login($twitter->get_user());
				$this->request->redirect('/');
				break;
			case Model_Openconnect_Twitter::STATUS_USER_NOT_REGISTERED:
				$this->request->redirect('/openconnect/twitter/signup');
				break;
			default:
				$this->request->redirect('/openconnect/twitter/error');
				break;
		}
	}

	public function action_declined()
	{
		$this->view = View::factory('openconnect/twitter/declined');
	}

	public function action_signup()
	{
		$this->view = View::factory('openconnect/twitter/signup');

		$twitter = new Model_Openconnect_Twitter($this->request, $this->session);
	}

	public function action_error()
	{
		$this->view = View::factory('openconnect/twitter/error');
	}
}