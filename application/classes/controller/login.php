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
		
		$credentials = Arr::extract($_POST, array('email', 'password', 'remember'));
		$this->view->login = $credentials;
		
		if ($this->request->method() == Request::POST)
		{
			$auth = CMC_Auth::instance();
			$user = ORM::factory('user');
			$token = ORM::factory('token');
			
			$validation = Validation::factory($_POST);
			
			if ($auth->login($user, $credentials, $token))
			{
				$this->request->redirect('/');
			}
			else
			{
				$this->_page_error('Incorrect email or password', 'email');
			}
		}
		else
		{
			$this->_page_setfocus('email');
		}
	}
	
	public function action_logout()
	{
		$this->auto_render = false;
		
		if (Security::check($this->request->param('id')))
		{
			$this->auth->logout();
		}
		
		// Go back to main
		$this->request->redirect('/');
	}
}
