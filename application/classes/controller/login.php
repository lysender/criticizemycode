<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Login controller
 * 
 * Handles login and logout
 */
class Controller_Login extends Controller_Site
{
	/** 
	 * Allows no login
	 * 
	 * @var boolean
	 */
	protected $_no_auth = TRUE;
	
	/** 
	 * Login page
	 * 
	 */
	public function action_index()
	{
		$this->template->title = 'Login';
		$this->view = View::factory('login/index');
		
		// Assign back the posted credentials to form except for password
		$this->view->login = Arr::extract(
			$this->request->post(),
			array('email', 'remember')
		) + array('password' => '');
		
		if ($this->request->method() == Request::POST)
		{
			if ($this->_login())
			{
				$this->request->redirect('/');
			}
		}
		else
		{
			$this->_page_setfocus('email');
		}
	}
	
	/**
	 * Returns true if and only if logging in succeeds
	 *
	 * @return boolean
	 */
	protected function _login()
	{
		if ($this->request->post('csrf') === $this->_old_token)
		{
			if ($this->auth->login(
				$this->request->post('email'),
				$this->request->post('password'),
				(bool) $this->request->post('remember')
			))
			{
				return TRUE;
			}
			else
			{
				$this->_page_error('Incorrect username or password.', 'email');
			}
		}
		else
		{
			$this->_page_error('Session time out, try again.', 'email');
		}
		
		return FALSE;
	}
	
	/**
	 * Logs out the user
	 *
	 */
	public function action_logout()
	{
		$this->auto_render = false;
		
		if ($this->_old_token === $this->request->param('id'))
		{
			$this->auth->logout();
		}
		
		// Go back to main
		$this->request->redirect('/');
	}
}
