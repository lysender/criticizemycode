<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Presearch extends Controller_Site {
	
	/**
	 * Don't use template
	 *
	 * @var boolean
	 */
	public $auto_render = FALSE;
	
	/**
	 * @var boolean
	 */
	protected $_track_page = FALSE;
	
	/**
	 * Ensure that searches are pre-approved
	 *
	 */
	public function before()
	{
		parent::before();
		
		if ($this->request->method() === Request::POST)
		{
			$this->_check_post_request();
		}
		else
		{
			$this->_go_back();
		}
	}
	
	/**
	 * Go back to previous page
	 *
	 */
	protected function _go_back()
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
	
	/**
	 * Checks for a valid post request
	 *
	 */
	protected function _check_post_request()
	{
		$keyword = trim($this->request->post('search_keyword'));
		$invalid = FALSE;
		
		if (strlen($keyword) < 5)
		{
			$this->session->set('error_message', 'Search keyword too short, it must be at least 5 characters');
			$invalid = TRUE;
		}
		
		if ($this->request->post('csrf') !== $this->_old_token)
		{
			$this->session->set('error_message', 'Invalid search request');
			$invalid = TRUE;
		}
		
		if ($invalid)
		{
			$this->_go_back();
		}
		
		// Build the pre-approved search hash
		$hash = hash_hmac('sha256', $keyword, uniqid());
		$this->session->set('search_hash', $hash);
		$this->session->set('search_keyword', $keyword);
		
		$url = Route::url('search', array('hash' => $hash));
		$this->request->redirect($url);
	}
	
	/**
	 * Browse codes page
	 */
	public function action_index()
	{
		
	}
}
