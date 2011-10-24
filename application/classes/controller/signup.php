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
	 * Don't track page
	 *
	 * @var boolean
	 */
	protected $_track_page = FALSE;
	
	/**
	 * @var Model_User
	 */
	protected $_signup_user;
	
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
				$this->session->set(
					'success_message',
					sprintf('Hi <strong>%s</strong>, your account is now ready to use', $this->_signup_user->username)
				);
				
				if ($this->_prev_page)
				{
					$this->request->redirect($this->_prev_page);
				}
				else
				{
					$this->request->redirect('/');
				}
			}
		}
		else
		{
			$this->get_script()->set_focus_script('username');
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
			$this->_signup_user = ORM::factory('user');
			
			try
			{
				$this->_signup_user->create_user(
					$this->request->post(),
					array('username', 'email', 'password')
				);
				
				if ( ! $this->_signup_user->loaded())
				{
					throw new Exception('User is not properly loaded during signup');
				}
				
				// Create login role for this user
				if ( ! $this->_signup_user->create_login_role())
				{
					throw new Exception('User has not been granted with login role during signup');
				}
				
				// Force login the user
				$auth = Auth::instance();
				$auth->force_login($this->_signup_user);
				
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
}
