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
	 * @var  boolean
	 */
	protected $_no_auth = TRUE;
	
	/**
	 * Don't track page
	 *
	 * @var  boolean
	 */
	protected $_track_page = FALSE;
	
	/** 
	 * Login page
	 * 
	 */
	public function action_index()
	{
		$this->template->head->title = 'Login';
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
				// If user is an administrator, always redirect to admin page
				if ($this->auth->get_user()->has('roles', ORM::factory('role', array('name' => 'admin'))))
				{
					$this->request->redirect('/admin');
				}
				else
				{
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
		}
		
		$this->script->set_focus_script('email');
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
				$this->message = new Kollection_Message_Error(array(
					'messages' => '<strong>ERROR!</strong> Incorrect username or password.'
				));
			}
		}
		else
		{
			$this->message = new Kollection_Message_Error(array(
				'messages' => '<strong>ERROR!</strong> Session time out, try again.'
			));
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
		
		if ($this->request->method() === Request::POST && $this->_old_token === $this->request->post('csrf'))
		{
			$this->auth->logout();
		}
		
		$this->redirect_previous();
	}
}
