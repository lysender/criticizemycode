<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Base for all controllers which contains several custom methods
 * used for basic site features and request validations
 *
 */
abstract class Controller_Site extends Controller_Template
{
	/**
	 * @var  string
	 */
	public $template = 'site/template/default';
	
	/**
	 * @var  string
	 */
	public $header = 'site/header';
	
	/**
	 * @var  Kohana_View
	 */
	public $view;
	
	/**
	 * Sidebar template
	 *
	 * @var  string
	 */
	public $sidebar = 'site/sidebar';
	
	/**
	 * @var  string
	 */
	public $footer = 'site/footer';
	
	/**
	 * @var  Auth
	 */
	public $auth;
	
	/** 
	 * @var  Session
	 */
	public $session;
	
	/**
	 * @var  Kollection_Script
	 */
	public $script;
	
	/**
	 * @var  Kollection_Message
	 */
	public $message;
	
	/** 
	 * Whether or not the user is required to be authenticated or not
	 * 
	 * @var  boolean
	 */
	protected $_no_auth = TRUE;
	
	/**
	 * Indicates whether or not to track the current page
	 * Set this to FALSE for pages like login/signup or AJAX pages
	 *
	 * @var  boolean
	 */
	protected $_track_page = TRUE;
	
	/**
	 * Whether or not the request is for ajax only
	 * There are requests the redirects when invalid in context, in this case
	 * ajax only requests are handled different and simply returns an error code
	 * as header and don't redirect instead
	 *
	 * @var  boolean
	 */
	protected $_ajax_only = FALSE;
	
	/**
	 * @var  string
	 */
	protected $_current_page;
	
	/**
	 * The previously visited page tracked
	 *
	 * @var  string
	 */
	protected $_prev_page;
	
	/**
	 * For CSRF token - old token
	 *
	 * @var  string
	 */
	protected $_old_token;
	
	/**
	 * For CSRF token - new token
	 *
	 * @var  string
	 */
	protected $_new_token;
	
	/**
	 * Whether or not to use token and renew it automatically
	 *
	 * @var  boolean
	 */
	protected $_use_token = TRUE;
	
	/** 
	 * before()
	 *
	 * Called before action is called
	 */
	public function before()
	{
		// Make sure template is initialized first
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
		// Initialize all necessary views
		$this->template->head = View::factory('site/section/fragment/head');
		$this->template->header = View::factory('site/section/header');
		$this->template->sidebar = View::factory('site/section/sidebar');
		$this->template->footer = View::factory('site/section/footer');
		$this->template->javascript = View::factory('site/section/fragment/javascript');
		
		$this->template->head->styles = array();
		
		// Set required js files
		$this->script = new Kollection_Script(new Kollection_Script_Bootstrap);
		$this->script->set_cache_buster('?v='.APP_VERSION)
			->add_file('media/js/jquery-1.6.4.min.js')
			->add_file('media/bootstrap/js/bootstrap-alerts.js');
		
		// Set head nav selected
		$this->template->header->nav = View::factory('site/section/fragment/nav')
			->set('current_controller', $this->request->controller())
			->set('current_directory', $this->request->directory());
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
			$this->message = new Kollection_Message_Error(array(
				'messages' => $error_message
			));
		}

		// Display success message to template when there was a passed message
		if ($success_message = $this->session->get_once('success_message'))
		{
			$this->message = new Kollection_Message_Success(array(
				'messages' => $success_message
			));
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
			$this->_detect_error_focus();
			$this->template->javascript->script = $this->script;
			
			// Add token value initialization
			$this->template->javascript->csrf_token = $this->_new_token;
			
			// Set logout script
			if ($this->auth->get_user())
			{
				$this->template->javascript->user_logged_in = TRUE;
			}
			
			// Set body content
			$this->template->content = $this->view;
			$this->template->content->message = $this->message;
		}

		return parent::after();
	}
	
	/**
	 * Checks if it is possible to focus on a form element
	 * when there are error messages and sets focus script
	 * if possible
	 *
	 * @return  void
	 */
	protected function _detect_error_focus()
	{
		if ($this->message instanceof Kollection_Message)
		{
			if ($this->message->get_type() == Kollection_Message::TYPE_ERROR)
			{
				$errors = $this->message->get_messages();
				
				if (is_array($errors))
				{
					$keys = array_keys($errors);
					$first_key = reset($keys);
					
					if ( ! is_numeric($first_key))
					{
						$this->script->set_focus_script($first_key);
					}
				}
			}
		}
	}
	
	/**
	 * Redirects to a page with a message for errors
	 *
	 * @param   string	$message
	 * @param   string	$uri
	 * @return  void
	 */
	public function redirect_error($message, $uri = NULL)
	{
		$this->site_redirect('error', $message, $uri);
	}
	
	/**
	 * Redirects to a page with a message for success
	 *
	 * @param   string	$message
	 * @param   string	$uri
	 * @return  void
	 */
	public function redirect_success($message, $uri = NULL)
	{
		$this->site_redirect('success', $message, $uri);
	}
	
	/**
	 * Redirects to a previous page without
	 *
	 * @return  void
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
	 * @param   string	$type
	 * @param   string	$message
	 * @param   string	$uri
	 * @return  void
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
	 * @return  void
	 */
	public function send_forbidden_headers()
	{
		$this->response->status(403);
		$this->response->send_headers();
		exit;
	}
}
