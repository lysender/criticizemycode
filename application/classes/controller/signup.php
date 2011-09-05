<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Signup controller
 *
 */
class Controller_Signup extends Controller_Site
{
	/**
	 * Allows no login
	 *
	 * @var boolean
	 */
	protected $_no_auth = TRUE;
	
	/**
	 * Signup form page
	 *
	 */
	public function action_index()
	{
		// Make sure that the user is logged out
		if ($this->auth->logged_in())
		{
			$this->auth->logout();
			
			$this->request->redirect('/signup');
		}
		
		$this->template->title = 'Signup';
		$this->view = View::factory('signup/index');
		
		// Assign back the posted data to form except for passwords
		$this->view->signup = Arr::extract(
			$this->request->post(),
			array('username', 'email')
		) + array('password' => '', 'password_confirm' => '');
		
		if ($this->request->method() == Request::POST)
		{
			if ($this->_signup())
			{
				$this->session->set('signup_success_token', uniqid(mt_rand(), TRUE));
				$this->request->redirect('/signup/success');
			}
		}
		else
		{
			$this->_page_setfocus('username');
		}
	}
	
	/**
	 * Hard core signup process
	 *
	 * @return boolean
	 */
	protected function _signup()
	{
		if ($this->request->post('csrf') === $this->_old_token)
		{
			$user = ORM::factory('user');
			
			try
			{
				$user->create_user(
					$this->request->post(),
					array('username', 'email', 'password')
				);
				
				if ( ! $user->loaded())
				{
					throw new Exception('User is not properly loaded during signup');
				}
				
				// Create login role for this user
				if ( ! $user->create_login_role())
				{
					throw new Exception('User has not been granted with login role during signup');
				}
				
				// Force login the user
				$auth = Auth::instance();
				$auth->force_login($user);
				
				return TRUE;
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->_page_error($e->errors('user'));
			}
		}
		else
		{
			$this->_page_error('Session time out, try again.', 'username');
		}
		
		return FALSE;
	}
	
	/**
	 * Signup success page
	 *
	 */
	public function action_success()
	{
		$this->template->title = 'Signup successfull!';
		$this->view = View::factory('signup/success');
		
		$success_token = $this->session->get_once('signup_success_token');
		
		if ( ! $success_token)
		{
			$this->request->redirect('/');
		}
	}
}
