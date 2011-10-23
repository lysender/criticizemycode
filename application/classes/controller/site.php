<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Base for all controllers which contains several custom methods
 * used for basic site features and request validations
 *
 */
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
	 * @var Form_Error
	 */
	public $form_error;
	
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
	 * Whether or not the request is for ajax only
	 * There are requests the redirects when invalid in context, in this case
	 * ajax only requests are handled different and simply returns an error code
	 * as header and don't redirect instead
	 *
	 * @var boolean
	 */
	protected $_ajax_only = FALSE;
	
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
	 * Whether or not to use token and renew it automatically
	 *
	 * @var boolean
	 */
	protected $_use_token = TRUE;
	
	/** 
	 * Head navigation selected menu
	 * 
	 * @var string
	 */
	protected $_headnav_class = ' class="selected"';
	
	/**
	 * @var Pagescript
	 */
	protected $_pagescript;
	
	/**
	 * Returns the pagescript object
	 *
	 * @return Pagescript
	 */
	public function get_pagescript()
	{
		if ($this->_pagescript === NULL)
		{
			// Configure pagescript object
			$this->_pagescript = new Pagescript;
			$this->_pagescript->set_js_adapter(new Pagescript_Js_Bootstrap);
		}
		
		return $this->_pagescript;
	}
	
	/**
	 * Sets the pagescript object
	 *
	 * @param Pagescript $pagescript
	 * @return Controller
	 */
	public function set_pagescript(Pagescript $pagescript)
	{
		$this->_pagescript = $pagescript;
		
		return $this;
	}
	
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
		
		// Initialize form error object
		$this->form_error = new Form_Error;
	}

	/** 
	 * Initializes template
	 * 
	 */
	protected function _init_template()
	{
		$this->template->styles = array(
			'media/css/bootstrap.min.css'	=> 'screen, projection',
			'media/css/print.css'	=> 'print',
			'media/css/style.css'	=> 'screen, projection',
			'media/css/crud.css'	=> 'screen, projection'
		);
		
		$ps = $this->get_pagescript();
		
		$ps->set_cache_buster('?v='.APP_VERSION)
			->add_file('media/js/jquery-1.4.4.min.js')
			->add_file('media/bootstrap/js/bootstrap-alerts.js')
			->add_global_script(
				$ps->get_js_adapter()
					->js_var('base_url', URL::site('/'))
			);
		
		$this->template->pagescript = $ps;
		
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
		
		if ($this->_use_token)
		{
			// Set the old and new csrf token
			$this->_old_token = $this->session->get('csrf_token');
			$this->_new_token = uniqid();
			
			// Set the new token to session
			$this->session->set('csrf_token', $this->_new_token);
		}
		
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
			if ($this->_ajax_only)
			{
				$this->send_forbidden_headers();
			}
			else
			{
				$this->request->redirect('/login');
			}
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
			// Finalize scripts
			$ps = $this->get_pagescript();
			
			// Add token value initialization
			if ($this->_new_token)
			{
				$ps->add_ready_script('$(".csrf-field").val("'.$this->_new_token.'");');
			}
			
			// Set logout script
			if ($this->auth->get_user())
			{
				$ps->add_ready_script('$("#h-logout-link").click(function(){'
					."\n".'$("#logout-form").submit();'
					."\n".'return false;'
					."\n".'});'
				);
			}
			
			// Set alert bootstrap
			$ps->add_ready_script('$(".alert-message").alert();');
			
			// Template disyplay logic
			$this->template->header = View::factory($this->header);
			
			$this->template->content = $this->view;
			$this->template->sidebar = View::factory($this->sidebar);
			
			$this->template->footer = View::factory($this->footer);			
		}

		return parent::after();
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
					$this->get_pagescript()
						->set_focus_script($first_error);
				}
			}
			else
			{
				$this->view->error_message = $error;
			}
			
			if (is_string($focus))
			{
				$this->get_pagescript()
					->set_focus_script($focus);
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
			
			$this->get_pagescript()
				->set_focus_script($first_error);
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
	public function redirect_error($message, $uri = NULL)
	{
		$this->site_redirect('error', $message, $uri);
	}
	
	/**
	 * Redirects to a page with a message for success
	 *
	 * @param string $message
	 * @param string $uri
	 * @return void
	 */
	public function redirect_success($message, $uri = NULL)
	{
		$this->site_redirect('success', $message, $uri);
	}
	
	/**
	 * Redirects to a previous page without
	 *
	 * @return void
	 */
	public function redirect_previous()
	{
		$this->site_redirect(NULL, NULL, NULL);
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
	public function site_redirect($type = NULL, $message = NULL, $uri = NULL)
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
	
	/**
	 * Sends forbidden headers for requests that doesn't handle redirects
	 * and instead must send proper headers like for ajax
	 *
	 * @return void
	 */
	public function send_forbidden_headers()
	{
		$this->response->status(403);
		$this->response->send_headers();
		exit;
	}
}
