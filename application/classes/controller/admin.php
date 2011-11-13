<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Base for all admin controllers which contains several custom methods
 * used for basic site features and request validations
 *
 */
abstract class Controller_Admin extends Controller_Site
{
	/**
	 * @var  string
	 */
	public $template = 'admin/site/template/default';
	
	/**
	 * @var  string
	 */
	public $header = 'admin/site/section/header';
	
	/**
	 * @var  Kohana_View
	 */
	public $view;
	
	/**
	 * Sidebar template
	 *
	 * @var  string
	 */
	public $sidebar = NULL;
	
	/**
	 * @var  string
	 */
	public $footer = 'admin/site/section/footer';

	/** 
	 * @var  string
	 */
	public $nav = 'admin/site/section/fragment/nav';

	/** 
	 * Whether or not the user is required to be authenticated or not
	 * 
	 * @var  boolean
	 */
	protected $_no_auth = FALSE;

	/** 
	 * Don't track admin paes
	 *
	 * @var  boolean
	 */
	protected $_track_page = FALSE;

	/** 
	 * Overrides init auth to assert admin role
	 */
	protected function _init_auth()
	{
		parent::_init_auth();

		$this->_assert_admin_role();
	}

	/** 
	 * Checks that the user has admin role
	 * Redirects to home page when user has no admin role
	 *
	 */
	protected function _assert_admin_role()
	{
		$user = $this->auth->get_user();
		$admin = FALSE;

		if ($user && $user->has('roles', ORM::factory('role', array('name' => 'admin'))))
		{
			$admin = TRUE;
		}

		if ( ! $admin)
		{
			if ($this->_ajax_only)
			{
				$this->send_forbidden_headers();
			}
			else
			{
				$this->site_redirect('error', 'Admin privilege required to visit admin pages', '/');
			}
		}
	}
}
