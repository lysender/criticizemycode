<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Site {
	
	protected $_keyword;
	
	protected $_hash;
	
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
			$this->_check_get_request();
		}
	}
	
	/**
	 * Checks for a valid post request
	 *
	 */
	protected function _check_post_request()
	{
		$this->_keyword = trim($this->request->post('search_keyword'));
		$invalid = FALSE;
		
		if (strlen($this->_keyword) < 5)
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
			if ($this->_prev_page)
			{
				var_dump($this->_prev_page);
				exit;
				$this->request->redirect($this->_prev_page);
			}
			else
			{
				$this->request->redirect('/');
			}
		}
		
		// Build the pre-approved search hash
		$hash = hash_hmac('sha256', $this->_keyword, uniqid());
		$this->session->set('search_hash', $hash);
		$this->session->set('search_keyword', $this->_keyword);
		
		$url = URL::site('/search').'?hash='.$hash.'&keyword='.urlencode($this->_keyword);
		
		$this->request->redirect($url);
	}
	
	/**
	 * Checks if the successive search requests are valid
	 * and pre-approved
	 *
	 */
	protected function _check_get_request()
	{
		$this->_keyword = $this->session->get('search_keyword');
		$this->_hash = $this->session->get('search_hash');
		$invalid = FALSE;
		
		if (empty($this->_keyword) || empty($this->_hash))
		{
			$invalid = TRUE;
		}
		
		if (
			$this->_keyword !== $this->request->query('keyword') ||
			$this->_hash !== $this->request->query('hash')
		   )
		{
			$invalid = TRUE;
		}
		
		if ($invalid)
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
	
	/**
	 * Browse codes page
	 */
	public function action_index()
	{
		$this->template->title = 'Search';
		$this->template->styles['media/css/pagination.css'] = 'screen, projection';
		$this->view = View::factory('search/index')
			->bind('codes', $codes);
		
		$code = ORM::factory('code');
		
		$this->view->keyword = $this->_keyword;
		
		// Pagination
		$paginate = new Paginate;
		
		$this->view->paginator = $paginate->render(
			'/browse',
			('/browse/page/'),
			$count = $code->count_all(),
			Model_Code::CODES_PER_PAGE,
			$page = $this->request->param('page', 1)
		);
		
		// Set codes to view
		$codes = $code->get_paged($count, $page);
	}
}
