<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Site extends Controller_Template
{
	/**
	 * @var string
	 */
	public $template = 'site/template';
	
	/**
	 * @var string
	 */
	public $header = 'site/header';
	
	/**
	 * @var Kohana_View
	 */
	public $view;
	
	/**
	 * Sidebar template
	 *
	 * @var string
	 */
	public $sidebar = 'site/sidebar';
	
	/**
	 * @var string
	 */
	public $footer = 'site/footer';
	
	/**
	 * @var Auth
	 */
	public $auth;
	
	/** 
	 * @var Session
	 */
	public $session;
	
	/** 
	 * Whether or not the user is required to be authenticated or not
	 * 
	 * @var boolean
	 */
	protected $_no_auth = TRUE;
	
	/**
	 * Indicates whether or not to track the current page
	 * Set this to FALSE for pages like login/signup or AJAX pages
	 *
	 * @var boolean
	 */
	protected $_track_page = TRUE;
	
	/**
	 * @var string
	 */
	protected $_current_page;
	
	/**
	 * The previously visited page tracked
	 *
	 * @var string
	 */
	protected $_prev_page;
	
	/**
	 * For CSRF token - old token
	 *
	 * @var string
	 */
	protected $_old_token;
	
	/**
	 * For CSRF token - new token
	 *
	 * @var string
	 */
	protected $_new_token;
	
	/** 
	 * Head navigation selected menu
	 * 
	 * @var string
	 */
	protected $_headnav_class = ' class="selected"';
	
	/** 
	 * before()
	 *
	 * Called before action is called
	 */
	public function before()
	{
		// make sure template is initialized first
		parent::before();

		if ($this->auto_render)
		{
			$this->_init_template();
		}
		
		// Initialize session and authentication
		$this->_init_auth();
		
		// Initialize flash messages
		$this->_init_messages();
	}

	/** 
	 * Initializes template
	 * 
	 */
	protected function _init_template()
	{
		$this->template->styles = array(
			'media/css/screen.css'	=> 'screen, projection',
			'media/css/print.css'	=> 'print',
			'media/css/style.css'	=> 'screen, projection',
			'media/css/crud.css'	=> 'screen, projection'
		);

		$this->template->scripts = array(
			'media/js/jquery-1.4.4.min.js'
		);
		
		// Initialize head_scripts and head_readyscripts
		$this->template->head_scripts = '';
		$this->template->head_readyscripts = '';
		
		// Set head nav selected
		View::set_global('head_nav', $this->_current_headnav());
	}
	
	/** 
	 * Initializes session and authentication
	 * 
	 */
	protected function _init_auth()
	{
		// Initialize session
		$this->session = Session::instance();
		
		// Initialize auth if present
		$this->auth = Auth::instance();
		
		$user = $this->auth->get_user();
		
		// Set the old and new csrf token
		$this->_old_token = $this->session->get('csrf_token');
		$this->_new_token = uniqid();
		
		// Set the new token to session
		$this->session->set('csrf_token', $this->_new_token);
		
		// Set username and csrf token to global view template
		if ($this->auto_render)
		{
			View::set_global('csrf_token', $this->_new_token);
			
			if ($user)
			{
				View::set_global('current_user', $user->username);
			}
		}
		
		// Track visited pages
		$this->_prev_page = $this->session->get('prev_page');
		$this->_current_page = $this->request->uri();
		
		// Set previous page from the current page
		if ($this->_track_page)
		{
			$this->session->set('prev_page', $this->_current_page);
		}
		
		// Redirect to login for unauthenticated users
		if ($this->_no_auth === FALSE && ! $user)
		{
			$this->request->redirect('/login');
		}
	}
	
	/** 
	 * Initializes success / error messages passed via session
	 * via flash message pattern
	 * 
	 */
	protected function _init_messages()
	{
		// Display error message to template when there was a passed message
		if ($error_message = $this->session->get_once('error_message'))
		{
			if ($this->auto_render)
			{
				View::bind_global('error_message', $error_message);
			}
		}

		// Display success message to template when there was a passed message
		if ($success_message = $this->session->get_once('success_message'))
		{
			if ($this->auto_render)
			{
				View::bind_global('success_message', $success_message);
			}
		}
	}
	
	/**
	 * after()
	 * 
	 * @see system/classes/kohana/controller/Kohana_Controller_Template#after()
	 */
	public function after()
	{
		if ($this->auto_render)
		{			
			// Template disyplay logic
			$this->template->header = View::factory($this->header);
			
			$this->template->content = $this->view;
			$this->template->sidebar = View::factory($this->sidebar);
			
			$this->template->footer = View::factory($this->footer);			
		}

		return parent::after();
	}
	
	/** 
	 * Sets focus to a form element
	 * 
	 * @param string $id
	 * @return void
	 */
	protected function _page_setfocus($id)
	{
		if ($this->auto_render)
		{
			$this->template->head_readyscripts .= '$("#'.$id.'").focus();'."\n";
		}
	}
	
	/** 
	 * Sets the error message to view
	 * 
	 * @param mixed $error
	 * @param mixed $focus
	 * @return void
	 */
	protected function _page_error($error, $focus = TRUE)
	{
		if ($this->auto_render)
		{
			if (is_array($error))
			{	
				// Merge external errors from orm validation
				// to the main error array
				if ( ! empty($error['_external']))
				{
					$ext = $error['_external'];
					unset($error['_external']);
					
					foreach ($ext as $key => $value)
					{
						$error[$key] = $value;
					}
				}
				
				$error_keys = array_keys($error);
				$first_error = current($error_keys);
				
				$this->view->error_message = implode('<br />', $error);
			
				if ($focus === TRUE)
				{
					$this->_page_setfocus($first_error);
				}
			}
			else
			{
				$this->view->error_message = $error;
			}
			
			if (is_string($focus))
			{
				$this->_page_setfocus($focus);
			}
		}
	}
	
	/** 
	 * Focus to the first error from all given errors
	 * 
	 * @param array $errors
	 */
	protected function _first_error_focus(array $errors)
	{
		$error_keys = array_keys($errors);
		
		if ( ! empty($error_keys))
		{
			$first_error = current($error_keys);
			
			$this->_page_setfocus($first_error);
		}
	}
	
	/** 
	 * Returns the current stats for head nav
	 * 
	 * @return array
	 */
	protected function _current_headnav()
	{
		$stats = array(
			'index' => array(
				'controller' => 'index',
				'title' => 'What\'s New?',
				'tooltip' => 'Latest stuff',
				'class' => NULL,
				'link' => '/',
			),
			'post' => array(
				'controller' => 'post',
				'title' => 'post code',
				'tooltip' => 'Let it be criticized',
				'class' => NULL,
				'link' => '/post',
			),
			'browse' => array(
				'directory' => 'browse',
				'controller' => 'browse',
				'title' => 'browse',
				'tooltip' => 'See wicked codes',
				'class' => NULL,
				'link' => '/browse',
			),
		);
		
		$key = $this->request->controller();
		$dir = $this->request->directory();
		
		if ( ! empty($dir))
		{
			$key = $dir;
		}
		
		if ($key && ! empty($stats[$key]))
		{
			$stats[$key]['class'] = $this->_headnav_class;
		}
		
		return $stats;
	}
	
	/**
	 * Redirects to a page with a message for errors
	 *
	 * @param string $message
	 * @param string $uri
	 * @return void
	 */
	protected function _redirect_error($message, $uri = NULL)
	{
		$this->_site_redirect('error', $message, $uri);
	}
	
	/**
	 * Redirects to a page with a message for success
	 *
	 * @param string $message
	 * @param string $uri
	 * @return void
	 */
	protected function _redirect_success($message, $uri = NULL)
	{
		$this->_site_redirect('success', $message, $uri);
	}
	
	/**
	 * Redirects to a previous page without
	 *
	 * @return void
	 */
	protected function _redirect_previous()
	{
		$this->_site_redirect(NULL, NULL, NULL);
	}
	
	/**
	 * Redirects to a page with ability to bring a message
	 * When $uri is null and there is a previously tracked page,
	 *   it redirects to the page instead
	 *
	 * @param string $type
	 * @param string $message
	 * @param string $uri
	 * @throws Exception
	 * @return void
	 */
	protected function _site_redirect($type = NULL, $message = NULL, $uri = NULL)
	{
		$location = '/';
		
		if ($uri === NULL)
		{
			if ($this->_prev_page)
			{
				$location = $this->_prev_page;
			}
		}
		else
		{
			$location = $uri;
		}
		
		if ($type && $message && in_array($type, array('error', 'success')))
		{
			$this->session->set($type.'_message', $message);
		}
		
		$this->request->redirect($location);
	}
}
