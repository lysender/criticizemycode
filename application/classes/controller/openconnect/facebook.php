<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Openconnect_Facebook extends Controller_Site {

	public function action_index()
	{
		// Start authenticating facebook
		$facebook = new Model_Openconnect_Facebook;
		$status = $facebook->process_auth_response($this->request);

		switch ($status)
		{
			case Model_Openconnect_Facebook::STATUS_NO_AUTH:
				$facebook->start_auth($this->request);
				break;
			case Model_Openconnect_Facebook::STATUS_USER_DECLINED:
				$this->view = View::factory('openconnect/facebook/declined');
				break;
			case Model_Openconnect_Facebook::STATUS_USER_NOT_REGISTERED;
				$this->view = View::factory('openconnect/signup');
				$this->view->form_action = '/openconnect/facebook';
				$this->view->signup = array(
					'email' => $facebook->get_email(),
					'username' => $facebook->get_suggested_username()
				);
				$this->_signup($facebook);
				$this->script->set_focus_script('username');
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

	protected function _check_email(Model_Openconnect_Facebook $facebook)
	{
		$email = $facebook->get_email();
		$valid = TRUE;

		if ($email)
		{
			$user = ORM::factory('user')->where('email', '=', $email)->find();

			if ($user->loaded())
			{
				$this->message = new Kollection_Message_Error(array(
					'messages' => 'Email address '.$email.' already exists, choose a different sign-in/sign-up method instead.'
				));

				$valid = FALSE;
			}
		}
		else 
		{
			throw new Exception('No email address found in third party authentication.');
		}

		return $valid;
	}

	/**
	 * Hard core signup process
	 * 
	 * @param   Model_Openconnect_Facebook $facebook
	 * @return  boolean
	 */
	protected function _signup(Model_Openconnect_Facebook $facebook)
	{
		$valid_email = $this->_check_email($facebook);

		if ($this->request->method() === Request::POST)
		{
			if ($this->request->post('csrf') === $this->_old_token && $valid_email)
			{
				$user = ORM::factory('user');
				$data = array(
					'username' => $this->request->post('username'),
					'email' => $facebook->get_email(),
					'password' => uniqid(microtime(), TRUE)
				);

				try
				{
					if ($facebook->create_user($this->request->post('username')))
					{
						// Force login the user
						$auth = Auth::instance();
						$auth->force_login($user);
						
						// Redirect to home page
						$this->request->redirect('/');
					}
				}
				catch (ORM_Validation_Exception $e)
				{
					$this->message = new Message_Error_Signup(array(
						'messages' => $e->errors('user')
					));
				}
			}
			else
			{
				$this->message = new Kollection_Message_Error(array(
					'messages' => '<strong>ERROR!</strong> Session time out, try again.'
				));
			}
		}
	}
}